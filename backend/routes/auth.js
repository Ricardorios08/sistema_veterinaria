const express = require('express');
const router = express.Router();
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const userDb = require('../db/userDb');
const fs = require('fs');
const path = require('path');
const { logAction } = require('../utils/logger');

const JWT_SECRET = process.env.JWT_SECRET || 'fallback_secret';
const LOG_PATH = path.join(__dirname, '../logs/audit.log');
const BACKUP_DIR = path.join(__dirname, '../logs/backups');

// Middleware to verify JWT
const authenticateToken = (req, res, next) => {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];

    if (!token) return res.status(401).json({ error: 'Token no proporcionado' });

    jwt.verify(token, JWT_SECRET, (err, user) => {
        if (err) return res.status(403).json({ error: 'Token inválido o expirado' });
        req.user = user;
        next();
    });
};

// Middleware to check admin, recepcion or superadmin role
const isAdmin = (req, res, next) => {
    if (req.user && (req.user.rol === 'admin' || req.user.rol === 'recepcion' || req.user.rol === 'superadmin')) {
        next();
    } else {
        res.status(403).json({ error: 'Acceso denegado: se requiere rol de administrador o recepción' });
    }
};

// Middleware to check superadmin only
const isSuperAdmin = (req, res, next) => {
    if (req.user && req.user.rol === 'superadmin') {
        next();
    } else {
        res.status(403).json({ error: 'Acceso denegado: se requiere rol de super-administrador' });
    }
};

const isCtaCte = (req, res, next) => {
    if (req.user && req.user.rol === 'ctacte') {
        next();
    } else {
        res.status(403).json({ error: 'Acceso denegado: se requiere rol de Cta Cte' });
    }
};

// POST /login
router.post('/login', async (req, res) => {
    const { nombre_usuario, password } = req.body;
    try {
        const users = await userDb.query('SELECT * FROM user WHERE FechaBaja IS NULL AND nombre_usuario = ?', [nombre_usuario], 'admin');
        if (users.length === 0) return res.status(401).json({ error: 'Usuario o contraseña incorrectos' });

        const user = users[0];
        const validPassword = await bcrypt.compare(password, user.password);
        if (!validPassword) return res.status(401).json({ error: 'Usuario o contraseña incorrectos' });

        const rolesResult = await userDb.query('SELECT rol FROM user_rol WHERE user_id = ?', [user.id], 'admin');
        const roles = rolesResult.map(r => r.rol);
        const finalRoles = roles.length > 0 ? roles : [user.rol];

        let activeRol = user.rol;
        if (finalRoles.includes('profesional')) {
            activeRol = 'profesional';
        } else if (finalRoles.includes('veterinario')) {
            activeRol = 'veterinario';
        } else if (finalRoles.includes('peluquero')) {
            activeRol = 'peluquero';
        } else if (finalRoles.includes('traslado')) {
            activeRol = 'traslado';
        } else if (finalRoles.includes('cobrador')) {
            activeRol = 'cobrador';
        } else if (finalRoles.includes('recepcion')) {
            activeRol = 'recepcion';
        } else if (finalRoles.includes('admin')) {
            activeRol = 'admin';
        }

        const token = jwt.sign(
            { 
                id: user.id, 
                nombre_usuario: user.nombre_usuario, 
                rol: activeRol, 
                roles: finalRoles,
                prestador_id: user.prestador_id 
            },
            JWT_SECRET,
            { expiresIn: '8h' }
        );

        res.json({ 
            token, 
            user: { 
                id: user.id, 
                nombre_usuario: user.nombre_usuario, 
                rol: activeRol, 
                roles: finalRoles, 
                prestador_id: user.prestador_id 
            } 
        });
        logAction(user.nombre_usuario, 'LOGIN', 'Inicio de sesión exitoso', req);
    } catch (err) {
        logAction(nombre_usuario || 'UNKNOWN', 'LOGIN_FAILED', `Error: ${err.message}`, req);
        res.status(500).json({ error: err.message });
    }
});

