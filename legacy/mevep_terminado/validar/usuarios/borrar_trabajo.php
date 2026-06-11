<?php 
include ("../../conexiones/config.inc.php");
$cod_operacion= $_REQUEST['cod_operacion'];
$fecha= $_REQUEST['fecha'];

$dia = $_REQUEST['dia'];
$mes = $_REQUEST['mes'];
$anio =$_REQUEST['anio'];
$anio = substr($anio,2,2);

$hora= $_REQUEST['hora'];
$trabajo= $_REQUEST['trabajo'];
$para=$_REQUEST['para1'];
$duracion= $_REQUEST['duracion'];

$band = 1;


$SQL="Delete From trabajo where cod_operacion = $cod_operacion";
$db->Execute($SQL);
ECHO "Eliminado";


include ("entrada_trabajo.php");



