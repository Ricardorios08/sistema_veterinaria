/**
 * migrate_socios_mascotas.js
 * 
 * 1. Crea las tablas `socio` y `mascota` en u259434644_veterinaria
 * 2. Migra socios desde MEVEP → socio
 * 3. Migra animal + animal_particular desde MEVEP → mascota
 */

const userDb = require('../db/userDb');
const mevepDb = require('../db/mevepDb');

const BATCH = 500; // insertar de a 500 registros

async function createTables() {
    console.log('\n=== PASO 1: Creando tablas socio y mascota ===\n');

    // Tabla socio (dueños/tutores de animales)
    await userDb.query(`
        CREATE TABLE IF NOT EXISTS \`socio\` (
            \`id\`               INT(11) NOT NULL AUTO_INCREMENT,
            \`cod_mevep\`        INT(10) DEFAULT NULL COMMENT 'cod_socio original en MEVEP',
            \`apellido\`         VARCHAR(100) NOT NULL DEFAULT '',
            \`nombre\`           VARCHAR(100) NOT NULL DEFAULT '',
            \`tipo_doc\`         VARCHAR(20) DEFAULT 'D.N.I',
            \`documento\`        VARCHAR(20) DEFAULT NULL,
            \`telefono\`         VARCHAR(50) DEFAULT NULL,
            \`celular\`          VARCHAR(50) DEFAULT NULL,
            \`domicilio\`        VARCHAR(200) DEFAULT NULL,
            \`localidad\`        VARCHAR(100) DEFAULT NULL,
            \`departamento\`     VARCHAR(100) DEFAULT NULL,
            \`cod_postal\`       VARCHAR(20) DEFAULT NULL,
            \`mail\`             VARCHAR(100) DEFAULT NULL,
            \`sexo\`             VARCHAR(10) DEFAULT NULL,
            \`fecha_ingreso\`    DATE DEFAULT NULL,
            \`importe_cuota\`    DECIMAL(10,2) DEFAULT 0.00,
            \`observaciones\`    TEXT DEFAULT NULL,
            \`prestador_id\`     INT(11) DEFAULT 1,
            \`CreacionUsuario\`  VARCHAR(100) DEFAULT 'MIGRACION_MEVEP',
            \`FechaCreacion\`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            \`ModificacionUsuario\` VARCHAR(100) DEFAULT NULL,
            \`FechaModificacion\`   TIMESTAMP NULL DEFAULT NULL,
            \`FechaBaja\`        TIMESTAMP NULL DEFAULT NULL,
            \`BajaUsuario\`      VARCHAR(100) DEFAULT NULL,
            PRIMARY KEY (\`id\`),
            UNIQUE KEY \`uk_socio_cod_mevep\` (\`cod_mevep\`),
            KEY \`idx_socio_documento\` (\`documento\`),
            KEY \`idx_socio_apellido\` (\`apellido\`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    `);
    console.log('✓ Tabla socio OK');

    // Tabla mascota (animales)
    await userDb.query(`
        CREATE TABLE IF NOT EXISTS \`mascota\` (
            \`id\`               INT(11) NOT NULL AUTO_INCREMENT,
            \`cod_mevep\`        INT(11) DEFAULT NULL COMMENT 'id original en MEVEP (animal.id)',
            \`cod_animal_mevep\` INT(11) DEFAULT NULL COMMENT 'cod_animal original en MEVEP',
            \`socio_id\`         INT(11) DEFAULT NULL COMMENT 'FK → socio (dueño)',
            \`nombre\`           VARCHAR(100) NOT NULL DEFAULT '',
            \`especie\`          VARCHAR(60) DEFAULT NULL,
            \`raza\`             VARCHAR(60) DEFAULT NULL,
            \`pelaje\`           VARCHAR(60) DEFAULT NULL,
            \`tamanio\`          VARCHAR(40) DEFAULT NULL,
            \`color\`            VARCHAR(60) DEFAULT NULL,
            \`sexo\`             VARCHAR(20) DEFAULT NULL,
            \`fecha_nac\`        DATE DEFAULT NULL,
            \`origen\`           ENUM('socio','particular') NOT NULL DEFAULT 'socio',
            \`observaciones\`    TEXT DEFAULT NULL,
            \`prestador_id\`     INT(11) DEFAULT 1,
            \`CreacionUsuario\`  VARCHAR(100) DEFAULT 'MIGRACION_MEVEP',
            \`FechaCreacion\`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            \`ModificacionUsuario\` VARCHAR(100) DEFAULT NULL,
            \`FechaModificacion\`   TIMESTAMP NULL DEFAULT NULL,
            \`FechaBaja\`        TIMESTAMP NULL DEFAULT NULL,
            \`BajaUsuario\`      VARCHAR(100) DEFAULT NULL,
            PRIMARY KEY (\`id\`),
            KEY \`idx_mascota_socio\` (\`socio_id\`),
            KEY \`idx_mascota_nombre\` (\`nombre\`),
            KEY \`idx_mascota_especie\` (\`especie\`),
            CONSTRAINT \`fk_mascota_socio\` FOREIGN KEY (\`socio_id\`) REFERENCES \`socio\` (\`id\`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    `);
    console.log('✓ Tabla mascota OK');
}

