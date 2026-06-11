<style type="text/css">
<!--
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo5 {font-size: 12px}
.Estilo8 {
	font-size: 14px;
	color: #FFFFFF;
}
.Estilo10 {font-size: 14px; color: #000000; }
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo13 {
	font-size: 11px;
	font-style: italic;
}
.Estilo14 {font-family: Arial, Helvetica, sans-serif}
.Estilo16 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>
 

<!-- 
<a href="imp_pendientes.php?a='excel'&&buscar_por=<?print("$buscar_por");?>"><IMG SRC="../../imagenes/botones//btn_exportar.gif" alt="Exportar" border = "0"></a> -->


<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 

<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo70 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo72 {font-size: 12px}
.Estilo72 {font-family: Arial, Helvetica, sans-serif}
.Estilo74 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>
<table width="102%" height="48" border="0">
  <!--DWLayoutTable-->
<tr valign="middle" bgcolor="#000099">
    <td height="21" colspan="5"><div align="center" class="Estilo2">
      <div align="right"><span class="Estilo5"><span class="Estilo8">Diario de Ventas Mensual Emitido  dia: <?ECHO $fecha_a;?></span> </span></div>
    </div></td>
  </tr>
<tr valign="middle" bgcolor="#000099">
  <td height="21" colspan="5" bgcolor="#FFFFFF"><hr noshade></td>
</tr>


	 <?

include ("../../../../conexiones/config_pro.php");


$fecha_desde = $anio."-".$mes."-01";
$fecha_hasta =$anio."-".$mes."-31";

 $sql2="select fecha from ventas_encabezado where fecha between '$fecha_desde' and '$fecha_hasta' group by fecha order by fecha";
$result123 = $db->Execute($sql2);

  if (!$result123) die("fallo".$db->ErrorMsg());
  while (!$result123->EOF) {

 $fecha1=strtoupper($result123->fields["fecha"]);

$dia1 = substr($fecha1,8,2);
$mes1 = substr($fecha1,5,2);
$anio1 = substr($fecha1,0,4);

$fecha20 = $dia1."-".$mes1."-".$anio1;
	


 $sql="select * from ventas_encabezado where fecha = '$fecha1' ORDER by tipo_fact , nro_factura, fecha desc";
$result = $db->Execute($sql);

  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cuent = $cuenta;

$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result->fields["nro_cuenta"]);

if ($nro_cliente != 0){
$cuenta=$nro_cliente;
$tipo_cuenta = 1; //cliente
}elseif ($nro_cuenta != 0){
$cuenta=$nro_cuenta;
$tipo_cuenta = 2; //asociado
}

 $cod_movimiento=strtoupper($result->fields["cod_operacion"]);
 $forma_pago=strtoupper($result->fields["forma_pago"]);
$nro_factura=strtoupper($result->fields["nro_factura"]);
$cod_operacion = strtoupper($result->fields["cod_operacion"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);




$fecha=strtoupper($result->fields["fecha"]);
$descuento=strtoupper($result->fields["descuento"]);

$bonificacion=strtoupper($result->fields["bonificacion"]);
$subtotal=strtoupper($result->fields["subtotal"]);
$iva=strtoupper($result->fields["iva"]);
$total=strtoupper($result->fields["total"]);
$periodo=strtoupper($result->fields["periodo"]);
$anio=strtoupper($result->fields["anio"]);
$neto=strtoupper($result->fields["neto"]);

$auxi = $neto;

if ($cod_operacion == 3){
$auxi = ($auxi * -1);
}

if ($forma_pago == "CONTADO"){
//$auxi_contado = $auxi_contado + $auxi;
if ($tipo_cuenta == 1){ //cliente
$auxi_contado_externos= $auxi_contado_externos + $auxi;
echo $iva_contado_externo = $iva_contado_externo + $iva; }
else{$auxi_contado_asociados = $auxi_contado_asociados + $auxi;
$iva_contado_asociado = $iva_contado_asociado + $iva;
}
}
else
	{
if ($tipo_cuenta == 1){ //cliente
$auxi_externo = $auxi_externo + $auxi;
}
else
		{
$auxi_asociado = $auxi_asociado + $auxi;
		}

	}



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


$sql3="select * from resumen_cta_vta where comprobante = '$nro_factura' ";
$result3 = $db->Execute($sql3);
$afectacion=strtoupper($result3->fields["afectacion"]);
//$movimiento = "N/C(".$afectacion.")";
$movimiento = "N/CREDITO";

BREAK;
}

case "4":{
$salida = $precio_renglon;
$movimiento = "PAGO POR CAJA";
BREAK;
}


CASE "5":{
$salida = $precio_renglon;
$movimiento = "DESC X LIQUIDACION";
BREAK;
}

CASE "6":{
$salida = ($precio_renglon * -1);
$movimiento = "ANULADA";
BREAK;
}

}


