<?php 
include ("../../conexiones/config.inc.php");

$contra=strtoupper($_REQUEST["contra"]);
$cod_socio=$_REQUEST["cod_socio"];
$cod_animal=$_REQUEST["cod_animal"];
$nombre_mascota=$_REQUEST["nombre_mascota"];

if ($contra == "RAZA"){
echo  $sql = "DELETE FROM animal where nombre = '$nombre_mascota' and cod_animal = $cod_animal";
mysql_query($sql);



$leyenda = "SE ELIMINO LA MASCOTA Y SU HISTORIA CLINICA";
include ("../../alertas/campo_informacion.php");

}ELSE{

$leyenda = "CLAVE DE SEGURIDAD INCORRECTA";
include ("../../alertas/campo_informacion2.php");
}