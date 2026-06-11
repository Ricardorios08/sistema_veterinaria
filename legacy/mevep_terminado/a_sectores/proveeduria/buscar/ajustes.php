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


$palabra=$_POST["busca"];


$sql="select * from stock where cod_movimiento = 7 ";




$result = $db->Execute($sql);




?>
<table width="103%" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td colspan="13"><div align="right"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>FICHA STOCK</strong> <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="9"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?print("$palabra");?> - <?print("$descripcion");?></font></strong></font></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">

	<td width="8%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA</font></div></td>
    <td colspan="2"><div align="center"></div>      <div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MERCADERA</font></div></td>
    <td width="26%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MOVIMIENTO</font></div></td>

<td width="14%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">COMPROBANTE</font></div></td>


    <td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CANTIDAD</font></div></td>

</tr>

  <?



$anio_actual = date("y");
$mes_actual = date ("m");


  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {


	

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);

$sql1="select * from mercaderia where cod_merca = $cod_mercaderia";
$result1 = $db->Execute($sql1);
$descripcion=strtoupper($result1->fields["descripcion"]);


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



if ($B == 1) {

?>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <?

			}




?>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$fecha");?></font></div></td>
    <td width="9%" bgcolor="#E8DCFC"><div align="right"><font size="2"><?print("$cod_mercaderia");?></font></div></td>
    <td width="34%" bgcolor="#E8DCFC"><font size="2"><?print("$descripcion");?></font></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$movimiento");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$tipo_fact");?> - <?print("$nro_comprobante");?></font></div></td>
	


<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?echo $salida;?></font></div></td>


</tr>
  
<?
	 $entrada = "";
	$salida = "";
	$saldo = "";
$result->MoveNext();
	}
  

?>
</table>

