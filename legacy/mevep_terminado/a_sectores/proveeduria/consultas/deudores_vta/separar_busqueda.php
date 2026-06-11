<?

$busca = $_REQUEST['busca'];
$dia_d= $_REQUEST['dia_d'];
$mes_d= $_REQUEST['mes_d'];
$anio_d= $_REQUEST['anio_d'];



 $mes_1 = $mes_d - 1;



if (strlen($mes_1) == 1){
$mes_1 = "0".$mes_1;
}


$fecha_hasta = $anio_d."-".$mes_d."-".$dia_d;
$fecha_hasta1 = $dia_d."-".$mes_d."-".$anio_d;




if ($fecha_hasta == "--"){
	$fecha_hasta = date("Y-m-d");
	$dia_d = date("d");
	$mes_1 = date("m") - 1;
	$anio_d = date("Y");

	if (strlen($mes_1) == 1){
$mes_1 = "0".$mes_1;
}


}


$fecha_desde = $anio_d."-".$mes_1."-".$dia_d;

$buscador_rapido = $_REQUEST['buscador_rapido'];

$opcione=$_POST["opciones"];
	for ($i=0;$i<count($opcione);$i++)    
	{     
$opciones = $opcione[$i];    
	}


$opcion = $_REQUEST['opcion'];


include ("cta_cte.php");
		

?>
