const userDb = require('./db/userDb');
const bcrypt = require('bcryptjs');

async function run() {
    try {
        const users = await userDb.query("SELECT * FROM \`user\` WHERE nombre_usuario = 'admin'");
        if (users.length === 0) {
            console.log("Admin user not found!");
            return;
        }
        const admin = users[0];
        console.log("Admin user:", {
            id: admin.id,
            nombre_usuario: admin.nombre_usuario,
            passwordHash: admin.password,
            rol: admin.rol
        });

        // Test passwords
        const testPasswords = ['admin456', 'admin123', 'admin', 'admin1234', 'S0p0rt3s2021#', '123456'];
        for (const pw of testPasswords) {
            const match = await bcrypt.compare(pw, admin.password);
            console.log(`Password '${pw}' matches: ${match}`);
        }
    } catch (err) {
        console.error(err);
    } finally {
        process.exit(0);
    }
}

run();
