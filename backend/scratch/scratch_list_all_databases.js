const userDb = require('../db/userDb');

async function run() {
    console.log("Listing all databases in MariaDB server...");
    try {
        const databases = await userDb.query("SHOW DATABASES");
        console.log("Databases on this host:", databases);
    } catch (err) {
        console.error("Error listing databases:", err);
    }
}

run();
