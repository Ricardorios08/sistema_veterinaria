const mariadb = require('mariadb');
const path = require('path');
const dotenv = require('dotenv');
dotenv.config({ path: path.join(__dirname, '.env') });

const sourceConfig = {
    host: process.env.MARIA_HOST || "193.203.175.222",
    port: parseInt(process.env.MARIA_PORT || "3306"),
    user: "u259434644_odomed",
    password: "S0p0rt3s2021#",
    database: "u259434644_odomed",
    connectTimeout: 15000,
    allowPublicKeyRetrieval: true
};

const destConfig = {
    host: process.env.MARIA_HOST || "193.203.175.222",
    port: parseInt(process.env.MARIA_PORT || "3306"),
    user: "u259434644_veterinaria",
    password: "S0p0rt3s2021#",
    database: "u259434644_veterinaria",
    connectTimeout: 15000,
    allowPublicKeyRetrieval: true
};

async function run() {
    let sourceConn, destConn;
    try {
        console.log("Connecting to Source Database (Odomed)...");
        sourceConn = await mariadb.createConnection(sourceConfig);
        console.log("Connected to Source Database.");

        console.log("Connecting to Destination Database (Veterinaria)...");
        destConn = await mariadb.createConnection(destConfig);
        console.log("Connected to Destination Database.");

        // Disable FK checks
        await destConn.query("SET FOREIGN_KEY_CHECKS = 0");

        // Fetch tables from source
        const tables = await sourceConn.query("SHOW TABLES");
        console.log(`Found ${tables.length} tables in source database.`);

        for (const tRow of tables) {
            const tableName = Object.values(tRow)[0];
            console.log(`\nProcessing table: ${tableName}`);

            // Get Create Table DDL
            const createResult = await sourceConn.query(`SHOW CREATE TABLE \`${tableName}\``);
            const createSql = createResult[0]['Create Table'];

            // Replace CREATE TABLE with CREATE TABLE IF NOT EXISTS
            const createSqlWithIfNotExists = createSql.replace(/CREATE TABLE/i, 'CREATE TABLE IF NOT EXISTS');

            // Create table in dest
            await destConn.query(createSqlWithIfNotExists);
            console.log(`- Created table (or already exists) in destination.`);

            // Fetch data from source
            const rows = await sourceConn.query(`SELECT * FROM \`${tableName}\``);
            console.log(`- Fetched ${rows.length} rows from source.`);

            if (rows.length > 0) {
                // Clear any existing rows in dest table
                await destConn.query(`TRUNCATE TABLE \`${tableName}\``);

                // Get column names
                const columns = Object.keys(rows[0]);
                const placeholders = columns.map(() => '?').join(', ');
                const columnsEscaped = columns.map(col => `\`${col}\``).join(', ');
                const insertSql = `INSERT INTO \`${tableName}\` (${columnsEscaped}) VALUES (${placeholders})`;

                // Convert rows to array of values
                const dataValues = rows.map(row => columns.map(col => row[col]));

                // Batch insert in chunks of 500 rows
                const chunkSize = 500;
                for (let i = 0; i < dataValues.length; i += chunkSize) {
                    const chunk = dataValues.slice(i, i + chunkSize);
                    await destConn.batch(insertSql, chunk);
                }
                console.log(`- Successfully copied ${rows.length} rows to destination.`);
            } else {
                console.log(`- Table has 0 rows, skipped data copying.`);
            }
        }

        // Re-enable FK checks
        await destConn.query("SET FOREIGN_KEY_CHECKS = 1");
        console.log("\nDatabase copy completed successfully!");

    } catch (err) {
        console.error("Error copying database:", err);
    } finally {
        if (sourceConn) await sourceConn.end();
        if (destConn) await destConn.end();
    }
}

run();
