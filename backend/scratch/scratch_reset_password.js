const userDb = require('../db/userDb');
const bcrypt = require('bcryptjs');

async function run() {
    try {
        const newPassword = 'admin456';
        const hashed = await bcrypt.hash(newPassword, 10);
        console.log(`Hashing password '${newPassword}' -> ${hashed}`);

        const result = await userDb.query(
            "UPDATE \`user\` SET password = ? WHERE nombre_usuario = 'admin'",
            [hashed]
        );
        console.log("Password updated successfully!", result);
    } catch (err) {
        console.error("Error updating password:", err);
    } finally {
        process.exit(0);
    }
}

run();
