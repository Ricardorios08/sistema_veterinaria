const userDb = require('../db/userDb');

async function migrate() {
    try {
        console.log("=== INICIANDO MIGRACIÓN DE CATÁLOGOS A TABLAS INTERMEDIAS ===");

        // 1. Limpiar tablas _new previas si existen
        await userDb.query("DROP TABLE IF EXISTS `prestador_obra_social_new`");
        await userDb.query("DROP TABLE IF EXISTS `prestador_nomenclador_new`");
        await userDb.query("DROP TABLE IF EXISTS `obra_social_new`");
        await userDb.query("DROP TABLE IF EXISTS `nomenclador_new`");

        // 2. Crear nuevas tablas de catálogos globales
        console.log("Creando tabla obra_social_new...");
        await userDb.query(`
            CREATE TABLE \`obra_social_new\` (
                \`id\` INT(11) NOT NULL AUTO_INCREMENT,
                \`nombre\` VARCHAR(255) NOT NULL,
                \`sigla\` VARCHAR(100) DEFAULT NULL,
                \`descripcion\` TEXT DEFAULT NULL,
                \`CreacionUsuario\` VARCHAR(255) DEFAULT NULL,
                \`FechaCreacion\` DATETIME DEFAULT NULL,
                \`ModificacionUsuario\` VARCHAR(255) DEFAULT NULL,
                \`FechaModificacion\` DATETIME DEFAULT NULL,
                \`FechaBaja\` DATETIME DEFAULT NULL,
                \`BajaUsuario\` VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (\`id\`),
                UNIQUE KEY \`uq_obra_social_nombre\` (\`nombre\`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        `);

        console.log("Creando tabla nomenclador_new...");
        await userDb.query(`
            CREATE TABLE \`nomenclador_new\` (
                \`id\` INT(11) NOT NULL AUTO_INCREMENT,
                \`codigo\` VARCHAR(50) NOT NULL,
                \`nombre\` VARCHAR(255) NOT NULL,
                \`descripcion\` TEXT DEFAULT NULL,
                \`CreacionUsuario\` VARCHAR(255) DEFAULT NULL,
                \`FechaCreacion\` DATETIME DEFAULT NULL,
                \`ModificacionUsuario\` VARCHAR(255) DEFAULT NULL,
                \`FechaModificacion\` DATETIME DEFAULT NULL,
                \`FechaBaja\` DATETIME DEFAULT NULL,
                \`BajaUsuario\` VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (\`id\`),
                UNIQUE KEY \`uq_nomenclador_codigo\` (\`codigo\`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        `);

        // 3. Crear tablas intermedias
        console.log("Creando tabla prestador_obra_social_new...");
        await userDb.query(`
            CREATE TABLE \`prestador_obra_social_new\` (
                \`id\` INT(11) NOT NULL AUTO_INCREMENT,
                \`prestador_id\` INT(11) NOT NULL,
                \`obra_social_id\` INT(11) NOT NULL,
                \`CreacionUsuario\` VARCHAR(255) DEFAULT NULL,
                \`FechaCreacion\` DATETIME DEFAULT NULL,
                \`FechaBaja\` DATETIME DEFAULT NULL,
                \`BajaUsuario\` VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (\`id\`),
                UNIQUE KEY \`uq_prestador_obra_social\` (\`prestador_id\`, \`obra_social_id\`),
                CONSTRAINT \`fk_prestador_obra_social_prestador\` FOREIGN KEY (\`prestador_id\`) REFERENCES \`prestador\` (\`id\`) ON DELETE CASCADE,
                CONSTRAINT \`fk_prestador_obra_social_obra_social\` FOREIGN KEY (\`obra_social_id\`) REFERENCES \`obra_social_new\` (\`id\`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        `);

        console.log("Creando tabla prestador_nomenclador_new...");
        await userDb.query(`
            CREATE TABLE \`prestador_nomenclador_new\` (
                \`id\` INT(11) NOT NULL AUTO_INCREMENT,
                \`prestador_id\` INT(11) NOT NULL,
                \`nomenclador_id\` INT(11) NOT NULL,
                \`precio\` DECIMAL(10,2) NOT NULL,
                \`CreacionUsuario\` VARCHAR(255) DEFAULT NULL,
                \`FechaCreacion\` DATETIME DEFAULT NULL,
                \`ModificacionUsuario\` VARCHAR(255) DEFAULT NULL,
                \`FechaModificacion\` DATETIME DEFAULT NULL,
                \`FechaBaja\` DATETIME DEFAULT NULL,
                \`BajaUsuario\` VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (\`id\`),
                UNIQUE KEY \`uq_prestador_nomenclador\` (\`prestador_id\`, \`nomenclador_id\`),
                CONSTRAINT \`fk_prestador_nomenclador_prestador\` FOREIGN KEY (\`prestador_id\`) REFERENCES \`prestador\` (\`id\`) ON DELETE CASCADE,
                CONSTRAINT \`fk_prestador_nomenclador_nomenclador\` FOREIGN KEY (\`nomenclador_id\`) REFERENCES \`nomenclador_new\` (\`id\`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        `);

        // 4. Consolidar Obras Sociales
        console.log("Consolidando Obras Sociales...");
        const oldObras = await userDb.query("SELECT * FROM obra_social ORDER BY id ASC");

        // Agrupar por nombre único (normalizado)
        const mappedObras = new Map(); // nombre_normalizado -> new_id
        const oldOsToNewOs = new Map(); // old_id -> new_id

        for (const os of oldObras) {
            const normalizedName = os.nombre.trim().toLowerCase();
            let newId;
            if (!mappedObras.has(normalizedName)) {
                // Insertar en la nueva tabla
                const res = await userDb.query(
                    `INSERT INTO obra_social_new 
                    (nombre, sigla, descripcion, CreacionUsuario, FechaCreacion, ModificacionUsuario, FechaModificacion, FechaBaja, BajaUsuario)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`,
                    [os.nombre.trim(), os.sigla, os.descripcion, os.CreacionUsuario, os.FechaCreacion, os.ModificacionUsuario, os.FechaModificacion, os.FechaBaja, os.BajaUsuario]
                );
                newId = res.insertId;
                mappedObras.set(normalizedName, newId);
            } else {
                newId = mappedObras.get(normalizedName);
            }
            oldOsToNewOs.set(os.id, newId);

            // Insertar relación en prestador_obra_social_new si no existe ya
            try {
                await userDb.query(
                    `INSERT IGNORE INTO prestador_obra_social_new 
                    (prestador_id, obra_social_id, CreacionUsuario, FechaCreacion, FechaBaja, BajaUsuario)
                    VALUES (?, ?, ?, ?, ?, ?)`,
                    [os.prestador_id || 1, newId, os.CreacionUsuario, os.FechaCreacion, os.FechaBaja, os.BajaUsuario]
                );
            } catch (err) {
                console.log(`Relación prestador-obra omitida para prestador ${os.prestador_id} y obra ${newId}: ${err.message}`);
            }
        }
        console.log(`Obras sociales consolidadas. Mapeo generado para ${oldOsToNewOs.size} registros.`);

        // 5. Consolidar Nomencladores
        console.log("Consolidando Nomencladores...");
        const oldNoms = await userDb.query("SELECT * FROM nomenclador ORDER BY id ASC");

        // Agrupar por código único
        const mappedNoms = new Map(); // codigo_normalizado -> new_id
        const oldNomToNewNom = new Map(); // old_id -> new_id

        for (const nom of oldNoms) {
            const normalizedCode = nom.codigo.trim().toLowerCase();
            let newId;
            if (!mappedNoms.has(normalizedCode)) {
                // Insertar en la nueva tabla
                const res = await userDb.query(
                    `INSERT INTO nomenclador_new 
                    (codigo, nombre, descripcion, CreacionUsuario, FechaCreacion, ModificacionUsuario, FechaModificacion, FechaBaja, BajaUsuario)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`,
                    [nom.codigo.trim(), nom.nombre.trim(), nom.descripcion, nom.CreacionUsuario, nom.FechaCreacion, nom.ModificacionUsuario, nom.FechaModificacion, nom.FechaBaja, nom.BajaUsuario]
                );
                newId = res.insertId;
                mappedNoms.set(normalizedCode, newId);
            } else {
                newId = mappedNoms.get(normalizedCode);
            }
            oldNomToNewNom.set(nom.id, newId);

            // Insertar relación en prestador_nomenclador_new
            try {
                await userDb.query(
                    `INSERT IGNORE INTO prestador_nomenclador_new 
                    (prestador_id, nomenclador_id, precio, CreacionUsuario, FechaCreacion, ModificacionUsuario, FechaModificacion, FechaBaja, BajaUsuario)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`,
                    [nom.prestador_id || 1, newId, nom.precio, nom.CreacionUsuario, nom.FechaCreacion, nom.ModificacionUsuario, nom.FechaModificacion, nom.FechaBaja, nom.BajaUsuario]
                );
            } catch (err) {
                console.log(`Relación prestador-nomenclador omitida: ${err.message}`);
            }
        }
        console.log(`Nomencladores consolidados. Mapeo generado para ${oldNomToNewNom.size} registros.`);

        // 6. Actualizar las referencias de claves foráneas
        console.log("Actualizando tabla 'paciente'...");
        const pacientes = await userDb.query("SELECT id, obra_social_id FROM paciente WHERE obra_social_id IS NOT NULL");
        for (const pac of pacientes) {
            const newOsId = oldOsToNewOs.get(pac.obra_social_id);
            if (newOsId) {
                await userDb.query("UPDATE paciente SET obra_social_id = ? WHERE id = ?", [newOsId, pac.id]);
            }
        }
        console.log(`Se actualizaron ${pacientes.length} registros de pacientes.`);

        console.log("Actualizando tabla 'tratamiento_realizado'...");
        const tratamientos = await userDb.query("SELECT id, nomenclador_id FROM tratamiento_realizado WHERE nomenclador_id IS NOT NULL");
        for (const tr of tratamientos) {
            const newNomId = oldNomToNewNom.get(tr.nomenclador_id);
            if (newNomId) {
                await userDb.query("UPDATE tratamiento_realizado SET nomenclador_id = ? WHERE id = ?", [newNomId, tr.id]);
            }
        }
        console.log(`Se actualizaron ${tratamientos.length} registros de tratamientos realizados.`);

        // 7. Renombrar tablas (Swapping)
        console.log("Renombrando tablas originales y nuevas...");

        // Quitar constraints temporales para evitar errores de renombrado
        await userDb.query("SET FOREIGN_KEY_CHECKS = 0");

        // Eliminar tablas de backup antiguas si existen
        await userDb.query("DROP TABLE IF EXISTS `prestador_obra_social_old`");
        await userDb.query("DROP TABLE IF EXISTS `prestador_nomenclador_old`");
        await userDb.query("DROP TABLE IF EXISTS `obra_social_old`");
        await userDb.query("DROP TABLE IF EXISTS `nomenclador_old`");

        // Renombrar originales a old
        await userDb.query("RENAME TABLE `obra_social` TO `obra_social_old`");
        await userDb.query("RENAME TABLE `nomenclador` TO `nomenclador_old`");

        // Renombrar nuevas a definitivas
        await userDb.query("RENAME TABLE `obra_social_new` TO `obra_social`");
        await userDb.query("RENAME TABLE `nomenclador_new` TO `nomenclador`");
        await userDb.query("RENAME TABLE `prestador_obra_social_new` TO `prestador_obra_social`");
        await userDb.query("RENAME TABLE `prestador_nomenclador_new` TO `prestador_nomenclador`");

        // Restaurar constraints y claves foráneas
        await userDb.query("SET FOREIGN_KEY_CHECKS = 1");

        // 8. Re-crear constraints en las tablas finales de relación
        console.log("Re-estableciendo constraints en las tablas definitivas...");

        // Limpieza de constraints huérfanas en obra_social
        try {
            await userDb.query("ALTER TABLE `prestador_obra_social` DROP FOREIGN KEY `fk_prestador_obra_social_obra_social`");
        } catch (e) { }
        await userDb.query(`
            ALTER TABLE \`prestador_obra_social\`
            ADD CONSTRAINT \`fk_prestador_obra_social_obra_social\` 
            FOREIGN KEY (\`obra_social_id\`) REFERENCES \`obra_social\` (\`id\`) ON DELETE CASCADE
        `);

        // Limpieza de constraints huérfanas en nomenclador
        try {
            await userDb.query("ALTER TABLE `prestador_nomenclador` DROP FOREIGN KEY `fk_prestador_nomenclador_nomenclador`");
        } catch (e) { }
        await userDb.query(`
            ALTER TABLE \`prestador_nomenclador\`
            ADD CONSTRAINT \`fk_prestador_nomenclador_nomenclador\` 
            FOREIGN KEY (\`nomenclador_id\`) REFERENCES \`nomenclador\` (\`id\`) ON DELETE CASCADE
        `);

        console.log("=== MIGRACIÓN COMPLETADA EXITOSAMENTE ===");

    } catch (err) {
        console.error("ERROR CRÍTICO DURANTE LA MIGRACIÓN:", err);
        // Intentar restaurar FK checks por si acaso
        await userDb.query("SET FOREIGN_KEY_CHECKS = 1");
    } finally {
        process.exit(0);
    }
}

migrate();
