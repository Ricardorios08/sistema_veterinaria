const userDb = require('./db/userDb');

async function run() {
    try {
        console.log("Altering user table rol column...");
        await userDb.query(
            "ALTER TABLE \`user\` MODIFY COLUMN \`rol\` ENUM('admin','usuario','superadmin','recepcion','profesional','veterinario','peluquero','traslado','cobrador') NOT NULL DEFAULT 'usuario'"
        );
        console.log("user table altered successfully.");

        console.log("Altering user_rol table rol column...");
        await userDb.query(
            "ALTER TABLE \`user_rol\` MODIFY COLUMN \`rol\` ENUM('admin','usuario','superadmin','recepcion','profesional','veterinario','peluquero','traslado','cobrador') NOT NULL"
        );
        console.log("user_rol table altered successfully.");

        console.log("Roles successfully updated in the database!");
    } catch (err) {
        console.error("Error updating database roles:", err);
    } finally {
        process.exit(0);
    }
}

run();
