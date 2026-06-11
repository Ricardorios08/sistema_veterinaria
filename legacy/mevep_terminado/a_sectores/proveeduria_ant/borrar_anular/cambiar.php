<?

include ("../../../conexiones/config_grabacion.php");

echo $nro_factura = $_REQUEST['nro_factura'];
echo $nro_factura_nuevo = $_REQUEST['nro_factura_nuevo'];
$tipo_fact = $_REQUEST['tipo_fact'];
$tipo_fact_nuevo = $_REQUEST['tipo_fact_nuevo'];

if ($nro_factura == ""){
	$leyenda = "NO INGRESO NUMERO DE FACTURA ANTERIOR";
	include ("../../../alertas/campo_vacio.php");
	exit;
}

if ($nro_factura_nuevo == ""){
	$leyenda = "NO INGRESO NUMERO DE FACTURA ANTERIOR";
	include ("../../../alertas/campo_vacio.php");
	exit;
}


$sql1="select * from factura where nro_factura like '$nro_factura_nuevo' and tipo_fact = '$tipo_fact'";
$result1 = $db_fa->Execute($sql1);

echo "fds".$nro_factura_viejo=$result1->fields["nro_factura"];

if ($nro_factura_viejo != ""){
	$leyenda = "NO PUEDE INGRESAR ESE NUMERO DE FACTURA";
	include ("../../../alertas/campo_vacio.php");
	exit;
}
else
{

$sql = "UPDATE `detalle` SET `nro_factura` = $nro_factura_nuevo WHERE `nro_factura` = $nro_factura";
$result1 = $db_gb->Execute($sql);
$sql = "UPDATE `ordenes` SET `nro_fac` = $nro_factura_nuevo WHERE `nro_fac` = $nro_factura";
$result1 = $db_gb->Execute($sql);
$sql = "UPDATE `composicion` SET `nro_factura` = $nro_factura_nuevo WHERE `nro_factura` = $nro_factura";
$result1 = $db_liq->Execute($sql);
$sql = "UPDATE `factura` SET `nro_factura` = $nro_factura_nuevo WHERE `nro_factura` = $nro_factura";
$result1 = $db_fa->Execute($sql);

$leyenda = "SE CAMBIO EL NUMERO DE FACTURA: ". $nro_factura." POR: ".$nro_factura_nuevo;
include ("../../../alertas/campo_informacion.php");

}



/*
if (($nueva_fact == "aceptada") && ($vieja_fact == "aceptada")){
echo "cambiar todos los nº de factura";

echo $sql = "UPDATE `detalle` SET `nro_factura` = $nro_factura_nuevo WHERE `nro_factura` = $nro_factura";
//$result1 = $db_gb->Execute($sql);
echo $sql = "UPDATE `ordenes` SET `nro_fac` = $nro_factura_nuevo WHERE `nro_fac` = $nro_factura";
//$result1 = $db_gb->Execute($sql);
echo $sql = "UPDATE `composicion` SET `nro_factura` = $nro_factura_nuevo WHERE `nro_factura` = $nro_factura";
//$result1 = $db_liq->Execute($sql);
echo $sql = "UPDATE `factura` SET `nro_factura` = $nro_factura_nuevo WHERE `nro_factura` = $nro_factura";
//$result1 = $db_fa->Execute($sql);

}

*/

?>
