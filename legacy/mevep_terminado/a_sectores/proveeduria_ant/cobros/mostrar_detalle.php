<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo3 {
	color: #000000;
	font-weight: bold;
}
.Estilo4 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 14px}
.Estilo8 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo9 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo10 {font-size: 12px}
.Estilo11 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo127 {color: #000000}
.Estilo128 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
-->
</style>
</head>

<body>
<table width="682" border="0">
  <!--DWLayoutTable-->
  <tr bgcolor="#000099">
    <td width="70"><div align="center"><span class="Estilo1 Estilo4 Estilo6">TIPO</span></div></td>
    <td width="87"><div align="center" class="Estilo1 Estilo4 Estilo6">FACTURA</div></td>
    <td width="109"><div align="center" class="Estilo9">IMPORTE</div></td>
    <td width="72"><div align="center" class="Estilo9">DEBITO</div></td>
    <td width="96"><div align="center"><span class="Estilo9">TOTAL FAC </span></div></td>
    <td width="73"><div align="center" class="Estilo8"><span class="Estilo1">SALDO</span></div></td>
<td width="72"><div align="center" class="Estilo8"><span class="Estilo1">PAGO</span></div></td>
    <td width="69"><div align="center" class="Estilo8"><span class="Estilo1">BORRAR</span></div></td>
  </tr>

<?

include ("../../../conexiones/config_grabacion.php");
$sql="select * from recibos1_encab_temp_pro";
$result = $db_cont->Execute($sql);
$nro_recibo=strtoupper($result->fields["nro_recibo"]);
$tipo_cuenta=strtoupper($result->fields["tipo_cuenta"]);


$sql="select * from recibos1_deta_temp_pro where nro_recibo = '$nro_recibo'";
$result = $db_cont->Execute($sql);

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {

$nro_factura=strtoupper($result->fields["nro_factura_afectado"]);
$monto=strtoupper($result->fields["importe_pagado"]);
$debito=strtoupper($result->fields["debito"]);
$nro_deta_recibo=strtoupper($result->fields["nro_deta_recibo"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$pago=strtoupper($result->fields["pago"]);



$total_importe = $total_importe + $monto;
$total_debito = $total_debito + $debito;

$saldo = $total_importe + $debito;

$total_recibo = $total_recibo + $saldo;

$total_fac = $monto + $debito;
if ($debito == 0.00 ){

	
$debito = " - ";
}
if ($total_debito == 0.00){
$total_debito = " - ";
}
?>

  <tr>
    <td><div align="center"><?ECHO $tipo_fact;?></div></td>
    <td> <div align="center"><?ECHO $nro_factura;?></div></td>
    <td><div align="center"><?ECHO number_format($monto,2);?></div></td>
    <td><div align="center"><?ECHO number_format($debito,2);?></div></td>
    <td><div align="center"><?ECHO number_format($total_fac,2);?></div></td>
    <td><div align="center"><?ECHO number_format($saldo,2);?></div></td>
	    <td><div align="center"><?ECHO $pago;?></div></td>
	<td><div align="center"><a href="borrar_item.php?nro_deta_recibo=<?print("$nro_deta_recibo");?>&&nro_factura=<?print("$nro_factura");?>&&monto=<?print("$monto");?>&&debito=<?print("$debito");?>&&tipo_cuenta=<?print("$tipo_cuenta");?>&&nro_os=<?print("$nro_os");?>&&fecha=<?print("$fecha");?>" onclick="return confirm('¿Está seguro de borrar este producto?');"><IMG SRC="../../../imagenes/office/095.ico" alt="Anular"  border = "0"></a></div></td>
  </tr>
  


  <?
$result->MoveNext();
}
$total_fac = 0;

?>

<tr>
    <td height="22" colspan="8" valign="top"><hr noshade></td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td><hr noshade></td>
    <td><div align="center" class="Estilo4 Estilo10"><span class="Estilo3">TOTALES</span></div></td>
    <td><div align="center" class="Estilo11 Estilo127">$ <?ECHO number_format($total_importe,2);?></div></td>
    <td><div align="center" class="Estilo128">$ <?ECHO number_format($total_debito,2);?></div></td>
    <td><div align="center"><span class="Estilo11"><strong>$ <?ECHO number_format($saldo,2);?></strong></span></div></td>
    <td><div align="center" class="Estilo11"></div></td>
	    <td><div align="center" class="Estilo11"><strong></strong></div></td>
  
    <td><hr noshade></td>
  </tr>
</table>
</body>
</html>

