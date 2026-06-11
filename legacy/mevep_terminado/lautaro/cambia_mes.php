<?php 
include ("../conexiones/config_gb.php");

ECHO $sql8 = "SELECT * FROM `confirmada` WHERE periodo = 'JUN'";
$result8 = $db->Execute($sql8);

 if (!$result8) die("fallo".$db->ErrorMsg());
  while (!$result8->EOF) {

	  $cod_grabacion=strtoupper($result8->fields["cod_grabacion"]);

	echo $sql = "UPDATE `confirmada` SET `periodo` = '05' WHERE `cod_grabacion` = '$cod_grabacion'";

		
		//mysql_query($sql);

$result8->MoveNext();
	} 
