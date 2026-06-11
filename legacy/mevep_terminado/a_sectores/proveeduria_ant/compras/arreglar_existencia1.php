<?	
include("../../../conexiones/config_pro.php");


$sql2 = "SELECT * FROM `compras_encabezado` order by fecha desc";
$result2 = $db->Execute($sql2);


if (!$result2) die("fallo".$db->ErrorMsg());
 while (!$result2->EOF) {


$nro_factura=$result2->fields["nro_factura"];
$nro_proveedor=$result2->fields["nro_proveedor"];
$fecha=$result2->fields["fecha"];


echo $sql3 = "SELECT * FROM `compras_detalle` where nro_factura = '$nro_factura' order by 'cod_mercaderia'";
$result3 = $db->Execute($sql3);

 while (!$result3->EOF) {
$cod_mercaderia=$result3->fields["cod_mercaderia"];
$lote=$result3->fields["lote"];
$mes_lote=$result3->fields["mes_lote"];
$anio_lote=$result3->fields["anio_lote"];
$precio_unitario=$result3->fields["precio_unitario"];
$cantidad= $result3->fields["cantidad"]; 

$cont = $cont  + 1;

echo $sql = "INSERT INTO `stock_ago` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `tipo_fact` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` ,  `mes_lote` , `anio_lote` , `cuenta` , `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , '2' ,  'A' , '$nro_factura' , '$cantidad' , '$precio_unitario' , '$lote' , '$mes_lote', '$anio_lote' , '$nro_proveedor' , '')";
mysql_query($sql);
echo "<br>";


$result3->MoveNext();
 }

$result2->MoveNext();
				}

				echo $cont;