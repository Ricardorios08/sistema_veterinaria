<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
}
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
.Estilo100 {font-size: 10px}
.Estilo102 {font-family: Arial, Helvetica, sans-serif; font-size: 9px; }
-->
</style>
<A HREF="imp_pendientes.php?a='imprimir'&&buscar_por=<?print("$buscar_por");?>&&nro_factura=<?print("$nro_factura");?>&&mes=<?print("$mes");?>&&anio=<?print("$anio");?>"><IMG SRC="../../../imagenes/botones//btn_imprimir.gif" alt="Imprimir" border = "0"></A> 

<!-- 
<a href="imp_pendientes.php?a='excel'&&buscar_por=<?print("$buscar_por");?>"><IMG SRC="../../imagenes/botones//btn_exportar.gif" alt="Exportar" border = "0"></a> -->





<?

$nro_factura;
$hoy = date("d/m/y");



?>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo4 {font-size: 9px}
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 9px; font-family: Arial, Helvetica, sans-serif; }
.Estilo8 {
	font-family: Arial, Helvetica, sans-serif;
	color: #0000CC;
	font-weight: bold;
}
-->
</style>



<table width="109%" height="127" border="0">
  <!--DWLayoutTable-->
  <tr valign="middle" bgcolor="#000099">
    <td height="32" colspan="12"><div align="center"><span class="Estilo5"><span class="Estilo1"><span class="Estilo3">Listado de Facturas Vendidas en Proveeduria. Emitidas al: </span><?ECHO $hoy;?></span> </span></div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Fecha</span> </div>
    <td width="13%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">N&ordf; Factura</span> </div>
    <td height="17" colspan="2">    <div align="center"><span class="Estilo6 Estilo2  Estilo5"> </span></div>
    <td width="6%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Pago</span></div></td>
    <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Bruto</span></div></td>
    <td width="8%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Descuento</span></div></td>
    <td width="7%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Neto Gr </span></div></td>
    <td width="9%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">IVA</span></div></td>
    <td width="8%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Total</span></div></td>
    <td width="12%"><div align="center" class="Estilo6 Estilo2 Estilo100"><span class="Estilo6 Estilo5  Estilo2"><span class="Estilo102">Factura/</span></span><span class="Estilo102">Detalle/</span><span class="Estilo6"><span class="Estilo6 Estilo2 Estilo100">Borrar</span></span></div>      </td>
  </tr>
  <?

include ("../../../conexiones/config_pro.php");

