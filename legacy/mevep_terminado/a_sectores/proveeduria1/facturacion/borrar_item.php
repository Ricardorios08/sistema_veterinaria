<?
include ("../../../conexiones/config_pro.php");

$cod_detalle = $_REQUEST['cod_detalle'];
$nro_factura= $_REQUEST['nro_factura'];
$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$año= $_REQUEST['anio'];
$nro_cliente= $_REQUEST['nro_cliente'];
$matricula= $_REQUEST['matricula'];
$forma_pago= $_REQUEST['forma_pago'];
$operador= $_REQUEST['operador'];

$for_pago = 1;

$cantidad= $_REQUEST['cantidad'];
$cod_mercaderia= $_REQUEST['cod_mercaderia'];
$band= $_REQUEST['band'];



$sql = "DELETE FROM ventas1_deta_temp where cod_detalle = $cod_detalle";
mysql_query($sql);

$band_refrescar = 1;
$opera = 1;
include ("entrada_factura_2.php");
include_once ("mostrar_detalle.php");

?>

