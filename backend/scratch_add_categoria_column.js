const userDb = require('./db/userDb');

async function run() {
    try {
        console.log("=== AGREGANDO COLUMNA CATEGORIA EN NOMENCLADOR ===");
        
        // Verificar si existe la columna
        const columns = await userDb.query("SHOW COLUMNS FROM nomenclador");
        const hasCategoria = columns.some(c => c.Field === 'categoria');
        
        if (!hasCategoria) {
            console.log("Agregando columna 'categoria'...");
            await userDb.query("ALTER TABLE nomenclador ADD COLUMN categoria VARCHAR(50) DEFAULT 'odontologico'");
            console.log("Columna 'categoria' agregada.");
        } else {
            console.log("La columna 'categoria' ya existe.");
        }

        console.log("=== MIGRACIÓN DE COLUMNA CATEGORIA COMPLETADA ===");
    } catch (err) {
        console.error("Error al alterar la tabla nomenclador:", err);
    } finally {
        process.exit(0);
    }
}

run();
