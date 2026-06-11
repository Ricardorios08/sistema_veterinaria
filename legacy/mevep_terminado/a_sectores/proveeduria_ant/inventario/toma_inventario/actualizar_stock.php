<?	
$_SESSION['nombre'] = 'abm'; 
include("../../../conexiones/config_pro.php");

$fecha = date("Y-m-d");

$sql1 = "SELECT * FROM `compras1_deta_temp`";
$result1 = $db->Execute($sql1);



if (!$result1) die("fallo".$db->ErrorMsg());
 while (!$result1->EOF) {

$nro_factura=strtoupper($result1->fields["nro_factura"]);
$cod_detalle=strtoupper($result1->fields["cod_detalle"]);
$cod_mercaderia=strtoupper($result1->fields["cod_mercaderia"]);
$lote=strtoupper($result1->fields["lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);


$sql2 = "SELECT * FROM `existencias` where cod_mercaderia = $cod_mercaderia and mes_lote = $mes_lote and anio_lote = $anio_lote and lote = $lote";
$result2 = $db->Execute($sql2);
$cod_merca=strtoupper($result2->fields["cod_mercaderia"]);

$cantidad_existente=strtoupper($result2->fields["cantidad_ingresada"]);
$cod_deta=strtoupper($result2->fields["cod_detalle"]);


$presentacion=strtoupper($result1->fields["presentacion"]);
//$lote=strtoupper($result1->fields["lote"]);
$lote1=strtoupper($result1->fields["lote"]);
$mes_lote1=strtoupper($result1->fields["mes_lote"]);
$anio_lote1=strtoupper($result1->fields["anio_lote"]);




$cantidad_ingresada=strtoupper($result1->fields["cantidad"]);
$precio_unitario=strtoupper($result1->fields["precio_unitario"]);
$precio_nuevo=strtoupper($result1->fields["precio_nuevo"]);



$total=strtoupper($result1->fields["total"]);


$total_neto =$total_neto + $total;


$sql3 = "SELECT * FROM `compras1_encab_temp` where nro_factura = $nro_factura";
$result3 = $db->Execute($sql3);
$cuenta=strtoupper($result3->fields["nro_proveedor"]);
$fecha=strtoupper($result3->fields["fecha"]);
$fecha_ultimo_mov = date("y-m-d");



if ($cod_merca == ""){
	include("../../../conexiones/config_pro.php");
$sql = "INSERT INTO `existencias` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `lote` ,  `mes_lote` , `anio_lote` , `cantidad_ingresada` , `precio_unitario` , `cantidad_salida` , `fecha_ultimo_mov` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$lote' , '$mes_lote' , '$anio_lote', '$cantidad_ingresada' , '$precio_unitario' , '' , '$fecha_ultimo_mov')";
mysql_query($sql);


$sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `tipo_fact` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` ,  `mes_lote` , `anio_lote` , `cuenta` , `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha_ultimo_mov' , '2' ,  'A' , '$nro_factura' , '$cantidad_ingresada' , '$precio_unitario' , '$lote' , '$mes_lote', '$anio_lote' , '$cuenta' , '')";
mysql_query($sql);

}
elseif (($lote == $lote1) && ($cod_mercaderia == $cod_merca) && ($anio == $anio1) && ($mes == $mes1)) {

$cantidad = $cantidad_ingresada + $cantidad_existente;


include("../../../conexiones/config_pro.php");
$sql = "UPDATE `existencias` SET `cantidad_ingresada` = '$cantidad', `precio_unitario` = '$precio_unitario' , `fecha_ultimo_mov` = '$fecha_ultimo_mov' WHERE cod_mercaderia = '$cod_mercaderia' and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote= '$anio_lote' and cod_detalle = '$cod_deta'";
mysql_query($sql);

$sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `tipo_fact` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` ,  `mes_lote` , `anio_lote` , `cuenta` , `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha_ultimo_mov' , '2' ,  'A' , '$nro_factura' , '$cantidad_ingresada' , '$precio_unitario' , '$lote' , '$mes_lote', '$anio_lote' , '$cuenta' , '')";
mysql_query($sql);
}
else {

$sql = "INSERT INTO `existencias` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `lote` ,  `mes_lote` , `anio_lote` , `cantidad_ingresada` , `precio_unitario` , `cantidad_salida` , `fecha_ultimo_mov` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$lote' , '$mes_lote' , '$anio_lote', '$cantidad_ingresada' , '$precio_unitario' , '' , '$fecha_ultimo_mov')";
mysql_query($sql);

 $sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `tipo_fact` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` ,  `mes_lote` , `anio_lote` , `cuenta` , `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha_ultimo_mov' , '2' ,  'A' , '$nro_factura' , '$cantidad_ingresada' , '$precio_unitario' , '$lote' , '$mes_lote', '$anio_lote' , '$cuenta' , '')";
mysql_query($sql);

}



$precio_actualizado = $precio_nuevo;


$sql = "UPDATE `mercaderia` SET `precio_actualizado` = '$precio_unitario' WHERE `cod_merca` = '$cod_mercaderia'";
mysql_query($sql);
//}

$sql = "INSERT INTO `compras_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `presentacion` , `lote` , `mes_lote` ,  `anio_lote` , `cantidad` , `precio_unitario` , `total` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' ,'$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad_ingresada' , '$precio_unitario' , '$total')";
mysql_query($sql);

$result1->MoveNext();
				}


$sql = "TRUNCATE TABLE `compras1_deta_temp`";
mysql_query($sql);


$sql3 = "SELECT * FROM `compras1_encab_temp`";
$result3 = $db->Execute($sql3);
$nro_factura=strtoupper($result3->fields["nro_factura"]);
$cod_operacion=strtoupper($result3->fields["cod_operacion"]);
$nro_proveedor=strtoupper($result3->fields["nro_proveedor"]);
$denominacion=strtoupper($result3->fields["denominacion"]);
$fecha=strtoupper($result3->fields["fecha"]);
$descuento=strtoupper($result3->fields["descuento"]);
$bonificacion=strtoupper($result3->fields["bonificacion"]);
$periodo=strtoupper($result3->fields["periodo"]);
$anio=strtoupper($result3->fields["anio"]);
$operador=strtoupper($result3->fields["operador"]);

$iva = ($total_neto * 0.21);
$total_compra = $total_neto + $iva;

if ($nro_factura != ""){

$sql = "INSERT INTO `compras_encabezado` ( `nro_factura` , `cod_operacion` , `nro_proveedor` , `denominacion` , `fecha` , `descuento` , `bonificacion`  , `subtotal` , `iva` , `total` , `periodo` , `anio` , `operador` )  VALUES ( '$nro_factura' , '$cod_operacion' , '$nro_proveedor' , '$denominacion' , '$fecha' , '$descuento' , '$bonificacion' ,  '$total_neto' ,'$iva' , '$total_compra' ,  '$periodo' ,'$anio' , '$operador')";
mysql_query($sql);
}


$sql = "TRUNCATE TABLE `compras1_encab_temp`";
mysql_query($sql);

$leyenda = "SE ACTUALIZO EL STOCK, SE GUARDO EL MAYOR Y FACTURA COMPRA";
include ("../../../alertas/campo_informacion.php");

include ("pagina1.php");
exit;