const userDb = require('./db/userDb');

async function run() {
    console.log("Listing all tables in the current u259434644_odomed database...");
    try {
        const tables = await userDb.query("SHOW TABLES");
        console.log("Tables in u259434644_odomed:", tables);
        
        for (const tRow of tables) {
            const tableName = Object.values(tRow)[0];
            console.log(`\n--- Columns of table: ${tableName} ---`);
            const columns = await userDb.query(`DESCRIBE \`${tableName}\``);
            console.table(columns);
        }
    } catch (err) {
        console.error("Error listing tables:", err);
    }
}

run();
