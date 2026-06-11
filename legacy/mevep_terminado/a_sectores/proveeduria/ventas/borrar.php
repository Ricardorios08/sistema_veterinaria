<?php 
include ("../../../conexiones/config_pro.php");

$cod_detalle = $_REQUEST['cod_detalle'];
$id= $_REQUEST['id'];
 $cantidad = $_REQUEST['cantidad'];


 $sql = "DELETE FROM ventas1_deta_temp where cod_detalle = $cod_detalle limit 1";
mysql_query($sql);

 include ("mostrar_detalle.php");
?>

