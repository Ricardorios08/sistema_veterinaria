<?php


$busca=$_REQUEST['busca'];
$operador=$_REQUEST['operador'];
$nro_recibo=$_REQUEST['nro_recibo'];

$cant_fact=$_REQUEST['cant_fact'];
$dia=$_REQUEST['dia'];
$mes=$_REQUEST['mes'];
$anio=$_REQUEST['anio'];
$fecha = $dia."/".$mes."/".$anio;
$fecha_guardar = $anio."-".$mes."-".$dia;
$cant_fact=$_REQUEST['cant_fact'];


$tipo_cuent=$_POST["tipo_cuenta"];
	for ($i=0;$i<count($tipo_cuent);$i++)    
	{     
	$tipo_cuenta = $tipo_cuent[$i];    
	}

 $tipo_cuenta;

switch ($tipo_cuenta){
	
	case "1":{ // Proveeduria Asociados
include ("cobrar_proveeduria.php");
	break;
	}

case "2":{ // Proveeduria Asociados
include ("cobrar_proveeduria.php");
	break;
	}

	case "3":{ // Obras Sociales 
include ("cobrar_os.php");
exit;
	break;
	}

	case "4":{ // Mega Analizar
include ("cobrar_mega.php");
	break;
	}

	case "5":{ // ABM CTA CTE
include ("cobrar_cta.php");
	break;
	}


}


?>
