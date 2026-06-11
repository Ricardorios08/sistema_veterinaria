const postgres = require('../backend/db/postgres');
const maria = require('../backend/db/maria');

async function check() {
    try {
        console.log("=== MARIADB DIRECT QUERY ===");
        let conn;
        try {
            conn = await maria.getConnection();
            const myRes = await conn.query("SELECT * FROM recaudacion2.apremio WHERE CuenCtct = '76169' AND CodiOfic = 6");
            console.log("MariaDB matching rows count:", myRes.length);
            if (myRes.length > 0) {
                console.log("First row:", {
                    NumeApre: myRes[0].NumeApre,
                    CuenCtct: myRes[0].CuenCtct,
                    CodiOfic: myRes[0].CodiOfic,
                    TituApre: myRes[0].TituApre
                });
            }
        } finally {
            if (conn) conn.release();
        }

        console.log("\n=== POSTGRESQL DIRECT QUERY ON tcedulacedcuo ===");
        const pgRes = await postgres.query("SELECT * FROM public.tcedulacedcuo WHERE cedcuotribcod = 76169");
        console.log("Postgres tcedulacedcuo matching rows count:", pgRes.rows.length);
        if (pgRes.rows.length > 0) {
            console.log("First 3 rows in tcedulacedcuo:", pgRes.rows.slice(0, 3));
            
            const cednros = pgRes.rows.map(r => r.cednro);
            const pgCedulas = await postgres.query("SELECT * FROM public.cedula WHERE cednro = ANY($1::bigint[])", [cednros]);
            console.log("Postgres matching cedulas count:", pgCedulas.rows.length);
            if (pgCedulas.rows.length > 0) {
                console.log("First 3 matching cedulas:", pgCedulas.rows.slice(0, 3).map(c => ({
                    cedid: c.cedid,
                    cednro: c.cednro,
                    cedseccod: c.cedseccod,
                    cedpercod: c.cedpercod
                })));
            }
        }

    } catch (err) {
        console.error("Error:", err);
    } finally {
        process.exit(0);
    }
}
check();
