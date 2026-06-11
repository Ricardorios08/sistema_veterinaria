<?php
global $buscador_rapido;
include("../../../../conexiones/config_grabacion.php");
if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
$B = 1;

$palabra=$_POST["busca"];

if ($dia_desde == ""){
$dia_desde = 0000-00-00;
}
if ($dia_hasta == ""){
$dia_hasta = date("Y-m-d");
}


$sql = "SELECT SUM(importe) as facturas FROM `resumen_cta_vta` WHERE cuenta = '$palabra'  AND ((cod_movimiento = 1) or (cod_movimiento = 2)) AND fecha < '$dia_desde'";
$result = $db_pro->Execute($sql);
$facturas=strtoupper($result->fields["facturas"]);

$sql = "SELECT SUM(importe) as restar FROM `resumen_cta_vta` WHERE cuenta ='$palabra'  AND ((cod_movimiento = 3) or (cod_movimiento = 4) or (cod_movimiento = 5)) AND fecha < '$dia_desde'";
$result = $db_pro->Execute($sql);
$restar=strtoupper($result->fields["restar"]);

$saldo_inicial = $facturas - $restar;
$acumula_saldo = $saldo_inicial;

$sql3="select * from clientes where cuenta like '$palabra'";
$result3 = $db_pro->Execute($sql3);
$denominacion=strtoupper($result3->fields["denominacion"]);

 $sql="select * from resumen_cta_vta where cuenta like '$palabra'  and fecha BETWEEN '$dia_desde' and '$dia_hasta' order by $ordenar";
$result = $db_pro->Execute($sql);

$tipo_cuenta=strtoupper($result->fields["tipo_cuenta"]);


 






?>
<table width="650" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td colspan="12"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong> </strong>Desde el: <?echo $dia_desde1;?> Hasta el: <?echo $dia_hasta1;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>CUENTA CORRIENTE VENTAS</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="12"><div align="right"><font color="#000000" face="Arial, Helvetica, sans-serif">Impreso el: <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="8"><div align="center"><font color="#0000FF" size="4" face="Arial, Helvetica, sans-serif"><strong><?print("$palabra");?> - <?print("$denominacion");?></strong></font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">

	<td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA</font></div></td>
    <td width="25%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MOVIMIENTO</font></div></td>

    <td width="8%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TIPO</font></div></td>
    <td width="13%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">COMPROBANTE</font></div></td>


	<td width="16%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DEBITOS</font></div></td>
    <td width="13%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CREDITOS</font></div></td>
<td width="14%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
</tr>
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="6"><div align="right"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">TRANSPORTE</font></div></td>
    <td><div align="right"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?echo number_format($saldo_inicial,2);?></font></div></td>
  </tr>

  <?



$anio_actual = date("y");
$mes_actual = date ("m");



  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


	


$fecha=strtoupper($result->fields["fecha"]);
$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio = substr($fecha,0,4);
$fecha = $dia."-".$mes."-".$anio;
$nro_comprobante=strtoupper($result->fields["comprobante"]);
$precio=strtoupper($result->fields["importe"]);
$cod_movimiento=strtoupper($result->fields["cod_movimiento"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$afectacion=strtoupper($result->fields["afectacion"]);

$precio_renglon =  $precio;

SWITCH ($cod_movimiento){

case "1":{
$entrada = $precio_renglon;
$movimiento = "FACTURA";
BREAK;
}

case "2":{
$entrada = $precio_renglon;
$movimiento = "NOTA DE DEBITO";
BREAK;
}

case "3":{
$salida = $precio_renglon;
$movimiento = "N/C (Afec. ".$afectacion.")";
BREAK;
}

case "4":{
$salida = $precio_renglon;
$movimiento = "PAGO POR CAJA (Afec. ".$afectacion.")";
BREAK;
}


CASE "5":{
$salida = $precio_renglon;
$movimiento = "DESC X LIQUIDACION";
BREAK;
}


}

$suma_entrada = $suma_entrada + $entrada;
	$suma_salida = 	$suma_salida + $salida;

/*if ($tipo_fact == 0){
$tipo_fact = 'X';
}
*/


$saldo = $entrada - $salida;
$acumula_saldo = $acumula_saldo + $saldo;
if ($entrada == 0.00){
$entrada = "-";
}else{
$entrada = number_format($entrada,2);
}


if ($salida== 0.00){
$salida = "-";
}else{
$salida= number_format($salida,2);
}

//1 FACTURA  - DEBE
// 2 NOTA DE DEBITO - DEBE 
// 3 NOTA DE CREDITO- HABER
// 4 PAGO POR CAJA - HABER
// 5 DESCUENTO POR LIQUIDACION - HABER






	if ($B == 1) {

?><tr bordercolor="#FFFFCC" bgcolor="#E6E6E6"> <?

			}





		?>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$fecha");?></font></div></td>
    <td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$movimiento");?></font></div></td>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$tipo_fact");?></font></div></td>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$nro_comprobante");?></font></div></td>
	<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $entrada;?></font></div></td>
<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $salida;?></font></div></td>

	<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"> <?echo number_format($acumula_saldo,2);?></font></div></td>
</tr>
  
 
  
<?
	 $entrada = "";
	$salida = "";
	$saldo = "";
$result->MoveNext();
	}
  
  ?>

  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
    <td colspan="4"><div align="right"><strong><font size="4" face="Arial, Helvetica, sans-serif">TOTALES</font></strong></div></td>
    <td><div align="right"><font size="2"><?echo number_format($suma_entrada,2);?></font></div></td>
    <td><div align="right"><font size="2"><?echo number_format($suma_salida,2);?></font></div></td>
    <td><div align="right"><strong><font size="4" face="Arial, Helvetica, sans-serif"> <?echo number_format($acumula_saldo,2);?></font></strong></div></td>
  </tr>

</table>
