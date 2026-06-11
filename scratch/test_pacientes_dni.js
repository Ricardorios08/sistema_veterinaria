const userDb = require('../backend/db/userDb');

async function test() {
    console.log("=== STARTING DNI COMPOSITE KEY INTEGRITY TEST ===");
    const testDni = '99887766';
    try {
        // Clean up any previous test runs
        console.log("Cleaning up previous test data...");
        await userDb.query("DELETE FROM paciente WHERE dni = ?", [testDni]);

        // Insert first patient (Prestador 1)
        console.log("\n1. Inserting Patient 1 (DNI: 99887766, Prestador: 1)...");
        await userDb.query(
            "INSERT INTO paciente (nombre, apellido, dni, telefono, email, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())",
            ["TestOne", "Patient", testDni, "12345678", "test1@example.com", 1, "SYSTEM_TEST"]
        );
        console.log("-> Success! Patient 1 inserted.");

        // Insert second patient (Prestador 2)
        console.log("\n2. Inserting Patient 2 (DNI: 99887766, Prestador: 2)...");
        await userDb.query(
            "INSERT INTO paciente (nombre, apellido, dni, telefono, email, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())",
            ["TestTwo", "Patient", testDni, "87654321", "test2@example.com", 2, "SYSTEM_TEST"]
        );
        console.log("-> Success! Patient 2 inserted under a different prestador.");

        // Insert third patient (Duplicate under Prestador 1)
        console.log("\n3. Trying to insert duplicate Patient 3 (DNI: 99887766, Prestador: 1)...");
        try {
            await userDb.query(
                "INSERT INTO paciente (nombre, apellido, dni, telefono, email, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())",
                ["TestThree", "Patient", testDni, "99999999", "test3@example.com", 1, "SYSTEM_TEST"]
            );
            console.error("-> FAILURE: Duplicate patient insert succeeded when it should have failed!");
        } catch (dbErr) {
            console.log(`-> SUCCESS: Duplicate insert failed as expected! Error message: ${dbErr.message}`);
        }

        // Clean up
        console.log("\nCleaning up test data...");
        await userDb.query("DELETE FROM paciente WHERE dni = ?", [testDni]);
        console.log("-> Cleanup complete.");

    } catch (err) {
        console.error("General error in test execution:", err);
    } finally {
        process.exit(0);
    }
}

test();
