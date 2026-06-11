<?php

include("../../../conexiones/config_pro.php");
$cod_mercaderia=$_REQUEST ['cod_mercaderia'];
$precio_nuevo=$_REQUEST ['precio_nuevo'];

$sql = "UPDATE `mercaderia` SET `precio_actualizado` = '$precio_nuevo' WHERE `cod_merca` = '$cod_mercaderia'";
mysql_query($sql);


$hoy = date("d/m/y");
$sql="select * from mercaderia where cod_merca like '$cod_mercaderia'";
$result = $db->Execute($sql);

?>
<table width="103%" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#993300">
    <td colspan="12
	" bgcolor="#E1F2EF"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">ACTUALIZACION DE PRECIOS . Emitido el <?echo $hoy;?> </font></div></td>
  </tr>

<tr bordercolor="#FFFFCC" bgcolor="#993300">
    <td colspan="12
	" bgcolor="#E1F2EF"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">  <?print("$modalidad");?> - <?print("$alicuota");?> - <?print("$operacion");?> </font></div></td>
  </tr>


    <tr bordercolor="#FFFFFF" bgcolor="#000099">
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DESCRIPCION</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRESENTACION</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRECIO ACTUALIZADO</font></div></td>
<td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">AJUSTE</font></div></td>
	<td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRECIO NUEVO</font></div></td>
</tr>
  <?



 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cod_merca=strtoupper($result->fields["cod_merca"]);
$nombre=strtoupper($result->fields["nombre"]);
$precio_actualizado=number_format($result->fields["precio_actualizado"],2);
$presentacion=strtoupper($result->fields["presentacion"]);




		?> <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cod_merca");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$nombre");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$presentacion");?></font></div></td>
	<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$precio_actualizado");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$precio_nuevo");?></font></div></td><?

		



$result->MoveNext();
	}

?>
</table>
