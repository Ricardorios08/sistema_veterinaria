const userDb = require('../db/userDb');

async function migrate() {
    console.log("=== RUNNING DATABASE MIGRATION FOR MULTIPLE ROLES ===");
    try {
        // Create user_rol table
        const createTableSql = `
            CREATE TABLE IF NOT EXISTS user_rol (
                user_id INT NOT NULL,
                rol ENUM('admin','usuario','superadmin','recepcion','profesional') NOT NULL,
                PRIMARY KEY (user_id, rol),
                CONSTRAINT fk_user_rol_user FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        `;
        console.log("Creating user_rol table...");
        await userDb.query(createTableSql);

        // Populate table with current roles to preserve existing data
        console.log("Migrating existing user roles to user_rol...");
        const populateSql = `
            INSERT IGNORE INTO user_rol (user_id, rol)
            SELECT id, rol FROM user
        `;
        await userDb.query(populateSql);

        console.log("Multi-role database migration completed successfully!");
    } catch (error) {
        console.error("Migration failed:", error);
    } finally {
        process.exit(0);
    }
}

migrate();
