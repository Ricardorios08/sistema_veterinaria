const postgres = require('../backend/db/postgres');
const maria = require('../backend/db/maria');

async function inspect() {
    try {
        console.log("=== POSTGRESQL DETALLES DE CÉDULA ===");
        const pgRes = await postgres.query("SELECT * FROM public.cedula WHERE cedid = $1 OR CAST(cednro AS TEXT) = $1", ['12165108']);
        if (pgRes.rows.length === 0) {
            console.log("No se encontró la cédula en PostgreSQL.");
        } else {
            console.log(JSON.stringify(pgRes.rows[0], (k, v) => typeof v === 'bigint' ? v.toString() : v, 2));
        }

        console.log("\n=== MARIADB DETALLES DE APREMIO ===");
        let conn;
        try {
            conn = await maria.getConnection();
            const myRes = await conn.query("SELECT * FROM recaudacion2.apremio WHERE NumeApre = 12165108");
            if (myRes.length === 0) {
                console.log("No se encontró el apremio en MariaDB.");
            } else {
                console.log(JSON.stringify(myRes[0], (k, v) => typeof v === 'bigint' ? v.toString() : v, 2));
            }
        } finally {
            if (conn) conn.release();
        }
    } catch (err) {
        console.error("Error:", err);
    } finally {
        process.exit(0);
    }
}
inspect();
