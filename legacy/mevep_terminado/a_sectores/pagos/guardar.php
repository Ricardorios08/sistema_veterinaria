<?php

include ("../../conexiones/config.inc.php");


$cod_barra = $_REQUEST['cod_barra'];
$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio= $_REQUEST['anio'];
$fecha_pago = $anio."-".$mes."-".$dia;


$cod_socio = substr($cod_barra,0,5);
$mes_pago =  substr($cod_barra,5,2);
$anio_pago =  substr($cod_barra,7,2);
//$importe_pago_entero =  substr($cod_barra,10,3);
//$importe_pago_decimal =  substr($cod_barra,13,2);
//$importe = $importe_pago_entero.".".$importe_pago_decimal;
$cobrador =   substr($cod_barra,9,2);

$anio_pago = "20".$anio_pago;
    $sql = "SELECT *  FROM `pagos` WHERE  `cod_socio` = '$cod_socio' AND `mes` = '$mes_pago' AND `anio` = '$anio_pago' AND `cobrador` = '$cobrador'";
$result = $db->Execute($sql);

$estado=$result->fields["estado"];

if ($estado == ""){
$leyenda = "COD BARRA INEXISTENTE";
include ("../../alertas/campo_informacion4.php");
include ("entrada_pago_cobrador.php");
exit;
}

$hora = time();
//Print ($hora);


if ($estado == "PENDIENTE"){
 $sql = "UPDATE `pagos` SET `estado` = 'PAGADO',  `fecha_pago` = '$fecha_pago' , `hora` = '$hora' WHERE `cod_socio` = '$cod_socio' AND `mes` = '$mes_pago' AND `anio` = '$anio_pago' AND `cobrador` = '$cobrador'";
$result = $db->Execute($sql);
$leyenda = "PAGO ACEPTADO";
include ("../../alertas/campo_informacion.php");
include ("entrada_pago_cobrador.php");
exit;

}else{

$leyenda = "YA INGRESO ESA BOLETA DEL SOCIO:". $cod_socio;
include ("../../alertas/campo_informacion.php");
include ("entrada_pago_cobrador.php");
exit;
}

include ("entrada_pago_cobrador.php");
//include ("ver_ultimos ingresados.php");


