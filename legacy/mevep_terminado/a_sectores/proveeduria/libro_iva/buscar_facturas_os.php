<html>
<head>
<style type="text/css">
<!--
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo5 {font-size: 12px}
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->

H1.SaltoDePagina
{
PAGE-BREAK-AFTER: always
}

<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 9px; font-family: Arial, Helvetica, sans-serif; }
.Estilo11 {font-size: 12px}
.Estilo11 {font-family: Arial, Helvetica, sans-serif}
.Estilo63 {font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo64 {font-size: 11px}
.Estilo82 {font-size: 10px}
.Estilo83 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo84 {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo85 {font-size: 12px}
.Estilo85 {font-family: Arial, Helvetica, sans-serif}
.Estilo87 {font-size: 12px}
.Estilo87 {font-family: Arial, Helvetica, sans-serif}
-->
</style>





</head>

<body>
<?
$nro_os=$_REQUEST ['nro_os'];
$buscar_po=$_REQUEST ['buscar_por'];
$nro_factura=$_REQUEST ['nro_factura'];
$anio=$_REQUEST ['anio'];
 $cliente_proveedor=$_REQUEST ['cliente_proveedor'];

$hoja=$_REQUEST ['hoja'];
 $registro=$_REQUEST ['registro'];


$ordena=$_POST["ordenar"];
for ($i=0;$i<count($ordena);$i++)    
	{     
	$ordenar = $ordena[$i];    
	}

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

IF ($buscar_por == "totales"){
include ("totales_os.php");
exit;
}

if ($hoja == ""){
$leyenda = "INGRESE Nº DE HOJA";
include ("../../../alertas/campo_informacion.php");
exit;
}

if ($registro == ""){
$leyenda = "INGRESE Nº DE REGISTRO";
include ("../../../alertas/campo_informacion.php");
exit;
}

switch ($mes)
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





<?

$nro_factura;
$hoy = date("d/m/y");



?>

<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">

<table width="1127" height="462" border="0">
  <!--DWLayoutTable-->
  <tr valign="middle" bgcolor="#FFFFFF">
     <td colspan="5" valign="top"><div align="center" class="Estilo67 Estilo72"><strong>ASOCIACION BIOQUIMICA DE MENDOZA </strong></div>       
       <div align="center" class="Estilo69 Estilo73"><strong>_________ <span class="Estilo76">OBRA SOCIAL </span> _______ </strong></div>              <div align="center" class="Estilo71 Estilo23 Estilo11">BELGRANO 925 - 5500 -MENDOZA </div>       <div align="center" class="Estilo71 Estilo23 Estilo11">IVA RESPONSABLE INSCRIPTO </div></td>
     <td colspan="5" valign="top" class="Estilo74 Estilo82"><div align="left" class="Estilo68 "><span class="Estilo75 Estilo84">IVA VENTA</span><BR>
     </div>      
       <span class="Estilo2">CUIT:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 30-54550865-2 <BR>
       ING.  BRUTOS: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EXENTO <BR>
     SEDE DE TIMBRADO: &nbsp;&nbsp;01</span></td>
  </tr>
   <tr valign="middle" bgcolor="#FFFFFF">
     <td colspan="5"><div align="left"><span class="Estilo65"><span class="Estilo64"> <span class="Estilo11 Estilo74"><strong><?ECHO $periodo;?> - <?ECHO $anio;?></strong></span></span> </span></div></td>
     <td colspan="5"><div align="right" class="Estilo22 Estilo73 Estilo2 Estilo82">Registro N&ordm; <?echo $registro;?> <span class="Estilo71 Estilo65"><span class="Estilo71 Estilo23">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>HOJA N&ordm; <?echo $hoja;?> </div></td>
   </tr>
   <tr bgcolor="#FFFFFF">
     <td colspan="10">
   <hr noshade>     </tr>
   <tr bgcolor="#FFFFFF">
     <td width="38"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Fecha</span> </div>
     <td width="199"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Comprobante</span></div>
     <td width="143">
       <div align="center"><span class="Estilo6 Estilo2  Estilo5">Denominaci&oacute;n</span></div>
     <td width="27"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Tipo</span></div></td>
     <td colspan="2"><div align="center"><span class="Estilo6 Estilo2  Estilo5">CUIT</span></div>       <div align="center"></div></td>
     <td width="65"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Importe Gravado</span></div></td>
     <td width="53"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Importe Exento</span></div></td>
     <td width="62"><div align="center"><span class="Estilo6 Estilo2  Estilo5">IVA</span></div></td>
     <td width="303"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Total</span></div></td>
   </tr>
   <tr bgcolor="#FFFFFF">
     <td colspan="10"><hr noshade>             </tr>

	


    <?

include ("../../../conexiones/config_grabacion.php");

if ($anio == ""){
	$anio = '08';
}


$fecha_desde = $anio."-".$mes."01"; 
$fecha_hasta =$anio."-".$mes."31";
$ordenar;
 $sql="select * from factura where fecha BETWEEN '$fecha_desde' and '$fecha_hasta'  and nro_factura < '100000' ORDER by $ordenar";
$result = $db_fa->Execute($sql);

  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


$cuent = $cuenta;

$nro_os=strtoupper($result->fields["nro_os"]);
$tipo_operacion=strtoupper($result->fields["tipo_operacion"]);







$sql1="select * from datos_os where nro_os like '$nro_os'";
$result1 = $db_os->Execute($sql1);
$denominacion=strtoupper($result1->fields["sigla"]);
$cuit=strtoupper($result1->fields["cuit"]);
$inscripcion=strtoupper($result1->fields["inscripcion"]);

switch ($inscripcion) {
	case "1":{
$condicion = "R.I.";
		break;
	}

	case "3":{
$condicion = "MON";
		break;
	}

	case "4":{
$condicion = "EXE";
		break;
	}

	case "0":{
$condicion = "MON";
		break;
	}

}



$contame = $contame +1;

$tipo_fact=strtoupper($result->fields["nro_factura"]);
$nro_factura=strtoupper($result->fields["nro_factura"]);
$nro_factura = "002-000".$nro_factura;

$fecha=strtoupper($result->fields["fecha"]);
$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio = substr($fecha,0,4);
$fecha = $dia."/".$mes."/".$anio;


$iva=strtoupper($result->fields["iva"]);
$total=strtoupper($result->fields["total"]);
$tot = $tot + $total;

 $tipo_fact=strtoupper($result->fields["tipo_fact"]);

 $estado=strtoupper($result->fields["estado"]);

 if ($estado == "ANULADA"){
$denominacion = "ANULADA";
 }

 if ($estado == "ANULADA POR C.A.I."){
$denominacion = "ANULADA POR C.A.I.";
 }





$cod_operacion = 1;

SWITCH ($tipo_operacion){

case "0":{
$entrada = $precio_renglon;
$movimiento = "FAC";
BREAK;
}

case "1":{
$entrada = $precio_renglon;
$movimiento = "FAC";
BREAK;
}


case "2":{
$entrada = $precio_renglon;
$movimiento = "NDB";
BREAK;
}

case "3":{
$salida = $precio_renglon;
$movimiento = "NCR";
$iva = ($iva * -1);
$total= ($total * -1);


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
$movimiento = "ANU";
//$denominacion = "ANULADA";
$condicion = "-";
$cuit= "-";

BREAK;
}

}


/////////////////////cuentas//////////
if (($tipo_fact == "B") or ($tipo_fact == "A") && ($iva == 0.00) && ($tipo_operacion != 6) ) {
$exento = $total;
$neto_gravado = 0.00;
$nro_factura;
$total_exento = $total_exento + $exento;
}else{
	$neto_gravado=$total - $iva;
	$total_neto_gravado = $total_neto_gravado + $neto_gravado;
$exento = 0.00;
}

if ($tipo_operacion != 6){
$total_final = $total_final + $total;
$total_iva = $total_iva + $iva;
}




	if ($iva != 0.00){
if ($neto_gravado == 0.00){
	$neto_gravado = "-";
}else {
$neto_gravado = number_format($neto_gravado,2);
}}
if ($iva == 0.00){
	$iva = "-";
	
}else {
$iva = number_format($iva,2);
}

if ($neto_gravado == 0.00){
	$neto_gravado = "-";
	
}else {
$neto_gravado = $neto_gravado;
}

if ($exento == 0.00){
	$exento = "-";
}else {
$exento = number_format($exento,2);
}
if ($total == 0.00){
	$total = "-";
}else {
$total = number_format($total,2);
}//

if ($tipo_operacion != 3){//nota de credito
?>
<tr bgcolor="#FFFFFF">
     <td class="Estilo63"><span class="Estilo63"><span class="Estilo63"><?print("$fecha");?></span></span><td><span class="Estilo63 Estilo63"><?print("$movimiento");?> <?print("$tipo_fact");?> - <?print("$nro_factura");?></span>
     <td><span class="Estilo63"><?print("$denominacion");?></span>
     <td>      <div align="center" class="Estilo63"><?print("$condicion");?></div></td>
     <td colspan="2"><span class="Estilo63 Estilo63"><span class="Estilo63 Estilo63"><?print("$cuit");?></span></span>       <div align="right" class="Estilo63"></div></td>
     <td><div align="right" class="Estilo63"><span class="Estilo63"><span class="Estilo78"><?echo $neto_gravado;?></span></span></div></td>
     <td><div align="right" class="Estilo63"><span class="Estilo63"><?echo $exento;?></span></div></td>
     <td><div align="right" class="Estilo63"><span class="Estilo63"><span class="Estilo63"><?echo $iva;?></span></span></div></td>
     <td><div align="right" class="Estilo63"><span class="Estilo63"><span class="Estilo63"><?echo $total;?></span></span></div></td>
  </tr>
  
  
  <?}else{

?>
<tr bgcolor="#FFFFFF">
     <td class="Estilo63"><span class="Estilo63"><?print("$fecha");?></span><td><span class="Estilo63 Estilo63"><?print("$movimiento");?> <?print("$tipo_fact");?> - <?print("$nro_factura");?>&nbsp;&nbsp;</span>   
    <td><span class="Estilo63"><?print("$denominacion");?></span>
    <td><div align="center" class="Estilo63"><?print("$condicion");?></div></td>
     <td colspan="2"><span class="Estilo63 Estilo63"><span class="Estilo63 Estilo63"><?print("$cuit");?></span></span>       <div align="right" class="Estilo63"></div></td>
     <td><div align="right" class="Estilo63"><span class="Estilo63"><span class="Estilo63">(<?echo $neto_gravado;?>)</span></span></div></td>
     <td><div align="right" class="Estilo63"><span class="Estilo63">(<?echo $exento;?>)</span></div></td>
     <td><div align="right" class="Estilo63"><span class="Estilo63"><span class="Estilo63">(<?echo $iva;?>)</span></span></div></td>
     <td><div align="right" class="Estilo63"><span class="Estilo63"><span class="Estilo63">(<?echo $total;?>)</span></span></div></td>
  </tr>
  
  
  <?

  }

	  $cont = $cont + 1;
	  if ($cont == 33){
	$hoja = $hoja + 1;	  
		  ?>

	


  <tr valign="middle" bgcolor="#FFFFFF">
     <td colspan="5" valign="top"><div align="center" class="Estilo67 Estilo72"><strong>ASOCIACION BIOQUIMICA DE MENDOZA </strong></div>       
       <div align="center" class="Estilo69 Estilo73"><strong>_________ <span class="Estilo76">OBRA SOCIAL </span> _______ </strong></div>              <div align="center" class="Estilo71 Estilo23 Estilo11">BELGRANO 925 - 5500 -MENDOZA </div>       <div align="center" class="Estilo71 Estilo23 Estilo11">IVA RESPONSABLE INSCRIPTO </div></td>
     <td colspan="5" valign="top" class="Estilo74 Estilo11"><div align="left"><span class="Estilo65"><span class="Estilo68 "><span class="Estilo75 Estilo83">IVA VENTA</span><BR>
     </span></span></div>       
       <span class="Estilo74 Estilo82">CUIT:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 30-54550865-2 <BR>
ING. BRUTOS: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EXENTO <BR>
SEDE DE TIMBRADO: &nbsp;&nbsp;01</span></td>
  </tr>
   <tr valign="middle" bgcolor="#FFFFFF">
     <td colspan="5"><div align="left"><span class="Estilo65"><span class="Estilo64"> <span class="Estilo11 Estilo2 Estilo74"><strong><?ECHO $periodo;?> - <?ECHO $anio;?></strong></span></span> </span></div></td>
     <td colspan="5"><div align="right" class="Estilo22 Estilo73 Estilo2 Estilo82">Registro N&ordm; <?echo $registro;?> <span class="Estilo71 Estilo65"><span class="Estilo71 Estilo23">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>HOJA N&ordm; <?echo $hoja;?> </div></td>
   </tr>
   <tr bgcolor="#FFFFFF">
     <td colspan="10">
   <hr noshade>     </tr>
   <tr bgcolor="#FFFFFF">
     <td width="38"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Fecha</span> </div>
     <td width="199"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Comprobante</span></div>
     <td width="143">
       <div align="center"><span class="Estilo6 Estilo2  Estilo5">Denominaci&oacute;n</span></div>
     <td width="27"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Tipo</span></div></td>
     <td colspan="2"><div align="center"><span class="Estilo6 Estilo2  Estilo5">CUIT</span></div>       <div align="center"></div></td>
     <td width="65"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Importe Gravado</span></div></td>
     <td width="53"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Importe Exento</span></div></td>
     <td width="62"><div align="center"><span class="Estilo6 Estilo2  Estilo5">IVA</span></div></td>
     <td width="303"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Total</span></div></td>
   </tr>
   <tr bgcolor="#FFFFFF">
     <td colspan="10"><hr noshade>             </tr>


	  <?$cont =0;}
	$result->MoveNext();
	}


if ($total_neto_gravado == 0.00){
	$total_neto_gravado = "-";

}else {
$total_neto_gravado = "$".number_format($total_neto_gravado,2);
}


if ($total_iva == 0.00){
	$total_iva = "-";

}else {
$total_iva = "$".number_format($total_iva,2);
}



if ($total_exento == 0.00){
	$total_exento = "-";

}else {
$total_exento = "$".number_format($total_exento,2);
}


if ($total_final == 0.00){
	$total_final = "-";

}else {
$total_final = "$".number_format($total_final,2);
}

$exento =0;
	?>
<tr bgcolor="#FFFFFF">
     <td colspan="6">   
    <td><hr noshade></td>
     <td><hr noshade></td>
     <td><hr noshade></td>
     <td><hr noshade></td>
  </tr>
   <tr bgcolor="#FFFFFF">
     <td colspan="6">         <div align="right"><strong><span class="Estilo85"><strong>TOTALES</strong></span></strong></div>
     <td><div align="right" class="Estilo2 Estilo87"><strong><span class="Estilo87"><?echo $total_neto_gravado;?></span></strong></div></td>
     <td><div align="right" class="Estilo2 Estilo87"><strong><span class="Estilo87"><?echo $total_exento;?></span></strong></div></td>
     <td><div align="right" class="Estilo2 Estilo87"><strong><span class="Estilo87"><?echo $total_iva;?></span></strong></div></td>
     <td><div align="right" class="Estilo2 Estilo87"><strong><?echo $total_final;?></strong></div></td>
   </tr>
   <tr bgcolor="#FFFFFF">
     <td colspan="10">             </tr>
</table>


<?$contame;?>

</body>
</html>
