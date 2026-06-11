<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">
<?php
global $buscador_rapido;
include ("../../../../conexiones/config.inc.php");
if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");


$B = 1;
$cont = 0;
$pagina = 1;
echo $palabra=$_POST["busca"];

if ($palabra == ""){

include ("ana_saldos_todos.php");
}else
{

switch ($ver){
case "1":{ //historico
 $sql="select * from composicion_saldos where cuenta like '$palabra'  order by fecha_emision, tipo_fact, comprobante";
	break;
}

case "2":{ //adeudado
$sql="select * from composicion_saldos where cuenta like '$palabra' and saldo > 0 order by fecha_emision, tipo_fact, comprobante";
	break;
}
}


$result = $db->Execute($sql);


  $sql3="select * from clientes where cuenta like '$palabra'";
$result3 = $db->Execute($sql3);
$denominacion=strtoupper($result3->fields["denominacion"]);




?><table width="850" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td width="93%" colspan="6"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" size="5" face="Arial, Helvetica, sans-serif">LISTADO DE COMPOSICION DE SALDOS </font></font></div></td>
    <td width="7%" rowspan="2"><img src="../../../../imagenes/obras/aridos.jpg" width="193" height="80"></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="7"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">Emitido el <?php echo $hoy;?></font></font></div></td>
  </tr>
  
</table>


<table width="860" height="137" border="0">
 
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="8"><font face="Arial, Helvetica, sans-serif"><strong><font size="2"><?php print("$palabra");?> - <?php print("$denominacion");?></font></strong></font></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">

	<td width="10%" height="19"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA DE EMISION </font></div></td>
    <td width="15%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MOVIMIENTO</font></div></td>

    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TIPO</font></div></td>
    <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">COMP.</font></div></td>


	<td width="15%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">IMPORTE ORIGINAL </font></div></td>
    <td width="17%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA DE PAGO </font></div></td>

<td width="15%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
<td width="17%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">AC. SALDO &nbsp;&nbsp;<?php echo $pagina;?></font></div></td>
</tr>

  <?php 



$anio_actual = date("y");
$mes_actual = date ("m");



  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {


	


$fecha_emision=strtoupper($result->fields["fecha_emision"]);

$dia = substr($fecha_emision,8,2);
$mes = substr($fecha_emision,5,2);
$anio= substr($fecha_emision,0,4);
$fecha_emision = $dia."-".$mes."-".$anio;


$comprobante=strtoupper($result->fields["comprobante"]);
$precio=strtoupper($result->fields["importe"]);
$cod_movimiento=strtoupper($result->fields["cod_movimiento"]);
$importe_original=strtoupper($result->fields["importe_original"]);
$fecha_pago=strtoupper($result->fields["fecha_pago"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$saldo=strtoupper($result->fields["saldo"]);

if ($fecha_pago == '0000-00-00'){

$fecha_pago = 'Sin Descontar';
}

$vencimiento=strtoupper($result->fields["vencimiento"]);
$cuotas=strtoupper($result->fields["cuotas"]);
$cuotas_pagadas=strtoupper($result->fields["cuotas_pagadas"]);

$saldo_acumulado = $saldo + $saldo_acumulado;

?>
    <tr><td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php print("$fecha_emision");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php print("$cod_movimiento");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php print("$tipo_fact");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php print("$comprobante");?></font></div></td>
	<td bgcolor="#E8DCFC"><div align="right"><font size="2"><?php echo number_format($importe_original,2);?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php echo $fecha_pago;?></font></div></td>
	<td bgcolor="#E8DCFC"><div align="right"><font size="2"> <?php echo number_format($saldo,2);?></font></div></td>
	<td bgcolor="#E8DCFC"><div align="right"><font size="2"> <?php echo number_format($saldo_acumulado,2);?></font></div></td>
</tr>   
  
<?php 
	
$cont = $cont + 1; //43
	
	if ($cont == 43){
		$cont = 0;
		$pagina = $pagina + 1;
?> 
<table width="103%" height="137" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td colspan="12"><div align="right"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong> DETALLE COMPOSICION DE SALDO </strong> <?php echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
    <td colspan="8"><div align="center"><font color="#0000FF" face="Arial, Helvetica, sans-serif"><strong><font size="3"><?php print("$palabra");?> - <?php print("$denominacion");?></font></strong></font></div></td>
  </tr>

<tr bordercolor="#FFFFFF" bgcolor="#000099">

	<td width="10%" height="19"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA DE EMISION </font></div></td>
    <td width="15%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">MOVIMIENTO</font></div></td>

    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">TIPO</font></div></td>
    <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">COMP.</font></div></td>


	<td width="15%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">IMPORTE ORIGINAL </font></div></td>
    <td width="17%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA DE PAGO </font></div></td>

<td width="15%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
<td width="17%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">AC. SALDO &nbsp;&nbsp;<?php echo $pagina;?></font></div></td>
</tr>

<?php }



$result->MoveNext();
	}
  

?>
<tr bgcolor="#C4D7E6">
  <td colspan="8"><hr noshade></td>
  </tr>
<tr bgcolor="#C4D7E6">
    <td colspan="8" bgcolor="#000099"><div align="right"><font color="#FFFFFF" size="3"><strong><font face="Arial, Helvetica, sans-serif">TOTAL $ <?php echo number_format($saldo_acumulado,2);?></font></strong></font></div></td>
  </tr>
</table>
<?php }?>