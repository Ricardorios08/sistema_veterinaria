const userDb = require('../db/userDb');

async function inspect() {
    console.log("=== INSPECTING NOMENCLADOR & OBRA SOCIAL TABLES ===");
    try {
        const nomCols = await userDb.query("SHOW COLUMNS FROM nomenclador");
        console.log("\nNomenclador columns:", nomCols);

        const osCols = await userDb.query("SHOW COLUMNS FROM obra_social");
        console.log("\nObra Social columns:", osCols);
    } catch (err) {
        console.error("Error inspecting:", err);
    } finally {
        process.exit(0);
    }
}

inspect();
