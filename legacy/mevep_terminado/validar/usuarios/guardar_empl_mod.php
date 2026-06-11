
<?php 
include ("../../conexiones/config.inc.php");
$id=$_POST["id"];
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

if ($sector == ""){
$sql = "select sector from empleados where id = $id";
	mysql_query($sql);
$result = $db->Execute($sql);
$sector=strtoupper($result->fields["sector"]);
}


$puesto=$_POST["puesto"];
$mes=$_POST["mes"];
$anio=$_POST["anio"];

include ("../../conexiones/config.inc.php");

$sql = "UPDATE `empleados` SET `nombre` = '$nombre' , `apellido` = '$apellido' , `direccion` = '$direccion' , `telefono` = '$telefono' , `celular` = '$celular' , `email` = '$email' , `interno` = '$interno' , `sector` = '$sector' , `puesto` = '$puesto' , `mes` = '$mes' , `anio` = '$anio' WHERE `id` = $id";

mysql_query($sql);

$leyenda = "Modificacion Guardada";
include ("../../alertas/campo_informacion.php");




	