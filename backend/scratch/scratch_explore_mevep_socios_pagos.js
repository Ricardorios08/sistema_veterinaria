const mevepDb = require('../db/mevepDb');

async function run() {
    try {
        // 1. Listar todas las tablas de la base MEVEP
        const tables = await mevepDb.query("SHOW TABLES");
        console.log("=== TABLAS EN MEVEP ===");
        tables.forEach(t => console.log(' -', Object.values(t)[0]));

        // 2. Buscar tablas relacionadas con socios/pagos/cuotas
        const keywords = ['socio', 'pago', 'cuota', 'cobro', 'ruta', 'cobrador', 'animal', 'mascota', 'espera', 'turno'];
        const related = tables.filter(t => {
            const name = Object.values(t)[0].toLowerCase();
            return keywords.some(k => name.includes(k));
        }).map(t => Object.values(t)[0]);

        console.log("\n=== TABLAS RELACIONADAS ===");
        related.forEach(t => console.log(' -', t));

        // 3. Describir cada tabla relacionada
        for (const tbl of related) {
            console.log(`\n--- DESCRIBE ${tbl} ---`);
            const cols = await mevepDb.query(`DESCRIBE \`${tbl}\``);
            cols.forEach(c => console.log(`  ${c.Field} | ${c.Type} | ${c.Null} | ${c.Key}`));
        }

    } catch (err) {
        console.error("Error:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
