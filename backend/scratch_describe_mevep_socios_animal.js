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

        const tables = ['socios', 'animal', 'animal_particular'];
        for (const t of tables) {
            console.log(`\n================ DESCRIBE ${t} ================`);
            const cols = await conn.query(`DESCRIBE \`${t}\``);
            console.table(cols);
        }
    } catch (err) {
        console.error("Error:", err.message);
    } finally {
        if (conn) await conn.end();
        process.exit(0);
    }
}

run();
