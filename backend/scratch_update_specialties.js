const userDb = require('./db/userDb');

async function run() {
    try {
        console.log("Setting foreign key checks to 0...");
        await userDb.query("SET FOREIGN_KEY_CHECKS = 0");

        console.log("Truncating tipo_profesional table...");
        await userDb.query("TRUNCATE TABLE \`tipo_profesional\`");

        console.log("Inserting new veterinary specialties...");
        await userDb.query(`
            INSERT INTO \`tipo_profesional\` (id, nombre, descripcion, CreacionUsuario) VALUES 
            (1, 'veterinario', 'Médico veterinario general y especialista', 'SYSTEM_MIGRATION'),
            (2, 'radiologo', 'Especialista en diagnóstico por imágenes y radiografías', 'SYSTEM_MIGRATION'),
            (3, 'bioquimico', 'Especialista en análisis clínicos y de laboratorio', 'SYSTEM_MIGRATION'),
            (4, 'peluquero', 'Servicios de peluquería, baño y estética animal', 'SYSTEM_MIGRATION'),
            (5, 'cobrador', 'Gestión de caja, cobros y facturación', 'SYSTEM_MIGRATION'),
            (6, 'ninguna', 'Sin especialidad asignada', 'SYSTEM_MIGRATION')
        `);

        console.log("Setting foreign key checks back to 1...");
        await userDb.query("SET FOREIGN_KEY_CHECKS = 1");

        console.log("Specialties successfully updated in the database!");
    } catch (err) {
        console.error("Error updating specialties:", err);
    } finally {
        process.exit(0);
    }
}

run();
