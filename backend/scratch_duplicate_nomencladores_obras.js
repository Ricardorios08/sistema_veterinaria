const userDb = require('./db/userDb');

async function duplicate() {
    try {
        console.log("=== INICIANDO DUPLICACIÓN DE NOMENCLADORES Y OBRAS SOCIALES ===");
        
        // 1. Obtener todos los prestadores
        const prestadores = await userDb.query("SELECT * FROM prestador WHERE FechaBaja IS NULL");
        console.log(`Se encontraron ${prestadores.length} prestadores activos.`);
        
        // 2. Obtener nomencladores del prestador base (ID = 1)
        const nomencladoresBase = await userDb.query(
            "SELECT * FROM nomenclador WHERE prestador_id = 1 AND FechaBaja IS NULL"
        );
        console.log(`Nomencladores base (ID=1) a duplicar: ${nomencladoresBase.length}`);
        
        // 3. Obtener obras sociales del prestador base (ID = 1)
        const obrasBase = await userDb.query(
            "SELECT * FROM obra_social WHERE prestador_id = 1 AND FechaBaja IS NULL"
        );
        console.log(`Obras sociales base (ID=1) a duplicar: ${obrasBase.length}`);
        
        // 4. Recorrer cada prestador distinto de 1 y duplicar los datos
        for (const p of prestadores) {
            if (p.id === 1) continue;
            console.log(`\nProcesando Prestador ID: ${p.id} (${p.nombre})...`);
            
            // Duplicar nomencladores
            let nomencladoresInsertados = 0;
            for (const nom of nomencladoresBase) {
                // Verificar si ya existe el código para este prestador
                const existing = await userDb.query(
                    "SELECT id FROM nomenclador WHERE codigo = ? AND prestador_id = ? AND FechaBaja IS NULL",
                    [nom.codigo, p.id]
                );
                
                if (existing.length === 0) {
                    await userDb.query(
                        `INSERT INTO nomenclador 
                        (codigo, nombre, descripcion, precio, prestador_id, CreacionUsuario, FechaCreacion) 
                        VALUES (?, ?, ?, ?, ?, ?, NOW())`,
                        [nom.codigo, nom.nombre, nom.descripcion, nom.precio, p.id, 'SYSTEM_DUPLICATION']
                    );
                    nomencladoresInsertados++;
                }
            }
            console.log(`-> Nomencladores insertados: ${nomencladoresInsertados}`);
            
            // Duplicar obras sociales
            let obrasInsertadas = 0;
            for (const os of obrasBase) {
                // Verificar si ya existe la obra social por nombre para este prestador
                const existing = await userDb.query(
                    "SELECT id FROM obra_social WHERE nombre = ? AND prestador_id = ? AND FechaBaja IS NULL",
                    [os.nombre, p.id]
                );
                
                if (existing.length === 0) {
                    await userDb.query(
                        `INSERT INTO obra_social 
                        (nombre, sigla, descripcion, prestador_id, CreacionUsuario, FechaCreacion) 
                        VALUES (?, ?, ?, ?, ?, NOW())`,
                        [os.nombre, os.sigla, os.descripcion, p.id, 'SYSTEM_DUPLICATION']
                    );
                    obrasInsertadas++;
                }
            }
            console.log(`-> Obras sociales insertadas: ${obrasInsertadas}`);
        }
        
        console.log("\n=== PROCESO COMPLETADO CON ÉXITO ===");
    } catch (err) {
        console.error("Error durante el proceso de duplicación:", err);
    } finally {
        process.exit(0);
    }
}

duplicate();
