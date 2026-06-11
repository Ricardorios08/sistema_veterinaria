const fs = require('fs');
const path = require('path');

const authPath = path.join(__dirname, '../backend/routes/auth.js');
let content = fs.readFileSync(authPath, 'utf8');

// Normalize line endings to \n
content = content.replace(/\r\n/g, '\n');

// 1. Replace POST /login
const oldLogin = `// POST /login
router.post('/login', async (req, res) => {
    const { nombre_usuario, password } = req.body;
    try {
        const users = await userDb.query('SELECT * FROM user WHERE nombre_usuario = ?', [nombre_usuario], 'admin');
        if (users.length === 0) return res.status(401).json({ error: 'Usuario o contraseña incorrectos' });

        const user = users[0];
        const validPassword = await bcrypt.compare(password, user.password);
        if (!validPassword) return res.status(401).json({ error: 'Usuario o contraseña incorrectos' });

        const token = jwt.sign(
            { id: user.id, nombre_usuario: user.nombre_usuario, rol: user.rol },
            JWT_SECRET,
            { expiresIn: '8h' }
        );

        res.json({ token, user: { id: user.id, nombre_usuario: user.nombre_usuario, rol: user.rol } });
        logAction(user.nombre_usuario, 'LOGIN', 'Inicio de sesión exitoso', req);
    } catch (err) {
        logAction(nombre_usuario || 'UNKNOWN', 'LOGIN_FAILED', \`Error: \${err.message}\`, req);
        res.status(500).json({ error: err.message });
    }
});`;

const newLogin = `// POST /login
router.post('/login', async (req, res) => {
    const { nombre_usuario, password } = req.body;
    try {
        const users = await userDb.query('SELECT * FROM user WHERE nombre_usuario = ? AND FechaBaja IS NULL', [nombre_usuario], 'admin');
        if (users.length === 0) return res.status(401).json({ error: 'Usuario o contraseña incorrectos' });

        const user = users[0];
        const validPassword = await bcrypt.compare(password, user.password);
        if (!validPassword) return res.status(401).json({ error: 'Usuario o contraseña incorrectos' });

        const token = jwt.sign(
            { id: user.id, nombre_usuario: user.nombre_usuario, rol: user.rol, prestador_id: user.prestador_id },
            JWT_SECRET,
            { expiresIn: '8h' }
        );

        res.json({ token, user: { id: user.id, nombre_usuario: user.nombre_usuario, rol: user.rol, prestador_id: user.prestador_id } });
        logAction(user.nombre_usuario, 'LOGIN', 'Inicio de sesión exitoso', req);
    } catch (err) {
        logAction(nombre_usuario || 'UNKNOWN', 'LOGIN_FAILED', \`Error: \${err.message}\`, req);
        res.status(500).json({ error: err.message });
    }
});`;

if (content.includes(oldLogin)) {
    content = content.replace(oldLogin, newLogin);
    console.log("-> Replaced login route successfully.");
} else {
    console.error("-> COULD NOT find old login route exactly.");
}

