<?
$nro_os=$_REQUEST ['nro_os'];
$buscar_po=$_REQUEST ['buscar_por'];
$nro_factura=$_REQUEST ['nro_factura'];
$anio=$_REQUEST ['anio'];
 $cliente_proveedor=$_REQUEST ['cliente_proveedor'];


$buscar_po=$_POST["buscar_por"];
	for ($i=0;$i<count($buscar_po);$i++)    
	{     
	$buscar_por = $buscar_po[$i];    
	}

	$me=$_POST["mes"];
	for ($i=0;$i<count($me);$i++)    
	{     
	$mes= $me[$i];    
	}


IF ($mes == ""){
$mes = date("m");
}

	$tip=$_POST["tipo"];
	for ($i=0;$i<count($tip);$i++)    
	{     
	$tipo= $tip[$i];    
	}

$buscar_por;

if ($buscar_por == ""){
$buscar_por = "compras";
}



//$nro_factura=$_REQUEST ['nro_factura'];

switch ($buscar_por){
	case "compras":
	{
	
	include ("compras.php");
		break;
	}

	case "ventas":
	{
include ("ventas.php");
		break;
	}

}


$hoy = date("d/m/y");

