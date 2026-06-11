const postgres = require('../backend/db/postgres');

async function inspect() {
    try {
        console.log("=== COLUMNS OF public.cedula ===");
        const colsRes = await postgres.query(`
            SELECT column_name, data_type 
            FROM information_schema.columns 
            WHERE table_schema = 'public' AND table_name = 'cedula'
        `);
        console.table(colsRes.rows);

        console.log("\n=== ALL TABLES CONTAINING 'ced' or 'cuo' IN public ===");
        const tablesRes = await postgres.query(`
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_schema = 'public' AND (table_name LIKE '%ced%' OR table_name LIKE '%cuo%')
        `);
        console.table(tablesRes.rows);

    } catch (err) {
        console.error("Error:", err);
    } finally {
        process.exit(0);
    }
}
inspect();
