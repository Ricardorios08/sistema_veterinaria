   <?


include("../../conexiones/config_pro.php");
$sql = "SELECT * FROM resumen_cta_vta  WHERE  `cod_movimiento` = 3 order by comprobante";
$result = $db->Execute($sql);
if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$afectacion=strtoupper($result->fields["afectacion"]);
$importe=strtoupper($result->fields["importe"]);
$fecha=strtoupper($result->fields["fecha"]);


$sql6="select * from  ventas_encabezado where nro_factura = $afectacion";
$result6= $db->Execute($sql6);

echo "saldo ---".$saldo_nc=strtoupper($result6->fields["saldo"]);
echo "<br>";
$saldo_a_guardar = $saldo_nc - $importe;




echo "<br>";
	 $result->MoveNext();
		}

