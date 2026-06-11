<?php

include ("../../conexiones/config.inc.php");


$habilitar_hc=$_POST["habilitar_hc"];
$codigo_seguridad=$_POST["codigo_seguridad"];


$cod_socio=$_POST["cod_socio"];

$cod_socio_usado=$_POST["cod_socio"];


$apellido=$_POST["apellido"];
$nombre=$_POST["nombre"];

$tipo_docs=$_POST["tipo_doc"];
for ($i=0;$i<count($tipo_docs);$i++)    
{     
$tipo_doc = $tipo_docs[$i];    
}

if ($tipo_doc == ""){
$sql="select tipo_doc from socios  where cod_socio = $cod_socio";
$result = $db->Execute($sql);
$tipo_doc=$result->fields["tipo_doc"];
}


$documento=$_POST["documento"];

$telefono=$_POST["telefono"];
$celular=$_POST["celular"];
$domicilio=$_POST["domicilio"];
$localidad=$_POST["localidad"];

$departament=$_POST["departamento"];
for ($i=0;$i<count($departament);$i++)    
{     
$departamento= $departament[$i];    
}

if ($departamento == ""){
$sql="select departamento from socios  where cod_socio = $cod_socio";
$result = $db->Execute($sql);
$departamento=$result->fields["departamento"];
}


$cod_postal=$_POST["cod_postal"];

$mail=$_POST["mail"];

$sex=$_POST["sexo"];
	for ($i=0;$i<count($sex);$i++)    
	{     
	$sexo = $sex[$i];    
	}
	
if ($sexo == ""){
$sql="select sexo from socios  where cod_socio = $cod_socio";
$result = $db->Execute($sql);
$sexo=$result->fields["sexo"];
}


$importe_cuota=$_POST["importe_cuota"];
$dia_ingreso=$_POST["dia_ingreso"];
$mes_ingreso=$_POST["mes_ingreso"];
$anio_ingreso=$_POST["anio_ingreso"];

$fecha_ingreso=$anio_ingreso."-".$mes_ingreso."-".$dia_ingreso;


$nombre_mascota=$_POST["nombre_mascota"];
$especie=$_POST["especie"];
$pelaje=$_POST["pelaje"];
$raza=$_POST["raza"];
$tamanio=$_POST["tamanio"];
$color=$_POST["color"];

$sexo_mascot=$_POST["sexo_mascota"];
	for ($i=0;$i<count($sexo_mascot);$i++)    
	{     
	$sexo_mascot = $sexo_mascot[$i];    
	}
	
$dia_nac=$_POST["dia_nac"];
$mes_nac=$_POST["mes_nac"];
$anio_nac=$_POST["anio_nac"];

$ruta_nueva=$_POST["ruta"];
$ruta=$_POST["ruta"];


$motivo=$_POST["motivo"];

$tipo_pag=$_POST["tipo_pago"];
	for ($i=0;$i<count($tipo_pag);$i++)    
	{     
	$tipo_pago = $tipo_pag[$i];    
	}

echo "aaaa".$tipo_pago;


if ($tipo_pago == ""){
$sql="select no_imprimir from socios  where cod_socio = $cod_socio";
$result = $db->Execute($sql);
$tipo_pago=$result->fields["no_imprimir"];
}


echo "***".$tipo_pago;
$fecha_nac=$anio_nac."-".$mes_nac."-".$dia_nac;

	$cobrado=$_POST["cobrador"];
	for ($i=0;$i<count($cobrado);$i++)    
	{     
	$cobrador = $cobrado[$i];    
	}


	if ($cobrador == ""){
$sql="select * from socios where cod_socio = $cod_socio";
$result = $db->Execute($sql);
$cobrador=$result->fields["cobrador"];

	}




/*$sql="select * from socios  where cod_socio = $cod_socio";
$result = $db->Execute($sql);
$ruta_actual=$result->fields["ruta"];

if ($ruta_nueva != $ruta_actual){

include ("acomodar_ruta.php");
}
else{
*/



if (($habilitar_hc == 1) and ($codigo_seguridad == "raza")){
 echo $sql = "UPDATE socios SET `apellido` = '$apellido' , `nombre` = '$nombre' , `tipo_doc` = '$tipo_doc' ,  `documento` = '$documento', `telefono` = '$telefono', `domicilio` = '$domicilio', `localidad` = '$localidad', `departamento` = '$departamento', `cod_postal` = '$cod_postal', `fecha_pago` = '$fecha_pago', `debito` = '$debito', `sexo` = '$sexo', `deuda` = '$deuda', `importe_deuda` = 'importe_deuda', `importe_cuota` = '$importe_cuota', `no_imprimir` = '$tipo_pago', `celular` = '$celular', `mail` = '$mail', `fecha_ingreso` = '$fecha_ingreso' , `motivo` = '$motivo' , `cobrador` = '$cobrador' , `habilitar_hc` = '$habilitar_hc' WHERE cod_socio = $cod_socio;";
mysql_query($sql);

$leyenda = "SE HABILITO HISTORIA CLINICA";
include ("../../alertas/campo_informacion.php");

}else{
echo  $sql = "UPDATE socios SET `apellido` = '$apellido' , `nombre` = '$nombre' , `tipo_doc` = '$tipo_doc' ,  `documento` = '$documento', `telefono` = '$telefono', `domicilio` = '$domicilio', `localidad` = '$localidad', `departamento` = '$departamento', `cod_postal` = '$cod_postal', `fecha_pago` = '$fecha_pago', `debito` = '$debito', `sexo` = '$sexo', `deuda` = '$deuda', `importe_deuda` = 'importe_deuda', `importe_cuota` = '$importe_cuota', `no_imprimir` = '$tipo_pago', `celular` = '$celular', `mail` = '$mail', `fecha_ingreso` = '$fecha_ingreso' , `motivo` = '$motivo' , `cobrador` = '$cobrador' , `habilitar_hc` = '$habilitar_hc' WHERE cod_socio = $cod_socio;";
mysql_query($sql);
}


 $sql = "UPDATE `pagos` SET `cobrador` = '$cobrador' WHERE `cod_socio` = '$cod_socio' and estado = 'PENDIENTE'";
mysql_query($sql);


$leyenda = "LOS DATOS HAN SIDO MODIFICADOS EN EL SISTEMA";
include ("../../alertas/campo_informacion.php");
	

?>

