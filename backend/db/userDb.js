const path = require('path');
const dotenv = require('dotenv');
dotenv.config({ path: path.join(__dirname, '../.env') });

const mariadb = require('mariadb');

function logDebug(msg) {
    if (global.hostingerLogger) {
        global.hostingerLogger(msg);
    } else {
        console.log(msg);
    }
}

// Detección dinámica de entorno para la base de datos
const isHostinger = __dirname.includes("u259434644") || process.env.NODE_ENV === "production";
const resolvedHost = isHostinger ? "127.0.0.1" : process.env.MARIA_HOST;

// Auto-curación de contraseña: si Hostinger recortó el '#' (dejando longitud 12), lo restauramos
let resolvedPass = process.env.MARIA_PASS;
if (isHostinger && resolvedPass === "S0p0rt3s2021") {
    resolvedPass = "S0p0rt3s2021#";
}

logDebug(`[USER DB] Inicializando Pool de Base de Datos para Host: ${resolvedHost}`);
logDebug(`[USER DB] MARIA_USER: ${process.env.MARIA_USER}`);
logDebug(`[USER DB] MARIA_DB_NAME: ${process.env.MARIA_DB_NAME}`);
logDebug(`[USER DB] MARIA_PORT: ${process.env.MARIA_PORT}`);
logDebug(`[USER DB] MARIA_PASS corregida existe: ${!!resolvedPass} (Longitud final: ${resolvedPass ? resolvedPass.length : 0})`);

// Prueba de conexión de diagnóstico en segundo plano al arrancar
(async () => {
    logDebug("[USER DB] Realizando prueba de conexión de diagnóstico cruda...");
    try {
        const conn = await mariadb.createConnection({
            host: resolvedHost,
            port: parseInt(process.env.MARIA_PORT || "3306"),
            database: process.env.MARIA_DB_NAME || 'u259434644_odomed',
            user: process.env.MARIA_USER,
            password: resolvedPass,
            connectTimeout: 5000
        });
        logDebug("[USER DB] ¡ÉXITO! Conexión de diagnóstico cruda establecida exitosamente.");
        await conn.end();
    } catch (err) {
        logDebug(`[USER DB] FALLÓ LA CONEXIÓN DE DIAGNÓSTICO CRUDA: ${err.message}`);
        logDebug(`[USER DB] CÓDIGO DE ERROR: ${err.code} (SQLState: ${err.sqlState})`);
        logDebug(`[USER DB] STACK DEL ERROR DE CONEXIÓN: ${err.stack}`);
    }
})();

const poolConfig = {
     host: resolvedHost, 
     port: parseInt(process.env.MARIA_PORT || "3306"),
     database: process.env.MARIA_DB_NAME || 'u259434644_odomed',
     user: process.env.MARIA_USER,
     password: resolvedPass,
     // Lower connectionLimit to 4 to prevent exceeding hosting limits (e.g. max_connections_per_hour)
     connectionLimit: 4, 
     connectTimeout: 10000,
     acquireTimeout: 10000,
     allowPublicKeyRetrieval: true
};

// Single pool shared for all queries
const pool = mariadb.createPool(poolConfig);

module.exports = {
    // Standard query
    query: async (sql, params, rol = null) => {
        let conn;
        try {
            conn = await pool.getConnection();
            const res = await conn.query(sql, params);
            return res;
        } finally {
            if (conn) conn.release();
        }
    },
    // Query with explicit role (alias to standard query for compatibility)
    queryWithRole: async (rol, sql, params) => {
        let conn;
        try {
            conn = await pool.getConnection();
            const res = await conn.query(sql, params);
            return res;
        } finally {
            if (conn) conn.release();
        }
    },
    adminPool: pool,
    userPool: pool,
    pool
};
