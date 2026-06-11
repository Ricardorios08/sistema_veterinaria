   <?include ("../../../conexiones/config_pro.php");


$nro_factura_afectada= $_REQUEST['nro_factura_afectada'];
$tipo_fact_afectado =$_REQUEST['tipo_fact_afectado'];
$nro_factura_nc =$_REQUEST['nro_factura_nc'];
$nro_factura_detalle =$_REQUEST['nro_factura_nc'];

$leyenda1 = $_REQUEST['leyenda1'];
$nro_factura_nuevo= $_REQUEST['nro_factura_nuevo'];
 $fact_nuevo= strtoupper($_REQUEST['fact_nuevo']);

$subtotal1= strtoupper($_REQUEST['subtotal']);
$descuento1= strtoupper($_REQUEST['descuento']);
echo $total_factura1= strtoupper($_REQUEST['total_factura']);
echo $neto_gravado1= strtoupper($_REQUEST['neto_gravado']);
echo $iva_fact1= strtoupper($_REQUEST['iva_fact']);



include("../../../conexiones/config_pro.php");
$sql6="select * from composicion_saldos where comprobante= $nro_factura_afectada and tipo_fact = '$tipo_fact_afectado'";
$result6= $db->Execute($sql6);
$saldo_nc=$result6->fields["saldo"];


$sql6="select * from iva_facturas where nro_factura= $nro_factura_afectada and tipo_fact = '$tipo_fact_afectado'";
$result6= $db->Execute($sql6);
$porc_iva=$result6->fields["tasa"];



if ($total_factura > $saldo_nc){
$leyenda = "ERROR DE ACTUALIZACION";
INCLUDE ("../../../alertas/campo_informacion2.php");
exit;
}


include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `notacredito_encab_temp`  WHERE  `nro_factura` = '$nro_factura_nc' and tipo_fact = '$tipo_fact_afectado'";
$result = $db->Execute($sql2);
 $nro_cliente=strtoupper($result->fields["nro_cliente"]);
