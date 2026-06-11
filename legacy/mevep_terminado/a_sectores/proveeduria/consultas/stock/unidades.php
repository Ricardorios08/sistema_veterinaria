  <?
$anio_actual = date("y");
$mes_actual = date ("m");


  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {


	

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$fecha=strtoupper($result->fields["fecha"]);

$dia = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$anio = substr($fecha,0,4);
$fecha = $dia."-".$mes."-".$anio;

$nro_comprobante=strtoupper($result->fields["nro_comprobante"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$precio_unitario=strtoupper($result->fields["precio_unitario"]);
$cod_movimiento=strtoupper($result->fields["cod_movimiento"]);


$precio_renglon =  $precio_unitario * $cantidad;

SWITCH ($cod_movimiento){

case "1":{
$entrada = $cantidad;
$movimiento = "INVENTARIO INICIAL";
BREAK;
}

case "2":{
$entrada = $cantidad;
$movimiento = "COMPRAS";
BREAK;
}

case "3":{
$entrada = $cantidad;
$movimiento = "N/C DEVOLUCION";
BREAK;
}

case "4":{
$entrada = $cantidad;
$movimiento = "AJUSTE POSITIVO";
BREAK;
}

//***************************************
CASE "5":{
$salida = $cantidad;
$movimiento = "VENTAS";
BREAK;
}

CASE "6":{
$salida = $cantidad;
$movimiento = "N/D PROVEEDOR";
BREAK;
}

CASE "7":{
$salida = $cantidad;
$movimiento = "AJUSTE NEGATIVO";
BREAK;
}

CASE "8":{
$salida = $cantidad;
$movimiento = "LOTE VENCIDO";
BREAK;
}

CASE "9":{
$salida = $cantidad;
$movimiento = "MERMAS Y ROTURAS";
BREAK;
}
}


 $saldo = $entrada - $salida;
$acumula_saldo = $acumula_saldo + $saldo;


$suma_ingresada = $suma_ingresada + $entrada;
$suma_salida = $suma_salida + $salida;


if ($B == 1) {

?>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <?

			}




?>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$fecha");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$movimiento");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$tipo_fact");?> - <?print("$nro_comprobante");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?echo $entrada;?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?echo $salida;?> </font></div></td>
	<td bgcolor="#E8DCFC"><div align="center"><font size="2"> <?echo $acumula_saldo;?></font></div></td>
</tr>
 
<?
	 $entrada = "";
	$salida = "";
	$saldo = "";
$result->MoveNext();
	}
  

?>

 <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <td colspan="3" bgcolor="#E6E6E6"><hr noshade></td>
    <td colspan="3" bgcolor="#E6E6E6"><hr noshade></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <td colspan="3" bgcolor="#E8DCFC"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">TOTALES</font></strong></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong><?echo $suma_ingresada;?></strong></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong><?echo $suma_salida;?></strong></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong><?echo $acumula_saldo;?></strong></font></div></td>
  </tr>
</table>
