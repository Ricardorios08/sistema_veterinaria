<link href="../../menus.css" rel="stylesheet" type="text/css" />

<?php
include ("../../conexiones/config.inc.php");

echo "<br>";

$fecha_turno = $anio1."-".$mes1."-".$c;

$hoy1 = date("Y-m-d");

//if ($fecha_turno >= $hoy1){

 ?>
 <style type="text/css">
<!--
.Estilo3 {font-family: "Trebuchet MS"}
.Estilo4 {font-size: 10px}
.Estilo5 {font-family: "Trebuchet MS"; font-size: 11px; }
-->
 </style>
 <table width="90%" border="1" cellpadding="0" cellspacing="0">
<?php


$sql="select * from turno where fecha_turno = '$fecha_turno'";
$result = $db->Execute($sql);


 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$col1=strtoupper($result->fields["col1"]);	
$col2=strtoupper($result->fields["col2"]);
$col3=strtoupper($result->fields["col3"]);
$col4=strtoupper($result->fields["col4"]);
$col5=strtoupper($result->fields["col5"]);
$col6=strtoupper($result->fields["col6"]);
$col7=strtoupper($result->fields["col7"]);

$nro_profesional=strtoupper($result->fields["nro_profesional"]);


?>






   
      <tr>

    <td><div align="left" class="Estilo5">pelu1 </div></td>
	  <td><div align="left" class="Estilo5">pelu2 </div></td>
    <td><div align="left" class="Estilo5"><?php echo $col1;?></div></td>
    <td><div align="left" class="Estilo5"><?php echo $col2;?></div></td>
    <td><div align="left" class="Estilo5"><?php echo $col3;?></div></td>
	<td><div align="left" class="Estilo5"><?php echo $col4;?></div></td>
	<td><div align="left" class="Estilo5"><?php echo $col5;?></div></td>
	<td><div align="left" class="Estilo5"><?php echo $col6;?></div></td>
	<td><div align="left" class="Estilo5"><?php echo $col7;?></div></td>




      </tr>



<?php 


$result->MoveNext();
	}

//}



?>
</table>

	