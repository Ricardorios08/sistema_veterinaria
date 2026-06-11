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

$ordena=$_POST["ordenar"];
for ($i=0;$i<count($ordena);$i++)    
	{     
	$ordenar = $ordena[$i];    
	}

	$me=$_POST["mes"];
	for ($i=0;$i<count($me);$i++)    
	{     
	$mes= $me[$i];    
	}

if ($ordenar == "factura"){
	$ordenar = "nro_factura";
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


$perio = $periodo;
$hoy = date("d/m/y");

?>

<style type="text/css">
<!--
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo5 {font-size: 12px}
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo3 {font-size: 14px}
-->
</style>



<?

$nro_factura;
$hoy = date("d/m/y");



?>
<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 9px; font-family: Arial, Helvetica, sans-serif; }
.Estilo15 {font-size: 12px}
.Estilo15 {font-family: Arial, Helvetica, sans-serif}
.Estilo16 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo16 {font-size: 9px; font-family: Arial, Helvetica, sans-serif; }
.Estilo17 {font-size: 12px}
.Estilo17 {font-family: Arial, Helvetica, sans-serif}
.Estilo18 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo18 {font-size: 9px; font-family: Arial, Helvetica, sans-serif; }
.Estilo22 {font-size: 10px; font-family: Arial, Helvetica, sans-serif; }
.Estilo23 {font-size: 10px}
.Estilo28 {font-size: 12px}
.Estilo28 {font-family: Arial, Helvetica, sans-serif}
.Estilo62 {font-size: 12px}
.Estilo62 {font-family: Arial, Helvetica, sans-serif}
.Estilo64 {	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo64 {	color: #000000;
	font-weight: bold;
}
.Estilo65 {font-size: 12px}
.Estilo65 {font-family: Arial, Helvetica, sans-serif}
.Estilo66 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo66 {font-size: 9px; font-family: Arial, Helvetica, sans-serif; }
-->
</style>

 <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">

 <table width="104%" height="363" border="0">
   <!--DWLayoutTable-->
   <tr valign="middle" bgcolor="#FFFFFF">
     <td height="32" colspan="12"><div align="center" class="Estilo62"><strong>ASOCIACION BIOQUIMICA DE MENDOZA </strong></div></td>
   </tr>
   <tr valign="middle" bgcolor="#FFFFFF">
     <td height="32" colspan="12"><div align="center"><span class="Estilo65"><span class="Estilo64"><span class="Estilo3">LIBRO IVA VENTAS PROVEEDURIA PERIODO: </span><?ECHO $perio;?> - <?ECHO $anio;?></span> </span></div></td>
   </tr>
   <tr bgcolor="#FFFFFF">
     <td height="17" colspan="11">
       <hr noshade>
   </tr>
   <tr bgcolor="#FFFFFF">
     <td width="6%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Fecha</span> </div>
     <td width="17%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Comprobante</span></div>
     <td width="23%" height="17">
       <div align="center"><span class="Estilo6 Estilo2  Estilo5">Denominaci&oacute;n</span></div>
     <td width="4%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Tipo</span></div></td>
     <td width="8%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">CUIT</span></div></td>
     <td width="7%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Resp. Inscrip </span></div></td>
     <td width="6%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Monotributo</span></div></td>
     <td width="7%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Exento</span></div></td>
     <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">IVA R.I </span></div></td>
     <td width="8%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">IVA Mon. </span></div></td>
     <td width="9%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Total</span></div></td>
   </tr>
   <tr>
     <td height="22" colspan="11"><hr noshade></td>
   </tr>
   <tr>
     <?

include ("../../../conexiones/config_grabacion.php");

if ($anio == ""){
	$anio = '08';
}


$fecha_desde = $anio."-".$mes."-01"; 
$fecha_hasta =$anio."-".$mes."-31";

 $sql="select * from ventas_encabezado where fecha BETWEEN '$fecha_desde' and '$fecha_hasta' ORDER by $ordenar";

//echo $sql="select * from ventas_encabezado where fecha BETWEEN '$fecha_desde' and '$fecha_hasta' and iva > 0 ORDER by $ordenar";


$result = $db_pro->Execute($sql);

  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


$cuent = $cuenta;

$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result->fields["nro_cuenta"]);
$contame = $contame +1;

$cod_operacion=strtoupper($result->fields["cod_operacion"]);

if ($cod_operacion == 6){
	$cuit = "";
}
$nro_factura=strtoupper($result->fields["nro_factura"]);
$nro_factura = "0001-000".$nro_factura;
$denominacion=strtoupper($result->fields["denominacion"]);
$denominacion=substr($denominacion,0,25);

$fecha=strtoupper($result->fields["fecha"]);
$tipo_iva=strtoupper($result->fields["tipo_iva"]);


