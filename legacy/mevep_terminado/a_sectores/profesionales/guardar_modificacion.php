<?php
include ("../../conexiones/config.inc.php");


$nro_profesional=$_POST["nro_profesional"];
$apellido=$_POST["apellido"];
$nombre=$_POST["nombre"];

$especialida=$_POST["especialidad"];
	for ($i=0;$i<count($especialida);$i++)    
	{     
	$especialidad = $especialida[$i];    
	}

if ($especialidad == ""){
$sql="select * from profesionales where nro_profesional = $nro_profesional";
$result = $db->Execute($sql);
$especialidad=$result->fields["especialidad"];
}

$sex=$_POST["sexo"];
	for ($i=0;$i<count($sex);$i++)    
	{     
	$sexo = $sex[$i];    
	}

if ($sexo == ""){
$sql="select * from profesionales where nro_profesional = $nro_profesional";
$result = $db->Execute($sql);
$sexo=$result->fields["sexo"];
}

$dia=$_POST["dia"];
$mes=$_POST["mes"];
$anio=$_POST["anio"];
$fecha_nacimiento=$anio."-".$mes."-".$dia;



$domicilio=$_POST["domicilio"];
$localidad=$_POST["localidad"];
$telefono=$_POST["telefono"];
$celular=$_POST["celular"];
$mail=$_POST["mail"];


echo "******".$lunes=$_POST["lunes"];




$martes=$_POST["martes"];
$miercoles=$_POST["miercoles"];
$jueves=$_POST["jueves"];
$viernes=$_POST["viernes"];
$sabado=$_POST["sabado"];
$duracion_consulta=$_POST["duracion_consulta"];
$espacio_entre_turnos=$_POST["espacio_entre_turnos"];
$cantidad_turnos_diarios=$_POST["cantidad_turnos_diarios"];

$turn=$_POST["turno"];
	for ($i=0;$i<count($turn);$i++)    
	{     
	$turno = $turn[$i];    
	}

if ($turno == ""){
$sql="select * from profesionales where nro_profesional = $nro_profesional";
$result = $db->Execute($sql);
$turno=$result->fields["turno"];
}



$horario_turno_manana=$_POST["horario_turno_manana"];
$horario_turno_tarde=$_POST["horario_turno_tarde"];
 
$tipo_horari=$_POST["tipo_horario"];
	for ($i=0;$i<count($tipo_horari);$i++)    
	{     
	$tipo_horario = $tipo_horari[$i];    
	}



if ($tipo_horario == ""){
$sql="select * from profesionales where nro_profesional = $nro_profesional";
$result = $db->Execute($sql);
$tipo_horario=$result->fields["tipo_horario"];
}




if ($nombre == ""){
$leyenda = "NO INGRESO NOMBRE";
include ("../../alertas/campo_informacion2.php");
EXIT;
}


if ($apellido == ""){
$leyenda = "NO INGRESO APELLIDO";
include ("../../alertas/campo_informacion2.php");
EXIT;
}

$horario_turno_tarde =$_POST["horario_turno_tarde"];
$horario_turno_manana =$_POST["horario_turno_manana"];


$sql = "UPDATE `profesionales` SET `apellido` = '$apellido', `nombre` = '$nombre', `especialidad` = '$especialidad', `sexo` = '$sexo', `fecha_nacimiento` = '$fecha_nacimiento', `domicilio` = '$domicilio', `localidad` = '$localidad', `telefono` = '$telefono', `celular` = '$celular', `mail` = '$mail', `lunes` = '$lunes', `martes` = '$martes', `miercoles` = '$miercoles', `jueves` = '$jueves', `viernes` = '$viernes', `sabado` = '$sabado' , `duracion_consulta` = '$duracion_consulta', `espacio_entre_turnos` = '$espacio_entre_turnos', `cantidad_turnos_diarios` = '$cantidad_turnos_diarios', `turno` = '$turno', `horario_turno_manana` = '$horario_turno_manana', `horario_turno_tarde` = '$horario_turno_tarde', `tipo_horario` = '$tipo_horario' WHERE nro_profesional = $nro_profesional";
mysql_query($sql);


$bande_nuevo = 1;
$palabra = $nro_paciente;
$bande = 2;

	$leyenda = "SE MODIFICO PROFESIONAL";
include ("../../alertas/campo_informacion.php");

?>

