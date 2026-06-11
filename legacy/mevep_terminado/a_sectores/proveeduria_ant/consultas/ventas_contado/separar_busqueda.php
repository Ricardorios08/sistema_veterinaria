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

	case "ASOCIADOS":{
		$tipo = 1;
include ("ana_saldos.php");
		break;
	}

	case "EXTERNOS":{
				$tipo = 2;
include ("ana_saldos.php");
		break;
	}
}

?>