switch ($tipo_iva) {
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



$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio = substr($fecha,0,4);

$fecha = $dia."/".$mes."/".$anio;
$bruto=strtoupper($result->fields["bruto"]);
$descuento=strtoupper($result->fields["descuento"]);
$iva=strtoupper($result->fields["iva"]);
//$neto_gravado=strtoupper($result->fields["neto_gravado"]);

$total=($result->fields["neto"]);
$neto_gravado =strtoupper($result->fields["neto_gravado"]);

////////////////////////
/*
$nt = round(($neto_gravado * 0.21),2);

$a = $nt - $iva;

if ($a > 1){
	echo "-------------------------".$nro_factura;

	echo "<br>";
}

*/

///////////////


$net = round($neto_gravado + $iva,2);




//$neto_gravado = $neto_gravado + $descuento;
if ($cod_operacion == 3){
$nota = $nota + $total;

}else{

 $total_final = $total_final + $total;
}

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
$condicion = " - ";
BREAK;
}

}


SWITCH ($tipo_iva){

case "1":{ //respo ins

$neto_gravado_ri = $neto_gravado;

if ($cod_operacion == 3){ // nc
// muestra el importe de la nc
$neto_nc = $neto_gravado_ri;
$iva_nc =  $iva;
////////////////////////////////
// acumula el importe NC
$nc_ri= $nc_ri + $neto_nc;
$nc_iva_ri = $nc_iva_ri + $iva;
///////////////////////////////

}else{

$total_neto_gravado_ri = $total_neto_gravado_ri + $neto_gravado_ri;
$iva_ri = $iva;
$total_iva_ri = $total_iva_ri + $iva_ri;
$acumula_fact_ri = $acumula_fact_ri + $neto_gravado_ri;
$acumula_iva_ri = $acumula_iva_ri + $iva_ri;
$total_final_ri = $total_final_ri + $neto_gravado_ri;}

BREAK;
}





case "4":{ //EXENTOS
	
/////////////
if ($cod_operacion == 3){
	//muestra el valor
$neto_gravado_ex = $neto_gravado;
$ex_nc= $neto_gravado_ex;
/////////////////////////// acumula exento
$nc_ex = $nc_ex + $neto_gravado;

}else{

$neto_gravado_ex = $neto_gravado;
$total_final_ex = $total_final_ex + $neto_gravado_ex;
$acumula_fact_ex = $acumula_fact_ex + $neto_gravado_ex;

}
BREAK;
}

case "3":{ //monotributit

	if ($cod_operacion == 3){
// muestra el importe de la nc
$iva_mon_nc = $iva;
$mon_nc = $neto_gravado;
////////////////////////////////
// acumula el importe NC
$nc_mon = $nc_mon + $neto_gravado;
$nc_iva_mon = $nc_iva_mon + $iva;
	}
else{
	$neto_gravado_mon = $neto_gravado;
$total_neto_gravado_mon = $total_neto_gravado_mon + $neto_gravado;
$iva_mon = $iva;
$total_iva_mon = $total_iva_mon + $iva_mon;
$total_final_mon = $total_final_mon + $neto_gravado_mon;

$acumula_fact_mon = $acumula_fact_mon + $neto_gravado_mon;
$acumula_iva_mon = $acumula_iva_mon + $iva_mon;


}
BREAK;
}


}




if ($neto_gravado_ri == 0.00){
	$neto_gravado_ri = "-";

}else {
$neto_gravado_ri = "$".number_format($neto_gravado_ri,2);
}


if ($neto_gravado_ex == 0.00){
	$neto_gravado_ex = "-";

}else {
$neto_gravado_ex = "$".number_format($neto_gravado_ex,2);
}

if ($neto_gravado_mon == 0.00){
	$neto_gravado_mon = "-";

}else {
$neto_gravado_mon = "$".number_format($neto_gravado_mon,2);
}

if ($iva_ri == 0.00){
	$iva_ri = "-";

}else {
$iva_ri = "$".number_format($iva_ri,2);
}

if ($iva_mon == 0.00){
	$iva_mon = "-";

}else {
$iva_mon = "$".number_format($iva_mon,2);
}


if ($total == 0.00){
	$total = "-";

}else {
$total = "$".number_format($total,2);
}





