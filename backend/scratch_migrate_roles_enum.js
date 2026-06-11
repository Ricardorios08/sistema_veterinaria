const userDb = require('./db/userDb');

async function run() {
    console.log("=== STARTING DATABASE MIGRATION: ALTER USER ROL ENUM ===");
    try {
        // 1. Temporarily change any existing 'municipalidad' role to a valid enum role (e.g. 'usuario') so the alter statement doesn't fail
        console.log("Normalizing existing roles before ALTER...");
        await userDb.query("UPDATE user SET rol = 'usuario' WHERE rol = 'municipalidad' OR rol = ''");

        // 2. Alter the table column enum to replace 'municipalidad' with 'recepcion'
        console.log("Altering user table to update 'rol' column enum values...");
        await userDb.query(`
            ALTER TABLE \`user\` 
            MODIFY COLUMN \`rol\` ENUM('admin','usuario','superadmin','recepcion','profesional') NOT NULL DEFAULT 'usuario'
        `);
        console.log("-> Success! 'rol' column enum modified successfully.");

        // 3. Set the 'recepcion' username user's role to 'recepcion'
        console.log("Setting 'recepcion' role for the user with name 'recepcion'...");
        await userDb.query("UPDATE user SET rol = 'recepcion' WHERE nombre_usuario = 'recepcion'");
        
        console.log("\n=== MIGRATION COMPLETED SUCCESSFULLY ===");
        
        // 4. Verify results
        const users = await userDb.query("SELECT id, nombre_usuario, rol FROM user");
        console.log("Current database users:", users);

    } catch (err) {
        console.error("Critical error during role migration:", err);
    } finally {
        process.exit(0);
    }
}

run();
