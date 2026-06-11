<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
$palabra=$_POST["busca"];
}


$hoy = date("d/m/y");

 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

$B = 1;


$sql="select * from clientes where cuenta like '%$palabra%' or estado like '%$palabra%' or denominacion like '%$palabra%' or domicilio like '%$palabra%' and cuenta < 5000 order by cuenta ,localidad, denominacion asc ";

	$result = $db->Execute($sql);
?>
<table width="103%" height="153" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td height="25" colspan="12"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE CLIENTES EXTERNOS MENORES DE 5000. Emitido el <?echo $hoy;?></font></font></div></td>
  </tr>
  
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CUENTA</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">RAZON SOCIAL O APELLIDO</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ESTADO</font></div></td>
	    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TELEFONO</font></div></td>
		    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOCALIDAD</font></div></td>
			   </tr> 

	<?
 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cuenta=strtoupper($result->fields["cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$estado=strtoupper($result->fields["estado"]);
$telefono=strtoupper($result->fields["telefono"]);
$localidad=strtoupper($result->fields["localidad"]);

switch ($estado)
						  {
	case "1": //activo
					{
$estad_o="ACTIVO";
				  }
		break;

			case "0": //activo
					{
$estad_o="ACTIVO";
				  }
		break;


	case "2": //suspendido
		  {
$estad_o="SUSPENDIDO";
		  }
break;

	case "3": //baja
		  {
$estad_o="BAJA";
		  }
break;

	case "4": //baja
		  {
$estad_o="BLOQUEADO";
		  }
break;
						  }



?>

<tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$cuenta");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$denominacion");?></font></div></td>
     <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$estad_o");?></font></div></td>
	      <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$telefono");?></font></div></td>
		       <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$localidad");?></font></div></td>


</tr>

<?

$result->MoveNext();
	}

?>


</table>
