<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

$B = 1;


$sql8="select * from proveedores where cuenta = $cod_proveedor";
$result8 = $db->Execute($sql8);
$denominacion=strtoupper($result8->fields["denominacion"]);





?>

<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 

<table width="113%" height="115" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#993300">
    <td colspan="7" bgcolor="#E1F2EF"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE EXISTENCIA. Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#993300">
    <td colspan="7" bgcolor="#E1F2EF"><hr noshade></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#993300">
    <td colspan="7" bgcolor="#E1F2EF"><div align="center"><strong><font face="Arial, Helvetica, sans-serif">PROVEEDOR: <?print("$cod_proveedor");?> - <?print("$denominacion");?></font></strong></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">


    <td width="11%" height="21"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="28%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>

<td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRESENTACION</font></div></td>
	<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALDO EXISTENTE </font></div></td>
<td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CANTIDAD A PEDIR </font></div></td>

  </tr>
   <tr>
      <td colspan="5" bgcolor="#E8DCFC"><hr noshade></td>
    </tr>
  <?



$anio_actual = date("y");
$mes_actual = date ("m");

$sql1="select * from mercaderia where proveedor = $cod_proveedor order by cod_merca";
$result1 = $db->Execute($sql1);


 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

$descripcion=strtoupper($result1->fields["descripcion"]);
$presentacion=strtoupper($result1->fields["presentacion"]);
$cod_mercaderia=strtoupper($result1->fields["cod_merca"]);



$sql="select sum(cantidad_ingresada - cantidad_salida) as saldo from existencias where cod_mercaderia like '$cod_mercaderia' ";
$result = $db->Execute($sql);


$saldo=strtoupper($result->fields["saldo"]);




?>

   
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cod_mercaderia");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="left"><font size="2"><?print("$descripcion");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$presentacion");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$saldo");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2">____________</font></div></td>

 
  </tr>
<?

$result1->MoveNext();
	}
  

?>
</table>
