<?php 

include ("../../../conexiones/config_grabacion.php");
$cod_merca=$_POST["cod_merca"];

$cod_merca_nuevo=$_POST["cod_merca_nuevo"];

if ($cod_merca_nuevo > 0){

$nombre=$_POST["nombre"];
$proveedo=$_POST["proveedor"];for ($i=0;$i<count($proveedo);$i++){$proveedor = $proveedo[$i];}
$precio_actualizado=$_POST["precio_actualizado"];
$cod_tas=$_POST["cod_tasa"];for ($i=0;$i<count($cod_tas);$i++){$cod_tasa = $cod_tas[$i];}
$tipo_moneda=$_POST["tipo_moneda"];

 $proveedor;


  $sql="select * from mercaderia where cod_merca = $cod_merca";
$result = $db_pro->Execute($sql);
$ing_bruto1=$result->fields["ing_bruto"];
$proveedor1=$result->fields["proveedor"];
 $cod_tasa1=$result->fields["cod_tasa"];

if ($proveedor == ""){$proveedor = $proveedor1;}
if ( $cod_tasa == ""){$cod_tasa = $cod_tasa1;}


$sql = "DELETE FROM mercaderia where cod_merca = $cod_merca";
$result = $db_pro->Execute($sql);

 $sql = "INSERT INTO `mercaderia` ( `cod_merca` , `nombre` , `proveedor` , `precio_actualizado` , `tipo_moneda` , `cod_tasa`) VALUES( '$cod_merca_nuevo' ,'$nombre' , '$proveedor' , '$precio_actualizado' , '$tipo_moneda' , '$cod_tasa')";
$result = $db_pro->Execute($sql);


$leyenda = "SE HA MODIFICADO EL PRODUCTO ".$cod_merca." ".$descripcion;
include ("../../../alertas/campo_vacio.php");

}
else{


$nombre=$_POST["nombre"];
$proveedo=$_POST["proveedor"];for ($i=0;$i<count($proveedo);$i++){$proveedor = $proveedo[$i];}
$precio_actualizado=$_POST["precio_actualizado"];
$cod_tas=$_POST["cod_tasa"];for ($i=0;$i<count($cod_tas);$i++){$cod_tasa = $cod_tas[$i];}
$tipo_moneda=$_POST["tipo_moneda"];




 $sql="select * from mercaderia where cod_merca = $cod_merca";
$result = $db_pro->Execute($sql);
$ing_bruto1=$result->fields["ing_bruto"];
$proveedor1=$result->fields["proveedor"];
$cod_tasa1=$result->fields["cod_tasa"];

if ($proveedor == ""){$proveedor = $proveedor1;}
if ( $cod_tasa == ""){$cod_tasa = $cod_tasa1;}


$sql = "DELETE FROM mercaderia where cod_merca = $cod_merca";
$result = $db_pro->Execute($sql);

$sql = "INSERT INTO `mercaderia` ( `cod_merca` , `nombre` , `proveedor` , `precio_actualizado` , `tipo_moneda` , `cod_tasa`) VALUES( '$cod_merca' ,'$nombre' , '$proveedor' , '$precio_actualizado' , '$tipo_moneda' , '$cod_tasa')";
$result = $db_pro->Execute($sql);


$leyenda = "SE HA MODIFICADO EL PRODUCTO ".$cod_merca." ".$descripcion;
include ("../../../alertas/campo_vacio.php");
}


?>

