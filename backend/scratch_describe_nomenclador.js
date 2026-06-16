const userDb = require('./db/userDb');

async function run() {
    try {
        console.log("Describing table 'nomenclador'...");
        const columns = await userDb.query("DESCRIBE `nomenclador`");
        console.table(columns);
    } catch (err) {
        console.error("Error:", err);
    } finally {
        process.exit(0);
    }
}

run();
