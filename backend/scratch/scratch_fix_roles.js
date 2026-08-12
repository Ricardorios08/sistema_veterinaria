const userDb = require('../db/userDb');

async function fix() {
    console.log("=== FIXING USER ROLES IN DATABASE ===");
    try {
        // 1. List users with problem roles
        const usersBefore = await userDb.query("SELECT id, nombre_usuario, rol FROM user");
        console.log("Users before fix:", usersBefore);

        // 2. Update user with 'recepcion' username to 'recepcion' role
        console.log("\nUpdating users with username 'recepcion' or role 'municipalidad' or empty to 'recepcion'...");
        const result = await userDb.query(
            "UPDATE user SET rol = 'recepcion' WHERE nombre_usuario = 'recepcion' OR rol = 'municipalidad' OR rol = ''"
        );
        console.log("Update query result:", result);

        // 3. List users again
        const usersAfter = await userDb.query("SELECT id, nombre_usuario, rol FROM user");
        console.log("\nUsers after fix:", usersAfter);

    } catch (err) {
        console.error("Error updating user roles:", err);
    } finally {
        process.exit(0);
    }
}

fix();
