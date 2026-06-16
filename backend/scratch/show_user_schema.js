const db = require('../db/userDb');

async function run() {
    const r = await db.query('SHOW CREATE TABLE `user`');
    console.log(r[0]['Create Table']);
    process.exit(0);
}
run().catch(e => { console.error(e.message); process.exit(1); });
