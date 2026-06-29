const express = require('express');
const router = express.Router();
const userDb = require('../db/userDb');
const mevepDb = require('../db/mevepDb');
const { logAction } = require('../utils/logger');

// Middleware JWT reutilizado del auth
const jwt = require('jsonwebtoken');
const JWT_SECRET = process.env.JWT_SECRET || 'fallback_secret';

const authenticateToken = (req, res, next) => {
    const token = req.headers['authorization']?.split(' ')[1];
    if (!token) return res.status(401).json({ error: 'Token no proporcionado' });
    jwt.verify(token, JWT_SECRET, (err, user) => {
        if (err) return res.status(403).json({ error: 'Token inválido o expirado' });
        req.user = user;
        next();
    });
};

// ─────────────────────────────────────────────────
// GET /api/socios  — listado con búsqueda y paginación
// ─────────────────────────────────────────────────
router.get('/', authenticateToken, async (req, res) => {
    try {
        const { search = '', page = 1, limit = 50 } = req.query;
        const offset = (parseInt(page) - 1) * parseInt(limit);

        let where = 'WHERE s.FechaBaja IS NULL';
        const params = [];

        if (search.trim()) {
            where += ' AND (s.apellido LIKE ? OR s.nombre LIKE ? OR s.documento LIKE ? OR s.telefono LIKE ? OR s.celular LIKE ?)';
            const q = `%${search.trim()}%`;
            params.push(q, q, q, q, q);
        }

        const countResult = await userDb.query(
            `SELECT COUNT(*) as total FROM socio s ${where}`, params
        );
        const total = countResult[0].total;

        const rows = await userDb.query(
            `SELECT s.id, s.cod_mevep, s.apellido, s.nombre, s.tipo_doc, s.documento,
                    s.telefono, s.celular, s.domicilio, s.localidad, s.departamento,
                    s.mail, s.sexo, s.fecha_ingreso, s.importe_cuota, s.observaciones,
                    s.prestador_id, s.ruta, s.cobrador, s.no_imprimir,
                    (SELECT COUNT(*) FROM mascota m WHERE m.socio_id = s.id AND m.FechaBaja IS NULL) as cant_mascotas
             FROM socio s ${where}
             ORDER BY s.apellido ASC, s.nombre ASC
             LIMIT ? OFFSET ?`,
            [...params, parseInt(limit), offset]
        );

        res.json({ total: Number(total), page: parseInt(page), data: rows });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/socios/:id  — detalle + mascotas
// ─────────────────────────────────────────────────
router.get('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const socios = await userDb.query(
            'SELECT * FROM socio WHERE id = ? AND FechaBaja IS NULL', [id]
        );
        if (socios.length === 0) return res.status(404).json({ error: 'Socio no encontrado' });

        const mascotas = await userDb.query(
            `SELECT id, nombre, especie, raza, pelaje, tamanio, color, sexo, fecha_nac, origen
             FROM mascota WHERE socio_id = ? AND FechaBaja IS NULL ORDER BY nombre ASC`,
            [id]
        );

        res.json({ ...socios[0], mascotas });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// POST /api/socios  — crear socio
// ─────────────────────────────────────────────────
router.post('/', authenticateToken, async (req, res) => {
    try {
        const { apellido, nombre, tipo_doc, documento, telefono, celular,
                domicilio, localidad, departamento, cod_postal, mail,
                sexo, fecha_ingreso, importe_cuota, observaciones,
                ruta, cobrador, no_imprimir } = req.body;

        if (!apellido || !nombre) {
            return res.status(400).json({ error: 'Apellido y nombre son obligatorios' });
        }

        const result = await userDb.query(
            `INSERT INTO socio 
             (apellido, nombre, tipo_doc, documento, telefono, celular, domicilio,
              localidad, departamento, cod_postal, mail, sexo, fecha_ingreso,
              importe_cuota, observaciones, prestador_id, CreacionUsuario, FechaCreacion,
              ruta, cobrador, no_imprimir)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?)`,
            [apellido.trim(), nombre.trim(), tipo_doc || 'D.N.I', documento || null,
             telefono || null, celular || null, domicilio || null, localidad || null,
             departamento || null, cod_postal || null, mail || null, sexo || null,
             fecha_ingreso || null, parseFloat(importe_cuota) || 0, observaciones || null,
             req.user.prestador_id || 1, req.user.nombre_usuario,
             ruta ? parseInt(ruta) : null, cobrador || null, no_imprimir || 'FALSO']
        );

        logAction(req.user.nombre_usuario, 'SOCIO_CREATE', `Nuevo socio: ${apellido} ${nombre}`, req);
        res.json({ message: 'OK', id: Number(result.insertId) });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// PUT /api/socios/:id  — editar socio
// ─────────────────────────────────────────────────
router.put('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const { apellido, nombre, tipo_doc, documento, telefono, celular,
                domicilio, localidad, departamento, cod_postal, mail,
                sexo, fecha_ingreso, importe_cuota, observaciones,
                ruta, cobrador, no_imprimir } = req.body;

        await userDb.query(
            `UPDATE socio SET
             apellido=?, nombre=?, tipo_doc=?, documento=?, telefono=?, celular=?,
             domicilio=?, localidad=?, departamento=?, cod_postal=?, mail=?, sexo=?,
             fecha_ingreso=?, importe_cuota=?, observaciones=?,
             ruta=?, cobrador=?, no_imprimir=?,
             ModificacionUsuario=?, FechaModificacion=NOW()
             WHERE id=? AND FechaBaja IS NULL`,
            [apellido?.trim(), nombre?.trim(), tipo_doc || 'D.N.I', documento || null,
             telefono || null, celular || null, domicilio || null, localidad || null,
             departamento || null, cod_postal || null, mail || null, sexo || null,
             fecha_ingreso || null, parseFloat(importe_cuota) || 0, observaciones || null,
             ruta ? parseInt(ruta) : null, cobrador || null, no_imprimir || 'FALSO',
             req.user.nombre_usuario, id]
        );

        logAction(req.user.nombre_usuario, 'SOCIO_UPDATE', `Socio ID ${id} modificado`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// DELETE /api/socios/:id  — baja lógica
// ─────────────────────────────────────────────────
router.delete('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        await userDb.query(
            'UPDATE socio SET FechaBaja=NOW(), BajaUsuario=? WHERE id=?',
            [req.user.nombre_usuario, id]
        );
        logAction(req.user.nombre_usuario, 'SOCIO_DELETE', `Socio ID ${id} dado de baja`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/socios/:id/pagos  — cuotas desde MEVEP legacy
// ─────────────────────────────────────────────────
router.get('/:id/pagos', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const { limit = 24 } = req.query; // últimos N meses, default 24

        // 1. Obtener cod_mevep del socio
        const socioRows = await userDb.query(
            'SELECT id, cod_mevep, importe_cuota, apellido, nombre FROM socio WHERE id = ? AND FechaBaja IS NULL',
            [id]
        );
        if (socioRows.length === 0) return res.status(404).json({ error: 'Socio no encontrado' });
        const socio = socioRows[0];

        if (!socio.cod_mevep) {
            return res.json({ cuotas: [], resumen: { pendientes: 0, pagadas: 0, deuda_total: 0, estado: 'sin_legacy' } });
        }

        // 2. Obtener cuotas desde MEVEP
        const cuotas = await mevepDb.query(
            `SELECT mes, anio, importe, estado, fecha_pago, cobrador, nro_boleta, ruta
             FROM pagos
             WHERE cod_socio = ?
             ORDER BY anio DESC, mes DESC
             LIMIT ?`,
            [socio.cod_mevep, parseInt(limit)]
        );

        // 3. También obtener datos adicionales del socio en MEVEP (deuda, cobrador, ruta)
        let mevepSocio = null;
        try {
            const mevepRows = await mevepDb.query(
                'SELECT deuda, importe_cuota, importe_deuda, ruta, cobrador, no_imprimir FROM socios WHERE cod_socio = ?',
                [socio.cod_mevep]
            );
            if (mevepRows.length > 0) mevepSocio = mevepRows[0];
        } catch (_) { /* tabla puede no tener ese socio */ }

        // 4. Calcular resumen
        const pendientes = cuotas.filter(c => c.estado === 'PENDIENTE');
        const pagadas = cuotas.filter(c => c.estado === 'PAGADO');
        const deudaTotal = pendientes.reduce((acc, c) => acc + parseFloat(c.importe || 0), 0);

        // Nombres de cobradores
        const cobradorNombres = {
            0: 'LOCAL', 10: 'LOCAL', 11: 'DANIEL', 12: 'JORGE',
            13: 'GUSTAVO', 14: 'RICARDO', 15: 'COBRADOR 15',
            16: 'COBRADOR 16', 17: 'COBRADOR 17'
        };

        const cuotasNormalized = cuotas.map(c => ({
            mes: c.mes,
            anio: c.anio,
            importe: parseFloat(c.importe || 0),
            estado: c.estado, // 'PAGADO' | 'PENDIENTE'
            fecha_pago: c.fecha_pago ? new Date(c.fecha_pago).toISOString().split('T')[0] : null,
            cobrador: c.cobrador,
            cobrador_nombre: cobradorNombres[c.cobrador] || `Cobrador ${c.cobrador}`,
            nro_boleta: c.nro_boleta?.toString(),
            ruta: c.ruta,
        }));

        res.json({
            cuotas: cuotasNormalized,
            resumen: {
                pendientes: pendientes.length,
                pagadas: pagadas.length,
                deuda_total: deudaTotal,
                estado: pendientes.length === 0 ? 'al_dia' : pendientes.length >= 3 ? 'inhabilitado' : 'con_deuda',
                cobrador: mevepSocio?.cobrador ?? null,
                cobrador_nombre: cobradorNombres[mevepSocio?.cobrador] || null,
                ruta: mevepSocio?.ruta ?? null,
                modo_pago: mevepSocio?.no_imprimir === 'VERDADERO' ? 'LOCAL' : 'COBRADOR',
            }
        });
    } catch (err) {
        console.error('[socios/pagos]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// PDF LIST REPORT HELPERS
// ─────────────────────────────────────────────────
const drawHeader = (doc, title, columns) => {
    doc.fontSize(16).font('Helvetica-Bold').fillColor('#0f172a').text(title, { align: 'center' });
    doc.fontSize(8).font('Helvetica-Oblique').fillColor('#64748b').text(`Generado el: ${new Date().toLocaleString('es-AR')}`, { align: 'center' });
    doc.moveDown(1.5);

    const startY = doc.y;
    doc.font('Helvetica-Bold').fontSize(9).fillColor('#1e293b');
    
    let currentX = 40;
    columns.forEach(col => {
        doc.text(col.title.toUpperCase(), currentX, startY, { width: col.width, align: col.align || 'left' });
        currentX += col.width;
    });

    doc.moveTo(40, startY + 14).lineTo(570, startY + 14).strokeColor('#cbd5e1').lineWidth(1.5).stroke();
    doc.y = startY + 22;
};

const buildListPdf = (res, title, columns, data) => {
    const PDFDocument = require('pdfkit');
    const doc = new PDFDocument({ margin: 40, size: 'A4', bufferPages: true });
    res.setHeader('Content-Type', 'application/pdf');
    res.setHeader('Content-Disposition', `inline; filename="${title.replace(/\s+/g, '_')}.pdf"`);
    doc.pipe(res);

    drawHeader(doc, title, columns);

    doc.font('Helvetica').fontSize(8.5).fillColor('#334155');
    
    let rowIndex = 0;
    data.forEach(row => {
        // Check page overflow
        if (doc.y > doc.page.height - 60) {
            doc.addPage();
            drawHeader(doc, title, columns);
            doc.font('Helvetica').fontSize(8.5).fillColor('#334155');
        }

        const startY = doc.y;
        let currentX = 40;

        // Zebra striping background
        if (rowIndex % 2 === 1) {
            doc.rect(38, startY - 2, 534, 14).fillColor('#f8fafc').fill();
            doc.fillColor('#334155');
        }

        columns.forEach(col => {
            const val = row[col.key] !== undefined && row[col.key] !== null ? String(row[col.key]) : '';
            doc.text(val, currentX, startY, { width: col.width - 5, align: col.align || 'left', ellipsis: true });
            currentX += col.width;
        });

        doc.moveTo(40, startY + 11).lineTo(570, startY + 11).strokeColor('#f1f5f9').lineWidth(0.5).stroke();
        doc.y = startY + 14;
        rowIndex++;
    });

    // Add page numbers
    const range = doc.bufferedPageRange ? doc.bufferedPageRange() : { start: 0, count: 1 };
    const totalPages = range.count;
    for (let i = 0; i < totalPages; i++) {
        doc.switchToPage(i);
        doc.fontSize(8).fillColor('#94a3b8').text(`Página ${i + 1} de ${totalPages}`, 40, doc.page.height - 30, { align: 'right' });
    }

    doc.end();
};

// ─────────────────────────────────────────────────
// GET /api/socios/informe/rutas  — Listado Rutas Control
// ─────────────────────────────────────────────────
router.get('/informe/rutas', authenticateToken, async (req, res) => {
    try {
        const rows = await mevepDb.query(
            "SELECT * FROM socios ORDER BY CAST(ruta AS UNSIGNED) ASC, cod_socio ASC"
        );
        
        const cobradorNombres = {
            0: 'LOCAL', 10: 'LOCAL', 11: 'DANIEL', 12: 'JORGE',
            13: 'GUSTAVO', 14: 'RICARDO', 15: 'COB.15',
            16: 'COB.16', 17: 'COB.17'
        };

        const data = rows.map(r => ({
            ruta: r.ruta || '—',
            cod_socio: r.cod_socio,
            nombre_completo: `${r.apellido || ''}, ${r.nombre || ''}`.toUpperCase(),
            domicilio: (r.domicilio || '').toUpperCase(),
            departamento: (r.departamento || '').toUpperCase(),
            telefono: r.telefono || '—',
            cobrador_nombre: cobradorNombres[r.cobrador] || `Cobrador ${r.cobrador}`
        }));

        const columns = [
            { title: 'Ruta', key: 'ruta', width: 40, align: 'center' },
            { title: 'Socio', key: 'cod_socio', width: 50, align: 'center' },
            { title: 'Nombre y Apellido', key: 'nombre_completo', width: 145 },
            { title: 'Domicilio', key: 'domicilio', width: 135 },
            { title: 'Localidad', key: 'departamento', width: 75 },
            { title: 'Teléfono', key: 'telefono', width: 75 },
            { title: 'Cob.', key: 'cobrador_nombre', width: 50, align: 'center' }
        ];

        buildListPdf(res, "Listado de Rutas de Control", columns, data);
    } catch (err) {
        console.error('[informe/rutas]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/socios/informe/socios  — Listado de Socios (por código)
// ─────────────────────────────────────────────────
router.get('/informe/socios', authenticateToken, async (req, res) => {
    try {
        const rows = await mevepDb.query(
            "SELECT * FROM socios ORDER BY cod_socio ASC"
        );
        
        const cobradorNombres = {
            0: 'LOCAL', 10: 'LOCAL', 11: 'DANIEL', 12: 'JORGE',
            13: 'GUSTAVO', 14: 'RICARDO', 15: 'COB.15',
            16: 'COB.16', 17: 'COB.17'
        };

        const data = rows.map(r => ({
            ruta: r.ruta || '—',
            cod_socio: r.cod_socio,
            nombre_completo: `${r.apellido || ''}, ${r.nombre || ''}`.toUpperCase(),
            domicilio: (r.domicilio || '').toUpperCase(),
            departamento: (r.departamento || '').toUpperCase(),
            telefono: r.telefono || '—',
            cobrador_nombre: cobradorNombres[r.cobrador] || `Cobrador ${r.cobrador}`
        }));

        const columns = [
            { title: 'Ruta', key: 'ruta', width: 40, align: 'center' },
            { title: 'Socio', key: 'cod_socio', width: 50, align: 'center' },
            { title: 'Nombre y Apellido', key: 'nombre_completo', width: 145 },
            { title: 'Domicilio', key: 'domicilio', width: 135 },
            { title: 'Localidad', key: 'departamento', width: 75 },
            { title: 'Teléfono', key: 'telefono', width: 75 },
            { title: 'Cob.', key: 'cobrador_nombre', width: 50, align: 'center' }
        ];

        buildListPdf(res, "Listado de Socios", columns, data);
    } catch (err) {
        console.error('[informe/socios]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/socios/informe/local  — Listado Local
// ─────────────────────────────────────────────────
router.get('/informe/local', authenticateToken, async (req, res) => {
    try {
        const rows = await mevepDb.query(
            "SELECT * FROM socios WHERE no_imprimir = 'VERDADERO' ORDER BY CAST(ruta AS UNSIGNED) ASC, cod_socio ASC"
        );
        
        const cobradorNombres = {
            0: 'LOCAL', 10: 'LOCAL', 11: 'DANIEL', 12: 'JORGE',
            13: 'GUSTAVO', 14: 'RICARDO', 15: 'COB.15',
            16: 'COB.16', 17: 'COB.17'
        };

        const data = rows.map(r => ({
            ruta: r.ruta || '—',
            cod_socio: r.cod_socio,
            nombre_completo: `${r.apellido || ''}, ${r.nombre || ''}`.toUpperCase(),
            motivo: (r.motivo || '').toUpperCase(),
            cobrador_nombre: cobradorNombres[r.cobrador] || `Cobrador ${r.cobrador}`,
            telefono: r.telefono || '—'
        }));

        const columns = [
            { title: 'Ruta', key: 'ruta', width: 40, align: 'center' },
            { title: 'Socio', key: 'cod_socio', width: 50, align: 'center' },
            { title: 'Nombre y Apellido', key: 'nombre_completo', width: 155 },
            { title: 'Observaciones / Motivo', key: 'motivo', width: 160 },
            { title: 'Cob.', key: 'cobrador_nombre', width: 50, align: 'center' },
            { title: 'Teléfono', key: 'telefono', width: 75 }
        ];

        buildListPdf(res, "Listado Local", columns, data);
    } catch (err) {
        console.error('[informe/local]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/socios/informe/facturacion  — Facturación Boletas PDF
// Replica EXACTA del legacy PHP/FPDF (socios_pdf_A4.php)
// Formato: A5 landscape (210mm × 148mm)
// Posiciones X/Y en mm → convertidas a pt (* 2.8346)
// ─────────────────────────────────────────────────
router.get('/informe/facturacion', authenticateToken, async (req, res) => {
    const PDFDocument = require('pdfkit');
    const bwipjs     = require('bwip-js');
    try {
        const { desde, hasta, mes_fac, fecha_fac, anio, observaciones = '' } = req.query;

        if (!desde || !hasta || !mes_fac || !fecha_fac) {
            return res.status(400).json({ error: 'Rango desde/hasta, mes y fecha son obligatorios' });
        }

        // Mapeo mes nombre → número (igual que el legacy PHP switch)
        const mesMap = {
            'ENERO':'01','FEBRERO':'02','MARZO':'03','ABRIL':'04',
            'MAYO':'05','JUNIO':'06','JULIO':'07','AGOSTO':'08',
            'SEPTIEMBRE':'09','OCTUBRE':'10','NOVIEMBRE':'11','DICIEMBRE':'12'
        };
        const mesCode = mesMap[mes_fac.toUpperCase()] || '01';
        const anioFull = anio ? String(anio) : String(new Date().getFullYear());
        const anio2    = anioFull.slice(-2); // legacy: substr($anio,2,2) → últimos 2 dígitos

        const querySql = `
            SELECT * FROM socios 
            WHERE CAST(ruta AS UNSIGNED) BETWEEN ? AND ? 
              AND no_imprimir = 'FALSO' 
            ORDER BY CAST(ruta AS UNSIGNED) ASC, cod_socio ASC
        `;
        const rows = await mevepDb.query(querySql, [parseInt(desde), parseInt(hasta)]);

        // ── Convertidor mm → pt (factor FPDF/PDF estándar) ─────────
        const mm = (v) => v * 2.8346;

        // A5 landscape: 210mm × 148mm = 595.28pt × 419.53pt
        const doc = new PDFDocument({ margin: 0, size: [mm(210), mm(148)] });
        res.setHeader('Content-Type', 'application/pdf');
        res.setHeader('Content-Disposition', `inline; filename="Boletas_Facturacion_${mes_fac}_${anioFull}.pdf"`);
        doc.pipe(res);

        // ── Helper: genera PNG del EAN-13 con bwip-js ───────────────
        // Legacy: $cod_barra = $cod_socio.$mes.$anio_barra.$cobrador
        const buildEAN13 = async (rawCode) => {
            const padded = rawCode.toString().padStart(12, '0').slice(-12);
            try {
                return await bwipjs.toBuffer({
                    bcid:        'ean13',
                    text:        padded,
                    scale:       3,
                    height:      15,       // mm de barras (bwip interno)
                    includetext: true,
                    textxalign:  'center',
                    textsize:    8,
                });
            } catch (_) {
                return null;
            }
        };

        // ── Renderizar: 1 socio por página ──────────────────────────
        let firstPage = true;

        for (const socio of rows) {
            if (!firstPage) doc.addPage();
            firstPage = false;

            // Obtener mascota (igual que legacy: select * from animal where cod_socio = ?)
            const pets = await mevepDb.query(
                'SELECT nombre FROM animal WHERE cod_socio = ? LIMIT 1',
                [socio.cod_socio]
            );
            const nombre_mascota = pets.length > 0 ? pets[0].nombre : '';

            // Obtener nro_boleta e importe del mes/año (igual que legacy: select from pagos)
            let nro_boleta = '';
            let importe_cuota = socio.importe_cuota || '0';
            try {
                const pagoRows = await mevepDb.query(
                    'SELECT nro_boleta, importe FROM pagos WHERE cod_socio = ? AND mes = ? AND anio = ? LIMIT 1',
                    [socio.cod_socio, mesCode, parseInt(anioFull)]
                );
                if (pagoRows.length > 0) {
                    nro_boleta    = pagoRows[0].nro_boleta || '';
                    importe_cuota = pagoRows[0].importe    || importe_cuota;
                }
            } catch (_) { /* si la consulta falla, usamos importe_cuota del socio */ }

            // Formateos iguales al legacy
            nro_boleta = String(nro_boleta).padStart(8, '0');

            const apellido = (socio.apellido || '').toUpperCase();
            const nombre   = (socio.nombre   || '').toUpperCase();
            const nombreCompleto = `${apellido}, ${nombre} (${socio.cod_socio})`;

            const domicilio = `${(socio.domicilio   || '').toUpperCase()} - ${(socio.departamento || '').toUpperCase()}`;
            const leyenda   = `1 Abono por: ${nombre_mascota || 'Mascota'}`;
            const ruta      = String(socio.ruta || '-');

            // Código de barras: $cod_barra = $cod_socio.$mes.$anio_barra.$cobrador
            const rawCode = `${socio.cod_socio}${mesCode}${anio2}${socio.cobrador || '00'}`;
            const barPng  = await buildEAN13(rawCode);

            // ════════════════════════════════════════════════════════
            // POSICIONAMIENTO EXACTO — réplica 1:1 del legacy PHP
            // Unidades: mm convertidas a pt con mm()
            // ════════════════════════════════════════════════════════

            // SetFont('Arial','',9)
            doc.font('Helvetica').fontSize(9).fillColor('#000000');

            // SetY(5) / SetX(70) → Nº boleta IZQUIERDA
            doc.text(`N°: ${nro_boleta}`, mm(70), mm(5), { lineBreak: false });
            // SetX(179) → Nº boleta DERECHA
            doc.text(`N°: ${nro_boleta}`, mm(179), mm(5), { lineBreak: false });

            // SetY(30) / SetX(70) → Fecha IZQUIERDA
            doc.text(fecha_fac, mm(70), mm(30), { lineBreak: false });
            // SetX(179) → Fecha DERECHA
            doc.text(fecha_fac, mm(179), mm(30), { lineBreak: false });

            // Ln() → y=35 / Ln() → y=40
            // SetX(20) → Nombre IZQUIERDA  (y=40mm)
            doc.text(nombreCompleto, mm(20), mm(40), { width: mm(100), lineBreak: false });
            // SetX(129) → Nombre DERECHA
            doc.text(nombreCompleto, mm(129), mm(40), { width: mm(75), lineBreak: false });

            // Ln() → y=45
            // SetX(20) → Domicilio IZQUIERDA (y=45mm)
            doc.text(domicilio, mm(20), mm(45), { width: mm(100), lineBreak: false });
            // SetX(129) → Domicilio DERECHA
            doc.text(domicilio, mm(129), mm(45), { width: mm(75), lineBreak: false });

            // SetY(60) → Leyenda/Importe
            // Cell(40,5,$leyenda) — x en margen izq (≈10mm en FPDF default)
            doc.text(leyenda, mm(10), mm(60), { width: mm(75), lineBreak: false });
            // SetX(90) → Importe IZQUIERDA
            doc.text(importe_cuota, mm(90), mm(60), { lineBreak: false });
            // SetX(124) → Leyenda DERECHA
            doc.text(leyenda, mm(124), mm(60), { width: mm(65), lineBreak: false });
            // SetX(194) → Importe DERECHA
            doc.text(importe_cuota, mm(194), mm(60), { lineBreak: false });

            // SetFont('Arial','B',28) / SetY(80) / SetX(25) → Mes IZQUIERDA
            doc.font('Helvetica-Bold').fontSize(28).fillColor('#000000');
            doc.text(mes_fac.toUpperCase(), mm(25), mm(80), { lineBreak: false });
            // SetX(126) → Mes DERECHA
            doc.text(mes_fac.toUpperCase(), mm(126), mm(80), { lineBreak: false });

            // SetFont('Arial','',8) / SetY(90) / SetX(120) → Observaciones (solo derecha, width=80mm)
            if (observaciones) {
                doc.font('Helvetica').fontSize(8).fillColor('#000000');
                doc.text(observaciones, mm(120), mm(90), { width: mm(80), lineBreak: true });
            }

            // SetFont('Arial','',9) / SetY(121)
            doc.font('Helvetica').fontSize(9).fillColor('#000000');

            // SetX(10) → Ruta
            doc.text(ruta, mm(10), mm(121), { lineBreak: false });
            // SetX(90) → Importe total IZQUIERDA
            doc.text(importe_cuota, mm(90), mm(121), { lineBreak: false });
            // SetX(194) → Importe total DERECHA
            doc.text(importe_cuota, mm(194), mm(121), { lineBreak: false });

            // EAN13(30, 90, $cod_barra) → Código de barras en la copia IZQUIERDA
            // (en el legacy solo hay un EAN13, en la mitad izquierda)
            if (barPng) {
                // EAN-13 estándar ≈ 37.29mm de ancho, 25.93mm de alto (a 100% escala)
                doc.image(barPng, mm(30), mm(90), {
                    width:  mm(38),   // ancho aproximado EAN-13 estándar en mm
                    height: mm(22),   // alto incluyendo texto del número
                });
            } else {
                doc.font('Courier').fontSize(7).fillColor('#000000')
                   .text(rawCode, mm(30), mm(95), { lineBreak: false });
            }
        }

        doc.end();
    } catch (err) {
        console.error('[informe/facturacion]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/socios/cobradores  — Lista de Cobradores
// ─────────────────────────────────────────────────
router.get('/cobradores', authenticateToken, async (req, res) => {
    try {
        let cobradores = [];
        try {
            cobradores = await mevepDb.query("SELECT * FROM cobradores ORDER BY cod_cobrador ASC");
        } catch (_) {
            cobradores = [
                { cod_cobrador: '10', nombre_cobrador: 'LOCAL' },
                { cod_cobrador: '11', nombre_cobrador: 'DANIEL' },
                { cod_cobrador: '12', nombre_cobrador: 'JORGE' },
                { cod_cobrador: '13', nombre_cobrador: 'GUSTAVO' },
                { cod_cobrador: '14', nombre_cobrador: 'RICARDO' }
            ];
        }
        res.json(cobradores);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/socios/legacy/search  — Buscar socios en el legacy
// ─────────────────────────────────────────────────
router.get('/legacy/search', authenticateToken, async (req, res) => {
    try {
        const { q = '' } = req.query;
        if (!q.trim()) {
            return res.json([]);
        }
        const searchTerm = `%${q.trim()}%`;
        const rows = await mevepDb.query(
            `SELECT cod_socio, apellido, nombre, ruta, cobrador, no_imprimir, motivo, domicilio, departamento
             FROM socios
             WHERE cod_socio LIKE ? OR apellido LIKE ? OR nombre LIKE ? OR domicilio LIKE ?
             ORDER BY apellido ASC, nombre ASC
             LIMIT 50`,
            [searchTerm, searchTerm, searchTerm, searchTerm]
        );
        res.json(rows);
    } catch (err) {
        console.error('[legacy/search]', err.message);
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// POST /api/socios/acomodar-ruta  — Reordenar/Insertar en Ruta
// ─────────────────────────────────────────────────
router.post('/acomodar-ruta', authenticateToken, async (req, res) => {
    try {
        const { cod_socio, ruta_nueva, tipo_pago, cobrador, motivo } = req.body;

        if (!cod_socio || !ruta_nueva) {
            return res.status(400).json({ error: 'Código de socio y ruta nueva son obligatorios' });
        }

        // 1. Verificar si el socio existe en MEVEP
        const mevepSocio = await mevepDb.query("SELECT cod_socio, ruta FROM socios WHERE cod_socio = ?", [cod_socio]);
        if (mevepSocio.length === 0) {
            return res.status(404).json({ error: 'Socio no encontrado en la base legacy MEVEP' });
        }

        // 2. Actualizar tipo_pago (no_imprimir), motivo y cobrador
        await mevepDb.query(
            "UPDATE socios SET no_imprimir = ?, motivo = ?, cobrador = ? WHERE cod_socio = ?",
            [tipo_pago || 'FALSO', motivo || '', cobrador || '10', cod_socio]
        );

        // 3. Obtener socios con ruta >= ruta_nueva para desplazarlos (incrementar en 1)
        // en orden descendente para no solaparse
        const sociosToShift = await mevepDb.query(
            "SELECT cod_socio, ruta FROM socios WHERE CAST(ruta AS UNSIGNED) >= ? ORDER BY CAST(ruta AS UNSIGNED) DESC",
            [parseInt(ruta_nueva)]
        );

        for (const s of sociosToShift) {
            const nextRuta = (parseInt(s.ruta) + 1).toString();
            await mevepDb.query(
                "UPDATE socios SET ruta = ? WHERE cod_socio = ? AND ruta = ?",
                [nextRuta, s.cod_socio, s.ruta]
            );
        }

        // 4. Ubicar al socio actual en la ruta_nueva
        await mevepDb.query(
            "UPDATE socios SET ruta = ? WHERE cod_socio = ?",
            [ruta_nueva.toString(), cod_socio]
        );

        logAction(req.user.nombre_usuario, 'SOCIO_ACOMODAR_RUTA', `Socio ${cod_socio} acomodado en ruta ${ruta_nueva}`, req);
        res.json({ message: 'Ruta acomodada correctamente' });
    } catch (err) {
        console.error('[acomodar-ruta]', err.message);
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
