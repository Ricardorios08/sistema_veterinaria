<?PHP
include ("../../../conexiones/config.inc.php");

$id=$_REQUEST['id'];
$contra_anterior=$_REQUEST['contra_anterior'];
$contra_nueva=$_REQUEST['contra_nueva'];
$contra_repita=$_REQUEST['contra_repita'];
$nombre=$_REQUEST['nombre'];


$ro=$_POST["rol"];
	for ($i=0;$i<count($ro);$i++)    
	{     
	$rol = $ro[$i];    
	}

if ($rol == ""){
  $sql="select * from usuario where id = $id";
$result = $db->Execute($sql);
$rol=$result->fields["rol"];
}


$sql="select * from usuario where id = $id and contrasena = $contra_anterior";
$result = $db->Execute($sql);

$usu=$result->fields["id"];

if ($usu == ""){
$leyenda = "CONTRASEÑA INCORRECTA";
include ("../../../alertas/campo_informacion2.php");
exit;
}

if ($contra_nueva != $contra_repita){
$leyenda = "LAS CONTRASEÑAS PARECEN NO SER IGUALES";
include ("../../../alertas/campo_informacion2.php");
exit;
}


 $sql = "UPDATE `usuario` SET `contrasena` = '$contra_nueva'   WHERE `id` = '$id' and contrasena = '$contra_anterior'";
$result = $db->Execute($sql);

$leyenda = "SE CAMBIAR LOS DATOS CORRECTAMENTE";
include ("../../../alertas/campo_informacion.php");
