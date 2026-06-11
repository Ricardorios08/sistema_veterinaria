<?php
include("../../conexiones/config.inc.php");

$sql = "SELECT * FROM `socios` order by ruta";
$result2 = $db->Execute($sql);

if (!$result2) die("fallo".$db->ErrorMsg());
while (!$result2->EOF) {


$cod_socio=$result2->fields["cod_socio"];
$ruta=strtoupper($result2->fields["ruta"]);

$cont = $cont + 1;

 


 $sql3 = "UPDATE `socios` SET `ruta` = '$cont' WHERE `cod_socio` = '$cod_socio' and ruta = $ruta";
$result3 = $db->Execute($sql3);


echo $sql = "SE ACOMODARON LAS RUTAS".$cont." ".$cod_socio." ".$ruta;
ECHO "<br>";


$result2->MoveNext();

	}


?>


