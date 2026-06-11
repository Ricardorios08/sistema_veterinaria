const fs = require('fs');
const path = require('path');

const obrasPath = path.join(__dirname, '../backend/routes/obrasSociales.js');
let content = fs.readFileSync(obrasPath, 'utf8');

// Normalize line endings
content = content.replace(/\r\n/g, '\n');

// 1. GET /
const oldGet = `        let sql = 'SELECT * FROM obra_social';
        let params = [];

        if (query) {
            sql += ' WHERE nombre LIKE ? OR sigla LIKE ?';
            const likeQuery = \`%\${query}%\`;
            params.push(likeQuery, likeQuery);
        }

        sql += ' ORDER BY nombre ASC';`;

const newGet = `        let sql = 'SELECT * FROM obra_social WHERE FechaBaja IS NULL';
        let params = [];

        if (query) {
            sql += ' AND (nombre LIKE ? OR sigla LIKE ?)';
            const likeQuery = \`%\${query}%\`;
            params.push(likeQuery, likeQuery);
        }

        sql += ' ORDER BY nombre ASC';`;

if (content.includes(oldGet)) {
    content = content.replace(oldGet, newGet);
    console.log("-> Replaced GET / successfully.");
} else {
    console.error("-> COULD NOT find old GET / exactly.");
}

// 2. POST uniqueness check
const oldPostCheck = `        // Check uniqueness
        const existing = await userDb.query('SELECT id FROM obra_social WHERE nombre = ?', [nombre], req.user.rol);`;

const newPostCheck = `        // Check uniqueness
        const existing = await userDb.query('SELECT id FROM obra_social WHERE nombre = ? AND FechaBaja IS NULL', [nombre], req.user.rol);`;

if (content.includes(oldPostCheck)) {
    content = content.replace(oldPostCheck, newPostCheck);
    console.log("-> Replaced POST uniqueness check successfully.");
} else {
    console.error("-> COULD NOT find old POST uniqueness check exactly.");
}

// 3. POST insert
const oldPostInsert = `        await userDb.query(
            'INSERT INTO obra_social (nombre, sigla, descripcion) VALUES (?, ?, ?)',
            [nombre, sigla || null, descripcion || null],
            req.user.rol
        );`;

const newPostInsert = `        await userDb.query(
            'INSERT INTO obra_social (nombre, sigla, descripcion, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, NOW())',
            [nombre, sigla || null, descripcion || null, req.user.nombre_usuario],
            req.user.rol
        );`;

if (content.includes(oldPostInsert)) {
    content = content.replace(oldPostInsert, newPostInsert);
    console.log("-> Replaced POST insert successfully.");
} else {
    console.error("-> COULD NOT find old POST insert exactly.");
}

// 4. PUT uniqueness check
const oldPutCheck = `        // Check uniqueness for others
        const existing = await userDb.query('SELECT id FROM obra_social WHERE nombre = ? AND id != ?', [nombre, id], req.user.rol);`;

const newPutCheck = `        // Check uniqueness for others
        const existing = await userDb.query('SELECT id FROM obra_social WHERE nombre = ? AND id != ? AND FechaBaja IS NULL', [nombre, id], req.user.rol);`;

if (content.includes(oldPutCheck)) {
    content = content.replace(oldPutCheck, newPutCheck);
    console.log("-> Replaced PUT uniqueness check successfully.");
} else {
    console.error("-> COULD NOT find old PUT uniqueness check exactly.");
}

// 5. PUT update
const oldPutUpdate = `        await userDb.query(
            'UPDATE obra_social SET nombre = ?, sigla = ?, descripcion = ? WHERE id = ?',
            [nombre, sigla || null, descripcion || null, id],
            req.user.rol
        );`;

const newPutUpdate = `        await userDb.query(
            'UPDATE obra_social SET nombre = ?, sigla = ?, descripcion = ?, ModificacionUsuario = ?, FechaModificacion = NOW() WHERE id = ?',
            [nombre, sigla || null, descripcion || null, req.user.nombre_usuario, id],
            req.user.rol
        );`;

if (content.includes(oldPutUpdate)) {
    content = content.replace(oldPutUpdate, newPutUpdate);
    console.log("-> Replaced PUT update successfully.");
} else {
    console.error("-> COULD NOT find old PUT update exactly.");
}

// 6. DELETE delete
const oldDelete = `// DELETE /api/obras-sociales/:id (delete - admin only)
router.delete('/:id', authenticateToken, isAdmin, async (req, res) => {
    const { id } = req.params;
    try {
        await userDb.query('DELETE FROM obra_social WHERE id = ?', [id], req.user.rol);
        logAction(req.user.nombre_usuario, 'OBRA_SOCIAL_DELETE', \`Obra Social eliminada ID: \${id}\`, req);
        res.json({ message: 'Obra Social eliminada con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

const newDelete = `// DELETE /api/obras-sociales/:id (delete - admin only)
router.delete('/:id', authenticateToken, isAdmin, async (req, res) => {
    const { id } = req.params;
    try {
        await userDb.query('UPDATE obra_social SET FechaBaja = NOW(), BajaUsuario = ? WHERE id = ?', [req.user.nombre_usuario, id], req.user.rol);
        logAction(req.user.nombre_usuario, 'OBRA_SOCIAL_DELETE', \`Obra Social eliminada ID: \${id}\`, req);
        res.json({ message: 'Obra Social eliminada con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

if (content.includes(oldDelete)) {
    content = content.replace(oldDelete, newDelete);
    console.log("-> Replaced DELETE successfully.");
} else {
    console.error("-> COULD NOT find old DELETE exactly.");
}

fs.writeFileSync(obrasPath, content, 'utf8');
console.log("=== COMPLETED OBRAS SOCIALES ROUTE REPLACEMENTS ===");
