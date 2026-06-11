const userDb = require('../db/userDb');

async function migrate() {
    console.log("=== RUNNING DATABASE MIGRATION FOR NEW USER FIELDS ===");
    try {
        // Check if columns already exist
        const columns = await userDb.query("SHOW COLUMNS FROM user");
        const existingFields = columns.map(c => c.Field.toLowerCase());

        const addQuery = [];
        
        if (!existingFields.includes('nombre')) {
            addQuery.push("ADD COLUMN nombre VARCHAR(100) DEFAULT NULL");
        }
        if (!existingFields.includes('apellido')) {
            addQuery.push("ADD COLUMN apellido VARCHAR(100) DEFAULT NULL");
        }
        if (!existingFields.includes('mail')) {
            addQuery.push("ADD COLUMN mail VARCHAR(255) DEFAULT NULL");
        }
        if (!existingFields.includes('celular')) {
            addQuery.push("ADD COLUMN celular VARCHAR(50) DEFAULT NULL");
        }
        if (!existingFields.includes('direccion')) {
            addQuery.push("ADD COLUMN direccion VARCHAR(255) DEFAULT NULL");
        }

        if (addQuery.length > 0) {
            const sql = `ALTER TABLE user ${addQuery.join(', ')}`;
            console.log("Executing SQL:", sql);
            await userDb.query(sql);
            console.log("Database columns added successfully!");
        } else {
            console.log("All columns already exist. No migration needed.");
        }
    } catch (error) {
        console.error("Migration failed:", error);
    } finally {
        process.exit(0);
    }
}

migrate();
