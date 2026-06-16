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
// GET /api/mascotas  — listado con filtros
// ─────────────────────────────────────────────────
router.get('/', authenticateToken, async (req, res) => {
    try {
        const { search = '', especie = '', page = 1, limit = 50, socio_id, particular_id } = req.query;
        const offset = (parseInt(page) - 1) * parseInt(limit);

        let where = 'WHERE m.FechaBaja IS NULL';
        const params = [];

        if (search.trim()) {
            where += ' AND (m.nombre LIKE ? OR m.raza LIKE ? OR s.apellido LIKE ? OR s.nombre LIKE ? OR p.apellido LIKE ? OR p.nombre LIKE ?)';
            const q = `%${search.trim()}%`;
            params.push(q, q, q, q, q, q);
        }
        if (especie.trim()) {
            where += ' AND m.especie = ?';
            params.push(especie.trim());
        }
        if (socio_id) {
            where += ' AND m.socio_id = ?';
            params.push(parseInt(socio_id));
        }
        if (particular_id) {
            where += ' AND m.particular_id = ?';
            params.push(parseInt(particular_id));
        }

        const countResult = await userDb.query(
            `SELECT COUNT(*) as total 
             FROM mascota m 
             LEFT JOIN socio s ON m.socio_id = s.id 
             LEFT JOIN particular p ON m.particular_id = p.id
             ${where}`, params
        );
        const total = countResult[0].total;

        const rows = await userDb.query(
            `SELECT m.id, m.cod_mevep, m.socio_id, m.particular_id, m.nombre, m.especie, m.raza,
                    m.pelaje, m.tamanio, m.color, m.sexo, m.fecha_nac, m.origen,
                    m.observaciones,
                    s.apellido as socio_apellido, s.nombre as socio_nombre,
                    s.telefono as socio_telefono, s.celular as socio_celular,
                    s.documento as socio_documento,
                    p.apellido as particular_apellido, p.nombre as particular_nombre,
                    p.telefono as particular_telefono, p.celular as particular_celular,
                    p.documento as particular_documento
             FROM mascota m
             LEFT JOIN socio s ON m.socio_id = s.id
             LEFT JOIN particular p ON m.particular_id = p.id
             ${where}
             ORDER BY m.nombre ASC
             LIMIT ? OFFSET ?`,
            [...params, parseInt(limit), offset]
        );

        res.json({ total: Number(total), page: parseInt(page), data: rows });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/mascotas/especies  — listado de especies únicas
// ─────────────────────────────────────────────────
router.get('/especies', authenticateToken, async (req, res) => {
    try {
        const rows = await userDb.query(
            `SELECT DISTINCT especie FROM mascota 
             WHERE especie IS NOT NULL AND especie != '' AND FechaBaja IS NULL
             ORDER BY especie ASC`
        );
        res.json(rows.map(r => r.especie));
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// GET /api/mascotas/:id  — detalle + historial clínico
// ─────────────────────────────────────────────────
router.get('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const mascotas = await userDb.query(
            `SELECT m.*, 
                    s.apellido as socio_apellido, s.nombre as socio_nombre,
                    s.telefono as socio_telefono, s.celular as socio_celular,
                    s.documento as socio_documento, s.domicilio as socio_domicilio,
                    p.apellido as particular_apellido, p.nombre as particular_nombre,
                    p.telefono as particular_telefono, p.celular as particular_celular,
                    p.documento as particular_documento, p.domicilio as particular_domicilio
             FROM mascota m
             LEFT JOIN socio s ON m.socio_id = s.id
             LEFT JOIN particular p ON m.particular_id = p.id
             WHERE m.id = ? AND m.FechaBaja IS NULL`,
            [id]
        );
        if (mascotas.length === 0) return res.status(404).json({ error: 'Mascota no encontrada' });

        // Historia clínica (referenciada por paciente_id = mascota.id en nueva arquitectura)
        const historia = await userDb.query(
            `SELECT hc.*, u.nombre as veterinario_nombre, u.apellido as veterinario_apellido
             FROM historia_clinica hc
             LEFT JOIN user u ON hc.odontologo_id = u.id
             WHERE hc.paciente_id = ? AND hc.FechaBaja IS NULL
             ORDER BY hc.FechaCreacion DESC`,
            [id]
        );

        res.json({ ...mascotas[0], historia_clinica: historia });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// POST /api/mascotas  — crear mascota
// ─────────────────────────────────────────────────
router.post('/', authenticateToken, async (req, res) => {
    try {
        const { socio_id, particular_id, nombre, especie, raza, pelaje, tamanio, color,
                sexo, fecha_nac, observaciones, origen } = req.body;

        if (!nombre) return res.status(400).json({ error: 'El nombre es obligatorio' });

        const result = await userDb.query(
            `INSERT INTO mascota 
             (socio_id, particular_id, nombre, especie, raza, pelaje, tamanio, color, sexo, fecha_nac,
              origen, observaciones, prestador_id, CreacionUsuario, FechaCreacion)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())`,
            [socio_id || null, particular_id || null, nombre.trim(), especie || null, raza || null,
             pelaje || null, tamanio || null, color || null, sexo || null,
             fecha_nac || null, origen || 'socio', observaciones || null,
             req.user.prestador_id || 1, req.user.nombre_usuario]
        );

        logAction(req.user.nombre_usuario, 'MASCOTA_CREATE', `Nueva mascota: ${nombre}`, req);
        res.json({ message: 'OK', id: Number(result.insertId) });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// PUT /api/mascotas/:id  — editar mascota
// ─────────────────────────────────────────────────
router.put('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const { socio_id, particular_id, nombre, especie, raza, pelaje, tamanio, color,
                sexo, fecha_nac, observaciones, origen } = req.body;

        await userDb.query(
            `UPDATE mascota SET
             socio_id=?, particular_id=?, nombre=?, especie=?, raza=?, pelaje=?, tamanio=?, color=?,
             sexo=?, fecha_nac=?, observaciones=?, origen=?,
             ModificacionUsuario=?, FechaModificacion=NOW()
             WHERE id=? AND FechaBaja IS NULL`,
            [socio_id || null, particular_id || null, nombre?.trim(), especie || null, raza || null,
             pelaje || null, tamanio || null, color || null, sexo || null,
             fecha_nac || null, observaciones || null, origen || 'socio',
             req.user.nombre_usuario, id]
        );

        logAction(req.user.nombre_usuario, 'MASCOTA_UPDATE', `Mascota ID ${id} modificada`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// DELETE /api/mascotas/:id  — baja lógica
// ─────────────────────────────────────────────────
router.delete('/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        await userDb.query(
            'UPDATE mascota SET FechaBaja=NOW(), BajaUsuario=? WHERE id=?',
            [req.user.nombre_usuario, id]
        );
        logAction(req.user.nombre_usuario, 'MASCOTA_DELETE', `Mascota ID ${id} dada de baja`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// ─────────────────────────────────────────────────
// POST /api/mascotas/:id/historia  — agregar entrada al historial
// ─────────────────────────────────────────────────
router.post('/:id/historia', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const { descripcion, diagnostico, tratamiento, odontologo_id } = req.body;

        const result = await userDb.query(
            `INSERT INTO historia_clinica 
             (paciente_id, odontologo_id, descripcion, diagnostico, tratamiento, CreacionUsuario, FechaCreacion)
             VALUES (?, ?, ?, ?, ?, ?, NOW())`,
            [id, odontologo_id || req.user.id, descripcion || null,
             diagnostico || null, tratamiento || null, req.user.nombre_usuario]
        );

        logAction(req.user.nombre_usuario, 'HC_CREATE', `Historia clínica mascota ID ${id}`, req);
        res.json({ message: 'OK', id: Number(result.insertId) });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
