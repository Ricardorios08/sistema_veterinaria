<?php 
include ("../conexiones/config_gb.php");
$sql1 = "TRUNCATE TABLE `conf` ";
mysql_query($sql1);

$sql="select * from confirmada group by cod_grabacion";
$result = $db->Execute($sql);

 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cod_grabacion=strtoupper($result->fields["cod_grabacion"]);
$confirmada=strtoupper($result->fields["confirmada"]);


$sql = "INSERT INTO `conf` (`cod_grabacion` , `confirmada`) VALUES ('$cod_grabacion', '$confirmada')";
mysql_query($sql);

$result->MoveNext();
	} 

