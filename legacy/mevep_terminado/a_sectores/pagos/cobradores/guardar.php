 <?php
include ("../../../conexiones/config.inc.php");


$nombre=$_POST["nombre"];

$pla=$_POST["plan"];
	for ($i=0;$i<count($pla);$i++)    
	{     
	$plan = $pla[$i];    
	}
	
      $sql11="select *  from cobradores order by cod_cobrador desc";
$result11 = $db->Execute($sql11);

$cod_cobrador=$result11->fields["cod_cobrador"]+1;

 


echo $sql = "INSERT INTO cobradores ( `cod_cobrador` , `nombre_cobrador` , `destino` , `plan` ) VALUES ( '$cod_cobrador' , '$nombre' , '$destino' , '$plan')";
mysql_query($sql);


$leyenda = "LOS DATOS HAN SIDO GUARDADOS EN EL SISTEMA";
include ("../../../alertas/campo_informacion.php");
	

?>

