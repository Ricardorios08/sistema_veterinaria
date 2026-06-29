const express = require('express');
const router  = express.Router();
const userDb  = require('../db/userDb');
const mevepDb = require('../db/mevepDb');
const { logAction } = require('../utils/logger');
const jwt = require('jsonwebtoken');
const JWT_SECRET = process.env.JWT_SECRET || 'fallback_secret';

// ─── Middleware JWT ──────────────────────────────────────────────────────────
const authenticateToken = (req, res, next) => {
    const token = req.headers['authorization']?.split(' ')[1];
    if (!token) return res.status(401).json({ error: 'Token no proporcionado' });
    jwt.verify(token, JWT_SECRET, (err, user) => {
        if (err) return res.status(403).json({ error: 'Token inválido o expirado' });
        req.user = user;
        next();
    });
};

// Roles con acceso completo al módulo de pagos
const isAdminOrCobrador = (req, res, next) => {
    const allowed = ['admin', 'superadmin', 'cobrador'];
    if (req.user && allowed.includes(req.user.rol)) return next();
    return res.status(403).json({ error: 'Acceso denegado: se requiere rol admin o cobrador' });
};

// Solo administradores (generar cuotas masivo)
const isAdminOnly = (req, res, next) => {
    const allowed = ['admin', 'superadmin'];
    if (req.user && allowed.includes(req.user.rol)) return next();
    return res.status(403).json({ error: 'Acceso denegado: se requiere rol administrador' });
};

// ─── Helper: próximo nro_boleta ─────────────────────────────────────────────
async function getNextNroBoleta() {
    const rows = await userDb.query('SELECT MAX(CAST(nro_boleta AS UNSIGNED)) AS max_boleta FROM pago');
    const max = rows[0]?.max_boleta || 0;
    return String(Number(max) + 1).padStart(8, '0');
}

// ─── Mapas mes ───────────────────────────────────────────────────────────────
const MES_NUM_TO_NOMBRE = {
    '01': 'ENERO', '02': 'FEBRERO', '03': 'MARZO', '04': 'ABRIL',
    '05': 'MAYO', '06': 'JUNIO', '07': 'JULIO', '08': 'AGOSTO',
    '09': 'SEPTIEMBRE', '10': 'OCTUBRE', '11': 'NOVIEMBRE', '12': 'DICIEMBRE'
};