if ($forma_pago == 'CTA/CTE'){
$cta_cte = $neto;
if ($cod_movimiento == 3){//nota
$cta_cte = ($cta_cte * -1);
}


IF ($tipo_cuenta == 1){
	$suma_cta_cte_cliente = $suma_cta_cte_cliente + $neto;
}else	
	{$suma_cta_cte_asociado = $suma_cta_cte_asociado + $neto;
}


$suma_cta_cte = $suma_cta_cte + $cta_cte;


}
ELSEIF($forma_pago == 'CONTADO'){
$contado = $neto;
if ($cod_movimiento == 3){//nota
$contado = ($contado * -1);
}


$suma_iva = $suma_iva + $iva;
//$suma_contado = $suma_contado + $contado;


IF ($tipo_cuenta == 1){

	$suma_contado_externo = $suma_contado_externo + $contado;
}else{
	$suma_contado_asociado= $suma_contado_asociado + $contado;

}


}



if ($cta_cte == 0.00){
	$cta_cte = "-";
}
else

	  {
$cta_cte = $cta_cte;
	  }

if ($contado == 0.00){
	$contado = "-";
}
else
{
$contado = $contado;
	  }




//$cuenta = "(".$cuenta.") ".$denominacion;
?>
<!-- <tr>
  <td height="21"><div align="center" class="Estilo70"><?print("$movimiento");?></div></td>
<td><div align="center" class="Estilo5"><?print("$tipo_fact");?> - <?print("$nro_factura");?></div></td>
<td><div align="center" class="Estilo5"> <div align="left"><?print("$cuenta");?> 
 - <?print("$denominacion");?></div>
</div>    </td>



<td><div align="center" class="Estilo5">
  <div align="right"><?echo $cta_cte;?></div>
</div></td>
<td><div align="center" class="Estilo5">
  <div align="right"><?echo $contado;?></div>
</div></td>
</tr>

 -->



<?

$cuenta = "";
	

	$result->MoveNext();
	}



/////////////////
 $sql1 = "SELECT sum(iva) as iva_facturas FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2 )";
$result1 = $db->Execute($sql1);
$iva_facturas=$result1->fields["iva_facturas"];

 $sql2 = "SELECT sum(iva) as iva_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' ";
$result2 = $db->Execute($sql2);
$iva_nc=$result2->fields["iva_nc"];


$iva = $iva_facturas - $iva_nc;


$suma_ventas = $suma_contado + $suma_cta_cte - $iva;

$suma_ventas_asociado = $suma_ventas_asociado + $suma_contado_asociado;
 $suma_ventas_externo = $suma_ventas_externo + $suma_contado_externo;



	?>
</table>





<table width="104%" border="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="20" colspan="5"><div align="center" class="Estilo2"><strong>MOVIMIENTO DEL DIA: <span class="Estilo5"><span class="Estilo10"><?ECHO $fecha20;?></span></span></strong></div></td>
    <td colspan="2"><div align="center" class="Estilo2"><strong>DEBE </strong></div></td>
    <td width="138"><div align="center" class="Estilo2"><strong>HABER</strong></div></td>
  </tr>
  <tr>
    <td height="21" colspan="5"><span class="Estilo2">1211001 Deudores por Ventas Proveedur&iacute;a Asociados </span></td>
    <td colspan="2"><div align="right"><span class="Estilo2"><?echo number_format($auxi_asociado,2);?></span></div></td>
    <td><div align="center">-</div></td>
  </tr>
  <?//if ($auxi_externo > 0){
	?>
  <tr>
    <td height="21" colspan="5"><span class="Estilo2">1211002 Deudores por Ventas Proveedur&iacute;a Externos </span></td>
    <td colspan="2"><div align="right"><span class="Estilo2"><?echo number_format($auxi_externo,2);?></span></div></td>
    <td><div align="center">-</div></td>
  </tr>
  <tr>
    <td width="226" height="21" valign="top"><div align="center" class="Estilo13"><span class="Estilo14">Laboratorio</span></div></td>
    <td width="109" valign="top"><div align="center"><span class="Estilo13"><span class="Estilo14">Comp.</span></span></div></td>
    <td width="59" valign="top"><div align="center" class="Estilo13"><span class="Estilo14">N.G</span></div></td>
    <td width="63" valign="top"><div align="center"><span class="Estilo13"><span class="Estilo14">IVA</span></span></div></td>
    <td colspan="2" valign="top"><div align="center" class="Estilo13"><span class="Estilo14">Total</span></div></td>
    <td width="90">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>


