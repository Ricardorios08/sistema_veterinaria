const userDb = require('../db/userDb');

async function run() {
    try {
        const rows = await userDb.query("SELECT * FROM \`prestador\`");
        console.log("Prestadores:", rows);
    } catch (err) {
        console.error(err);
    } finally {
        process.exit(0);
    }
}

run();
