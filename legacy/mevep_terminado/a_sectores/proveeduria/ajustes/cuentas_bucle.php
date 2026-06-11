<?



if ($descripcion != "") {

if ($cantidad == ""){
$leyenda = "NO INGRESO CANTIDAD";
include ("../../../alertas/campo_vacio.php");
exit;
}

if ($cod_mercaderia== ""){
$leyenda = "NO INGRESO MERCADERIA";
include ("../../../alertas/campo_vacio.php");
exit;
}

if ($descripcion == ""){
	$leyenda = "PRODUCTO INEXISTENTE";
	include ("../../../alertas/campo_vacio.php");
exit;
}

$total = $precio_actualizado * $cantidad;
//$total = $cantidad * $precio_unitario;

$sql9 = "SELECT count(*) as total FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$total_ordenes = $db_aj->Execute($sql9);
$items=$total_ordenes->fields["total"];




if ($items < 18){
 $sql = "INSERT INTO `ventas1_deta_temp` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact`  )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad_existente' , '$precio_actualizado' , '$total' , '$fact')";
$result19 = $db_aj->Execute($sql);
}
else{
	echo "CANTIDAD DE ITEMS COMPLETOS, POR FAVOR PROCEDA A FACTURA";

}

}


?>