$operador=strtoupper($result->fields["operador"]);
 $nro_cuenta=strtoupper($result->fields["nro_cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$fecha_original=strtoupper($result->fields["fecha"]);
$descuento=strtoupper($result->fields["descuento"]);
$bruto=strtoupper($result->fields["bruto"]);
$tipo_iva =strtoupper($result->fields["tipo_iva"]);
$fecha_guardar=strtoupper($result->fields["fecha"]);
$neto=strtoupper($result->fields["neto"]);


$dia = substr($fecha_guardar,8,2);
$mes= substr($fecha_guardar,5,2);
$anio= substr($fecha_guardar,0,4);
$fecha_hoy = $dia."-".$mes."-".$anio;



if ($descuento != 0.00){
$porc_dto = round($descuento / $bruto,2);
}


$dia = substr($fecha,8,2);
$mes=substr($fecha,5,2);
$anio =substr($fecha,2,2);
$forma_pago=strtoupper($result->fields["forma_pago"]);

$bruto=strtoupper($result->fields["bruto"]);
$descuento=strtoupper($result->fields["descuento"]);
$total_iva=strtoupper($result->fields["iva"]);
$retencion=strtoupper($result->fields["retencion"]);
$total_fact=strtoupper($result->fields["neto"]);

$periodo=strtoupper($result->fields["periodo"]);
$anio=strtoupper($result->fields["anio"]);

Switch ($operador){
	case "101":{
		$nombre_operador = "Sergio Zavala";
		break;
	}

	case "201":{
$nombre_operador = "Juan Tomas";
break;
	}
}


switch ($mes)
					{
		case "ENERO":{$periodo1= "01".$año; $mes_actual="01";}break;
		case "FEBRERO":{$periodo1= "02".$año;$mes_actual="02";}break;
		case "MARZO":{$periodo1= "03".$año;$mes_actual="03";}break;
		case "ABRIL":{$periodo1= "04".$año;$mes_actual="04";}break;
		case "MAYO":{$periodo1= "05".$año;$mes_actual="05";}break;
		case "JUNIO":{$periodo1= "06".$año;$mes_actual="06";}break;
		case "JULIO":{$periodo1= "07".$año;$mes_actual="07";}break;
		case "AGOSTO":{$periodo1= "08".$año;$mes_actual="08";}break;
		case "SETIEMBRE":{$periodo1= "09".$año;$mes_actual="09";break;}
		case "OCTUBRE":{$periodo1= "10".$año;$mes_actual="10";}break;
		case "NOVIEMBRE":{$periodo1= "11".$año;$mes_actual="11";}break;
		case "DICIEMBRE":{$periodo1= "12".$año;$mes_actual="12";}break;
					}


 
if ($nro_cliente != 0){
$tipo_cuenta = "2"; //tipo 1 externo;
$nro = $nro_cliente;
}
elseif ($nro_cuenta != 0){
$tipo_cuenta = "1"; //tipo 1 asociado;
$nro = $nro_cuenta;
}


if ($nro_cliente!=0){
 include("../../../conexiones/config_pro.php");
echo $sql="select * from clientes where cuenta like '$nro_cliente'";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);
$domicilio=$result->fields["domicilio"];
$puerta=$result->fields["puerta"];
$localidad=$result->fields["localidad"];
$direccion = $domicilio." ".$puerta." - ".$localidad;
$cuit=$result->fields["cuit"];


$sql7="select * from condiciones_clientes where cuenta like '$nro_cliente'";
$result7 = $db->Execute($sql7);
$plan=strtoupper($result7->fields["plan"]);

$iva =$result7->fields["iva"];



$todo = $denominacion." (".$nro_cliente.")";
$band = "cliente";
}
elseif ($nro_cuenta!=""){ 
 include("../../../conexiones/config.inc.php");
echo $sql="select * from datos_laboratorio where nro_laboratorio like '$nro_cuenta'";
$result=$db->Execute($sql);

 $nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);
$matricula1=$result->fields["matricula"];
$domicilio=$result->fields["domicilio"];
$nro_domicilio=$result->fields["nro_domicilio"];
$departamento=$result->fields["departamento"];


$direccion = $domicilio." ".$nro_domicilio." - ".$departamento;



$sql1="select * from datos_personales where matricula like '$nro_cuenta'";
$result1 = $db->Execute($sql1);

$nombre=strtoupper($result1->fields["nombre"]);
$apellido=strtoupper($result1->fields["apellido"]);

 $sql2="select * from afip where nro_laboratorio like '$nro_cuenta'";
$result2 = $db->Execute($sql2);
 $cuit=strtoupper($result2->fields["nro_afip"]);
 $sit_iva=strtoupper($result2->fields["sit_iva"]);

switch ($sit_iva){
	case "RESPONSABLE INSCRIPTO":{
$iva1 = "Responsable Inscripto";
$tipo_iva = 1;
		break;
	}

	case "EXENTO":{
$iva1 = "Exento";
$tipo_iva = 3;
		break;
	}

		case "MONOTRIBUTISTA":{
$iva1 = "Monotributo";
$tipo_iva = 3;
		break;
	}

		case "MON":{
$iva1 = "Monotributo";
$tipo_iva = 3;
		break;
	}

			case "CONS. FINAL":{
$iva1 = "Cons. FInal";
$fact = "B";
$tipo_iva = 4;
$leyenda = "Irregular situación AFIP";
include ("../../../alertas/campo_vacio.php");
EXIT;
		break;
	}

}
$todo="Lab. ".$nombre_laboratorio." (".$cuenta.")";
$band = "cuenta";
}

$leyenda= "FACTURA AFECTADA Nº ".$nro_factura_afectada;



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

