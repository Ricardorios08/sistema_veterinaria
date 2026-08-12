const mevepDb = require('../db/mevepDb');

async function run() {
    try {
        // La tabla "pagos" tiene 296K registros - esa es la principal
        // Veamos su estructura y datos recientes
        console.log("=== DESCRIBE pagos (tabla principal) ===");
        const desc = await mevepDb.query("DESCRIBE pagos");
        desc.forEach(c => console.log(`  ${c.Field} | ${c.Type}`));

        // Últimos pagos PAGADOS
        console.log("\n=== Últimos pagos PAGADOS en 'pagos' ===");
        const ultimos = await mevepDb.query(
            "SELECT cod_socio, mes, anio, importe, cobrador, estado, fecha_pago, nro_boleta, ruta FROM pagos WHERE estado = 'PAGADO' ORDER BY fecha_pago DESC, nro_boleta DESC LIMIT 10"
        );
        console.table(ultimos.map(p => ({
            cod_socio: p.cod_socio,
            mes: p.mes, anio: p.anio,
            importe: p.importe?.toString(),
            estado: p.estado,
            fecha_pago: p.fecha_pago?.toString?.() ?? String(p.fecha_pago),
            ruta: p.ruta, cobrador: p.cobrador
        })));

        // Buscar un socio que tenga pagos en la tabla principal
        console.log("\n=== Socio con más pagos en 'pagos' ===");
        const topSocio = await mevepDb.query(
            "SELECT cod_socio, COUNT(*) as total FROM pagos GROUP BY cod_socio ORDER BY total DESC LIMIT 5"
        );
        console.table(topSocio.map(r => ({ cod_socio: r.cod_socio, total: r.total?.toString() })));

        // Ver pagos del socio más activo
        const codSocio = topSocio[0]?.cod_socio;
        console.log(`\n=== Pagos del socio ${codSocio} (últimos 18 meses) ===`);
        const pagosSocio = await mevepDb.query(
            "SELECT mes, anio, importe, estado, fecha_pago FROM pagos WHERE cod_socio = ? ORDER BY anio DESC, mes DESC LIMIT 18",
            [codSocio]
        );
        console.table(pagosSocio.map(p => ({
            mes: p.mes, anio: p.anio,
            importe: p.importe?.toString(),
            estado: p.estado,
            fecha_pago: p.fecha_pago?.toString?.() ?? String(p.fecha_pago)
        })));

        // Ver datos de ese socio en tabla socios del sistema nuevo
        console.log(`\n=== Datos del socio ${codSocio} en tabla MEVEP socios ===`);
        const socioData = await mevepDb.query(
            "SELECT cod_socio, apellido, nombre, deuda, importe_cuota, importe_deuda, ruta, cobrador FROM socios WHERE cod_socio = ?",
            [codSocio]
        );
        if (socioData[0]) {
            const s = socioData[0];
            console.log({
                cod_socio: s.cod_socio,
                apellido: s.apellido,
                nombre: s.nombre,
                deuda: s.deuda?.toString(),
                importe_cuota: s.importe_cuota?.toString(),
                importe_deuda: s.importe_deuda?.toString(),
                ruta: s.ruta,
                cobrador: s.cobrador
            });
        }

        // Ver los distintos estados en pagos
        console.log("\n=== Estados distintos en pagos ===");
        const estados = await mevepDb.query(
            "SELECT estado, COUNT(*) as total FROM pagos GROUP BY estado"
        );
        console.table(estados.map(e => ({ estado: e.estado, total: e.total?.toString() })));

        // Ver cuántos socios en el sistema nuevo tienen cod_socio en la tabla mevep.socios
        console.log("\n=== Total socios en mevep.socios ===");
        const totalMevep = await mevepDb.query("SELECT COUNT(*) as total FROM socios");
        console.log("Total:", totalMevep[0]?.total?.toString());

    } catch (err) {
        console.error("Error:", err.message, err.stack);
    } finally {
        process.exit(0);
    }
}

run();
