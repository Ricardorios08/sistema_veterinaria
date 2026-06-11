<?php 
//449 - B

$sql2="select * from `ventas_encabezado`  where tipo_fact = 'B' order by nro_factura desc";
$result2 = $db->Execute($sql2);
$nro_factura=$result2->fields["nro_factura"]+1;

$denominacion = "CONSUMIDOR FINAL";

$neto_gravado = $total_par / 1.21;

$iva = $total_par - $neto_gravado;
echo $sql = "INSERT INTO `ventas_encabezado` (`tipo_fact`, `nro_factura`, `cod_operacion`, `tipo`, `nro_cliente`, `nro_cuenta`, `plan`, `operador`, `denominacion`, `fecha`, `bruto`, `descuento`, `neto_gravado`, `iva`, `retencion`, `neto`, `forma_pago`, `periodo`, `anio`, `tipo_iva`, `cheque`, `contado`, `afectacion`) VALUES ('B', '$nro_factura', '', '$tipo', '$clientes', '$clientes', '', '$id', '$denominacion', '$fecha', '$total_par', '', '$neto_gravado', '$iva', '', '$total_par', '$tipo_pago', '', '', '$iva', '', '', '')";
mysql_query($sql);
