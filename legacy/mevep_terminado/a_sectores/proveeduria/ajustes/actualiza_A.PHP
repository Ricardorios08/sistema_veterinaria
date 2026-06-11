   <?include ("../../../conexiones/config_grabacion.php");

$nro_factura= $_REQUEST['nro_factura'];
$fact =$_REQUEST['fact'];
$tipo_fact =$_REQUEST['tipo_fact'];
$cuit= $_REQUEST['cuit'];
$direccion= $_REQUEST['direccion'];
$leyenda2 =  $_REQUEST['leyenda1'];
$cantidad_cuotas=  $_REQUEST['cantidad_cuotas'];



include("../../../conexiones/config_grabacion.php");
$sql2 = "SELECT * FROM `ventas1_encab_temp` where nro_factura = $nro_factura";
$result2 = $db_aj->Execute($sql2);



$cod_operacion=strtoupper($result2->fields["cod_operacion"]);
$fact=strtoupper($result2->fields["tipo_fact"]);
$tipo_iva=strtoupper($result2->fields["tipo"]);


$operador=strtoupper($result2->fields["operador"]);
$denominacion=strtoupper($result2->fields["denominacion"]);

$fecha=strtoupper($result2->fields["fecha"]);
$dia=substr($fecha,8,2);
$mes=substr($fecha,5,2);
$anio=substr($fecha,0,4);
$fecha_a = $dia."/".$mes."/".$anio;

$fact=strtoupper($result2->fields["tipo_fact"]);


$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` , `tipo_iva` ) VALUES ( 'I' , '$nro_factura' , '1' , '$tipo_iva' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' , '$tp' )";
$result85 = $db_aj->Execute($sql);





 $sql = "SELECT * FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $nro_factura";
$result = $db_aj->Execute($sql);
if (!$result) die("fallo".$db_aj->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);

$lote=strtoupper($result->fields["lote"]);

$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);

//$total=strtoupper($result->fields["total"]);
//$cod_detalle=strtoupper($result->fields["cod_detalle"]);

$sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db_pro->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);
$precio_actualizado=strtoupper($result2->fields["precio_actualizado"]);
$id_tasa=strtoupper($result2->fields["id_tasa"]);

$sql3="select * from tasas where cod_tasa = $id_tasa";
$result3 = $db_pro->Execute($sql3);

$iva_normal=strtoupper($result3->fields["iva_normal"]);







$total = round($precio_actualizado * $cantidad,2);


$subtotal = $subtotal + $total;




$sql3="select * from existencias where cod_mercaderia = $cod_mercaderia and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' ";
$result3 = $db_pro->Execute($sql3);
$nro_fact_compra=strtoupper($result3->fields["nro_factura"]);
$cantidad_ingresada=strtoupper($result3->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result3->fields["cantidad_salida"]);
$cantidad_vendida = $cantidad_ingresada - $cantidad;
$cantidad_a_guardar = $cantidad + $cantidad_salida;



$total = $total;





$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura= $nro_factura_nuevo;
}



$sql = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_a_guardar' WHERE cod_mercaderia = $cod_mercaderia and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' and lote = '$lote'";
$result3 = $db_pro->Execute($sql);

$sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` ,  `tipo_fact` , `cod_movimiento` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` ,  `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , '$fact' , '7' , '$nro_factura' , '$cantidad' , '$precio_unitario' , '$lote' , '$mes_lote' , '$anio_lote' , '$nro' ,  '$tipo_cuenta')" ;
$result3 = $db_pro->Execute($sql);

$sql = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_actualizado' , '$total' , '$fact' )";
$result3 = $db_aj->Execute($sql);


	 $result->MoveNext();
		}


$desc_fact = round(($subtotal * $porc_dto)/100,2);
$neto_gravado = $subtotal - $desc_fact;
$iva = round(($neto_gravado * $iva_normal) /100,2);
$total_factura = $neto_gravado + $iva;


 $sumatoria = $cont;
		$cont = 0;


$sumatoria = 0;


 $sql = "UPDATE `ventas_encabezado` SET `bruto` = '$subtotal', `descuento` = '$desc_fact' , `iva` = '$iva' , `retencion` = '$retencion', `neto` = '$total_factura' , `neto_gravado` = '$neto_gravado' WHERE `tipo_fact` = '$fact' AND `nro_factura` = '$nro_factura'";
$result3 = $db_aj->Execute($sql);


$total_factura = 0;
$subtotal = 0;
$neto_gravado = 0;
$desc_fact= 0;
$iva = 0;


	

$sql = "TRUNCATE TABLE `ventas1_deta_temp`";
$result3 = $db_aj->Execute($sql);
$sql = "TRUNCATE TABLE `ventas1_encab_temp`";
$result3 = $db_aj->Execute($sql);

$total_factura = 0;
$neto = 0;
$iva = 0;

$leyenda = "Se actualizo Stock, Existencias y Ajuste";
include ("../../../alertas/campo_informacion.php");
include ("entrada_factura.php");
?>

