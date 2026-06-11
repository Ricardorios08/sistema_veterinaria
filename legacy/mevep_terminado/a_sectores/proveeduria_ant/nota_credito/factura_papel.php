<?
$actua= $_REQUEST['imprimir'];
$impri =$_REQUEST['Actualizar Stock'];


if ($impri != ""){
	include ("actualiza_A.php");
}else{
	include ("factura_papel_A.php");
}
?>