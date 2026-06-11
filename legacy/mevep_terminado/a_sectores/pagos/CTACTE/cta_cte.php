 <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 
 
 <?php
 


global $buscador_rapido;
include("../../../conexiones/config.inc.php");




$hoy = date("d/m/Y");
$B = 1;


$cobrado=$_POST["cobrador"];
for ($i=0;$i<count($cobrado);$i++)    
{     
$cobrador = $cobrado[$i];    
}

 
  $sql11="select *  from cobradores where cod_cobrador = $cobrador";
$result11 = $db->Execute($sql11);

$nombre_cobrador=strtoupper($result11->fields["nombre_cobrador"]);

$cobrador1 = $cobrador." - ".$nombre_cobrador;



if ($dia_desde == ""){
$dia_desde = 0000-00-00;
}
if ($dia_hasta == ""){
$dia_hasta = date("Y-m-d");
}


/*$sql = "SELECT SUM(importe) as facturas FROM `resumen_cta_vta` WHERE cuenta = '$palabra'  AND ((cod_movimiento = 1) or (cod_movimiento = 2)) AND fecha < '$dia_desde'";
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

*/

 $sql="select * from pagos where cobrador =  '$cobrador' and fecha_pago BETWEEN '$dia_desde' and '$dia_hasta' and estado = 'PAGADO' ORDER BY fecha_pago, nro_boleta";
$result = $db->Execute($sql);



$fecha_hoy = date("Y-m-d");




?>
<table width="850" height="58" border="1" cellspacing = "0">
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td colspan="13"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong> </strong>Desde el: <?echo $dia_desde1;?> Hasta el: <?echo $dia_hasta1;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>PORCENTAJES COBRADOR</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="14"><div align="right"><font color="#000000" face="Arial, Helvetica, sans-serif">Impreso el: <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="10"><div align="center"><font color="#0000FF" size="4" face="Arial, Helvetica, sans-serif"><strong>  <?print("$cobrador1");?></strong></font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">
    <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">N&deg;</font></div></td>
    <td width="22%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PERIODO</font></div></td>

	<td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA PAGO </font></div></td>
    <td width="31%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SOCIO</font></div></td>
    <td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">Nº BOLETA</font></div></td>



    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">IMPORTE</font></div></td>
    <td colspan="2"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">COMISION</font></div></td>
  </tr>
 

  <?



$anio_actual = date("y");
$mes_actual = date ("m");



  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {


	$fecha_p = $fecha_pago1;

 $importe=$result->fields["importe"];
$cod_socio=$result->fields["cod_socio"];
$socio=strtoupper($result->fields["socio"]);
$fecha_pago=strtoupper($result->fields["fecha_pago"]);
$fecha_pago1=strtoupper($result->fields["fecha_pago"]);
 $mes_actual=strtoupper($result->fields["mes"]);
 $anio_actual=strtoupper($result->fields["anio"]);

 $mes_1 = $mes_actual;

$mes_1 = str_pad($mes_1, 2, "0", STR_PAD_LEFT);
$mes_actual = str_pad($mes_actual, 2, "0", STR_PAD_LEFT);

$nro_boleta=strtoupper($result->fields["nro_boleta"]);



  $sql1="select * from cobradores where cod_cobrador = '$cobrador'";
$result1 = $db->Execute($sql1);
$plan=$result1->fields["plan"];




 $sql1="select * from plan_cobrador where cod_plan = '$plan'";
$result1 = $db->Execute($sql1);

$a1_10=$result1->fields["1_10"];
$a11_20=$result1->fields["11_20"];
$a21_31=$result1->fields["21_31"];
$deuda=$result1->fields["deuda"];






 $dia = SUBSTR($fecha_pago,8,2);
 $mes= SUBSTR($fecha_pago,5,2);
 $anio = SUBSTR($fecha_pago,0,4);


 


if ($mes == $mes_1){
if (($dia > 0) and ($dia < 11)){
 $comision = $importe * $a1_10/100;
}elseif (($dia > 10) and ($dia < 21)){
 $comision = $importe * $a11_20/100;
}elseif (($dia > 20) and ($dia < 32)){
 $comision = $importe * $a21_31/100;
}
}
else{
 $comision = $importe * $deuda/100;

 IF ($plan == 4){
 
if (($dia > 0) and ($dia < 11)){
$comision = $importe * $a1_10/100;
}elseif (($dia > 10) and ($dia < 21)){
 $comision = $importe * $a11_20/100;
}elseif (($dia > 20) and ($dia < 32)){
 $comision = $importe * $a21_31/100;
}


 }

}


$fecha_pago = $dia."/".$mes."/".$anio;


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

 
	$suma_salida = 	$suma_salida + $importe;

 	$suma_comision =  $suma_comision + $comision;



 
$total_dia = $total_dia + $comision;

 
 
$cant = $cant + 1;


switch ($mes_actual){
case "01":{$mes_periodo = "ENERO";break;}
case "02":{$mes_periodo = "FEBRERO";break;}
case "03":{$mes_periodo = "MARZO";break;}
case "04":{$mes_periodo = "ABRIL";break;}
case "05":{$mes_periodo = "MAYO";break;}
case "06":{$mes_periodo = "JUNIO";break;}
case "07":{$mes_periodo = "JULIO";break;}
case "08":{$mes_periodo = "AGOSTO";break;}
case "09":{$mes_periodo = "SETIEMBRE";break;}
case "10":{$mes_periodo = "OCTUBRE";break;}
case "11":{$mes_periodo = "NOVIEMBRE";break;}
case "12":{$mes_periodo = "DICIEMBRE";break;}
}

	if ($B == 1) {

?><tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cod_socio");?></font></div></td>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$mes_periodo");?></font>  <font size="2" face="Arial, Helvetica, sans-serif"><?print("$anio_actual");?></font></div></td> 
    <?

			}





		?>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$fecha_pago");?></font></div></td>
    <td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$socio");?></font></div></td>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$nro_boleta");?></font></div></td>

<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $importe;?></font></div></td>

	<td width="9%"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $comision;?></font></div></td>
 
  </tr>
 
  <?php if ($band != "1"){
      
  
  if ($fecha_pago1 != $fecha_p){?>
 <!--  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
    <td colspan="7"><div align="right"><font size="2" face="Trebuchet MS">TOTAL X DIA </font></div>      <div align="right"></div></td>
    <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?echo number_format($total_dia,2);?></font></div></td>
  </tr> -->
  
 
  
<?
$total_dia = "";	
}
  }


$neto = $suma_salida - $suma_comision;

	 $entrada = "";
	$salida = "";
	$saldo = "";
$result->MoveNext();
	}
  
  ?>

  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
    <td colspan="5"><div align="right"><strong><font size="4" face="Arial, Helvetica, sans-serif">TOTALES POR <?echo $cant;?> BOLETAS</font></strong></div>      <div align="right"><font size="2"> </font></div></td>
    <td><div align="right"> <?echo number_format($suma_salida,2);?></font> </td>
    <td><div align="right"><?echo number_format($suma_comision,2);?></td>
 
  </tr>

   <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
    <td colspan="6"><div align="right"><strong><font size="4" face="Arial, Helvetica, sans-serif">NETO A PAGAR</font></strong></div>      <div align="right"><font size="2"> </font></div></td>
    <td><div align="right"><?echo number_format($neto,2);?></div></td>
    
 
  </tr>

</table>
