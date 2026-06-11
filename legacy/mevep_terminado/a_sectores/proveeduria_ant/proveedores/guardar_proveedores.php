<?php
include ("../../../conexiones/config_pro.php");

//tabla proveedores
$cuenta=$_POST["cuenta"];
$denominacion=$_POST["denominacion"];
$contacto=$_POST["contacto"];
$domicilio=$_POST["domicilio"];

$puerta=$_POST["puerta"];
$referencia=$_POST["referencia"];
$cod_postal =$_POST["cod_postal"];


$localida=$_POST["localidad"];
	for ($i=0;$i<count($localida);$i++)    
	{     
	$localidad = $localida[$i];    
	}


$caracteristica_1=$_POST["caracteristica_1"];
$telefono_1=$_POST["telefono_1"];

$caracteristica_2=$_POST["caracteristica_2"];
$telefono_2=$_POST["telefono_2"];


$caracteristica_3=$_POST["caracteristica_3"];
$telefono_3=$_POST["telefono_3"];


$email=$_POST["email"];



//tabla condiciones_proveedores

$cuit=$_POST["cuit"];

$tipo_ivas=$_POST["tipo_iva"];
for ($i=0;$i<count($tipo_ivas);$i++)    
{     
$tipo_iva = $tipo_ivas[$i];    
}

$ing_brutoo=$_POST["ing_bruto"];
for ($i=0;$i<count($ing_brutoo);$i++)    
{     
$ing_bruto= $ing_brutoo[$i];    
}

$tipo_iva;
$ing_bruto;

$nro_ib=$_POST["nro_ib"];
$pago_orden=$_POST["pago_orden"];
$observaciones=$_POST["observaciones"];




$sql = "INSERT INTO `proveedores` ( `cuenta` , `denominacion` , `contacto` , `domicilio` , `puerta` , `referencia` , `cod_postal` , `localidad` , `caracteristica_1` , `telefono_1` , `caracteristica_2` , `telefono_2` , `caracteristica_3` , `telefono_3` , `email`, `cuit`,`tipo_iva` , `ing_bruto`  , `nro_ib` , `pago_orden` , `observaciones` ) VALUES ('$cuenta' , '$denominacion' , '$contacto' , '$domicilio' , '$puerta' , '$referencia' , '$cod_postal' , '$localidad' , '$caracteristica_1' , '$telefono_1' , '$caracteristica_2' , '$telefono_2' , '$caracteristica_3' , '$telefono_3' , '$email' , '$cuit', '$tipo_iva' , '$ing_bruto' , '$nro_ib' , '$pago_orden' , '$observaciones')";

mysql_query($sql);




include ("../../proveeduria/proveedores/entrada_dato.php");

?>