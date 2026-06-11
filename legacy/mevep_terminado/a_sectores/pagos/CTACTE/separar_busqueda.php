<?php 

$busca = $_REQUEST['busca'];
$buscador_rapido = $_REQUEST['buscador_rapido'];

$opcione=$_POST["opciones"];
	for ($i=0;$i<count($opcione);$i++)    
	{     
$opciones = $opcione[$i];    
	}


$pago=$_POST["pago"];
$opcion = $_REQUEST['opcion'];


$ordena=$_POST["ordenar"];
	for ($i=0;$i<count($ordena);$i++)    
	{     
$ordenar = $ordena[$i];    
	}


if ($ordenar == ""){
	$ordenar = "fecha,  tipo_fact, comprobante";
}


 $dia_d = $_REQUEST['dia_d'];
$mes_d = $_REQUEST['mes_d'];
 $anio_d = $_REQUEST['anio_d'];

$dia_h = $_REQUEST['dia_h'];
$mes_h = $_REQUEST['mes_h'];
 $anio_h = $_REQUEST['anio_h'];

$dia_desde = $anio_d."-".$mes_d."-".$dia_d;
$dia_desde1 = $dia_d."-".$mes_d."-".$anio_d;

 $dia_hasta = $anio_h."-".$mes_h."-".$dia_h;
$dia_hasta1 = $dia_h."-".$mes_h."-".$anio_h;

$tipo = $_REQUEST['tipo'];


switch ($tipo){

case "1":{  include ("cta_cte.php");break;}
case "2":{
$mes_deuda = $_REQUEST['mes_deuda'];
$anio_deuda = $_REQUEST['anio_deuda'];
include ("cta_cte_deuda.php");
break;}


case "3":{  include ("cta_cte_impresion.php");break;}
}



?>
