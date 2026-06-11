const fs = require('fs');
const path = require('path');

const pacPath = path.join(__dirname, '../backend/routes/pacientes.js');
let content = fs.readFileSync(pacPath, 'utf8');

// Normalize line endings
content = content.replace(/\r\n/g, '\n');

// 1. GET /
const oldGet = `// GET /api/pacientes (list or search)
router.get('/', authenticateToken, async (req, res) => {
    const { query } = req.query;
    try {
        let sql = \`
            SELECT p.*, 
                   os.nombre as cobertura_medica_nombre, 
                   os.sigla as cobertura_medica_sigla
            FROM paciente p
            LEFT JOIN obra_social os ON p.obra_social_id = os.id
            WHERE 1=1
        \`;
        let params = [];

        if (query) {
            sql += ' AND (p.nombre LIKE ? OR p.apellido LIKE ? OR p.dni LIKE ?)';
            const likeQuery = \`%\${query}%\`;
            params.push(likeQuery, likeQuery, likeQuery);
        }

        sql += ' ORDER BY p.apellido ASC, p.nombre ASC';
        const patients = await userDb.query(sql, params, req.user.rol);
        res.json(patients);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

const newGet = `// GET /api/pacientes (list or search)
router.get('/', authenticateToken, async (req, res) => {
    const { query } = req.query;
    try {
        let sql = \`
            SELECT p.*, 
                   os.nombre as cobertura_medica_nombre, 
                   os.sigla as cobertura_medica_sigla
            FROM paciente p
            LEFT JOIN obra_social os ON p.obra_social_id = os.id
            WHERE p.FechaBaja IS NULL
        \`;
        let params = [];

        if (req.user.rol !== 'superadmin') {
            sql += ' AND p.prestador_id = ?';
            params.push(req.user.prestador_id);
        }

        if (query) {
            sql += ' AND (p.nombre LIKE ? OR p.apellido LIKE ? OR p.dni LIKE ?)';
            const likeQuery = \`%\${query}%\`;
            params.push(likeQuery, likeQuery, likeQuery);
        }

        sql += ' ORDER BY p.apellido ASC, p.nombre ASC';
        const patients = await userDb.query(sql, params, req.user.rol);
        res.json(patients);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

if (content.includes(oldGet)) {
    content = content.replace(oldGet, newGet);
    console.log("-> Replaced GET / successfully.");
} else {
    console.error("-> COULD NOT find old GET / exactly.");
}

// 2. GET /:id
const oldGetId = `// GET /api/pacientes/:id (specific patient details)
router.get('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const patients = await userDb.query('SELECT * FROM paciente WHERE id = ?', [id], req.user.rol);
        if (patients.length === 0) return res.status(404).json({ error: 'Paciente no encontrado' });
        res.json(patients[0]);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

const newGetId = `// GET /api/pacientes/:id (specific patient details)
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
});`;

if (content.includes(oldGetId)) {
    content = content.replace(oldGetId, newGetId);
    console.log("-> Replaced GET /:id successfully.");
} else {
    console.error("-> COULD NOT find old GET /:id exactly.");
}

// 3. POST / (insert patient query)
const oldPost = `        await userDb.query(
            'INSERT INTO paciente (nombre, apellido, dni, telefono, email, fecha_nacimiento, cobertura_medica, numero_afiliado, obra_social_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                nombre, 
                apellido, 
                dni, 
                telefono || null, 
                email || null, 
                fecha_nacimiento || null, 
                cobertura_medica || null, 
                numero_afiliado || null,
                obra_social_id ? parseInt(obra_social_id) : null
            ],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'PACIENTE_CREATE', \`Paciente creado: \${nombre} \${apellido} (DNI: \${dni})\`, req);`;

const newPost = `        const finalPrestadorId = req.user.prestador_id || 1;
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

        logAction(req.user.nombre_usuario, 'PACIENTE_CREATE', \`Paciente creado: \${nombre} \${apellido} (DNI: \${dni}, Prestador ID: \${finalPrestadorId})\`, req);`;

if (content.includes(oldPost)) {
    content = content.replace(oldPost, newPost);
    console.log("-> Replaced POST / successfully.");
} else {
    console.error("-> COULD NOT find old POST / exactly.");
}

// 4. PUT /:id
const oldPut = `    try {
        // Check if DNI exists in another patient
        const existing = await userDb.query('SELECT id FROM paciente WHERE dni = ? AND id != ?', [dni, id], req.user.rol);
        if (existing.length > 0) {
            return res.status(400).json({ error: 'Ya existe otro paciente con este DNI' });
        }

        await userDb.query(
            'UPDATE paciente SET nombre = ?, apellido = ?, dni = ?, telefono = ?, email = ?, fecha_nacimiento = ?, cobertura_medica = ?, numero_afiliado = ?, obra_social_id = ? WHERE id = ?',
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
                id
            ],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'PACIENTE_UPDATE', \`Paciente ID actualizado: \${id} (\${nombre} \${apellido})\`, req);`;

const newPut = `    try {
        // Check isolation
        const check = await userDb.query('SELECT id, prestador_id FROM paciente WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Paciente no encontrado o dado de baja' });
        if (req.user.rol !== 'superadmin' && check[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para modificar este paciente de otra institución' });
        }

        // Check if DNI exists in another patient
        const existing = await userDb.query('SELECT id FROM paciente WHERE dni = ? AND id != ? AND FechaBaja IS NULL', [dni, id], req.user.rol);
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

        logAction(req.user.nombre_usuario, 'PACIENTE_UPDATE', \`Paciente ID actualizado: \${id} (\${nombre} \${apellido})\`, req);`;

if (content.includes(oldPut)) {
    content = content.replace(oldPut, newPut);
    console.log("-> Replaced PUT /:id successfully.");
} else {
    console.error("-> COULD NOT find old PUT /:id exactly.");
}

// 5. DELETE /:id
const oldDelete = `// DELETE /api/pacientes/:id (delete patient - admin only)
router.delete('/:id', authenticateToken, isAdmin, async (req, res) => {
    const { id } = req.params;
    try {
        await userDb.query('DELETE FROM paciente WHERE id = ?', [id], req.user.rol);
        logAction(req.user.nombre_usuario, 'PACIENTE_DELETE', \`Paciente eliminado ID: \${id}\`, req);
        res.json({ message: 'Paciente eliminado con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

const newDelete = `// DELETE /api/pacientes/:id (delete patient - admin only)
router.delete('/:id', authenticateToken, isAdmin, async (req, res) => {
    const { id } = req.params;
    try {
        const check = await userDb.query('SELECT id, prestador_id FROM paciente WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Paciente no encontrado o ya eliminado' });
        if (req.user.rol !== 'superadmin' && check[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para eliminar este paciente de otra institución' });
        }

        await userDb.query('UPDATE paciente SET FechaBaja = NOW(), BajaUsuario = ? WHERE id = ?', [req.user.nombre_usuario, id], req.user.rol);
        logAction(req.user.nombre_usuario, 'PACIENTE_DELETE', \`Paciente eliminado lógicamente ID: \${id}\`, req);
        res.json({ message: 'Paciente eliminado con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

if (content.includes(oldDelete)) {
    content = content.replace(oldDelete, newDelete);
    console.log("-> Replaced DELETE /:id successfully.");
} else {
    console.error("-> COULD NOT find old DELETE /:id exactly.");
}

// 6. GET /:id/historia
const oldGetHistoria = `// GET /api/pacientes/:id/historia (patient medical history)
router.get('/:id/historia', authenticateToken, async (req, res) => {
    const { id } = req.params;
    try {
        // Query history entries
        const historyEntries = await userDb.query(
            \`SELECT hc.*, u.nombre_usuario as odontologo_nombre 
             FROM historia_clinica hc 
             LEFT JOIN user u ON hc.odontologo_id = u.id 
             WHERE hc.paciente_id = ? 
             ORDER BY hc.fecha DESC\`,
            [id],
            req.user.rol
        );`;

const newGetHistoria = `// GET /api/pacientes/:id/historia (patient medical history)
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
            \`SELECT hc.*, u.nombre_usuario as odontologo_nombre 
             FROM historia_clinica hc 
             LEFT JOIN user u ON hc.odontologo_id = u.id 
             WHERE hc.paciente_id = ? AND hc.FechaBaja IS NULL
             ORDER BY hc.fecha DESC\`,
            [id],
            req.user.rol
        );`;

if (content.includes(oldGetHistoria)) {
    content = content.replace(oldGetHistoria, newGetHistoria);
    console.log("-> Replaced GET /:id/historia successfully.");
} else {
    console.error("-> COULD NOT find old GET /:id/historia exactly.");
}

// 7. POST /:id/historia
const oldPostHistoria = `// POST /api/pacientes/:id/historia (add history entry and treatments)
router.post('/:id/historia', authenticateToken, async (req, res) => {
    const { id } = req.params; // paciente_id
    const { diagnostico, observaciones, tratamientos } = req.body; // tratamientos = array of { nomenclador_id, diente_numero, cara, notas }

    try {
        // 1. Insert history entry
        const insertHc = await userDb.query(
            'INSERT INTO historia_clinica (paciente_id, odontologo_id, diagnostico, observaciones) VALUES (?, ?, ?, ?)',
            [id, req.user.id, diagnostico || null, observaciones || null],
            req.user.rol
        );

        const insertId = Number(insertHc.insertId);

        // 2. Insert treatments if any
        if (tratamientos && Array.isArray(tratamientos)) {
            for (const treat of tratamientos) {
                await userDb.query(
                    'INSERT INTO tratamiento_realizado (historia_clinica_id, nomenclador_id, diente_numero, cara, notas) VALUES (?, ?, ?, ?, ?)',
                    [insertId, treat.nomenclador_id, treat.diente_numero || null, treat.cara || null, treat.notes || null], // Note: previous code had 'treat.notes' or 'treat.notas'
                    req.user.rol
                );`;

// Wait, let's verify if original has treat.notas or treat.notes or how it's formatted. In our view_file, line 223 was:
// [insertId, treat.nomenclador_id, treat.diente_numero || null, treat.cara || null, treat.notas || null]
// Let's make sure we match it exactly. Let's write the search and replace dynamically using regex or simpler string replacement.

const oldPostHistoriaSimple = `        // 1. Insert history entry
        const insertHc = await userDb.query(
            'INSERT INTO historia_clinica (paciente_id, odontologo_id, diagnostico, observaciones) VALUES (?, ?, ?, ?)',
            [id, req.user.id, diagnostico || null, observaciones || null],
            req.user.rol
        );`;

const newPostHistoriaSimple = `        // Security check
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
        );`;

if (content.includes(oldPostHistoriaSimple)) {
    content = content.replace(oldPostHistoriaSimple, newPostHistoriaSimple);
    console.log("-> Replaced POST /:id/historia insert successfully.");
} else {
    console.error("-> COULD NOT find old POST /:id/historia insert exactly.");
}

// Update treatment insert and odontogram insert inside the history post handler
const oldTreatmentInsert = `                await userDb.query(
                    'INSERT INTO tratamiento_realizado (historia_clinica_id, nomenclador_id, diente_numero, cara, notas) VALUES (?, ?, ?, ?, ?)',
                    [insertId, treat.nomenclador_id, treat.diente_numero || null, treat.cara || null, treat.notas || null],
                    req.user.rol
                );`;

const newTreatmentInsert = `                await userDb.query(
                    'INSERT INTO tratamiento_realizado (historia_clinica_id, nomenclador_id, diente_numero, cara, notas, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())',
                    [insertId, treat.nomenclador_id, treat.diente_numero || null, treat.cara || null, treat.notas || null, finalPrestadorId, req.user.nombre_usuario],
                    req.user.rol
                );`;

if (content.includes(oldTreatmentInsert)) {
    content = content.replace(oldTreatmentInsert, newTreatmentInsert);
    console.log("-> Replaced treatment insert successfully.");
} else {
    console.error("-> COULD NOT find old treatment insert exactly.");
}

const oldOdontogramUpdateInHc = `                    // Insert or Update in odontograma table
                    await userDb.query(
                        \`INSERT INTO odontograma (paciente_id, diente_numero, cara, estado, notas) 
                         VALUES (?, ?, ?, ?, ?) 
                         ON DUPLICATE KEY UPDATE estado = VALUES(estado), notas = VALUES(notas)\`,
                        [id, treat.diente_numero, cara, targetState, treat.notas || \`Tratado mediante ficha clínica #\${insertId}\`],
                        req.user.rol
                    );`;

const newOdontogramUpdateInHc = `                    // Insert or Update in odontograma table
                    await userDb.query(
                        \`INSERT INTO odontograma (paciente_id, diente_numero, cara, estado, notas, prestador_id, CreacionUsuario, FechaCreacion) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, NOW()) 
                         ON DUPLICATE KEY UPDATE estado = VALUES(estado), notas = VALUES(notas), ModificacionUsuario = VALUES(CreacionUsuario), FechaModificacion = NOW()\`,
                        [id, treat.diente_numero, cara, targetState, treat.notas || \`Tratado mediante ficha clínica #\${insertId}\`, finalPrestadorId, req.user.nombre_usuario],
                        req.user.rol
                    );`;

if (content.includes(oldOdontogramUpdateInHc)) {
    content = content.replace(oldOdontogramUpdateInHc, newOdontogramUpdateInHc);
    console.log("-> Replaced odontogram update inside HC successfully.");
} else {
    console.error("-> COULD NOT find old odontogram update inside HC exactly.");
}

// 8. PUT /:id/historia/:entry_id/anular
const oldAnnul = `        await userDb.query(
            \`UPDATE historia_clinica 
             SET anulado = 1, motivo_anulacion = ?, fecha_anulacion = ? 
             WHERE id = ?\`,
            [motivo_anulacion, annulledTime, entry_id],
            req.user.rol
        );`;

const newAnnul = `        await userDb.query(
            \`UPDATE historia_clinica 
             SET anulado = 1, motivo_anulacion = ?, fecha_anulacion = ?, FechaBaja = NOW(), BajaUsuario = ? 
             WHERE id = ?\`,
            [motivo_anulacion, annulledTime, req.user.nombre_usuario, entry_id],
            req.user.rol
        );`;

if (content.includes(oldAnnul)) {
    content = content.replace(oldAnnul, newAnnul);
    console.log("-> Replaced history annul successfully.");
} else {
    console.error("-> COULD NOT find old history annul exactly.");
}

// 9. GET /:id/odontograma
const oldGetOdontogram = `// GET /api/pacientes/:id/odontograma (patient odontogram)
router.get('/:id/odontograma', authenticateToken, async (req, res) => {
    const { id } = req.params;
    try {
        const teeth = await userDb.query('SELECT * FROM odontograma WHERE paciente_id = ?', [id], req.user.rol);
        res.json(teeth);`;

const newGetOdontogram = `// GET /api/pacientes/:id/odontograma (patient odontogram)
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
        res.json(teeth);`;

if (content.includes(oldGetOdontogram)) {
    content = content.replace(oldGetOdontogram, newGetOdontogram);
    console.log("-> Replaced GET /:id/odontograma successfully.");
} else {
    console.error("-> COULD NOT find old GET /:id/odontograma exactly.");
}

// 10. POST /:id/odontograma
const oldPostOdontogram = `// POST /api/pacientes/:id/odontograma (update tooth state directly)
router.post('/:id/odontograma', authenticateToken, async (req, res) => {
    const { id } = req.params;
    const { diente_numero, cara, estado, notas } = req.body;

    if (!diente_numero || !estado) {
        return res.status(400).json({ error: 'Número de diente y estado son obligatorios' });
    }

    try {
        const targetCara = cara || 'general';
        await userDb.query(
            \`INSERT INTO odontograma (paciente_id, diente_numero, cara, estado, notas) 
             VALUES (?, ?, ?, ?, ?) 
             ON DUPLICATE KEY UPDATE estado = VALUES(estado), notas = VALUES(notas)\`,
            [id, diente_numero, targetCara, estado, notas || null],
            req.user.rol
        );`;

const newPostOdontogram = `// POST /api/pacientes/:id/odontograma (update tooth state directly)
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
            \`INSERT INTO odontograma (paciente_id, diente_numero, cara, estado, notas, prestador_id, CreacionUsuario, FechaCreacion) 
             VALUES (?, ?, ?, ?, ?, ?, ?, NOW()) 
             ON DUPLICATE KEY UPDATE estado = VALUES(estado), notas = VALUES(notas), ModificacionUsuario = VALUES(CreacionUsuario), FechaModificacion = NOW()\`,
            [id, diente_numero, targetCara, estado, notas || null, finalPrestadorId, req.user.nombre_usuario],
            req.user.rol
        );`;

if (content.includes(oldPostOdontogram)) {
    content = content.replace(oldPostOdontogram, newPostOdontogram);
    console.log("-> Replaced POST /:id/odontograma successfully.");
} else {
    console.error("-> COULD NOT find old POST /:id/odontograma exactly.");
}

fs.writeFileSync(pacPath, content, 'utf8');
console.log("=== COMPLETED PACIENTES ROUTE REPLACEMENTS ===");
