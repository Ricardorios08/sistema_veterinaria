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
 

<!-- 
<a href="imp_pendientes.php?a='excel'&&buscar_por=<?php print("$buscar_por");?>"><IMG SRC="../../imagenes/botones//btn_exportar.gif" alt="Exportar" border = "0"></a> -->


<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 



<?php 

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
<table width="860" height="214" border="0">
  <!--DWLayoutTable-->
<tr valign="middle" bgcolor="#000099">
    <td height="26" colspan="7"><div align="center" class="Estilo2">
      <div align="center"><span class="Estilo5"><span class="Estilo8">Diario de Ventas del dia: <?php ECHO $fecha_a;?></span> </span></div>
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

	 <?php 

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
$neto=strtoupper($result->fields["subtotal"]);

$neto1=strtoupper($result->fields["subtotal"]);
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
  <td height="21"><div align="center" class="Estilo70"><?php print("$movimiento");?></div></td>

<?php  

if (($forma_pago == "CONTADO")){

	?>



<td><div align="center" class="Estilo5">
<a href ="cargar_cheque.php?nro_factura=<?php echo $nro_factura?>&&cuenta=<?php echo $cuenta?>&&denominacion=<?php echo $denominacion?>&&neto=<?php echo $neto1?>&&cheque1=<?php echo $cheque2?>&&fecha=<?php echo $fec?>&&fecha_a=<?php echo $fecha_a?>&&contado1=<?php echo $contado2?>&&fecha=<?php echo $fec?>&&tipo_fact=<?php echo $tipo_fact?>"><?php print("$tipo_fact");?> - <?php print("$nro_factura");?>
</a></div></td> <?php }
else{?>
<td><div align="center" class="Estilo5"><?php print("$tipo_fact");?> - <?php print("$nro_factura");?></div></td>
<?php }?>


<td><div align="center" class="Estilo5"> <div align="left"><?php print("$cuenta");?> 
 - <?php print("$denominacion");?></div>
</div>    </td>



<td><div align="center"><span class="Estilo70"><?php print("$es");?></span></div></td>
<td><div align="center" class="Estilo5">
  <div align="right"><?php echo $cta_cte;?></div>
</div></td>
<td><div align="center" class="Estilo5">
  <div align="right"><?php echo $contado1;?></div>
</div></td>
<td><div align="right" class="Estilo2"><?php echo $cheque1;?></div></td>
</tr>





<?php 

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
    <div align="right"><strong><span class="Estilo72 Estilo75">$ <?php echo number_format($suma_cta_cte,2);?></span></strong></div>
  </div></td>
  <td bgcolor="#006600"><div align="center" class="Estilo74 Estilo72 Estilo75">
    <div align="right"><strong><span class="Estilo72">$ <?php echo number_format($suma_caja1,2);?></span></strong></div>
  </div></td>
  <td bgcolor="#006600"><div align="right" class="Estilo75"><strong><span class="Estilo72">$ <?php echo number_format($suma_cheque1,2);?></span></strong></div></td>
  </tr>
	<tr>
	  <td height="21" colspan="4"><!--DWLayoutEmptyCell-->&nbsp;</td>
	  <td colspan="3" bgcolor="#006600"><div align="center"><strong><span class="Estilo72 Estilo75">Total Vta Contado $ <?php echo number_format($suma_contado,2);?></span></strong></div></td>
  </tr>
	<tr>
	  <td height="21" colspan="4"><!--DWLayoutEmptyCell-->&nbsp;</td>
	  <td><!--DWLayoutEmptyCell-->&nbsp;</td>
	  <td colspan="2"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
</table>



