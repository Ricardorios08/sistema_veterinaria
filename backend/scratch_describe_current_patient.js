const userDb = require('./db/userDb');

async function run() {
    try {
        console.log("Describing table 'paciente'...");
        const columns = await userDb.query("DESCRIBE `paciente`");
        console.table(columns);
    } catch (err) {
        console.error("Error:", err);
    } finally {
        process.exit(0);
    }
}

run();
