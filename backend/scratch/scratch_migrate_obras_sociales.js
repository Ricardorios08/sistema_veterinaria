const userDb = require('../db/userDb');

async function run() {
    console.log("Starting database migration for Obras Sociales in Odomed database...");
    try {
        // 1. Create obra_social table
        console.log("Creating 'obra_social' table...");
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
        console.log("'obra_social' table created successfully!");

        // 2. Alter paciente table to add obra_social_id foreign key
        console.log("\nAltering 'paciente' table to add 'obra_social_id' column and constraint...");

        // Add column if it doesn't exist
        const addColumnQuery = `
            ALTER TABLE \`paciente\`
            ADD COLUMN IF NOT EXISTS \`obra_social_id\` INT(11) DEFAULT NULL;
        `;
        await userDb.query(addColumnQuery);
        console.log("'obra_social_id' column added!");

        // Add foreign key constraint (ignoring errors if constraint already exists)
        try {
            const addFkQuery = `
                ALTER TABLE \`paciente\`
                ADD CONSTRAINT \`fk_paciente_obra_social\`
                FOREIGN KEY (\`obra_social_id\`) REFERENCES \`obra_social\` (\`id\`)
                ON DELETE SET NULL;
            `;
            await userDb.query(addFkQuery);
            console.log("Foreign key constraint fk_paciente_obra_social created successfully!");
        } catch (fkErr) {
            console.log("Constraint might already exist, skipping: ", fkErr.message);
        }

        // 3. Inject default Obras Sociales if empty
        console.log("\nChecking for default Obras Sociales...");
        const activeObras = await userDb.query("SELECT COUNT(*) as count FROM \`obra_social\`");
        if (activeObras[0].count === 0) {
            console.log("Injecting default Obras Sociales (OSEP, OSDE, PAMI, Particular, SANCOR SALUD)...");
            const defaults = [
                { nombre: 'Particular', sigla: 'PART', descripcion: 'Atención particular sin obra social' },
                { nombre: 'Obra Social de Empleados Públicos', sigla: 'OSEP', descripcion: 'Obra Social de Empleados Públicos de Mendoza' },
                { nombre: 'Organización de Servicios Directos Empresarios', sigla: 'OSDE', descripcion: 'Medicina Prepaga OSDE' },
                { nombre: 'Programa de Atención Médica Integral', sigla: 'PAMI', descripcion: 'PAMI Jubilados y Pensionados' },
                { nombre: 'Sancor Salud', sigla: 'SANCOR', descripcion: 'Grupo de Medicina Privada' }
            ];

            for (const item of defaults) {
                await userDb.query(
                    "INSERT INTO \`obra_social\` (nombre, sigla, descripcion) VALUES (?, ?, ?)",
                    [item.nombre, item.sigla, item.descripcion]
                );
            }
            console.log("Default Obras Sociales injected successfully!");
        } else {
            console.log("Obras Sociales already exist in table. Skipping injection.");
        }

        console.log("\nObras Sociales migration completed successfully!");

    } catch (err) {
        console.error("Migration failed:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
