<BODY background="../../../laboratorio/a_sectores/pacientes/pescar.bmp"><CENTER><TABLE WIDTH="90%" BORDER=0><TR><TD>  

<?php
include ("../../conexiones/config.inc.php");

echo "---".$cod_socio=$_POST["cod_socio"];
$apellido=$_POST["apellido"];
$nombre=$_POST["nombre"];

$tipo_docs=$_POST["tipo_doc"];
for ($i=0;$i<count($tipo_docs);$i++)    
{     
$tipo_doc = $tipo_docs[$i];    
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

$cod_postal=$_POST["cod_postal"];

$mail=$_POST["mail"];

$sex=$_POST["sexo"];
	for ($i=0;$i<count($sex);$i++)    
	{     
	$sexo = $sex[$i];    
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
	$sexo_mascota = $sexo_mascot[$i];    
	}
	
$dia_nac=$_POST["dia_nac"];
$mes_nac=$_POST["mes_nac"];
$anio_nac=$_POST["anio_nac"];

$ruta=$_POST["ruta"];

$tipo_pag=$_POST["tipo_pago"];
	for ($i=0;$i<count($tipo_pag);$i++)    
	{     
	$tipo_pago = $tipo_pag[$i];    
	}

	$cobrado=$_POST["cobrador"];
	for ($i=0;$i<count($cobrado);$i++)    
	{     
	$cobrador = $cobrado[$i];    
	}






$fecha_nac=$anio_nac."-".$mes_nac."-".$dia_nac;



$sql = "INSERT INTO particulares ( `cod_socio` , `apellido` , `nombre` , `tipo_doc` , `documento` , `telefono` , `domicilio` , `localidad` , `departamento` , `cod_postal` , `fecha_pago` , `debito` , `sexo` , `deuda` , `cantidad` , `ruta` , `importe_deuda` , `importe_cuota` , `llamada` , `motivo` , `no_imprimir` , `celular` , `mail` , `fecha_ingreso` , `cobrador` ) VALUES ( '$cod_socio' , '$apellido' , '$nombre' , '$tipo_doc' , '$documento' , '$telefono' , '$domicilio' , '$localidad' , '$departamento' , '$cod_postal' , '$fecha_pago' , '$debito' , '$sexo' , '$deuda' , '$cantidad' , '$ruta' , '$importe_deuda' , '$importe_cuota' , '$llamada' , '$motivo' , '$tipo_pago' , '$celular' , '$mail' , '$fecha_ingreso' , '$cobrador' )";
mysql_query($sql);


$sql = "INSERT INTO `animal_particular` ( `cod_socio` , `nombre` , `especie` , `raza` , `pelaje` , `tamanio` , `color` , `sexo` , `fecha_nac` , `historia_clinica` , `cod_animal` , `motivo` , `nuevo` , `nuevos` )  VALUES ('$cod_socio' , '$nombre_mascota' , '$especie' , '$raza' , '$pelaje' , '$tamanio' , '$color' , '$sexo_mascota' , '$fecha_nac' , '$historia_clinica' , '$cod_animal' , '$motivo' , '$nuevo' , '$nuevos')";
mysql_query($sql);


/*
if ($ruta == ""){
$sql="select * from socios  ORDER BY ruta DESC";
$result = $db->Execute($sql);
$ruta=($result->fields["ruta"] + 1);
}

*/


$leyenda = "LOS DATOS HAN SIDO GUARDADOS EN EL SISTEMA";
include ("../../alertas/campo_informacion.php");

/*	$borrar =1;
	$palabra = $cod_socio;
INCLUDE ("buscar_socios.php");*/


?>

<a href="buscar_socios.php?cod_socio=<?php print("$php?cod_socio");?>&&cod_socio=<?php print("$cod_socio");?>"><strong>IR A HISTORIA</strong></a>

