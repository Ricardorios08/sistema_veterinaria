<?


 $sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result = $db->Execute($sql);
$descripcion=strtoupper($result->fields["descripcion"]);
$presentacion=strtoupper($result->fields["presentacion"]);

$id_tasa=strtoupper($result->fields["id_tasa"]);

$sql2="select * from tasas where cod_tasa = $id_tasa";
$result2 = $db->Execute($sql2);

$iva_normal=strtoupper($result2->fields["iva_normal"]);



$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);


$sql3 = "SELECT * FROM `tasas_planes`  WHERE  `cod_plan` = $plan";
$result3 = $db->Execute($sql3);


$precio = $precio_actualizado;


$descuento_1=strtoupper($result3->fields["descuento_1"]);
$porc_descuento_1= round(($precio_actualizado * $descuento_1)/100,2);
$precio_actualizado = $precio_actualizado - $porc_descuento_1;


$descuento_2=strtoupper($result3->fields["descuento_2"]);
$porc_descuento_2= round(($precio_actualizado * $descuento_2)/100,2);
$precio_actualizado = $precio_actualizado - $porc_descuento_2;

$recargo_1=strtoupper($result3->fields["recargo_1"]);
$porc_recargo_1= round(($precio_actualizado * $recargo_1)/100,2);
$precio_actualizado = $precio_actualizado + $porc_recargo_1;

$recargo_2=strtoupper($result3->fields["recargo_2"]);
$porc_recargo_2= round(($precio_actualizado * $recargo_2)/100,2);
$precio_actualizado = $precio_actualizado + $porc_recargo_2;



$recargo_impuesto=strtoupper($result3->fields["recargo_impuestos"]);
$porc_recargo_impuesto= round(($precio_actualizado * $recargo_impuesto)/100,2);
$precio_actualizado = $precio_actualizado + $porc_recargo_impuesto;



$desc_articulo = ($precio_actualizado * $porc_dto)/100;

$desc_factura = $desc_factura + $desc_articulo;



$precio_actualizado = round($precio_actualizado,2);

$fact;

if ($tipo_iva != 4){ //exento

if ($fact == "B"){
$iva_renglon= round(($precio_actualizado * $iva_normal)/100,2);
//$precio_actualizado = round($precio_actualizado + $iva_articulo,3);
$iva_total = $precio_actualizado + $iva_renglon;
$iva_normal;
$precio_unitario = round($precio_actualizado + (($precio_actualizado * $iva_normal)/100),2);
$iva_total = round($iva_total * $cantidad_existente,2);
$iva_renglon = $iva_renglon * $cantidad_existente;
$iva_total = round(($iva_total) * 1,2);

}
else // caso A
{
	$precio_unitario = round($precio_actualizado,2);
	$cantidad_existente;
	$iva_total = $precio_unitario * $cantidad_existente;
}
}else{

$precio_unitario = $precio_actualizado;

if ($band == "SI"){	
		echo "a".$iva_total = $precio_unitario * $dif;}
	else{
		echo "b".		$iva_total = $precio_unitario * $cantidad;
		}



$iva_renglon = 0;

}


$iva_renglon = round($iva_renglon,2);
 


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


$dif;


//$total = $precio_actualizado * $cantidad_existente;
//$total = $cantidad * $precio_unitario;

$sql9 = "SELECT count(*) as total FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$total_ordenes = $db->Execute($sql9);
$items=$total_ordenes->fields["total"];





if ($items < 18){
$sql = "INSERT INTO `ventas1_deta_temp` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` , `iva_renglon` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad_existente' , '$precio_unitario' , '$iva_total' , '$fact' , '$iva_renglon')";
mysql_query($sql);
$precio_actualizado = $prec;
}
else{
	echo "CANTIDAD DE ITEMS COMPLETOS, POR FAVOR PROCEDA A FACTURA";

}

}

 
?>