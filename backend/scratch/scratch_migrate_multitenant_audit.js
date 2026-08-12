const userDb = require('../db/userDb');

async function run() {
    console.log("=== INICIANDO MIGRACIÓN MULTI-TENANCY Y AUDITORÍA GENERAL ===");
    try {
        // 1. Crear tabla 'prestador'
        console.log("\n[1/6] Creando tabla 'prestador'...");
        const createPrestadorQuery = `
            CREATE TABLE IF NOT EXISTS \`prestador\` (
              \`id\` INT(11) NOT NULL AUTO_INCREMENT,
              \`nombre\` VARCHAR(255) NOT NULL,
              \`sigla\` VARCHAR(50) DEFAULT NULL,
              \`cuit\` VARCHAR(50) DEFAULT NULL,
              \`direccion\` VARCHAR(255) DEFAULT NULL,
              \`telefono\` VARCHAR(100) DEFAULT NULL,
              \`CreacionUsuario\` VARCHAR(255) DEFAULT 'SYSTEM_MIGRATION',
              \`FechaCreacion\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              \`ModificacionUsuario\` VARCHAR(255) DEFAULT NULL,
              \`FechaModificacion\` TIMESTAMP NULL DEFAULT NULL,
              \`FechaBaja\` TIMESTAMP NULL DEFAULT NULL,
              \`BajaUsuario\` VARCHAR(255) DEFAULT NULL,
              PRIMARY KEY (\`id\`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        `;
        await userDb.query(createPrestadorQuery);
        await userDb.query(`INSERT IGNORE INTO \`prestador\` (\`id\`, \`nombre\`) VALUES (1, 'Premium')`);
        console.log("-> Tabla 'prestador' verificada.");


        const createObraSocialQuery = `
            CREATE TABLE IF NOT EXISTS \`obra_social\` (
              \`id\` INT(11) NOT NULL AUTO_INCREMENT,
              \`nombre\` VARCHAR(255) NOT NULL,
              \`sigla\` VARCHAR(50) DEFAULT NULL,
              \`descripcion\` TEXT DEFAULT NULL,
              PRIMARY KEY (\`id\`),
              UNIQUE KEY \`uq_obra_social_nombre\` (\`nombre\`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        `;
        await userDb.query(createObraSocialQuery);
        console.log("-> Tabla 'obra_social' verificada.");

        // 4. Agregar columnas de auditoría a todas las tablas existentes
        console.log("\n[4/6] Agregando columnas de auditoría a todas las tablas...");
        const tablesToAudit = [
            'user', 'paciente', 'turno', 'historia_clinica', 'odontograma',
            'tratamiento_realizado', 'nomenclador', 'tipo_profesional', 'obra_social'
        ];

        for (const table of tablesToAudit) {
            console.log(`-> Procesando tabla '${table}'...`);
            // Usamos ALTER TABLE ADD COLUMN IF NOT EXISTS para mayor robustez
            const alterAuditQuery = `
                ALTER TABLE \`${table}\`
                ADD COLUMN IF NOT EXISTS \`CreacionUsuario\` VARCHAR(255) DEFAULT 'SYSTEM_MIGRATION',
                ADD COLUMN IF NOT EXISTS \`FechaCreacion\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                ADD COLUMN IF NOT EXISTS \`ModificacionUsuario\` VARCHAR(255) DEFAULT NULL,
                ADD COLUMN IF NOT EXISTS \`FechaModificacion\` TIMESTAMP NULL DEFAULT NULL,
                ADD COLUMN IF NOT EXISTS \`FechaBaja\` TIMESTAMP NULL DEFAULT NULL,
                ADD COLUMN IF NOT EXISTS \`BajaUsuario\` VARCHAR(255) DEFAULT NULL;
            `;
            await userDb.query(alterAuditQuery);
        }
        console.log("-> Columnas de auditoría añadidas con éxito.");

        // 5. Agregar prestador_id y FK a las tablas correspondientes
        console.log("\n[5/6] Agregando columna 'prestador_id' y FKs...");
        const tablesWithTenant = [
            'user', 'paciente', 'turno', 'historia_clinica', 'odontograma', 'tratamiento_realizado'
        ];

        for (const table of tablesWithTenant) {
            console.log(`-> Procesando 'prestador_id' en '${table}'...`);
            // Añadir columna prestador_id
            await userDb.query(`
                ALTER TABLE \`${table}\`
                ADD COLUMN IF NOT EXISTS \`prestador_id\` INT(11) DEFAULT NULL;
            `);

            // Intentar añadir constraint FK
            try {
                const fkName = `fk_${table}_prestador`;
                await userDb.query(`
                    ALTER TABLE \`${table}\`
                    ADD CONSTRAINT \`${fkName}\`
                    FOREIGN KEY (\`prestador_id\`) REFERENCES \`prestador\` (\`id\`)
                    ON DELETE SET NULL;
                `);
                console.log(`   * Restricción FK '${fkName}' añadida.`);
            } catch (fkErr) {
                console.log(`   * La restricción FK ya existía o se omitió: ${fkErr.message}`);
            }
        }

        // 6. Poblar datos históricos
        console.log("\n[6/6] Poblando datos históricos y relacionando al prestador ID = 1...");

        // Asociar registros preexistentes a prestador 1
        for (const table of tablesWithTenant) {
            const updateCount = await userDb.query(`
                UPDATE \`${table}\`
                SET \`prestador_id\` = 1
                WHERE \`prestador_id\` IS NULL
            `);
            console.log(`-> Tabla '${table}': Se actualizaron ${updateCount.affectedRows || 0} registros con prestador_id = 1.`);
        }

        // Poblar fechas de creación de datos históricos con datos existentes cuando sea posible
        // Para 'paciente', heredar de 'fecha_creacion'
        try {
            await userDb.query(`
                UPDATE \`paciente\`
                SET \`FechaCreacion\` = \`fecha_creacion\`
                WHERE \`FechaCreacion\` IS NULL AND \`fecha_creacion\` IS NOT NULL
            `);
        } catch (e) {
            console.log("No se pudo heredar fecha_creacion en paciente:", e.message);
        }

        // Para 'historia_clinica', heredar de 'fecha'
        try {
            await userDb.query(`
                UPDATE \`historia_clinica\`
                SET \`FechaCreacion\` = \`fecha\`
                WHERE \`FechaCreacion\` IS NULL AND \`fecha\` IS NOT NULL
            `);
        } catch (e) {
            console.log("No se pudo heredar fecha en historia_clinica:", e.message);
        }

        // Asegurar que las columnas de creación queden consistentes
        for (const table of tablesToAudit) {
            await userDb.query(`
                UPDATE \`${table}\`
                SET \`CreacionUsuario\` = 'SYSTEM_MIGRATION'
                WHERE \`CreacionUsuario\` IS NULL
            `);
        }

        console.log("\n=== MIGRACIÓN COMPLETADA EXITOSAMENTE DE FORMA CORRECTA ===");
    } catch (err) {
        console.error("\n[ERROR] Falló la migración:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
