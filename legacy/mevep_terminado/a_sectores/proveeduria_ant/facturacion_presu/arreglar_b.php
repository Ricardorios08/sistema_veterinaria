<?include ("../../../conexiones/config_pro.php");

include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `compras_detalle`";
$result2 = $db->Execute($sql2);

if (!$result2) die("fallo".$db->ErrorMsg());

 while (!$result2->EOF) {

$nro_factura=strtoupper($result2->fields["nro_factura"]);
echo " - ";
$cod_mercaderia=strtoupper($result2->fields["cod_mercaderia"]);
echo " - ";
$lote=strtoupper($result2->fields["lote"]);
echo " - ";
$mes_lote=strtoupper($result2->fields["mes_lote"]);
echo " - ";
$anio_lote=strtoupper($result2->fields["anio_lote"]);
echo " - ";
$cantidad=strtoupper($result2->fields["cantidad"]);
echo " - ";
$precio_unitario=strtoupper($result2->fields["precio_unitario"]);
echo " - ";
$total=strtoupper($result2->fields["total"]);


echo "<br>";





ECHO $sql = "UPDATE `ventas_encabezado` SET  `neto_gravado` = '$neto_gravado' , `iva` = '$iva' WHERE `tipo_fact` = 'B' AND `nro_factura` = '$nro_factura'";
//mysql_query($sql);
echo "<br>";
	 $result2->MoveNext();
		}