?>
     <td><div align="center"><span class="Estilo65"><span class="Estilo22"><?print("$fecha");?></span></span></div></td>
     <td>
       <div align="center" class="Estilo5 Estilo23">
         <div align="left">
           <div align="center"><?print("$movimiento");?> <?print("$tipo_fact");?> - <?print("$nro_factura");?></div>
         </div>
     </div></td>
     <td height="20"><div align="left" class="Estilo23"> <?print("$denominacion");?></div></td>
     <td><div align="center" class="Estilo23"><span class="Estilo22"><?print("$condicion");?></span>
         
     </div></td>
     <td><div align="center" class="Estilo22"><?print("$cuit");?></div></td>
     <!-- <td><div align="center" class="Estilo6"><span class="Estilo4 Estilo5"><?print("$proveedor");?></span></div></td> -->
     <? if ($cod_operacion == 3){?>
     <td><div align="right" class="Estilo22">
       <div align="right">(-<?echo $neto_nc;?>)</div>
     </div></td>
     <td><div align="right" class="Estilo23">
       <div align="right" class="Estilo23">(-<?echo $mon_nc;?>)</div>
     </div></td>
     <td><div align="right" class="Estilo23">
       <div align="right" class="Estilo22">(-<?echo $ex_nc;?>)</div>
     </div></td>
     <td><div align="right" class="Estilo22">
       <div align="right">(-<?echo $iva_nc;?>)</div>
     </div></td>
     <td><div align="right" class="Estilo22">
       <div align="right" class="Estilo22">(-<?echo $iva_mon_nc;?>)</div>
     </div></td>
     <td><div align="right" class="Estilo22">
       <div align="right">(-<?echo $total;?>)</div>
     </div></td>
     <?}else{?>
     <td><div align="right" class="Estilo22">
       <div align="right"><?echo $neto_gravado_ri;?></div>
     </div></td>
     <td><div align="right" class="Estilo22"><?echo $neto_gravado_mon;?></div></td>
     <td><div align="right" class="Estilo22">
       <div align="right"><?echo $neto_gravado_ex;?></div>
     </div></td>
     <td><div align="right" class="Estilo22">
       <div align="right"><?echo $iva_ri;?></div>
     </div></td>
     <td><div align="right" class="Estilo22"><?echo $iva_mon;?></div></td>
     <td><div align="right" class="Estilo22"><?echo $total;?></div></td>
     <?}?>
   </tr>
   <?$neto_gravado_ri= "";
$neto_gravado_mon= "";
$neto_gravado_ex= "";
$iva_ri= "";
$iva_mon= "";
$total = "";
$neto_nc = "";
$iva_nc = "";
$iva_mon_nc = "";
$mon_nc = "";
$ex_nc = "";

//$condicion = "";  

$cont = $cont +1;

if ($cont == 23){
?>
   <tr valign="middle" bgcolor="#FFFFFF">
     <td height="32" colspan="12"><div align="center" class="Estilo62"><strong>ASOCIACION BIOQUIMICA DE MENDOZA </strong></div></td>
   </tr>
   <tr valign="middle" bgcolor="#FFFFFF">
     <td height="32" colspan="12"><div align="center"><span class="Estilo65"><span class="Estilo64"><span class="Estilo3">LIBRO IVA VENTAS PROVEEDURIA PERIODO: </span><?ECHO $perio;?> - <?ECHO $anio;?></span> </span></div></td>
   </tr>
   <tr bgcolor="#FFFFFF">
     <td height="17" colspan="11">
       <hr noshade>
   </tr>
   <tr bgcolor="#FFFFFF">
     <td width="6%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Fecha</span> </div>
     <td width="17%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Comprobante</span></div>
     <td width="23%" height="17">
       <div align="center"><span class="Estilo6 Estilo2  Estilo5">Denominaci&oacute;n</span></div>
     <td width="4%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Tipo</span></div></td>
     <td width="8%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">CUIT</span></div></td>
     <td width="7%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Resp. Inscrip </span></div></td>
     <td width="6%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Monotributo</span></div></td>
     <td width="7%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Exento</span></div></td>
     <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">IVA R.I </span></div></td>
     <td width="8%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">IVA Mon. </span></div></td>
     <td width="9%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Total</span></div></td>
   </tr>
   <tr>
     <td height="25" colspan="11"><hr noshade></td>
   </tr>
   <tr>
     <?
$cont = 0;

}
	$result->MoveNext();
	}

	$condicion = "";  

$cuit = "";
$tipo = "";



$total_final_ri = $total_final_ri - $nc_ri;

$total_final_mon = $total_final_mon - $nc_mon;
$total_final_ex = $total_final_ex - $nc_ex;

$total_iva_ri = $total_iva_ri - $nc_iva_ri;
$total_iva_mon = $total_iva_mon - $nc_iva_mon;

$total_fin = $total_final - $nota;


$suma_totales= $total_final_ri + $total_final_mon + $total_final_ex + $total_iva_mon + $total_iva_ri;
$diferencia = number_format($suma_totales - $total_fin,2);



if ($total_final_ri == 0.00){
	$total_final_ri = "-";

}else {
$total_final_ri = "$".number_format($total_final_ri,2);
}


