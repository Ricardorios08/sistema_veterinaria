<?php 

//tabla clientes
include ("../../../conexiones/config_pro.php");
$sql="select * from proveedores where cuenta = $cuenta";
$result = $db->Execute($sql);

$cuenta=strtoupper($result->fields["cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$contacto=strtoupper($result->fields["contacto"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$puerta=strtoupper($result->fields["puerta"]);
$referencia=strtoupper($result->fields["referencia"]);
$cod_postal=strtoupper($result->fields["cod_postal"]);
$localidad=strtoupper($result->fields["localidad"]);
$caracteristica_1=strtoupper($result->fields["caracteristica_1"]);
$telefono_1=strtoupper($result->fields["telefono_1"]);
$caracteristica_2=strtoupper($result->fields["caracteristica_2"]);
$telefono_2=strtoupper($result->fields["telefono_2"]);
$caracteristica_3=strtoupper($result->fields["caracteristica_3"]);
$telefono_3=strtoupper($result->fields["telefono_3"]);
$email=strtoupper($result->fields["email"]);
$cuit=strtoupper($result->fields["cuit"]);
$tipo_iva=strtoupper($result->fields["tipo_iva"]);
$ing_bruto=strtoupper($result->fields["ing_bruto"]);
$nro_ib=strtoupper($result->fields["nro_ib"]);
$pago_orden=strtoupper($result->fields["pago_orden"]);;
$observaciones=strtoupper($result->fields["observaciones"]);

switch ($tipo_iva){
	case "1":{
$tipo_iva = "Responsable Inscripto";
		break;
	}

	case "2":{
$tipo_iva = "Monotributista";
		break;
	}

		case "3":{
$tipo_iva = "Exento";
		break;
	}

		case "4":{
$tipo_iva = "Consumidor Final";
		break;
	}

}

switch ($ing_bruto){
	case "1":{
$ing_bruto = "Normal";
		break;
	}

	case "2":{
$ing_bruto = "Convenio Multilateral";
		break;
	}

		case "3":{
$ing_bruto = "Exento";
		break;
	}

		
}
?>

