const userDb = require('../db/userDb');

async function run() {
    console.log("Checking and creating auditoria_sistema table if not exists...");
    try {
        const createQuery = `
            CREATE TABLE IF NOT EXISTS \`auditoria_sistema\` (
              \`id\` INT(11) NOT NULL AUTO_INCREMENT,
              \`fecha\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              \`usuario\` VARCHAR(255) NOT NULL,
              \`accion\` VARCHAR(255) NOT NULL,
              \`detalles\` TEXT DEFAULT NULL,
              \`ip\` VARCHAR(100) DEFAULT NULL,
              PRIMARY KEY (\`id\`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        `;
        await userDb.query(createQuery);
        console.log("auditoria_sistema table is healthy and ready!");
    } catch (err) {
        console.error("Failed to create audit table:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
