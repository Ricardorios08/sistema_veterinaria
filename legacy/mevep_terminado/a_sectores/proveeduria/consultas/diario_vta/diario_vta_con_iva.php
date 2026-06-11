<style type="text/css">
<!--
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo5 {font-size: 12px}
.Estilo8 {font-size: 14px}
.Estilo74 {font-family: Arial, Helvetica, sans-serif}
.Estilo75 {color: #FFFFFF}
.Estilo76 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; }
-->
</style>
 

<?

$hora_inicial  = time();
 $s = date("h:i:s",$hora_inicial);

 if ($s > '07:20:00'){
//include ("genera_archivo.php");
//echo "SE GENERO DISKETTE PARA PAGINA WEB";
}?>


<!-- 
<a href="imp_pendientes.php?a='excel'&&buscar_por=<?print("$buscar_por");?>"><IMG SRC="../../imagenes/botones//btn_exportar.gif" alt="Exportar" border = "0"></a> -->


<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 



<?

// este mismo programa con seleccion de bioquimico corte por mes sera estadistica de venta

/*  mes    CONTADO   CTA CTE
	01         $5000
 	02                   $600
	03
*/


$nro_factura;




?>
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
<table width="102%" height="214" border="0">
  <!--DWLayoutTable-->
<tr valign="middle" bgcolor="#000099">
    <td height="26" colspan="7"><div align="center" class="Estilo2">
      <div align="center"><span class="Estilo5"><span class="Estilo8">Diario de Ventas del dia: <?ECHO $fecha_a;?></span> </span></div>
    </div></td>
  </tr>
   <tr bgcolor="#DAFAFC">
     <td height="21" colspan="5" bgcolor="#FFFFFF">   
     <td colspan="2" bgcolor="#006600" ><div align="center" class="Estilo75"><span class="Estilo2"><span class="Estilo2">Ventas Contado</span></span></div></td>
   </tr>
   <tr bgcolor="#DAFAFC">
     <td width="10%" height="21" bgcolor="#E6E6E6"><div align="center"><span class="Estilo2">Movimiento</span>
     </div>
     <td width="12%" bgcolor="#E6E6E6"><div align="center"><span class="Estilo2">Comprobante</span></span></div></td>
     <!-- <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Proveedor</span></div></td> -->
<td width="35%" bgcolor="#E6E6E6" ><div align="center"><span class="Estilo2">Titular</span></span></div></td>
<td width="10%" bgcolor="#E6E6E6" ><div align="center"><span class="Estilo2">Tipo</span></div></td>
<td width="14%" bgcolor="#FF0000" ><div align="center" class="Estilo75"><span class="Estilo2">Ventas Diferidas</span></span></div></td>
     <td width="9%" bgcolor="#006600" ><div align="center" class="Estilo76"></div>
     <div align="center" class="Estilo75"><span class="Estilo2"><span class="Estilo2">Efectivo</span></span></div></td>
     <td width="10%" bgcolor="#006600" ><div align="center" class="Estilo75"><span class="Estilo2"><span class="Estilo2">Cheque</span></span></div></td>
   </tr>
   <tr valign="top" bgcolor="#FFFFFF">
     <td height="21" colspan="7"><hr noshade>     </tr>

	 <?

include ("../../../../conexiones/config_pro.php");
$fec = $fecha;
$sql="select * from ventas_encabezado where fecha = '$fecha' ORDER by tipo_fact , nro_factura, fecha desc";
$result = $db->Execute($sql);

  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cuent = $cuenta;

$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result->fields["nro_cuenta"]);

