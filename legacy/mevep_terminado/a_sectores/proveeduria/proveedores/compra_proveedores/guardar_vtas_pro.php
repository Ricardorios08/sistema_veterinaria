<BODY background="pescar.bmp"><CENTER><TABLE WIDTH="90%" BORDER=0><TR><TD>  

<?php
include ("../../../../conexiones/config_pro.php");


$nro_proveedor=$_POST["nro_proveedor"];
$fecha=$_POST["fecha"];
$factura=$_POST["factura"];
$porcentaje_boni=$_POST["porcentaje_boni"];
$porcentaje_dto=$_POST["porcentaje_dto"];
$cod_merca=$_POST["cod_merca"];
$cantidad=$_POST["cantidad"];





echo $sql = "INSERT INTO `compras_proveeduria` ( `nro_proveedor` , `fecha` , `factura` , `porcentaje_boni` , `porcentaje_dto` , `cod_merca`  , `presentacion` , `lote` , `vto_lote` , `precio_unitario`, `cantidad`)VALUES ('$nro_proveedor' ,'$fecha' , '$factura', '$porcentaje_boni', '$porcentaje_dto', '$cod_merca'  , '$presentacion' , '$lote' , '$vto_lote' , '$precio_unitario', '$cantidad' )";


mysql_query($sql);


include ("../../../proveeduria/proveedores/compra_proveedores/vtas_pro.php");



 
?>