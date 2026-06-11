<?	
include("../../../conexiones/config_pro.php");


$sql2 = "SELECT * FROM `exist_ok`";
$result2 = $db->Execute($sql2);


if (!$result2) die("fallo".$db->ErrorMsg());
 while (!$result2->EOF) {


$nro_factura=$result2->fields["nro_factura"];
$cod_mercaderia=$result2->fields["cod_mercaderia"];
$lote=$result2->fields["lote"];
$mes_lote=$result2->fields["mes_lote"];
$anio_lote=$result2->fields["anio_lote"];
$cantidad_ingresada= $result2->fields["cantidad_ingresada"]; 


 echo $sql = "UPDATE `existencia_ago` SET `cantidad_ingresada` = '$cantidad_ingresada'  WHERE cod_mercaderia = '$cod_mercaderia' and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote= '$anio_lote' and nro_factura = '$nro_factura'";
mysql_query($sql);


$cont = $cont  + 1;

echo "<br>";

$result2->MoveNext();
				}

echo $cont;