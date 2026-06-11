const express = require('express');
const router = express.Router();
const userDb = require('../db/userDb');
const { logAction } = require('../utils/logger');

// Middleware to verify JWT token
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

// GET /api/obras-sociales (list all)
router.get('/', authenticateToken, async (req, res) => {
    const { query, catalog } = req.query;
    try {
        let sql = '';
        let params = [];

        if (req.user.rol === 'superadmin' || catalog === 'true') {
            sql = "SELECT os.* FROM obra_social os WHERE os.FechaBaja IS NULL AND os.tipo = 'publica'";
        } else {
            sql = `SELECT os.* FROM obra_social os 
                   JOIN prestador_obra_social pos ON os.id = pos.obra_social_id 
                   WHERE os.FechaBaja IS NULL AND pos.FechaBaja IS NULL AND pos.prestador_id = ?`;
            params.push(req.user.prestador_id || 1);
        }

        if (query) {
            sql += ' AND (os.nombre LIKE ? OR os.sigla LIKE ?)';
            const likeQuery = `%${query}%`;
            params.push(likeQuery, likeQuery);
        }

        sql += ' ORDER BY os.nombre ASC';
        const rows = await userDb.query(sql, params, req.user.rol);
        res.json(rows);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /api/obras-sociales (create or link)
router.post('/', authenticateToken, async (req, res) => {
    const { nombre, sigla, descripcion, tipo } = req.body;
    const finalTipo = tipo === 'privada' ? 'privada' : 'publica';

    if (!nombre) {
        return res.status(400).json({ error: 'El nombre de la Obra Social es obligatorio' });
    }

    try {
        const finalPrestadorId = req.user.prestador_id || 1;
        
        let osId;
        if (finalTipo === 'publica') {
            // 1. Check if it already exists globally as public
            const existingGlobal = await userDb.query(
                "SELECT id FROM obra_social WHERE nombre = ? AND tipo = 'publica' AND FechaBaja IS NULL", 
                [nombre], 
                req.user.rol
            );
            
            if (existingGlobal.length > 0) {
                osId = existingGlobal[0].id;
            } else {
                // Create globally
                const insertOs = await userDb.query(
                    "INSERT INTO obra_social (nombre, sigla, descripcion, tipo, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, 'publica', NULL, ?, NOW())",
                    [nombre.trim(), sigla || null, descripcion || null, req.user.nombre_usuario],
                    req.user.rol
                );
                osId = insertOs.insertId;
            }
        } else {
            // 2. Check if private one exists for this clinic
            const existingPrivate = await userDb.query(
                "SELECT id FROM obra_social WHERE nombre = ? AND tipo = 'privada' AND prestador_id = ? AND FechaBaja IS NULL",
                [nombre, finalPrestadorId],
                req.user.rol
            );

            if (existingPrivate.length > 0) {
                osId = existingPrivate[0].id;
            } else {
                // Create private
                const insertOs = await userDb.query(
                    "INSERT INTO obra_social (nombre, sigla, descripcion, tipo, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, 'privada', ?, ?, NOW())",
                    [nombre.trim(), sigla || null, descripcion || null, finalPrestadorId, req.user.nombre_usuario],
                    req.user.rol
                );
                osId = insertOs.insertId;
            }
        }

        // 3. Link relationship
        const existingRelation = await userDb.query(
            'SELECT id, FechaBaja FROM prestador_obra_social WHERE prestador_id = ? AND obra_social_id = ?',
            [finalPrestadorId, osId],
            req.user.rol
        );

        if (existingRelation.length > 0) {
            if (existingRelation[0].FechaBaja !== null) {
                // Reactivate relationship
                await userDb.query(
                    'UPDATE prestador_obra_social SET FechaBaja = NULL, BajaUsuario = NULL, CreacionUsuario = ?, FechaCreacion = NOW() WHERE id = ?',
                    [req.user.nombre_usuario, existingRelation[0].id],
                    req.user.rol
                );
            } else {
                return res.status(400).json({ error: 'Ya tienes esta Obra Social vinculada a tu institución' });
            }
        } else {
            // Insert relationship
            await userDb.query(
                'INSERT INTO prestador_obra_social (prestador_id, obra_social_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, NOW())',
                [finalPrestadorId, osId, req.user.nombre_usuario],
                req.user.rol
            );
        }

        logAction(req.user.nombre_usuario, 'OBRA_SOCIAL_CREATE', `Obra Social vinculada: ${nombre} (${finalTipo}) (Prestador ID: ${finalPrestadorId})`, req);
        res.json({ message: 'Obra Social vinculada con éxito', id: osId });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// PUT /api/obras-sociales/:id (update details)
router.put('/:id', authenticateToken, async (req, res) => {
    const { id } = req.params;
    const { nombre, sigla, descripcion } = req.body;
    if (!nombre) {
        return res.status(400).json({ error: 'El nombre de la Obra Social es obligatorio' });
    }

    try {
        const check = await userDb.query('SELECT * FROM obra_social WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (check.length === 0) return res.status(404).json({ error: 'Obra Social no encontrada' });

        const finalPrestadorId = req.user.prestador_id || 1;

        // Verify permission: Only superadmin can edit public ones, other admins can edit their own private ones
        if (check[0].tipo === 'publica' && req.user.rol !== 'superadmin') {
            return res.status(403).json({ error: 'No tienes permisos para modificar una Obra Social del catálogo global' });
        }
        if (check[0].tipo === 'privada' && check[0].prestador_id !== finalPrestadorId && req.user.rol !== 'superadmin') {
            return res.status(403).json({ error: 'No tienes permisos para modificar esta Obra Social privada' });
        }

        // Check uniqueness in same category
        let uniquenessQuery = '';
        let uniquenessParams = [];
        if (check[0].tipo === 'publica') {
            uniquenessQuery = "SELECT id FROM obra_social WHERE nombre = ? AND tipo = 'publica' AND id != ? AND FechaBaja IS NULL";
            uniquenessParams = [nombre, id];
        } else {
            uniquenessQuery = "SELECT id FROM obra_social WHERE nombre = ? AND tipo = 'privada' AND prestador_id = ? AND id != ? AND FechaBaja IS NULL";
            uniquenessParams = [nombre, finalPrestadorId, id];
        }

        const existing = await userDb.query(uniquenessQuery, uniquenessParams, req.user.rol);
        if (existing.length > 0) {
            return res.status(400).json({ error: 'Ya existe otra Obra Social registrada con ese nombre en esta categoría' });
        }

        await userDb.query(
            'UPDATE obra_social SET nombre = ?, sigla = ?, descripcion = ?, ModificacionUsuario = ?, FechaModificacion = NOW() WHERE id = ?',
            [nombre, sigla || null, descripcion || null, req.user.nombre_usuario, id],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'OBRA_SOCIAL_UPDATE', `Obra Social ID actualizada: ${id} (${nombre})`, req);
        res.json({ message: 'Obra Social actualizada con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// DELETE /api/obras-sociales/:id (unlink)
router.delete('/:id', authenticateToken, isAdmin, async (req, res) => {
    const { id } = req.params;
    try {
        const finalPrestadorId = req.user.prestador_id || 1;
        
        const check = await userDb.query(
            'SELECT id FROM prestador_obra_social WHERE prestador_id = ? AND obra_social_id = ? AND FechaBaja IS NULL',
            [finalPrestadorId, id],
            req.user.rol
        );
        if (check.length === 0) return res.status(404).json({ error: 'Obra Social no vinculada o ya desvinculada de esta institución' });

        await userDb.query(
            'UPDATE prestador_obra_social SET FechaBaja = NOW(), BajaUsuario = ? WHERE id = ?',
            [req.user.nombre_usuario, check[0].id],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'OBRA_SOCIAL_DELETE', `Obra Social desvinculada ID: ${id} del prestador: ${finalPrestadorId}`, req);
        res.json({ message: 'Obra Social desvinculada con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
