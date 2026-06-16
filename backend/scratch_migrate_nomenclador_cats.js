const userDb = require('./db/userDb');

async function run() {
    try {
        console.log("Migrating category 'odontologico' to 'veterinario' in nomenclador...");
        const result = await userDb.query("UPDATE `nomenclador` SET categoria = 'veterinario' WHERE categoria = 'odontologico'");
        console.log("Migration result:", result);
    } catch (err) {
        console.error("Error:", err);
    } finally {
        process.exit(0);
    }
}

run();
