const userDb = require('../db/userDb');

/**
 * Writes a log entry directly to the auditoria_sistema database table.
 * @param {string} user - Username or 'SYSTEM'
 * @param {string} action - Action performed (e.g., LOGIN, SEARCH, EXPORT)
 * @param {string} details - Additional info
 * @param {object} req - Optional Express request object to extract IP/Metadata
 */
const logAction = (user, action, details = '', req = null) => {
    try {
        const ip = req ? (req.headers['x-forwarded-for'] || req.socket.remoteAddress || '127.0.0.1') : 'N/A';
        
        // Clean IP format if needed (e.g., remove IPv6 prefix for localhost)
        const cleanIp = ip === '::1' ? '127.0.0.1' : ip;

        // Perform insert asynchronously so it does not block the response lifecycle
        userDb.query(
            'INSERT INTO auditoria_sistema (usuario, accion, detalles, ip) VALUES (?, ?, ?, ?)',
            [user, action, details || null, cleanIp]
        ).catch(err => {
            console.error('[DB LOGGER BACKGROUND ERROR] Failed to save audit log:', err.message);
        });
        
        // Also log to console for development visibility
        console.log(`[AUDIT] [IP: ${cleanIp}] [USER: ${user}] [ACTION: ${action}] ${details}`);
    } catch (err) {
        console.error('[LOGGER ERROR] Could not log action:', err.message);
    }
};

module.exports = {
    logAction
};
