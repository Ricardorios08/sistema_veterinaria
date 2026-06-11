 <?php
include ("../../../conexiones/config.inc.php");


$cod_cobrador=$_REQUEST["cod_cobrador"];

 


 $sql = "delete from cobradores where cod_cobrador = $cod_cobrador";
mysql_query($sql);


$leyenda = "LOS DATOS HAN SIDO ELIMINADOS EN EL SISTEMA";
include ("../../../alertas/campo_informacion.php");
	

?>

