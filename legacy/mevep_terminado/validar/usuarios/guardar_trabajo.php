
<?php
include ("../../conexiones/config.inc.php");



$dia=$_POST["dia"];
$mes=$_POST["mes"];
$anio=$_POST["anio"];
$fecha = $anio."-".$mes."-".$dia;

$duracion=$_POST["duracion"];
$hora=$_POST["hora"];
$trabajo=$_POST["trabajo"];
$para=$_POST["para"];

include ("../../conexiones/config.inc.php");
$sql ="INSERT INTO `trabajo` ( `fecha` , `hora` , `trabajo` , `para` , `duracion` ) VALUES ('$fecha' , '$hora' , '$trabajo' , '$para' , '$duracion')";
mysql_query($sql);

$leyenda = "Guardado...";
include ("../../validar/usuarios/entrada_trabajo.php");




	