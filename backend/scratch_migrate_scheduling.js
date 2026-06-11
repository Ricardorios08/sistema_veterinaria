const userDb = require('./db/userDb');

async function run() {
    console.log("Starting database migration for Odomed scheduling columns...");
    try {
        // 1. Add scheduling columns to user table
        console.log("Adding scheduling columns to 'user' table...");
        
        const alterQuery = `
            ALTER TABLE \`user\`
            ADD COLUMN IF NOT EXISTS \`lunes\` TINYINT(1) NOT NULL DEFAULT 0,
            ADD COLUMN IF NOT EXISTS \`martes\` TINYINT(1) NOT NULL DEFAULT 0,
            ADD COLUMN IF NOT EXISTS \`miercoles\` TINYINT(1) NOT NULL DEFAULT 0,
            ADD COLUMN IF NOT EXISTS \`jueves\` TINYINT(1) NOT NULL DEFAULT 0,
            ADD COLUMN IF NOT EXISTS \`viernes\` TINYINT(1) NOT NULL DEFAULT 0,
            ADD COLUMN IF NOT EXISTS \`sabado\` TINYINT(1) NOT NULL DEFAULT 0,
            ADD COLUMN IF NOT EXISTS \`duracion_consulta\` INT(11) NOT NULL DEFAULT 30,
            ADD COLUMN IF NOT EXISTS \`espacio_entre_turnos\` INT(11) NOT NULL DEFAULT 0,
            ADD COLUMN IF NOT EXISTS \`cantidad_turnos_diarios\` INT(11) NOT NULL DEFAULT 10,
            ADD COLUMN IF NOT EXISTS \`horario_inicio\` VARCHAR(10) NOT NULL DEFAULT '08:00',
            ADD COLUMN IF NOT EXISTS \`observaciones_agenda\` TEXT DEFAULT NULL;
        `;
        
        await userDb.query(alterQuery);
        console.log("Columns successfully added!");

        // 2. Configure default hours for any existing professional users so they work out-of-the-box
        console.log("\nChecking for existing professionals in Odomed...");
        const professionals = await userDb.query("SELECT id, nombre_usuario FROM \`user\` WHERE rol = 'profesional'");
        console.log("Professionals found:", professionals);

        if (professionals.length > 0) {
            console.log("Updating existing professional users with default working schedule (e.g. Thursday & Friday starting at 08:00)...");
            for (const prof of professionals) {
                await userDb.query(`
                    UPDATE \`user\`
                    SET jueves = 1, viernes = 1,
                        duracion_consulta = 30,
                        espacio_entre_turnos = 10,
                        cantidad_turnos_diarios = 8,
                        horario_inicio = '08:00',
                        observaciones_agenda = 'Horario de atención general'
                    WHERE id = ?
                `, [prof.id]);
                console.log(`Updated professional: ${prof.nombre_usuario} (ID: ${prof.id})`);
            }
        } else {
            console.log("No existing professionals found. Let's make sure the admin or superadmin can be configured as a professional or we will create one later via User Management.");
        }

        console.log("\nMigration completed successfully!");

    } catch (err) {
        console.error("Migration failed:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
