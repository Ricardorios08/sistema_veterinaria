/**
 * Verifica el hash del usuario admin y muestra si la contraseña matchea
 */
const db = require('../db/userDb');
const bcrypt = require('bcryptjs');

async function run() {
    try {
        const rows = await db.query(
            "SELECT id, nombre_usuario, rol, password, FechaBaja FROM `user` WHERE nombre_usuario = 'admin'"
        );
        
        if (rows.length === 0) {
            console.log('ERROR: No se encontró usuario admin');
            process.exit(1);
        }

        const user = rows[0];
        console.log('--- Usuario encontrado ---');
        console.log('id:', user.id);
        console.log('nombre_usuario:', user.nombre_usuario);
        console.log('rol:', user.rol);
        console.log('FechaBaja:', user.FechaBaja);
        console.log('password hash (primeros 30 chars):', user.password?.substring(0, 30));

        // Verificar contraseña
        const testPasswords = ['admin2024', 'admin456', 'admin', 'S0p0rt3s2021#'];
        for (const pw of testPasswords) {
            const ok = await bcrypt.compare(pw, user.password);
            console.log(`\nTest '${pw}': ${ok ? '✓ COINCIDE' : '✗ NO coincide'}`);
        }
    } catch (err) {
        console.error('ERROR:', err.message);
    } finally {
        process.exit(0);
    }
}
run();
