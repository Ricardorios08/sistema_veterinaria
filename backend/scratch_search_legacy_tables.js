const { Pool } = require('pg');

async function run() {
    console.log("Searching for legacy scheduling / medical tables in Postgres...");
    const pool = new Pool({
        host: 'aush6.intranet',
        user: 'ricardo.rios',
        password: 'icfifNaubookJuks',
        port: 5432,
        database: 'genrentasmgumigracion',
        connectionTimeoutMillis: 5000
    });

    try {
        const client = await pool.connect();
        
        // Let's get ALL tables in the schema
        const res = await client.query(`
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_schema = 'public'
            ORDER BY table_name
        `);

        const tables = res.rows.map(r => r.table_name);
        
        // Keywords to search for
        const keywords = ['turno', 'agenda', 'medico', 'profesional', 'horario', 'paciente', 'especialidad', 'clinica', 'atencion', 'reserva', 'cita', 'calendario', 'med', 'pac', 'tur', 'age', 'esp'];
        
        const matchedTables = tables.filter(t => {
            return keywords.some(k => t.toLowerCase().includes(k));
        });

        console.log("Matched Tables:", matchedTables);

        // Let's inspect columns or select rows for some interesting ones if they exist
        // For example, if there is a 'turno', 'agenda', 'profesional' or similar table, let's DESCRIBE it!
        for (const t of matchedTables) {
            console.log(`\n--- Columns of ${t} ---`);
            const colRes = await client.query(`
                SELECT column_name, data_type, is_nullable
                FROM information_schema.columns
                WHERE table_schema = 'public' AND table_name = ?
            `, [t]).catch(() => {});
            
            if (colRes && colRes.rows) {
                console.log(colRes.rows);
            } else {
                // Try direct select limit 0 to get column names or query pg_attribute
                const colRes2 = await client.query(`
                    SELECT column_name, data_type, is_nullable
                    FROM information_schema.columns
                    WHERE table_schema = 'public' AND table_name = $1
                `, [t]);
                console.log(colRes2.rows);
            }
        }

        client.release();
        await pool.end();
    } catch (err) {
        console.error("Error searching tables:", err.message);
    }
}

run();