if ($total_final_mon == 0.00){
	$total_final_mon = "-";

}else {
$total_final_mon = "$".number_format($total_final_mon,2);
}

if ($total_final_ex == 0.00){
	$total_final_ex = "-";

}else {
$total_final_ex = "$".number_format($total_final_ex,2);
}

if ($total_iva_ri == 0.00){
	$total_iva_ri = "-";

}else {
$total_iva_ri = "$".number_format($total_iva_ri,2);
}

if ($total_iva_mon == 0.00){
	$total_iva_mon = "-";

}else {
$total_iva_mon = "$".number_format($total_iva_mon,2);
}

if ($total_final == 0.00){
	$total_final = "-";

}else {
$total_final = "$".number_format($total_final,2);
}



$total_nc = $nc_ri + $nc_mon + $nc_ex + $nc_iva_ri + $nc_iva_mon;
$total_fa = $acumula_fact_ri+ $acumula_fact_mon + $acumula_fact_ex + $acumula_iva_ri + $acumula_iva_mon;


	?>
   <tr>
     <td height="22" colspan="5"><!--DWLayoutEmptyCell-->&nbsp;</td>
     <td><hr noshade></td>
     <td><div align="center">
         <hr noshade>
     </div></td>
     <td><div align="center">
         <hr noshade>
     </div></td>
     <td><hr noshade></td>
     <td><hr noshade></td>
     <td><hr noshade></td>
   </tr>
   <tr>
     <td height="22" colspan="5"><div align="right" class="Estilo62"><strong>TOTALES</strong></div></td>
     <td class="Estilo62"><div class="Estilo65"><strong><span class="Estilo66"><?echo $total_final_ri;?></span></strong></div></td>
     <td class="Estilo62"><div align="right"><span class="Estilo17"><strong><span class="Estilo18"><?echo $total_final_mon;?></span></strong></span></div></td>
     <td class="Estilo62"><div align="right"><strong><span class="Estilo15"><span class="Estilo16"><?echo $total_final_ex;?></span></span></strong></div></td>
     <td class="Estilo62"><div align="right" class="Estilo65"><strong><span class="Estilo66"><?echo $total_iva_ri;?></span></strong></div></td>
     <td class="Estilo62"><div align="right"><strong><span class="Estilo65"><span class="Estilo66"><?echo $total_iva_mon;?></span></span></strong></div></td>
     <td class="Estilo62"><div align="right" class="Estilo66"><strong><?echo $total_fin;?></strong></div></td>
   </tr>
 </table>
 <BR>
 <HR><BR>
<table width="783" border="1" class="Estilo64">
  <tr>
    <td width="63">&nbsp;</td>
    <td width="97"><div align="center" class="Estilo22 Estilo23">NETO GRAVADO RESP. INSCRIPTO </div></td>
    <td width="129"><div align="center" class="Estilo22">NETO GRAVADO MONOTRIBUTO</div></td>
    <td width="116"><div align="center" class="Estilo22">NETO GRAVADO EXENTO </div></td>
    <td width="100"><div align="center" class="Estilo22">IVA RESP. INSCRIPTO </div></td>
    <td width="111"><div align="center" class="Estilo22">IVA MONOTRIBUTO </div></td>
    <td width="137"><div align="center" class="Estilo22">TOTAL </div></td>
  </tr>
  <tr>
    <td colspan="7"><HR noshade></td>
  </tr>
  <tr>
    <td><div align="center" class="Estilo66"><span class="Estilo65">FACTURAS</span></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $acumula_fact_ri;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $acumula_fact_mon;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $acumula_fact_ex;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $acumula_iva_ri;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $acumula_iva_mon;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $total_fa;?></strong></div></td>
  </tr>
  <tr>
    <td><div align="center" class="Estilo66"><span class="Estilo65">N/CREDITOS</span></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $nc_ri;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $nc_mon;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $nc_ex;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $nc_iva_ri;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $nc_iva_mon;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $total_nc;?></strong></div></td>
  </tr>
  <tr>
    <td><div align="center" class="Estilo66"><span class="Estilo65">N/DEBITOS</span></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><hr align="center" noshade class="Estilo28"></td>
  </tr>
  <tr>
    <td><div align="center" class="Estilo66"><span class="Estilo65">TOTALES</span></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $total_final_ri;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $total_final_mon;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $total_final_ex;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $total_iva_ri;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $total_iva_mon;?></strong></div></td>
    <td><div align="center" class="Estilo66"><strong><?echo $total_fin;?></strong></div></td>
  </tr>
</table>


<?



?>
<table width="571" border="0">
  <tr>
    <td width="317">&nbsp;</td>
    <td width="244">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">REVISAR DIFERENCIA</div></td>
    <td><span class="Estilo66"><strong><?echo $diferencia;?></strong></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
 