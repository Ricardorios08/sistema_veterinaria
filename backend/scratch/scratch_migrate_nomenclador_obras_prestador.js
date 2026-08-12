const userDb = require('../db/userDb');

async function run() {
    console.log("=== STARTING MIGRATION: NOMENCLADOR & OBRA SOCIAL TO MULTI-TENANT ===");
    try {
        // 1. ALTER TABLE nomenclador
        console.log("\n[1/4] Migrating nomenclador table...");

        // Add prestador_id column
        try {
            await userDb.query(`
                ALTER TABLE \`nomenclador\` 
                ADD COLUMN \`prestador_id\` INT(11) DEFAULT 1,
                ADD CONSTRAINT \`fk_nomenclador_prestador\` FOREIGN KEY (\`prestador_id\`) REFERENCES \`prestador\` (\`id\`) ON DELETE SET NULL
            `);
            console.log("-> prestador_id column and foreign key added to nomenclador.");
        } catch (e) {
            console.log("-> prestador_id column already exists or failed to add:", e.message);
        }

        // Drop single UNIQUE index on 'codigo'
        const dropNomQueries = [
            'ALTER TABLE \`nomenclador\` DROP INDEX IF EXISTS \`codigo\`',
            'ALTER TABLE \`nomenclador\` DROP INDEX IF EXISTS \`uq_nomenclador_codigo\`',
            'DROP INDEX IF EXISTS \`codigo\` ON \`nomenclador\`',
            'DROP INDEX IF EXISTS \`uq_nomenclador_codigo\` ON \`nomenclador\`',
            'ALTER TABLE \`nomenclador\` DROP INDEX \`codigo\`',
            'ALTER TABLE \`nomenclador\` DROP INDEX \`uq_nomenclador_codigo\`',
            'ALTER TABLE \`nomenclador\` DROP CONSTRAINT IF EXISTS \`codigo\`',
            'ALTER TABLE \`nomenclador\` DROP CONSTRAINT IF EXISTS \`uq_nomenclador_codigo\`',
        ];
        for (const q of dropNomQueries) {
            try {
                await userDb.query(q);
                console.log(`-> Success: ${q}`);
            } catch (err) {
                // Ignore errors
            }
        }

        // Add composite UNIQUE key on (codigo, prestador_id)
        try {
            await userDb.query(`
                ALTER TABLE \`nomenclador\` 
                ADD UNIQUE KEY \`uq_nomenclador_codigo_prestador\` (\`codigo\`, \`prestador_id\`)
            `);
            console.log("-> Composite unique index uq_nomenclador_codigo_prestador created.");
        } catch (e) {
            console.log("-> Composite unique index on nomenclador already exists or failed:", e.message);
        }


        // 2. ALTER TABLE obra_social
        console.log("\n[2/4] Migrating obra_social table...");

        // Add prestador_id column
        try {
            await userDb.query(`
                ALTER TABLE \`obra_social\` 
                ADD COLUMN \`prestador_id\` INT(11) DEFAULT 1,
                ADD CONSTRAINT \`fk_obra_social_prestador\` FOREIGN KEY (\`prestador_id\`) REFERENCES \`prestador\` (\`id\`) ON DELETE SET NULL
            `);
            console.log("-> prestador_id column and foreign key added to obra_social.");
        } catch (e) {
            console.log("-> prestador_id column already exists or failed to add:", e.message);
        }

        // Drop single UNIQUE index on 'nombre'
        const dropOsQueries = [
            'ALTER TABLE \`obra_social\` DROP INDEX IF EXISTS \`nombre\`',
            'ALTER TABLE \`obra_social\` DROP INDEX IF EXISTS \`uq_obra_social_nombre\`',
            'DROP INDEX IF EXISTS \`nombre\` ON \`obra_social\`',
            'DROP INDEX IF EXISTS \`uq_obra_social_nombre\` ON \`obra_social\`',
            'ALTER TABLE \`obra_social\` DROP INDEX \`nombre\`',
            'ALTER TABLE \`obra_social\` DROP INDEX \`uq_obra_social_nombre\`',
            'ALTER TABLE \`obra_social\` DROP CONSTRAINT IF EXISTS \`nombre\`',
            'ALTER TABLE \`obra_social\` DROP CONSTRAINT IF EXISTS \`uq_obra_social_nombre\`',
        ];
        for (const q of dropOsQueries) {
            try {
                await userDb.query(q);
                console.log(`-> Success: ${q}`);
            } catch (err) {
                // Ignore errors
            }
        }

        // Add composite UNIQUE key on (nombre, prestador_id)
        try {
            await userDb.query(`
                ALTER TABLE \`obra_social\` 
                ADD UNIQUE KEY \`uq_obra_social_nombre_prestador\` (\`nombre\`, \`prestador_id\`)
            `);
            console.log("-> Composite unique index uq_obra_social_nombre_prestador created.");
        } catch (e) {
            console.log("-> Composite unique index on obra_social already exists or failed:", e.message);
        }

        console.log("\n=== DATABASE SCHEMAS CONVERTED SUCCESSFULLY ===");
    } catch (err) {
        console.error("General error during migration:", err.message);
    } finally {
        process.exit(0);
    }
}

run();
