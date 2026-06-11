<?php

include ("../../conexiones/config.inc.php");
date_default_timezone_set('America/Los_Angeles');

 $cod_socio= $_REQUEST['cod_socio'];
 $tipo= $_REQUEST['tipo'];
 $usuario= $_REQUEST['usuario'];

$sql="select * from  usuario  where id = $usuario";
 $result = $db->Execute($sql);
$nombre_vet=$result->fields["nombre"];


 $diagnostico_presuntivo= $_REQUEST['diagnostico_presuntivo'];
 $diagnostico= $_REQUEST['diagnostico'];
 $hoy = date("Y-m-d");


IF ($diagnostico == ""){
	$leyenda = "DEBE INGRESAR HISTORIA DE LA MASCOTA";
	include ("../../alertas/campo_informacion2.php");
	exit;
}else{

  $time = time();
 $hora = date("H:i:s", $time);

 $sql = "INSERT INTO `diagnostico` (`cod_socio`, `fecha_diagnostico`, `diagnostico_presuntivo`, `diagnostico`, `cod_operacion` , `tipo` , `usuario` , `veterinario` , `hora`  ) VALUES ('$cod_socio', '$hoy', '$diagnostico_presuntivo', '$diagnostico', NULL, '$tipo' , '$usuario' , '$nombre_vet'  , '$hora')";
mysql_query($sql);

	$leyenda = "SE GUARDO HISTORIA CLINICA";
	include ("../../alertas/campo_informacion.php");

}

