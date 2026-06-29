const mevepDb = require('./db/mevepDb');

async function run() {
    try {
        // 1. Muestra de pagos actuales (tabla pagos8 - posiblemente la más reciente)
        console.log("=== MUESTRA pagos8 (últimos pagos) ===");
        const pagos = await mevepDb.query(
            "SELECT * FROM pagos8 ORDER BY nro_boleta DESC LIMIT 10"
        );
        console.table(pagos.map(p => ({
            cod_socio: p.cod_socio,
            mes: p.mes,
            anio: p.anio,
            importe: p.importe?.toString(),
            cobrador: p.cobrador,
            estado: p.estado,
            fecha_pago: p.fecha_pago?.toString?.() ?? p.fecha_pago,
            nro_boleta: p.nro_boleta?.toString(),
            ruta: p.ruta
        })));

        // 2. Ver qué tablas pagos existen (pagos1..pagos9)
        const tables = await mevepDb.query("SHOW TABLES LIKE 'pagos%'");
        const pagosTables = tables.map(t => Object.values(t)[0]);
        console.log("\n=== Tablas de pagos disponibles ===");
        for (const tbl of pagosTables) {
            const count = await mevepDb.query(`SELECT COUNT(*) as total FROM \`${tbl}\``);
            console.log(`  ${tbl}: ${count[0].total} registros`);
        }

        // 3. Ver cuánta deuda tiene un socio específico
        console.log("\n=== Socio de muestra (cod_socio = 1) en tabla socios ===");
        const socioSample = await mevepDb.query(
            "SELECT cod_socio, apellido, nombre, deuda, importe_cuota, importe_deuda, ruta, cobrador, no_imprimir FROM socios WHERE cod_socio = 1"
        );
        console.log(socioSample[0]);

        // 4. Ver pagos del socio 1 en pagos8
        console.log("\n=== Pagos del socio cod_socio=1 en pagos8 ===");
        const pagosSocio = await mevepDb.query(
            "SELECT mes, anio, importe, estado, fecha_pago FROM pagos8 WHERE cod_socio = 1 ORDER BY anio DESC, mes DESC LIMIT 12"
        );
        console.table(pagosSocio.map(p => ({
            mes: p.mes,
            anio: p.anio,
            importe: p.importe?.toString(),
            estado: p.estado,
            fecha_pago: p.fecha_pago?.toString?.() ?? p.fecha_pago,
        })));

        // 5. Ver la tabla de rutas
        const rutasCheck = await mevepDb.query("SHOW TABLES LIKE 'ruta%'");
        console.log("\n=== Tablas de rutas ===", rutasCheck.map(t => Object.values(t)[0]));

        // 6. Ver el campo cobrador y los distintos valores
        console.log("\n=== Cobradores distintos en socios ===");
        const cobradores = await mevepDb.query(
            "SELECT DISTINCT cobrador, COUNT(*) as cantidad FROM socios GROUP BY cobrador ORDER BY cobrador"
        );
        console.table(cobradores.map(c => ({ cobrador: c.cobrador, cantidad: c.cantidad?.toString() })));

    } catch (err) {
        console.error("Error:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
