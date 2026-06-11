
<?php 
include ("../../conexiones/config.inc.php");


$apellido=$_POST["apellido"];
$nombre=$_POST["nombre"];
$direccion=$_POST["direccion"];
$telefono=$_POST["telefono"];
$celular=$_POST["celular"];
$email=$_POST["email"];
$interno=$_POST["interno"];
$secto=$_POST["sector"];
for ($i=0;$i<count($secto);$i++)    
{     
$sector= $secto[$i];
}

$puesto=$_POST["puesto"];
$mes=$_POST["mes"];
$anio=$_POST["anio"];

include ("../../conexiones/config.inc.php");
$sql = "INSERT INTO `empleados` ( `apellido` , `nombre` , `direccion` , `telefono` , `celular` , `email` , `interno` , `sector` , `puesto` , `mes` , `anio` ) VALUES ('$apellido' , '$nombre' , '$direccion' , '$telefono' , '$celular' , '$email' , '$interno' , '$sector' , '$puesto' , '$mes' , '$anio')";
mysql_query($sql);

$leyenda = "Empleado Guardado";
include ("../../alertas/campo_vacio.php");




	