// 2. Replace GET /users
const oldGetUsers = `router.get('/users', authenticateToken, async (req, res) => {
    try {
        const isAdminUser = req.user.rol === 'admin' || req.user.rol === 'superadmin';
        let query = 'SELECT id, nombre_usuario, rol FROM user';
        let params = [];
        
        if (!isAdminUser) {
            query += ' WHERE id = ?';
            params.push(req.user.id);
        }
        
        const users = await userDb.query(query, params, req.user.rol);
        res.json(users);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

const newGetUsers = `// GET /users (lists all users with specialty/professional type JOIN)
router.get('/users', authenticateToken, async (req, res) => {
    try {
        const isSuperAdmin = req.user.rol === 'superadmin';
        const isAdminUser = req.user.rol === 'admin' || isSuperAdmin;
        
        let query = \`
            SELECT u.id, u.nombre_usuario, u.rol, u.tipo_profesional_id, u.matricula, 
                   u.prestador_id, p.nombre as prestador_nombre,
                   tp.nombre as tipo_profesional_nombre 
            FROM user u
            LEFT JOIN tipo_profesional tp ON u.tipo_profesional_id = tp.id
            LEFT JOIN prestador p ON u.prestador_id = p.id
            WHERE u.FechaBaja IS NULL
        \`;
        let params = [];
        
        if (!isSuperAdmin) {
            if (isAdminUser) {
                query += ' AND u.prestador_id = ?';
                params.push(req.user.prestador_id);
            } else {
                query += ' AND u.id = ?';
                params.push(req.user.id);
            }
        }
        
        query += ' ORDER BY u.nombre_usuario ASC';
        
        const users = await userDb.query(query, params, req.user.rol);
        res.json(users);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

if (content.includes(oldGetUsers)) {
    content = content.replace(oldGetUsers, newGetUsers);
    console.log("-> Replaced GET /users successfully.");
} else {
    console.error("-> COULD NOT find old GET /users exactly.");
}

// 3. Replace POST /users
const oldPostUsers = `router.post('/users', authenticateToken, isAdmin, async (req, res) => {
    // ... existing post logic ...
    const { nombre_usuario, password, rol } = req.body;
    if (!nombre_usuario || !password || !rol) return res.status(400).json({ error: 'Todo obligatorio' });
    try {
        const hashedPass = await bcrypt.hash(password, 10);
        await userDb.query('INSERT INTO user (nombre_usuario, password, rol) VALUES (?, ?, ?)', [nombre_usuario, hashedPass, rol], req.user.rol);
        logAction(req.user.nombre_usuario, 'USER_CREATE', \`Nuevo usuario: \${nombre_usuario} (Rol: \${rol})\`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

const newPostUsers = `// POST /users (creates professional or standard users)
router.post('/users', authenticateToken, isAdmin, async (req, res) => {
    const { nombre_usuario, password, rol, tipo_profesional_id, matricula, prestador_id } = req.body;
    if (!nombre_usuario || !password || !rol) return res.status(400).json({ error: 'Todo obligatorio' });
    try {
        // Enforce prestador isolation
        const finalPrestadorId = req.user.rol === 'superadmin' 
            ? (prestador_id ? parseInt(prestador_id) : (req.user.prestador_id || 1))
            : req.user.prestador_id;

        const hashedPass = await bcrypt.hash(password, 10);
        await userDb.query(
            'INSERT INTO user (nombre_usuario, password, rol, tipo_profesional_id, matricula, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())', 
            [nombre_usuario, hashedPass, rol, tipo_profesional_id || null, matricula || null, finalPrestadorId, req.user.nombre_usuario], 
            req.user.rol
        );
        logAction(req.user.nombre_usuario, 'USER_CREATE', \`Nuevo usuario: \${nombre_usuario} (Rol: \${rol}, Prestador ID: \${finalPrestadorId})\`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

if (content.includes(oldPostUsers)) {
    content = content.replace(oldPostUsers, newPostUsers);
    console.log("-> Replaced POST /users successfully.");
} else {
    console.error("-> COULD NOT find old POST /users exactly.");
}

// 4. Replace PUT /users/:id
const oldPutUsers = `router.put('/users/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const { password, rol } = req.body;
        const isAdminUser = req.user.rol === 'admin' || req.user.rol === 'superadmin';

        // Allow if admin OR if editing self
        if (!isAdminUser && parseInt(id) !== req.user.id) {
            return res.status(403).json({ error: 'No tienes permiso para editar otros usuarios' });
        }
        
        // Check if user exists and isn't Ricardo
        const users = await userDb.query('SELECT nombre_usuario, rol FROM user WHERE id = ?', [id], req.user.rol);
        if (users.length === 0) return res.status(404).json({ error: 'Usuario no encontrado' });
        if (users[0].nombre_usuario === 'Ricardo' && req.user.nombre_usuario !== 'Ricardo') {
            return res.status(403).json({ error: 'No se puede modificar a este admin' });
        }

        if (password) {
            const hashedPass = await bcrypt.hash(password, 10);
            // If not admin, they cannot change their own role
            const finalRol = isAdminUser ? rol : users[0].rol;
            await userDb.query('UPDATE user SET password = ?, rol = ? WHERE id = ?', [hashedPass, finalRol, id], req.user.rol);
        } else if (isAdminUser) {
            await userDb.query('UPDATE user SET rol = ? WHERE id = ?', [rol, id], req.user.rol);
        }
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

const newPutUsers = `// PUT /users/:id (update users with professional details support)
router.put('/users/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const { password, rol, tipo_profesional_id, matricula, prestador_id } = req.body;
        const isSuperAdmin = req.user.rol === 'superadmin';
        const isAdminUser = req.user.rol === 'admin' || isSuperAdmin;

        // Allow if admin OR if editing self
        if (!isAdminUser && parseInt(id) !== req.user.id) {
            return res.status(403).json({ error: 'No tienes permiso para editar otros usuarios' });
        }
        
        // Check if user exists and isn't Ricardo
        const users = await userDb.query('SELECT nombre_usuario, rol, prestador_id FROM user WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (users.length === 0) return res.status(404).json({ error: 'Usuario no encontrado' });
        
        // Security isolation check: admin can only edit users of their own prestador
        if (req.user.rol === 'admin' && users[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para editar usuarios de otra institución' });
        }

        if (users[0].nombre_usuario === 'Ricardo' && req.user.nombre_usuario !== 'Ricardo') {
            return res.status(403).json({ error: 'No se puede modificar a este admin' });
        }

        const finalRol = isAdminUser ? rol : users[0].rol;
        const updates = [];
        const params = [];

        if (password) {
            const hashedPass = await bcrypt.hash(password, 10);
            updates.push('password = ?');
            params.push(hashedPass);
        }

        updates.push('rol = ?', 'tipo_profesional_id = ?', 'matricula = ?');
        params.push(finalRol, tipo_profesional_id !== undefined ? tipo_profesional_id : null, matricula !== undefined ? matricula : null);

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
            \`UPDATE user SET \${updates.join(', ')} WHERE id = ?\`, 
            params, 
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'USER_UPDATE', \`Usuario ID modificado: \${id}\`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

if (content.includes(oldPutUsers)) {
    content = content.replace(oldPutUsers, newPutUsers);
    console.log("-> Replaced PUT /users/:id successfully.");
} else {
    console.error("-> COULD NOT find old PUT /users/:id exactly.");
}

// 5. Replace DELETE /users/:id
const oldDeleteUsers = `router.delete('/users/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const isAdminUser = req.user.rol === 'admin' || req.user.rol === 'superadmin';

        // SECURITY CHECK: Only admins can actually delete
        if (!isAdminUser) {
            logAction(req.user.nombre_usuario, 'USER_DELETE_REJECTED', \`Intento fallido de eliminar usuario ID: \${id} (Permisos insuficientes)\`, req);
            return res.status(403).json({ error: 'RECHAZADO POR EL SERVIDOR: No tienes permisos de administrador para realizar eliminaciones en la base de datos.' });
        }

        const users = await userDb.query('SELECT nombre_usuario, rol FROM user WHERE id = ?', [id], req.user.rol);
        if (users.length > 0 && users[0].nombre_usuario === 'Ricardo') {
            return res.status(403).json({ error: 'No se puede eliminar a este admin' });
        }

        await userDb.query('DELETE FROM user WHERE id = ?', [id], req.user.rol);
        logAction(req.user.nombre_usuario, 'USER_DELETE', \`Usuario ID eliminado: \${id}\`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

const newDeleteUsers = `router.delete('/users/:id', authenticateToken, async (req, res) => {
    try {
        const { id } = req.params;
        const isSuperAdmin = req.user.rol === 'superadmin';
        const isAdminUser = req.user.rol === 'admin' || isSuperAdmin;

        // SECURITY CHECK: Only admins can delete
        if (!isAdminUser) {
            logAction(req.user.nombre_usuario, 'USER_DELETE_REJECTED', \`Intento fallido de eliminar usuario ID: \${id} (Permisos insuficientes)\`, req);
            return res.status(403).json({ error: 'RECHAZADO POR EL SERVIDOR: No tienes permisos de administrador.' });
        }

        const users = await userDb.query('SELECT nombre_usuario, rol, prestador_id FROM user WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (users.length === 0) return res.status(404).json({ error: 'Usuario no encontrado' });

        // Security isolation check: admin can only delete users of their own prestador
        if (req.user.rol === 'admin' && users[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para eliminar usuarios de otra institución' });
        }

        if (users[0].nombre_usuario === 'Ricardo') {
            return res.status(403).json({ error: 'No se puede eliminar a este admin' });
        }

        // Logical deletion
        await userDb.query(
            'UPDATE user SET FechaBaja = NOW(), BajaUsuario = ? WHERE id = ?', 
            [req.user.nombre_usuario, id], 
            req.user.rol
        );
        logAction(req.user.nombre_usuario, 'USER_DELETE', \`Usuario ID eliminado lógicamente: \${id}\`, req);
        res.json({ message: 'OK' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});`;

if (content.includes(oldDeleteUsers)) {
    content = content.replace(oldDeleteUsers, newDeleteUsers);
    console.log("-> Replaced DELETE /users/:id successfully.");
} else {
    console.error("-> COULD NOT find old DELETE /users/:id exactly.");
}

fs.writeFileSync(authPath, content, 'utf8');
console.log("=== COMPLETED ALL REPLACEMENTS SUCCESSFULLY ===");
