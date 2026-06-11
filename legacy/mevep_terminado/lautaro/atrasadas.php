<?php 

include ("../conexiones/config_gb.php");
$sql = "SELECT * FROM `confirmada`  WHERE 1 AND `cod_grabacion` LIKE '5073%' AND `confirmada` LIKE '1' AND `periodo` = 09 AND `anio` LIKE '07' ";
$result3 = $db->Execute($sql);

if (!$result3) die("fallo3".$db->ErrorMsg());
	 while (!$result3->EOF) { 

echo $cod_grabacion=$result3->fields["cod_grabacion"];
echo "<br>";
$cont = $cont + 1;

$sql1 = "UPDATE `detalle` SET `confirmada` = 1 WHERE `cod_grabacion` = $cod_grabacion";

//echo $sql1 = "UPDATE `detalle` SET `confirmada` = 1 WHERE `cod_grabacion` = $cod_grabacion"; //para los casos traidos de cobol
mysql_query($sql1);
$result3->MoveNext();
}
echo $cont;
echo "THE END";