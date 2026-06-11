<style type="text/css">
<!--
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo5 {font-size: 12px}
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo3 {font-size: 14px}
.Estilo83 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #0000FF;
}
.Estilo89 {font-family: Arial, Helvetica, sans-serif; color: #000000; }
.Estilo91 {
	font-family: "Courier New", Courier, mono;
	font-style: italic;
	font-size: 10px;
}
.Estilo92 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
}
.Estilo93 {font-size: 14px; font-family: Arial, Helvetica, sans-serif; }
.Estilo95 {font-size: 14px; font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; }
.Estilo96 {color: #FFFFFF}
body {
	background-image: url(../../../imagenes/logito.png);
}
-->
</style>
<!-- <A HREF="imp_pendientes.php?a='imprimir'&&buscar_por=<?print("$buscar_por");?>&&nro_factura=<?print("$nro_factura");?>&&mes=<?print("$mes");?>&&anio=<?print("$anio");?>"><IMG SRC="../../../imagenes/botones//btn_imprimir.gif" alt="Imprimir" border = "0"></A>  -->

<!-- 
<a href="imp_pendientes.php?a='excel'&&buscar_por=<?print("$buscar_por");?>"><IMG SRC="../../imagenes/botones//btn_exportar.gif" alt="Exportar" border = "0"></a> -->





<?
$nro_os=$_REQUEST ['nro_os'];
$buscar_po=$_REQUEST ['buscar_por'];
$nro_factura=$_REQUEST ['nro_factura'];
$anio=$_REQUEST ['anio'];
 $cliente_proveedor=$_REQUEST ['cliente_proveedor'];


$buscar_po=$_POST["buscar_por"];
	for ($i=0;$i<count($buscar_po);$i++)    
	{     
	$buscar_por = $buscar_po[$i];    
	}

	$me=$_POST["mes"];
	for ($i=0;$i<count($me);$i++)    
	{     
	$mes= $me[$i];    
	}


IF ($mes == ""){
$mes = date("m");
}

	$tip=$_POST["tipo"];
	for ($i=0;$i<count($tip);$i++)    
	{     
	$tipo= $tip[$i];    
	}

$buscar_por;

if ($buscar_por == ""){
$buscar_por = "compras";
}

$nro_factura;
$hoy = date("d/m/y");



?>
<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 9px; font-family: Arial, Helvetica, sans-serif; }
.Estilo97 {font-size: 12px}
.Estilo97 {font-family: Arial, Helvetica, sans-serif}
-->
</style>



<table width="686" height="127" border="0">
  <!--DWLayoutTable-->
  <tr valign="middle" bgcolor="#000099">
    <td height="32" colspan="12"><div align="center" class="Estilo97"><span class="Estilo96"><span class="Estilo3">Listado de Facturas Vendidas. Emitidas al: </span><?ECHO $hoy;?></span> </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td width="6%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Fecha</span> </div>
    <td width="13%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">N&ordf; Factura</span> </div>
    <td height="17" colspan="2">    <div align="center"><span class="Estilo6 Estilo2  Estilo5"> </span></div>
    <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Pago</span></div></td>
    <td width="7%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Subtotal</span></div></td>
    <td width="6%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Descuento</span></div></td>
    <td width="7%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Neto Gr </span></div></td>
    <td width="6%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">IVA</span></div></td>
    <td width="8%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Total</span></div></td>
      <td width="5%"><div align="center"><span class="Estilo6"><span class="Estilo6 Estilo2  Estilo5">Detalle</span></span></div></td>
  </tr>
  <?

include ("../../../conexiones/config_grabacion.php");


switch ($mes){
case "01":{
$desde = $anio."-01-01";
$hasta= $anio."-01-31";
	break;
}

case "02":{
$desde = $anio."-02-01";
$hasta= $anio."-02-31";
	break;
}

case "03":{
$desde = $anio."-03-01";
$hasta= $anio."-03-31";
	break;
}

case "04":{
$desde = $anio."-04-01";
$hasta= $anio."-04-31";
	break;
}

case "05":{
$desde = $anio."-05-01";
$hasta= $anio."-05-31";
	break;
}

case "06":{
$desde = $anio."-06-01";
$hasta= $anio."-06-31";
	break;
}

case "07":{
$desde = $anio."-07-01";
$hasta= $anio."-07-31";
	break;
}

case "08":{
$desde = $anio."-08-01";
$hasta= $anio."-08-31";
	break;
}

case "09":{
$desde = $anio."-09-01";
 $hasta= $anio."-09-31";
	break;
}

case "10":{
$desde = $anio."-10-01";
$hasta= $anio."-10-31";
	break;
}


case "11":{
$desde = $anio."-11-01";
$hasta= $anio."-11-31";
	break;

}

case "12":{
$desde = $anio."-12-01";
$hasta= $anio."-12-31";
	break;
}




}



