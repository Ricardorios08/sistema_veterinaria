<?include ("../../../conexiones/config_pro.php");

include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas_encabezado` where fecha between '2008-11-01' and '9999-99-99'";
$result2 = $db->Execute($sql2);

if (!$result2) die("fallo".$db->ErrorMsg());

 while (!$result2->EOF) {

$neto=strtoupper($result2->fields["neto"]);




$nro_factura=strtoupper($result2->fields["nro_factura"]);


$iva=strtoupper($result2->fields["iva"]);

$neto_gravado = $neto - $iva;

ECHO $sql = "UPDATE `ventas_encabezado` SET  `neto_gravado` = '$neto_gravado' WHERE `tipo_fact` = 'A' AND `nro_factura` = '$nro_factura'";
//mysql_query($sql);

	 $result2->MoveNext();
		}





