<?php 
 $tipo_factura= $_REQUEST['tipo_factura'];
 $confirma= $_REQUEST['confirma'];
$fact =$_REQUEST['fact'];

if (($confirma == "NO") or ($confirma == "no") or ($confirma == "No") or ($confirma == "nO")){



include ("../../../conexiones/config_pro.php");
$sql = "TRUNCATE TABLE `ventas1_deta_temp`";
mysql_query($sql);
$sql = "TRUNCATE TABLE `ventas1_encab_temp`";
mysql_query($sql);
include ("entrada_factura.php");
}




elseif  (($confirma == "SI") or ($confirma == "si") or ($confirma == "Si") or ($confirma == "sI")){

	switch ($tipo_factura){
		case "A":{
			
	include ("actualiza_A.php");

BREAK;
		}

		CASE "B":{

			
	include ("actualiza_B.php");
BREAK;
}
	}

}ELSE
{
include ("ver_temporal.php");
}






?>

