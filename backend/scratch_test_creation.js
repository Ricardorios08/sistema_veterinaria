const userDb = require('./db/userDb');

async function test() {
    try {
        console.log("=== PROBANDO LA CREACIÓN DE UNA INSTITUCIÓN ===");
        
        // Simular los parámetros
        const nombre = "Clínica de Prueba " + Date.now();
        const sigla = "TEST";
        const usuario = "admin";
        
        const result = await userDb.query(
            `INSERT INTO prestador (nombre, sigla, CreacionUsuario, FechaCreacion) 
             VALUES (?, ?, ?, NOW())`,
            [nombre, sigla, usuario]
        );

        const newPrestadorId = Number(result.insertId);
        console.log(`Institución creada con ID: ${newPrestadorId}`);

        // 1. Auto-vincular
        await userDb.query(
            `INSERT INTO prestador_obra_social (prestador_id, obra_social_id, CreacionUsuario, FechaCreacion)
             SELECT ?, id, ?, NOW() FROM obra_social WHERE FechaBaja IS NULL`,
            [newPrestadorId, usuario]
        );
        console.log("Vínculos con Obras Sociales creados.");

        // 2. Auto-vincular Nomencladores
        await userDb.query(
            `INSERT INTO prestador_nomenclador (prestador_id, nomenclador_id, precio, CreacionUsuario, FechaCreacion)
             SELECT ?, nomenclador_id, precio, ?, NOW() FROM prestador_nomenclador WHERE prestador_id = 1 AND FechaBaja IS NULL`,
            [newPrestadorId, usuario]
        );
        console.log("Vínculos con Nomencladores y precios base creados.");

        // Verificar resultados
        const obras = await userDb.query("SELECT * FROM prestador_obra_social WHERE prestador_id = ?", [newPrestadorId]);
        console.log(`Obras vinculadas para esta clínica (esperado: 1): ${obras.length}`);

        const noms = await userDb.query("SELECT * FROM prestador_nomenclador WHERE prestador_id = ?", [newPrestadorId]);
        console.log(`Nomencladores vinculados para esta clínica (esperado: 9): ${noms.length}`);

        // Limpiar para no ensuciar la base de datos de producción
        await userDb.query("DELETE FROM prestador_obra_social WHERE prestador_id = ?", [newPrestadorId]);
        await userDb.query("DELETE FROM prestador_nomenclador WHERE prestador_id = ?", [newPrestadorId]);
        await userDb.query("DELETE FROM prestador WHERE id = ?", [newPrestadorId]);
        console.log("Datos de prueba limpiados correctamente.");

        console.log("=== PRUEBA COMPLETADA EXITOSAMENTE ===");

    } catch (err) {
        console.error("Error en la prueba:", err);
    } finally {
        process.exit(0);
    }
}

test();
