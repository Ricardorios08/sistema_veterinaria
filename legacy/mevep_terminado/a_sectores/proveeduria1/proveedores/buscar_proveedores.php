<?php

echo $a;
	if ($a == 1){
?><body background="../../imagenes/logito.png"><?
}
else
{
?><body background="../imagenes/logito.png"><?
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
$sql="select * from proveedores where cuenta order by denominacion";

}else{

$sql="select * from proveedores where cuenta like '%$palabra%'  or denominacion like '%$palabra%' or domicilio like '%$palabra%' order by cuenta asc ";
}
	$result = $db->Execute($sql);
?>
<table width="650" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="11"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE PROVEEDORES . Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <?

switch ($buscador_rapido)
{
	case "1"://mostrar sin modificar
	{ 
		?>
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>CUENTA</strong></font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>RAZON SOCIAL O APELLIDO</strong></font></div></td>
	<td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>CONTACTO</strong></font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>TELEFONO(1)</strong></font></div></td>
    <?




	break;
}


	case "2": //mostrar con modificar
	{
		?>
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>CUENTA</strong></font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>RAZON SOCIAL O APELLIDO</strong></font></div></td>
<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>CONTACTO</strong></font></div></td>
    <td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>TELEFONO(1)</strong></font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>MODIFICAR </strong></font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>ELIMINAR </strong></font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>FICHA </strong></font></div></td>
  </tr>
  <?


	break;
}	






}
 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cuenta=strtoupper($result->fields["cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$telefono=strtoupper($result->fields["telefono_1"]);
$contacto=strtoupper($result->fields["contacto"]);

					 



	if ($B == 1) {

?>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <?
$B = 0;
				}
	ELSE	{
	$B=1;
		 	
?>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <?

			}





switch ($buscador_rapido)
{
	case "2": //mostrar sin modificar
	{
		?>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cuenta");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$denominacion");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$contacto");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$telefono");?></font></div></td>
   <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="proveedores/modificar_proveedor.php?cuenta=<?print("$cuenta");?>"><IMG SRC="../../imagenes/office/027.ico" alt="Modificar" border = "0"></a></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="proveedores/borra.php?cuenta=<?print("$cuenta");?>"><IMG SRC="../../imagenes/office/1047.ico" alt="Eliminar" border = "0"></a></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="proveedores/ficha.php?cuenta=<?print("$cuenta");?>"><IMG SRC="../../imagenes/office/005.ico" alt="Ficha" border = "0"></a></font></div></td>
  </tr>
  <?



break;
}


case "1":
	  {
	?>
  <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cuenta");?></font></div></td>
      <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$denominacion");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$contacto");?></font></div></td>
	  <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$telefono");?></font></div></td>
  </tr>
  <?

	break;
	  }
	  }

$result->MoveNext();
	}

?>
</table>
