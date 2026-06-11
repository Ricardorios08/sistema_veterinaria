<?

$cod_mercaderia = $_REQUEST['cod_mercaderia'];
$lote= $_REQUEST['lote'];
$mes_lote= $_REQUEST['mes_lote'];
$anio_lote= $_REQUEST['anio_lote'];

include ("../../../conexiones/config_pro.php");

$sql = "DELETE FROM existencias_nuevo where cod_mercaderia = '$cod_mercaderia'";
mysql_query($sql);

$sql = "DELETE FROM stock_nuevo where cod_mercaderia = '$cod_mercaderia'";
mysql_query($sql);

$cod_mercaderia = "";

$banderas=1;
$emision=1;

include ("separar_busqueda.php");

