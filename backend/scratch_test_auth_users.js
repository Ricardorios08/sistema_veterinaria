const userDb = require('./db/userDb');

async function test() {
    console.log("=== TESTING /auth/users QUERY SIMULATION FOR USER 'recepcion' ===");
    try {
        // Mock req.user for 'recepcion'
        const reqUser = {
            id: 5,
            nombre_usuario: 'recepcion',
            rol: 'recepcion',
            prestador_id: 2
        };

        const isSuperAdmin = reqUser.rol === 'superadmin';
        const isAdminUser = reqUser.rol === 'admin' || reqUser.rol === 'recepcion' || isSuperAdmin;
        
        let query = `
            SELECT u.id, u.nombre_usuario, u.rol, u.tipo_profesional_id, u.matricula, 
                   u.prestador_id, p.nombre as prestador_nombre,
                   tp.nombre as tipo_profesional_nombre 
            FROM user u
            LEFT JOIN tipo_profesional tp ON u.tipo_profesional_id = tp.id
            LEFT JOIN prestador p ON u.prestador_id = p.id
            WHERE u.FechaBaja IS NULL
        `;
        let params = [];
        
        if (!isSuperAdmin) {
            if (isAdminUser) {
                query += ' AND u.prestador_id = ?';
                params.push(reqUser.prestador_id);
            } else {
                query += ' AND u.id = ?';
                params.push(reqUser.id);
            }
        }
        
        query += ' ORDER BY u.nombre_usuario ASC';
        
        console.log("Query SQL:", query);
        console.log("Params:", params);

        const users = await userDb.query(query, params, reqUser.rol);
        console.log("Query Results:", users);

    } catch (err) {
        console.error("Query failed:", err);
    } finally {
        process.exit(0);
    }
}

test();
