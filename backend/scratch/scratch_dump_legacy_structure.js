const mariadb = require('mariadb');
const fs = require('fs');
const path = require('path');

async function run() {
    console.log("Dumping legacy database structure to legacy_structure.txt...");
    
    let conn;
    try {
        conn = await mariadb.createConnection({
            host: '193.203.175.222',
            user: 'u259434644_sigma_turnos',
            password: 'S0p0rt3s2021',
            database: 'u259434644_sigma_turnos',
            port: 3306,
            connectTimeout: 5000
        });
    } catch (err) {
        console.error("Connection failed:", err.message);
        return;
    }

    let output = "=== LEGACY DATABASE STRUCTURE FOR u259434644_sigma_turnos ===\n\n";

    try {
        const tables = await conn.query("SHOW TABLES");
        const tableNames = tables.map(tRow => Object.values(tRow)[0]);
        output += `Tables found: ${tableNames.join(', ')}\n\n`;

        for (const tableName of tableNames) {
            output += `==================================================\n`;
            output += `TABLE: ${tableName}\n`;
            output += `==================================================\n`;
            
            // Columns info
            const columns = await conn.query(`DESCRIBE \`${tableName}\``);
            output += "Columns:\n";
            columns.forEach(col => {
                output += `  - ${col.Field}: ${col.Type} | Null: ${col.Null} | Key: ${col.Key} | Default: ${col.Default} | Extra: ${col.Extra}\n`;
            });
            output += "\n";

            // Row count
            const countRes = await conn.query(`SELECT COUNT(*) as cnt FROM \`${tableName}\``);
            const count = countRes[0].cnt;
            output += `Row Count: ${count}\n\n`;

            // Sample rows
            if (count > 0) {
                const sample = await conn.query(`SELECT * FROM \`${tableName}\` LIMIT 5`);
                output += "Sample Records:\n";
                output += JSON.stringify(sample, (key, val) => typeof val === 'bigint' ? val.toString() : val, 2);
                output += "\n";
            }
            output += "\n";
        }

        fs.writeFileSync(path.join(__dirname, 'legacy_structure.txt'), output, 'utf8');
        console.log("Dump successful! Saved to backend/legacy_structure.txt");

    } catch (err) {
        console.error("Error exploring database:", err.message);
    } finally {
        await conn.end();
    }
}

run();
