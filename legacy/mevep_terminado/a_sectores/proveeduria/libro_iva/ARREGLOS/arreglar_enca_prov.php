<?

include("../../../../conexiones/config_grabacion.php");
echo $sql2 = "SELECT * FROM `ventas_encabezado` where cod_operacion != '6'";
$result2 = $db_pro->Execute($sql2);

if (!$result2) die("fallo".$db->ErrorMsg());

 while (!$result2->EOF) {

$tipo_fact=strtoupper($result2->fields["tipo_fact"]);
echo $nro_factura=strtoupper($result2->fields["nro_factura"]);


$nro_cliente=strtoupper($result2->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result2->fields["nro_cuenta"]);


if ($nro_cliente != 0){
$cuenta=$nro_cliente;

$sql3="select * from condiciones_clientes where cuenta like '$cuenta'";
 
$result3 = $db_pro->Execute($sql3);
$tipo_iva=$result3->fields["iva"];



}elseif ($nro_cuenta != 0){
$cuenta=$nro_cuenta;

$sql4="select * from afip where nro_laboratorio like '$cuenta'";
$result4 = $db_bq->Execute($sql4);
 $sit_iva=$result4->fields["sit_iva"];


switch ($sit_iva){
	case "RESPONSABLE INSCRIPTO":{
echo "----------".$tipo_iva = 1;
		break;
	}

	case "MONOTRIBUTISTA":{
$tipo_iva = 3;
		break;
	}

	case "Monotributista":{
$tipo_iva = 3;
		break;
	}
}
}




//$neto=strtoupper($result2->fields["neto"]);
//$iva=strtoupper($result2->fields["iva"]);

//$neto_gravado = $neto - $iva;

$sql8 = "UPDATE `ventas_encabezado_back` SET  `tipo` = '$tipo_iva' WHERE `tipo_fact` = '$tipo_fact' AND `nro_factura` = '$nro_factura'";
$result8 = $db_pro->Execute($sql8);

	 $result2->MoveNext();
		}





