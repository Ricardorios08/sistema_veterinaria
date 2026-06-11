const maria = require('../backend/db/maria');
async function test() {
    let conn;
    try {
        conn = await maria.getConnection();
        console.log("Database connected.");
        const query = `
            SELECT a.NumeApre, a.CuenCtct, p.denominacion 
            FROM recaudacion2.apremio a 
            JOIN vpadrones_persona p ON TRIM(a.CuenCtct) = TRIM(p.nro_padron) 
            WHERE p.denominacion LIKE '%QUIROGA%' 
            LIMIT 5
        `;
        const res = await conn.query(query);
        console.log("Results found:", res.length);
        console.table(res);
    } catch (err) {
        console.error("SQL Error:", err.message);
    } finally {
        if (conn) conn.release();
        process.exit(0);
    }
}
test();
