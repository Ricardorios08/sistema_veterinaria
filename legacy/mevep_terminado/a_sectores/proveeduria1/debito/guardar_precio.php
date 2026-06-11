<?php
include ("../../../conexiones/config_grabacion.php");

//tabla mercaderia
$dolar=$_POST["dolar"];
$dolar1=$_POST["dolar1"];

$costo=$_POST["costo"];
$empresas=$_POST["empresas"];
$regaleria=$_POST["regaleria"];
$por_menor=$_POST["por_menor"];


$sql = "truncate precio_costos";
$result = $db_pro->Execute($sql);

 $sql = "INSERT INTO `precio_costos` ( `dolar_compra` ,  `dolar_venta` , `costo` , `empresas` , `regaleria` , `por_menor`) VALUES( '$dolar' , '$dolar1' , '$costo' , '$empresas' , '$regaleria' , '$por_menor')";
	$result = $db_pro->Execute($sql);

include ("precio_costos.php");

?>

