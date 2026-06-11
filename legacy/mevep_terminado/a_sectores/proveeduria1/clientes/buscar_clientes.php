
<?

	if ($a == 1){
?><body background="../../imagenes/logito.png"><?
}
else
{
?><body background="../imagenes/logito.png"><?
}
?>


<?
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
$palabra=$_POST["busca"];
}


$hoy = date("d/m/y");

 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "lopez");

$B = 1;


 $sql="select * from clientes where cuenta like '%$palabra%' or estado like '%$palabra%' or denominacion like '%$palabra%' or domicilio like '%$palabra%' order by localidad, denominacion, cuenta asc ";

	$result = $db->Execute($sql);
?>
<table width="650" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="12"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE CLIENTES. Emitido el <?echo $hoy;?></font></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#666666">
    <?

switch ($buscador_rapido)
{
	case "1"://mostrar sin modificar
	{ 
		?>
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CUENTA</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">RAZON SOCIAL O APELLIDO</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ESTADO</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TELEFONO</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOCALIDAD</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FICHA</font></div></td>
    <?




	break;
}


	case "2": //mostrar con modificar
	{
		?>
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CUENTA</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">RAZON SOCIAL O APELLIDO</font></div></td>
    <td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ESTADO</font></div></td>
	<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
	<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CTA-CTE</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MODIFICAR </font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ELIMINAR </font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FICHA </font></div></td>
  </tr>
  <?


	break;
}	






}
 
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





switch ($buscador_rapido)
{
	case "2": //mostrar sin modificar
	{
		?>
    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$cuenta");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$denominacion");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$estad_o");?></font></div></td>

    

    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="consultas/ana_saldos/consultas.php?cuenta=<?print("$cuenta");?>&&denominacion=<?print("$denominacion");?>"><IMG SRC="../../imagenes/office/018.ico" alt="Modificar" border = "0"></a></font></div></td>
     <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="consultas/CTACTE/consultas.php?cuenta=<?print("$cuenta");?>&&denominacion=<?print("$denominacion");?>"><IMG SRC="../../imagenes/office/033.ico" alt="Modificar" border = "0"></a></font></div></td>
    
	<td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif">
	<a href="clientes/modificar.php?id=<?print("$cuenta");?>"><IMG SRC="../../imagenes/office/027.ico" alt="Modificar" border = "0"></a></font></div></td>
	    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="clientes/modificar.php?id=<?print("$cuenta");?>"><IMG SRC="../../imagenes/office/027.ico" alt="Modificar" border = "0"></a></font></div></td>
	
	
	<td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="clientes/ficha.php?id=<?print("$cuenta");?>"><IMG SRC="../../imagenes/office/005.ico" alt="Ficha" border = "0"></a></font></div></td>
  </tr>
  <?



break;
}


case "1":
	  {
	?>
  <td bgcolor="#A0A7F5"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$cuenta");?></font></div></td>
    <td bgcolor="#A0A7F5"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$denominacion");?></font></div></td>
    <td bgcolor="#A0A7F5"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$estad_o");?></font></div></td>
    <td bgcolor="#A0A7F5"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$telefono");?></font></div></td>
    <td bgcolor="#A0A7F5"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$localidad");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#A0A7F5"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="clientes/ficha.php?id=<?print("$id");?>"><IMG SRC="../imagenes/office/005.ico" alt="Ficha" border = "0"></a></font></div></td>
  </tr>
  <?

	break;
	  }
	  }

$result->MoveNext();
	}

?>
</table>
