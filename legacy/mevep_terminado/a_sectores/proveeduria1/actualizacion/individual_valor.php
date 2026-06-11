<?php

include("../../../conexiones/config_pro.php");


$hoy = date("d/m/y");
$sql="select * from mercaderia where cod_merca like '$cod_mercaderia'";
$result = $db->Execute($sql);

?>

<form action="indiv_valor.php" method="post">


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
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$porc");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><input type="text" size = "4" name="precio_nuevo" id="precio_nuevo" onKeyPress="return verif_caracter(this,event)"></font></div></td>
	
	<input type="hidden" name="cod_mercaderia" value= "<?echo $cod_mercaderia;?>" onKeyPress="return verif_caracter(this,event)">

	<?

		
					
		



$result->MoveNext();
	}

?>
</table>
</form>