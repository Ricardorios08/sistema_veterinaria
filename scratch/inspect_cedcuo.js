const postgres = require('../backend/db/postgres');

async function inspect() {
    try {
        console.log("=== COLUMNS OF public.tcedulacedcuo ===");
        const colsRes = await postgres.query(`
            SELECT column_name, data_type 
            FROM information_schema.columns 
            WHERE table_schema = 'public' AND table_name = 'tcedulacedcuo'
        `);
        console.table(colsRes.rows);

        console.log("\n=== ROWS OF public.tcedulacedcuo FOR cednro = 263544 ===");
        const rowsRes = await postgres.query(`
            SELECT * FROM public.tcedulacedcuo WHERE cednro = 263544
        `);
        console.log(JSON.stringify(rowsRes.rows, null, 2));

    } catch (err) {
        console.error("Error:", err);
    } finally {
        process.exit(0);
    }
}
inspect();
