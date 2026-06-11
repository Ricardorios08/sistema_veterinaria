   <?


include("../../conexiones/config_pro.php");
echo $sql = "SELECT * FROM composicion_saldos  WHERE  tipo_fact = 1 and saldo > 0 order by tipo_cuenta, cuenta, comprobante";
$result = $db->Execute($sql);
if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

echo $cuenta=$result->fields["cuenta"];
$tipo_cuenta=$result->fields["tipo_cuenta"];
$fecha_emision=$result->fields["fecha_emision"];
$comprobante=$result->fields["comprobante"];
$importe_original=$result->fields["importe_original"];
$saldo=$result->fields["saldo"];

switch ($tipo_cuenta){
	case "1":{
$nro_cuenta = $cuenta;
 include("../../conexiones/config.inc.php");
$sql2="select * from datos_laboratorio where nro_laboratorio like '$nro_cuenta'";
$result2=$db->Execute($sql);

$denominacion=strtoupper($result2->fields["nombre_laboratorio"]);
$nro_cliente = "";
		break;
	}

	case "2":{
$nro_cliente = $cuenta;
include("../../conexiones/config_pro.php");
$sql3="select * from clientes where cuenta like '$nro_cliente'";
$result3 = $db->Execute($sql3);
$denominacion=strtoupper($result3->fields["denominacion"]);
$nro_cuenta = "";
		break;
	}
}

$operador = 101;



include("../../conexiones/config_pro.php");
$sql1 = "INSERT INTO `ventas_encabezad` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `neto_gravado` , `iva` , `retencion` , `neto` , `forma_pago` , `periodo` , `anio` , `tipo_iva` ) VALUES ('1' , '$comprobante' , '1' , '$tipo' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha_emision' , '$bruto' , '$descuento' , '$neto_gravado' , '$iva' , '$retencion' , '$saldo' , '$forma_pago' , '$periodo' , '$anio' , '$tipo_iva' )";
mysql_query($sql1);


echo "<br>";
	 $result->MoveNext();
		}

