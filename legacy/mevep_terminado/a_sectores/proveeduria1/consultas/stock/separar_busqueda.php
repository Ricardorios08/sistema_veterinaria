<?

$busca = $_REQUEST['busca'];
$buscador_rapido = $_REQUEST['buscador_rapido'];

$opcione=$_POST["opciones"];
	for ($i=0;$i<count($opcione);$i++)    
	{     
$opciones = $opcione[$i];    
	}
$opcion = $_REQUEST['opcion'];

switch ($opciones){
	case "Mercaderia":{
include ("stock.php");
		break;
	}

	case "Rango Fecha":{
include ("stock.php.php");
		break;
	}

}

?>