if ($nro_cliente != 0){
$cuenta=$nro_cliente;
$es= "Externo";
$tipo_cuenta = 1; //cliente
}elseif ($nro_cuenta != 0){
$cuenta=$nro_cuenta;
$es= "Asociado";
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

$neto1=strtoupper($result->fields["neto"]);
$cheque1=strtoupper($result->fields["cheque"]);
$contado1=strtoupper($result->fields["contado"]);

$cheque2=$cheque1;
$contado2=$contado1;

if (($cheque1 == 0.00) && ($forma_pago == "CONTADO")){
$contado1 = $neto;
}


$auxi = $neto;

if ($cod_operacion == 3){
$auxi = ($auxi * -1);
}

if ($forma_pago == "CONTADO"){
$auxi_contado = $auxi_contado + $auxi;
$auxi_caja = $auxi_caja + $auxi;
$auxi_cheque = $auxi_cheque + $auxi;
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
$movimiento = "FACT";
BREAK;
}

case "2":{
$entrada = $precio_renglon;
$movimiento = "N/DE";
BREAK;
}

case "3":{
$salida = $precio_renglon;


$sql3="select * from resumen_cta_vta where comprobante = '$nro_factura' ";
$result3 = $db->Execute($sql3);
$afectacion=strtoupper($result3->fields["afectacion"]);
//$movimiento = "N/C(".$afectacion.")";
$movimiento = "N/CRE";

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
$movimiento = "ANU";
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

	$contado= "";
	$contado1= "";
	$cheque = "";
}
ELSEIF($forma_pago == 'CONTADO'){
$contado = $neto;

if ($cod_movimiento == 3){//nota
$contado = ($contado * -1);
$contado1 = ($contado1 * -1);
$cheque1 = ($cheque1 * -1);

}


$suma_iva = $suma_iva + $iva;


$suma_contado = $suma_contado + $contado;
$suma_caja1 = $suma_caja1 + $contado1;
$suma_cheque1 = $suma_cheque1 + $cheque1;


}



if ($cta_cte == 0.00){
	$cta_cte = "-";
}
else

	  {
$cta_cte = "$ ".number_format($cta_cte,2);
	  }

if ($contado == 0.00){
	$contado = "-";
}
else
{
$contado = "$ ".number_format($contado,2);
	  }

if ($contado1 == 0.00){
	$contado1 = "-";
}
else
{
$contado1 = "$ ".number_format($contado1,2);
	  }

	  if ($cheque1 == 0.00){
	$cheque1 = "-";
}
else
{
$cheque1 = "$ ".number_format($cheque1,2);
	  }



$cheque;

//$cuenta = "(".$cuenta.") ".$denominacion;
?>
<tr>
  <td height="21"><div align="center" class="Estilo70"><?print("$movimiento");?></div></td>

<? 

if (($forma_pago == "CONTADO")){

	?>



<td><div align="center" class="Estilo5">
<a href ="cargar_cheque.php?nro_factura=<?echo $nro_factura?>&&cuenta=<?echo $cuenta?>&&denominacion=<?echo $denominacion?>&&neto=<?echo $neto1?>&&cheque1=<?echo $cheque2?>&&fecha=<?echo $fec?>&&fecha_a=<?echo $fecha_a?>&&contado1=<?echo $contado2?>&&fecha=<?echo $fec?>&&tipo_fact=<?echo $tipo_fact?>"><?print("$tipo_fact");?> - <?print("$nro_factura");?>
</a></div></td> <?}
else{?>
<td><div align="center" class="Estilo5"><?print("$tipo_fact");?> - <?print("$nro_factura");?></div></td>
<?}?>


<td><div align="center" class="Estilo5"> <div align="left"><?print("$cuenta");?> 
 - <?print("$denominacion");?></div>
</div>    </td>



<td><div align="center"><span class="Estilo70"><?print("$es");?></span></div></td>
<td><div align="center" class="Estilo5">
  <div align="right"><?echo $cta_cte;?></div>
</div></td>
<td><div align="center" class="Estilo5">
  <div align="right"><?echo $contado1;?></div>
</div></td>
<td><div align="right" class="Estilo2"><?echo $cheque1;?></div></td>
</tr>





<?

$cuenta = "";
$contado1 = "";
$cheque1 = "";
$cta_cte= "";

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


$suma_debe = $auxi_externo + $auxi_asociado + $auxi_contado;
$suma_haber = $suma_ventas + $iva;
	?>

	<tr>
	  <td height="21" colspan="7"><hr noshade></td>
	</tr>
	<tr>
  <td height="21" colspan="4"><div align="right" class="Estilo74"><strong>TOTAL</strong></div></td>
  <td bgcolor="#FF0000"><div align="center" class="Estilo74 Estilo72">
    <div align="right"><strong><span class="Estilo72 Estilo75">$ <?echo number_format($suma_cta_cte,2);?></span></strong></div>
  </div></td>
  <td bgcolor="#006600"><div align="center" class="Estilo74 Estilo72 Estilo75">
    <div align="right"><strong><span class="Estilo72">$ <?echo number_format($suma_caja1,2);?></span></strong></div>
  </div></td>
  <td bgcolor="#006600"><div align="right" class="Estilo75"><strong><span class="Estilo72">$ <?echo number_format($suma_cheque1,2);?></span></strong></div></td>
  </tr>
	<tr>
	  <td height="21" colspan="4"><!--DWLayoutEmptyCell-->&nbsp;</td>
	  <td colspan="3" bgcolor="#006600"><div align="center"><strong><span class="Estilo72 Estilo75">Total Vta Contado $ <?echo number_format($suma_contado,2);?></span></strong></div></td>
  </tr>
	<tr>
	  <td height="21" colspan="4"><!--DWLayoutEmptyCell-->&nbsp;</td>
	  <td><!--DWLayoutEmptyCell-->&nbsp;</td>
	  <td colspan="2"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
</table>



<?

 ////////////////////////////////////////////
 $sql1 = "SELECT sum(iva) as iva_facturas FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2 ) and nro_cuenta != 0 ";
$result1 = $db->Execute($sql1);

  $iva_facturas=$result1->fields["iva_facturas"];

  $sql2 = "SELECT sum(iva) as iva_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != '0'";
$result2 = $db->Execute($sql2);
  $iva_nc=$result2->fields["iva_nc"];
 $iva = $iva_facturas - $iva_nc;

$sql1 = "SELECT sum(neto) as neto FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cuenta != 0 and forma_pago = 'CTA/CTE'";
$result1 = $db->Execute($sql1);
 $neto=$result1->fields["neto"];

 $sql2 = "SELECT sum(neto) as neto_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != 0 and forma_pago = 'CTA/CTE'";
$result2 = $db->Execute($sql2);
  $neto_nc=$result2->fields["neto_nc"];

$neto = $neto - $neto_nc;

 $sql1 = "SELECT sum(neto) as contado FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $contado=$result1->fields["contado"];

$sql2 = "SELECT sum(neto) as contado_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
  $contado_nc=$result2->fields["contado_nc"];

///////////////////// NUEVA PARTE
 $sql1 = "SELECT sum(cheque) as cheque FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $cheque=$result1->fields["cheque"];

$sql2 = "SELECT sum(cheque) as cheque_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
 $cheque_nc=$result2->fields["cheque_nc"];

 $sql1 = "SELECT sum(neto) as caja FROM ventas_encabezado WHERE ( fecha = '$fecha' and cod_operacion = 0 and nro_cuenta != 0 and forma_pago = 'CONTADO' and cheque = '0.00') OR ( fecha = '$fecha' and cod_operacion = 1 and nro_cuenta != 0 and forma_pago = 'CONTADO' and cheque = '0.00') OR (fecha = '$fecha' and cod_operacion = 2 and nro_cuenta != 0 and forma_pago = 'CONTADO' and cheque = '0.00') ";
$result1 = $db->Execute($sql1);
$caja=$result1->fields["caja"];

$sql2 = "SELECT sum(neto) as caja_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
$caja_nc=$result2->fields["caja_nc"];

$cheque= $cheque - $cheque_nc;

$caja= $contado - $contado_nc - $cheque;


$vendido = $neto + $caja + $cheque - $iva;

$debe= $neto + $caja + $cheque;
$haber= $vendido + $iva;



?>
<table width="608" border="0">
  <tr>
    <td colspan="4"><div align="center"><span class="Estilo2"><strong><span class="Estilo1 Estilo20"><strong><blink>Fecha <?echo $fecha20;?></blink></strong></span></strong></span></div>      
    <div align="center"></div>      <div align="center"></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center" class="Estilo2">
      <div align="center"><strong><span class="Estilo1"><strong><strong>***</strong> Asiento Asociados *** </strong></span></strong></div>
    </div></td>
    <td width="97"><div align="center" class="Estilo19"><em><span class="Estilo1">DEBE</span></em></div></td>
    <td width="136"><div align="center" class="Estilo19"><em><span class="Estilo1">HABER</span></em></div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1211001 Deudores por Ventas Proveedur&iacute;a Asociados </span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($neto,2);?></span></div></td>
    <td><div align="center">-</div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">11101021 Fondos a Depositar Efectivo </span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($caja,2);?></span></div></td>
    <td><div align="center">-</div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1110101 Fondos a Depositar Cheque</span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($cheque,2);?></span></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="110">&nbsp;</td>
    <td width="247"><span class="Estilo2">a 4110201 Ventas Proveedur&iacute;a Asociados</span></td>
    <td><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($vendido,2);?></span></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo2">a 2410107 IVA D&eacute;bito Fiscal</span></td>
    <td><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($iva,2);?></span></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td><div align="right"><strong><span class="Estilo2"><?echo number_format($debe,2);?></span></strong></div></td>
    <td><div align="right"><strong><span class="Estilo2"><?echo number_format($haber,2);?></span></strong></div></td>
  </tr>
</table>


<?
////////////////////////////////////////////
$todo_debe_asociados = $todo_debe_asociados + $debe;
$todo_iva_asociados = $todo_iva_asociados + $iva;
//externos
 ////////////////////////////////////////////
 $sql1 = "SELECT sum(iva) as iva_facturas FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2 ) and nro_cliente != 0 ";
$result1 = $db->Execute($sql1);

 $iva_facturas=$result1->fields["iva_facturas"];

 $sql2 = "SELECT sum(iva) as iva_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0";
$result2 = $db->Execute($sql2);
 $iva_nc=$result2->fields["iva_nc"];

 $iva = $iva_facturas - $iva_nc;

$sql1 = "SELECT sum(neto) as neto FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cliente != 0 and forma_pago = 'CTA/CTE'";
$result1 = $db->Execute($sql1);
 $neto=$result1->fields["neto"];

 $sql2 = "SELECT sum(neto) as neto_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0 and forma_pago = 'CTA/CTE'";
$result2 = $db->Execute($sql2);
  $neto_nc=$result2->fields["neto_nc"];

$neto = $neto - $neto_nc;

 $sql1 = "SELECT sum(neto) as contado FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $contado=$result1->fields["contado"];

 $sql2 = "SELECT sum(neto) as contado_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
  $contado_nc=$result2->fields["contado_nc"];

 ///////////////////// NUEVA PARTE
 $sql1 = "SELECT sum(cheque) as cheque FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $cheque=$result1->fields["cheque"];

$sql2 = "SELECT sum(cheque) as cheque_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
 $cheque_nc=$result2->fields["cheque_nc"];

 $sql1 = "SELECT sum(neto) as caja FROM ventas_encabezado WHERE (fecha = '$fecha' AND cod_operacion = 0 and nro_cliente != 0 and forma_pago = 'CONTADO' and cheque = '0.00') OR (fecha = '$fecha' AND cod_operacion = 1 and nro_cliente != 0 and forma_pago = 'CONTADO' and cheque = '0.00') OR (fecha = '$fecha' AND cod_operacion = 2 and nro_cliente != 0 and forma_pago = 'CONTADO' and cheque = '0.00')";
$result1 = $db->Execute($sql1);
 $caja=$result1->fields["caja"];

$sql2 = "SELECT sum(contado) as caja_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
$caja_nc=$result2->fields["caja_nc"];

$cheque= $cheque - $cheque_nc;
$caja= $caja - $caja_nc;

$contado = $contado - $contado_nc;
$vendido = $neto + $caja + $cheque - $iva;

$debe= $neto + $caja + $cheque;
$haber= $vendido + $iva;


?>
<table width="608" border="0">
  <tr>
    <td colspan="2"><div align="center" class="Estilo2">
      <div align="center"><strong><span class="Estilo1"><strong>***</strong></span> Asiento Externos <span class="Estilo1"><strong>***</strong></span></strong></div>
    </div>      <div align="center" class="Estilo2"></div>      <div align="center" class="Estilo2"></div></td>
    <td><div align="center" class="Estilo19">    </div></td>
    <td><div align="center">
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1211002 Deudores por Ventas Proveedur&iacute;a Externos </span></td>
    <td width="95"><div align="right"><span class="Estilo2"><?echo number_format($neto,2);?></span></div></td>
    <td width="138"><div align="center">-</div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1110102 Fondos a Depositar Efectivo</span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($caja,2);?></span></div></td>
    <td><div align="center">-</div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1110101 Fondos a Depositar Cheque</span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($cheque,2);?></span></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="110">&nbsp;</td>
    <td width="247"><span class="Estilo2">a 4110204 Ventas Proveedur&iacute;a Externos</span></td>
    <td><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($vendido,2);?></span></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo2">a 2410107 IVA D&eacute;bito Fiscal</span></td>
    <td><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($iva,2);?></span></div></td>
  </tr>
  <tr>
    <td height="21" colspan="2">&nbsp;</td>
    <td><div align="right"><strong><span class="Estilo2"><?echo number_format($debe,2);?></span></strong></div></td>
    <td><div align="right"><strong><span class="Estilo2"><?echo number_format($haber,2);?></span></strong></div></td>
  </tr>
</table>



<?
////////////////////////////////////////////
$cheque = "";
$caja = "";
$todo_debe_externos = $todo_debe_externos + $debe;
$todo_iva_externos = $todo_iva_externos + $iva;
/////////////// DETALLE ANALITICO DE EXTERNOS  ///////////

?>
<table width="608" border="0">
  <!--DWLayoutTable-->
<tr>
  <td colspan="6"><div align="center">___________________ <span class="Estilo5">DETALLE DE DEUDORES X VENTA EXTERNO</span> ___________________</div></td>
  </tr>
<tr>
    <td width="228"><div align="center" class="Estilo11 Estilo5"><em><span class="Estilo5">Laboratorio</span></em></div></td>
    <td colspan="2"><div align="center" class="Estilo12"><em><span class="Estilo5">Comp.</span></em></div></td>
    <td width="89"><div align="center" class="Estilo11 Estilo5"><em><span class="Estilo5">N.G</span></em></div></td>
    <td width="73"><div align="center" class="Estilo12"><em><span class="Estilo5">IVA</span></em></div></td>
    <td width="77"><div align="center" class="Estilo11 Estilo5"><em><span class="Estilo5">Total</span></em></div></td>
  </tr>

  <?

$sql1 = "SELECT * FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cliente != 0 and forma_pago = 'CTA/CTE'";
$result_ext = $db->Execute($sql1);

  if (!$result_ext) die("fallo".$db->ErrorMsg());
  while (!$result_ext->EOF) {

$cod_movimiento1=strtoupper($result_ext->fields["cod_operacion"]);
$forma_pago1=strtoupper($result_ext->fields["forma_pago"]);
$nro_factura1=strtoupper($result_ext->fields["nro_factura"]);
$cod_operacion1 = strtoupper($result_ext->fields["cod_operacion"]);
$denominacion1=strtoupper($result_ext->fields["denominacion"]);
$tipo_fact1=strtoupper($result_ext->fields["tipo_fact"]);
$fecha1=strtoupper($result_ext->fields["fecha"]);
$neto_gravado1=strtoupper($result_ext->fields["neto_gravado"]);
$neto1=strtoupper($result_ext->fields["neto"]);
$iva1=strtoupper($result_ext->fields["iva"]);
$auxi_ext = $neto1;

if ($cod_operacion1 == 3){
$auxi_ext = ($auxi_ext * -1);
}


$suma_neto_gravado1 = $suma_neto_gravado1 + $neto_gravado1;
$suma_iva1 = $suma_iva1 + $iva1;
$suma_neto1 = $suma_neto1 + $neto1;


?>
<tr>
    <td><span class="Estilo12 Estilo5 Estilo11"><?echo $cuenta;?> - <?echo $denominacion1;?></span></td>
    <td colspan="2"><div align="center" class="Estilo5"><span class="Estilo16 Estilo11"><?echo $movimiento;?> <?echo $tipo_fact1;?> - <?echo $nro_factura1;?></span></div></td>
    <td><div align="right" class="Estilo12 Estilo13"><span class="Estilo12"><?echo number_format($neto_gravado1,2);?></span></div></td>
    <td><div align="right" class="Estilo14"><span class="Estilo12"><?echo number_format($iva1,2);?></span></div></td>
    <td><div align="right" class="Estilo14"><span class="Estilo12"><?echo number_format($neto1,2);?></span></div></td>
  </tr>

<?

$result_ext->MoveNext(); // CAMBIA ANALITICO
	}

?>
<tr>
  <td colspan="3"><div align="right"><span class="Estilo15 Estilo17 Estilo5">Total</span></div></td>
  <td><div align="right" class="Estilo18"><span class="Estilo12 Estilo13"><span class="Estilo12 Estilo17  Estilo5"><?echo number_format($suma_neto_gravado1,2);?></span></span></div></td>
  <td><div align="right" class="Estilo18"><span class="Estilo12 Estilo13"><span class="Estilo12 Estilo5  Estilo17"><?echo number_format($suma_iva1,2);?></span></span></div></td>
  <td><div align="right" class="Estilo18"><span class="Estilo12 Estilo13"><span class="Estilo12 Estilo17  Estilo5"><?echo number_format($suma_neto1,2);?></span></span></div></td>
</tr>
<tr>
  <td colspan="2">&nbsp;</td>
  <td width="81">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="6"><div align="center">****************************************************************</div></td>
  </tr>

	<?

$suma_neto_gravado1 = "";
$suma_iva1 = "";
$suma_neto1 = "";


$todo_debe = $todo_debe_asociados + $todo_debe_externos;
$todo_iva = $todo_iva_asociados + $todo_iva_externos;

?>
</TABLE>

