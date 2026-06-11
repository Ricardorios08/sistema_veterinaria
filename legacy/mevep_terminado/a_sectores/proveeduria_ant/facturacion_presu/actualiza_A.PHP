
            <?include ("../../../conexiones/config_pro.php");

$nro_factura= $_REQUEST['nro_factura'];
$fact =$_REQUEST['fact'];
$tipo_fact =$_REQUEST['tipo_fact'];
$cuit= $_REQUEST['cuit'];
$direccion= $_REQUEST['direccion'];
$leyenda2 =  $_REQUEST['leyenda1'];
$cantidad_cuotas=  $_REQUEST['cantidad_cuotas'];


if ($cantidad_cuotas == ""){
$cantidad_cuotas = 1;
}

if ($cantidad_cuotas == 0){
$cantidad_cuotas = 1;
}


if (($cantidad_cuotas > 6) or ($cantidad_cuotas < 0) ) {
$leyenda = "Máximo de Cuotas = 6";
	include ("../../../alertas/campo_informacion2.php");
	EXIT;
}

if (($cantidad_cuotas < 7) and ($cantidad_cuotas > 1)){
	$mostrar_recuadro_cuotas = "SI";
}


//$leyenda1 = substr($leyenda_12, 0,30);
//$leyenda2 = substr($leyenda_12,30,30);


$nro_factura_nuevo= $_REQUEST['nro_factura_nuevo'];
 $fact_nuevo= strtoupper($_REQUEST['fact_nuevo']);



include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result2 = $db->Execute($sql2);

$nro_cliente=strtoupper($result2->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result2->fields["nro_cuenta"]);
$cod_operacion=strtoupper($result2->fields["cod_operacion"]);
$fact=strtoupper($result2->fields["tipo_fact"]);
$tipo_iva=strtoupper($result2->fields["tipo"]);
$tp=strtoupper($result2->fields["tipo"]);


$plan=strtoupper($result2->fields["plan"]);
$operador=strtoupper($result2->fields["operador"]);
$denominacion=strtoupper($result2->fields["denominacion"]);

$fecha=strtoupper($result2->fields["fecha"]);
$dia=substr($fecha,8,2);
$mes=substr($fecha,5,2);
$anio=substr($fecha,0,4);
$fecha_a = $dia."/".$mes."/".$anio;

$forma_pago=strtoupper($result2->fields["forma_pago"]);
$fact=strtoupper($result2->fields["tipo_fact"]);
$porc_dto=strtoupper($result2->fields["porc_dto"]);


if ($nro_cliente != 0){
$tipo_cuenta = "2"; //tipo 1 externo;
$leyenda1 = "EXTERNO";
$nro = $nro_cliente;
}
elseif ($nro_cuenta != 0){
$tipo_cuenta = "1"; //tipo 1 asociado;
$leyenda1 = "ABM";
if ($forma_pago == 'CTA/CTE'){
$leyenda3 = "AUTORIZO A DESCONTAR DE MIS HONORARIOS EN LA LIQUIDACION CORRESPONDIENTE";
$leyenda4 = "FIRMA:.........................";
}
$nro = $nro_cuenta;
}


if (($nro_factura_nuevo != "") && ($fact_nuevo != "")) {
$caso = 1;
}
if (($nro_factura_nuevo != "") && ($fact_nuevo == "")) {
$caso = 2;
}
if (($nro_factura_nuevo == "") && ($fact_nuevo != "")) {
$caso = 3;
}
if (($nro_factura_nuevo == "") && ($fact_nuevo == "")) {
$caso = 4;
}

