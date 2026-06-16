/**
 * restructure_particulares.js
 * 
 * 1. Crea tabla `particular` en veterinaria
 * 2. Agrega columna `particular_id` a `mascota`
 * 3. Migra `particulares` de MEVEP → `particular`
 * 4. Actualiza las mascotas de origen 'particular' para que apunten a `particular_id`
 *    (en lugar de estar sin dueño o vinculadas a socio_id)
 * 5. Borra los registros mal insertados de animal_particular y los re-inserta con el vínculo correcto
 */

const userDb = require('../db/userDb');
const mevepDb = require('../db/mevepDb');

const BATCH = 500;

async function crearTablasYColumnas() {
    console.log('\n=== PASO 1: Creando tabla particular y columna particular_id ===\n');

    // Tabla particular (dueños sin cuota/membresía)
    await userDb.query(`
        CREATE TABLE IF NOT EXISTS \`particular\` (
            \`id\`               INT(11) NOT NULL AUTO_INCREMENT,
            \`cod_mevep\`        INT(10) DEFAULT NULL COMMENT 'cod_socio original en particulares MEVEP',
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
            \`observaciones\`    TEXT DEFAULT NULL,
            \`prestador_id\`     INT(11) DEFAULT 1,
            \`CreacionUsuario\`  VARCHAR(100) DEFAULT 'MIGRACION_MEVEP',
            \`FechaCreacion\`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            \`ModificacionUsuario\` VARCHAR(100) DEFAULT NULL,
            \`FechaModificacion\`   TIMESTAMP NULL DEFAULT NULL,
            \`FechaBaja\`        TIMESTAMP NULL DEFAULT NULL,
            \`BajaUsuario\`      VARCHAR(100) DEFAULT NULL,
            PRIMARY KEY (\`id\`),
            UNIQUE KEY \`uk_particular_cod_mevep\` (\`cod_mevep\`),
            KEY \`idx_particular_documento\` (\`documento\`),
            KEY \`idx_particular_apellido\` (\`apellido\`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    `);
    console.log('✓ Tabla particular OK');

    // Agregar columna particular_id a mascota (si no existe)
    const cols = await userDb.query("SHOW COLUMNS FROM mascota LIKE 'particular_id'");
    if (cols.length === 0) {
        await userDb.query(`
            ALTER TABLE mascota 
            ADD COLUMN \`particular_id\` INT(11) DEFAULT NULL COMMENT 'FK → particular' AFTER \`socio_id\`,
            ADD KEY \`idx_mascota_particular\` (\`particular_id\`),
            ADD CONSTRAINT \`fk_mascota_particular\` FOREIGN KEY (\`particular_id\`) REFERENCES \`particular\` (\`id\`) ON DELETE SET NULL
        `);
        console.log('✓ Columna particular_id agregada a mascota');
    } else {
        console.log('✓ Columna particular_id ya existe en mascota');
    }
}

