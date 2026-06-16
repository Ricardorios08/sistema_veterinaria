const express = require('express');
const router = express.Router();
const userDb = require('../db/userDb');
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
                    s.prestador_id,
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
                sexo, fecha_ingreso, importe_cuota, observaciones } = req.body;

        if (!apellido || !nombre) {
            return res.status(400).json({ error: 'Apellido y nombre son obligatorios' });
        }

        const result = await userDb.query(
            `INSERT INTO socio 
             (apellido, nombre, tipo_doc, documento, telefono, celular, domicilio,
              localidad, departamento, cod_postal, mail, sexo, fecha_ingreso,
              importe_cuota, observaciones, prestador_id, CreacionUsuario, FechaCreacion)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())`,
            [apellido.trim(), nombre.trim(), tipo_doc || 'D.N.I', documento || null,
             telefono || null, celular || null, domicilio || null, localidad || null,
             departamento || null, cod_postal || null, mail || null, sexo || null,
             fecha_ingreso || null, parseFloat(importe_cuota) || 0, observaciones || null,
             req.user.prestador_id || 1, req.user.nombre_usuario]
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
                sexo, fecha_ingreso, importe_cuota, observaciones } = req.body;

        await userDb.query(
            `UPDATE socio SET
             apellido=?, nombre=?, tipo_doc=?, documento=?, telefono=?, celular=?,
             domicilio=?, localidad=?, departamento=?, cod_postal=?, mail=?, sexo=?,
             fecha_ingreso=?, importe_cuota=?, observaciones=?,
             ModificacionUsuario=?, FechaModificacion=NOW()
             WHERE id=? AND FechaBaja IS NULL`,
            [apellido?.trim(), nombre?.trim(), tipo_doc || 'D.N.I', documento || null,
             telefono || null, celular || null, domicilio || null, localidad || null,
             departamento || null, cod_postal || null, mail || null, sexo || null,
             fecha_ingreso || null, parseFloat(importe_cuota) || 0, observaciones || null,
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

module.exports = router;
