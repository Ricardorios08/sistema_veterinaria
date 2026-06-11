const fs = require('fs');
const path = require('path');

const indexPath = path.join(__dirname, '../backend/index.js');
let content = fs.readFileSync(indexPath, 'utf8');

// Normalize line endings
content = content.replace(/\r\n/g, '\n');

const oldRoutes = `// API Routes
app.use('/api/auth', require('./routes/auth'));
app.use('/api/pacientes', require('./routes/pacientes'));
app.use('/api/nomenclador', require('./routes/nomenclador'));
app.use('/api/turnos', require('./routes/turnos'));
app.use('/api/obras-sociales', require('./routes/obrasSociales'));`;

const newRoutes = `// API Routes
app.use('/api/auth', require('./routes/auth'));
app.use('/api/pacientes', require('./routes/pacientes'));
app.use('/api/nomenclador', require('./routes/nomenclador'));
app.use('/api/turnos', require('./routes/turnos'));
app.use('/api/obras-sociales', require('./routes/obrasSociales'));
app.use('/api/prestadores', require('./routes/prestadores'));`;

if (content.includes(oldRoutes)) {
    content = content.replace(oldRoutes, newRoutes);
    fs.writeFileSync(indexPath, content, 'utf8');
    console.log("-> Replaced index routes successfully.");
} else {
    console.error("-> COULD NOT find old index routes exactly.");
}
