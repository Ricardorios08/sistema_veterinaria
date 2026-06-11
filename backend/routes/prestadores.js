const express = require('express');
const router = express.Router();
const userDb = require('../db/userDb');
const { logAction } = require('../utils/logger');

// Middleware to verify JWT token and superadmin role
const authenticateToken = (req, res, next) => {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];

    if (!token) return res.status(401).json({ error: 'Token no proporcionado' });

    const jwt = require('jsonwebtoken');
    const JWT_SECRET = process.env.JWT_SECRET || 'fallback_secret';
    jwt.verify(token, JWT_SECRET, (err, user) => {
        if (err) return res.status(403).json({ error: 'Token inválido o expirado' });
        req.user = user;
        
        // Exclusively allow superadmin
        if (user.rol !== 'superadmin') {
            return res.status(403).json({ error: 'Acceso denegado: se requiere rol de super-administrador' });
        }
        next();
    });
};

// Apply superadmin restriction to all endpoints in this router
router.use(authenticateToken);

// GET /api/prestadores (list all active institutions)
router.get('/', async (req, res) => {
    try {
        const rows = await userDb.query(
            'SELECT * FROM prestador WHERE FechaBaja IS NULL ORDER BY nombre ASC', 
            [], 
            req.user.rol
        );
        res.json(rows);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /api/prestadores (create institution)
router.post('/', async (req, res) => {
    const { nombre, sigla, cuit, direccion, telefono } = req.body;
    if (!nombre) return res.status(400).json({ error: 'El nombre es obligatorio' });

    try {
        const result = await userDb.query(
            `INSERT INTO prestador (nombre, sigla, cuit, direccion, telefono, CreacionUsuario, FechaCreacion) 
             VALUES (?, ?, ?, ?, ?, ?, NOW())`,
            [nombre, sigla || null, cuit || null, direccion || null, telefono || null, req.user.nombre_usuario],
            req.user.rol
        );

        const newPrestadorId = Number(result.insertId);

        // 1. Auto-link all active global Obras Sociales
        await userDb.query(
            `INSERT INTO prestador_obra_social (prestador_id, obra_social_id, CreacionUsuario, FechaCreacion)
             SELECT ?, id, ?, NOW() FROM obra_social WHERE FechaBaja IS NULL`,
            [newPrestadorId, req.user.nombre_usuario],
            req.user.rol
        );

        // 2. Auto-link all active Nomencladores with base prices from prestador 1
        await userDb.query(
            `INSERT INTO prestador_nomenclador (prestador_id, nomenclador_id, precio, CreacionUsuario, FechaCreacion)
             SELECT ?, nomenclador_id, precio, ?, NOW() FROM prestador_nomenclador WHERE prestador_id = 1 AND FechaBaja IS NULL`,
            [newPrestadorId, req.user.nombre_usuario],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'PRESTADOR_CREATE', `Institución creada: ${nombre} (ID: ${newPrestadorId})`, req);
        res.json({ message: 'Institución registrada con éxito', id: newPrestadorId });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// PUT /api/prestadores/:id (update institution)
router.put('/:id', async (req, res) => {
    const { id } = req.params;
    const { nombre, sigla, cuit, direccion, telefono } = req.body;
    if (!nombre) return res.status(400).json({ error: 'El nombre es obligatorio' });

    try {
        const check = await userDb.query('SELECT id FROM prestador WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Institución no encontrada' });

        await userDb.query(
            `UPDATE prestador 
             SET nombre = ?, sigla = ?, cuit = ?, direccion = ?, telefono = ?, 
                 ModificacionUsuario = ?, FechaModificacion = NOW() 
             WHERE id = ?`,
            [nombre, sigla || null, cuit || null, direccion || null, telefono || null, req.user.nombre_usuario, id],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'PRESTADOR_UPDATE', `Institución ID actualizada: ${id} (${nombre})`, req);
        res.json({ message: 'Institución actualizada con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// DELETE /api/prestadores/:id (logical delete of institution)
router.delete('/:id', async (req, res) => {
    const { id } = req.params;
    if (parseInt(id) === 1) {
        return res.status(400).json({ error: 'No se puede eliminar la institución por defecto' });
    }

    try {
        const check = await userDb.query('SELECT id FROM prestador WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Institución no encontrada' });

        await userDb.query(
            `UPDATE prestador 
             SET FechaBaja = NOW(), BajaUsuario = ? 
             WHERE id = ?`,
            [req.user.nombre_usuario, id],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'PRESTADOR_DELETE', `Institución ID eliminada: ${id}`, req);
        res.json({ message: 'Institución eliminada con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
