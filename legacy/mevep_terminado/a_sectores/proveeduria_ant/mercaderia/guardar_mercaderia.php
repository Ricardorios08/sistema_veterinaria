<BODY background="pescar.bmp"><CENTER><TABLE WIDTH="90%" BORDER=0><TR><TD>  

<?php
include ("../../../conexiones/config_pro.php");

//tabla mercaderia
$cod_merca=$_POST["cod_merca"];
$nombre=$_POST["nombre"];
$proveedo=$_POST["proveedor"];
	for ($i=0;$i<count($proveedo);$i++)    
	{     
	$proveedor = $proveedo[$i];  
			}

$precio_actualizado=$_POST["precio_actualizado"];
$tipo_moneda=$_POST["tipo_moneda"];

$cod_tasa = 2;

$sql = "INSERT INTO `mercaderia` ( `cod_merca` , `nombre` , `proveedor` , `precio_actualizado`  , `tipo_moneda`  , `cod_tasa`) VALUES( '$cod_merca' ,'$nombre' , '$proveedor' , '$precio_actualizado' , '$tipo_moneda' , '$cod_tasa')";
 mysql_query($sql);
include ("../../proveeduria/mercaderia/entrada_mercaderia.php");

?>