// POST /switch-role (allows dynamic switching of active role)
router.post('/switch-role', authenticateToken, async (req, res) => {
    const { rol } = req.body;
    if (!rol) return res.status(400).json({ error: 'Rol no especificado' });

    try {
        // Verify user actually has this role assigned
        const userRoles = await userDb.query('SELECT rol FROM user_rol WHERE user_id = ? AND rol = ?', [req.user.id, rol], req.user.rol);
        if (userRoles.length === 0) {
            return res.status(403).json({ error: 'No tienes este rol asignado' });
        }

        // Fetch all assigned roles to keep them in token
        const allRolesResult = await userDb.query('SELECT rol FROM user_rol WHERE user_id = ?', [req.user.id], req.user.rol);
        const allRoles = allRolesResult.map(r => r.rol);

        // Generate a new token with the switched active role
        const token = jwt.sign(
            { 
                id: req.user.id, 
                nombre_usuario: req.user.nombre_usuario, 
                rol: rol, // Switched active role!
                roles: allRoles,
                prestador_id: req.user.prestador_id 
            },
            JWT_SECRET,
            { expiresIn: '8h' }
        );

        res.json({ 
            token, 
            user: { 
                id: req.user.id, 
                nombre_usuario: req.user.nombre_usuario, 
                rol: rol, 
                roles: allRoles,
                prestador_id: req.user.prestador_id 
            } 
        });
        logAction(req.user.nombre_usuario, 'ROLE_SWITCH', `Cambio de rol activo a: ${rol}`, req);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /impersonate (allows superadmin to sign a token for any user without a password)
router.post('/impersonate', authenticateToken, async (req, res) => {
    if (req.user.rol !== 'superadmin') {
        logAction(req.user.nombre_usuario, 'IMPERSONATE_REJECTED', `Intento fallido de suplantar usuario (Rol actual: ${req.user.rol})`, req);
        return res.status(403).json({ error: 'Acceso denegado: Solo el superadmin puede suplantar identidad.' });
    }

    const { userId } = req.body;
    if (!userId) return res.status(400).json({ error: 'ID de usuario no especificado' });

    try {
        const targetUsers = await userDb.query('SELECT id, nombre_usuario, rol, prestador_id FROM user WHERE id = ? AND FechaBaja IS NULL', [userId], req.user.rol);
        if (targetUsers.length === 0) {
            return res.status(404).json({ error: 'Usuario no encontrado' });
        }
        const targetUser = targetUsers[0];

        const targetRolesResult = await userDb.query('SELECT rol FROM user_rol WHERE user_id = ?', [userId], req.user.rol);
        const targetRoles = targetRolesResult.map(r => r.rol);

        const token = jwt.sign(
            {
                id: targetUser.id,
                nombre_usuario: targetUser.nombre_usuario,
                rol: targetUser.rol,
                roles: targetRoles.length > 0 ? targetRoles : [targetUser.rol],
                prestador_id: targetUser.prestador_id
            },
            JWT_SECRET,
            { expiresIn: '2h' }
        );

        logAction(req.user.nombre_usuario, 'IMPERSONATE_START', `Superadmin suplantando identidad de: ${targetUser.nombre_usuario}`, req);

        res.json({
            token,
            user: {
                id: targetUser.id,
                nombre_usuario: targetUser.nombre_usuario,
                rol: targetUser.rol,
                roles: targetRoles.length > 0 ? targetRoles : [targetUser.rol],
                prestador_id: targetUser.prestador_id
            }
        });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

router.get('/me', authenticateToken, (req, res) => {
    res.json({ user: req.user });
});

// GET /users (lists all users with specialty/professional type JOIN)
router.get('/users', authenticateToken, async (req, res) => {
    try {
        const isSuperAdmin = req.user.rol === 'superadmin';
        const isAdminUser = req.user.rol === 'admin' || req.user.rol === 'recepcion' || isSuperAdmin;
        
        let query = `
            SELECT u.id, u.nombre_usuario, u.rol, u.tipo_profesional_id, u.matricula, 
                   u.prestador_id, p.nombre as prestador_nombre,
                   tp.nombre as tipo_profesional_nombre,
                   u.nombre, u.apellido, u.mail, u.celular, u.direccion,
                   GROUP_CONCAT(DISTINCT ur.rol) as roles
            FROM user u
            LEFT JOIN tipo_profesional tp ON u.tipo_profesional_id = tp.id
            LEFT JOIN prestador p ON u.prestador_id = p.id
            LEFT JOIN user_rol ur ON u.id = ur.user_id
            WHERE u.FechaBaja IS NULL
        `;
        let params = [];
        
        if (!isSuperAdmin) {
            query += " AND u.rol != 'superadmin' AND u.id NOT IN (SELECT user_id FROM user_rol WHERE rol = 'superadmin')";
            if (isAdminUser) {
                query += ' AND u.prestador_id = ?';
                params.push(req.user.prestador_id);
            } else {
                query += ' AND u.id = ?';
                params.push(req.user.id);
            }
        }
        
        query += ' GROUP BY u.id ORDER BY u.nombre_usuario ASC';
        
        const users = await userDb.query(query, params, req.user.rol);
        res.json(users);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// GET /tipos-profesional (lists all professional types/specialties)
router.get('/tipos-profesional', authenticateToken, async (req, res) => {
    try {
        const types = await userDb.query('SELECT * FROM tipo_profesional ORDER BY nombre ASC', [], req.user.rol);
        res.json(types);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /users (creates professional or standard users)
router.post('/users', authenticateToken, isAdmin, async (req, res) => {
    const { password, rol, roles, tipo_profesional_id, matricula, prestador_id, nombre, apellido, mail, celular, direccion } = req.body;
    if (!nombre || !apellido || !password) {
        return res.status(400).json({ error: 'Nombre, Apellido y Contraseña son obligatorios' });
    }

    // Support both single "rol" (string) or multiple "roles" (array)
    let finalRoles = [];
    if (roles && Array.isArray(roles) && roles.length > 0) {
        finalRoles = roles;
    } else if (rol) {
        finalRoles = [rol];
    }

    if (finalRoles.length === 0) {
        return res.status(400).json({ error: 'Debes seleccionar al menos un rol' });
    }

    // Non-superadmins cannot assign the superadmin role!
    if (req.user.rol !== 'superadmin' && finalRoles.includes('superadmin')) {
        return res.status(403).json({ error: 'Acceso denegado: No tienes permisos para crear un usuario Super Administrador.' });
    }

    try {
        // Enforce prestador isolation
        const finalPrestadorId = req.user.rol === 'superadmin' 
            ? (prestador_id ? parseInt(prestador_id) : (req.user.prestador_id || 1))
            : req.user.prestador_id;

        // Auto-generate username: primerApellido.PrimerNombre (lowercase, normalized)
        const firstLastName = apellido.trim().split(/\s+/)[0];
        const firstFirstName = nombre.trim().split(/\s+/)[0];
        let generatedUsername = `${firstLastName}.${firstFirstName}`.toLowerCase()
            .normalize("NFD").replace(/[\u0300-\u036f]/g, ""); // Remove accents

        // Check if username exists and append suffix if duplicate
        let usernameBase = generatedUsername;
        let suffix = 1;
        let usernameExists = true;
        while (usernameExists) {
            const existing = await userDb.query('SELECT id FROM user WHERE nombre_usuario = ? AND FechaBaja IS NULL', [generatedUsername], req.user.rol);
            if (existing.length === 0) {
                usernameExists = false;
            } else {
                generatedUsername = `${usernameBase}${suffix}`;
                suffix++;
            }
        }

        const hashedPass = await bcrypt.hash(password, 10);
        const insertResult = await userDb.query(
            'INSERT INTO user (nombre_usuario, password, rol, tipo_profesional_id, matricula, prestador_id, nombre, apellido, mail, celular, direccion, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())', 
            [generatedUsername, hashedPass, finalRoles[0], tipo_profesional_id || null, matricula || null, finalPrestadorId, nombre, apellido, mail || null, celular || null, direccion || null, req.user.nombre_usuario], 
            req.user.rol
        );
        
        const userId = Number(insertResult.insertId);
        if (userId) {
            const uniqueRoles = [...new Set(finalRoles)];
            for (const r of uniqueRoles) {
                await userDb.query('INSERT INTO user_rol (user_id, rol) VALUES (?, ?)', [userId, r], req.user.rol);
            }
        }

        logAction(req.user.nombre_usuario, 'USER_CREATE', `Nuevo usuario: ${generatedUsername} (Nombre: ${nombre} ${apellido}, Roles: ${finalRoles.join(', ')}, Prestador ID: ${finalPrestadorId})`, req);
        res.json({ message: 'OK', nombre_usuario: generatedUsername });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

router.delete('/users/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const isSuperAdmin = req.user.rol === 'superadmin';
        const isAdminUser = req.user.rol === 'admin' || req.user.rol === 'recepcion' || isSuperAdmin;

        // SECURITY CHECK: Only admins can delete
        if (!isAdminUser) {
            logAction(req.user.nombre_usuario, 'USER_DELETE_REJECTED', `Intento fallido de eliminar usuario ID: ${id} (Permisos insuficientes)`, req);
            return res.status(403).json({ error: 'RECHAZADO POR EL SERVIDOR: No tienes permisos de administrador.' });
        }

        const users = await userDb.query('SELECT nombre_usuario, rol, prestador_id FROM user WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (users.length === 0) return res.status(404).json({ error: 'Usuario no encontrado' });

        // Security isolation check: admin/recepcion can only delete users of their own prestador
        if (req.user.rol !== 'superadmin' && users[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para eliminar usuarios de otra institución' });
        }

        if (users[0].nombre_usuario === 'Ricardo') {
            return res.status(403).json({ error: 'No se puede eliminar a este admin' });
        }

        if (req.user.rol !== 'superadmin') {
            const targetSuperCheck = await userDb.query('SELECT 1 FROM user_rol WHERE user_id = ? AND rol = "superadmin"', [id], req.user.rol);
            if (users[0].rol === 'superadmin' || targetSuperCheck.length > 0) {
                return res.status(403).json({ error: 'Acceso denegado: No tienes permisos para eliminar a un Super Administrador.' });
            }
        }

        // Logical deletion
        await userDb.query(
            'UPDATE user SET FechaBaja = NOW(), BajaUsuario = ? WHERE id = ?', 
            [req.user.nombre_usuario, id], 
            req.user.rol
        );
        logAction(req.user.nombre_usuario, 'USER_DELETE', `Usuario ID eliminado lógicamente: ${id}`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// PUT /users/:id (update users with professional details support)
router.put('/users/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const { password, rol, roles, tipo_profesional_id, matricula, prestador_id, nombre, apellido, mail, celular, direccion } = req.body;
        const isSuperAdmin = req.user.rol === 'superadmin';
        const isAdminUser = req.user.rol === 'admin' || req.user.rol === 'recepcion' || isSuperAdmin;

        // Allow if admin OR if editing self
        if (!isAdminUser && parseInt(id) !== req.user.id) {
            return res.status(403).json({ error: 'No tienes permiso para editar otros usuarios' });
        }
        
        // Check if user exists and isn't Ricardo
        const users = await userDb.query('SELECT nombre_usuario, rol, prestador_id FROM user WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (users.length === 0) return res.status(404).json({ error: 'Usuario no encontrado' });
        
        // Security isolation check: admin/recepcion can only edit users of their own prestador
        if (req.user.rol !== 'superadmin' && users[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para editar usuarios de otra institución' });
        }

        if (users[0].nombre_usuario === 'Ricardo' && req.user.nombre_usuario !== 'Ricardo') {
            return res.status(403).json({ error: 'No se puede modificar a este admin' });
        }

        // Non-superadmins cannot modify a superadmin!
        if (req.user.rol !== 'superadmin') {
            const targetSuperCheck = await userDb.query('SELECT 1 FROM user_rol WHERE user_id = ? AND rol = "superadmin"', [id], req.user.rol);
            if (users[0].rol === 'superadmin' || targetSuperCheck.length > 0) {
                return res.status(403).json({ error: 'Acceso denegado: No tienes permisos para modificar a un Super Administrador.' });
            }
        }

        let finalRoles = [];
        if (roles && Array.isArray(roles) && roles.length > 0) {
            finalRoles = roles;
        } else if (rol) {
            finalRoles = [rol];
        }

        // Non-superadmins cannot assign the superadmin role!
        if (req.user.rol !== 'superadmin' && finalRoles.includes('superadmin')) {
            return res.status(403).json({ error: 'Acceso denegado: No puedes asignar el rol de Super Administrador.' });
        }

        const finalRol = finalRoles.length > 0 ? finalRoles[0] : (isAdminUser ? rol : users[0].rol);
        const updates = [];
        const params = [];

        if (password) {
            const hashedPass = await bcrypt.hash(password, 10);
            updates.push('password = ?');
            params.push(hashedPass);
        }

        updates.push('rol = ?', 'tipo_profesional_id = ?', 'matricula = ?');
        params.push(finalRol, tipo_profesional_id !== undefined ? tipo_profesional_id : null, matricula !== undefined ? matricula : null);

        if (nombre !== undefined) {
            updates.push('nombre = ?');
            params.push(nombre || null);
        }
        if (apellido !== undefined) {
            updates.push('apellido = ?');
            params.push(apellido || null);
        }
        if (mail !== undefined) {
            updates.push('mail = ?');
            params.push(mail || null);
        }
        if (celular !== undefined) {
            updates.push('celular = ?');
            params.push(celular || null);
        }
        if (direccion !== undefined) {
            updates.push('direccion = ?');
            params.push(direccion || null);
        }

        // Only superadmin can edit prestador_id
        if (isSuperAdmin && prestador_id !== undefined) {
            updates.push('prestador_id = ?');
            params.push(prestador_id ? parseInt(prestador_id) : null);
        }

        // Add audit columns
        updates.push('ModificacionUsuario = ?', 'FechaModificacion = NOW()');
        params.push(req.user.nombre_usuario);

        params.push(id);

        await userDb.query(
            `UPDATE user SET ${updates.join(', ')} WHERE id = ?`, 
            params, 
            req.user.rol
        );

        if (finalRoles.length > 0) {
            // Delete old roles and insert new ones
            await userDb.query('DELETE FROM user_rol WHERE user_id = ?', [id], req.user.rol);
            const uniqueRoles = [...new Set(finalRoles)];
            for (const r of uniqueRoles) {
                await userDb.query('INSERT INTO user_rol (user_id, rol) VALUES (?, ?)', [id, r], req.user.rol);
            }
        }

        logAction(req.user.nombre_usuario, 'USER_UPDATE', `Usuario ID modificado: ${id} (Roles asignados: ${finalRoles.join(', ')})`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// Logs (Superadmin only)
router.get('/logs', authenticateToken, isSuperAdmin, (req, res) => {
    try {
        if (!fs.existsSync(LOG_PATH)) return res.json({ logs: '' });
        const logs = fs.readFileSync(LOG_PATH, 'utf8');
        res.json({ logs });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

router.post('/logs/rotate', authenticateToken, isSuperAdmin, (req, res) => {
    try {
        if (!fs.existsSync(BACKUP_DIR)) fs.mkdirSync(BACKUP_DIR, { recursive: true });
        if (fs.existsSync(LOG_PATH)) {
            const timestamp = new Date().toISOString().replace(/[:.]/g, '-');
            const backupPath = path.join(BACKUP_DIR, `audit_${timestamp}.log`);
            fs.copyFileSync(LOG_PATH, backupPath);
            fs.writeFileSync(LOG_PATH, `[${new Date().toLocaleString()}] [LOG_ROTATED] Log rotado por ${req.user.nombre_usuario}\n`);
        }
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

router.put('/change-password', authenticateToken, async (req, res) => {
    const { currentPassword, newPassword } = req.body;
    try {
        const users = await userDb.query('SELECT password FROM user WHERE id = ?', [req.user.id], req.user.rol);
        const validPassword = await bcrypt.compare(currentPassword, users[0].password);
        if (!validPassword) return res.status(401).json({ error: 'Error' });
        const hashedPass = await bcrypt.hash(newPassword, 10);
        await userDb.query('UPDATE user SET password = ? WHERE id = ?', [hashedPass, req.user.id], req.user.rol);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
