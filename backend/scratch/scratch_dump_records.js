const userDb = require('../db/userDb');

async function run() {
    try {
        console.log("=== ALL NOMENCLADORES ===");
        const nomencladores = await userDb.query("SELECT * FROM nomenclador");
        console.log(nomencladores);

        console.log("=== ALL OBRAS SOCIALES ===");
        const obras = await userDb.query("SELECT * FROM obra_social");
        console.log(obras);
    } catch (err) {
        console.error(err);
    } finally {
        process.exit(0);
    }
}

run();
