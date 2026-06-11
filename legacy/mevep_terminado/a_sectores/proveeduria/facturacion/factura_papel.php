<?
$actua= $_REQUEST['impri'];
$impri =$_REQUEST['actua'];


if ($impri != ""){
	include ("actualiza_A.php");
}else{
	include ("factura_papel_A.php");
}
?>