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


if ($busca == ""){
$sql="select * from encabezado_compra";
}else{
$sql="select * from encabezado_compra where nro_factura like '$busca%' or nro_proveedor like '$busca%' or denominacion like '%$busca%' order by fecha desc, nro_factura";
}



	$result = $db->Execute($sql);
?>
<table width="135%" height="153" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td height="25" colspan="12"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE FACTURAS DE COMPRAS. Emitido el <?php echo $hoy;?></font></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <?php 

switch ($buscador_rapido)
{
	case "1"://mostrar sin modificar
	{ 
		?>
    <td width="7%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">Nº FACTURA</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PROVEEDOR</font></div></td>
    <td width="4%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FEC COMP.</font></div></td>
	    <td width="3%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DESC.</font></div></td>
		    <td width="4%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">BONIF.</font></div></td>
			<td width="4%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SUBTOTAL</font></div></td>
			<td width="4%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">IVA</font></div></td>
			<td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TOTAL</font></div></td>
		    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DETALLE</font></div></td>
    <?php 




	break;
}


	case "2": //mostrar con modificar
	{
		?>
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">Nº FACTURA</font></div></td>
    <td width="13%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PROVEEDOR</font></div></td>
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FEC COMPRA</font></div></td>
	    <td width="2%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DESC.</font></div></td>
		    <td width="3%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">BONIF.</font></div></td>
			<td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SUBTOTAL</font></div></td>
			<td width="3%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">IVA</font></div></td>
			<td width="3%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TOTAL</font></div></td>
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MODIFICAR </font></div></td>
    <td width="4%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ELIMINAR </font></div></td>
    <td width="3%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DETALLE</font></div></td>
  </tr>
  <?php 


	break;
}	






}
 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$nro_factura=strtoupper($result->fields["nro_factura"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$nro_proveedor=strtoupper($result->fields["nro_proveedor"]);
$fecha=strtoupper($result->fields["fecha"]);
$bonificacion=strtoupper($result->fields["bonificacion"]);
$descuento=strtoupper($result->fields["descuento"]);
$subtotal=strtoupper($result->fields["subtotal"]);
$iva=strtoupper($result->fields["iva"]);
$total=strtoupper($result->fields["total"]);






	if ($B == 1) {

?>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <?php 
$B = 0;
				}
	ELSE	{
	$B=1;
		 	
?>
  <tr bordercolor="#FFFFFF" bgcolor="#00FFFF">
    <?php 

			}





switch ($buscador_rapido)
{
	case "2": //mostrar sin modificar
	{
		?>
  <td bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$nro_factura");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$denominacion");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$fecha");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$descuento");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$bonificacion");?></font></div></td>
	<td bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$subtotal");?></font></div></td>
	<td bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$iva");?></font></div></td>
	<td bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$total");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="clientes/modificar.php?id=<?php print("$cuenta");?>"><IMG SRC="../../imagenes/office/027.ico" alt="Modificar" border = "0"></a></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="clientes/borra.php?id=<?php print("$cuenta");?>"><IMG SRC="../../imagenes/office/1047.ico" alt="Eliminar" border = "0"></a></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="clientes/ficha.php?id=<?php print("$cuenta");?>"><IMG SRC="../../imagenes/office/005.ico" alt="Ficha" border = "0"></a></font></div></td>
  </tr>
  <?php 



break;
}


case "1":
	  {
	?>
  <td bgcolor="#FFFFFF"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$nro_factura");?></font></div></td>
    <td bgcolor="#FFFFFF"><div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$denominacion");?></font></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$fecha");?></font></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$descuento");?></font></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$bonificacion");?></font></div></td>
	<td bgcolor="#FFFFFF"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$subtotal");?></font></div></td>
	<td bgcolor="#FFFFFF"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$iva");?></font></div></td>
	<td bgcolor="#FFFFFF"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?php print("$total");?></font></div></td>


    <td bordercolor="#E8DCFC" bgcolor="#FFFFFF"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="clientes/ficha.php?id=<?php print("$id");?>"><IMG SRC="../imagenes/office/005.ico" alt="Ficha" border = "0"></a></font></div></td>
  </tr>
  <?php 

	break;
	  }
	  }

$result->MoveNext();
	}

?>
</table>
