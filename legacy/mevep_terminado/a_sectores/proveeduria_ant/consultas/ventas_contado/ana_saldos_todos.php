<?php
global $buscador_rapido;
include("../../../../conexiones/config_grabacion.php");
if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

$B = 1;


$sql="select * from composicion_saldos order by cuenta";
$result = $db_pro->Execute($sql);




?>
<table width="103%" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td colspan="10"><div align="right"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong> DETALLE COMPOSICION DE SALDO </strong> <?echo $hoy;?> </font></div></td>
  </tr>

  <?



$anio_actual = date("y");
$mes_actual = date ("m");



  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


$cuenta = $palabra;
$palabra=strtoupper($result->fields["cuenta"]);
$tipo_cuenta=strtoupper($result->fields["tipo_cuenta"]);

if ($tipo_cuenta == '2'){

  $sql3="select * from clientes where cuenta like '$palabra'";
$result3 = $db_pro->Execute($sql3);
$denominacion=strtoupper($result3->fields["denominacion"]);


}elseif ($tipo_cuenta == "1"){
	

$sql4="select * from datos_laboratorio where nro_laboratorio like '$palabra'";
$result4=$db_bq->Execute($sql4);

$denominacion=strtoupper($result4->fields["nombre_laboratorio"]);
	

}
	


$fecha_emision=strtoupper($result->fields["fecha_emision"]);
$comprobante=strtoupper($result->fields["comprobante"]);
$precio=strtoupper($result->fields["importe"]);
$cod_movimiento=strtoupper($result->fields["cod_movimiento"]);
$importe_original=strtoupper($result->fields["importe_original"]);
$fecha_pago=strtoupper($result->fields["fecha_pago"]);

if ($fecha_pago == '0000-00-00'){

$fecha_pago = 'Sin Descontar';
}

$vencimiento=strtoupper($result->fields["vencimiento"]);
$cuotas=strtoupper($result->fields["cuotas"]);
$cuotas_pagadas=strtoupper($result->fields["cuotas_pagadas"]);

$saldo = $importe_original + $saldo;


$sql1="select sum(importe_original) as cant from composicion_saldos where cuenta = '$palabra' order by cuenta";
$result1 = $db_pro->Execute($sql1);

$cant=$result1->fields["cant"];




if ($palabra != $cuenta){

?>  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td width="30%"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?print("$palabra");?> - <?print("$denominacion");?> ($ <?print("$cant");?>)</font></strong></font></td>
    <td width="12%"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">FECHA DE EMISION </font></div></td>
    <td width="12%" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">MOVIMIENTO</font></div></td>
    <td width="10%" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">COMPROBANTE</font></div></td>
    <td width="14%" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">IMPORTE ORIGINAL </font></div></td>
    <td width="11%" bgcolor="#E6E6E6"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">FECHA DE PAGO </font></div></td>
    </tr>
  <?

}

?>
    <tr>
	<td bgcolor="#E8DCFC"><div align="left"><font face="Arial, Helvetica, sans-serif"><font size="2"></font></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$fecha_emision");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cod_movimiento");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$comprobante");?></font></div></td>
	<td bgcolor="#E8DCFC"><div align="center"><font size="2">$ <?echo number_format($importe_original,2);?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?echo $fecha_pago;?></font></div></td>
  </tr>   
  

<?
	
	
$result->MoveNext();
	}
  

?>
<tr bgcolor="#C4D7E6">
  <td colspan="6"><hr noshade></td>
  </tr>
<tr bgcolor="#C4D7E6">
    <td colspan="6" bgcolor="#000099"><div align="right"><font color="#FFFFFF" size="3"><strong><font face="Arial, Helvetica, sans-serif">TOTAL</font><font color="#FFFFFF" size="3"><strong><font face="Arial, Helvetica, sans-serif"> $ <?echo number_format($saldo,2);?></font></strong></font></strong></font></div>      <div align="center"></div></td>
    </tr>
</table>
