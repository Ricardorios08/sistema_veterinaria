const userDb = require('../db/userDb');

async function run() {
    console.log("Starting database migration for Waiting List in Odomed database...");
    try {
        console.log("Altering 'turno' table to add 'hora_llegada' column...");
        const addColumnQuery = `
            ALTER TABLE \`turno\`
            ADD COLUMN IF NOT EXISTS \`hora_llegada\` VARCHAR(10) DEFAULT NULL;
        `;
        await userDb.query(addColumnQuery);
        console.log("'hora_llegada' column added successfully!");
    } catch (err) {
        console.error("Migration failed:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
