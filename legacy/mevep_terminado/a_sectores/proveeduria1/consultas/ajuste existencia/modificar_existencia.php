<?
$cod_detalle=$_REQUEST["cod_detalle"];
$cantidad_ingresada =$_REQUEST["cantidad_ingresada"];
$cantidad_salida =$_REQUEST["cantidad_salida"];

include ("../../../../conexiones/config_pro.php");

$sql = "UPDATE `existencias` SET `cantidad_ingresada` = '$cantidad_ingresada',  `cantidad_salida` = '$cantidad_salida' WHERE `cod_detalle` = '$cod_detalle'";
mysql_query($sql);

$leyenda = "SE MODIFICO LA EXISTENCIA";
include ("../../../../alertas/campo_informacion.php");
include ("consultas.php");


?>
