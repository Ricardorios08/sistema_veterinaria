<?php
global $buscador_rapido;
$buscador_rapido=$_POST["buscador_rapido"];
$hoy = date("d/m/y");
 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

$B = 1;

if ($palabra == ""){
 $sql="select * from proveedores order by cuenta asc ";
}
else
{
$sql="select * from proveedores where cuenta like '%$palabra%'  or denominacion like '%$palabra%' or domicilio like '%$palabra%' order by cuenta asc ";
}


	$result = $db->Execute($sql);


?>
<table width="103%" height="58" border="0">
   <tr bordercolor="#FFFFCC" bgcolor="#000099">
     <td colspan="4" bgcolor="#E6E6E6">&nbsp;      </td>
    <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>CUENTA</strong></font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>RAZON SOCIAL O APELLIDO</strong></font></div></td>
	<td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>CONTACTO</strong></font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>TELEFONO</strong></font></div></td>
    <?


 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cuenta=strtoupper($result->fields["cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$telefono=strtoupper($result->fields["telefono_1"]);
$contacto=strtoupper($result->fields["contacto"]);

					 

	if ($B == 1) {?>
	<tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <?}?>


  <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cuenta");?></font></div></td>
      <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$denominacion");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$contacto");?></font></div></td>
	  <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$telefono");?></font></div></td>
  </tr>

<?
$result->MoveNext();
	}

?>
</table>
</form>