<?php 

$busca = $_REQUEST['busca'];
$buscador_rapido = $_REQUEST['buscador_rapido'];

$opciones=$_REQUEST["opciones"];
$cod_fabricante=$_REQUEST["cod_fabricante"];


switch ($opciones){
	case "Existencias":{


include ("existencia.php");
		break;
	}

		


	case "Vencimiento de Lotes":{
include ("vto_lote.php");
		break;
	}

	case "Lotes Vencidos":{
include ("lotes_vencidos.php");
		break;
	}

	case "Lista de Precios":{
		include ("lista_precios.php");
		exit;
		break;

	}

		case "Facturas Vencidas":{
include ("fact_vencidas.php");

		break;}

}

?>