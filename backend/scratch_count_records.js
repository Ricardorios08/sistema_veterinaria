const userDb = require('./db/userDb');

async function run() {
    try {
        console.log("=== COUNT NOMENCLADORES PER PRESTADOR ===");
        const nomencladorCounts = await userDb.query(
            "SELECT prestador_id, COUNT(*) as qty FROM nomenclador WHERE FechaBaja IS NULL GROUP BY prestador_id"
        );
        console.log(nomencladorCounts);

        console.log("=== COUNT OBRAS SOCIALES PER PRESTADOR ===");
        const obraSocialCounts = await userDb.query(
            "SELECT prestador_id, COUNT(*) as qty FROM obra_social WHERE FechaBaja IS NULL GROUP BY prestador_id"
        );
        console.log(obraSocialCounts);

    } catch (err) {
        console.error(err);
    } finally {
        process.exit(0);
    }
}

run();
