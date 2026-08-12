const mariadb = require('mariadb');
require('dotenv').config();

const pool = mariadb.createPool({
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || '',
    database: process.env.DB_NAME || 'odontoweb',
    connectionLimit: 5
});

async function run() {
    let conn;
    try {
        conn = await pool.getConnection();
        const rows = await conn.query("SHOW TABLES");
        console.log("Tables:", rows.map(r => Object.values(r)[0]));
        
        await conn.query(`
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
        `);
        console.log("Table historia_clinica_archivo created/verified successfully.");
    } catch (err) {
        console.error(err);
    } finally {
        if (conn) conn.end();
        process.exit();
    }
}
run();
