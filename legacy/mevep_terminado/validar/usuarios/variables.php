<?php 
include ("../../conexiones/config.inc.php");
 $sql = "SELECT * FROM `empleados` where id = $id";
$result = $db->Execute($sql);

$id=$result->fields["id"];
$nombre=strtoupper($result->fields["nombre"]);
$apellido=strtoupper($result->fields["apellido"]);
$direccion=strtoupper($result->fields["direccion"]);
$telefono=$result->fields["telefono"];
$celular =strtoupper($result->fields["celular"]);
$email=$result->fields["email"];
$interno=strtoupper($result->fields["interno"]);
$sector=strtoupper($result->fields["sector"]);
$puesto=strtoupper($result->fields["puesto"]);
$mes=strtoupper($result->fields["mes"]);
$anio=strtoupper($result->fields["anio"]);
?>