<BODY background="../../../laboratorio/a_sectores/pacientes/pescar.bmp"><CENTER><TABLE WIDTH="90%" BORDER=0><TR><TD>  

<?php
include ("../../conexiones/config.inc.php");

$cod_socio=$_POST["cod_socio"];

	


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

$ruta=$_POST["ruta"];

$tipo_pag=$_POST["tipo_pago"];
	for ($i=0;$i<count($tipo_pag);$i++)    
	{     
	$tipo_pago = $tipo_pag[$i];    
	}


$fecha_nac=$anio_nac."-".$mes_nac."-".$dia_nac;


 $sql="select * from animal_particular  ORDER BY cod_animal DESC";
$result = $db->Execute($sql);
$cod_animal=($result->fields["cod_animal"] + 1);


 $sql = "INSERT INTO `animal_particular` ( `cod_socio` , `nombre` , `especie` , `raza` , `pelaje` , `tamanio` , `color` , `sexo` , `fecha_nac` , `historia_clinica` , `cod_animal` , `motivo` , `nuevo` , `nuevos` )  VALUES ('$cod_socio' , '$nombre_mascota' , '$especie' , '$raza' , '$pelaje' , '$tamanio' , '$color' , '$sexo_mascota' , '$fecha_nac' , '$historia_clinica' , '$cod_animal' , '$motivo' , '$nuevo' , '$nuevos')";
mysql_query($sql);


$leyenda = "SE AGREGO UNA MASCOTA";
include ("../../alertas/campo_informacion.php");
	

?>

