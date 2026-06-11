
<?

$nro_factura = $_REQUEST['nro_factura'];
$cuenta= $_REQUEST['cuenta'];
$denominacion= $_REQUEST['denominacion'];
$neto= $_REQUEST['neto'];
$cheque1= $_REQUEST['importe_cheque'];
$contado1= $_REQUEST['importe_caja'];
$tipo_fact= $_REQUEST['tipo_fact'];
$fecha= $_REQUEST['fecha'];
$fecha_a= $_REQUEST['fecha_a'];

if ($cheque1 != $neto){
$contado = round($neto - $cheque1,2);
}


if (($contado1 == "") && ($cheque1 == "")){
$leyenda = "NO INGRESO VALORES";
include ("../../../../alertas/campo_informacion2.php");
exit;
}

if ($cheque1 + $contado1 > $neto){
$leyenda = "NO PUEDE INGRESAR VALORES SUPERIORES A LO FACTURADO";
include ("../../../../alertas/campo_informacion2.php");
exit;
}

/*if ($cheque1 + $contado1 < $neto){
$leyenda = "NO PUEDE INGRESAR VALORES INFERIORES A LO FACTURADO";
include ("../../../../alertas/campo_informacion2.php");
exit;
}
*/

include ("../../../../conexiones/config_pro.php");
$sql = "UPDATE `ventas_encabezado` SET `cheque` = '$cheque1',`contado` = '$contado' WHERE `tipo_fact` = '$tipo_fact' AND `nro_factura` = '$nro_factura'";
mysql_query($sql);

$leyenda = "SE ACTUALIZO DIARIO DE VENTA";
include ("../../../../alertas/campo_informacion.php");
$cheque = 1;
include ("diario_vta.php");

