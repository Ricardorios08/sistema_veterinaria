<?php
require('conexion.php');

$usuario=$_POST['usuario'];
$mensaje=$_POST['mensaje'];

if($usuario=='') $usuario='anonimo';
if($mensaje=='') $mensaje='ningun mensaje';

$query = "INSERT INTO chat ( fecha, usuario, mensaje) VALUES (NOW(),'$usuario','$mensaje')";

mysql_query($query);
//eliminando registros si estos superarn los 10
$max=10;
$NroRegistros=mysql_num_rows(mysql_query("SELECT * FROM chat",$con));
if($NroRegistros>$max){
	$NroAEliminar=$NroRegistros-$max;
	mysql_query("DELETE FROM chat ORDER BY fecha ASC LIMIT $NroAEliminar");
}
?>
