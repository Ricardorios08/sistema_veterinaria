<?php

$seg=$_POST["seg"];


if ($seg == "raza"){



$mes1=$_POST["mes"];
	for ($i=0;$i<count($mes1);$i++)    
	{     
	$mes = $mes1[$i];    
	}

$anio= $_REQUEST['anio'];




$fecha_generacion = date("Y-m-d");

include ("../../conexiones/config.inc.php");

$sql="select * from pagos8 order by nro_boleta desc ";
 $result = $db->Execute($sql);

$nro_boleta=$result->fields["nro_boleta"];

 $an=$result->fields["anio"];
 $me=$result->fields["mes"];

$nro_boleta = 33318;

 $sql="select * from pagos8 where anio = $anio and mes = $mes and tipo_creacion = 0";
 $result = $db->Execute($sql);

$mess=$result->fields["mes"];



if ($mess != ""){
echo "YA GENERO LAS CUOTAS DEL MES ".$mes."/".$anio;
exit;
}


  $sql="select * from socios order by no_imprimir, ruta ";
 $result = $db->Execute($sql);

  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cod_socio=$result->fields["cod_socio"];
$cobrador=$result->fields["cobrador"];
$importe_cuota=$result->fields["importe_cuota"];
$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);

$socio = $apellido.",".$nombre;

$nro_boleta = $nro_boleta + 1;

  $sql="select * from pagos8 where cod_socio = $cod_socio and anio = $anio and mes = $mes";
 $result8 = $db->Execute($sql);
 $mes_u=$result8->fields["mes"];


if ($mes_u == ""){

 
   $sql = "INSERT INTO `pagos8` ( `cod_socio` , `mes` , `anio` , `importe` , `cobrador` , `observaciones` , `estado` ,`fecha_generacion` ,   `fecha_pago` ,  `nro_boleta` , `socio` , `hora` , `tipo_creacion`)  VALUES ( '$cod_socio' , '$mes' , '$anio' , '$importe_cuota' , '$cobrador' , '$observaciones' , 'PENDIENTE' ,  '$fecha_generacion'  , '' , '$nro_boleta' , '$socio' , '' , '0')";
 //mysql_query($sql);
 


$cont = $cont + 1;
}

$conta = $conta + 1;



$result->MoveNext();
	}

$leyenda = "SE GENERARON ".$cont." BOLETAS DEL ".$mes."/".$anio;
include ("../../alertas/campo_informacion.php");

$leyenda = "DE ".$conta." SOCIOS";
include ("../../alertas/campo_informacion.php");

}
else

{
$leyenda = "CONTRASEÑA INCORRECTA";
include ("../../alertas/campo_informacion.php");
include ("entrada_cuota.php");
}