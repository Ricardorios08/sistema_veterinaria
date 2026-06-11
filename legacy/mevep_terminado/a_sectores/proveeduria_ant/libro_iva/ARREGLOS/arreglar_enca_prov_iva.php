<?

include("../../../../conexiones/config_grabacion.php");
//echo $sql2 = "SELECT * FROM `ventas_encabezado` where tipo_fact = 'B' and tipo = '4'";
echo $sql2 = "SELECT * FROM `ventas_encabezado_back` where tipo_fact = 'B' and tipo = '4'";
$result2 = $db_pro->Execute($sql2);

if (!$result2) die("fallo".$db->ErrorMsg());

 while (!$result2->EOF) {

$tipo_fact=strtoupper($result2->fields["tipo_fact"]);
$nro_factura=strtoupper($result2->fields["nro_factura"]);
$neto=strtoupper($result2->fields["neto"]);


echo $sql8 = "UPDATE `ventas_encabezado_back` SET  `iva` = '0.00' , `neto_gravado` = '$neto' WHERE `tipo_fact` = '$tipo_fact' AND `nro_factura` = '$nro_factura'";
$result8 = $db_pro->Execute($sql8);
echo "<br>";
	 $result2->MoveNext();
		}





