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

// GET /api/nomenclador (list practices)
router.get('/', authenticateToken, async (req, res) => {
    const { catalog, categoria } = req.query;
    try {
        let sql = '';
        let params = [];
        
        if (req.user.rol === 'superadmin' || catalog === 'true') {
            sql = "SELECT n.*, NULL as precio FROM nomenclador n WHERE n.FechaBaja IS NULL AND n.tipo = 'publica'";
        } else {
            sql = `SELECT n.*, pn.precio FROM nomenclador n
                   JOIN prestador_nomenclador pn ON n.id = pn.nomenclador_id
                   WHERE n.FechaBaja IS NULL AND pn.FechaBaja IS NULL AND pn.prestador_id = ?`;
            params.push(req.user.prestador_id || 1);
        }

        if (categoria) {
            sql += ' AND n.categoria = ?';
            params.push(categoria);
        }
        
        sql += ' ORDER BY n.codigo ASC';
        const practices = await userDb.query(sql, params, req.user.rol);
        res.json(practices);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /api/nomenclador (create or link practice)
router.post('/', authenticateToken, isAdmin, async (req, res) => {
    const { codigo, nombre, descripcion, precio, categoria } = req.body;
    const finalCategoria = categoria || 'odontologico';

    if (!codigo || !nombre || precio === undefined) {
        return res.status(400).json({ error: 'Código, nombre y precio son obligatorios' });
    }

    try {
        const finalPrestadorId = req.user.prestador_id || 1;
        
        const { tipo } = req.body;
        const finalTipo = tipo === 'privada' ? 'privada' : 'publica';

        // 1. Check if the nomenclador exists globally or privately
        let existingGlobal;
        if (finalTipo === 'privada') {
            existingGlobal = await userDb.query(
                "SELECT id FROM nomenclador WHERE codigo = ? AND categoria = ? AND tipo = 'privada' AND prestador_id = ? AND FechaBaja IS NULL", 
                [codigo, finalCategoria, finalPrestadorId], 
                req.user.rol
            );
        } else {
            existingGlobal = await userDb.query(
                "SELECT id FROM nomenclador WHERE codigo = ? AND categoria = ? AND tipo = 'publica' AND FechaBaja IS NULL", 
                [codigo, finalCategoria], 
                req.user.rol
            );
        }
        
        let nomencladorId;
        if (existingGlobal.length > 0) {
            nomencladorId = existingGlobal[0].id;
        } else {
            // Create globally or privately
            const insertNom = await userDb.query(
                "INSERT INTO nomenclador (codigo, nombre, descripcion, categoria, tipo, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())",
                [codigo.trim(), nombre.trim(), descripcion || null, finalCategoria, finalTipo, finalTipo === 'privada' ? finalPrestadorId : null, req.user.nombre_usuario],
                req.user.rol
            );
            nomencladorId = insertNom.insertId;
        }

        // 2. Check if relation exists for this prestador
        const existingRelation = await userDb.query(
            'SELECT id, FechaBaja FROM prestador_nomenclador WHERE prestador_id = ? AND nomenclador_id = ?',
            [finalPrestadorId, nomencladorId],
            req.user.rol
        );

        if (existingRelation.length > 0) {
            if (existingRelation[0].FechaBaja !== null) {
                // Reactivate and update price
                await userDb.query(
                    'UPDATE prestador_nomenclador SET FechaBaja = NULL, BajaUsuario = NULL, precio = ?, CreacionUsuario = ?, FechaCreacion = NOW() WHERE id = ?',
                    [precio, req.user.nombre_usuario, existingRelation[0].id],
                    req.user.rol
                );
            } else {
                return res.status(400).json({ error: 'Ya tienes este código del nomenclador vinculado a tu institución' });
            }
        } else {
            // Insert relation
            await userDb.query(
                'INSERT INTO prestador_nomenclador (prestador_id, nomenclador_id, precio, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, NOW())',
                [finalPrestadorId, nomencladorId, precio, req.user.nombre_usuario],
                req.user.rol
            );
        }

        logAction(req.user.nombre_usuario, 'NOMENCLADOR_CREATE', `Práctica nomenclador vinculada: ${codigo} - ${nombre} (${finalCategoria}) ($${precio}) (Prestador ID: ${finalPrestadorId})`, req);
        res.json({ message: 'Práctica agregada con éxito al nomenclador de la institución' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// PUT /api/nomenclador/:id (update price or global metadata)
router.put('/:id', authenticateToken, isAdmin, async (req, res) => {
    const { id } = req.params; // nomenclador_id
    const { precio, codigo, nombre, descripcion, categoria } = req.body;
    
    try {
        const finalPrestadorId = req.user.prestador_id || 1;

        // Check relationship exists
        const relCheck = await userDb.query(
            'SELECT id FROM prestador_nomenclador WHERE prestador_id = ? AND nomenclador_id = ? AND FechaBaja IS NULL',
            [finalPrestadorId, id],
            req.user.rol
        );
        if (relCheck.length === 0) return res.status(404).json({ error: 'Relación con el nomenclador no encontrada' });

        // Update the price for this institution
        if (precio !== undefined) {
            await userDb.query(
                'UPDATE prestador_nomenclador SET precio = ?, ModificacionUsuario = ?, FechaModificacion = NOW() WHERE id = ?',
                [precio, req.user.nombre_usuario, relCheck[0].id],
                req.user.rol
            );
        }

        // If superadmin or if it is a private practice belonging to this prestador, update catalog metadata (codigo, nombre, descripcion, categoria)
        const currentNom = await userDb.query('SELECT * FROM nomenclador WHERE id = ?', [id], req.user.rol);
        const isOwnerOfPrivate = currentNom.length > 0 && currentNom[0].tipo === 'privada' && currentNom[0].prestador_id === finalPrestadorId;
        const canEditMetadata = req.user.rol === 'superadmin' || isOwnerOfPrivate;

        if (canEditMetadata && (codigo || nombre || categoria)) {
            const targetCat = categoria || (currentNom.length > 0 ? currentNom[0].categoria : 'odontologico');
            const targetCode = codigo || (currentNom.length > 0 ? currentNom[0].codigo : '');

            if (codigo || categoria) {
                let existing;
                if (isOwnerOfPrivate) {
                    existing = await userDb.query(
                        "SELECT id FROM nomenclador WHERE codigo = ? AND categoria = ? AND tipo = 'privada' AND prestador_id = ? AND id != ? AND FechaBaja IS NULL",
                        [targetCode, targetCat, finalPrestadorId, id],
                        req.user.rol
                    );
                } else {
                    existing = await userDb.query(
                        "SELECT id FROM nomenclador WHERE codigo = ? AND categoria = ? AND tipo = 'publica' AND id != ? AND FechaBaja IS NULL",
                        [targetCode, targetCat, id],
                        req.user.rol
                    );
                }
                if (existing.length > 0) {
                    return res.status(400).json({ error: 'Ya existe otra práctica con este código y categoría en el catálogo' });
                }
            }

            await userDb.query(
                'UPDATE nomenclador SET codigo = COALESCE(?, codigo), nombre = COALESCE(?, nombre), descripcion = COALESCE(?, descripcion), categoria = COALESCE(?, categoria), ModificacionUsuario = ?, FechaModificacion = NOW() WHERE id = ?',
                [codigo || null, nombre || null, descripcion || null, categoria || null, req.user.nombre_usuario, id],
                req.user.rol
            );
        }

        logAction(req.user.nombre_usuario, 'NOMENCLADOR_UPDATE', `Práctica nomenclador ID ${id} actualizada para Prestador ${finalPrestadorId}`, req);
        res.json({ message: 'Práctica actualizada con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// DELETE /api/nomenclador/:id (unlink practice)
router.delete('/:id', authenticateToken, isAdmin, async (req, res) => {
    const { id } = req.params; // nomenclador_id
    try {
        const finalPrestadorId = req.user.prestador_id || 1;

        const check = await userDb.query(
            'SELECT id FROM prestador_nomenclador WHERE prestador_id = ? AND nomenclador_id = ? AND FechaBaja IS NULL',
            [finalPrestadorId, id],
            req.user.rol
        );
        if (check.length === 0) return res.status(404).json({ error: 'Práctica no vinculada o ya desvinculada de esta institución' });

        await userDb.query(
            'UPDATE prestador_nomenclador SET FechaBaja = NOW(), BajaUsuario = ? WHERE id = ?',
            [req.user.nombre_usuario, check[0].id],
            req.user.rol
        );

        // Si es una práctica privada de este prestador, también la damos de baja en el nomenclador global
        const currentNom = await userDb.query('SELECT * FROM nomenclador WHERE id = ?', [id], req.user.rol);
        if (currentNom.length > 0 && currentNom[0].tipo === 'privada' && currentNom[0].prestador_id === finalPrestadorId) {
            await userDb.query(
                'UPDATE nomenclador SET FechaBaja = NOW(), BajaUsuario = ? WHERE id = ?',
                [req.user.nombre_usuario, id],
                req.user.rol
            );
        }

        logAction(req.user.nombre_usuario, 'NOMENCLADOR_DELETE', `Práctica desvinculada ID: ${id} para el prestador: ${finalPrestadorId}`, req);
        res.json({ message: 'Práctica desvinculada del nomenclador institucional con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