<?

$sql="select * from ventas_encabezado where fecha = '$fecha1' and nro_cliente != 0 and forma_pago != 'CONTADO' ORDER by tipo_fact , nro_factura, fecha desc";
$result_ext = $db->Execute($sql);


  if (!$result_ext) die("fallo".$db->ErrorMsg());
  while (!$result_ext->EOF) {

$cuent = $cuenta;

$nro_cliente=strtoupper($result_ext->fields["nro_cliente"]);

if ($nro_cliente != 0){
$cuenta=$nro_cliente;
$tipo_cuenta = 1; //cliente
$iva1=strtoupper($result_ext->fields["iva"]);
echo "---------------".$iva_externos = $iva_externos + $iva1;
}elseif ($nro_cuenta != 0){
$cuenta=$nro_cuenta;
$iva1=strtoupper($result_ext->fields["iva"]);
$iva_asoc = $iva_asoc + $iva1;
$tipo_cuenta = 2; //asociado
}

$cod_movimiento1=strtoupper($result_ext->fields["cod_operacion"]);
$forma_pago1=strtoupper($result_ext->fields["forma_pago"]);
$nro_factura1=strtoupper($result_ext->fields["nro_factura"]);
$cod_operacion1 = strtoupper($result_ext->fields["cod_operacion"]);
$denominacion1=strtoupper($result_ext->fields["denominacion"]);
$tipo_fact1=strtoupper($result_ext->fields["tipo_fact"]);
$fecha1=strtoupper($result_ext->fields["fecha"]);



$neto_gravado1=strtoupper($result_ext->fields["neto_gravado"]);
//$bonificacion=strtoupper($result_ext->fields["bonificacion"]);
//$subtotal=strtoupper($result_ext->fields["subtotal"]);

//$total=strtoupper($result_ext->fields["total"]);
//$periodo=strtoupper($result_ext->fields["periodo"]);
//$anio=strtoupper($result_ext->fields["anio"]);
$neto1=strtoupper($result_ext->fields["neto"]);

$auxi_ext = $neto1;

if ($cod_operacion1 == 3){
$auxi_ext = ($auxi_ext * -1);
}


SWITCH ($cod_movimiento1){

case "1":{
$entrada1 = $precio_renglon;
$movimiento = "FAC";
BREAK;
}

case "2":{
$entrada1 = $precio_renglon;
$movimiento = "N/D";
BREAK;
}

case "3":{
$salida1 = $precio_renglon;

$sql3="select * from resumen_cta_vta where comprobante = '$nro_factura1' ";
$result3 = $db->Execute($sql3);
$afectacion=strtoupper($result3->fields["afectacion"]);
$movimiento = "N/C";

BREAK;
}

case "4":{
$salida1 = $precio_renglon;
$movimiento = "PAGO POR CAJA";
BREAK;
}


CASE "5":{
$salida1 = $precio_renglon;
$movimiento = "DESC X LIQUIDACION";
BREAK;
}

CASE "6":{
$salida1 = ($precio_renglon * -1);
$movimiento = "ANULADA";
BREAK;
}

}


  



?>
<tr>
    <td height="21" valign="top"><span class="Estilo12"><?echo $cuenta;?> - <?echo $denominacion1;?></span></td>
    <td valign="top"><div align="center"><span class="Estilo16"><?echo $movimiento;?> <?echo $tipo_fact1;?> - <?echo $nro_factura1;?></span></div></td>
    <td valign="top"><div align="right"><span class="Estilo12"><?echo number_format($neto_gravado1,2);?></span></div></td>
    <td valign="top"><div align="right"><span class="Estilo12"><?echo number_format($iva1,2);?></span></div></td>
    <td colspan="2" valign="top"><div align="right"><span class="Estilo12"><?echo number_format($neto1,2);?></span></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<?

$result_ext->MoveNext();
	}

