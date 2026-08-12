const userDb = require('../db/userDb');

async function run() {
    try {
        const rows = await userDb.query("SELECT DISTINCT categoria, COUNT(*) as count FROM `nomenclador` GROUP BY categoria");
        console.log("Categories in database:", rows);
    } catch (err) {
        console.error("Error:", err);
    } finally {
        process.exit(0);
    }
}

run();
