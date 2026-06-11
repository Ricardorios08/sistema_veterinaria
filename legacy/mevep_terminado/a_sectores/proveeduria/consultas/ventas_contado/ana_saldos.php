<?php
global $buscador_rapido;
include("../../../../conexiones/config_grabacion.php");
if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");

$B = 1;


$palabra=$_POST["busca"];

if ($palabra == ""){

include ("ana_saldos_todos.php");
}else
{


switch ($tipo){
	case "1":{
 $sql="select * from ventas_encabezado where nro_cuenta like '$palabra' and forma_pago = 'CONTADO'";
		break;
	}

	case "2":{
 $sql="select * from ventas_encabezado where nro_cliente like '$palabra'  and forma_pago = 'CONTADO'";
		break;
	}
}


$result = $db_pro->Execute($sql);

$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result->fields["nro_cuenta"]);

$denominacion=strtoupper($result->fields["denominacion"]);

if ($denominacion == ""){
$leyenda = "NO REGISTRA COMPRAS EN PROVEEDURIA DE CONTADO";
include ("../../../../alertas/campo_informacion2.php");
exit;
}



$tipo_cuenta=strtoupper($result->fields["tipo_cuenta"]);


$cod_movimiento = "COMPRA DE CONTADO";

?>
<table width="103%" height="137" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td colspan="7"><div align="right"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong> DETALLE COMPRAS DE CONTADO </strong><?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="3"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?print("$palabra");?> - <?print("$denominacion");?></font></strong></font></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">

	<td width="15%" height="19"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA DE EMISION </font></div></td>
    <td width="43%"><div align="center"></div>      <div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">COMPROBANTE</font></div></td>
    <td width="42%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">IMPORTE ORIGINAL </font></div></td>
  </tr>

  <?



$anio_actual = date("y");
$mes_actual = date ("m");



  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


	




$fecha=strtoupper($result->fields["fecha"]);

$dia = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$anio= substr($fecha,0,4);
$fecha = $dia."-".$mes."-".$anio;

$neto=strtoupper($result->fields["neto"]);

$nro_factura=strtoupper($result->fields["nro_factura"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);


if ($fecha_pago == '00-00-0000'){

$fecha_pago = 'Sin Descontar';
}

$vencimiento=strtoupper($result->fields["vencimiento"]);
$cuotas=strtoupper($result->fields["cuotas"]);
$cuotas_pagadas=strtoupper($result->fields["cuotas_pagadas"]);

$total_neto= $total_neto+ $neto;

?>
    <tr><td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$fecha");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"></div>      <div align="center"><font size="2"><?print("$tipo_fact");?> -<?print("$nro_factura");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2">$ <?echo number_format($neto,2);?></font></div></td>
</tr>   
  
<?
	
	
$result->MoveNext();
	}
  

?>
<tr bgcolor="#C4D7E6">
  <td colspan="3"><hr noshade></td>
  </tr>
<tr bgcolor="#C4D7E6">
    <td colspan="2" bgcolor="#000099"><div align="right"><font color="#FFFFFF" size="3"><strong></strong></font></div>      <div align="right"><font color="#FFFFFF" size="3"><strong><font face="Arial, Helvetica, sans-serif">TOTAL </font></strong></font></div></td>
    <td bgcolor="#000099"><div align="center"><font color="#FFFFFF" size="3"><strong><font color="#FFFFFF" size="3"><strong><font face="Arial, Helvetica, sans-serif">$</font></strong></font> <font face="Arial, Helvetica, sans-serif"><?echo number_format($total_neto,2);?></font></strong></font></div></td>
</tr>
</table>
<?}?>