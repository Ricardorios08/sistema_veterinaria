<? switch ($mes)
	{
		case "1":{$periodo= "ENERO";}break;
		case "2":{$periodo= "FEBRERO";}break;
		case "3":{$periodo= "MARZO";}break;
		case "4":{$periodo= "ABRIL";}break;
		case "5":{$periodo= "MAYO";}break;
		case "6":{$periodo= "JUNIO";}break;
		case "7":{$periodo= "JULIO";}break;
		case "8":{$periodo= "AGOSTO";}break;
		case "9":{$periodo= "SETIEMBRE";}break;
		case "10":{$periodo="OCTUBRE";}break;
		case "11":{$periodo="NOVIEMBRE";}break;
		case "12":{$periodo="DICIEMBRE";}break;
				}


$hoy = date("d/m/y");


?>
<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo17 {font-size: 12px}
.Estilo17 {font-family: Arial, Helvetica, sans-serif}
.Estilo69 {color: #FFFFFF}
.Estilo70 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; }
-->
</style>

 <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">
 
<table width="112%" height="168" border="0">
  <!--DWLayoutTable-->
<tr valign="middle" bgcolor="#E6E6E6">
    <td height="26" colspan="8"><div align="center" class="Estilo2">
      <div align="center"><span class="Estilo5"><span class="Estilo8">Sub Diario de Ventas del Mes: <?ECHO $mes;?></span> </span></div>
    </div></td>
  </tr>
     <tr bgcolor="#000099">
       <td width="11%" height="21" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
       <td colspan="2"><div align="center"><span class="Estilo70">FACTURAS</span></div></td>
       <td colspan="2"><div align="center"><span class="Estilo70">N/CREDITOS</span></div></td>
       <td colspan="2"><div align="center"><span class="Estilo70">N/DEBITOS</span></div></td>
       <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
     </tr>
     <tr bgcolor="#000099">
      <td height="21"><div align="center" class="Estilo69"><span class="Estilo17">Fecha</span></div></td>
      <td width="13%"><div align="right" class="Estilo70">BRUTO</div></td>
      <td width="11%"><div align="right"><span class="Estilo70">IVA</span></div></td>
      <td width="13%"><div align="right" class="Estilo70">BRUTO</div></td>
      <td width="13%"><div align="right"><span class="Estilo70">IVA </span></div></td>
      <td width="11%"><div align="right"><span class="Estilo70">BRUTO</span></div></td>
      <td width="13%"><div align="right"><span class="Estilo70">IVA </span></div></td>
      <td width="15%"><div align="right" class="Estilo70">TOTAL</div></td>
  </tr>
  <tr>
    <?

include ("../../../conexiones/config_grabacion.php");

if ($anio == ""){
	$anio = '08';
}


$fecha_desde = $anio."-".$mes."-01"; 
$fecha_hasta =$anio."-".$mes."-31";

$sql="select * from factura where fecha BETWEEN '$fecha_desde' and '$fecha_hasta'  and nro_factura < '100000' group by fecha order by fecha";

$result = $db_fa->Execute($sql);

  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


$fecha=strtoupper($result->fields["fecha"]);

$dia = substr($fecha, 8,2);
$mes = substr($fecha, 5,2);
$anio = substr($fecha, 0,4);

$fecha1 = $dia."-".$mes."-".$anio;

$sql1="select sum(total) as total, sum(iva) as iva from factura where (fecha = '$fecha' and tipo_operacion = 1 and nro_factura < 100000) or (fecha = '$fecha' and tipo_operacion = 0 and nro_factura < 100000) ORDER by $ordenar";
$result1 = $db_fa->Execute($sql1);
 $total=strtoupper($result1->fields["total"]);
 $iva=strtoupper($result1->fields["iva"]);

$sql1="select sum(total) as nota_credito,  sum(iva) as iva_nc from factura where (fecha = '$fecha' and tipo_operacion = 3 and nro_factura < 100000) ORDER by $ordenar";
$result1 = $db_fa->Execute($sql1);
$nota_credito=strtoupper($result1->fields["nota_credito"]);
 $iva_nc=strtoupper($result1->fields["iva_nc"]);
 
$nota_credito1 = $nota_credito - $iva_nc;
$sql1="select sum(total) as nota_debito, sum(iva) as iva_nd from factura where (fecha = '$fecha' and tipo_operacion = 2 and nro_factura < 100000) ORDER by $ordenar";
$result1 = $db_fa->Execute($sql1);
$nota_debito=strtoupper($result1->fields["nota_debito"]);

$iva_nd=strtoupper($result1->fields["iva_nd"]);
$nota_debito1 = $nota_debito - $iva_nd;


$total1 = $total - $iva;
$total_facturas = $total_facturas + $total1 - $nota_credito + $nota_debito;
$total_dia = $total1 + $iva - $nota_credito + $nota_debito;

$total_iva = $total_iva + $iva;


$total_nota_credito = $total_nota_credito + $nota_credito1;
$total_nota_debito = $total_nota_debito + $nota_debito1;

$total_nota_credito_iva = $total_nota_credito_iva + $iva_nc;
$total_nota_debito_iva  = $total_nota_debito_iva + $iva_nd;


if ($contado_nc == "0.00"){
	$contado_nc = "";
}


?>
  
  <td height="21" bgcolor="#E6E6E6"><div align="center" "><?print("$fecha1");?></div></td>
<td><div align="center" >
  <div align="right"><?echo $total1;?></div>
</div></td>
<td><div align="right"><?echo $iva;?></div></td>
<td bgcolor="#E6E6E6"><div align="right">-<?echo $nota_credito1;?></div></td>
<td bgcolor="#E6E6E6"><div align="right">-<?echo $iva_nc;?></div></td>
<td><div align="right"><?echo $nota_debito1;?></div></td>
<td><div align="right"><?echo $iva_nd;?></div></td>
<td bgcolor="#E6E6E6"><div align="right"><?echo $total_dia;?></div></td>
</tr>





<?

$total_dia = "";
$cuenta = "";
	

	$result->MoveNext();
	}

$total_final = $total_facturas + $total_iva - $total_nota_credito - $total_nota_credito_iva + $total_nota_debito_iva + $total_nota_debito;
	?>

	<tr>
	  <td height="21" colspan="8" bgcolor="#E6E6E6"><hr noshade></td>
  </tr>
	<tr>
  <td height="21" bgcolor="#E6E6E6"><div align="right" class="Estilo74"><strong>TOTAL</strong></div></td>
  <td><div align="center" class="Estilo74 Estilo72">
    <div align="right"><strong><span class="Estilo72">$ <?echo number_format( $total_facturas,2);?></span></strong></div>
  </div></td>
  <td><div align="right"><strong><span class="Estilo72">$ <?echo number_format( $total_iva,2);?></span></strong></div></td>
  <td bgcolor="#E6E6E6"><div align="right"><strong><span class="Estilo72">$ -<?echo  number_format($total_nota_credito,2);?></span></strong></div></td>
  <td bgcolor="#E6E6E6"><div align="right"><strong><span class="Estilo72">$ -<?echo  number_format($total_nota_credito_iva,2);?></span></strong></div></td>
  <td><div align="right"><strong><span class="Estilo72">$ <?echo number_format( $total_nota_debito,2);?></span></strong></div></td>
  <td><div align="right"><strong><span class="Estilo72">$ <?echo number_format( $total_nota_debito_iva,2);?></span></strong></div></td>
  <td bgcolor="#E6E6E6"><div align="right"><strong><span class="Estilo72">$ <?echo number_format($total_final,2);?></span></strong></div></td>
  </tr>
</table>
