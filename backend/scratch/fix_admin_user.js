/**
 * Restaura usuario 'admin' a rol=superadmin y contraseña conocida: admin2024
 */
const db = require('../db/userDb');
const bcrypt = require('bcryptjs');

async function run() {
    try {
        const hashed = await bcrypt.hash('admin2024', 10);
        const result = await db.query(
            "UPDATE `user` SET password = ?, rol = 'superadmin' WHERE nombre_usuario = 'admin'",
            [hashed]
        );
        console.log('Resultado UPDATE:', result.affectedRows, 'fila(s) modificada(s)');

        const row = await db.query("SELECT id, nombre_usuario, rol FROM `user` WHERE nombre_usuario = 'admin'");
        console.table(row);
        console.log('\n✓ Listo. Login: admin / admin2024');
    } catch (err) {
        console.error('ERROR:', err.message);
    } finally {
        process.exit(0);
    }
}
run();