if ($anio == ""){
	$anio = '08';
}

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
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura'  ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
 $sql="select * from ventas_encabezado where  ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura%' and fecha BETWEEN  '$desde' AND  '$hasta' ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}else{
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and denominacion like '$cliente_proveedor%'  ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";}
}
elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor))  ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
}else{
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and (denominacion like '$cliente_proveedor%') ORDER by nro_factura , nro_cuenta, nro_cliente, fecha desc";
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
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura' and cod_operacion = '1' ORDER by nro_factura, nro_cuenta, nro_cliente, fecha desc, periodo, anio";
}elseif (($mes == 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
 $sql="select * from ventas_encabezado where  ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor))  ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor == "")){
 $sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '1' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor == "")){
$sql="select * from ventas_encabezado where nro_factura like '$nro_factura%' and fecha BETWEEN  '$desde' AND  '$hasta' and cod_operacion = '1' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}elseif (($mes != 13) && ($nro_factura != "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '1' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where (nro_factura = '$nro_factura' or nro_factura = '$nro_factura' or fecha = '$nro_factura') and fecha BETWEEN  '$desde' AND  '$hasta' and denominacion like '$cliente_proveedor%'  and cod_operacion = '1' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc,";}
}
elseif (($mes != 13) && ($nro_factura == "") && ($cliente_proveedor != "")){
if (is_numeric($cliente_proveedor)==true) {
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and ((nro_cuenta = $cliente_proveedor) or (nro_cliente = $cliente_proveedor)) and cod_operacion = '1' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
}else{
$sql="select * from ventas_encabezado where fecha BETWEEN  '$desde' AND  '$hasta' and (denominacion like '$cliente_proveedor%') and cod_operacion = '1' ORDER by nro_cuenta, nro_cliente, nro_factura, fecha desc";
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

$result = $db->Execute($sql);

  if (!$result) die("fallo".$db->ErrorMsg());
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

$bruto=strtoupper($result->fields["bruto"]);

$descuento=strtoupper($result->fields["descuento"]);
$neto_gravado=strtoupper($result->fields["neto_gravado"]);
$iva=strtoupper($result->fields["iva"]);
$retencion=strtoupper($result->fields["retencion"]);
$total=strtoupper($result->fields["neto"]);
$periodo=strtoupper($result->fields["periodo"]);
$anio=strtoupper($result->fields["anio"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$cod_operacion=strtoupper($result->fields["cod_operacion"]);
$forma_pago=strtoupper($result->fields["forma_pago"]);



$denominacion = substr($denominacion,0,24);

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
  <tr>
    <td><div align="center"><span class="Estilo5"><span class="Estilo2"><?print("$fecha");?></span></span></div></td>
    <td>      <div align="center" class="Estilo5">
        <div align="right"><span class="Estilo2"><?print("$movimiento");?> <?print("$tipo_fact");?> - </span><span class="Estilo5"><span class="Estilo2"><a href="cambiar_numero.php?nro_factura=<?print("$nro_factura");?>&&tipo_fact=<?print("$tipo_fact");?>&&forma_pago=<?print("$forma_pago");?>" target = "central" title = "Presione Aqui si quiere cambiar el numero de Factura" ><font color="#0000FF"><?print("$nro_factura");?></font></a></span></span></div>
      </div></td>
    <td width="1%"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="26%" height="22"><div align="right"></div>      
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
    <td>
      <div align="center" class="Estilo6"><font color="#000000" size="2"><a href="../buscar/factura_papel.php?tipo_fact=<?print("$tipo_fact");?>&&nro_factura=<?print("$nro_factura");?>&&sigla=<?print("$sigla");?>&&cant_bioq=<?print("$cant_bioq");?>&&cant_ordenes=<?print("$cant_ordenes");?>&&fecha=<?print("$fecha");?>&&total=<?print("$total");?>&&iva=<?print("$iva");?>"><img src="../../../imagenes/office//330.ico" alt="Imprimir" width="18" height="16" border = "0" target= "_top"></a></font> <font color="#000000" size="2"><a href="detalle_ventas.php?nro_factura=<?print("$nro_factura");?>"><img src="../../../imagenes/office//009.ico" alt="Imprimir Detalle" width="17" height="16" border = "0" target= "_top"></a></font><font color="#000000" size="2"><a href="../borrar_anular/clave.php?nro_factura=<?print("$nro_factura");?>&&tipo_fact=<?print("$tipo_fact");?>"> <img src="../../../imagenes/office//1047.ico" alt="Imprimir Detalle" width="17" height="16" border = "0" target= "_top"></a></font></div>      </td>
  </tr>
  
  <?
$cantidad = $cantidad + 1;
		  $total_facturas = $total_facturas + $total;
	$result->MoveNext();
	}


	?>

	<tr>
	  <td height="22" colspan="11"><hr noshade></td>
  </tr>
	<tr bgcolor="#000099">
    <td height="22" colspan="4"><span class="Estilo95">Cantidad de Comprobantes: <?echo $cantidad;?></span></td>
    <td colspan="7"><div align="right" class="Estilo96">
      <div align="right"><span class="Estilo93">Total: $ <?echo number_format($total_facturas,2);?></span><span class="Estilo96"></span></div>
    </div>      </td>
  </tr>

</table>
