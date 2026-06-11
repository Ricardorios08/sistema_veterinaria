<?
include ("../../../conexiones/config_grabacion.php");

echo $nro_recibo = $_REQUEST['nro_recibo'];
echo $tipo_cuenta= $_REQUEST['tipo_cuenta'];
echo $cuenta= $_REQUEST['cuenta'];


switch ($tipo_cuenta){
	case "1":{

$sql="select * from detalle_recibo where nro_recibo = '$nro_recibo'";
$result = $db_cont->Execute($sql);

if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {

$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$nro_factura_afectado=strtoupper($result->fields["nro_factura_afectado"]);
$importe_factura=strtoupper($result->fields["importe_pagado"]);

echo $sql1="select * from composicion_saldos where tipo_fact = '$tipo_fact' and comprobante = '$nro_factura_afectado'";
$result1 = $db_pro->Execute($sql1);

$saldo=$result1->fields["saldo"];

$saldo_a_guardar = $saldo + $importe_factura;

echo $sql4 = "UPDATE `composicion_saldos` SET `saldo` = '$saldo_a_guardar' , `fecha_pago` = '0000-00-00' WHERE `tipo_fact` = '$tipo_fact' AND `comprobante` = '$nro_factura_afectado'";
$result4 = $db_pro->Execute($sql4);



	$result->MoveNext();
	}


echo $sql5 = "delete from recibos where nro_recibo = '$nro_recibo'";
$result5 = $db_cont->Execute($sql5);
echo $sql6 = "delete from detalle_recibo where nro_recibo = '$nro_recibo'";
$result6 = $db_cont->Execute($sql6);
echo $sql7 = "delete from resumen_cta_vta where comprobante = '$nro_recibo'";
$result7 = $db_pro->Execute($sql7);




break;}

case "2":{

$sql="select * from detalle_recibo where nro_recibo = '$nro_recibo'";
$result = $db_cont->Execute($sql);

if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {

$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$nro_factura_afectado=strtoupper($result->fields["nro_factura_afectado"]);
$importe_factura=strtoupper($result->fields["importe_pagado"]);

echo $sql1="select * from composicion_saldos where tipo_fact = '$tipo_fact' and comprobante = '$nro_factura_afectado'";
$result1 = $db_pro->Execute($sql1);

$saldo=$result1->fields["saldo"];

$saldo_a_guardar = $saldo + $importe_factura;

echo $sql4 = "UPDATE `composicion_saldos` SET `saldo` = '$saldo_a_guardar' , `fecha_pago` = '0000-00-00' WHERE `tipo_fact` = '$tipo_fact' AND `comprobante` = '$nro_factura_afectado'";
$result4 = $db_pro->Execute($sql4);



	$result->MoveNext();
	}


echo $sql5 = "delete from recibos where nro_recibo = '$nro_recibo'";
$result5 = $db_cont->Execute($sql5);
echo $sql6 = "delete from detalle_recibo where nro_recibo = '$nro_recibo'";
$result6 = $db_cont->Execute($sql6);
echo $sql7 = "delete from resumen_cta_vta where comprobante = '$nro_recibo'";
$result7 = $db_pro->Execute($sql7);


	break;
}

	case "3":{

$sql="select * from detalle_recibo where nro_recibo = '$nro_recibo'";
$result = $db_cont->Execute($sql);

if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {

$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$nro_factura_afectado=strtoupper($result->fields["nro_factura_afectado"]);
$importe_factura=strtoupper($result->fields["importe_pagado"]);

echo $sql1="select * from factura where tipo_fact = '$tipo_fact' and nro_factura = '$nro_factura_afectado'";
$result1 = $db_pro->Execute($sql1);

$saldo=$result1->fields["saldo"];

$saldo_a_guardar = $saldo + $importe_factura;

echo $sql3 = "UPDATE `factura` SET `estado` = 'PENDIENTE' , `fecha_pago_fact` = '0000-00-00' , `pagados` = '0.00', `saldo` = '$saldo_a_guardar' WHERE `nro_factura` = '$nro_factura_afectado'";
$result3 = $db_fa->Execute($sql3);



	$result->MoveNext();
	}



echo $sql4 = "UPDATE `composicion` SET `observaciones` = 'PENDIENTE', `fecha_pago_fact` = '0000-00-00' WHERE `nro_factura` = '$nro_factura_afectado'";
$result4 = $db_liq->Execute($sql4);
echo $sql5 = "delete from recibos where nro_recibo = '$nro_recibo'";
$result5 = $db_cont->Execute($sql5);
echo $sql6 = "delete from detalle_recibo where nro_recibo = '$nro_recibo'";
$result6 = $db_cont->Execute($sql6);
echo $sql7 = "delete from resumen_cta_vta_os where comprobante = '$nro_recibo'";
$result7 = $db_liq->Execute($sql7);
echo $sql7 = "delete from facturas_pagadas where comprobante = '$nro_factura_afectado'";
$result7 = $db_liq->Execute($sql7);
}

}


include ("../buscar_recibos.php");


?>



