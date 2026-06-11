<?
include ("../../../conexiones/config_grabacion.php");

$sql2="select * from recibos1_encab_temp_pro";
$result2 = $db_cont->Execute($sql2);
$nro_recibo=strtoupper($result2->fields["nro_recibo"]);
$fecha_pago=strtoupper($result2->fields["fecha_pago"]);
$cuenta=strtoupper($result2->fields["cuenta"]);
$tipo_cuenta=strtoupper($result2->fields["tipo_cuenta"]);
$cant_fact=strtoupper($result2->fields["cant_fact"]);
//$importe_pagado=strtoupper($result2->fields["fecha_pago"]);
$periodo=strtoupper($result2->fields["periodo"]);
$anio=strtoupper($result2->fields["anio"]);
$operador=strtoupper($result2->fields["operador"]);







$sql="select * from recibos1_deta_temp_pro where nro_recibo = '$nro_recibo'";
$result = $db_cont->Execute($sql);

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {

$nro_factura=strtoupper($result->fields["nro_factura_afectado"]);
$importe_pagado=strtoupper($result->fields["importe_pagado"]);
$debito=strtoupper($result->fields["debito"]);
$nro_deta_recibo=strtoupper($result->fields["nro_deta_recibo"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$pago=strtoupper($result->fields["pago"]);


$total = $importe_pagado + $debito;

$sql2="select * from factura where nro_factura = '$nro_factura' and tipo_fact = '$tipo_fact'";
$result2 = $db_fa->Execute($sql2);
$saldo=strtoupper($result2->fields["saldo"]);
$pagados=strtoupper($result2->fields["pagados"]);


$pagados_a_guardar = ($pagados) + ($importe_pagado + $debito);
$saldo_a_guardar = ($saldo) - ($importe_pagado + $debito);



$sql3 = "UPDATE `factura` SET `estado` = 'COBRADA' , `fecha_pago_fact` = '$fecha_pago' , `pagados` = '$pagados_a_guardar', `saldo` = '$saldo_a_guardar' WHERE `nro_factura` = '$nro_factura'";
$result3 = $db_fa->Execute($sql3);

$sql4 = "UPDATE `composicion` SET `observaciones` = 'COBRADA', `fecha_pago_fact` = '$fecha_pago' WHERE `nro_factura` = '$nro_factura'";
$result4 = $db_liq->Execute($sql4);

$total_importe = $total_importe + $monto;
$saldo = $total_importe + $debito;


 $sql6 = "INSERT INTO `detalle_recibo` ( `nro_recibo` , `tipo_fact` , `nro_factura_afectado` , `importe_pagado` , `debito` , `nro_deta_recibo`  )  VALUES ('$nro_recibo' , '$tipo_fact' ,'$nro_factura' , '$importe_pagado' , '$debito' , '')";
$result6 = $db_cont->Execute($sql6);


 $sql5 = "INSERT INTO `resumen_cta_vta_os` ( `cuenta` , `tipo_cuenta` , `fecha` , `tipo_fact` , `comprobante` , `cod_movimiento` , `importe` , `vencimiento` , `referencia` , `afectacion` )  VALUES ('$cuenta' , '$tipo_cuenta' , '$fecha_pago' , '$tipo_fact' , '$nro_recibo' , '4' , '$total' , '' , '' , 'nro_factura' )";
$result5 = $db_liq->Execute($sql5);



$result->MoveNext();
}

echo $sql5 = "INSERT INTO `recibos` ( `nro_recibo` , `fecha_pago` , `cuenta` , `tipo_cuenta` , `cant_fact` , `importe_pagado` , `periodo` , `anio` , `operador` )  VALUES ('$nro_recibo' , '$fecha_pago' , '$cuenta' , '$tipo_cuenta' , '$cant_fact' , '$importe_pagado' , '$periodo' , '$anio' , '$operador')";
$result5 = $db_cont->Execute($sql5);

$sql1 = "INSERT INTO `facturas_pagadas` ( `tipo_fact` , `nro_factura` , `fecha_pago` , `nro_recibo` , `importe_pagado` , `importe_debito` , `pago` ) VALUES ( '$tipo_fact' , '$nro_factura' , '$fecha_pago' , '$nro_recibo' ,  '$importe_pagado' , '$debito' , '$pago')";
$result1 = $db_liq->Execute($sql1);


$sql="truncate table recibos1_encab_temp ";
$result = $db_cont->Execute($sql);
$sql="truncate table recibos1_deta_temp ";
$result = $db_cont->Execute($sql);

include_once ("cobrar_factura_1.php");


?>



