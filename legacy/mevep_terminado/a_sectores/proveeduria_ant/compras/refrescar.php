<?php 	
$cod_mercaderia= $_REQUEST['cod_mercaderia1'];
$lote= $_REQUEST['lote'];

$mes_lote= $_REQUEST['mes_lote'];
$anio_lote= $_REQUEST['anio_lote'];

if (strlen($mes_lote) == 1){
$mes_lote= "0".$mes_lote;
}


$cantidad= $_REQUEST['cantidad'];
$precio_unitario= $_REQUEST['precio_unitario'];



$nro_factura= $_REQUEST['nro_factura'];
$porcentaje_dto= $_REQUEST['porcentaje_dto'];
$porcentaje_boni= $_REQUEST['porcentaje_boni'];

$nro_proveedor= $_REQUEST['nro_proveedor'];
$nro_cuenta= $_REQUEST['nro_cuenta'];

$fecha= $_REQUEST['fecha'];

include("../../../conexiones/config_pro.php");

$periodo = date("m"); 
$anio1 = date("y"); 


Switch ($operador){
	case "101":{
		$nombre_operador = "";
		break;
	}

	case "201":{
$nombre_operador = "";
break;
	}
}

 $sql = "INSERT INTO `compras1_encab_temp` ( `nro_factura` , `cod_operacion` , `nro_proveedor` , `denominacion` , `fecha` , `descuento` , `bonificacion` , `periodo` , `anio` , `operador` ) VALUES ( '$nro_factura' , '$cod_operacion' , '$nro_proveedor' , '$denominacion', '$fecha' , '$porcentaje_dto' , '$porcentaje_boni' , '$periodo' , '$anio1' , '$nombre_operador' )";
//mysql_query($sql);



 echo $sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result = $db->Execute($sql);
 $descripcion=strtoupper($result->fields["nombre"]);
 $presentacion=strtoupper($result->fields["presentacion"]);
 $precio_actualizado =$result->fields["precio_actualizado"];

$sql2 = "SELECT * FROM `existencias`  WHERE  `cod_mercaderia` = $cod_mercaderia and lote = $lote and mes_lote = $mes_lote and anio_lote = $anio_lote";
$result2 = $db->Execute($sql2);
 $cod_merca=strtoupper($result2->fields["cod_merca"]);
 $presentacion=strtoupper($result2->fields["presentacion"]);
 $precio_actualizado =$result2->fields["precio_actualizado"];



if ($precio_unitario == ""){
$precio_unitario = $precio_actualizado;
$precio_nuevo = $precio_actualizado;
}




if ($operador == ""){
$leyenda ="NO INGRESO OPERADOR";
include ("../../../alertas/campo_vacio.php");
	exit;
}


if ($descripcion != ""){

if ($cantidad == ""){
$leyenda ="NO INGRESO CANTIDAD";
include ("../../../alertas/campo_vacio.php");
	exit;
}

if ($cod_mercaderia== ""){

$leyenda ="NO INGRESO MERCADERIA";
include ("../../../alertas/campo_vacio.php");
	exit;
}

if ($descripcion == ""){

	$leyenda ="PRODUCTO INEXISTENTE";
	include ("../../../alertas/campo_vacio.php");
		exit;
}



$total = $cantidad * $precio_unitario;



$sql = "INSERT INTO `compras1_deta_temp` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `presentacion` , `lote` , `mes_lote` ,  `anio_lote` , `cantidad` , `precio_unitario` , `precio_nuevo` , `total` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' ,'$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_unitario' , '$precio_nuevo', '$total')";
mysql_query($sql);


}

include ("refrescar_detalle.php");//$refrescar = "NO";


