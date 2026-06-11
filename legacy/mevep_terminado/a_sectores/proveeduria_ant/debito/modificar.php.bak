<?

include ("../../../conexiones/config_grabacion.php");
$cod_mevep=$_REQUEST["cod_mevep"];
$nombre=$_REQUEST["nombre"];
$documento=$_REQUEST["documento"];
$cbu=$_REQUEST["cbu"];
$monto_descontar=$_REQUEST["monto_descontar"];
$fecha_ingreso=$_REQUEST["fecha_ingreso"];


$sql = "UPDATE `mevep`.`debito` SET  `nombre` = '$nombre', `documento` = '$documento', `cbu` = '$cbu', `monto_descontar` = '$monto_descontar' , `fecha_ingreso` = '$fecha_ingreso' WHERE `debito`.`cod_mevep` = $cod_mevep";
$result = $db_pro->Execute($sql);

$leyenda = "SE HA MODIFICADO EL DEBITO";
include ("../../../alertas/campo_vacio.php");
?>