async function migrarParticulares() {
    console.log('\n=== PASO 2: Migrando particulares desde MEVEP ===\n');

    const total = await mevepDb.query('SELECT COUNT(*) as t FROM particulares');
    console.log(`Total particulares en MEVEP: ${total[0].t}`);

    let offset = 0, migrados = 0, errores = 0;

    while (true) {
        const rows = await mevepDb.query(
            `SELECT cod_socio, apellido, nombre, tipo_doc, documento, telefono, celular,
                    domicilio, localidad, departamento, cod_postal, mail, sexo, fecha_ingreso
             FROM particulares ORDER BY cod_socio LIMIT ? OFFSET ?`,
            [BATCH, offset]
        );
        if (rows.length === 0) break;

        for (const p of rows) {
            try {
                let fechaIngreso = null;
                if (p.fecha_ingreso) {
                    const d = new Date(p.fecha_ingreso);
                    if (!isNaN(d.getTime())) fechaIngreso = d.toISOString().split('T')[0];
                }
                await userDb.query(
                    `INSERT IGNORE INTO particular
                     (cod_mevep, apellido, nombre, tipo_doc, documento, telefono, celular,
                      domicilio, localidad, departamento, cod_postal, mail, sexo, fecha_ingreso)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
                    [
                        p.cod_socio,
                        (p.apellido || '').trim(),
                        (p.nombre || '').trim(),
                        p.tipo_doc || 'D.N.I',
                        p.documento ? String(p.documento) : null,
                        p.telefono || null,
                        p.celular || null,
                        p.domicilio || null,
                        p.localidad || null,
                        p.departamento || null,
                        p.cod_postal || null,
                        p.mail || null,
                        p.sexo || null,
                        fechaIngreso
                    ]
                );
                migrados++;
            } catch (e) {
                errores++;
                if (errores <= 5) console.error(`  ✗ Particular ${p.cod_socio}: ${e.message}`);
            }
        }

        offset += rows.length;
        process.stdout.write(`\r  Procesados: ${offset} | Migrados: ${migrados} | Errores: ${errores}`);
        if (rows.length < BATCH) break;
    }
    console.log(`\n✓ Particulares migrados: ${migrados} | Errores: ${errores}`);
}

async function reasignarMascotasParticulares() {
    console.log('\n=== PASO 3: Reasignando mascotas de particulares ===\n');
    console.log('  Borrando mascotas particulares mal vinculadas...');

    // Borrar las mascotas de origen 'particular' que se migraron sin el vínculo correcto
    await userDb.query(`DELETE FROM mascota WHERE origen = 'particular'`);
    console.log('  ✓ Mascotas particulares anteriores eliminadas');

    // Cargar mapa: cod_mevep de MEVEP particulares → id local en tabla particular
    const partRows = await userDb.query('SELECT id, cod_mevep FROM particular WHERE cod_mevep IS NOT NULL');
    const partMap = {};
    for (const r of partRows) partMap[r.cod_mevep] = Number(r.id);
    console.log(`  Mapa de particulares cargado: ${Object.keys(partMap).length}`);

    const total = await mevepDb.query('SELECT COUNT(*) as t FROM animal_particular');
    console.log(`  Total animal_particular en MEVEP: ${total[0].t}`);

    let offset = 0, migrados = 0, errores = 0;

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

                const particularId = partMap[a.cod_socio] || null;

                await userDb.query(
                    `INSERT INTO mascota
                     (particular_id, cod_animal_mevep, nombre, especie, raza, pelaje, tamanio, color, sexo, fecha_nac, origen)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'particular')`,
                    [
                        particularId,
                        a.cod_animal || null,
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
                if (errores <= 5) console.error(`  ✗ animal_particular ${a.cod_socio}/${a.nombre}: ${e.message}`);
            }
        }

        offset += rows.length;
        process.stdout.write(`\r  Procesados: ${offset} | Migrados: ${migrados} | Errores: ${errores}`);
        if (rows.length < BATCH) break;
    }
    console.log(`\n✓ Mascotas particulares re-migradas: ${migrados} | Errores: ${errores}`);
}

async function verificar() {
    console.log('\n=== VERIFICACIÓN FINAL ===\n');
    const [socios, particulares, mascotas, mSocios, mPart] = await Promise.all([
        userDb.query('SELECT COUNT(*) as t FROM socio'),
        userDb.query('SELECT COUNT(*) as t FROM particular'),
        userDb.query(`SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN origen='socio' THEN 1 ELSE 0 END) as de_socios,
            SUM(CASE WHEN origen='particular' THEN 1 ELSE 0 END) as de_particulares
            FROM mascota`),
        mevepDb.query('SELECT COUNT(*) as t FROM animal'),
        mevepDb.query('SELECT COUNT(*) as t FROM animal_particular'),
    ]);
    console.table([
        { Tabla: 'socio', Registros: socios[0].t },
        { Tabla: 'particular', Registros: particulares[0].t },
        { Tabla: 'mascota total', Registros: mascotas[0].total },
        { Tabla: '  → de socios', Registros: mascotas[0].de_socios },
        { Tabla: '  → de particulares', Registros: mascotas[0].de_particulares },
        { Tabla: 'animal MEVEP', Registros: mSocios[0].t },
        { Tabla: 'animal_particular MEVEP', Registros: mPart[0].t },
    ]);
}

async function main() {
    try {
        await crearTablasYColumnas();
        await migrarParticulares();
        await reasignarMascotasParticulares();
        await verificar();
        console.log('\n✓ Reestructuración completada!\n');
    } catch (err) {
        console.error('\n✗ ERROR FATAL:', err.message, err);
    } finally {
        process.exit(0);
    }
}
main();
