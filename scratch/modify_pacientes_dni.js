const fs = require('fs');
const path = require('path');

const pacPath = path.join(__dirname, '../backend/routes/pacientes.js');
let content = fs.readFileSync(pacPath, 'utf8');

// Normalize line endings
content = content.replace(/\r\n/g, '\n');

// 1. POST / check
const oldPostCheck = `        // Check if DNI already exists
        const existing = await userDb.query('SELECT id FROM paciente WHERE dni = ?', [dni], req.user.rol);`;

const newPostCheck = `        // Check if DNI already exists for this prestador
        const existing = await userDb.query('SELECT id FROM paciente WHERE dni = ? AND prestador_id = ? AND FechaBaja IS NULL', [dni, req.user.prestador_id || 1], req.user.rol);`;

if (content.includes(oldPostCheck)) {
    content = content.replace(oldPostCheck, newPostCheck);
    console.log("-> Replaced POST DNI check successfully.");
} else {
    console.error("-> COULD NOT find old POST DNI check exactly.");
}

// 2. PUT /:id check
const oldPutCheck = `        // Check if DNI exists in another patient
        const existing = await userDb.query('SELECT id FROM paciente WHERE dni = ? AND id != ? AND FechaBaja IS NULL', [dni, id], req.user.rol);`;

const newPutCheck = `        // Check if DNI exists in another patient for this prestador
        const existing = await userDb.query('SELECT id FROM paciente WHERE dni = ? AND id != ? AND prestador_id = ? AND FechaBaja IS NULL', [dni, id, req.user.prestador_id || 1], req.user.rol);`;

if (content.includes(oldPutCheck)) {
    content = content.replace(oldPutCheck, newPutCheck);
    console.log("-> Replaced PUT DNI check successfully.");
} else {
    console.error("-> COULD NOT find old PUT DNI check exactly.");
}

fs.writeFileSync(pacPath, content, 'utf8');
console.log("=== COMPLETED PACIENTES DNI REPLACEMENTS ===");
