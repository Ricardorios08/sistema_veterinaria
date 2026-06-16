/**
 * explore_mevep_socios.js
 * Explora las tablas de socios/animales en la base MEVEP legacy
 */
const mariadb = require('mariadb');

const MEVEP = {
    host: '193.203.175.222',
    user: 'u259434644_mevep',
    password: 'S0p0rt3s2021',
    database: 'u259434644_mevep',
    port: 3306,
    connectTimeout: 8000
};

async function run() {
    let conn;
    try {
        conn = await mariadb.createConnection(MEVEP);
        console.log('✓ Conectado a u259434644_mevep\n');

        // 1) Listar todas las tablas
        const tables = await conn.query('SHOW TABLES');
        const tableNames = tables.map(r => Object.values(r)[0]);
        console.log('=== TODAS LAS TABLAS EN MEVEP ===');
        console.log(tableNames.join(', '));

        // 2) Describir tablas clave
        const keyTables = ['socios', 'animal', 'animal_particular'];
        for (const t of keyTables) {
            if (!tableNames.includes(t)) {
                console.log(`\n⚠ Tabla '${t}' no existe en MEVEP`);
                continue;
            }
            console.log(`\n${'='.repeat(50)}`);
            console.log(`DESCRIBE ${t}`);
            console.log('='.repeat(50));
            const cols = await conn.query(`DESCRIBE \`${t}\``);
            console.table(cols.map(c => ({ Field: c.Field, Type: c.Type, Null: c.Null, Key: c.Key, Default: c.Default })));

            const count = await conn.query(`SELECT COUNT(*) as total FROM \`${t}\``);
            console.log(`→ Registros: ${count[0].total}`);

            // Muestra 3 registros de ejemplo
            const sample = await conn.query(`SELECT * FROM \`${t}\` LIMIT 3`);
            console.log('→ Muestra (3 registros):');
            console.log(JSON.stringify(sample, null, 2));
        }

    } catch (err) {
        console.error('ERROR:', err.message);
    } finally {
        if (conn) await conn.end();
        process.exit(0);
    }
}
run();