switch ($tipo){
	
	case "TODOS":{
if (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes == 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura'  ORDER by nro_factura, nro_cuenta, nro_cliente, fecha desc, periodo, anio";
}elseif (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
 $sql="select * from ventas_encabezado where  ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor))  ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
  $sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura%' and fecha BETWEEN  '$desde' AND  '$hasta' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and denominacion like '$cliente_proveedor%'  ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";}
}
elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor))  ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and (denominacion like '$cliente_proveedor%') ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc, periodo, anio";
}
	}
	 
	 BREAK;
	}

	case "CREDITO":{
if (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado WHERE cod_operacion = '3' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes == 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura' and cod_operacion = '3' ORDER by nro_factura, nro_cuenta, nro_cliente, fecha desc, periodo, anio";
}elseif (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
 $sql="select * from ventas_encabezado where  ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor))  ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '3' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura%' and fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '3' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '3' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and denominacion like '$cliente_proveedor%'  and cod_operacion = '3' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc,";}
}
elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '3' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and (denominacion like '$cliente_proveedor%') and cod_operacion = '3' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}
	}
	 
	 BREAK;
	}

	case "FACTURAS":{
if (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado WHERE cod_operacion = '1' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes == 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura' and cod_operacion = '1'ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
 $sql="select * from ventas_encabezado where  ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor))  ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '1' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura%' and fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '1' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '1' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}else{
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and denominacion like '$cliente_proveedor%'  and cod_operacion = '1' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";}
}
elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '1' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}else{
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and (denominacion like '$cliente_proveedor%') and cod_operacion = '1' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}
	}
	 
	 BREAK;
	}

case "ANULADA":{
if (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado WHERE cod_operacion = '6' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes == 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura' and cod_operacion = '6' ORDER by nro_factura, nro_cuenta, nro_cliente, fecha desc, periodo, anio";
}elseif (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
 $sql="select * from ventas_encabezado where  ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor))  ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";}
elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '6' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura%' and fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '6' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '6' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and denominacion like '$cliente_proveedor%'  and cod_operacion = '6' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc,";}
}
elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '6' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and (denominacion like '$cliente_proveedor%') and cod_operacion = '6' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}
	}
	 
	 BREAK;
	}

	case "DEBITO":{
if (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado WHERE cod_operacion = '6' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes == 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura' and cod_operacion = '2' ORDER by nro_factura, nro_cuenta, nro_cliente, fecha desc, periodo, anio";
}elseif (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
 $sql="select * from ventas_encabezado where  ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor))  ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '2' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura%' and fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '2' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '2' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and denominacion like '$cliente_proveedor%'  and cod_operacion = '2' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc,";}
}
elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '2' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and (denominacion like '$cliente_proveedor%') and cod_operacion = '2' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}
	}
	 
	 BREAK;
	}

}

$result = $db_pro->Execute($sql);

  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {

$cuent = $cuenta;

$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result->fields["nro_cuenta"]);

if ($nro_cliente != 0){
$cuenta=$nro_cliente;
}elseif ($nro_cuenta != 0){
$cuenta=$nro_cuenta;
}

$nro_factura=strtoupper($result->fields["nro_factura"]);

$denominacion=strtoupper($result->fields["denominacion"]);
$fecha=strtoupper($result->fields["fecha"]);

$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio = substr($fecha,0,4);

$fecha = $dia."-".$mes."-".$anio;

$bruto=strtoupper($result->fields["subtotal"]);

