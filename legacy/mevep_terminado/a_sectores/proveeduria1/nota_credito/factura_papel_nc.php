<?
$actua= $_REQUEST['imprimir'];
$impri =$_REQUEST['Actualizar'];
$tipo_fact_afectado =$_REQUEST['tipo_fact_afectado'];

IF ($tipo_fact_afectado == "A"){

if ($impri != ""){
	include ("actualiza_B.php");
}else{
	include ("factura_papel_A.php");
}

}else{

if ($impri != ""){
	include ("actualiza_B.php");
}else{
	include ("factura_papel_B.php");
}

}
?>