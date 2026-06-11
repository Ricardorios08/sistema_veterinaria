<?php
global $buscador_rapido;



$hoy = date("d/m/Y");
 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");







 $sql="select * from stock where cod_mercaderia order by cod_mercaderia";
 $result = $db->Execute($sql);




?>
<table width="103%" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td colspan="12"><div align="right"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>FICHA STOCK</strong> <?echo $hoy;?> </font></div></td>
  </tr>
  
  <tr bordercolor="#FFFFFF" bgcolor="#000099">
<td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"></font></div></td>
	<td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MOVIMIENTO</font></div></td>

<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">COMPROBANTE</font></div></td>

<?if ($opcion == "valor"){?>
<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CANTIDAD</font></div></td>
<?}?>


	<td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ENTRADA</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALIDA</font></div></td>
</tr>

  <?



$anio_actual = date("y");
$mes_actual = date ("m");



  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {


$cod_merquita = $cod_mercaderia;
$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);

$sql1="select * from mercaderia where cod_merca = $cod_mercaderia";
$result1 = $db->Execute($sql1);
$descripcion=strtoupper($result1->fields["descripcion"]);


$fecha=strtoupper($result->fields["fecha"]);
$nro_comprobante=strtoupper($result->fields["nro_comprobante"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$precio_unitario=strtoupper($result->fields["precio_unitario"]);
$cod_movimiento=strtoupper($result->fields["cod_movimiento"]);


$precio_renglon =  $precio_unitario * $cantidad;

if ($cod_merquita != $cod_mercaderia){
$sql2="select SUM(precio_unitario * cantidad) as saldo_entrada from stock where cod_mercaderia = '$cod_mercaderia' and cod_movimiento = 'INGRESOS' order by cod_mercaderia";
 $result2 = $db->Execute($sql2);
$saldo_entrada=strtoupper($result2->fields["saldo_entrada"]);

$sql2="select SUM(precio_unitario * cantidad) as saldo_salida from stock where cod_mercaderia = '$cod_mercaderia' and cod_movimiento = 'EGRESOS' order by cod_mercaderia";
 $result2 = $db->Execute($sql2);
$saldo_salida=strtoupper($result2->fields["saldo_salida"]);
}


SWITCH ($cod_movimiento){

case "1":{
$entrada = $precio_renglon;
$movimiento = "INVENTARIO INICIAL";
BREAK;
}

case "2":{
$entrada = $precio_renglon;
$movimiento = "COMPRAS";
BREAK;
}

case "3":{
$entrada = $precio_renglon;
$movimiento = "N/C DEVOLUCION";
BREAK;
}

case "4":{
$entrada = $precio_renglon;
$movimiento = "AJUSTE POSITIVO";
BREAK;
}

//***************************************
CASE "5":{
$salida = $precio_renglon;
$movimiento = "VENTAS";
BREAK;
}

CASE "6":{
$salida = $precio_renglon;
$movimiento = "N/D PROVEEDOR";
BREAK;
}

CASE "7":{
$salida = $precio_renglon;
$movimiento = "AJUSTE NEGATIVO";
BREAK;
}

CASE "8":{
$salida = $precio_renglon;
$movimiento = "LOTE VENCIDO";
BREAK;
}

CASE "9":{
$salida = $precio_renglon;
$movimiento = "MERMAS Y ROTURAS";
BREAK;
}
}


$saldo1 = $saldo_entrada - $saldo_salida;
 $saldo = $entrada - $salida;
$acumula_saldo = $acumula_saldo + $saldo;




if ($cod_mercaderia != $cod_merquita){?>
<tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="7"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?print("$cod_mercaderia");?> - <?print("$descripcion");?> (SALDO $<?echo number_format($saldo1,2);?>) </font></strong></font></td>
  </tr>
<?}?>

<td bgcolor="#E8DCFC"><div align="center"><font size="2"></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$fecha");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$movimiento");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$nro_comprobante");?></font></div></td>
	<!-- <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?echo $cantidad;?></font></div></td> -->

<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?echo number_format($entrada,2);?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?echo number_format($salida,2);?></font></div></td>

	<!-- <td bgcolor="#E8DCFC"><div align="center"><font size="2"> <?echo number_format($acumula_saldo,2);?></font></div></td> -->
</tr>
  
<?
	 $entrada = "";
	$salida = "";
	$saldo = "";
$result->MoveNext();
	}
  

?>
</table>
