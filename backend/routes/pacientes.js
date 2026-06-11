const express = require('express');
const router = express.Router();
const userDb = require('../db/userDb');
const { logAction } = require('../utils/logger');

// Middleware to verify JWT token and user context
const authenticateToken = (req, res, next) => {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];

    if (!token) return res.status(401).json({ error: 'Token no proporcionado' });

    const jwt = require('jsonwebtoken');
    const JWT_SECRET = process.env.JWT_SECRET || 'fallback_secret';
    jwt.verify(token, JWT_SECRET, (err, user) => {
        if (err) return res.status(403).json({ error: 'Token inválido o expirado' });
        req.user = user;
        next();
    });
};

// Check if user is admin, recepcion or superadmin
const isAdmin = (req, res, next) => {
    if (req.user && (req.user.rol === 'admin' || req.user.rol === 'recepcion' || req.user.rol === 'superadmin')) {
        next();
    } else {
        res.status(403).json({ error: 'Acceso denegado: se requiere rol de administrador o recepción' });
    }
};

// GET /api/pacientes (list or search)
router.get('/', authenticateToken, async (req, res) => {
    const { query } = req.query;
    try {
        let sql = `
            SELECT p.*, 
                   os.nombre as cobertura_medica_nombre, 
                   os.sigla as cobertura_medica_sigla
            FROM paciente p
            LEFT JOIN obra_social os ON p.obra_social_id = os.id
            WHERE p.FechaBaja IS NULL
        `;
        let params = [];

        if (req.user.rol !== 'superadmin') {
            sql += ' AND p.prestador_id = ?';
            params.push(req.user.prestador_id);
        }

        if (query) {
            sql += ' AND (p.nombre LIKE ? OR p.apellido LIKE ? OR p.dni LIKE ?)';
            const likeQuery = `%${query}%`;
            params.push(likeQuery, likeQuery, likeQuery);
        }

        sql += ' ORDER BY p.apellido ASC, p.nombre ASC';
        const patients = await userDb.query(sql, params, req.user.rol);
        res.json(patients);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// GET /api/pacientes/:id (specific patient details)
router.get('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        let sql = 'SELECT * FROM paciente WHERE id = ? AND FechaBaja IS NULL';
        let params = [id];

        if (req.user.rol !== 'superadmin') {
            sql += ' AND prestador_id = ?';
            params.push(req.user.prestador_id);
        }

        const patients = await userDb.query(sql, params, req.user.rol);
        if (patients.length === 0) return res.status(404).json({ error: 'Paciente no encontrado' });
        res.json(patients[0]);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /api/pacientes (create patient)
router.post('/', authenticateToken, async (req, res) => {
    const { nombre, apellido, dni, telefono, email, fecha_nacimiento, cobertura_medica, numero_afiliado, obra_social_id } = req.body;
    if (!nombre || !apellido || !dni) {
        return res.status(400).json({ error: 'Nombre, apellido y DNI son obligatorios' });
    }

    // Require at least email or phone/whatsapp
    if (!email && !telefono) {
        return res.status(400).json({ error: 'Debe ingresar al menos un medio de contacto (Email o Teléfono/WhatsApp)' });
    }

    try {
        // Check if DNI already exists for this prestador
        const existing = await userDb.query('SELECT id FROM paciente WHERE dni = ? AND prestador_id = ? AND FechaBaja IS NULL', [dni, req.user.prestador_id || 1], req.user.rol);
        if (existing.length > 0) {
            return res.status(400).json({ error: 'Ya existe un paciente registrado con este DNI' });
        }

        const finalPrestadorId = req.user.prestador_id || 1;
        await userDb.query(
            'INSERT INTO paciente (nombre, apellido, dni, telefono, email, fecha_nacimiento, cobertura_medica, numero_afiliado, obra_social_id, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())',
            [
                nombre, 
                apellido, 
                dni, 
                telefono || null, 
                email || null, 
                fecha_nacimiento || null, 
                cobertura_medica || null, 
                numero_afiliado || null,
                obra_social_id ? parseInt(obra_social_id) : null,
                finalPrestadorId,
                req.user.nombre_usuario
            ],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'PACIENTE_CREATE', `Paciente creado: ${nombre} ${apellido} (DNI: ${dni}, Prestador ID: ${finalPrestadorId})`, req);
        res.json({ message: 'Paciente registrado con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// PUT /api/pacientes/:id (update patient)
router.put('/:id', authenticateToken, async (req, res) => {
    const { id } = req.params;
    const { nombre, apellido, dni, telefono, email, fecha_nacimiento, cobertura_medica, numero_afiliado, obra_social_id } = req.body;
    if (!nombre || !apellido || !dni) {
        return res.status(400).json({ error: 'Nombre, apellido y DNI son obligatorios' });
    }

    // Require at least email or phone/whatsapp
    if (!email && !telefono) {
        return res.status(400).json({ error: 'Debe ingresar al menos un medio de contacto (Email o Teléfono/WhatsApp)' });
    }

    try {
        // Check isolation
        const check = await userDb.query('SELECT id, prestador_id FROM paciente WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Paciente no encontrado o dado de baja' });
        if (req.user.rol !== 'superadmin' && check[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para modificar este paciente de otra institución' });
        }

        // Check if DNI exists in another patient for this prestador
        const existing = await userDb.query('SELECT id FROM paciente WHERE dni = ? AND id != ? AND prestador_id = ? AND FechaBaja IS NULL', [dni, id, req.user.prestador_id || 1], req.user.rol);
        if (existing.length > 0) {
            return res.status(400).json({ error: 'Ya existe otro paciente con este DNI' });
        }

        await userDb.query(
            'UPDATE paciente SET nombre = ?, apellido = ?, dni = ?, telefono = ?, email = ?, fecha_nacimiento = ?, cobertura_medica = ?, numero_afiliado = ?, obra_social_id = ?, ModificacionUsuario = ?, FechaModificacion = NOW() WHERE id = ?',
            [
                nombre, 
                apellido, 
                dni, 
                telefono || null, 
                email || null, 
                fecha_nacimiento || null, 
                cobertura_medica || null, 
                numero_afiliado || null, 
                obra_social_id ? parseInt(obra_social_id) : null,
                req.user.nombre_usuario,
                id
            ],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'PACIENTE_UPDATE', `Paciente ID actualizado: ${id} (${nombre} ${apellido})`, req);
        res.json({ message: 'Paciente actualizado con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// DELETE /api/pacientes/:id (delete patient - admin only)
router.delete('/:id', authenticateToken, isAdmin, async (req, res) => {
    const { id } = req.params;
    try {
        const check = await userDb.query('SELECT id, prestador_id FROM paciente WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Paciente no encontrado o ya eliminado' });
        if (req.user.rol !== 'superadmin' && check[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para eliminar este paciente de otra institución' });
        }

        await userDb.query('UPDATE paciente SET FechaBaja = NOW(), BajaUsuario = ? WHERE id = ?', [req.user.nombre_usuario, id], req.user.rol);
        logAction(req.user.nombre_usuario, 'PACIENTE_DELETE', `Paciente eliminado lógicamente ID: ${id}`, req);
        res.json({ message: 'Paciente eliminado con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// GET /api/pacientes/:id/historia (patient medical history)
router.get('/:id/historia', authenticateToken, async (req, res) => {
    const { id } = req.params;
    try {
        // Security check
        const check = await userDb.query('SELECT id, prestador_id FROM paciente WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Paciente no encontrado o dado de baja' });
        if (req.user.rol !== 'superadmin' && check[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para ver la historia clínica de este paciente' });
        }

        // Query history entries
        const historyEntries = await userDb.query(
            `SELECT hc.*, u.nombre_usuario as odontologo_nombre 
             FROM historia_clinica hc 
             LEFT JOIN user u ON hc.odontologo_id = u.id 
             WHERE hc.paciente_id = ? AND hc.FechaBaja IS NULL
             ORDER BY hc.fecha DESC`,
            [id],
            req.user.rol
        );

        // Fetch treatments and files for each history entry
        for (const entry of historyEntries) {
            const treatments = await userDb.query(
                `SELECT tr.*, n.codigo as nomenclador_codigo, n.nombre as nomenclador_nombre, pn.precio as nomenclador_precio
                 FROM tratamiento_realizado tr
                 LEFT JOIN nomenclador n ON tr.nomenclador_id = n.id
                 LEFT JOIN prestador_nomenclador pn ON pn.nomenclador_id = n.id AND pn.prestador_id = tr.prestador_id
                 WHERE tr.historia_clinica_id = ?`,
                [entry.id],
                req.user.rol
            );
            entry.tratamientos = treatments;

            const archivos = await userDb.query(
                `SELECT * FROM historia_clinica_archivo WHERE historia_clinica_id = ? AND FechaBaja IS NULL`,
                [entry.id],
                req.user.rol
            );
            entry.archivos = archivos;
        }

        res.json(historyEntries);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /api/pacientes/:id/historia (add history entry and treatments)
router.post('/:id/historia', authenticateToken, async (req, res) => {
    const { id } = req.params; // paciente_id
    const { diagnostico, observaciones, tratamientos, turno_id } = req.body; // tratamientos = array of { nomenclador_id, diente_numero, cara, notas }

    try {
        // Security check
        const check = await userDb.query('SELECT id, prestador_id FROM paciente WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Paciente no encontrado o dado de baja' });
        if (req.user.rol !== 'superadmin' && check[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para registrar historias clínicas de este paciente' });
        }

        const finalPrestadorId = req.user.prestador_id || 1;

        // 1. Insert history entry
        const insertHc = await userDb.query(
            'INSERT INTO historia_clinica (paciente_id, odontologo_id, diagnostico, observaciones, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, NOW())',
            [id, req.user.id, diagnostico || null, observaciones || null, finalPrestadorId, req.user.nombre_usuario],
            req.user.rol
        );

        // 1.5 Update appointment to 'atendido' if turno_id was provided
        if (turno_id) {
            await userDb.query(
                'UPDATE turno SET estado = ?, FechaModificacion = NOW() WHERE id = ?',
                ['atendido', turno_id],
                req.user.rol
            );
        }

        const insertId = Number(insertHc.insertId);

        // 2. Insert treatments if any
        if (tratamientos && Array.isArray(tratamientos)) {
            for (const treat of tratamientos) {
                await userDb.query(
                    'INSERT INTO tratamiento_realizado (historia_clinica_id, nomenclador_id, diente_numero, cara, notas, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())',
                    [insertId, treat.nomenclador_id, treat.diente_numero || null, treat.cara || null, treat.notas || null, finalPrestadorId, req.user.nombre_usuario],
                    req.user.rol
                );

                // 3. Proactively update Odontogram if tooth treatment is recorded!
                // If treatment is related to a tooth and has a status change, we can register/update the odontogram!
                if (treat.diente_numero) {
                    // Decide state based on nomenclature procedure
                    // Default to 'tratado'
                    let targetState = 'tratado';
                    const nomencladorObj = await userDb.query('SELECT codigo FROM nomenclador WHERE id = ?', [treat.nomenclador_id], req.user.rol);
                    if (nomencladorObj.length > 0) {
                        const code = nomencladorObj[0].codigo;
                        if (code === '02.01' || code === '02.02') targetState = 'tratado'; // Obturado/Tratado
                        else if (code === '09.01') targetState = 'corona'; // Corona
                        else if (code === '05.01' || code === '05.02') targetState = 'ausente'; // Ausente/Extracción
                    }

                    const cara = treat.cara || 'general';

                    // Insert or Update in odontograma table
                    await userDb.query(
                        `INSERT INTO odontograma (paciente_id, diente_numero, cara, estado, notas, prestador_id, CreacionUsuario, FechaCreacion) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, NOW()) 
                         ON DUPLICATE KEY UPDATE estado = VALUES(estado), notas = VALUES(notas), ModificacionUsuario = VALUES(CreacionUsuario), FechaModificacion = NOW()`,
                        [id, treat.diente_numero, cara, targetState, treat.notas || `Tratado mediante ficha clínica #${insertId}`, finalPrestadorId, req.user.nombre_usuario],
                        req.user.rol
                    );
                }
            }
        }

        logAction(req.user.nombre_usuario, 'HISTORIA_CLINICA_ADD', `Nueva ficha clínica registrada para Paciente ID: ${id}`, req);
        res.json({ message: 'Historia clínica registrada con éxito', insertId });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// PUT /api/pacientes/:id/historia/:entry_id/anular (annul a clinical history entry - Logical delete)
router.put('/:id/historia/:entry_id/anular', authenticateToken, async (req, res) => {
    const { id, entry_id } = req.params;
    const { motivo_anulacion } = req.body;

    if (!motivo_anulacion) {
        return res.status(400).json({ error: 'El motivo de anulación es obligatorio.' });
    }

    try {
        // 1. Fetch entry to check who created it
        const entries = await userDb.query('SELECT * FROM historia_clinica WHERE id = ? AND paciente_id = ?', [entry_id, id], req.user.rol);
        if (entries.length === 0) {
            return res.status(404).json({ error: 'Registro de historia clínica no encontrado.' });
        }

        const entry = entries[0];

        // 2. Validate that ONLY the professional who created it can annul it
        if (entry.odontologo_id !== req.user.id) {
            return res.status(403).json({ error: 'Acceso denegado: solo el profesional que atendió y registró la ficha puede anularla.' });
        }

        // 3. Mark as annulled (Logical delete)
        const formatMySqlDate = (date) => date.toISOString().slice(0, 19).replace('T', ' ');
        const annulledTime = formatMySqlDate(new Date());

        await userDb.query(
            `UPDATE historia_clinica 
             SET anulado = 1, motivo_anulacion = ?, fecha_anulacion = ?, FechaBaja = NOW(), BajaUsuario = ? 
             WHERE id = ?`,
            [motivo_anulacion, annulledTime, req.user.nombre_usuario, entry_id],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'HISTORIA_CLINICA_ANULAR', `Ficha clínica ID ${entry_id} del Paciente ID ${id} anulada por: ${motivo_anulacion}`, req);
        res.json({ message: 'Ficha clínica anulada con éxito.' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// GET /api/pacientes/:id/odontograma (patient odontogram)
router.get('/:id/odontograma', authenticateToken, async (req, res) => {
    const { id } = req.params;
    try {
        // Security check
        const check = await userDb.query('SELECT id, prestador_id FROM paciente WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Paciente no encontrado o dado de baja' });
        if (req.user.rol !== 'superadmin' && check[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para ver el odontograma de este paciente' });
        }

        const teeth = await userDb.query('SELECT * FROM odontograma WHERE paciente_id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        res.json(teeth);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /api/pacientes/:id/odontograma (update tooth state directly)
router.post('/:id/odontograma', authenticateToken, async (req, res) => {
    const { id } = req.params;
    const { diente_numero, cara, estado, notas } = req.body;

    if (!diente_numero || !estado) {
        return res.status(400).json({ error: 'Número de diente y estado son obligatorios' });
    }

    try {
        // Security check
        const check = await userDb.query('SELECT id, prestador_id FROM paciente WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Paciente no encontrado o dado de baja' });
        if (req.user.rol !== 'superadmin' && check[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para modificar el odontograma de este paciente' });
        }

        const finalPrestadorId = req.user.prestador_id || 1;
        const targetCara = cara || 'general';
        await userDb.query(
            `INSERT INTO odontograma (paciente_id, diente_numero, cara, estado, notas, prestador_id, CreacionUsuario, FechaCreacion) 
             VALUES (?, ?, ?, ?, ?, ?, ?, NOW()) 
             ON DUPLICATE KEY UPDATE estado = VALUES(estado), notas = VALUES(notas), ModificacionUsuario = VALUES(CreacionUsuario), FechaModificacion = NOW()`,
            [id, diente_numero, targetCara, estado, notas || null, finalPrestadorId, req.user.nombre_usuario],
            req.user.rol
        );

        res.json({ message: 'Odontograma actualizado con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// GET /api/pacientes/:id/historia/pdf (Generate PDF report)
router.get('/:id/historia/pdf', authenticateToken, async (req, res) => {
    const { id } = req.params;
    const PDFDocument = require('pdfkit');

    try {
        // Security check
        const check = await userDb.query('SELECT * FROM paciente WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Paciente no encontrado o dado de baja' });
        if (req.user.rol !== 'superadmin' && check[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para ver este paciente' });
        }

        const patient = check[0];

        // Query history entries
        const historyEntries = await userDb.query(
            `SELECT hc.*, u.nombre_usuario as odontologo_nombre 
             FROM historia_clinica hc 
             LEFT JOIN user u ON hc.odontologo_id = u.id 
             WHERE hc.paciente_id = ? AND hc.FechaBaja IS NULL
             ORDER BY hc.fecha ASC`, // Chronological order for PDF
            [id],
            req.user.rol
        );

        // Fetch treatments for each history entry
        for (const entry of historyEntries) {
            const treatments = await userDb.query(
                `SELECT tr.*, n.codigo as nomenclador_codigo, n.nombre as nomenclador_nombre
                 FROM tratamiento_realizado tr
                 LEFT JOIN nomenclador n ON tr.nomenclador_id = n.id
                 WHERE tr.historia_clinica_id = ?`,
                [entry.id],
                req.user.rol
            );
            entry.tratamientos = treatments;
        }

        // Create PDF
        const doc = new PDFDocument({ margin: 50, size: 'A4' });
        res.setHeader('Content-Type', 'application/pdf');
        res.setHeader('Content-Disposition', `inline; filename="Historia_Clinica_${patient.dni}.pdf"`);
        doc.pipe(res);

        // Header
        doc.fontSize(20).text('Historia Clínica Odontológica', { align: 'center' });
        doc.moveDown(0.5);
        
        // Patient Info Box
        doc.rect(50, doc.y, 495, 60).stroke('#cccccc');
        doc.fontSize(10).fillColor('#333333');
        const startY = doc.y + 10;
        doc.text(`Paciente: ${patient.apellido.toUpperCase()}, ${patient.nombre}`, 60, startY);
        doc.text(`DNI: ${patient.dni}`, 60, startY + 15);
        doc.text(`Obra Social: ${patient.cobertura_medica || 'Particular'}`, 60, startY + 30);
        
        const birthDate = patient.fecha_nacimiento ? new Date(patient.fecha_nacimiento).toLocaleDateString('es-AR') : '-';
        doc.text(`Fecha Nac.: ${birthDate}`, 300, startY);
        doc.text(`Teléfono: ${patient.telefono || '-'}`, 300, startY + 15);
        doc.text(`Nº Afiliado: ${patient.numero_afiliado || '-'}`, 300, startY + 30);
        
        doc.y = startY + 60;
        doc.moveDown(1);

        if (historyEntries.length === 0) {
            doc.fontSize(12).fillColor('#666666').text('El paciente no cuenta con registros clínicos.', { align: 'center' });
        } else {
            // Render entries
            historyEntries.forEach((entry, index) => {
                const dateStr = new Date(entry.fecha).toLocaleString('es-AR');
                
                // Entry Header
                doc.fontSize(11).fillColor(entry.anulado ? '#ef4444' : '#2563eb')
                   .text(`Fecha: ${dateStr} | Dr/a: ${entry.odontologo_nombre || 'Desconocido'}`, { continued: entry.anulado ? true : false });
                
                if (entry.anulado) {
                    doc.fillColor('#ef4444').text(' [ANULADA]');
                }

                doc.moveDown(0.5);
                
                doc.fontSize(10).fillColor('#000000');
                if (entry.anulado) {
                    doc.text(`Motivo de Anulación: ${entry.motivo_anulacion}`);
                    doc.moveDown(0.5);
                }

                // Use strikethrough logic if annulled, but PDFKit doesn't have native strike.
                // We'll just change color to grey.
                doc.fillColor(entry.anulado ? '#999999' : '#333333');
                
                doc.font('Helvetica-Bold').text('Diagnóstico: ', { continued: true })
                   .font('Helvetica').text(entry.diagnostico || 'Sin diagnóstico');
                
                if (entry.observaciones) {
                    doc.font('Helvetica-Bold').text('Observaciones: ', { continued: true })
                       .font('Helvetica').text(entry.observaciones);
                }

                if (entry.tratamientos && entry.tratamientos.length > 0) {
                    doc.moveDown(0.3);
                    doc.font('Helvetica-Bold').text('Prácticas Realizadas:');
                    doc.font('Helvetica');
                    entry.tratamientos.forEach(t => {
                        let text = `  • [${t.nomenclador_codigo}] ${t.nomenclador_nombre}`;
                        if (t.diente_numero) {
                            text += ` (Pieza #${t.diente_numero}`;
                            if (t.cara && t.cara !== 'general') text += ` - ${t.cara}`;
                            text += ')';
                        }
                        doc.text(text);
                    });
                }

                doc.moveDown(1);
                // Separator
                if (index < historyEntries.length - 1) {
                    doc.moveTo(50, doc.y).lineTo(545, doc.y).stroke('#eeeeee');
                    doc.moveDown(1);
                }
            });
        }

        // Footer
        const totalPages = doc.bufferedPageRange ? doc.bufferedPageRange().count : 1;
        doc.fontSize(8).fillColor('#999999').text(`Generado el: ${new Date().toLocaleString('es-AR')}`, 50, doc.page.height - 50, { align: 'center' });

        doc.end();
    } catch (err) {
        console.error('PDF Error:', err);
        if (!res.headersSent) res.status(500).json({ error: 'Error al generar el PDF' });
    }
});

const multer = require('multer');
const fs = require('fs');
const path = require('path');

// Configure multer storage
const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        const dir = path.join(__dirname, '..', 'uploads');
        if (!fs.existsSync(dir)){
            fs.mkdirSync(dir);
        }
        cb(null, dir);
    },
    filename: function (req, file, cb) {
        const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
        cb(null, uniqueSuffix + '-' + file.originalname);
    }
});
const upload = multer({ storage: storage });

// POST /api/pacientes/:id/historia/:entry_id/archivos (Upload a file)
router.post('/:id/historia/:entry_id/archivos', authenticateToken, upload.single('archivo'), async (req, res) => {
    const { id, entry_id } = req.params;

    try {
        if (!req.file) {
            return res.status(400).json({ error: 'No se envió ningún archivo.' });
        }

        // Verify history entry exists and belongs to this patient
        const entries = await userDb.query('SELECT * FROM historia_clinica WHERE id = ? AND paciente_id = ? AND FechaBaja IS NULL', [entry_id, id], req.user.rol);
        if (entries.length === 0) {
            return res.status(404).json({ error: 'Ficha clínica no encontrada o anulada.' });
        }

        const entry = entries[0];

        // Security check
        if (req.user.rol !== 'superadmin' && req.user.rol !== 'admin' && entry.odontologo_id !== req.user.id) {
             return res.status(403).json({ error: 'No tienes permisos para adjuntar archivos a la ficha clínica de otro profesional.' });
        }

        const nombre_archivo = req.file.originalname;
        const ruta_archivo = `/uploads/${req.file.filename}`;
        const tipo_archivo = req.file.mimetype;

        await userDb.query(
            'INSERT INTO historia_clinica_archivo (historia_clinica_id, nombre_archivo, ruta_archivo, tipo_archivo, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, NOW())',
            [entry_id, nombre_archivo, ruta_archivo, tipo_archivo, req.user.nombre_usuario],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'HISTORIA_CLINICA_ARCHIVO', `Archivo ${nombre_archivo} adjuntado a Ficha ${entry_id} del paciente ID ${id}`, req);
        res.json({ message: 'Archivo subido con éxito', fileUrl: ruta_archivo });
    } catch (err) {
        console.error(err);
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
