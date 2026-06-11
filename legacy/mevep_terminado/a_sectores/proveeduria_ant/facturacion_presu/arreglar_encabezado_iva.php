<?include ("../../../conexiones/config_grabacion.php");


$sql2 = "SELECT * FROM `ventas_encabezado` where cod_operacion != '6'";
$result2 = $db_pro->Execute($sql2);

if (!$result2) die("fallo".$db_pro->ErrorMsg());

 while (!$result2->EOF) {

$nro_factura=$result2->fields["nro_factura"];
$nro_cliente =$result2->fields["nro_cliente"];
$matricula=$result2->fields["nro_cuenta"];

if ($nro_cliente!=0){

$sql7="select * from condiciones_clientes where cuenta like '$nro_cliente'";
$result7 = $db_pro->Execute($sql7);
$tipo_iva =$result7->fields["iva"];
echo $nro_factura;
ECHO $sql21 = "UPDATE `ventas_encabezado` SET  `tipo_iva` = '$tipo_iva' WHERE nro_cliente = '$nro_cliente'";
$result21 = $db_pro->Execute($sql21);
echo "<br>";

}elseif ($matricula!=""){ 

$sql3="select * from afip where nro_laboratorio like '$matricula'";
$result3 = $db_bq->Execute($sql3);


$tipo_fact=strtoupper($result3->fields["sit_iva"]); //letras


switch ($tipo_fact){

		case "RESPONSABLE INSCRIPTO":{
$tipo_iva = 1;
		break;
	}

	case "EXENTO":{
$tipo_iva = 4;
		break;
	}

		case "MONOTRIBUTISTA":{

$tipo_iva = 3;
		break;
	}

			case "CONS. FINAL":{
$tipo_iva = 5;

		break;
	}



}
echo $nro_factura;
ECHO $sql21 = "UPDATE `ventas_encabezado` SET  `tipo_iva` = '$tipo_iva' WHERE nro_cuenta = '$matricula'";
$result21 = $db_pro->Execute($sql21);
echo "<br>";


	
}

$result2->MoveNext();

 }