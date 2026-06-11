<?
include ("../../../conexiones/config_pro.php");

$cod_detalle = $_REQUEST['cod_detalle'];
echo "dsfdsfsd".$precio_modificado = $_REQUEST['precio_modificado'];
$nro_proveedor = $_REQUEST['nro_proveedor'];
$fecha= $_REQUEST['fecha'];
$nro_factura= $_REQUEST['nro_factura'];
$porcentaje_boni= $_REQUEST['porcentaje_boni'];
$porcentaje_dto= $_REQUEST['porcentaje_dto'];


$sql = "DELETE FROM compras1_deta_temp where cod_detalle = $cod_detalle";
//mysql_query($sql);

$refrescar = "SI";

include ("ver_compra.php");
include_once("refrescar_detalle.php");

?>

