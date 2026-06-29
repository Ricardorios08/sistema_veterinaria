const mevepDb = require('../db/mevepDb');
const PDFDocument = require('pdfkit');
const fs = require('fs');
const path = require('path');

async function test() {
  try {
    console.log("Running query...");
    const rows = await mevepDb.query(
      `SELECT * FROM socios WHERE CAST(ruta AS UNSIGNED) BETWEEN 1 AND 10 AND no_imprimir = 'FALSO' ORDER BY CAST(ruta AS UNSIGNED) ASC, cod_socio ASC`
    );
    console.log(`Query returned ${rows.length} rows`);

    const doc = new PDFDocument({ margin: 20, size: [611, 905] });
    const writeStream = fs.createWriteStream(path.join(__dirname, 'test_receipt.pdf'));
    doc.pipe(writeStream);

    const drawReceipt = (x, y, socio, petName) => {
        doc.undash();
        doc.lineWidth(1).strokeColor('#cbd5e1');
        doc.rect(x, y, 270, 155).stroke();

        doc.font('Helvetica-Bold').fontSize(9).fillColor('#0f172a').text('MEVEP - CONTROL DE CUOTA', x + 10, y + 10);
        doc.font('Helvetica').fontSize(8).fillColor('#64748b').text(`FECHA: 2026-06-18`, x + 180, y + 10, { align: 'right', width: 80 });

        doc.moveTo(x + 10, y + 22).lineTo(x + 260, y + 22).strokeColor('#e2e8f0').stroke();

        doc.font('Helvetica-Bold').fontSize(8.5).fillColor('#1e293b').text(`${socio.apellido}, ${socio.nombre}`.toUpperCase(), x + 10, y + 28, { width: 250, ellipsis: true });
        doc.font('Helvetica').fontSize(7.5).fillColor('#64748b').text(`Nº SOCIO: ${socio.cod_socio}   |   RUTA: ${socio.ruta || '—'}`, x + 10, y + 38);
        doc.text(`DOMICILIO: ${socio.domicilio || ''} - ${socio.departamento || ''}`.toUpperCase(), x + 10, y + 48, { width: 250, ellipsis: true });

        doc.rect(x + 10, y + 60, 250, 40).fillAndStroke('#f8fafc', '#e2e8f0');
        doc.fillColor('#334155').font('Helvetica').fontSize(8).text('CONCEPTO', x + 15, y + 64);
        doc.text('IMPORTE', x + 210, y + 64, { align: 'right', width: 45 });
        doc.moveTo(x + 10, y + 74).lineTo(x + 260, y + 74).strokeColor('#e2e8f0').stroke();

        doc.fillColor('#0f172a').font('Helvetica-Bold').text(`1 Abono por: ${petName || 'Mascota'}`, x + 15, y + 80, { width: 180, ellipsis: true });
        doc.text(`$${parseFloat(socio.importe_cuota || 0).toFixed(2)}`, x + 210, y + 80, { align: 'right', width: 45 });

        doc.font('Helvetica-Bold').fontSize(14).fillColor('#2563eb').text('JUNIO', x + 10, y + 108);

        doc.font('Helvetica-Bold').fontSize(9).fillColor('#0f172a').text(`TOTAL: $${parseFloat(socio.importe_cuota || 0).toFixed(2)}`, x + 160, y + 108, { align: 'right', width: 100 });

        const barcodeVal = `${socio.cod_socio}0620260000000`;
        doc.font('Courier').fontSize(7).fillColor('#94a3b8').text(`*${barcodeVal}*`, x + 10, y + 142, { align: 'center', width: 250 });
    };

    console.log("Rendering receipts...");
    for (let i = 0; i < rows.length; i += 2) {
        if (i > 0) doc.addPage();

        doc.strokeColor('#cbd5e1').lineWidth(1).dash(4, { space: 4 });
        doc.moveTo(20, 452).lineTo(590, 452).stroke();
        doc.moveTo(305, 20).lineTo(305, 430).stroke();
        doc.moveTo(305, 474).lineTo(305, 880).stroke();

        const socio1 = rows[i];
        const pets1 = await mevepDb.query("SELECT nombre FROM animal WHERE cod_socio = ? LIMIT 1", [socio1.cod_socio]);
        const petName1 = pets1.length > 0 ? pets1[0].nombre : '';
        drawReceipt(20, 30, socio1, petName1);
        drawReceipt(320, 30, socio1, petName1);

        if (i + 1 < rows.length) {
            const socio2 = rows[i + 1];
            const pets2 = await mevepDb.query("SELECT nombre FROM animal WHERE cod_socio = ? LIMIT 1", [socio2.cod_socio]);
            const petName2 = pets2.length > 0 ? pets2[0].nombre : '';
            drawReceipt(20, 480, socio2, petName2);
            drawReceipt(320, 480, socio2, petName2);
        }
    }

    doc.end();
    console.log("PDF generated successfully!");
  } catch (err) {
    console.error("Error occurred:", err);
  } finally {
    process.exit();
  }
}

test();
