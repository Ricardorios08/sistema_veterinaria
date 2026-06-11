<?
echo "fdsf".$modalidad=$_REQUEST ['modalidad'];
$alicuota=$_REQUEST ['alicuota'];

$operacion=$_REQUEST ['operacion'];
$actualiza=$_REQUEST ['actualiza'];
$cod_mercaderia=$_REQUEST ['cod_mercaderia'];
$cod_proveedor=$_REQUEST ['cod_proveedor'];
$desde=$_REQUEST ['desde'];
$hasta=$_REQUEST ['hasta'];


switch ($modalidad){

case "VAL":{

break;
}


case "PORC":{

break;
}
}//cierra el switch modalidad


switch ($actualiza){

case "ind":{
include ("individual.php");
break;
}


case "ran":{
include ("rango.php");
break;
}
}//cierra el switch modalidad



?>