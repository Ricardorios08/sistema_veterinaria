const userDb = require('./db/userDb');
const mevepDb = require('./db/mevepDb');

async function run() {
    try {
        // Ver estructura de la tabla socios en el sistema nuevo
        console.log("=== DESCRIBE socios (sistema nuevo) ===");
        const desc = await userDb.query("DESCRIBE `socio`");
        desc.forEach(c => console.log(`  ${c.Field} | ${c.Type} | Key: ${c.Key}`));

        // Ver si hay un campo cod_socio o mevep_id en la tabla
        console.log("\n=== Primeros 5 socios del sistema nuevo ===");
        const socios = await userDb.query("SELECT * FROM `socio` LIMIT 5");
        socios.forEach(s => console.log(JSON.stringify(Object.fromEntries(
            Object.entries(s).map(([k,v]) => [k, v?.toString?.() ?? v])
        ))));

        // Ver si hay tabla de pagos en el sistema nuevo
        const tables = await userDb.query("SHOW TABLES");
        console.log("\n=== Tablas en sistema nuevo ===");
        tables.forEach(t => console.log(' -', Object.values(t)[0]));

    } catch (err) {
        console.error("Error:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
