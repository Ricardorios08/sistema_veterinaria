<?

include ("../../../conexiones/config_grabacion.php");

//encabeado
echo "Fecha: ".$fecha=$_REQUEST ['fecha'];
echo " = ";
echo  " cod mov: ".$cod_movimiento=$_REQUEST ['cod_movimiento'];
echo " = ";
echo  " tipo_fact: ".$tipo_fact=$_REQUEST ['tipo_fact'];
echo " = ";
echo  " nro_factura: ".$nro_factura=$_REQUEST ['nro_factura'];
echo " = ";
echo  " tipo_cuenta: ".$tipo_cuenta=$_REQUEST ['tipo_cuenta'];
echo " = ";
echo  " cuenta: ".$cuenta=$_REQUEST ['cuenta'];
echo "<br>";

//detalle
echo "Cantidad: ".$cantidad=$_REQUEST ['cantidad'];
echo " - Cod Mercaderia: ".$cod_mercaderia=$_REQUEST ['cod_mercaderia'];
echo " - Lote: ".$lote=$_REQUEST ['lote'];
echo " - Mes Lote: ".$mes_lote=$_REQUEST ['mes_lote'];
echo " - Anio lote: ".$anio_lote=$_REQUEST ['anio_lote'];
echo " - Precio Unitario: ".$precio_unitario=$_REQUEST ['precio_unitario'];
echo " - Total: ".$total=$_REQUEST ['total'];
echo "<br>";



$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result = $db_pro->Execute($sql);
$descripcion=strtoupper($result->fields["descripcion"]);


if ($cod_mercaderia != ""){
 $sql = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` )  VALUES ('$nro_factura' , '' , '$cod_mercaderia' , '$descripcion' , '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_unitario' , '$total' , '$tipo_fact')";
$result = $db_pro->Execute($sql);


 $sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `tipo_fact` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` , `tipo_cuenta` , `cod_operacion` ) VALUES ('$cod_mercaderia' , '$fecha' , '$cod_movimiento' , '$tipo_fact' , '$nro_factura' , '$cantidad' , '$precio_unitario' , '$lote' , '$mes_lote' , '$anio_lote' , '$cuenta' , '$tipo_cuenta' , '' )";
$result = $db_pro->Execute($sql);



 $sql = "SELECT * FROM `existencias`  WHERE  cod_mercaderia = $cod_mercaderia and  lote = '$lote' and mes_lote = '$mes_lote' and anio_lote = '$anio_lote'";
$result = $db_pro->Execute($sql);

echo "cantidad_actual ".$cantidad_salida=strtoupper($result->fields["cantidad_salida"]);
echo " - ";
$cantidad_en_existencia = $cantidad_salida + $cantidad;
echo "cantidad a actualizar ".$cantidad_en_existencia;
echo "<br>";

$sql = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_en_existencia' WHERE  cod_mercaderia = $cod_mercaderia and  lote = '$lote' and mes_lote = '$mes_lote' and anio_lote = '$anio_lote'";
$result = $db_pro->Execute($sql);
}


$band = 1;
include ("arreglar_facturas.php");
?>