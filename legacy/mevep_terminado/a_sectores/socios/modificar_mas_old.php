<?php

include ("../../conexiones/config.inc.php");




$cod_socio=$_REQUEST["cod_socio"];
$cod_animal=$_REQUEST["cod_animal"];






$nombre_mascota=$_REQUEST["nombre_mascota"];
$especie=$_REQUEST["especie"];
$pelaje=$_REQUEST["pelaje"];
$raza=$_REQUEST["raza"];
$tamanio=$_REQUEST["tamanio"];
$color=$_REQUEST["color"];

$sexo_mascot=$_REQUEST["sexo_mascota"];
	for ($i=0;$i<count($sexo_mascot);$i++)    
	{     
	$sexo_mascota = $sexo_mascot[$i];    
	}
	

if ($sexo_mascota == ""){
$sql="select sexo from animal where cod_socio = $cod_socio and cod_animal = $cod_animal";
$result = $db->Execute($sql);
$sexo_mascota=$result->fields["sexo"];
}


$dia_nac=$_POST["dia_nac"];
$mes_nac=$_POST["mes_nac"];
$anio_nac=$_POST["anio_nac"];



$fecha_nac=$anio_nac."-".$mes_nac."-".$dia_nac;


echo  $sql = "UPDATE `mevep`.`animal` SET `nombre` = '$nombre_mascota', `especie` = '$especie', `raza` = '$raza', `pelaje` = '$pelaje', `tamanio` = '$tamanio', `color` = '$color', `sexo` = '$sexo_mascota', `fecha_nac` = '$fecha_nac' WHERE cod_socio = $cod_socio and cod_animal = $cod_animal";
mysql_query($sql);




$leyenda = "LOS DATOS HAN SIDO MODIFICADOS EN EL SISTEMA";
include ("../../alertas/campo_informacion.php");
	

?>

