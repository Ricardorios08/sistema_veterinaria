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

 $sql="select * from pagos where cobrador =  '$cobrador' and mes = $mes_deuda and anio = $anio_deuda and estado = 'PENDIENTE' ORDER BY nro_boleta, socio";
$result = $db->Execute($sql);



$fecha_hoy = date("Y-m-d");




?>
<table width="850" height="58" border="1" cellspacing = "0">
  <!--DWLayoutTable-->
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td height="23" colspan="6"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"> <?php echo $mes_deuda;?> /  <?php echo $anio_deuda;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong> COBRADOR: </strong>&nbsp;</font><font color="#0000FF" size="4" face="Arial, Helvetica, sans-serif"><strong><font color="#FFFFFF"><?php print("$cobrador1");?></font></strong></font><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;</font></div></td>
  </tr>
  
  <tr bordercolor="#FFFFFF" bgcolor="#000099">
    <td width="17" height="16" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">N&deg;</font></div></td>
    <td width="166" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">SOCIO</font></div></td>
    <td width="262" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">MASCOTA</font></div></td>
    <td width="75" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">ACTUAL</font></div></td>
    <td width="83" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">DEUDA</font></div></td>
    <td width="72" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">TOTAL</font></div></td>
  </tr>
 

  <?php 



$anio_actual = date("y");
$mes_actual = date ("m");



  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {


	$fecha_p = $fecha_pago1;

$importe=$result->fields["importe"];
$cod_socio=$result->fields["cod_socio"];

$sql5 = "SELECT * FROM animal WHERE cod_socio = $cod_socio";
$result5 = $db->Execute($sql5);
$nombre_mascota=strtoupper($result5->fields["nombre"]);

$socio=strtoupper($result->fields["socio"]);
$fecha_pago=strtoupper($result->fields["fecha_pago"]);
$fecha_pago1=strtoupper($result->fields["fecha_pago"]);
 $mes_actual=strtoupper($result->fields["mes"]);
 $anio_actual=strtoupper($result->fields["anio"]);

 $mes_1 = $mes_actual;

$mes_1 = str_pad($mes_1, 2, "0", STR_PAD_LEFT);
$mes_actual = str_pad($mes_actual, 2, "0", STR_PAD_LEFT);

$nro_boleta=strtoupper($result->fields["nro_boleta"]);




$sql5 = "SELECT SUM(importe) as deuda FROM pagos WHERE estado LIKE 'PENDIENTE'  and  cod_socio = $cod_socio";
$result5 = $db->Execute($sql5);
$deuda=strtoupper($result5->fields["deuda"]);


 $dia = SUBSTR($fecha_pago,8,2);
 $mes= SUBSTR($fecha_pago,5,2);
 $anio = SUBSTR($fecha_pago,0,4);


 


$fecha_pago = $dia."/".$mes."/".$anio;


 $deuda = $deuda - $importe;

$total = $deuda + $importe;


	$suma_importe = 	$suma_importe + $importe;
    $suma_deuda = 	$suma_deuda + $deuda;


    $suma_total = 	$suma_total + $total;



 
 
$cant = $cant + 1;




?><tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td height="23"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php print("$cod_socio");?></font></div></td>

    <td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php print("$socio");?></font></div></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"><?php print("$nombre_mascota");?></font></td>
    <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo number_format($importe,2);?></font></div></td>

	<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo number_format($deuda,2);?></font></div></td>
	<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo number_format($total,2);?></font></div></td>
	</tr>
 
 
  <?php
      

  if ($pago == "si"){
      
$fecha_pago = date("Y-m-d");
$cod_socio;


  $sql4="select * from pagos where cod_socio = $cod_socio and estado = 'PENDIENTE' order by anio, mes";
 $result4 = $db->Execute($sql4);

  if (!$result4) die("fallo".$db->ErrorMsg());
  while (!$result4->EOF) {

	$cont = $cont + 1;
$anio=$result4->fields["anio"];
$mes=$result4->fields["mes"];
$mes_mostrar = $mes;

switch ($mes){
case "1":{$mes_mostrar = "ENERO";break;}
case "2":{$mes_mostrar = "FEBRERO";break;}
case "3":{$mes_mostrar = "MARZO";break;}
case "4":{$mes_mostrar = "ABRIL";break;}
case "5":{$mes_mostrar = "MAYO";break;}
case "6":{$mes_mostrar = "JUNIO";break;}
case "7":{$mes_mostrar = "JULIO";break;}
case "8":{$mes_mostrar = "AGOSTO";break;}
case "9":{$mes_mostrar = "SEPTIEMBRE";break;}
case "10":{$mes_mostrar = "OCTUBRE";break;}
case "11":{$mes_mostrar = "NOVIEMBRE";break;}
case "12":{$mes_mostrar = "DICIEMBRE";break;}


}

$mes_pagar=$result4->fields["mes"];
$anio_pagar=$result4->fields["anio"];

$importe5=$result4->fields["importe"];
 $cobrador=$result4->fields["cobrador"];
$nro_boleta=$result4->fields["nro_boleta"];


$total_importe5 = $total_importe5 + $importe5;


$dud = $dud." ".$mes_mostrar."/".$anio.";";

  

if ($cont == 9){
	$cont = 0;
}



$result4->MoveNext();
	}

$total_importe5 = "";






  }

if ($pago == "si"){
?>
<tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td height="23" colspan="6" valign="top" bgcolor="#FFCC99"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php print("$dud");?></font></div></td>
  </tr>

<?php
}


$dud = "";


	 $entrada = "";
	$salida = "";
	$saldo = "";
$result->MoveNext();
	}
  
  ?>

  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
    <td height="25" colspan="3"><div align="right"><strong><font size="4" face="Arial, Helvetica, sans-serif">TOTALES POR <?php echo $cant;?> BOLETAS</font></strong></div>      <div align="right"><font size="2"> </font></div></td>
    <td><div align="right"> <div align="right"><?php echo number_format($suma_importe,2);?></font> </div></td>
    <td><div align="right"><?php echo number_format($suma_deuda,2);?></div></td>
    <td><div align="right"><?php echo number_format($suma_total,2);?></div></td>
  </tr>

   <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
    <td height="25" colspan="6"><div align="right"><strong><font size="4" face="Arial, Helvetica, sans-serif"><?php echo number_format($neto,2);?>NETO A PAGAR</font></strong></div>      <div align="right"><font size="2"> </font></div></td>
  </tr>
</table>
