const path = require('path');
const dotenv = require('dotenv');
dotenv.config({ path: path.join(__dirname, '../.env') });

const mariadb = require('mariadb');

// La base MEVEP siempre es remota (base legacy en producción, solo lectura)
const pool = mariadb.createPool({
    host: process.env.MEVEP_HOST || '193.203.175.222',
    port: parseInt(process.env.MEVEP_PORT || '3306'),
    database: process.env.MEVEP_DB || 'u259434644_mevep',
    user: process.env.MEVEP_USER || 'u259434644_mevep',
    password: process.env.MEVEP_PASS || 'S0p0rt3s2021',
    connectionLimit: 3,
    connectTimeout: 10000,
    acquireTimeout: 10000,
});

module.exports = {
    query: async (sql, params) => {
        let conn;
        try {
            conn = await pool.getConnection();
            return await conn.query(sql, params);
        } finally {
            if (conn) conn.release();
        }
    },
    pool
};
