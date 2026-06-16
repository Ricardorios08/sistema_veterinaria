const express = require('express');
const router = express.Router();
const userDb = require('../db/userDb');
const { logAction } = require('../utils/logger');

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
// GET /api/particulares  — listado con paginación y búsqueda
// ─────────────────────────────────────────────────
router.get('/', authenticateToken, async (req, res) => {
    try {
        const { search = '', page = 1, limit = 50 } = req.query;
        const offset = (parseInt(page) - 1) * parseInt(limit);

        let where = 'WHERE p.FechaBaja IS NULL';
        const params = [];

        if (search.trim()) {
            where += ' AND (p.apellido LIKE ? OR p.nombre LIKE ? OR p.documento LIKE ? OR p.telefono LIKE ? OR p.celular LIKE ?)';
            const q = `%${search.trim()}%`;
            params.push(q, q, q, q, q);
        }

        const countResult = await userDb.query(
            `SELECT COUNT(*) as total FROM particular p ${where}`, params
        );
        const total = countResult[0].total;

        const rows = await userDb.query(
            `SELECT p.id, p.cod_mevep, p.apellido, p.nombre, p.tipo_doc, p.documento,
                    p.telefono, p.celular, p.domicilio, p.localidad, p.departamento,
                    p.mail, p.sexo, p.fecha_ingreso, p.observaciones, p.prestador_id,
                    (SELECT COUNT(*) FROM mascota m WHERE m.particular_id = p.id AND m.FechaBaja IS NULL) as cant_mascotas
             FROM particular p ${where}
             ORDER BY p.apellido ASC, p.nombre ASC
             LIMIT ? OFFSET ?`,
            [...params, parseInt(limit), offset]
        );

        res.json({ total: Number(total), page: parseInt(page), data: rows });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/particulares/:id  — detalle + mascotas
// ─────────────────────────────────────────────────
router.get('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const rows = await userDb.query(
            'SELECT * FROM particular WHERE id = ? AND FechaBaja IS NULL', [id]
        );
        if (rows.length === 0) return res.status(404).json({ error: 'Particular no encontrado' });

        const mascotas = await userDb.query(
            `SELECT id, nombre, especie, raza, pelaje, tamanio, color, sexo, fecha_nac, origen
             FROM mascota WHERE particular_id = ? AND FechaBaja IS NULL ORDER BY nombre ASC`,
            [id]
        );

        res.json({ ...rows[0], mascotas });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// POST /api/particulares  — crear particular
// ─────────────────────────────────────────────────
router.post('/', authenticateToken, async (req, res) => {
    try {
        const { apellido, nombre, tipo_doc, documento, telefono, celular,
                domicilio, localidad, departamento, cod_postal, mail,
                sexo, fecha_ingreso, observaciones } = req.body;

        if (!apellido || !nombre) {
            return res.status(400).json({ error: 'Apellido y nombre son obligatorios' });
        }

        const result = await userDb.query(
            `INSERT INTO particular 
             (apellido, nombre, tipo_doc, documento, telefono, celular, domicilio,
              localidad, departamento, cod_postal, mail, sexo, fecha_ingreso,
              observaciones, prestador_id, CreacionUsuario, FechaCreacion)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())`,
            [apellido.trim(), nombre.trim(), tipo_doc || 'D.N.I', documento || null,
             telefono || null, celular || null, domicilio || null, localidad || null,
             departamento || null, cod_postal || null, mail || null, sexo || null,
             fecha_ingreso || null, observaciones || null,
             req.user.prestador_id || 1, req.user.nombre_usuario]
        );

        logAction(req.user.nombre_usuario, 'PARTICULAR_CREATE', `Nuevo particular: ${apellido} ${nombre}`, req);
        res.json({ message: 'OK', id: Number(result.insertId) });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// PUT /api/particulares/:id  — editar
// ─────────────────────────────────────────────────
router.put('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const { apellido, nombre, tipo_doc, documento, telefono, celular,
                domicilio, localidad, departamento, cod_postal, mail,
                sexo, fecha_ingreso, observaciones } = req.body;

        await userDb.query(
            `UPDATE particular SET
             apellido=?, nombre=?, tipo_doc=?, documento=?, telefono=?, celular=?,
             domicilio=?, localidad=?, departamento=?, cod_postal=?, mail=?, sexo=?,
             fecha_ingreso=?, observaciones=?, ModificacionUsuario=?, FechaModificacion=NOW()
             WHERE id=? AND FechaBaja IS NULL`,
            [apellido?.trim(), nombre?.trim(), tipo_doc || 'D.N.I', documento || null,
             telefono || null, celular || null, domicilio || null, localidad || null,
             departamento || null, cod_postal || null, mail || null, sexo || null,
             fecha_ingreso || null, observaciones || null, req.user.nombre_usuario, id]
        );

        logAction(req.user.nombre_usuario, 'PARTICULAR_UPDATE', `Particular ID ${id} modificado`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// DELETE /api/particulares/:id  — baja lógica
// ─────────────────────────────────────────────────
router.delete('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        await userDb.query(
            'UPDATE particular SET FechaBaja=NOW(), BajaUsuario=? WHERE id=?',
            [req.user.nombre_usuario, id]
        );
        logAction(req.user.nombre_usuario, 'PARTICULAR_DELETE', `Particular ID ${id} dado de baja`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
