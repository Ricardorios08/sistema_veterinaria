<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();"> 

<?php

include("adodb.inc.php");
$db = NewADOConnection('mysql');
$db->Connect("localhost", "root", "", "mevep");


$desde=$_POST["desde"];
$hasta=$_POST["hasta"];

$mes_fac=$_POST["mes_fac"];
$fecha_fac=$_POST["fecha_fac"];


if ($desde == ""){
$leyenda = "NO INGRESO RANGO DESDE";
include ("../../alertas/campo_informacion.php");
EXIT;
}

if ($hasta == ""){
$leyenda = "NO INGRESO RANGO DESDE";
include ("../../alertas/campo_informacion.php");
EXIT;
}


$hoy = date("d/m/y");



$arriba = 1;


$sql = "SELECT * FROM `socios` WHERE ruta BETWEEN '$desde' AND '$hasta'  and no_imprimir = 'FALSO'";


$result = $db->Execute($sql);

 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {


$cod_socio=$result->fields["cod_socio"];
$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);

$nombre = substr($nombre,0,15);
$apellido= substr($apellido,0,30);


$domicilio=strtoupper($result->fields["domicilio"]);
$departamento=strtoupper($result->fields["departamento"]);
$telefono=strtoupper($result->fields["telefono"]);
$cod_postal=strtoupper($result->fields["cod_postal"]);
$importe_cuota=strtoupper($result->fields["importe_cuota"]);

$sql1="select * from animal where cod_socio = $cod_socio";
$result1 = $db->Execute($sql1);

	
$nombre_mascota=strtoupper($result1->fields["nombre"]);

if ($arriba == 1){
?><br><?
?><br><?
include ("tabla.php");
$arriba = 2;
$result->MoveNext();
?><br><?
}elseif ($arriba == 2){
include("tabla1.php");
$arriba = 3;
$result->MoveNext();
}elseif ($arriba == 3){
?><br><?
?><br><?
?><br><?
?><br><?

include ("tabla2.php");
$arriba = 4;
$result->MoveNext();
}elseif ($arriba == 4){
?><br><?
?><br><?
?><br><?
?><br><?
?><br><?

include ("tabla3.php");
$arriba = 1;
?><br><?
?><br><?
?><br><?
?><br><?
$result->MoveNext();
}



}








	

?>

