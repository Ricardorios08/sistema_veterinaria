<?

include ("../../../conexiones/config_grabacion.php");
$cod_operacion=$_REQUEST["cod_operacion"];

$nombre=$_REQUEST["nombre"];
$documento=$_REQUEST["documento"];
$cbu=$_REQUEST["cbu"];
$monto_descontar=$_REQUEST["monto_descontar"];
$fecha_ingreso=$_REQUEST["fecha_ingreso"];


$sql = "UPDATE `mevep`.`debito` SET  `nombre` = '$nombre', `documento` = '$documento', `cbu` = '$cbu', `monto_descontar` = '$monto_descontar' , `fecha_ingreso` = '$fecha_ingreso' WHERE `debito`.`cod_operacion` = $cod_operacion";
$result = $db_pro->Execute($sql);

$leyenda = "SE HA MODIFICADO EL DEBITO";
include ("../../../alertas/campo_vacio.php");
?>