include("../../../conexiones/config_pro.php");
switch ($caso){

	case "1":{
 $sql = "UPDATE `notacredito_encab_temp` SET `nro_factura` = '$nro_factura_nuevo' , `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
mysql_query($sql);

 $sql = "UPDATE `notacredito_deta_temp` SET `nro_factura` = '$nro_factura_nuevo' , `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
mysql_query($sql);

$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago`  , `tipo_iva` ) VALUES ( '$fact_nuevo' , '$nro_factura_nuevo' , '3' , '$tipo_fact' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha_guardar' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' , '$tipo_iva' )";
mysql_query($sql);



$tipo_fact_afectado = $fact_nuevo;
$nro_factura_nc = $nro_factura_nuevo;
break;
	}

	case "2":{
 $sql = "UPDATE `notacredito_encab_temp` SET `nro_factura` = '$nro_factura_nuevo'   WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
mysql_query($sql);

 $sql = "UPDATE `notacredito_deta_temp` SET `nro_factura` = '$nro_factura_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
mysql_query($sql);

$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` , `tipo_iva` ) VALUES ( '$tipo_fact_afectado' , '$nro_factura_nuevo' , '3' , '$tipo_fact' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha_guardar' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago'  , '$tipo_iva' )";
mysql_query($sql);
$nro_factura_nc = $nro_factura_nuevo;
break;
	}

		case "3":{
$sql = "UPDATE `notacredito_encab_temp` SET `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact_nuevo' ";
mysql_query($sql);

$sql = "UPDATE `notacredito_deta_temp` SET `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
mysql_query($sql);

$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` ,  `tipo_iva` ) VALUES ( '$fact_nuevo' , '$nro_factura_nc' , '3' , '$tipo_fact' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha_guardar' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' , '$tipo_iva' )";
mysql_query($sql);
$tipo_fact_afectado = $fact_nuevo;
break;
	}

		case "4":{
$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` , `tipo_iva` ) VALUES ( '$tipo_fact_afectado' , '$nro_factura_nc' , '3' , '$tipo_fact_afectado' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha_guardar' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago'  , '$tipo_iva' )";
mysql_query($sql);

break;
	}


}
        



include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `notacredito_deta_temp`  WHERE  `nro_factura` = '$nro_factura_detalle' and tipo_fact = '$tipo_fact_afectado'";
$result = $db->Execute($sql);
if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$presentacion=strtoupper($result->fields["presentacion"]);
$descripcion=strtoupper($result->fields["descripcion"]);
$cod_detalle=strtoupper($result->fields["cod_detalle"]);
$lote1=strtoupper($result->fields["lote"]);
$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);
$vto_lote = $mes_lote."/".$anio_lote;
 $precio_actualizado=strtoupper($result->fields["precio_unitario"]);
$precio_actualizado = $precio_actualizado;

$total_renglon = round($precio_actualizado * $cantidad,2);

$subtotal = $subtotal + $total_renglon;

 $sql3="select * from existencias where cod_mercaderia = $cod_mercaderia and lote = '$lote1' and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' ";
$result3 = $db->Execute($sql3);
$nro_fact_compra=strtoupper($result3->fields["nro_factura"]);
$cod_merquita=strtoupper($result3->fields["cod_mercaderia"]);
$cantidad_ingresada=strtoupper($result3->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result3->fields["cantidad_salida"]);



$cantidad_1 = $cantidad_ingresada + $cantidad;
$cantidad_2 = $cantidad_salida - $cantidad;


$cantidad_a_guardar =  $cantidad_salida + $cantidad;


$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura_nc= $nro_factura_nuevo;
}


if ($cod_merquita == ""){

$sql = "INSERT INTO `existencias` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `lote` ,  `mes_lote` , `anio_lote` , `cantidad_ingresada` , `precio_unitario` , `cantidad_salida` , `fecha_ultimo_mov` )  VALUES ('$nro_factura_nc' , '' ,'$cod_mercaderia' , '$lote1' , '$mes_lote' , '$anio_lote', '$cantidad_1' , '$precio_actualizado' , '' , '$fecha_guardar')";
mysql_query($sql);
}
else
	 {
$sql = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_2' WHERE cod_mercaderia = $cod_mercaderia and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' and lote = '$lote1'";
mysql_query($sql);
	 }

$sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` ,  `tipo_fact` , `cod_movimiento` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` ,  `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha_guardar' , '$tipo_fact_afectado' , '3' , '$nro_factura_nc' , '$cantidad' , '$precio_unitario' , '$lote1' , '$mes_lote1' , '$anio_lote1' , '$nro' ,  '$tipo_cuenta')" ;
mysql_query($sql);


$sql = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` )  VALUES ('$nro_factura_nc' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote1' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_actualizado' , '$total' , '$tipo_fact_afectado' )";
mysql_query($sql);




	 $result->MoveNext();
		}


if ($tipo_fact_afectado == "A") {

$porc_dto;
$desc_factura = round($neto_gravado * $porc_dto,2);
$subtotal = $subtotal - $desc_factura;
$iva_fact = round(($subtotal * 21)/100,2);
$total_factura = $subtotal + $iva_fact;
$neto_gravado= $subtotal;
 $sql = "UPDATE `ventas_encabezado` SET `bruto` = '$subtotal1', `descuento` = '$desc_factura' , `neto_gravado` = '$neto_gravado' , `iva` = '$iva_fact' , `retencion` = '$retencion', `neto` = '$total_factura' WHERE `tipo_fact` = '$tipo_fact_afectado' AND `nro_factura` = '$nro_factura_nc'";
mysql_query($sql);
}else {

$desc_factura = round($subtotal * $porc_dto,2);

$iva_fact = $subtotal - $neto_gravado;

$total_factura = round($subtotal - $desc_factura,2);


$neto_gravado = round(($total_factura / 1.21),2);
$iva_fact = round((($neto_gravado * $porc_iva)/100),2);


 $sql = "UPDATE `ventas_encabezado` SET `bruto` = '$subtotal1', `descuento` = '$desc_factura' , `neto_gravado` = '$neto_gravado' , `iva` = '$iva_fact' , `retencion` = '$retencion', `neto` = '$total_factura' WHERE `tipo_fact` = '$tipo_fact_afectado' AND `nro_factura` = '$nro_factura_nc'";
mysql_query($sql);

}
////////////////////////////////////////////////////////////////////////////




if ($forma_pago == 'CTA/CTE'){
 $sql = "INSERT INTO `resumen_cta_vta` ( `cuenta` , `tipo_cuenta` , `fecha` , `tipo_fact` , `comprobante` , `cod_movimiento` , `importe` , `vencimiento` , `referencia` , `afectacion` ) VALUES ( '$nro' , '$tipo_cuenta' ,'$fecha_guardar' , '$tipo_fact_afectado' , '$nro_factura_nc' , '3' , '$total_factura' , '$vencimiento1' , '$referencia' , '$nro_factura_afectada')";
mysql_query($sql);
}


if ($forma_pago == 'CTA/CTE'){



$saldo_a_guardar = $saldo_nc - $total_factura;


$sql = "UPDATE `composicion_saldos` SET `saldo` = '$saldo_a_guardar',  `fecha_pago` = 'fecha_hoy' WHERE `tipo_fact` = '$tipo_fact_afectado' AND `comprobante` = '$nro_factura_afectada'";
mysql_query($sql);
	


}

$sql = "INSERT INTO `notas_creditos` ( `tipo_fact` , `nro_factura` , `fact_afectado` , `nro_fact_afectada` ) VALUES ( '$tipo_fact_afectado' ,  '$nro_factura_nc' , '$tipo_fact_afectado' , '$nro_factura_afectada' )";
mysql_query($sql);

$sql = "TRUNCATE TABLE `notacredito_deta_temp`";
mysql_query($sql);

$sql = "TRUNCATE TABLE `notacredito_encab_temp`";
mysql_query($sql);

$total_factura = 0;
$neto = 0;
$iva = 0;

$leyenda  = "SE ACTUALIZO EL STOCK, EXISTENCIA Y NOTA DE CREDITO";
include ("../../../alertas/campo_informacion.php");
include ("entrada_factura.php");

