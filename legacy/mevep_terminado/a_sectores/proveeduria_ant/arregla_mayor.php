   <?


include("../../conexiones/config_pro.php");
$sql = "SELECT * FROM resumen_cta_vta  WHERE  `cod_movimiento` = 3 and fecha between '2010-01-31' and '2010-07-31' order by comprobante";
$result = $db->Execute($sql);
if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$afectacion=strtoupper($result->fields["afectacion"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);

$sql6="select * from  `composicion_saldos` where comprobante= $afectacion and tipo_fact = '$tipo_fact'";
$result6= $db->Execute($sql6);

$saldo_nc=strtoupper($result6->fields["saldo"]);

//if ($saldo_nc > 0){
echo " saldo --- ".$saldo_nc;


echo " labor ".$cuenta=strtoupper($result->fields["cuenta"]);
echo " nro fact ".$nro_factura=strtoupper($result->fields["comprobante"]);

echo " - imp resumen ".$importe=strtoupper($result->fields["importe"]);
$fecha=strtoupper($result->fields["fecha"]);

$sql6="select * from  ventas_encabezado where nro_factura= $nro_factura and tipo_fact = '$tipo_fact'";
$result6= $db->Execute($sql6);

echo " importe orig ".$neto=strtoupper($result6->fields["neto"]);
echo " - iva -  ".$iva=strtoupper($result6->fields["iva"]);

$saldo_a_guardar = $saldo_nc + $iva;


  $sql6 = "UPDATE `composicion_saldos` SET `saldo` = '$saldo_a_guardar',  `fecha_pago` = '$fecha' WHERE  `comprobante` = '$afectacion' and tipo_fact = '$tipo_fact'";
//$result6= $db->Execute($sql6);


 echo $sql6 = "UPDATE resumen_cta_vta SET importe = '$neto' WHERE  `comprobante` = '$nro_factura' and tipo_fact = '$tipo_fact'";
$result6= $db->Execute($sql6);

echo " afectacion: ".$afectacion;
$cont = $cont + 1;

echo "<br>";
//}
	 $result->MoveNext();
		}

echo "<br>";
echo "cantidad de registros: ".$cont;