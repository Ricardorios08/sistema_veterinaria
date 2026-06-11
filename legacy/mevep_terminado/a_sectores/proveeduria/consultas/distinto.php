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








?>
<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 
<table width="130%" height="131" border="0">
  <!--DWLayoutTable-->
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td height="21" colspan="2"><div align="center"><strong>ABM PROVEEDURIA </strong></div></td>
    <td colspan="7" valign="top"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE ERRORES. Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr valign="top" bordercolor="#FFFFFF" bgcolor="#000099">
    <td height="32" colspan="9" valign="top" bgcolor="#FFFFFF"><hr noshade></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">
    <td height="23" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">EXISTENCIAS</font></div></td>
    <td colspan="3" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">STOCK</font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">


    <td width="95" height="23" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="442" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>
<td width="112" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">LOTE</font></div></td>
    <td width="50" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">ENTRADAS</font></div></td>
<td width="51" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">SALIDAS</font></div></td>
<td width="53" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
<td width="58" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">DEBE </font></div></td>

  <td width="58" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">HABER </font></div></td>
  <td width="48" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td height="22" colspan="9" valign="top"><hr noshade></td>
  </tr>
  <?



$anio_actual = date("y");
$mes_actual = date ("m");

$hoy = date ("Y-m-d");
$hoy = "2009-09-01";

// $sql1="select * from existencias where fecha_ultimo_mov = '$hoy' order by cod_mercaderia";
  $sql1="select * from existencias group by cod_mercaderia  order by cod_mercaderia";
$result1 = $db->Execute($sql1);
 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {


$cod_mercaderia=strtoupper($result1->fields["cod_mercaderia"]);


$sql5="select sum(cantidad_ingresada) as cantidad_ingresada from existencias where cod_mercaderia like '$cod_mercaderia'";
$result5 = $db->Execute($sql5);
$cantidad_ingresada=strtoupper($result5->fields["cantidad_ingresada"]);

$sql5="select sum(cantidad_salida) as cantidad_salida from existencias where cod_mercaderia like '$cod_mercaderia'";
$result5 = $db->Execute($sql5);
$cantidad_salida=strtoupper($result5->fields["cantidad_salida"]);




$sql5="select sum(cantidad) as inventario from stock where cod_mercaderia like '$cod_mercaderia' and  cod_movimiento = 1";
$result5 = $db->Execute($sql5);
$inventario=strtoupper($result5->fields["inventario"]);

 $sql5="select sum(cantidad) as compras from stock where cod_mercaderia like '$cod_mercaderia'  and cod_movimiento = 2";
$result5 = $db->Execute($sql5);
$compras=strtoupper($result5->fields["compras"]);

$sql5="select sum(cantidad) as nc from stock where cod_mercaderia like '$cod_mercaderia'  and cod_movimiento = 3";
$result5 = $db->Execute($sql5);
$nc=strtoupper($result5->fields["nc"]);

$sql5="select sum(cantidad) as ajp from stock where cod_mercaderia like '$cod_mercaderia'  and cod_movimiento = 4";
$result5 = $db->Execute($sql5);
$ajp=strtoupper($result5->fields["ajp"]);

$sql5="select sum(cantidad) as ventas from stock where cod_mercaderia like '$cod_mercaderia'  and cod_movimiento = 5";
$result5 = $db->Execute($sql5);
$ventas=strtoupper($result5->fields["ventas"]);

$sql5="select sum(cantidad) as ajn from stock where cod_mercaderia like '$cod_mercaderia'  and cod_movimiento = 7";
$result5 = $db->Execute($sql5);
$ajn=strtoupper($result5->fields["ajn"]);


$saldo_stock_d = $inventario + $compras + $nc + $ajp;
$saldo_stock_h = $ventas + $ajn;

if ($saldo_stock_d >  $saldo_stock_h){
$saldo_stock = $saldo_stock_d - $saldo_stock_h;}
elseif ($saldo_stock_d <  $saldo_stock_h){
$saldo_stock = $saldo_stock_h - $saldo_stock_d;}
elseif ($saldo_stock_d ==  $saldo_stock_h){
$saldo_stock = $saldo_stock_h - $saldo_stock_d;}

$sql="select * from mercaderia where cod_merca like '$cod_mercaderia' ";
$result = $db->Execute($sql);
$descripcion=strtoupper($result->fields["descripcion"]);
$presentacion=strtoupper($result->fields["presentacion"]);


//$vto_lote = $mes_lote." - ".$anio_lote;



$cantidad_existente = $cantidad_ingresada - $cantidad_salida;
	
$mes = $mes_lote;
$anio = $anio_lote;

if ($anio == ""){
	$anio = $anio_actual;
}
else
		  {
$estado = "-";
		  }



if (($anio != "00") && ($mes != "00") or ($anio != "00") or ($mes != "00") ){

if ($anio < $anio_actual){
$estado = "VENCIDO";
}
else{

if ($anio > $anio_actual){
$estado = "-";}
else{

if ($mes < $mes_actual){
$estado = "VENCIDO";
}
else{
	$estado ="-";
}
}
}
}







IF ($cantidad_existente != $saldo_stock){
?>
    <tr bgcolor="#FFFFFF"><td><div align="center"><font size="2"><?print("$cod_mercaderia");?></font></div></td>
    <td><div align="left"><font size="2"><?print("$descripcion");?> <?print("$fecha_ultimo_mov");?></font></div></td>
    <td><div align="left"><font size="2"><?print("$lote1");?></font></div></td>
<td><div align="center"><font size="2"><?print("$cantidad_ingresada");?></font></div></td>
	  <td><div align="center"><font size="2"><?print("$cantidad_salida");?></font></div></td>
	<td><div align="center"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><strong><?print("$cantidad_existente");?></strong></font></div></td>
	<td><div align="center"><font size="2"><?print("$saldo_stock_d");?> </font></div></td>

 
  <td><div align="center"><font size="2"><?print("$saldo_stock_h");?></font></div></td>
  <td><div align="center"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><strong><?print("$saldo_stock");?></strong></font></div></td>

  </tr>
<?


}

$result1->MoveNext();

	$saldo_stock = "";
	}
  

?>
</table>
