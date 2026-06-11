<?
include ("../../../conexiones/config_grabacion.php");

$nro_deta_recibo = $_REQUEST['nro_deta_recibo'];
$tipo_cuenta = $_REQUEST['tipo_cuenta'];
$busca= $_REQUEST['nro_os'];

$sql = "DELETE FROM recibos1_deta_temp_pro where nro_deta_recibo = $nro_deta_recibo";
$result = $db_cont->Execute($sql);



switch ($tipo_cuenta){
	case "1":{

include ("cobrar_proveeduria1.php");
include_once ("mostrar_detalle.php");
		break;
	}

	case "2":{

include ("cobrar_proveeduria1.php");
include_once ("mostrar_detalle.php");
		break;
	}

	}






?>

