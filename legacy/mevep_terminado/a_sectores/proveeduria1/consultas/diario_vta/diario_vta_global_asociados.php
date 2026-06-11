<style type="text/css">
<!--
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo5 {font-size: 12px}
.Estilo8 {
	font-size: 14px;
	color: #FFFFFF;
}
.Estilo16 {font-size: 10px}
.Estilo17 {font-family: Arial, Helvetica, sans-serif}
.Estilo18 {
	color: #0000FF;
	font-weight: bold;
}
.Estilo19 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.Estilo20 {color: #0000FF}
.Estilo22 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #0000FF;
}
-->
</style>
 

<!-- 
<a href="imp_pendientes.php?a='excel'&&buscar_por=<?print("$buscar_por");?>"><IMG SRC="../../imagenes/botones//btn_exportar.gif" alt="Exportar" border = "0"></a> -->


 <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()">

<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo11 {font-size: 10px}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo13 {font-size: 10}
.Estilo14 {font-family: Arial, Helvetica, sans-serif; font-size: 10; }
.Estilo15 {font-size: 12px}
.Estilo15 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
<table width="80%" height="24" border="0">
  <!--DWLayoutTable-->
<tr valign="middle" bgcolor="#000099">
    <td height="20" colspan="5"><div align="center" class="Estilo2">
      <div align="right"><span class="Estilo5"><span class="Estilo8">Diario de Ventas Mensual Emitido  dia: <?ECHO $fecha_a;?></span> </span></div>
    </div></td>
</tr>
</TABLE>

	 <?

include ("../../../../conexiones/config_pro.php");

$fecha_desde = $anio."-".$mes."-01";
$fecha_hasta =$anio."-".$mes."-31";

 $sql2="select fecha from ventas_encabezado where fecha between '$fecha_desde' and '$fecha_hasta' and nro_cuenta != 0 group by fecha order by fecha";