async function migrarSocios() {
    console.log('\n=== PASO 2: Migrando socios desde MEVEP ===\n');

    const total = await mevepDb.query('SELECT COUNT(*) as t FROM socios');
    console.log(`Total socios en MEVEP: ${total[0].t}`);

    let offset = 0;
    let migrados = 0;
    let errores = 0;

    while (true) {
        const rows = await mevepDb.query(
            `SELECT cod_socio, apellido, nombre, tipo_doc, documento, 
                    telefono, celular, domicilio, localidad, departamento, 
                    cod_postal, mail, sexo, fecha_ingreso, importe_cuota
             FROM socios 
             ORDER BY cod_socio 
             LIMIT ? OFFSET ?`,
            [BATCH, offset]
        );

        if (rows.length === 0) break;

        for (const s of rows) {
            try {
                // Normalizar fecha_ingreso (puede venir vacía)
                let fechaIngreso = null;
                if (s.fecha_ingreso && s.fecha_ingreso.toString().trim() !== '') {
                    const d = new Date(s.fecha_ingreso);
                    if (!isNaN(d.getTime())) fechaIngreso = d.toISOString().split('T')[0];
                }

                await userDb.query(
                    `INSERT IGNORE INTO socio 
                     (cod_mevep, apellido, nombre, tipo_doc, documento, telefono, celular,
                      domicilio, localidad, departamento, cod_postal, mail, sexo, 
                      fecha_ingreso, importe_cuota)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
                    [
                        s.cod_socio,
                        (s.apellido || '').trim(),
                        (s.nombre || '').trim(),
                        s.tipo_doc || 'D.N.I',
                        s.documento ? String(s.documento) : null,
                        s.telefono || null,
                        s.celular || null,
                        s.domicilio || null,
                        s.localidad || null,
                        s.departamento || null,
                        s.cod_postal ? String(s.cod_postal) : null,
                        s.mail || null,
                        s.sexo || null,
                        fechaIngreso,
                        parseFloat(s.importe_cuota) || 0
                    ]
                );
                migrados++;
            } catch (e) {
                errores++;
                if (errores <= 5) console.error(`  ✗ Socio ${s.cod_socio}: ${e.message}`);
            }
        }

        offset += rows.length;
        process.stdout.write(`\r  Procesados: ${offset} | Migrados: ${migrados} | Errores: ${errores}`);

        if (rows.length < BATCH) break;
    }

    console.log(`\n✓ Socios migrados: ${migrados} | Errores: ${errores}`);
}

async function migrarAnimales() {
    console.log('\n=== PASO 3: Migrando animales (socios) desde MEVEP ===\n');

    // Cargar mapa cod_mevep → id local de socios
    console.log('  Cargando mapa de socios...');
    const socioRows = await userDb.query('SELECT id, cod_mevep FROM socio WHERE cod_mevep IS NOT NULL');
    const socioMap = {};
    for (const r of socioRows) socioMap[r.cod_mevep] = Number(r.id);
    console.log(`  Mapa cargado: ${Object.keys(socioMap).length} socios`);

    const total = await mevepDb.query('SELECT COUNT(*) as t FROM animal');
    console.log(`  Total animales en MEVEP: ${total[0].t}`);

    let offset = 0;
    let migrados = 0;
    let errores = 0;

    while (true) {
        const rows = await mevepDb.query(
            `SELECT id, cod_socio, nombre, especie, raza, pelaje, tamanio, color, sexo, fecha_nac, cod_animal
             FROM animal ORDER BY id LIMIT ? OFFSET ?`,
            [BATCH, offset]
        );

        if (rows.length === 0) break;

        for (const a of rows) {
            try {
                let fechaNac = null;
                if (a.fecha_nac) {
                    const d = new Date(a.fecha_nac);
                    if (!isNaN(d.getTime()) && d.getFullYear() > 1900) {
                        fechaNac = d.toISOString().split('T')[0];
                    }
                }

                const socioId = socioMap[a.cod_socio] || null;

                await userDb.query(
                    `INSERT IGNORE INTO mascota 
                     (cod_mevep, cod_animal_mevep, socio_id, nombre, especie, raza, pelaje, tamanio, color, sexo, fecha_nac, origen)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'socio')`,
                    [
                        a.id,
                        a.cod_animal || null,
                        socioId,
                        (a.nombre || '').trim() || 'SIN NOMBRE',
                        a.especie || null,
                        a.raza || null,
                        a.pelaje || null,
                        a.tamanio || null,
                        a.color || null,
                        a.sexo || null,
                        fechaNac
                    ]
                );
                migrados++;
            } catch (e) {
                errores++;
                if (errores <= 5) console.error(`  ✗ Animal ${a.id}: ${e.message}`);
            }
        }

        offset += rows.length;
        process.stdout.write(`\r  Procesados: ${offset} | Migrados: ${migrados} | Errores: ${errores}`);

        if (rows.length < BATCH) break;
    }

    console.log(`\n✓ Mascotas (socios) migradas: ${migrados} | Errores: ${errores}`);
}

async function migrarAnimalesParticulares() {
    console.log('\n=== PASO 4: Migrando animal_particular desde MEVEP ===\n');

    // Para particulares, buscar si el cod_socio ya existe como socio
    const socioRows = await userDb.query('SELECT id, cod_mevep FROM socio WHERE cod_mevep IS NOT NULL');
    const socioMap = {};
    for (const r of socioRows) socioMap[r.cod_mevep] = Number(r.id);

    const total = await mevepDb.query('SELECT COUNT(*) as t FROM animal_particular');
    console.log(`  Total en MEVEP: ${total[0].t}`);

    // Obtener los cod_mevep ya insertados para no duplicar
    const yaInsertados = await userDb.query("SELECT cod_mevep FROM mascota WHERE cod_mevep IS NOT NULL AND origen = 'socio'");
    const setInsertados = new Set(yaInsertados.map(r => Number(r.cod_mevep)));

    let offset = 0;
    let migrados = 0;
    let errores = 0;

    while (true) {
        const rows = await mevepDb.query(
            `SELECT cod_socio, nombre, especie, raza, pelaje, tamanio, color, sexo, fecha_nac, cod_animal
             FROM animal_particular ORDER BY cod_socio LIMIT ? OFFSET ?`,
            [BATCH, offset]
        );

        if (rows.length === 0) break;

        for (const a of rows) {
            try {
                let fechaNac = null;
                if (a.fecha_nac) {
                    const d = new Date(a.fecha_nac);
                    if (!isNaN(d.getTime()) && d.getFullYear() > 1900) {
                        fechaNac = d.toISOString().split('T')[0];
                    }
                }

                const socioId = socioMap[a.cod_socio] || null;

                await userDb.query(
                    `INSERT INTO mascota 
                     (cod_animal_mevep, socio_id, nombre, especie, raza, pelaje, tamanio, color, sexo, fecha_nac, origen)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'particular')`,
                    [
                        a.cod_animal || null,
                        socioId,
                        (a.nombre || '').trim() || 'SIN NOMBRE',
                        a.especie || null,
                        a.raza || null,
                        a.pelaje || null,
                        a.tamanio || null,
                        a.color || null,
                        a.sexo || null,
                        fechaNac
                    ]
                );
                migrados++;
            } catch (e) {
                errores++;
                if (errores <= 5) console.error(`  ✗ Particular ${a.cod_socio}/${a.nombre}: ${e.message}`);
            }
        }

        offset += rows.length;
        process.stdout.write(`\r  Procesados: ${offset} | Migrados: ${migrados} | Errores: ${errores}`);

        if (rows.length < BATCH) break;
    }

    console.log(`\n✓ Mascotas (particulares) migradas: ${migrados} | Errores: ${errores}`);
}

async function verificar() {
    console.log('\n=== VERIFICACIÓN FINAL ===\n');
    const [socios, mascotas, mevSocios, mevAnimal, mevPart] = await Promise.all([
        userDb.query('SELECT COUNT(*) as t FROM socio'),
        userDb.query('SELECT COUNT(*) as t FROM mascota'),
        mevepDb.query('SELECT COUNT(*) as t FROM socios'),
        mevepDb.query('SELECT COUNT(*) as t FROM animal'),
        mevepDb.query('SELECT COUNT(*) as t FROM animal_particular'),
    ]);
    console.table([
        { Tabla: 'socios (MEVEP)', Total: mevSocios[0].t },
        { Tabla: 'socio (veterinaria)', Total: socios[0].t },
        { Tabla: 'animal (MEVEP)', Total: mevAnimal[0].t },
        { Tabla: 'animal_particular (MEVEP)', Total: mevPart[0].t },
        { Tabla: 'mascota (veterinaria)', Total: mascotas[0].t },
    ]);
}

async function main() {
    try {
        await createTables();
        await migrarSocios();
        await migrarAnimales();
        await migrarAnimalesParticulares();
        await verificar();
        console.log('\n✓ ¡Migración completada!\n');
    } catch (err) {
        console.error('\n✗ ERROR FATAL:', err.message);
        console.error(err);
    } finally {
        process.exit(0);
    }
}

main();
