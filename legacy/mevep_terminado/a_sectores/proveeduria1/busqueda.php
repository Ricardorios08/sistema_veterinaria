<?

$busca = $_REQUEST['busca'];
$buscador_rapido = $_REQUEST['buscador_rapido'];

$opcione=$_POST["opciones"];
	for ($i=0;$i<count($opcione);$i++)    
	{     
$opciones = $opcione[$i];    
	}


$pla=$_POST["plan"];
	for ($i=0;$i<count($pla);$i++)    
	{     
$plan = $pla[$i];    
	}

if ($plan == ""){
	$plan = 1;
}

echo $opciones;

switch ($opciones){
	case "mod_cli":{
include ("clientes/buscar_clientes.php");
		break;
	}

	case "Proveedores":{
include ("proveedores/buscar_proveedores.php");
		break;
	}

	case "Mercaderia":{
include ("mercaderia/buscar_mercaderia.php");
		break;
	}



		case "Compras":{
			include ("compras/buscar_factura_compra.php");

		break;}


				case "Existencia":{
			include ("compras/existencia.php");

		break;
	}

		case "Facturas":{
	include ("buscar/buscar_facturas.php");

		break;
	}
}
?>