<?

echo "---".$busca = $_REQUEST['busca'];
$buscador_rapido = $_REQUEST['buscador_rapido'];

$opciones=$_REQUEST["opciones"];


if ($busca == ""){
include ("consultas.php");
}else{
include ("cambiar_existencia.php");
}





?>