switch ($caso){

	case "1":{
 $sql = "UPDATE `ventas1_encab_temp` SET `nro_factura` = '$nro_factura_nuevo' , `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
mysql_query($sql);

 $sql = "UPDATE `ventas1_deta_temp` SET `nro_factura` = '$nro_factura_nuevo' , `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
mysql_query($sql);

$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` , `tipo_iva` ) VALUES ( '$fact_nuevo' , '$nro_factura_nuevo' , '1' , '$tipo_iva' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' , '$tp' )";
mysql_query($sql);

$fact = $fact_nuevo;
$nro_factura = $nro_factura_nuevo;
break;
	}

	case "2":{
 $sql = "UPDATE `ventas1_encab_temp` SET `nro_factura` = '$nro_factura_nuevo'   WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
mysql_query($sql);

 $sql = "UPDATE `ventas1_deta_temp` SET `nro_factura` = '$nro_factura_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
mysql_query($sql);

 $sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` , `tipo_iva`) VALUES ( '$fact' , '$nro_factura_nuevo' , '1' , '$tipo_iva' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' , '$tp' )";
mysql_query($sql);
$nro_factura = $nro_factura_nuevo;
break;
	}

		case "3":{
 $sql = "UPDATE `ventas1_encab_temp` SET `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact_nuevo' ";
mysql_query($sql);

 $sql = "UPDATE `ventas1_deta_temp` SET `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";

mysql_query($sql);

 $sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` , `tipo_iva`) VALUES ( '$fact_nuevo' , '$nro_factura' , '1' , '$tipo_iva' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' , '$tp' )";
mysql_query($sql);
$fact = $fact_nuevo;
break;
	}

		case "4":{
$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` , `tipo_iva` ) VALUES ( '$fact' , '$nro_factura' , '1' , '$tipo_iva' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' , '$tp')";
mysql_query($sql);

break;
	}


}
include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result3 = $db->Execute($sql);
if (!$result3) die("fallo".$db->ErrorMsg());

 while (!$result3->EOF) {
$renglon = $renglon + 1;
$cod_mercaderia=strtoupper($result3->fields["cod_mercaderia"]);
$cantidad=strtoupper($result3->fields["cantidad"]);
$presentacion=strtoupper($result3->fields["presentacion"]);
$descripcion=strtoupper($result3->fields["descripcion"]);
$cod_detalle=strtoupper($result3->fields["cod_detalle"]);
$lote1=strtoupper($result3->fields["lote"]);
$lote=$lote1;
$mes_lote=strtoupper($result3->fields["mes_lote"]);
$anio_lote=strtoupper($result3->fields["anio_lote"]);
$vto_lote = $mes_lote."/".$anio_lote;


$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result = $db->Execute($sql);
$id_tasa=strtoupper($result->fields["id_tasa"]);

$sql2="select * from tasas where cod_tasa = $id_tasa";
$result2 = $db->Execute($sql2);

$iva_normal=strtoupper($result2->fields["iva_normal"]);


$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);
$margendif=strtoupper($result->fields["margendif"]);
//if ($plan == 1){
$margendif = 0;
//}

$porce_margendif = (($precio_actualizado * $margendif) /100);
$precio_actualizado = $precio_actualizado + $porce_margendif;



$sql6 = "SELECT * FROM `tasas_planes`  WHERE  `cod_plan` = $plan";
$result6 = $db->Execute($sql6);

$descuento_1=strtoupper($result6->fields["descuento_1"]);
$porc_descuento_1= (($precio_actualizado * $descuento_1)/100);
$precio_actualizado = $precio_actualizado - $porc_descuento_1;



$descuento_2=strtoupper($result6->fields["descuento_2"]);
$porc_descuento_2= (($precio_actualizado * $descuento_2)/100);
$precio_actualizado = $precio_actualizado - $porc_descuento_2;

$recargo_1=strtoupper($result6->fields["recargo_1"]);
$porc_recargo_1= (($precio_actualizado * $recargo_1)/100);
$precio_actualizado = $precio_actualizado + $porc_recargo_1;

$recargo_2=strtoupper($result6->fields["recargo_2"]);
$porc_recargo_2= (($precio_actualizado * $recargo_2)/100);
$precio_actualizado = $precio_actualizado + $porc_recargo_2;

$recargo_impuesto=strtoupper($result6->fields["recargo_impuestos"]);
$porc_recargo_impuesto= (($precio_actualizado * $recargo_impuesto)/100);
$precio_actualizado = $precio_actualizado + $porc_recargo_impuesto;


$precio_actualizado = round($precio_actualizado,3);


 $total = $precio_actualizado * $cantidad; //subtotal



$subtotal = $subtotal + $total;
$desc_fact = ($subtotal * $porc_dto)/100;
$neto_gravado = $subtotal - $desc_fact;
$iva = ($neto_gravado * $iva_normal) /100;
$total_factura = round($neto_gravado,2) + round($iva,2);



$cont = $cont + 1;;




///////////

$sql4="select * from existencias where cod_mercaderia = $cod_mercaderia and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' ";
$result4 = $db->Execute($sql4);
$nro_fact_compra=strtoupper($result4->fields["nro_factura"]);
$cantidad_ingresada=strtoupper($result4->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result4->fields["cantidad_salida"]);
$cod_detalle=strtoupper($result4->fields["cod_detalle"]);
$cantidad_vendida = $cantidad_ingresada - $cantidad;
$cantidad_a_guardar = $cantidad + $cantidad_salida;


$precio_unitario= $precio_actualizado;
$total = $total;

//$precio_actualizado= round($precio_actualizado,2);



$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura= $nro_factura_nuevo;
}



 $sql   = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_a_guardar' WHERE cod_mercaderia = $cod_mercaderia and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' and lote = '$lote'";
