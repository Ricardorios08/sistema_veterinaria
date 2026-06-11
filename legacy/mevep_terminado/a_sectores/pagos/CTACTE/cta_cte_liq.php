<?php
global $buscador_rapido;
include("../../../../conexiones/config_grabacion.php");
if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

$B = 1;


$palabra=$_POST["busca"];

if ($dia_desde == ""){
$dia_desde = 0000-00-00;
}
if ($dia_hasta == ""){
$dia_hasta = date("Y-m-d");
}


$sql = "SELECT SUM(importe) as facturas FROM `resumen_cta_vta` WHERE cuenta = '$palabra' and tipo_cuenta = $tipo AND ((cod_movimiento = 1) or (cod_movimiento = 2)) AND fecha < '$dia_desde'";
$result = $db_pro->Execute($sql);
//$facturas=strtoupper($result->fields["facturas"]);

$sql = "SELECT SUM(importe) as restar FROM `resumen_cta_vta` WHERE cuenta ='$palabra' and tipo_cuenta = $tipo AND ((cod_movimiento = 3) or (cod_movimiento = 4) or (cod_movimiento = 5)) AND fecha < '$dia_desde'";
//$result = $db_pro->Execute($sql);
$restar=strtoupper($result->fields["restar"]);

$saldo_inicial = $facturas - $restar;
$acumula_saldo = $saldo_inicial;


 $sql="select * from resumen_cta_vta where cuenta like '$palabra' and tipo_cuenta = $tipo and fecha BETWEEN '$dia_desde' and '$dia_hasta' and cod_movimiento = 5 order by $ordenar";



 $sql = "SELECT *  FROM `resumen_cta_vta`  WHERE cod_movimiento = 5 AND fecha BETWEEN '$dia_desde' AND '$dia_hasta' ORDER BY fecha, cuenta "; 

$result = $db_pro->Execute($sql);





?>
<table width="103%" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td colspan="15"><div align="center"><strong>CONSULTAS VALIDAS A PARTIR DE JULIO 2010 EN ADELANTE </strong></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td colspan="15"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong> </strong>Desde el: <?echo $dia_desde1;?> Hasta el: <?echo $dia_hasta1;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>LIQUIDACIONES DESCONTADAS </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Impreso el: <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="11"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?print("$palabra");?> - <?print("$denominacion");?></font></strong></font></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">

	<td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA</font></div></td>
    <td width="18%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MOVIMIENTO</font></div></td>

    <td width="3%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TIPO</font></div></td>
    <td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">COMPROBANTE</font></div></td>
	<td width="21%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DENOMINACION</font></div></td>
    <td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">IMP. PROV</font></div></td>
<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ACUMULADO</font></div></td>
<td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LIQUIDADO</font></div></td>
<td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DEUDA</font></div></td>
  <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">V</font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="6"><div align="right"><font color="#FF8000" size="1" face="Arial, Helvetica, sans-serif">TRANSPORTE</font></div></td>
    <td><div align="right"><font color="#FF8000" size="2" face="Arial, Helvetica, sans-serif"><?echo number_format($saldo_inicial,2);?></font></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <?



$anio_actual = date("y");
$mes_actual = date ("m");



  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


	
$tipo_cuenta=strtoupper($result->fields["tipo_cuenta"]);
$palabra=strtoupper($result->fields["cuenta"]);
if ($tipo_cuenta == '2'){

 
$sql3="select * from clientes where cuenta like '$palabra'";
$result3 = $db_pro->Execute($sql3);
$denominacion=strtoupper($result3->fields["denominacion"]);


}elseif ($tipo_cuenta == "1"){
	

 $sql4="select * from datos_laboratorio where nro_laboratorio like '$palabra'";
$result4=$db_bq->Execute($sql4);

 $denominacion=strtoupper($result4->fields["nombre_laboratorio"]);
	

}

$denominacion = substr($denominacion,0,10);

$per = $peri;
$fecha=strtoupper($result->fields["fecha"]);
$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$peri = $dia.$mes;

