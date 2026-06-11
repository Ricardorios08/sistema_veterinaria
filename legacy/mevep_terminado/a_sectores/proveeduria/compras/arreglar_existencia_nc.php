<?php 	
include("../../../conexiones/config_pro.php");


$sql2 = "SELECT * FROM `ventas_encabezado` where cod_operacion = 3 order by fecha desc";
$result2 = $db->Execute($sql2);


if (!$result2) die("fallo".$db->ErrorMsg());
 while (!$result2->EOF) {


$nro_factura=$result2->fields["nro_factura"];
$nro_proveedor=$result2->fields["nro_proveedor"];
$fecha=$result2->fields["fecha"];
$tipo_fact=$result2->fields["tipo_fact"];



$sql3 = "SELECT * FROM `ventas_detalle` where nro_factura = '$nro_factura' order by 'cod_mercaderia'";
$result3 = $db->Execute($sql3);

 while (!$result3->EOF) {
$cod_mercaderia=$result3->fields["cod_mercaderia"];
$lote=$result3->fields["lote"];
$mes_lote=$result3->fields["mes_lote"];
$anio_lote=$result3->fields["anio_lote"];
$precio_unitario=$result3->fields["precio_unitario"];
$cantidad= $result3->fields["cantidad"]; 

if ($cantidad < 0){
	$cantidad = $cantidad * (-1);
}

$cont = $cont  + 1;

echo $sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `tipo_fact` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` ,  `mes_lote` , `anio_lote` , `cuenta` , `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , '3' ,  '$tipo_fact' , '$nro_factura' , '$cantidad' , '$precio_unitario' , '$lote' , '$mes_lote', '$anio_lote' , '$nro_proveedor' , '')";
mysql_query($sql);
echo "<br>";


$result3->MoveNext();
 }

$result2->MoveNext();
				}

				echo $cont;