mysql_query($sql);

 $sql   = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` ,  `tipo_fact` , `cod_movimiento` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` ,  `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , '$fact' , '5' , '$nro_factura' , '$cantidad' , '$precio_unitario' , '$lote' , '$mes_lote' , '$anio_lote' , '$nro' ,  '$tipo_cuenta')" ;
mysql_query($sql);


 $sql   = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_actualizado' , '$total' , '$fact' )";
mysql_query($sql);



	 $result3->MoveNext();
		}


$desc_fact = round(($subtotal * $porc_dto)/100,2);
$neto_gravado = $subtotal - $desc_fact;
$iva = round(($neto_gravado * $iva_normal) /100,2);
$total_factura = $neto_gravado + $iva;



/*
$subtotal= number_format($subtotal,2);
$neto_gravado = number_format($neto_gravado,2);
$desc_fact = number_format($descuento,2);
$iva = number_format($iva,2);
$total_factura = number_format($total_factura,2);
*/

$total_factura = round($total_factura,2);

$sql = "UPDATE `ventas_encabezado` SET `bruto` = '$subtotal', `descuento` = '$desc_fact' , `iva` = '$iva' , `retencion` = '$retencion', `neto` = '$total_factura' , `neto_gravado` = '$neto_gravado' , `contado` = '$total_factura'  WHERE `tipo_fact` = '$fact' AND `nro_factura` = '$nro_factura'";
mysql_query($sql);


echo "TOTAL_FACTURA ".$total_factura;
ECHO "<BR>";
 $sumatoria = $cont;
		$cont = 0;


?>
    

<?


if ($mostrar_recuadro_cuotas == "SI"){
$cuota = round(($total_factura / $cantidad_cuotas),2);
$fecha;
$dia_vto = substr($fecha,8,2);
$mes_1 = substr($fecha,5,2)+1;
$anio_vto = substr($fecha,0,4);

if ($mes_1 > 12){
	$mes_1 = 1;
	$anio_vto = $anio_vto + 1;
}

if (strlen($mes_1) == 1){
	$mes_1 = "0".$mes_1;
}

$vencimiento1 = $dia_vto."/".$mes_1;



$mes_2 = $mes_1+1;


if ($mes_2 > 12){
	$mes_2 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_2) == 1){
	$mes_2 = "0".$mes_2;
}

$vencimiento2 = $dia_vto."/".$mes_2;

$mes_3 = $mes_2+1;


if ($mes_3 > 12){
	$mes_3 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_3) == 1){
	$mes_3 = "0".$mes_3;
}

$vencimiento3 = $dia_vto."/".$mes_3;

$mes_4 = $mes_3+1;


if ($mes_4 > 12){
	$mes_4 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_4) == 1){
	$mes_4 = "0".$mes_4;
}

$vencimiento4 = $dia_vto."/".$mes_4;

/////////////////////////////

$mes_5 = $mes_4+1;


if ($mes_5 > 12){
	$mes_5 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_5) == 1){
	$mes_5 = "0".$mes_5;
}

$vencimiento5 = $dia_vto."/".$mes_5;


$mes_6 = $mes_5+1;


if ($mes_6 > 12){
	$mes_6 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_6) == 1){
	$mes_6 = "0".$mes_6;
}

$vencimiento6 = $dia_vto."/".$mes_6;



switch ($cantidad_cuotas){
	case "1":{

$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
		break;
	}

	case "2":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
		break;}

			case "3":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
		break;}

			case "4":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento4.")";

		break;}


			case "5":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento4.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento5.")";


		break;}

					case "6":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento4.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento5.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento6.")";
		break;}

}


$leyenda4 = $leyenda1;

}


////////////termina cuotas

if ($forma_pago == 'CTA/CTE'){
 $sql   = "INSERT INTO `resumen_cta_vta` ( `cuenta` , `tipo_cuenta` , `fecha` , `tipo_fact` , `comprobante` , `cod_movimiento` , `importe` , `vencimiento` , `referencia` , `afectacion` ) VALUES ( '$nro' , '$tipo_cuenta' ,'$fecha' , '$fact' , '$nro_factura' , '1' , '$total_factura' , '$vencimiento1' , '$referencia' , '$afectacion')";
mysql_query($sql);
}

if ($forma_pago == 'CTA/CTE'){
$sql   = "INSERT INTO `composicion_saldos` ( `cuenta` , `tipo_cuenta` , `tipo_fact` , `comprobante` , `fecha_emision` , `importe_original` , `fecha_pago` , `saldo` , `vencimiento` , `cuotas` , `cuotas_pagadas` , `cod_movimiento` ) VALUES ( '$nro' , '$tipo_cuenta' , '$fact' ,  '$nro_factura' , '$fecha' , '$total_factura' , '' , '$total_factura' , '$vencimiento1' , '$cantidad_cuotas' , '0', 'PROVEEDURIA' )";
mysql_query($sql);
}

$sql   = "INSERT INTO `iva_facturas` (`tipo_fact` , `nro_factura` , `tasa` ) VALUES ('$fact' , '$nro_factura' , '$iva_normal')";
mysql_query($sql);

//11 ventas
//12 nota de debito

//21 pago
//22 nota de credito



$total_factura = 0;
$subtotal = 0;
$neto_gravado = 0;
$desc_fact= 0;
$iva = 0;


	?>
<?
$sql = "TRUNCATE TABLE `ventas1_deta_temp`";
mysql_query($sql);
$sql = "TRUNCATE TABLE `ventas1_encab_temp`";
mysql_query($sql);

$total_factura = 0;
$neto = 0;
$iva = 0;

$leyenda  = "SE ACTUALIZO EL STOCK, EXISTENCIA Y FACTURA DE VENTA";
include ("../../../alertas/campo_informacion.php");
include ("entrada_factura.php");
// header("Location: entrada_factura.php");
?>
