<?php
global $buscador_rapido;
$buscador_rapido=$_POST["buscador_rapido"];
$hoy = date("d/m/y");

include ("../../../conexiones/config_pro.php");

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
<table width="103%" height="58" border="0">
   <tr bordercolor="#FFFFCC" bgcolor="#000099">
     <td colspan="4" bgcolor="#E6E6E6"><div align="center"><font face="Arial, Helvetica, sans-serif">LISTADO DE PROVEEDORES </font></div></td>
   <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td width="5%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Nº PROVEEDOR</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">RAZON SOCIAL O APELLIDO</font></div></td>
	<td width="12%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">CONTACTO</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">TELEFONO</font></div></td>
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
