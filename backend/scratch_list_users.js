const userDb = require('./db/userDb');

async function run() {
    try {
        const rows = await userDb.query("SELECT id, nombre_usuario, rol, prestador_id FROM \`user\`");
        console.log("Users in u259434644_odomed:", rows);
    } catch (err) {
        console.error(err);
    } finally {
        process.exit(0);
    }
}

run();
