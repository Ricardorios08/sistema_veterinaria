
<?php
include ("../../../conexiones/config.inc.php");


$nro_laboratorio=$_POST["nro_laboratorio"];
$nombre_laboratorio=$_POST["nombre_laboratorio"];
$matricula=$_POST["matricula"];
$fecha_habilitacion=$_POST["fecha_habilitacion"];
//$dia_inicio=$_POST["dia_inicio"];
//$mes_inicio=$_POST["mes_inicio"];
//$año_inicio=$_POST["año_inicio"];


//$fecha_inicio=$dia_inicio."/".$mes_inicio."/".$año_inicio;
$fecha_inicio=$_POST["fecha_inicio"];

$fecha_vencimiento=$_POST["fecha_vencimiento"];
$tipo_socieda=$_POST["tipo_sociedad"];
for ($i=0;$i<count($tipo_socieda);$i++)    
	{     
	$tipo_sociedad = $tipo_socieda[$i];    
	}

if ($tipo_sociedad== ""){
$sql="select * from datos_laboratorio where nro_laboratorio like $nro_laboratorio";
$result = $db->Execute($sql);
$tipo_sociedad=$result->fields["tipo_sociedad"];
}


$cantidad=$_POST["cantidad"];


$categoria_la=$_POST["categoria_lab"];
	for ($i=0;$i<count($categoria_la);$i++)    
	{     
	$categoria_lab = $categoria_la[$i];    
	}

if ($categoria_lab== ""){
$sql="select * from datos_laboratorio where nro_laboratorio like $nro_laboratorio";
$result = $db->Execute($sql);
$categoria_lab=$result->fields["categoria_lab"];
}

$domicilio=$_POST["domicilio"];
$nro_domicilio=$_POST["nro_domicilio"];
$referencia=$_POST["referencia"];
$cod_postal=$_POST["cod_postal"];
$localidad=$_POST["localidad"];
$plan=$_POST["plan"];


$departament=$_POST["departamento"];
for ($i=0;$i<count($departament);$i++)    
{     
$departamento= $departament[$i];   
}

if ($departamento== ""){
$sql="select * from datos_laboratorio where nro_laboratorio like $nro_laboratorio";
$result = $db->Execute($sql);
$departamento=$result->fields["departamento"];
}


$orientacion=$_POST["orientacion"];
$telefono=$_POST["telefono"];
$celular=$_POST["celular"];
$fax=$_POST["fax"];
$email=$_POST["email"];
$especialidad=$_POST["especialidad"];

$sql="select * from datos_laboratorio where nro_laboratorio like $nro_laboratorio";
$result = $db->Execute($sql);
$nro_lab1=$result->fields["nro_laboratorio"];

if ($nro_lab1 == ""){
	include ("../../../conexiones/config.inc.php");
	$sql = "INSERT INTO `datos_laboratorio` ( `nro_laboratorio` , `matricula` , `nombre_laboratorio` ,`tipo_sociedad` , `cantidad` , `categoria_lab` , `fecha_habilitacion` , `fecha_inicio` , `fecha_vencimiento` , `integrantes` , `especialidad` , `orientacion` , `departamento` , `domicilio` , `nro_domicilio` , `referencia` , `localidad` , `cod_postal` , `telefono` , `celular` , `fax` , `email` )  VALUES (  '$nro_laboratorio' , '$matricula' , '$nombre_laboratorio' , '$tipo_sociedad' , '$cantidad' , '$categoria_lab' , '$fecha_habilitacion' , '$fecha_inicio' , '$fecha_vencimiento' , '$integrantes' , '$especialidad' , '$orientacion' , '$departamento' , '$domicilio' , '$nro_domicilio' , '$referencia' , '$localidad' , '$cod_postal' , '$telefono' , '$celular' , '$fax' , '$email' )";
mysql_query($sql);
include ("../../../conexiones/config_pro.php");
$sql = "INSERT INTO `condiciones_socios` ( `cuenta` , `plan`)  VALUES ( '$nro_laboratorio' , '$plan')";
mysql_query($sql);

}
else
{
include ("../../../conexiones/config.inc.php");
$sql = "UPDATE `datos_laboratorio` SET   `matricula` = '$matricula' , `nombre_laboratorio` = '$nombre_laboratorio' , `tipo_sociedad` = '$tipo_sociedad' , `cantidad` = '$cantidad' , `categoria_lab`= '$categoria_lab' , `fecha_habilitacion` = '$fecha_habilitacion' , `fecha_inicio`= '$fecha_inicio' , `fecha_vencimiento`= '$fecha_vencimiento' , `especialidad`= '$especialidad' , `orientacion` = '$orientacion' , `departamento` = '$departamento' , `domicilio` = '$domicilio' , `nro_domicilio` = '$nro_domicilio' , `referencia`=  '$referencia' , `localidad`= '$localidad' , `cod_postal`= '$cod_postal' , `telefono` = '$telefono' , `celular` = '$celular' , `fax`= '$fax' , `email` = '$email' where `nro_laboratorio` = '$nro_laboratorio'";
mysql_query($sql);

include ("../../../conexiones/config_pro.php");
$sql = "UPDATE `condiciones_socios` SET   `plan` = '$plan'  where `cuenta` = '$nro_laboratorio'";
mysql_query($sql);


}









$leyenda = "Datos Modificados con exito";
include ("../../../alertas/campo_informacion.php");
//include ("../a_cuentas/cuenta.php");