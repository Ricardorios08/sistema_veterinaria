<?
include ("../../../conexiones/config_grabacion.php");
$sql="select * from composicion_saldos where tipo_fact = 1";
$result = $db_pro->Execute($sql);

 if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {

$tipo_fact = 1;
echo $comprobante=ucwords($result->fields["comprobante"]);
echo $fecha_emision=ucwords($result->fields["fecha_emision"]);
echo $importe_orginal=ucwords($result->fields["importe_original"]);
echo $cuenta=ucwords($result->fields["cuenta"]);
echo $tipo_cuenta=ucwords($result->fields["tipo_cuenta"]);
$operador = 101;
$forma_pago = "CTA/CTE";
$plan= 1;

switch ($tipo_cuenta){
	case "2":{
$sql="select * from clientes where cuenta like '$cuenta'";
$result3 = $db_pro->Execute($sql);
echo $denominacion=strtoupper($result3->fields["denominacion"]);
$nro_cliente = $cuenta;
$nro_cuenta = "";


$sql7="select * from condiciones_clientes where cuenta like '$cuenta'";
$result7 = $db_pro->Execute($sql7);
$plan=strtoupper($result7->fields["plan"]);
$tipo_fact=strtoupper($result7->fields["iva"]);  // letras
$tipo_iva=strtoupper($result7->fields["iva"]); // numero
$iva =$result7->fields["iva"];

switch ($tipo_iva){
	case "1":{
$tipo_fact = "Responsable Inscripto";
$fact = "A";
		break;
	}

	case "4":{
$tipo_fact = "Exento";
$fact = "B";
		break;
	}

		case "3":{
$tipo_fact = "Monotributo";
$fact = "B";
		break;
	}

		case "5":{
$tipo_fact = "Consumidor Final";
$fact = "B";
$leyenda = "Irregular situación AFIP";
include ("../../../alertas/campo_vacio.php");
exit;
		break;
	}

	case "2":{
$tipo_fact = "RNI";
$fact = "B";
$leyenda = "NO EXISTE ESA CATEGORIA EN AFIP, REGULARICE SU SITUACION";
include ("../../../alertas/campo_vacio.php");
exit;
		break;
	}


}

break;
	}

	case "1":{

$sql="select * from datos_laboratorio where nro_laboratorio like '$cuenta'";
$result4=$db_bq->Execute($sql);

echo $denominacion=strtoupper($result4->fields["nombre_laboratorio"]);
$nro_cuenta = $cuenta;
$nro_cliente = "";

$sql2="select * from afip where nro_laboratorio like '$cuenta'";
$result2 = $db_bq->Execute($sql2);
$cuit=strtoupper($result2->fields["nro_afip"]);
$tipo_fact=strtoupper($result2->fields["sit_iva"]); //letras
$tipo_iva=strtoupper($result2->fields["sit_iva"]); //numero

 include("../../../conexiones/config_pro.php");
$sql7="select * from condiciones_socios where cuenta like '$cuenta'";
$result7 = $db->Execute($sql7);
$plan=strtoupper($result7->fields["plan"]);


switch ($tipo_iva){
	case "RESPONSABLE INSCRIPTO":{
$tipo_fact = "1";
$fact = "A";
$tipo_iva = 1;
		break;
	}

	case "EXENTO":{
$tipo_fact = "4";
$fact = "B";
$tipo_iva = 4;
		break;
	}

		case "MONOTRIBUTISTA":{
$tipo_fact = "3";
$tipo_iva = 3;
$fact = "B";
		break;
	}

			case "CONS. FINAL":{
$tipo_fact = "5";
$fact = "B";
$tipo_iva = 5;
$leyenda = "Irregular situación AFIP";
include ("../../../alertas/campo_vacio.php");
EXIT;
		break;
	}

}


break;
	}
}



$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` ) VALUES ( '$fact' , '$comprobante' , '1' , '$tipo_iva' , '$nro_cliente' , '$nro_cuenta' , 'MIG' , '$operador' , '$denominacion' , '$fecha_emision' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$importe_orginal' , '$forma_pago' )";
$result7=$db_pro->Execute($sql);


echo "<br>";
$result->MoveNext();
	}
?>