<?
$actua= $_REQUEST['actua'];
$impri =$_REQUEST['imprimir'];
$tipo_fact_afectado = $_REQUEST['tipo_fact_afectado'];
$nro_factura_afectada = $_REQUEST['nro_factura_afectada'];
$nro_factura_nc= $_REQUEST['nro_factura_nc'];
$anular_iva= $_REQUEST['anular_iva'];

$renglon1= $_REQUEST['renglon1'];
$renglon2= $_REQUEST['renglon2'];
$renglon3= $_REQUEST['renglon3'];
$renglon4= $_REQUEST['renglon4'];

$importe1= $_REQUEST['importe1'];
$importe2= $_REQUEST['importe2'];
$importe3= $_REQUEST['importe3'];
$importe4= $_REQUEST['importe4'];

$leyenda1 = "FACTURA AFECTADA Nº ".$tipo_fact_afectado." - ".$nro_factura_afectada;


if ($actua == "Actualizar Stock"){
	include ("actualiza_B.php");}
	elseif ($impri == "imprimir"){
	include ("factura_papel_A.php");
}
?>