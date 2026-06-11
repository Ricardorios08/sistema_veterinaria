<?php

include ("../../conexiones/config.inc.php");


 $cod_socio= $_REQUEST['cod_socio'];
 $tipo= $_REQUEST['tipo'];
 $usuario= $_REQUEST['usuario'];
echo $cod_operacion= $_REQUEST['cod_operacion'];




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

 $sql = "UPDATE `diagnostico` SET `diagnostico_presuntivo` = '$diagnostico_presuntivo', `diagnostico` = '$diagnostico' where `cod_operacion` = '$cod_operacion'";
mysql_query($sql);

	$leyenda = "SE GUARDO HISTORIA CLINICA";
	include ("../../alertas/campo_informacion.php");

}

