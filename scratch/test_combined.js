const postgres = require('../backend/db/postgres');
const maria = require('../backend/db/maria');

async function test() {
    try {
        const numeapre = '';
        const cuenctct = '76169';
        const codiof = '6';
        const estado = '';
        const tituapre = '';

        // 1. Build MariaDB Query dynamically
        let mariaSql = `SELECT a.NumeApre as numeapre, a.CuenCtct as cuenctct, a.CodiOfic as codiofic, a.TotaApre as totaapre, ea.DetaEsap as estadodeta, a.TituApre as tituapre FROM recaudacion2.apremio a LEFT JOIN recaudacion2.estadoapremio ea ON a.EstaApre = ea.CodiEsap WHERE 1=1`;
        const mariaParams = [];

        if (numeapre && numeapre.trim()) {
            mariaSql += " AND a.NumeApre = ?";
            mariaParams.push(parseInt(numeapre.trim()));
        }
        if (cuenctct && cuenctct.trim()) {
            mariaSql += " AND a.CuenCtct = ?";
            mariaParams.push(cuenctct.trim());
        }
        if (codiof && codiof.trim()) {
            mariaSql += " AND a.CodiOfic = ?";
            mariaParams.push(parseInt(codiof.trim()));
        }
        if (estado && estado.trim()) {
            mariaSql += " AND ea.DetaEsap LIKE ?";
            mariaParams.push(`%${estado.trim()}%`);
        }
        if (tituapre && tituapre.trim()) {
            mariaSql += " AND a.TituApre LIKE ?";
            mariaParams.push(`%${tituapre.trim()}%`);
        }
        mariaSql += " ORDER BY a.NumeApre DESC LIMIT 50";

        console.log("MariaDB SQL:", mariaSql);
        console.log("MariaDB Params:", mariaParams);

        // 2. Build PostgreSQL Query dynamically
        let pgSql = `SELECT DISTINCT c.cedid, c.cednro, c.cedimptot, c.cedestado, c.cedseccod, c.cedpercod, TRIM(p.pernom) as pernom FROM public.cedula c LEFT JOIN public.persona p ON c.cedpercod = p.percod`;
        const pgWhere = [];
        const pgParams = [];

        if (cuenctct && cuenctct.trim()) {
            pgSql += " JOIN public.tcedulacedcuo cc ON c.cednro = cc.cednro";
            pgWhere.push(`cc.cedcuotribcod = $${pgParams.length + 1}`);
            pgParams.push(parseInt(cuenctct.trim()));
        }
        if (numeapre && numeapre.trim()) {
            pgWhere.push(`c.cedid = $${pgParams.length + 1}`);
            pgParams.push(numeapre.trim());
        }
        if (codiof && codiof.trim()) {
            pgWhere.push(`c.cedseccod = $${pgParams.length + 1}`);
            pgParams.push(parseInt(codiof.trim()));
        }
        if (pgWhere.length > 0) {
            pgSql += " WHERE " + pgWhere.join(" AND ");
        }
        pgSql += " LIMIT 50";

        console.log("Postgres SQL:", pgSql);
        console.log("Postgres Params:", pgParams);

        const [mariaResults, pgRes] = await Promise.all([
            maria.query(mariaSql, mariaParams),
            postgres.query(pgSql, pgParams)
        ]);

        console.log("MariaDB raw rows found:", mariaResults.length);
        console.log("Postgres raw rows found:", pgRes.rows.length);

        let finalMariaResults = [...mariaResults];
        let finalPgRows = [...pgRes.rows];

        const pgIds = finalPgRows.map(r => r.cedid);
        const missingMariaIds = pgIds.filter(pid => !finalMariaResults.some(m => m.numeapre.toString() === pid.toString()));
        if (missingMariaIds.length > 0) {
            console.log("Missing MariaDB IDs to fetch:", missingMariaIds);
        }

        const mariaIds = finalMariaResults.map(r => r.numeapre);
        const missingPgIds = mariaIds.filter(mid => !finalPgRows.some(p => p.cedid.toString() === mid.toString())).map(mid => mid.toString());
        if (missingPgIds.length > 0) {
            console.log("Missing Postgres IDs to fetch:", missingPgIds);
            const extraPg = await postgres.query(`SELECT c.cedid, c.cednro, c.cedimptot, c.cedestado, c.cedseccod, c.cedpercod, TRIM(p.pernom) as pernom FROM public.cedula c LEFT JOIN public.persona p ON c.cedpercod = p.percod WHERE c.cedid = ANY($1::text[])`, [missingPgIds]);
            console.log("Fetched extra Postgres rows:", extraPg.rows.length);
            finalPgRows = [...finalPgRows, ...extraPg.rows];
        }

        const allIds = new Set([...finalMariaResults.map(r => r.numeapre.toString()), ...finalPgRows.map(r => r.cedid.toString())]);
        const combined = Array.from(allIds).map(idStr => {
            const m = finalMariaResults.find(r => r.numeapre.toString() === idStr);
            const p = finalPgRows.find(r => r.cedid.toString() === idStr);
            return { id: idStr, inMaria: !!m, inPostgres: !!p };
        });

        console.log("COMBINED RESULT:", combined);

    } catch (err) {
        console.error("CRITICAL ERROR IN ROUTE LOGIC:", err);
    } finally {
        process.exit(0);
    }
}
test();
