const userDb = require('./db/userDb');

async function run() {
    try {
        console.log("Connecting to remote database...");
        await userDb.query(`
            CREATE TABLE IF NOT EXISTS historia_clinica_archivo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                historia_clinica_id INT NOT NULL,
                nombre_archivo VARCHAR(255) NOT NULL,
                ruta_archivo VARCHAR(500) NOT NULL,
                tipo_archivo VARCHAR(100),
                CreacionUsuario VARCHAR(255),
                FechaCreacion DATETIME DEFAULT CURRENT_TIMESTAMP,
                FechaBaja DATETIME NULL,
                BajaUsuario VARCHAR(255) NULL,
                FOREIGN KEY (historia_clinica_id) REFERENCES historia_clinica(id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        `, [], 'superadmin');
        console.log("Table historia_clinica_archivo created/verified successfully on remote database.");
    } catch (err) {
        console.error(err);
    } finally {
        process.exit();
    }
}
run();
