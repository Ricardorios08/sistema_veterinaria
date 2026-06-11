<?php 	
	include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `existencia_ago` group by 'lote', 'anio_lote', 'mes_lote' order by 'cod_mercaderia'";
$result2 = $db->Execute($sql2);


if (!$result2) die("fallo".$db->ErrorMsg());
 while (!$result2->EOF) {


$cod_merca=$result2->fields["cod_mercaderia"];
$lote=$result2->fields["lote"];
$mes_lote=$result2->fields["mes_lote"];
$anio_lote=$result2->fields["anio_lote"];
$nro_factura=$result2->fields["nro_factura"];
$precio_unitario=$result2->fields["precio_unitario"];
$fecha_ultimo_mov= $result2->fields["fecha_ultimo_mov"]; 


echo  $sql3 = "SELECT sum(cantidad_ingresada) as cantidad_ingresada, sum(cantidad_salida) as cantidad_salida  FROM `existencia_ago` where cod_mercaderia = '$cod_merca' and anio_lote = '$anio_lote' and mes_lote = '$mes_lote' and lote = '$lote'";
$result3 = $db->Execute($sql3);

echo $cod_merca;
echo "-i-". $cantidad_ingresada=strtoupper($result3->fields["cantidad_ingresada"]);
echo "-s-".$cantidad_salida=strtoupper($result3->fields["cantidad_salida"]);



echo $sql = "INSERT INTO `existencia_arreglada` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `lote` ,  `mes_lote` , `anio_lote` , `cantidad_ingresada` , `precio_unitario` , `cantidad_salida` , `fecha_ultimo_mov` )  VALUES ('$nro_factura' , '' ,'$cod_merca' , '$lote' , '$mes_lote' , '$anio_lote', '$cantidad_ingresada' , '$precio_unitario' , '$cantidad_salida' , '$fecha_ultimo_mov')";
mysql_query($sql);
echo "<br>";

$result2->MoveNext();
				}