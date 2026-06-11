<?
$actua= $_REQUEST['impri'];
$impri =$_REQUEST['actua'];


if ($impri != ""){
	include ("actualiza_B.php");
}else{
	include ("factura_papel_B.php");
}
?>