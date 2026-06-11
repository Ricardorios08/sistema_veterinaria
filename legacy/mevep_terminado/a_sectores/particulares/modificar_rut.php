<?php

include ("../../conexiones/config.inc.php");




$cod_socio=$_POST["cod_socio"];
$cod_socio_usado=$_POST["cod_socio"];


$apellido=$_POST["apellido"];
$nombre=$_POST["nombre"];

$ruta=$_POST["ruta"];

$ruta_nueva=$_POST["ruta_nueva"];


if ($ruta_nueva == ""){
$leyenda = "NO INGRESO RUTA NUEVA";
include ("../../alertas/campo_informacion.php");
exit;

}


$motivo=$_POST["motivo"];

$tipo_pag=$_POST["tipo_pago"];
	for ($i=0;$i<count($tipo_pag);$i++)    
	{     
	$tipo_pago = $tipo_pag[$i];    
	}

if ($tipo_pago == ""){
$sql="select no_imprimir from socios  where cod_socio = $cod_socio";
$result = $db->Execute($sql);
$tipo_pago=$result->fields["no_imprimir"];
}

$cobrado=$_POST["cobrador"];
	for ($i=0;$i<count($cobrado);$i++)    
	{     
	$cobrador = $cobrado[$i];    
	}


	if ($cobrador == ""){
$sql="select * from socios where cod_socio = $cod_socio";
$result = $db->Execute($sql);
$cobrador=$result->fields["cobrador"];

	}

  $sql = "UPDATE socios SET  `no_imprimir` = '$tipo_pago', `motivo` = '$motivo' , `cobrador` = '$cobrador' WHERE cod_socio = $cod_socio;";
mysql_query($sql);



 $sql="select * from socios where ruta >= $ruta_nueva ORDER BY ruta DESC";
$result = $db->Execute($sql);


  If (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$ruta_vieja=$result->fields["ruta"];
$ruta_incre=($result->fields["ruta"] + 1);
$cod_socio=$result->fields["cod_socio"];

$sql1 = "UPDATE socios SET `ruta` = '$ruta_incre' WHERE cod_socio = $cod_socio and ruta = $ruta_vieja;";
mysql_query($sql1);


	  $result->MoveNext();
	}


 $sql1 = "UPDATE socios SET `ruta` = '$ruta_nueva' WHERE cod_socio = $cod_socio_usado";
mysql_query($sql1);






$leyenda = "SE MODIFICO LA RUTA";
include ("../../alertas/campo_informacion.php");
 


	

?>

