const mariadb = require('mariadb');

async function testWithPassword(password) {
    console.log(`Trying connection to u259434644_sigma_turnos with password: "${password}"`);
    let conn;
    try {
        conn = await mariadb.createConnection({
            host: '193.203.175.222',
            user: 'u259434644_sigma_turnos',
            password: password,
            database: 'u259434644_sigma_turnos',
            port: 3306,
            connectTimeout: 5000
        });
        console.log("SUCCESSFULLY CONNECTED!");
        return conn;
    } catch (err) {
        console.error("Connection failed:", err.message);
        return null;
    }
}

async function run() {
    // Try without '#' first as in user's comment
    let conn = await testWithPassword("S0p0rt3s2021");
    if (!conn) {
        // Try with '#' just in case
        conn = await testWithPassword("S0p0rt3s2021#");
    }

    if (!conn) {
        console.error("Could not connect to u259434644_sigma_turnos with either password.");
        return;
    }

    try {
        console.log("\nListing all tables in u259434644_sigma_turnos...");
        const tables = await conn.query("SHOW TABLES");
        console.log("Tables found:", tables);

        for (const tRow of tables) {
            const tableName = Object.values(tRow)[0];
            console.log(`\n--- Table: ${tableName} ---`);
            try {
                const columns = await conn.query(`DESCRIBE \`${tableName}\``);
                console.table(columns);

                const rowCount = await conn.query(`SELECT COUNT(*) as cnt FROM \`${tableName}\``);
                console.log(`Row count: ${rowCount[0].cnt}`);

                if (rowCount[0].cnt > 0) {
                    const sample = await conn.query(`SELECT * FROM \`${tableName}\` LIMIT 3`);
                    console.log("Sample records:");
                    console.log(JSON.stringify(sample, (key, value) => typeof value === 'bigint' ? value.toString() : value, 2));
                }
            } catch (err) {
                console.error(`Error describing table ${tableName}:`, err.message);
            }
        }
    } catch (err) {
        console.error("Error exploring tables:", err.message);
    } finally {
        await conn.end();
    }
}

run();
