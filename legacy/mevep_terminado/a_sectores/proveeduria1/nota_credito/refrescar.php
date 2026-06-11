<?	
$cantidad= $_REQUEST['cantidad'];
$cod_mercaderia= $_REQUEST['cod_mercaderia'];
$band= $_REQUEST['band'];

$sql = "SELECT * FROM `notacredito_encab_temp`  WHERE  `nro_factura` = $nro_factura_nc and tipo_fact = '$tipo_fact_afectado'";
$result = $db->Execute($sql);


	if ($tipo_fact_afectado == "B"){
	include_once ("mostrar_detalle_B.php");
	}
	else
	{
include_once ("mostrar_detalle.php");
	}

?>
	