<?php 

$cobrador=$_POST["cobrador"];
$importe=$_POST["importe"];

 
$sql = "SELECT *  FROM socios WHERE cod_socio = $cod_socio";
$result = $db->Execute($sql);
$apellido =$result->fields["apellido"];
$nombre =$result->fields["nombre"];
$cobrador =$result->fields["cobrador"];


if ($apellido == ""){
$leyenda = "NO EXISTE SOCIO";
include ("../../alertas/campo_informacion2.php");
exit;
}

if ($importe == ""){
$leyenda = "NO INGRESO IMPORTE";
include ("../../alertas/campo_informacion2.php");
exit;
}

$socio = $apellido.", ".$nombre;
 
 switch ($mes){
case "1":{$fecha_pago = $anio."-01-01";break;}
case "2":{$fecha_pago = $anio."-02-01";break;}
case "3":{$fecha_pago = $anio."-03-01";break;}
case "4":{$fecha_pago = $anio."-04-01";break;}
case "5":{$fecha_pago = $anio."-05-01";break;}
case "6":{$fecha_pago = $anio."-06-01";break;}
case "7":{$fecha_pago = $anio."-07-01";;break;}
case "8":{$fecha_pago = $anio."-08-01";break;}
case "9":{$fecha_pago = $anio."-09-01";break;}
case "10":{$fecha_pago = $anio."-10-01";break;}
case "11":{$fecha_pago = $anio."-11-01";break;}
case "12":{$fecha_pago = $anio."-12-01";break;}


}



if ($cobrador == 0){
$leyenda = "INGRESE N° COBRADOR";
include ("../../alertas/campo_informacion2.php");
echo "N° INGRESE COBRADOR";
?><BR><?php
echo "10 LOCAL";
?><BR><?php
echo "11 DANIEL";
?><BR><?php
echo "12 JORGE";
?><BR><?php
echo "13 GUSTAVO";
?><BR><?php
echo "14 RICARDO";
?><BR><?php


EXIT;
}


$sql = "SELECT *  FROM `pagos` order by nro_boleta desc";
$result = $db->Execute($sql);
$nro_boleta =$result->fields["nro_boleta"] + 1;


 
 $sql="select * from pagos where anio = $anio and mes = $mes and cod_socio = $cod_socio";
 $result = $db->Execute($sql);

$mess=$result->fields["mes"];



if ($mess != ""){
echo "ESTE SOCIO YA TIENE CARGADA LA CUOTA DEL ".$mes."/".$anio;
exit;
}



$sql = "INSERT INTO `pagos` ( `cod_socio` , `mes` , `anio` , `importe` , `cobrador` , `observaciones` , `estado` , `fecha_generacion` , `fecha_pago` , `nro_boleta` , `socio` , `hora` , `tipo_creacion` )   VALUES ('$cod_socio' , '$mes' , '$anio' , '$importe' , '$cobrador' , '$observaciones' , 'PENDIENTE' , '$fecha_pago' , '' , '$nro_boleta' , '$socio' , '' , '1')";
$result = $db->Execute($sql);


 


