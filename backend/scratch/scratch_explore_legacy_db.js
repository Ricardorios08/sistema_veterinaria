const mariadb = require('mariadb');
const { Pool } = require('pg');

async function exploreMariaDB() {
    console.log("=== Exploring Old MariaDB (192.168.133.15) ===");
    try {
        const conn = await mariadb.createConnection({
            host: '192.168.133.15',
            user: 'migracionadmin2',
            password: 'vefemlittaryekJur',
            port: 3306,
            connectTimeout: 5000
        });
        console.log("Connected to old MariaDB!");
        const databases = await conn.query("SHOW DATABASES");
        console.log("Databases in old MariaDB:", databases);

        for (const dbRow of databases) {
            const dbName = dbRow.Database || dbRow.database;
            if (dbName === 'information_schema' || dbName === 'performance_schema' || dbName === 'mysql') continue;
            console.log(`\nTables in database: ${dbName}`);
            try {
                await conn.query(`USE \`${dbName}\``);
                const tables = await conn.query("SHOW TABLES");
                console.log(tables);
            } catch (err) {
                console.error(`Error listing tables for ${dbName}:`, err.message);
            }
        }
        await conn.end();
    } catch (err) {
        console.error("Failed to connect to old MariaDB:", err.message);
    }
}

async function explorePostgres() {
    console.log("\n=== Exploring Postgres (aush6.intranet) ===");
    try {
        const pool = new Pool({
            host: 'aush6.intranet',
            user: 'ricardo.rios',
            password: 'icfifNaubookJuks',
            port: 5432,
            database: 'genrentasmgumigracion',
            connectionTimeoutMillis: 5000
        });
        const client = await pool.connect();
        console.log("Connected to Postgres!");
        
        const tablesRes = await client.query(`
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_schema = 'public'
            ORDER BY table_name
        `);
        console.log("Tables in Postgres public schema:", tablesRes.rows);
        client.release();
        await pool.end();
    } catch (err) {
        console.error("Failed to connect to Postgres:", err.message);
    }
}

async function run() {
    await exploreMariaDB();
    await explorePostgres();
}

run();
