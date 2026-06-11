<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">

<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
$palabra=$_POST["busca"];
}


$hoy = date("d/m/y");

 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "conlogos");

$B = 1;


$sql="select * from clientes where cuenta like '%$palabra%' or estado like '%$palabra%' or denominacion like '%$palabra%' or domicilio like '%$palabra%' order by  cuenta asc ";

	$result = $db->Execute($sql);
?>
<table width="800" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="12"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE CLIENTES EXTERNOS . Emitido el <?echo $hoy;?></font></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
  
	  <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CUENTA</font></div></td>
    <td width="27%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">RAZON SOCIAL O APELLIDO</font></div></td>
    <td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TELEFONO</font></div></td>
	    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DOMICILIO</font></div></td>
		    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOCALIDAD</font></div></td>
			    <td width="8%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">C. POS</font></div></td>
				<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CUIT</font></div></td>
				   <td width="17%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">EMAIL</font></div></td>

    <?




 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cuenta=strtoupper($result->fields["cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$puerta=strtoupper($result->fields["puerta"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$localidad=strtoupper($result->fields["localidad"]);
$caracteristica_1=strtoupper($result->fields["caracteristica_1"]);
$telefono_1=strtoupper($result->fields["telefono_1"]);
$cod_postal=strtoupper($result->fields["cod_postal"]);
$cuit=strtoupper($result->fields["cuit"]);

$email=$result->fields["email"];


	if ($B == 1) {

?>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <?
$B = 0;
				}
	ELSE	{
	$B=1;
		 	
?>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <?

			}


if ($telefono_1 == 0){
$telefono_1 = "-";
}
    ?><td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$cuenta");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$denominacion");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <?echo $telefono_1;?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?echo $domicilio;?> - <?echo $puerta;?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"> <?echo $localidad;?></font></div></td>
       <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <?echo $cod_postal;?></font></div></td>
	       <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <?echo $cuit;?></font></div></td>
		       <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <?echo $email;?></font></div></td>

  </tr>
  <?




$result->MoveNext();
	}

?>
</table>
