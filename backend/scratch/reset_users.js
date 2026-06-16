/**
 * reset_users.js
 * Limpia TODA la tabla user y user_rol, y crea un superadmin fresco.
 */
const db = require('../db/userDb');
const bcrypt = require('bcryptjs');

const ADMIN_USER = 'admin';
const ADMIN_PASS = 'admin2024';

async function run() {
    try {
        console.log('--- Limpiando tablas user_rol y user ---');
        await db.query('SET FOREIGN_KEY_CHECKS = 0');
        await db.query('DELETE FROM user_rol');
        await db.query('DELETE FROM user');
        await db.query('ALTER TABLE user AUTO_INCREMENT = 1');
        await db.query('SET FOREIGN_KEY_CHECKS = 1');
        console.log('✓ Tablas vaciadas.');

        const hashed = await bcrypt.hash(ADMIN_PASS, 10);

        await db.query(
            `INSERT INTO \`user\` 
             (nombre_usuario, password, rol, prestador_id, nombre, apellido, CreacionUsuario, FechaCreacion) 
             VALUES (?, ?, 'superadmin', 1, 'Admin', 'Sistema', 'SYSTEM', NOW())`,
            [ADMIN_USER, hashed]
        );
        console.log('✓ Usuario superadmin creado.');

        // Insertar también en user_rol
        const rows = await db.query("SELECT id FROM `user` WHERE nombre_usuario = ?", [ADMIN_USER]);
        const userId = Number(rows[0].id);
        await db.query('INSERT INTO user_rol (user_id, rol) VALUES (?, ?)', [userId, 'superadmin']);
        console.log('✓ Rol superadmin asignado en user_rol.');

        // Verificar
        const final = await db.query('SELECT id, nombre_usuario, rol, prestador_id FROM `user`');
        console.log('\n=== RESULTADO FINAL ===');
        console.table(final);
        console.log(`\n✓ Login: ${ADMIN_USER} / ${ADMIN_PASS}`);
    } catch (err) {
        console.error('✗ ERROR:', err.message);
        console.error(err);
    } finally {
        process.exit(0);
    }
}

run();
