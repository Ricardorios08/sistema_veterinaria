const mevepDb = require('../db/mevepDb');

async function test() {
  try {
    const counts = await mevepDb.query("SELECT COUNT(*) as total FROM socios");
    console.log("Total legacy socios:", counts[0].total);

    const countsFalso = await mevepDb.query("SELECT COUNT(*) as total FROM socios WHERE no_imprimir = 'FALSO'");
    console.log("Socios with no_imprimir = 'FALSO':", countsFalso[0].total);

    const countsByRuta = await mevepDb.query("SELECT MIN(CAST(ruta AS UNSIGNED)) as minRuta, MAX(CAST(ruta AS UNSIGNED)) as maxRuta FROM socios WHERE ruta REGEXP '^[0-9]+$'");
    console.log("Ruta range:", countsByRuta[0].minRuta, "to", countsByRuta[0].maxRuta);
  } catch (err) {
    console.error("Error:", err.message);
  } finally {
    process.exit(0);
  }
}
test();
