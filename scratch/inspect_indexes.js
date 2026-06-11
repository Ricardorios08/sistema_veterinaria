const postgres = require('../backend/db/postgres');
const maria = require('../backend/db/maria');

async function inspect() {
    try {
        console.log("=== MARIADB INDEXES ON apremio ===");
        let conn;
        try {
            conn = await maria.getConnection();
            const myRes = await conn.query("SHOW INDEX FROM recaudacion2.apremio");
            console.table(myRes.map(idx => ({
                Table: idx.Table,
                Non_unique: idx.Non_unique,
                Key_name: idx.Key_name,
                Seq_in_index: idx.Seq_in_index,
                Column_name: idx.Column_name
            })));
        } finally {
            if (conn) conn.release();
        }

        console.log("\n=== POSTGRESQL INDEXES ON public.cedula AND public.tcedulacedcuo ===");
        const pgRes = await postgres.query(`
            SELECT 
                t.relname as table_name,
                i.relname as index_name,
                a.attname as column_name
            FROM 
                pg_class t,
                pg_class i,
                pg_index ix,
                pg_attribute a
            WHERE 
                t.oid = ix.indrelid
                AND i.oid = ix.indexrelid
                AND a.attrelid = t.oid
                AND a.attnum = ANY(ix.indkey)
                AND t.relkind = 'r'
                AND t.relname IN ('cedula', 'tcedulacedcuo')
            ORDER BY 
                t.relname,
                i.relname;
        `);
        console.table(pgRes.rows);

    } catch (err) {
        console.error("Error:", err);
    } finally {
        process.exit(0);
    }
}
inspect();
