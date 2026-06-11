const userDb = require('./db/userDb');

async function run() {
    try {
        console.log("=== AGREGANDO COLUMNAS EN OBRA_SOCIAL ===");
        
        // 1. Verificar si existen las columnas
        const columns = await userDb.query("SHOW COLUMNS FROM obra_social");
        const hasTipo = columns.some(c => c.Field === 'tipo');
        const hasPrestadorId = columns.some(c => c.Field === 'prestador_id');
        
        if (!hasTipo) {
            console.log("Agregando columna 'tipo'...");
            await userDb.query("ALTER TABLE obra_social ADD COLUMN tipo VARCHAR(20) DEFAULT 'publica'");
            console.log("Columna 'tipo' agregada.");
        } else {
            console.log("La columna 'tipo' ya existe.");
        }

        if (!hasPrestadorId) {
            console.log("Agregando columna 'prestador_id'...");
            await userDb.query("ALTER TABLE obra_social ADD COLUMN prestador_id INT NULL");
            console.log("Columna 'prestador_id' agregada.");
        } else {
            console.log("La columna 'prestador_id' ya existe.");
        }

        console.log("=== MIGRACIÓN DE COLUMNAS COMPLETADA ===");
    } catch (err) {
        console.error("Error al alterar la tabla:", err);
    } finally {
        process.exit(0);
    }
}

run();