$result123 = $db->Execute($sql2);

  if (!$result123) die("fallo".$db->ErrorMsg());
  while (!$result123->EOF) {

 $fecha1=strtoupper($result123->fields["fecha"]);

$dia1 = substr($fecha1,8,2);
$mes1 = substr($fecha1,5,2);
$anio1 = substr($fecha1,0,4);

$fecha20 = $dia1."-".$mes1."-".$anio1;
	
 ////////////////////////////////////////////
 $sql1 = "SELECT sum(iva) as iva_facturas FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2 ) and nro_cuenta != 0 ";
$result1 = $db->Execute($sql1);

  $iva_facturas=$result1->fields["iva_facturas"];

  $sql2 = "SELECT sum(iva) as iva_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != '0'";
$result2 = $db->Execute($sql2);
  $iva_nc=$result2->fields["iva_nc"];
 $iva = $iva_facturas - $iva_nc;

$sql1 = "SELECT sum(neto) as neto FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cuenta != 0 and forma_pago = 'CTA/CTE'";
$result1 = $db->Execute($sql1);
 $neto=$result1->fields["neto"];

 $sql2 = "SELECT sum(neto) as neto_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != 0 and forma_pago = 'CTA/CTE'";
$result2 = $db->Execute($sql2);
  $neto_nc=$result2->fields["neto_nc"];

$neto = $neto - $neto_nc;

 $sql1 = "SELECT sum(neto) as contado FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $contado=$result1->fields["contado"];

$sql2 = "SELECT sum(neto) as contado_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
  $contado_nc=$result2->fields["contado_nc"];

///////////////////// NUEVA PARTE
 $sql1 = "SELECT sum(cheque) as cheque FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $cheque=$result1->fields["cheque"];

$sql2 = "SELECT sum(cheque) as cheque_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
 $cheque_nc=$result2->fields["cheque_nc"];

 $sql1 = "SELECT sum(contado) as caja FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $caja=$result1->fields["caja"];

$sql2 = "SELECT sum(contado) as caja_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cuenta != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
$caja_nc=$result2->fields["caja_nc"];

$cheque= $cheque - $cheque_nc;
$caja= $caja - $caja_nc;


$contado = $contado - $contado_nc;
$vendido = $neto + $contado - $iva;

$debe= $neto + $contado;
$haber= $vendido + $iva;


?>
<table width="608" border="0">
  <tr>
    <td colspan="4"><div align="center"><span class="Estilo2"><strong><span class="Estilo1 Estilo20"><strong><blink>Fecha <?echo $fecha20;?></blink></strong></span></strong></span></div>      
    <div align="center"></div>      <div align="center"></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center" class="Estilo2">
      <div align="center"><strong><span class="Estilo1"><strong><strong>***</strong> Asiento Asociados *** </strong></span></strong></div>
    </div></td>
    <td width="97"><div align="center" class="Estilo19"><em><span class="Estilo1">DEBE</span></em></div></td>
    <td width="136"><div align="center" class="Estilo19"><em><span class="Estilo1">HABER</span></em></div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1211001 Deudores por Ventas Proveedur&iacute;a Asociados </span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($neto,2);?></span></div></td>
    <td><div align="center">-</div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1110101 Fondos a Depositar Efectivo </span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($caja,2);?></span></div></td>
    <td><div align="center">-</div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1110102 Fondos a Depositar Cheque</span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($cheque,2);?></span></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="110">&nbsp;</td>
    <td width="247"><span class="Estilo2">a 4110201 Ventas Proveedur&iacute;a Asociados</span></td>
    <td><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($vendido,2);?></span></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo2">a 2410107 IVA D&eacute;bito Fiscal</span></td>
    <td><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($iva,2);?></span></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td><div align="right"><strong><span class="Estilo2"><?echo number_format($debe,2);?></span></strong></div></td>
    <td><div align="right"><strong><span class="Estilo2"><?echo number_format($haber,2);?></span></strong></div></td>
  </tr>
</table>


<?
////////////////////////////////////////////
$todo_debe_asociados = $todo_debe_asociados + $debe;
$todo_iva_asociados = $todo_iva_asociados + $iva;
//externos
 ////////////////////////////////////////////
 $sql1 = "SELECT sum(iva) as iva_facturas FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2 ) and nro_cliente != 0 ";
$result1 = $db->Execute($sql1);

 $iva_facturas=$result1->fields["iva_facturas"];

 $sql2 = "SELECT sum(iva) as iva_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0";
$result2 = $db->Execute($sql2);
 $iva_nc=$result2->fields["iva_nc"];

 $iva = $iva_facturas - $iva_nc;

$sql1 = "SELECT sum(neto) as neto FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cliente != 0 and forma_pago = 'CTA/CTE'";
$result1 = $db->Execute($sql1);
 $neto=$result1->fields["neto"];

 $sql2 = "SELECT sum(neto) as neto_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0 and forma_pago = 'CTA/CTE'";
$result2 = $db->Execute($sql2);
  $neto_nc=$result2->fields["neto_nc"];

$neto = $neto - $neto_nc;

 $sql1 = "SELECT sum(neto) as contado FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $contado=$result1->fields["contado"];

 $sql2 = "SELECT sum(neto) as contado_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
  $contado_nc=$result2->fields["contado_nc"];

 ///////////////////// NUEVA PARTE
 $sql1 = "SELECT sum(cheque) as cheque FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $cheque=$result1->fields["cheque"];

$sql2 = "SELECT sum(cheque) as cheque_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
 $cheque_nc=$result2->fields["cheque_nc"];

 $sql1 = "SELECT sum(contado) as caja FROM ventas_encabezado WHERE fecha = '$fecha' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result1 = $db->Execute($sql1);
 $caja=$result1->fields["caja"];

$sql2 = "SELECT sum(contado) as caja_nc FROM ventas_encabezado WHERE fecha = '$fecha' AND cod_operacion = '3' and nro_cliente != 0 and forma_pago = 'CONTADO'";
$result2 = $db->Execute($sql2);
$caja_nc=$result2->fields["caja_nc"];

$cheque= $cheque - $cheque_nc;
$caja= $caja - $caja_nc;

$contado = $contado - $contado_nc;
$vendido = $neto + $contado - $iva;

$debe= $neto + $contado;
$haber= $vendido + $iva;


?>
<table width="608" border="0">
  <tr>
    <td colspan="2"><div align="center" class="Estilo2">
      <div align="center"><strong><span class="Estilo1"><strong>***</strong></span> Asiento Externos <span class="Estilo1"><strong>***</strong></span></strong></div>
    </div>      <div align="center" class="Estilo2"></div>      <div align="center" class="Estilo2"></div></td>
    <td><div align="center" class="Estilo19">    </div></td>
    <td><div align="center">
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1211002 Deudores por Ventas Proveedur&iacute;a Externos </span></td>
    <td width="95"><div align="right"><span class="Estilo2"><?echo number_format($neto,2);?></span></div></td>
    <td width="138"><div align="center">-</div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1110101 Fondos a Depositar Efectivo</span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($caja,2);?></span></div></td>
    <td><div align="center">-</div></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">1110102 Fondos a Depositar Cheque</span></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($cheque,2);?></span></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="110">&nbsp;</td>
    <td width="247"><span class="Estilo2">a 4110204 Ventas Proveedur&iacute;a Externos</span></td>
    <td><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($vendido,2);?></span></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo2">a 2410107 IVA D&eacute;bito Fiscal</span></td>
    <td><div align="center">-</div></td>
    <td><div align="right"><span class="Estilo2"><?echo number_format($iva,2);?></span></div></td>
  </tr>
  <tr>
    <td height="21" colspan="2">&nbsp;</td>
    <td><div align="right"><strong><span class="Estilo2"><?echo number_format($debe,2);?></span></strong></div></td>
    <td><div align="right"><strong><span class="Estilo2"><?echo number_format($haber,2);?></span></strong></div></td>
  </tr>
</table>



<?
////////////////////////////////////////////
$cheque = "";
$caja = "";
$todo_debe_externos = $todo_debe_externos + $debe;
$todo_iva_externos = $todo_iva_externos + $iva;

/////////////// DETALLE ANALITICO DE EXTERNOS  ///////////
?>
<table width="608" border="0">
  <!--DWLayoutTable-->
<tr>
  <td colspan="6"><div align="center">___________________ <span class="Estilo5">DETALLE DE DEUDORES X VENTA EXTERNO</span> ___________________</div></td>
  </tr>
<tr>
    <td width="236"><div align="center" class="Estilo11 Estilo5"><em><span class="Estilo5">Laboratorio</span></em></div></td>
    <td width="73" colspan="2"><div align="center" class="Estilo12"><em><span class="Estilo5">Comp.</span></em></div></td>
    <td width="81"><div align="center" class="Estilo11 Estilo5"><em><span class="Estilo5">N.G</span></em></div></td>
    <td width="66"><div align="center" class="Estilo12"><em><span class="Estilo5">IVA</span></em></div></td>
    <td width="67"><div align="center" class="Estilo11 Estilo5"><em><span class="Estilo5">Total</span></em></div></td>
  </tr>

  <?

$sql1 = "SELECT * FROM ventas_encabezado WHERE fecha = '$fecha1' AND ( cod_operacion = 0 OR cod_operacion = 1 OR cod_operacion = 2) and nro_cliente != 0 and forma_pago = 'CTA/CTE'";
$result_ext = $db->Execute($sql1);

  if (!$result_ext) die("fallo".$db->ErrorMsg());
  while (!$result_ext->EOF) {

$cod_movimiento1=strtoupper($result_ext->fields["cod_operacion"]);
$forma_pago1=strtoupper($result_ext->fields["forma_pago"]);
$nro_factura1=strtoupper($result_ext->fields["nro_factura"]);
$cod_operacion1 = strtoupper($result_ext->fields["cod_operacion"]);
$denominacion1=strtoupper($result_ext->fields["denominacion"]);
$tipo_fact1=strtoupper($result_ext->fields["tipo_fact"]);
$fecha1=strtoupper($result_ext->fields["fecha"]);
$neto_gravado1=strtoupper($result_ext->fields["neto_gravado"]);
$neto1=strtoupper($result_ext->fields["neto"]);
$iva1=strtoupper($result_ext->fields["iva"]);
$auxi_ext = $neto1;

if ($cod_operacion1 == 3){
$auxi_ext = ($auxi_ext * -1);
}


$suma_neto_gravado1 = $suma_neto_gravado1 + $neto_gravado1;
$suma_iva1 = $suma_iva1 + $iva1;
$suma_neto1 = $suma_neto1 + $neto1;


?>
<tr>
    <td><span class="Estilo12 Estilo5 Estilo11"><?echo $cuenta;?> - <?echo $denominacion1;?></span></td>
    <td colspan="2"><div align="center" class="Estilo5"><span class="Estilo16 Estilo11"><?echo $movimiento;?> <?echo $tipo_fact1;?> - <?echo $nro_factura1;?></span></div></td>
    <td><div align="right" class="Estilo12 Estilo13"><span class="Estilo12"><?echo number_format($neto_gravado1,2);?></span></div></td>
    <td><div align="right" class="Estilo14"><span class="Estilo12"><?echo number_format($iva1,2);?></span></div></td>
    <td><div align="right" class="Estilo14"><span class="Estilo12"><?echo number_format($neto1,2);?></span></div></td>
  </tr>

<?

$result_ext->MoveNext(); // CAMBIA ANALITICO
	}

?>
<tr>
  <td colspan="3"><div align="right"><span class="Estilo15 Estilo17 Estilo5">Total</span></div></td>
  <td><div align="right" class="Estilo18"><span class="Estilo12 Estilo13"><span class="Estilo12 Estilo17  Estilo5"><?echo number_format($suma_neto_gravado1,2);?></span></span></div></td>
  <td><div align="right" class="Estilo18"><span class="Estilo12 Estilo13"><span class="Estilo12 Estilo5  Estilo17"><?echo number_format($suma_iva1,2);?></span></span></div></td>
  <td><div align="right" class="Estilo18"><span class="Estilo12 Estilo13"><span class="Estilo12 Estilo17  Estilo5"><?echo number_format($suma_neto1,2);?></span></span></div></td>
</tr>
<tr>
  <td colspan="2">&nbsp;</td>
  <td width="73">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="6"><div align="center">****************************************************************</div></td>
  </tr>

	<?

$suma_neto_gravado1 = "";
$suma_iva1 = "";
$suma_neto1 = "";
	$result123->MoveNext(); // cambia de dia
	}

$todo_debe = $todo_debe_asociados + $todo_debe_externos;
$todo_iva = $todo_iva_asociados + $todo_iva_externos;

?>
    <tr>
      <td colspan="2" valign="top"><div align="center"><span class="Estilo18"><span class="Estilo17">IVA DEL MES <?echo number_format($todo_iva,2);?></span></span></div></td>
      <td colspan="4" valign="top"><div align="center"><span class="Estilo18"><span class="Estilo17">TOTAL DEL ME</span></span><span class="Estilo22">S: <?echo number_format($todo_debe,2);?></span></div></td>
    </tr>

</TABLE>
