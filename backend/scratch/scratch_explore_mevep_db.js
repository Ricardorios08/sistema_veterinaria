const mariadb = require('mariadb');

async function run() {
    console.log("Connecting to u259434644_mevep database on host 193.203.175.222...");
    let conn;
    try {
        conn = await mariadb.createConnection({
            host: '193.203.175.222',
            user: 'u259434644_mevep',
            password: 'S0p0rt3s2021',
            database: 'u259434644_mevep',
            port: 3306,
            connectTimeout: 8000
        });
        console.log("SUCCESSFULLY connected to mevep legacy database!");
        
        console.log("\n--- Listing Tables ---");
        const tables = await conn.query("SHOW TABLES");
        console.log(tables);

        for (const tRow of tables) {
            const tableName = Object.values(tRow)[0];
            console.log(`\n======================================================`);
            console.log(`Table: ${tableName}`);
            console.log(`======================================================`);
            const columns = await conn.query(`DESCRIBE \`${tableName}\``);
            console.table(columns);
        }

    } catch (err) {
        console.error("Connection failed:", err.message);
    } finally {
        if (conn) {
            await conn.end();
        }
        process.exit(0);
    }
}

run();
