const userDb = require('./db/userDb');

async function verify() {
    try {
        console.log("=== VERIFICANDO RESULTADO DE LA MIGRACIÓN ===");

        const os = await userDb.query("SELECT * FROM obra_social");
        console.log(`\nObras Sociales en catálogo global (esperado: 1): ${os.length}`);
        console.log(os);

        const pos = await userDb.query("SELECT * FROM prestador_obra_social");
        console.log(`\nRelaciones prestador-obra (esperado: 5): ${pos.length}`);
        console.log(pos.map(r => `Prestador ID ${r.prestador_id} -> Obra ID ${r.obra_social_id}`));

        const nom = await userDb.query("SELECT * FROM nomenclador");
        console.log(`\nNomencladores en catálogo global (esperado: 9): ${nom.length}`);
        console.log(nom.map(n => `${n.codigo}: ${n.nombre}`));

        const pnom = await userDb.query("SELECT * FROM prestador_nomenclador");
        console.log(`\nRelaciones prestador-nomenclador (esperado: 45): ${pnom.length}`);
        console.log(`Total relaciones: ${pnom.length}`);

        const pacientes = await userDb.query("SELECT id, nombre, obra_social_id FROM paciente");
        console.log("\nPacientes y sus nuevas obras sociales:");
        console.log(pacientes);

    } catch (err) {
        console.error(err);
    } finally {
        process.exit(0);
    }
}

verify();
