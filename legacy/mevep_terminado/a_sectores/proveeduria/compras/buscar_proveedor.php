<?php
global $buscador_rapido;
$buscador_rapido=$_POST["buscador_rapido"];
$hoy = date("d/m/y");

include ("../../../conexiones/config.inc.php");

$B = 1;
$palabra=$_POST["nro_proveedor"];

if ($palabra == ""){
 $sql="select * from proveedores order by cuenta asc ";
}
else
{
$sql="select * from proveedores where cuenta like '%$palabra%'  or denominacion like '%$palabra%' or domicilio like '%$palabra%' order by cuenta asc ";
}


	$result = $db->Execute($sql);


?>
<table width="799" height="58" border="1" cellpadding="0" cellspacing="0">
   <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td width="9%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Nº</font></div></td>
    <td width="47%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">RAZON SOCIAL O APELLIDO</font></div></td>
	<td width="25%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">CONTACTO</font></div></td>
    <td width="19%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">TELEFONO</font></div></td>
    <?php 


 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cuenta=strtoupper($result->fields["cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$telefono=strtoupper($result->fields["telefono_1"]);
$contacto=strtoupper($result->fields["contacto"]);

					 

	if ($B == 1) {?>
  <tr bordercolor="#FFFFCC" bgcolor="#E1F2EF">
    <?php }?>


  <td><div align="center"><font size="2"><?php print("$cuenta");?></font></div></td>
    <td><div align="center"><font size="2"><?php print("$denominacion");?></font></div></td>
<td><div align="center"><font size="2"><?php print("$contacto");?></font></div></td>
    <td><div align="center"><font size="2"><?php print("$telefono");?></font></div></td>
  </tr>

<?php 
$result->MoveNext();
	}

?>
</table>
