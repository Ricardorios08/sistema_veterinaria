const userDb = require('./db/userDb');

async function inspect() {
    console.log("=== INSPECTING USER TABLE SCHEMA ===");
    try {
        const columns = await userDb.query("SHOW COLUMNS FROM user");
        console.log("User table columns:", columns);

        // Also check if there is an ENUM constraint or CHECK constraint
        const createTable = await userDb.query("SHOW CREATE TABLE user");
        console.log("Create Table statement:", createTable[0]['Create Table']);
    } catch (err) {
        console.error("Error inspecting:", err);
    } finally {
        process.exit(0);
    }
}

inspect();
