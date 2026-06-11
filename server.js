const fs = require("fs");
const path = require("path");

const logFile = path.join(__dirname, "debug.log");

function logDebug(msg) {
    try {
        const timestamp = new Date().toISOString();
        fs.appendFileSync(logFile, `[${timestamp}] [SERVER.JS] ${msg}\n`);
    } catch (e) {}
}

logDebug("=== INICIANDO ENTRADA DESDE SERVER.JS ===");
logDebug(`CWD actual: ${process.cwd()}`);
logDebug(`__dirname: ${__dirname}`);
logDebug(`process.env.PORT original: ${process.env.PORT}`);
logDebug(`process.env.NODE_ENV: ${process.env.NODE_ENV}`);

try {
    const originalPort = process.env.PORT;
    
    logDebug("Cargando variables de entorno (.env)...");
    require("dotenv").config({ path: path.join(__dirname, "backend", ".env") });
    logDebug(`process.env.PORT cargado de .env: ${process.env.PORT}`);

    const isHostinger = __dirname.includes("u259434644") || process.env.NODE_ENV === "production";
    logDebug(`¿Es Hostinger detectado?: ${isHostinger}`);
    
    if (isHostinger) {
        process.env.PORT = originalPort || 3000;
        logDebug(`Puerto forzado para Hostinger: ${process.env.PORT}`);
    }

    logDebug("Delegando inicio a ./backend/index.js...");
    // Pasar una referencia al logger para usarlo en backend/index.js
    global.hostingerLogger = logDebug;
    require("./backend/index.js");
    logDebug("Delegación completada exitosamente.");
} catch (error) {
    logDebug(`ERROR CRÍTICO EN SERVER.JS: ${error.message}`);
    logDebug(`STACK TRACE: ${error.stack}`);
}