// ─────────────────────────────────────────────────────────────────────────────
// POST /api/pagos/generar-cuotas
// Genera cuotas del mes para todos los socios activos (rol admin)
// Igual a generar_cuota.php del legacy
// ─────────────────────────────────────────────────────────────────────────────
router.post('/generar-cuotas', authenticateToken, isAdminOnly, async (req, res) => {
    try {
        const { mes, anio } = req.body;  // mes: '01'-'12', anio: 2026
        if (!mes || !anio) return res.status(400).json({ error: 'Mes y año son obligatorios' });
        if (!/^\d{2}$/.test(mes) || !/^\d{4}$/.test(String(anio))) {
            return res.status(400).json({ error: 'Formato inválido: mes(2 dígitos), anio(4 dígitos)' });
        }

        // Verificar que no se hayan generado ya las cuotas de ese mes/año
        const existentes = await userDb.query(
            "SELECT COUNT(*) AS cant FROM pago WHERE mes = ? AND anio = ? AND tipo_creacion = 0",
            [mes, parseInt(anio)]
        );
        if (existentes[0].cant > 0) {
            return res.status(409).json({
                error: `Ya se generaron ${existentes[0].cant} cuotas para ${MES_NUM_TO_NOMBRE[mes]}/${anio}`
            });
        }

        // Obtener todos los socios activos que deban imprimirse (no_imprimir != 'VERDADERO')
        const socios = await userDb.query(
            `SELECT id, cod_mevep, apellido, nombre, importe_cuota, ruta, cobrador
             FROM socio 
             WHERE FechaBaja IS NULL AND (no_imprimir IS NULL OR no_imprimir != 'VERDADERO')
             ORDER BY apellido ASC, nombre ASC`
        );

        const hoy = new Date().toISOString().split('T')[0];
        let generados = 0;
        let omitidos = 0;

        for (const socio of socios) {
            // Verificar si ya tiene cuota para ese mes/año (por si existe manual previa)
            const dup = await userDb.query(
                'SELECT id FROM pago WHERE socio_id = ? AND mes = ? AND anio = ?',
                [socio.id, mes, parseInt(anio)]
            );
            if (dup.length > 0) { omitidos++; continue; }

            const nroBoleta = await getNextNroBoleta();
            await userDb.query(
                `INSERT INTO pago (socio_id, cod_mevep, mes, anio, importe, cobrador, estado,
                 nro_boleta, fecha_generacion, tipo_creacion, CreacionUsuario, ruta)
                 VALUES (?, ?, ?, ?, ?, ?, 'PENDIENTE', ?, ?, 0, ?, ?)`,
                [
                    socio.id,
                    socio.cod_mevep || null,
                    mes,
                    parseInt(anio),
                    parseFloat(socio.importe_cuota || 0),
                    socio.cobrador || null,   // Pre-assign the collector of this partner
                    nroBoleta,
                    hoy,
                    req.user.nombre_usuario,
                    socio.ruta || null         // Save current route
                ]
            );
            generados++;
        }

        logAction(req.user.nombre_usuario, 'PAGOS_GENERAR_CUOTAS',
            `Generadas ${generados} cuotas para ${MES_NUM_TO_NOMBRE[mes]}/${anio} (${omitidos} omitidas)`, req);

        res.json({
            message: `Cuotas generadas correctamente`,
            generados,
            omitidos,
            mes: MES_NUM_TO_NOMBRE[mes],
            anio
        });
    } catch (err) {
        console.error('[pagos/generar-cuotas]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────────────────────────────────
// POST /api/pagos/registrar-barra
// Registra un pago escaneando el código de barras EAN-13
// Lógica idéntica a guardar.php del legacy:
//   cod_socio = substr(0,5), mes = substr(5,2), anio2 = substr(7,2), cobrador = substr(9,2)
// ─────────────────────────────────────────────────────────────────────────────
router.post('/registrar-barra', authenticateToken, isAdminOrCobrador, async (req, res) => {
    try {
        const { cod_barra, fecha_pago, metodo_pago = 'EFECTIVO' } = req.body;
        if (!cod_barra || !fecha_pago) {
            return res.status(400).json({ error: 'Código de barras y fecha de pago son obligatorios' });
        }

        // Descomponer el código como en el legacy
        const barraStr   = cod_barra.replace(/\D/g, ''); // solo dígitos
        const cod_mevep  = barraStr.substring(0, 5);
        const mes        = barraStr.substring(5, 7);
        const anio2      = barraStr.substring(7, 9);
        const cobrador   = barraStr.substring(9, 11);
        const anioFull   = '20' + anio2;

        // Buscar socio por cod_mevep en la nueva DB
        const socios = await userDb.query(
            'SELECT id, apellido, nombre, importe_cuota FROM socio WHERE cod_mevep = ? AND FechaBaja IS NULL',
            [parseInt(cod_mevep)]
        );
        if (socios.length === 0) {
            return res.status(404).json({
                result: 'INEXISTENTE',
                message: `Código de barras inexistente (cod_mevep: ${cod_mevep})`
            });
        }
        const socio = socios[0];

        // Buscar el pago pendiente en la nueva DB
        const pagos = await userDb.query(
            `SELECT id, estado, importe FROM pago
             WHERE socio_id = ? AND mes = ? AND anio = ?`,
            [socio.id, mes, parseInt(anioFull)]
        );

        if (pagos.length === 0) {
            return res.status(404).json({
                result: 'INEXISTENTE',
                message: `No se encontró cuota para ${socio.apellido}, ${socio.nombre} — ${MES_NUM_TO_NOMBRE[mes]}/${anioFull}`
            });
        }

        const pago = pagos[0];
        if (pago.estado === 'PAGADO') {
            return res.status(409).json({
                result: 'YA_PAGADO',
                message: `Ya se registró el pago de ${socio.apellido}, ${socio.nombre} — ${MES_NUM_TO_NOMBRE[mes]}/${anioFull}`
            });
        }

        // Actualizar a PAGADO
        await userDb.query(
            `UPDATE pago SET estado = 'PAGADO', fecha_pago = ?, cobrador = ?, metodo_pago = ?,
             ModificacionUsuario = ? WHERE id = ?`,
            [fecha_pago, cobrador, metodo_pago, req.user.nombre_usuario, pago.id]
        );

        logAction(req.user.nombre_usuario, 'PAGO_REGISTRAR_BARRA',
            `Pago registrado: ${socio.apellido} ${socio.nombre} — ${MES_NUM_TO_NOMBRE[mes]}/${anioFull} — $${pago.importe}`, req);

        res.json({
            result: 'ACEPTADO',
            message: `Pago aceptado: ${socio.apellido}, ${socio.nombre}`,
            socio: { id: socio.id, apellido: socio.apellido, nombre: socio.nombre },
            mes: MES_NUM_TO_NOMBRE[mes],
            anio: anioFull,
            importe: pago.importe,
            fecha_pago,
            metodo_pago
        });
    } catch (err) {
        console.error('[pagos/registrar-barra]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────────────────────────────────
// POST /api/pagos/pago-manual
// Pago manual sin lector de barras (admin o cobrador)
// ─────────────────────────────────────────────────────────────────────────────
router.post('/pago-manual', authenticateToken, isAdminOrCobrador, async (req, res) => {
    try {
        const { socio_id, mes, anio, importe, metodo_pago = 'EFECTIVO', observaciones, fecha_pago } = req.body;
        if (!socio_id || !mes || !anio) {
            return res.status(400).json({ error: 'socio_id, mes y anio son obligatorios' });
        }

        const socios = await userDb.query(
            'SELECT id, apellido, nombre, importe_cuota FROM socio WHERE id = ? AND FechaBaja IS NULL',
            [socio_id]
        );
        if (socios.length === 0) return res.status(404).json({ error: 'Socio no encontrado' });
        const socio = socios[0];

        // Verificar si ya existe pago
        const dup = await userDb.query(
            'SELECT id, estado FROM pago WHERE socio_id = ? AND mes = ? AND anio = ?',
            [socio_id, mes, parseInt(anio)]
        );

        const fechaPagoFinal = fecha_pago || new Date().toISOString().split('T')[0];
        const importeFinal   = parseFloat(importe || socio.importe_cuota || 0);
        const cobrador       = req.user.cod_cobrador || String(req.user.id);

        if (dup.length > 0) {
            // Ya existe: actualizar a PAGADO si estaba pendiente
            if (dup[0].estado === 'PAGADO') {
                return res.status(409).json({ error: `La cuota de ${MES_NUM_TO_NOMBRE[mes]}/${anio} ya está pagada` });
            }
            await userDb.query(
                `UPDATE pago SET estado = 'PAGADO', fecha_pago = ?, cobrador = ?, importe = ?,
                 metodo_pago = ?, observaciones = ?, tipo_creacion = 1, ModificacionUsuario = ? WHERE id = ?`,
                [fechaPagoFinal, cobrador, importeFinal, metodo_pago, observaciones || null, req.user.nombre_usuario, dup[0].id]
            );
        } else {
            // Crear nueva cuota directamente pagada
            const nroBoleta = await getNextNroBoleta();
            const hoy = new Date().toISOString().split('T')[0];
            await userDb.query(
                `INSERT INTO pago (socio_id, cod_mevep, mes, anio, importe, cobrador, metodo_pago,
                 estado, nro_boleta, observaciones, fecha_generacion, fecha_pago, tipo_creacion, CreacionUsuario)
                 VALUES (?, ?, ?, ?, ?, ?, ?, 'PAGADO', ?, ?, ?, ?, 1, ?)`,
                [
                    socio_id, socio.cod_mevep || null, mes, parseInt(anio),
                    importeFinal, cobrador, metodo_pago, nroBoleta,
                    observaciones || null, hoy, fechaPagoFinal, req.user.nombre_usuario
                ]
            );
        }

        logAction(req.user.nombre_usuario, 'PAGO_MANUAL',
            `Pago manual: ${socio.apellido} ${socio.nombre} — ${MES_NUM_TO_NOMBRE[mes]}/${anio} — $${importeFinal} (${metodo_pago})`, req);

        res.json({
            message: 'Pago registrado correctamente',
            socio: `${socio.apellido}, ${socio.nombre}`,
            mes: MES_NUM_TO_NOMBRE[mes],
            anio,
            importe: importeFinal,
            metodo_pago
        });
    } catch (err) {
        console.error('[pagos/pago-manual]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────────────────────────────────
// GET /api/pagos/consulta
// Consulta flexible: por socio, por cobrador+mes+año, por nro_boleta
// ─────────────────────────────────────────────────────────────────────────────
router.get('/consulta', authenticateToken, isAdminOrCobrador, async (req, res) => {
    try {
        const { socio_id, mes, anio, nro_boleta, estado, cobrador } = req.query;

        let where = [];
        let params = [];

        if (socio_id)   { where.push('p.socio_id = ?');  params.push(parseInt(socio_id)); }
        if (mes)        { where.push('p.mes = ?');        params.push(mes); }
        if (anio)       { where.push('p.anio = ?');       params.push(parseInt(anio)); }
        if (nro_boleta) { where.push('p.nro_boleta = ?'); params.push(nro_boleta); }
        if (estado)     { where.push('p.estado = ?');     params.push(estado.toUpperCase()); }
        if (cobrador)   { where.push('p.cobrador = ?');   params.push(cobrador); }

        // Si el usuario es cobrador, filtrar por su código de cobrador automáticamente
        if (req.user.rol === 'cobrador') {
            where.push('p.cobrador = ?');
            params.push(req.user.cod_cobrador || '');
        }

        if (where.length === 0) {
            return res.status(400).json({ error: 'Se requiere al menos un filtro (socio_id, mes+anio, nro_boleta)' });
        }

        const rows = await userDb.query(
            `SELECT p.*, s.apellido, s.nombre, s.domicilio, s.departamento, s.telefono, s.celular
             FROM pago p
             JOIN socio s ON s.id = p.socio_id
             WHERE ${where.join(' AND ')}
             ORDER BY p.anio DESC, p.mes DESC, s.apellido ASC`,
            params
        );

        const data = rows.map(r => ({
            id:              r.id,
            nro_boleta:      r.nro_boleta,
            socio_id:        r.socio_id,
            apellido:        r.apellido,
            nombre:          r.nombre,
            domicilio:       r.domicilio,
            departamento:    r.departamento,
            telefono:        r.telefono,
            mes:             r.mes,
            mes_nombre:      MES_NUM_TO_NOMBRE[r.mes] || r.mes,
            anio:            r.anio,
            importe:         parseFloat(r.importe || 0),
            cobrador:        r.cobrador,
            metodo_pago:     r.metodo_pago,
            estado:          r.estado,
            fecha_generacion: r.fecha_generacion,
            fecha_pago:      r.fecha_pago,
        }));

        res.json(data);
    } catch (err) {
        console.error('[pagos/consulta]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────────────────────────────────
// GET /api/pagos/ultimos
// Últimos pagos registrados (para dashboard en pantalla de cobrador)
// ─────────────────────────────────────────────────────────────────────────────
router.get('/ultimos', authenticateToken, isAdminOrCobrador, async (req, res) => {
    try {
        const { limit = 20, fecha } = req.query;
        const fechaFiltro = fecha || new Date().toISOString().split('T')[0];

        const rows = await userDb.query(
            `SELECT p.id, p.nro_boleta, p.mes, p.anio, p.importe, p.cobrador,
                    p.metodo_pago, p.estado, p.fecha_pago, p.FechaCreacion,
                    s.apellido, s.nombre
             FROM pago p
             JOIN socio s ON s.id = p.socio_id
             WHERE p.estado = 'PAGADO' AND DATE(p.FechaCreacion) = ?
             ORDER BY p.FechaCreacion DESC
             LIMIT ?`,
            [fechaFiltro, parseInt(limit)]
        );

        const data = rows.map(r => ({
            id:          r.id,
            nro_boleta:  r.nro_boleta,
            socio:       `${r.apellido}, ${r.nombre}`,
            mes_nombre:  MES_NUM_TO_NOMBRE[r.mes] || r.mes,
            anio:        r.anio,
            importe:     parseFloat(r.importe || 0),
            metodo_pago: r.metodo_pago,
            cobrador:    r.cobrador,
            fecha_pago:  r.fecha_pago,
            hora:        r.FechaCreacion,
        }));

        res.json(data);
    } catch (err) {
        console.error('[pagos/ultimos]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// GET /api/pagos/resumen-cobrador
// Socios de un cobrador para el cobro en campo
// ─────────────────────────────────────────────────────────────────────────────
router.get('/resumen-cobrador', authenticateToken, isAdminOrCobrador, async (req, res) => {
    try {
        const { mes, anio, search = '' } = req.query;
        if (!mes || !anio) return res.status(400).json({ error: 'Mes y año son obligatorios' });

        let whereExtra = '';
        const params = [mes, parseInt(anio)];

        // Filter by logged-in cobrador code if role is cobrador
        if (req.user.rol === 'cobrador') {
            whereExtra += ' AND p.cobrador = ?';
            params.push(req.user.cod_cobrador || '');
        }

        if (search.trim()) {
            whereExtra += ` AND (s.apellido LIKE ? OR s.nombre LIKE ? OR s.domicilio LIKE ? OR CAST(s.cod_mevep AS CHAR) LIKE ?)`;
            const q = `%${search.trim()}%`;
            params.push(q, q, q, q);
        }

        const rows = await userDb.query(
            `SELECT p.id, p.nro_boleta, p.mes, p.anio, p.importe, p.estado,
                    p.fecha_pago, p.metodo_pago, p.ruta, p.cobrador,
                    s.id AS socio_id, s.apellido, s.nombre, s.domicilio,
                    s.departamento, s.telefono, s.celular, s.cod_mevep
             FROM pago p
             JOIN socio s ON s.id = p.socio_id
             WHERE p.mes = ? AND p.anio = ? ${whereExtra}
             ORDER BY CAST(p.ruta AS UNSIGNED) ASC, s.apellido ASC, s.nombre ASC`,
            params
        );

        const data = rows.map(r => ({
            pago_id:     r.id,
            nro_boleta:  r.nro_boleta,
            mes_nombre:  MES_NUM_TO_NOMBRE[r.mes] || r.mes,
            anio:        r.anio,
            importe:     parseFloat(r.importe || 0),
            estado:      r.estado,
            fecha_pago:  r.fecha_pago,
            metodo_pago: r.metodo_pago,
            ruta:        r.ruta,
            cobrador:    r.cobrador,
            socio_id:    r.socio_id,
            cod_mevep:   r.cod_mevep,
            apellido:    r.apellido,
            nombre:      r.nombre,
            domicilio:   r.domicilio,
            departamento: r.departamento,
            telefono:    r.telefono,
            celular:     r.celular,
        }));

        res.json(data);
    } catch (err) {
        console.error('[pagos/resumen-cobrador]', err.message);
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
