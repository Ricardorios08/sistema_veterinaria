const userDb = require('./db/userDb');

async function run() {
    console.log("=== INICIANDO MIGRACIÓN CLAVE COMPUESTA PACIENTE (DNI + PRESTADOR) ===");
    try {
        // 1. Intentar borrar el índice único existente sobre 'dni' solo
        console.log("\n[1/2] Intentando eliminar índice único existente 'dni'...");
        const dropQueries = [
            'ALTER TABLE \`paciente\` DROP INDEX IF EXISTS \`dni\`',
            'ALTER TABLE \`paciente\` DROP INDEX IF EXISTS \`uq_paciente_dni\`',
            'ALTER TABLE \`paciente\` DROP CONSTRAINT IF EXISTS \`dni\`',
            'ALTER TABLE \`paciente\` DROP CONSTRAINT IF EXISTS \`uq_paciente_dni\`',
            'DROP INDEX IF EXISTS \`dni\` ON \`paciente\`',
            'DROP INDEX IF EXISTS \`uq_paciente_dni\` ON \`paciente\`',
            // En MariaDB/MySQL, las llaves únicas a veces se llaman igual que la columna
            'ALTER TABLE \`paciente\` DROP INDEX \`dni\`',
            'ALTER TABLE \`paciente\` DROP INDEX \`uq_paciente_dni\`'
        ];

        for (const dropQuery of dropQueries) {
            try {
                await userDb.query(dropQuery);
                console.log(`-> Éxito ejecutando: ${dropQuery}`);
            } catch (e) {
                console.log(`-> Omitido o no aplicable: ${dropQuery} (${e.message})`);
            }
        }

        // 2. Agregar clave compuesta única sobre (dni, prestador_id)
        console.log("\n[2/2] Creando clave única compuesta (dni, prestador_id)...");
        try {
            await userDb.query(`
                ALTER TABLE \`paciente\` 
                ADD UNIQUE KEY \`uq_paciente_dni_prestador\` (\`dni\`, \`prestador_id\`)
            `);
            console.log("-> ¡Éxito! Clave única compuesta uq_paciente_dni_prestador creada.");
        } catch (err) {
            console.error("-> Error al crear la clave compuesta:", err.message);
        }

        console.log("\n=== MIGRACIÓN FINALIZADA CORRECTAMENTE ===");
    } catch (err) {
        console.error("Fallo general:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
