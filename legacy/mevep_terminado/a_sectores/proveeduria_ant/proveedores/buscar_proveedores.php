<?php

echo $a;
	if ($a == 1){
?><body background="../../imagenes/logito.png"><?php 
}
else
{
?><body background="../imagenes/logito.png"><?php 
}



global $buscador_rapido;

if ($refre != "SI"){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/y");
include("../../conexiones/config_pro.php");


$B = 1;
$palabra=$_POST["busca"];
$buscador_rapido;
if ($palabra == ""){
$sql="select * from proveedores where cuenta order by cuenta, denominacion";

}else{

$sql="select * from proveedores where cuenta like '%$palabra%'  or denominacion like '%$palabra%' or domicilio like '%$palabra%' order by cuenta asc ";
}
	$result = $db->Execute($sql);
?>
<table width="850" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="11"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE PROVEEDORES . Emitido el <?php echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
 
    <td width="71"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>CUENTA</strong></font></div></td>
    <td width="356"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>RAZON SOCIAL O APELLIDO</strong></font></div></td>
<td width="133"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>CONTACTO</strong></font></div></td>
    <td width="122"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>TELEFONO(1)</strong></font></div></td>
    <td width="55"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>MODIFICAR </strong></font></div></td>
    <td width="47"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>ELIMINAR </strong></font></div></td>
    <td width="36"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>FICHA </strong></font></div></td>
  </tr>
 
 <?php
 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cuenta=strtoupper($result->fields["cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$telefono=strtoupper($result->fields["telefono_1"]);
$contacto=strtoupper($result->fields["contacto"]);

?>

  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
		
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php print("$cuenta");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="left"><font size="2"><?php print("$denominacion");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php print("$contacto");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php print("$telefono");?></font></div></td>
   <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="proveedores/modificar_proveedor.php?cuenta=<?php print("$cuenta");?>"><IMG SRC="../../imagenes/office/027.ico" alt="Modificar" border = "0"></a></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="proveedores/borra.php?cuenta=<?php print("$cuenta");?>"><IMG SRC="../../imagenes/office/1047.ico" alt="Eliminar" border = "0"></a></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="proveedores/ficha.php?cuenta=<?php print("$cuenta");?>"><IMG SRC="../../imagenes/office/005.ico" alt="Ficha" border = "0"></a></font></div></td>
  </tr>
  <?php 





$result->MoveNext();
	}

?>
</table>
