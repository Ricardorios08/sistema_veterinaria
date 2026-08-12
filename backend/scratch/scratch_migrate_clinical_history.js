const userDb = require('../db/userDb');

async function run() {
    console.log("Starting database migration for Clinical History logical deletion in Odomed...");
    try {
        console.log("Altering 'historia_clinica' table to add logical deletion columns...");

        // Add anulado column
        const addAnuladoQuery = `
            ALTER TABLE \`historia_clinica\`
            ADD COLUMN IF NOT EXISTS \`anulado\` TINYINT(1) DEFAULT 0;
        `;
        await userDb.query(addAnuladoQuery);
        console.log("'anulado' column added!");

        // Add motivo_anulacion column
        const addMotivoQuery = `
            ALTER TABLE \`historia_clinica\`
            ADD COLUMN IF NOT EXISTS \`motivo_anulacion\` VARCHAR(255) DEFAULT NULL;
        `;
        await userDb.query(addMotivoQuery);
        console.log("'motivo_anulacion' column added!");

        // Add fecha_anulacion column
        const addFechaQuery = `
            ALTER TABLE \`historia_clinica\`
            ADD COLUMN IF NOT EXISTS \`fecha_anulacion\` TIMESTAMP NULL DEFAULT NULL;
        `;
        await userDb.query(addFechaQuery);
        console.log("'fecha_anulacion' column added successfully!");

    } catch (err) {
        console.error("Migration failed:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
