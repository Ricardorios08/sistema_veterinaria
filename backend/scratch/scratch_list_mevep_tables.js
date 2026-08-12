const mevepDb = require('../db/mevepDb');

async function run() {
    console.log("Listing tables in MEVEP database...");
    try {
        const tables = await mevepDb.query("SHOW TABLES");
        console.log("Tables in MEVEP:", tables);

        for (const tRow of tables) {
            const tableName = Object.values(tRow)[0];
            if (['socios', 'pagos', 'cobradores', 'rutas'].includes(tableName.toLowerCase())) {
                console.log(`\n--- Columns of table: ${tableName} ---`);
                const columns = await mevepDb.query(`DESCRIBE \`${tableName}\``);
                console.table(columns);
            }
        }
    } catch (err) {
        console.error("Error:", err);
    }
}

run();
