


<?
include ("../../../conexiones/config_pro.php");




 $lote1= $_REQUEST['lote'];
 $mes_lote1= $_REQUEST['mes_lote'];
 $anio_lote1= $_REQUEST['anio_lote'];
$cantidad1= $_REQUEST['cantidad'];
$presentacion1= $_REQUEST['presentacion'];
$descripcion1= $_REQUEST['descripcion'];


$cod_mercaderia1= $_REQUEST['cod_mercaderia'];

include ("../../../conexiones/config_pro.php");

$cod_detalle1 = $_REQUEST['cod_detalle'];
$nro_factura_afectada = $_REQUEST['nro_factura_afectada'];
$nro_factura_nc = $_REQUEST['nro_factura_nc'];
$tipo_fact_afectado = $_REQUEST['tipo_fact_afectado'];




$band = "1";
$sql = "DELETE FROM notacredito_deta_temp where cod_detalle = $cod_detalle1";
//mysql_query($sql);

$band_refrescar = 1;
$opera = 1;
include ("entrada_factura_2.php");
include_once ("mostrar_detalle_B.php");

?>

