const userDb = require('./db/userDb');

async function run() {
    console.log("Altering tables in userDb to support routes, collectors, and printing flags...");
    
    const queries = [
        { name: "socio.ruta", sql: "ALTER TABLE socio ADD COLUMN IF NOT EXISTS ruta INT NULL" },
        { name: "socio.cobrador", sql: "ALTER TABLE socio ADD COLUMN IF NOT EXISTS cobrador VARCHAR(10) NULL" },
        { name: "socio.no_imprimir", sql: "ALTER TABLE socio ADD COLUMN IF NOT EXISTS no_imprimir VARCHAR(10) DEFAULT 'FALSO'" },
        { name: "pago.ruta", sql: "ALTER TABLE pago ADD COLUMN IF NOT EXISTS ruta INT NULL" },
        { name: "user.cod_cobrador", sql: "ALTER TABLE user ADD COLUMN IF NOT EXISTS cod_cobrador VARCHAR(10) NULL" }
    ];

    for (const q of queries) {
        try {
            console.log(`Running: ${q.name}...`);
            await userDb.query(q.sql);
            console.log(`Success: ${q.name}`);
        } catch (err) {
            console.error(`Failed: ${q.name}. Error: ${err.message}`, err);
        }
    }
    console.log("Done.");
}

run();
