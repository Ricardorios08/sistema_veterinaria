const path = require("path");

function logDebug(msg) {
    if (global.hostingerLogger) {
        global.hostingerLogger(msg);
    } else {
        console.log(msg);
    }
}

// Guardamos el puerto original asignado por el sistema antes de cargar dotenv
const originalPort = process.env.PORT;

const dotenv = require("dotenv");
dotenv.config({ path: path.join(__dirname, ".env") });

const express = require("express");
const cors = require("cors");
const userDb = require("./db/userDb");
const authParser = require("./middleware/authParser");

BigInt.prototype.toJSON = function () {
    return this.toString();
};

const app = express();

// Si estamos en producción/Hostinger, ignoramos el PORT=3010 del .env y usamos el original o 3000
const isHostinger = __dirname.includes("u259434644") || process.env.NODE_ENV === "production";
const PORT = isHostinger ? (originalPort || 3000) : (process.env.PORT || 3010);

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Frontend estático
const frontendPath = path.join(__dirname, "..", "frontend", "dist");
app.use(express.static(frontendPath));

// Archivos subidos (Radiografías, Informes, etc.)
app.use("/uploads", express.static(path.join(__dirname, "uploads")));

// API
app.use("/api", authParser);
app.use("/api/auth", require("./routes/auth"));
app.use("/api/pacientes", require("./routes/pacientes"));
app.use("/api/nomenclador", require("./routes/nomenclador"));
app.use("/api/turnos", require("./routes/turnos"));
app.use("/api/obras-sociales", require("./routes/obrasSociales"));
app.use("/api/prestadores", require("./routes/prestadores"));

// Health check
app.get("/api/test-connections", async (req, res) => {
    const result = {
        maria: { status: "testing", error: null },
    };

    try {
        await userDb.query("SELECT 1");
        result.maria.status = "connected";
    } catch (err) {
        result.maria.status = "failed";
        result.maria.error = err.message;
    }

    res.json(result);
});

// SPA fallback (ignore requests starting with /api)
app.get(/^(?!\/api).*/, (req, res) => {
    res.sendFile(path.join(frontendPath, "index.html"));
});

// Explicit API 404 handler
app.use("/api", (req, res) => {
    res.status(404).json({ error: "Endpoint de API no encontrado" });
});

try {
    logDebug(`Intentando escuchar en puerto ${PORT}...`);
    app.listen(PORT, "0.0.0.0", () => {
        logDebug(`Servidor iniciado y escuchando exitosamente en puerto ${PORT}`);
    });
} catch (error) {
    logDebug(`ERROR CRÍTICO AL INICIAR EL LISTENER EN EL BACKEND: ${error.message}`);
    logDebug(`STACK TRACE: ${error.stack}`);
}

module.exports = app;