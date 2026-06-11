<?
$nro_os=$_REQUEST ['nro_os'];
$buscar_po=$_REQUEST ['buscar_por'];
$nro_factura=$_REQUEST ['nro_factura'];
$anio=$_REQUEST ['anio'];
 $cliente_proveedor=$_REQUEST ['cliente_proveedor'];

 $registro=$_REQUEST ['registro'];
$hoja=$_REQUEST ['hoja'];


$buscar_po=$_POST["buscar_por"];
for ($i=0;$i<count($buscar_po);$i++)    
	{     
	$buscar_por = $buscar_po[$i];    
	}

	$tipo_libr=$_POST["tipo_libro"];
for ($i=0;$i<count($tipo_libr);$i++)    
	{     
	$tipo_libro = $tipo_libr[$i];    
	}




$ordena=$_POST["ordenar"];
for ($i=0;$i<count($ordena);$i++)    
	{     
	$ordenar = $ordena[$i];    
	}

	$me=$_POST["mes"];
	for ($i=0;$i<count($me);$i++)    
	{     
	$mes= $me[$i];    
	}

if ($ordenar == "factura"){
	$ordenar = "nro_factura";
}

switch ($mes)
	{
		case "1":{$periodo= "ENERO";}break;
		case "2":{$periodo= "FEBRERO";}break;
		case "3":{$periodo= "MARZO";}break;
		case "4":{$periodo= "ABRIL";}break;
		case "5":{$periodo= "MAYO";}break;
		case "6":{$periodo= "JUNIO";}break;
		case "7":{$periodo= "JULIO";}break;
		case "8":{$periodo= "AGOSTO";}break;
		case "9":{$periodo= "SETIEMBRE";}break;
		case "10":{$periodo="OCTUBRE";}break;
		case "11":{$periodo="NOVIEMBRE";}break;
		case "12":{$periodo="DICIEMBRE";}break;
				}


$perio = $periodo;
$hoy = date("d/m/y");


IF ($tipo_libro == "COMPRAS"){
include ("compras.php");
exit;
}

IF ($tipo_libro == "VENTAS"){
include ("ventas.php");
exit;
}

if ($hoja == ""){
$leyenda = "INGRESE Nº DE HOJA";
include ("../../../alertas/campo_informacion.php");
exit;
}

if ($registro == ""){
$leyenda = "INGRESE Nº DE REGISTRO";
include ("../../../alertas/campo_informacion.php");
exit;
}







