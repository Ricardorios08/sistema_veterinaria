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

if ($palabra == ""){
include ("stock_todo.php");
exit;
}
else{

$sql="select * from mercaderia where cod_merca like '$palabra' ";
	$result = $db->Execute($sql);
?>
<table width="800" height="191" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td height="40" colspan="12
	"><div align="center"><font size="3" face="Arial, Helvetica, sans-serif">Asociaci&oacute;n Bioqu&iacute;mica de Mendoza. </font><font color="#000000" face="Arial, Helvetica, sans-serif"> Emitido el <?echo $hoy;?></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td height="28" colspan="12
	"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif"> EXISTENCIA - EJERCICIO 2009</font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">



    <td width="9%" height="21"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="35%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>

<td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRESENTACION</font></div></td>
	<td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOTE</font></div></td>
    <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">VTO LOTE</font></div></td>
<td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ENTRADAS</font></div></td>
<td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALIDAS</font></div></td>
<td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
<td width="8%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ESTADO</font></div></td>
<td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ULT-MOV</font></div></td>

  </tr>
<?



$anio_actual = date("y");
$mes_actual = date ("m");


 
$cod_merca=strtoupper($result->fields["cod_merca"]);

$sql1="select * from existencias_31082010 where cod_mercaderia = $cod_merca";
$result1 = $db->Execute($sql1);



  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {


$cod_merquita=strtoupper($result1->fields["cod_mercaderia"]);



if ($cod_merquita == ""){

$result1->MoveNext();
}
else
	  {

$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);


$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
$lote=strtoupper($result1->fields["lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$fecha_ultimo_mov=strtoupper($result1->fields["fecha_ultimo_mov"]);

$vto_lote = $mes_lote." - ".$anio_lote;

$nombre=strtoupper($result->fields["nombre"]);
$presentacion=strtoupper($result->fields["presentacion"]);
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


$suma_ingresada = $suma_ingresada + $cantidad_ingresada;
$suma_salida = $suma_salida + $cantidad_salida;
$suma_existente = $suma_existente + $cantidad_existente;


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








if ($B == 1) {

?>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <?

			}




		?>
    <td bgcolor="#E1F2EF"><div align="center"><font size="2"><?print("$cod_merca");?></font></div></td>
    <td bgcolor="#E1F2EF"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$nombre");?></font></div></td>
    <td bgcolor="#E1F2EF"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$presentacion");?></font></div></td>
<td bgcolor="#E1F2EF"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$lote");?></font></div></td>
<td bgcolor="#E1F2EF"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$vto_lote");?></font></div></td>

	<td bgcolor="#E1F2EF"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cantidad_ingresada");?></font></div></td>
		<td bgcolor="#E1F2EF"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cantidad_salida");?></font></div></td>
	<td bgcolor="#E1F2EF"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cantidad_existente");?></font></div></td>
<td bgcolor="#E1F2EF"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$estado");?></font></div></td>
<td bgcolor="#E1F2EF"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$fecha_ultimo_mov");?></font></div></td>

 
  </tr>
  

 <?

$result1->MoveNext();
	}
  }

?>

<tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <td colspan="5" bgcolor="#E6E6E6">&nbsp;</td>
    <td colspan="3" bgcolor="#E6E6E6"><hr noshade></td>
    <td colspan="2" bgcolor="#E6E6E6">&nbsp;</td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <td height="23" colspan="5" bgcolor="#E8DCFC"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">TOTALES</font></strong></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?print("$suma_ingresada");?></font></strong></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?print("$suma_salida");?></font></strong></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?print("$suma_existente");?></font></strong></font></div></td>
    <td colspan="2" bgcolor="#E8DCFC">&nbsp;</td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <td colspan="10" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>

</table>

<?


$suma_ingresada = "";
$suma_salida = "";
$suma_existente = "";


$sql="select * from stock_31082010 where cod_mercaderia like '$palabra' order by fecha, tipo_fact, nro_comprobante";
}



$result = $db->Execute($sql);

$sql1="select * from mercaderia where cod_merca = $palabra";
$result1 = $db->Execute($sql1);
$descripcion=strtoupper($result1->fields["descripcion"]);


?>
<table width="800" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="10"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">FICHA STOCK  </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="6"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?print("$palabra");?> - <?print("$descripcion");?></font></strong></font></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">

	<td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MOVIMIENTO</font></div></td>

<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">COMPROBANTE</font></div></td>


<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ENTRADA</font></div></td>



	<td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALIDA</font></div></td>
    <td width="12%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
</tr>

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
  <tr bordercolor="#FFFFCC" bgcolor="#E1F2EF">
    <?

			}




?>
    <td><div align="center"><font size="2"><?print("$fecha");?></font></div></td>
    <td><div align="center"><font size="2"><?print("$movimiento");?></font></div></td>
    <td><div align="center"><font size="2"><?print("$tipo_fact");?> - <?print("$nro_comprobante");?></font></div></td>
<td><div align="center"><font size="2"><?echo $entrada;?></font></div></td>
<td><div align="center"><font size="2"><?echo $salida;?> </font></div></td>
	<td><div align="center"><font size="2"> <?echo $acumula_saldo;?></font></div></td>
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
