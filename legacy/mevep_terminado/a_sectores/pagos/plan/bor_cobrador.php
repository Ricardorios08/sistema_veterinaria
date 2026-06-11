 <?php
include ("../../../conexiones/config.inc.php");


$cod_plan=$_REQUEST["cod_plan"];

 


 $sql = "delete from plan_cobrador where cod_plan = $cod_plan";
mysql_query($sql);


$leyenda = "LOS DATOS HAN SIDO ELIMINADOS EN EL SISTEMA";
include ("../../../alertas/campo_informacion.php");
	

?>