//}


$iva_asociados = $iva - $iva_externos;

if ($iva_asociados < 0){
$iva_asociados = $iva_asociados * -1;
	}



if ($iva_externos < 0){
$iva_externos = $iva_externos * -1;
	}


$suma_ventas_asociado = $auxi_asociado + $auxi_contado_asociados - $iva_asociados;
$suma_ventas_externo = $auxi_externo + $auxi_contado_externos - $iva_externos;

if ($suma_ventas_asociado < 0){
$suma_ventas_asociado = $suma_ventas_asociado * -1;
	}

	if ($suma_ventas_externo < 0){
 $suma_ventas_externo = $suma_ventas_externo * -1;
	}



$suma_debe = $auxi_externo + $auxi_asociado + $auxi_contado_asociados + $auxi_contado_externos;
$suma_haber = $suma_ventas_asociado + $suma_ventas_externo + $iva;

	?>
  <tr>
    <td height="21" colspan="5"><span class="Estilo2">1110101 Fondos a Depositar Asociados </span></td>
    <td colspan="2"><div align="right"><span class="Estilo2"><?echo number_format($auxi_contado_asociados,2);?></span></div></td>
    <td><div align="center">-</div></td>
  </tr>
  <tr>
    <td height="21" colspan="5"><span class="Estilo2">1110101 Fondos a Depositar Externos</span></td>
    <td colspan="2"><div align="right"><span class="Estilo2"><?echo number_format($auxi_contado_externos,2);?></span></div></td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="5"><div align="right"><span class="Estilo2">a 4110201 Ventas Proveedur&iacute;a Asociado&nbsp;&nbsp;&nbsp;</span></div></td>
    <td colspan="2"><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($suma_ventas_asociado,2);?></span></div></td>
  </tr>
  <tr>
    <td height="21" colspan="5"><div align="right"><span class="Estilo2">a 4110201 Ventas Proveedur&iacute;a Externo </span></div></td>
    <td colspan="2"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($suma_ventas_externo,2);?></span></div></td>
  </tr>
  <tr>
    <td height="21" colspan="5"><div align="right"><span class="Estilo2">a 2410107 IVA D&eacute;bito Fiscal Asociados&nbsp;</span></div></td>
    <td width="43">&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($iva_asociados,2);?></span></div></td>
  </tr>
  <tr>
    <td height="21" colspan="5"><div align="right"><span class="Estilo2">a 2410107 IVA D&eacute;bito Fiscal  Externos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div></td>
    <td colspan="2"><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($iva_externos,2);?></span></div></td>
  </tr>
  <tr>
    <td height="22" colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="28">&nbsp;</td>
    <td colspan="2"><hr noshade></td>
    <td><hr noshade></td>
  </tr>
  <tr>
    <td height="21" colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><div align="right"><span class="Estilo2"><?echo number_format($suma_debe,2);?></span></div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($suma_haber,2);?></span></div></td>
  </tr>
  <tr>
    <td height="22" colspan="8"><hr noshade></td>
  </tr>
</table>

<?

$neto_gravado = ($suma_debe / 1.21);

$suma_debe = "";
$suma_haber= "";
$iva= "";
$suma_ventas= 0;
$auxi_contado= "";
$auxi_contado_asociados= "";
$auxi_contado_externos= "";
$iva_externos = "";
$iva_asociados = "";
$iva_contado_asociado = ""; 
$iva_contado_externo = "";
$auxi_externo= "";
$auxi_asociado= "";
$suma_contado = "";
	$suma_cta_cte = "";
	$iva_nc = "";
	$iva_facturas = "";
	$contado = "";
	$cta_cte = "";

	echo "<br>";
	$result123->MoveNext();
	}

	?>