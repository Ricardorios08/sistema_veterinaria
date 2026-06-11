const fs = require('fs');
const path = require('path');

const turnPath = path.join(__dirname, '../backend/routes/turnos.js');
let content = fs.readFileSync(turnPath, 'utf8');

// Normalize line endings
content = content.replace(/\r\n/g, '\n');

// 1. GET /
const oldGet = `        let sql = \`
            SELECT t.*, 
                   p.nombre as paciente_nombre, p.apellido as paciente_apellido, p.dni as paciente_dni, p.telefono as paciente_telefono,
                   u.nombre_usuario as odontologo_nombre
            FROM turno t
            INNER JOIN paciente p ON t.paciente_id = p.id
            INNER JOIN user u ON t.odontologo_id = u.id
            WHERE 1=1
        \`;
        let params = [];`;

const newGet = `        let sql = \`
            SELECT t.*, 
                   p.nombre as paciente_nombre, p.apellido as paciente_apellido, p.dni as paciente_dni, p.telefono as paciente_telefono,
                   u.nombre_usuario as odontologo_nombre
            FROM turno t
            INNER JOIN paciente p ON t.paciente_id = p.id
            INNER JOIN user u ON t.odontologo_id = u.id
            WHERE t.FechaBaja IS NULL
        \`;
        let params = [];

        if (req.user.rol !== 'superadmin') {
            sql += ' AND t.prestador_id = ?';
            params.push(req.user.prestador_id);
        }`;

if (content.includes(oldGet)) {
    content = content.replace(oldGet, newGet);
    console.log("-> Replaced GET / successfully.");
} else {
    console.error("-> COULD NOT find old GET / exactly.");
}

fs.writeFileSync(turnPath, content, 'utf8');
console.log("=== COMPLETED TURNOS GET / REPLACEMENTS ===");
