const mariadb = require('mariadb');

async function run() {
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

        const rows = await conn.query("SELECT * FROM `diagnostico` ORDER BY fecha_diagnostico DESC LIMIT 20");
        console.log("Sample Diagnosticos:");
        console.log(rows);
    } catch (err) {
        console.error("Error:", err.message);
    } finally {
        if (conn) await conn.end();
        process.exit(0);
    }
}

run();
