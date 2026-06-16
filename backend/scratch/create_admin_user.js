/**
 * Script: create_admin_user.js
 * Crea o actualiza el usuario 'admin' con rol 'administrador' en la base veterinaria.
 * Contraseña: admin2024
 */

const userDb = require('../db/userDb');
const bcrypt = require('bcryptjs');

const ADMIN_USER = 'admin';
const ADMIN_PASS = 'admin2024';

async function run() {
    try {
        // 1) Ver esquema de la tabla user
        console.log('\n=== ESQUEMA TABLA user ===');
        const cols = await userDb.query('DESCRIBE `user`');
        console.table(cols.map(c => ({ Field: c.Field, Type: c.Type, Null: c.Null, Key: c.Key, Default: c.Default })));

        // 2) Ver usuarios actuales
        console.log('\n=== USUARIOS ACTUALES ===');
        const users = await userDb.query('SELECT id, nombre_usuario, rol, prestador_id FROM `user`');
        console.table(users);

        // 3) Hashear contraseña
        const hashed = await bcrypt.hash(ADMIN_PASS, 10);
        console.log(`\nContraseña '${ADMIN_PASS}' hasheada OK.`);

        // 4) Verificar si ya existe el admin
        const existing = await userDb.query(
            'SELECT id FROM `user` WHERE nombre_usuario = ?',
            [ADMIN_USER]
        );

        if (existing.length > 0) {
            // Actualizar
            await userDb.query(
                'UPDATE `user` SET password = ?, rol = ? WHERE nombre_usuario = ?',
                [hashed, 'administrador', ADMIN_USER]
            );
            console.log(`\n✓ Usuario '${ADMIN_USER}' ACTUALIZADO con rol=administrador y nueva contraseña.`);
        } else {
            // Insertar nuevo
            // Primero revisar qué columnas son requeridas
            await userDb.query(
                'INSERT INTO `user` (nombre_usuario, password, rol) VALUES (?, ?, ?)',
                [ADMIN_USER, hashed, 'administrador']
            );
            console.log(`\n✓ Usuario '${ADMIN_USER}' CREADO con rol=administrador.`);
        }

        // 5) Verificar resultado final
        console.log('\n=== RESULTADO FINAL ===');
        const final = await userDb.query('SELECT id, nombre_usuario, rol, prestador_id FROM `user`');
        console.table(final);

    } catch (err) {
        console.error('\n✗ ERROR:', err.message);
        console.error(err);
    } finally {
        process.exit(0);
    }
}

run();