$descuento=strtoupper($result->fields["descuento"]);
$neto_gravado=strtoupper($result->fields["neto_gravado"]);
$iva=strtoupper($result->fields["iva"]);
$retencion=strtoupper($result->fields["retencion"]);
$total=strtoupper($result->fields["total"]);
$periodo=strtoupper($result->fields["periodo"]);
$anio=strtoupper($result->fields["anio"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$cod_operacion=strtoupper($result->fields["cod_operacion"]);
$forma_pago=strtoupper($result->fields["forma_pago"]);





$forma_pago;
SWITCH ($cod_operacion){

case "1":{
$entrada = $precio_renglon;
$movimiento = "FAC";
BREAK;
}

case "2":{
$entrada = $precio_renglon;
$movimiento = "NOTA DE DEBITO";
BREAK;
}

case "3":{
$salida = $precio_renglon;
$movimiento = "NCR";
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
$salida = $precio_renglon;
$movimiento = "FAC";
$denominacion = "ANULADA";
BREAK;
}

}



$total_subtotal = $total_subtotal + $bruto;
$total_descuento = $total_descuento + $descueno;
$total_neto_gravado = $total_neto_gravado + $neto_gravado;
$total_iva = $total_iva + $iva;
$total_facturas = $total_facturas + $total;


if ($bruto == 0.00){
	$bruto = "-";

}else {
$bruto = number_format($bruto,2);
}


if ($iva == 0.00){
	$iva = "-";

}else {
$iva = number_format($iva,2);
}

if ($descuento == 0.00){
	$descuento = "-";

}else {
$descuento = number_format($descuento,2);
}

if ($total == 0.00){
	$total = "-";

}else {
$total = number_format($total,2);
}

if ($retencion == 0.00){
	$retencion = "-";

}else {
$retencion = number_format($retencion,2);
}

 $forma_pago;
$denonominacion = substr($denominacion,0,28);
?>
  <tr bgcolor="#FFFFFF">
    <td><div align="center"><span class="Estilo5"><span class="Estilo2"><?print("$fecha");?></span></span></div></td>
    <td>      <div align="center" class="Estilo5">
        <div align="right"><span class="Estilo2"><?print("$movimiento");?> <?print("$tipo_fact");?> - </span><span class="Estilo5"><span class="Estilo2"><a href="cambiar_numero.php?nro_factura=<?print("$nro_factura");?>&&tipo_fact=<?print("$tipo_fact");?>&&forma_pago=<?print("$forma_pago");?>" target = "central" title = "Presione Aqui si quiere cambiar el numero de Factura" ><font color="#0000FF"><?print("$nro_factura");?></font></a></span></span></div>
    </div></td>
    <td width="1%"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="31%" height="22"><div align="right"></div>      
      <span class="Estilo92"> <?print("$cuenta");?> - 
    <?print("$denominacion");?></span></td>
    <td><div align="center"><span class="Estilo5"><span class="Estilo91"><?print("$forma_pago");?></span></span></div></td>
    <!-- <td><div align="center" class="Estilo6"><span class="Estilo4 Estilo5"><?print("$proveedor");?></span></div></td> -->
    <td><div align="center" class="Estilo5">
      <div align="right"><span class="Estilo89"><?echo $bruto;?> </span></div>
    </div></td>
    <td><div align="center" class="Estilo5">
      <div align="right"><span class="Estilo89"><?echo $descuento;?> </span></div>
    </div></td>
    <td><div align="right"><span class="Estilo5"><span class="Estilo89"><?echo $neto_gravado;?></span></span></div></td>
    <td><div align="right"><span class="Estilo5"><span class="Estilo89"><?echo $iva;?></span></span></div></td>
    <td><div align="center" class="Estilo5">
      <div align="right"><span class="Estilo83"><?echo $total;?> </span></div>
    </div></td>
     <td><div align="center"><font color="#000000" size="2"><a href="detalle_ventas.php?nro_factura=<?print("$nro_factura");?>&&tipo_fact=<?print("$tipo_fact");?>"><img src="../../../imagenes/office//009.ico" alt="Imprimir Detalle" width="17" height="16" border = "0" target= "_top"></a></font></div></td>
  </tr>
  
  <?
$cantidad = $cantidad + 1;
	
	$result->MoveNext();
	}


	?>
	<tr bgcolor="#FFFFFF">
	  <td height="22" colspan="5"><div align="right"><span class="Estilo6">TOTALES</span></div></td>
	  <td><hr noshade></td>
	  <td><hr noshade></td>
	  <td><hr noshade></td>
	  <td><hr noshade></td>
	  <td><hr noshade></td>
	  <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
	<tr bgcolor="#000099">
    <td height="22" colspan="5"><span class="Estilo95"><span class="Estilo93">Total</span></span>      <div align="right" class="Estilo96">
        <div align="right"><span class="Estilo96"></span></div>
      </div></td>
    <td><div align="right" class="Estilo96"><span class="Estilo93"><?echo number_format($total_subtotal,2);?></span></div></td>
    <td><div align="right" class="Estilo96"><span class="Estilo97"><span class="Estilo89"><span class="Estilo93 Estilo96"><?echo number_format($total_descuento,2);?></span></span></span></div></td>
    <td><div align="right" class="Estilo96"><span class="Estilo93"><?echo number_format($total_neto_gravado,2);?></span></div></td>
    <td><div align="right" class="Estilo96"><span class="Estilo93"><?echo number_format($total_iva,2);?></span></div></td>
    <td><div align="right" class="Estilo96"><span class="Estilo93"><?echo number_format($total_facturas,2);?></span></div></td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
</table>
