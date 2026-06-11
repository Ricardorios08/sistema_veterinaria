 <?
 include("../../../../conexiones/config_pro.php");


$sql2 = "SELECT * FROM `existencias_nuevo`";
$result1 = $db->Execute($sql2);

  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

$cod_mercaderia=strtoupper($result1->fields["cod_mercaderia"]);
echo $cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
$lote=strtoupper($result1->fields["lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$fecha_ultimo_mov=strtoupper($result1->fields["fecha_ultimo_mov"]);

$sql="select * from mercaderia where cod_merca like '$cod_mercaderia' ";
$result = $db->Execute($sql);
$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);


$sql = "INSERT INTO `stock_nuevo` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `tipo_fact` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` ,  `mes_lote` , `anio_lote` , `cuenta` , `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha_ultimo_mov' , '1' ,  '0' , '1' , '$cantidad_ingresada' , '$precio_actualizado' , '$lote' , '$mes_lote', '$anio_lote' , '0' , '1')";
mysql_query($sql);

$sql2= "UPDATE `existencias_nuevo` SET `precio_unitario` = '$precio_actualizado' WHERE `cod_mercaderia` = '$cod_mercaderia'";
mysql_query($sql2);

$result1->MoveNext();
	}
?>

 <?/*
 include("../../../../conexiones/config_pro.php");


$sql2 = "SELECT * FROM `existencias_nuevo`";
$result1 = $db->Execute($sql2);

  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

$cod_mercaderia=strtoupper($result1->fields["cod_mercaderia"]);
$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
$lote=strtoupper($result1->fields["lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$fecha_ultimo_mov=strtoupper($result1->fields["fecha_ultimo_mov"]);

$sql="select * from mercaderia where cod_merca like '$cod_mercaderia' ";
$result = $db->Execute($sql);
$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);


$sql = "INSERT INTO `stock_nuevo1` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `tipo_fact` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` ,  `mes_lote` , `anio_lote` , `cuenta` , `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha_ultimo_mov' , '1' ,  '0' , '1' , '$cantidad' , '$precio_actualizado' , '$lote' , '$mes_lote', '$anio_lote' , '0' , '1')";
mysql_query($sql);

   
$result1->MoveNext();
	}*/
?>