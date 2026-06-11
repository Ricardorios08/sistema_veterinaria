<?php

include ("../../../conexiones/config.inc.php");



	$cod_plan=$_POST["cod_plan"];
 
$a1_10=$_POST["a1_10"];
$a11_20=$_POST["a11_20"];
$a21_31=$_POST["a21_31"];
$deuda=$_POST["deuda"];

	if ($plan == ""){
 $sql="select * from cobradores where cod_cobrador = $cod_cobrador";
$result = $db->Execute($sql);
$plan=$result->fields["plan"];

	}



echo $sql = "UPDATE plan_cobrador SET 1_10 = '$a1_10' , 11_20 = '$a11_20' , 21_31 = '$a21_31' , deuda = '$deuda' WHERE cod_plan = '$cod_plan'";
mysql_query($sql);


$leyenda = "LOS DATOS HAN SIDO MODIFICADOS EN EL SISTEMA";
include ("../../../alertas/campo_informacion.php");
	

?>

