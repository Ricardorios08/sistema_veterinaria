const mevepDb = require('../db/mevepDb');

async function run() {
    try {
        // Todas las tablas
        const tables = await mevepDb.query('SHOW TABLES');
        const names = tables.map(r => Object.values(r)[0]);
        console.log('=== TABLAS EN MEVEP ===');
        console.log(names.join('\n'));

        // Buscar tabla de particulares/clientes
        const posibles = names.filter(n => n.toLowerCase().includes('partic') || n.toLowerCase().includes('client') || n.toLowerCase().includes('dueno') || n.toLowerCase().includes('propietario'));
        if (posibles.length > 0) {
            for (const t of posibles) {
                console.log(`\n=== DESCRIBE ${t} ===`);
                const cols = await mevepDb.query(`DESCRIBE \`${t}\``);
                console.table(cols.map(c => ({ Field: c.Field, Type: c.Type })));
                const cnt = await mevepDb.query(`SELECT COUNT(*) as t FROM \`${t}\``);
                console.log('Registros:', cnt[0].t);
                const sample = await mevepDb.query(`SELECT * FROM \`${t}\` LIMIT 3`);
                console.log(JSON.stringify(sample, null, 2));
            }
        } else {
            console.log('\n⚠ No hay tabla de particulares/clientes en MEVEP');
            
            // Ver qué es el cod_socio en animal_particular — puede referenciar a socios o a otra tabla
            console.log('\n=== Análisis cod_socio en animal_particular ===');
            const apSample = await mevepDb.query('SELECT DISTINCT cod_socio FROM animal_particular ORDER BY cod_socio LIMIT 10');
            console.log('Primeros cod_socio:', apSample.map(r => r.cod_socio).join(', '));
            
            // Verificar si esos cod_socio existen en socios
            const socioCheck = await mevepDb.query(
                'SELECT COUNT(*) as t FROM animal_particular ap WHERE EXISTS (SELECT 1 FROM socios s WHERE s.cod_socio = ap.cod_socio)'
            );
            const total = await mevepDb.query('SELECT COUNT(*) as t FROM animal_particular');
            console.log(`\nDe ${total[0].t} animal_particular:`);
            console.log(`  - ${socioCheck[0].t} tienen cod_socio que existe en socios`);
            console.log(`  - ${total[0].t - socioCheck[0].t} tienen cod_socio SIN socio registrado`);
        }
    } catch (err) {
        console.error('ERROR:', err.message);
    } finally {
        process.exit(0);
    }
}
run();
