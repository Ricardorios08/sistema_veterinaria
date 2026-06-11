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


$sql="select * from condiciones_clientes where (iva = '') or  (iva = 0) or  (iva = 2) or  (iva = 5)  order by cuenta, iva ";

	$result = $db->Execute($sql);
?>
<table width="103%" height="153" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td height="25" colspan="12"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE CLIENTES EXTERNOS QUE NO TIENEN CARGADO EL TIPO DE IVA EN LA BASE DE DATOS. Emitido el <?echo $hoy;?></font></font></div></td>
  </tr>
  
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CUENTA</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">RAZON SOCIAL O APELLIDO</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TIPO IVA</font></div></td>
	     <td width="20%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CUIT</font></div></td>

	<?
 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cuenta=strtoupper($result->fields["cuenta"]);
$iva=strtoupper($result->fields["iva"]);

$sql1="select * from clientes where cuenta = '$cuenta' ";
$result1 = $db->Execute($sql1);

$denominacion=strtoupper($result1->fields["denominacion"]);
$estado=strtoupper($result1->fields["estado"]);
$telefono=strtoupper($result1->fields["telefono"]);
$localidad=strtoupper($result1->fields["localidad"]);
$cuit=strtoupper($result1->fields["cuit"]);
switch ($iva)
						  {
	case "0":{$tipo_iva="REVISAR";}break;
	case "1":{$tipo_iva="RI";}break;
	case "2":{$tipo_iva="RESP. NO INSCRIPTO";}break;
	case "3":{$tipo_iva="MONOTRIBUTO";}break;
	case "4":{$tipo_iva="EXENTO";}break;
	case "5":{$tipo_iva="CONSUMIDOR FINAL";}break;

	}



?>

<tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$cuenta");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$denominacion");?></font></div></td>
     <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$tipo_iva");?></font></div></td>

     <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$cuit");?></font></div></td>

</tr>

<?

$result->MoveNext();
	}

?>


</table>


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


$sql="select * from condiciones_clientes where (iva = '1') or  (iva = 3) or  (iva = 4)  order by cuenta, iva ";

	$result = $db->Execute($sql);
?>
<table width="103%" height="153" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td height="25" colspan="12"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE CLIENTES EXTERNOS. Emitido el <?echo $hoy;?></font></font></div></td>
  </tr>
  
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CUENTA</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">RAZON SOCIAL O APELLIDO</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TIPO IVA</font></div></td>
	    <td width="20%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CUIT</font></div></td>
	 

	<?
 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cuenta=strtoupper($result->fields["cuenta"]);
$iva=strtoupper($result->fields["iva"]);

$sql1="select * from clientes where cuenta = '$cuenta' ";
$result1 = $db->Execute($sql1);

$denominacion=strtoupper($result1->fields["denominacion"]);
$estado=strtoupper($result1->fields["estado"]);
$telefono=strtoupper($result1->fields["telefono"]);
$localidad=strtoupper($result1->fields["localidad"]);
$cuit=strtoupper($result1->fields["cuit"]);

switch ($iva)
						  {
	case "0":{$tipo_iva="REVISAR";}break;
	case "1":{$tipo_iva="RI";}break;
	case "2":{$tipo_iva="RESP. NO INSCRIPTO";}break;
	case "3":{$tipo_iva="MONOTRIBUTO";}break;
	case "4":{$tipo_iva="EXENTO";}break;
	case "5":{$tipo_iva="CONSUMIDOR FINAL";}break;

	}



?>

<tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$cuenta");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$denominacion");?></font></div></td>
     <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$tipo_iva");?></font></div></td>
	     <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$cuit");?></font></div></td>



</tr>

<?

$result->MoveNext();
	}

?>


</table>