$anio = substr($fecha,0,4);
$fecha = $dia."-".$mes."-".$anio;
$nro_comprobante=strtoupper($result->fields["comprobante"]);
$precio=strtoupper($result->fields["importe"]);
$cod_movimiento=strtoupper($result->fields["cod_movimiento"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$afectacion=strtoupper($result->fields["afectacion"]);



  $sql4="select * from liquidacion  where  operacion = 1000 and nro_factura = $nro_comprobante and nro_laboratorio = $palabra and periodo = $mes";
//$result4 = $db_liq->Execute($sql4);
$liquidado=$result4->fields["importe"];

 $sql4="select * from liquidacion  where  operacion = 1100 and nro_factura = $nro_comprobante and nro_laboratorio = $palabra and periodo = $mes";
$result4 = $db_liq->Execute($sql4);
$liquidado=$result4->fields["importe"];

//$liquidado = $liquidado_1000 + $liquidado_1100;

$sql4="select * from liquidacion  where  operacion = 2000 and nro_factura = $nro_comprobante and nro_laboratorio = $palabra and periodo = $mes";
$result4 = $db_liq->Execute($sql4);

$deuda=$result4->fields["saldo_deuda"];

$precio_renglon =  $precio;

SWITCH ($cod_movimiento){

case "1":{
$entrada = $precio_renglon;
$movimiento = "FACTURA";
BREAK;
}

case "2":{
$entrada = $precio_renglon;
$movimiento = "N/DEBITO";
BREAK;
}

case "3":{
$salida = $precio_renglon;
$movimiento = "N/C (Afec. ".$afectacion.")";
BREAK;
}

case "4":{
$salida = $precio_renglon;
$movimiento = "POR CAJA (Afec. ".$afectacion.")";
BREAK;
}


CASE "5":{
$salida = $precio_renglon;
$movimiento = "DESC X LIQUI";
BREAK;
}


}

$suma_entrada = $suma_entrada + $entrada;
	$suma_salida = 	$suma_salida + $salida;

/*if ($tipo_fact == 0){
$tipo_fact = 'X';
}
*/

	if ($per != $peri){
$acumula_saldo = "";
if ($per != $peri){
?><tr bordercolor="#FFFFCC" bgcolor="#E6E6E6"> 
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?("$fecha");?></font></div></td>
    <td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?("$movimiento");?></font></div></td>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?("$tipo_fact");?></font></div></td>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?("$nro_comprobante");?></font></div></td>
	<td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><? $palabra;?> - <? $denominacion;?></font></div></td>
<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? $salida;?></font></div></td>

	<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"> <? number_format($acumula_saldo,2);?></font></div></td>
    <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">
      <? number_format($liquidado,2);?>
    </font></div></td>
    <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">
      <? number_format($deuda,2);?>
    </font></div></td>
    <td>&nbsp;</td>
  </tr><?
}


	}

$saldo = $salida;
$acumula_saldo = $acumula_saldo + $saldo;

$acumula_saldo_t = $acumula_saldo_t + $saldo;
$suma_liquidado = $suma_liquidado + $liquidado;
$suma_deuda = $suma_deuda + $deuda;

$liqdeu = $suma_liquidado + $suma_deuda;
$verif = ($liquidado + $deuda) - $salida;
	$suma_verif = $suma_verif + $verif;


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



IF ($verif == 0.00){$verif = "";}else	  {$verif = number_format($verif,2); }
IF ($liquidado == 0.00){$liquidado = "";}else	  {$liquidado = number_format($liquidado,2); }
IF ($deuda == 0.00){$deuda = "";}else	  {$deuda = number_format($deuda,2); }




?><tr bordercolor="#FFFFCC" bgcolor="#E6E6E6"> 
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$fecha");?></font></div></td>
    <td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$movimiento");?></font></div></td>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$tipo_fact");?></font></div></td>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$nro_comprobante");?></font></div></td>
	<td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $palabra;?> - <?echo $denominacion;?></font></div></td>
<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $salida;?></font></div></td>

	<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"> <?echo number_format($acumula_saldo,2);?></font></div></td>
    <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">
      <?echo  $liquidado;?>
    </font></div></td>
    <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">
      <? echo $deuda;?>
    </font></div></td>
    <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">
      <? echo $verif;?>
    </font></div></td>
  </tr>
  
 
  
<?
	

	 $entrada = "";
	$salida = "";
	$saldo = "";
$result->MoveNext();
	}
  
  ?>

  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5"><hr noshade></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="4"><div align="right"><strong><font size="4" face="Arial, Helvetica, sans-serif">TOTALES</font></strong></div></td>
    <td><div align="right"></div></td>
    <td><div align="right"><font size="2"><?echo number_format($suma_salida,2);?></font></div></td>
    <td><div align="right"><strong><font size="4" face="Arial, Helvetica, sans-serif"> <?echo number_format($acumula_saldo_t,2);?></font></strong></div></td>
    <td><div align="right"><?echo number_format($suma_liquidado,2);?></div></td>
    <td><div align="right"><?echo number_format($suma_deuda,2);?></div></td>
    <td><div align="right"><?echo number_format($suma_verif,2);?></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="4">&nbsp;</td>
    <td colspan="3"><div align="right"><strong><font size="4" face="Arial, Helvetica, sans-serif">  LIQUIDADO + DEUDA </font></strong></div></td>
    <td colspan="2">      <div align="right"><?echo number_format($liqdeu,2);?></div></td>
    <td>&nbsp;</td>
  </tr>

</table>
