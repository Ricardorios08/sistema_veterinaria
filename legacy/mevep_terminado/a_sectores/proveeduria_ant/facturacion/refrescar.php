<style type="text/css">
<!--
.Estilo6 {font-size: 12}
.Estilo26 {
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->


<!--
.Estilo53 {font-family: Arial, Helvetica, sans-serif}
-->



</style>
	<?	
$anio_actual = date("y");
$mes_actual = date("m");


$nro_factura= $_REQUEST['nro_factura'];
//$tipo_iva= $_REQUEST['tipo_iva'];

$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$año= $_REQUEST['anio'];
$nro_cliente= $_REQUEST['nro_cliente'];
$matricula= $_REQUEST['matricula'];
$hab_lote= $_REQUEST['hab_lote'];
$aa= $_REQUEST['aa'];

 $operador=$_REQUEST["operador"];


$sql4 = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result4 = $db->Execute($sql4);
$forma_pago=strtoupper($result4->fields["forma_pago"]);
$tipo_iva=strtoupper($result4->fields["tipo"]);
$fact=strtoupper($result4->fields["tipo_fact"]);
$tipo_precio=strtoupper($result4->fields["nro_cuenta"]);



$plan;

$sql = "SELECT count(nro_factura) as cont from ventas1_deta_temp";
$result = $db->Execute($sql);
$items_cargados=strtoupper($result->fields["cont"]);

if ($items_cargados == 12){

$leyenda = "TOPE DE ITEMS = 12";
INCLUDE ("../../../alertas/campo_informacion.php");
if ($fact == "B"){
		include ("mostrar_detalle_B.php");
		}else{
		include ("mostrar_detalle.php");
		}
exit;

}

if ($plan == ""){
$sql = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result = $db->Execute($sql);
$plan=strtoupper($result->fields["plan"]);


}

else{


$sql8 = "SELECT * FROM `condiciones_clientes` where cuenta = $nro_cliente";
$result8 = $db->Execute($sql8);
$plan_encabezado=strtoupper($result8->fields["plan"]);


if ($plan != $plan_encabezado){
$sql = "UPDATE `ventas1_encab_temp` SET `plan` = '$plan' WHERE nro_factura = $nro_factura ";
//mysql_query($sql);

}
}



$forma_pago2;

/*if ($forma_pago == ""){
include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result = $db->Execute($sql);
 $forma_pago=strtoupper($result->fields["forma_pago"]);
}
*/
$forma_pago;

$sql = "UPDATE `ventas1_encab_temp` SET `forma_pago` = '$forma_pago' WHERE nro_factura = $nro_factura  and tipo_fact = '$fact'";
//mysql_query($sql);

//echo $sql = "INSERT INTO `ventas_temp` ( `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` ) VALUES ( '$nro_factura' , '$cod_operacion' , '$tipo' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' )";
//mysql_query($sql);


$cantidad= $_REQUEST['cantidad'];

$cod_mercaderia= $_REQUEST['cod_mercaderia'];
$band= $_REQUEST['band'];

 $sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result = $db->Execute($sql);
$descripcion=strtoupper($result->fields["nombre"]);
$presentacion=strtoupper($result->fields["presentacion"]);

$id_tasa=strtoupper($result->fields["id_tasa"]);

$sql2="select * from tasas where cod_tasa = $id_tasa";
$result2 = $db->Execute($sql2);

$iva_normal=strtoupper($result2->fields["iva_normal"]);



$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);

$sql1 = "select * from precio_costos";
$result1 = $db->Execute($sql1);

$dolar_compra=strtoupper($result1->fields["dolar_compra"]);
$dolar_venta=strtoupper($result1->fields["dolar_venta"]);
$costo=strtoupper($result1->fields["costo"]);
$empresas=strtoupper($result1->fields["empresas"]);
$regaleria=strtoupper($result1->fields["regaleria"]);
$por_menor=strtoupper($result1->fields["por_menor"]);




switch ($tipo_precio){
	case "1":{$precio_actualizado = $precio_actualizado * $empresas /100;break;}
	case "2":{$precio_actualizado = $precio_actualizado * $regaleria /100;break;}
	case "3":{$precio_actualizado = $precio_actualizado * $por_menor/100;break;}
}


if ($cod_mercaderia != "") {
if (($precio_actualizado == "") or ($precio_actualizado == 0.00)){
$leyenda = "ESE ARTICULO NO TIENE PRECIO CARGADO POR FAVOR CHEQUEE EL PRECIO ACTUALIZADO";
INCLUDE ("../../../alertas/campo_informacion2.php");
exit;
}
}







$cantidad_salida1 = "";

//$sql13 = "TRUNCATE TABLE `existencia_temporal`";
//$result13 = $db->Execute($sql13);

//echo $sql12 = "INSERT INTO `proveeduria`.`existencia_temporal` SELECT * FROM `proveeduria`.`existencias` WHERE  `cod_mercaderia` = '$cod_mercaderia' order by anio_lote, mes_lote";
//$result12 = $db->Execute($sql12);
if ($hab_lote == "NO"){
$sql1 = "SELECT * FROM existencias  WHERE  (`cod_mercaderia` = '$cod_mercaderia' and anio_lote > '$anio_actual') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '00') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '$anio_actual' and mes_lote >= '$mes_actual') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '00' and mes_lote = '00') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '$anio_actual' and mes_lote >= '$mes_actual') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '' and mes_lote = '') order by anio_lote, mes_lote";
}else{
 $sql1 = "SELECT * FROM existencias  WHERE  `cod_mercaderia` = '$cod_mercaderia' order by anio_lote, mes_lote";
}
$result1 = $db->Execute($sql1);

$sql18 = "SELECT SUM(cantidad_ingresada) as cant FROM existencias  WHERE  `cod_mercaderia` = '$cod_mercaderia' ";
$result18 = $db->Execute($sql18);
$cant_lotes=strtoupper($result18->fields["cant"]);

$sql18 = "SELECT SUM(cantidad_salida) as salid FROM existencias  WHERE  `cod_mercaderia` = '$cod_mercaderia' ";
$result18 = $db->Execute($sql18);
$cant_salid_lotes=strtoupper($result18->fields["salid"]);

$sql19 = "SELECT SUM(cantidad) as cant FROM ventas1_deta_temp  WHERE  `cod_mercaderia` = '$cod_mercaderia' ";
$result19 = $db->Execute($sql19);
$cant_temp=strtoupper($result19->fields["cant"]);

$cantidad_stock = $cant_lotes - $cant_salid_lotes - $cant_temp;


if ($cantidad_stock < $cantidad){
	$leyenda = "No alcanza la cantidad requerida en Existencia quedan ".number_format($cantidad_stock);
	include ("../../../alertas/campo_informacion2.php");
if ($fact == "B"){
		include ("mostrar_detalle_B.php");
		}else{
		include ("mostrar_detalle.php");
		}
	exit;
}

if ($cantidad_stock == 0){
	//$leyenda = "No alcanza la cantidad requerida en Existencia o no ingreso nada";
	//include ("../../../alertas/campo_informacion.php");
	if ($fact == "B"){
		include ("mostrar_detalle_B.php");
		}else{
		include ("mostrar_detalle.php");
		}
	exit;
}

$band = "NO";


$merca=strtoupper($result1->fields["cod_mercaderia"]);
if ($merca == ""){
$leyenda = "PRODUCTO VENCIDO O INEXISTENTE";
	include ("../../../alertas/campo_informacion.php");
	
if ($fact == "B"){
		include ("mostrar_detalle_B.php");
		}else{
		include ("mostrar_detalle.php");
		}
	exit;
}

if (!$result1) die("fallo".$db->ErrorMsg());

 while (!$result1->EOF) { 


	 
$lote=strtoupper($result1->fields["lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);


if ($cantidad_ingresada < $cantidad_salida){
	if ($fact == "B"){
		include ("mostrar_detalle_B.php");
		}else{
		include ("mostrar_detalle.php");
		}
	exit;
}


if ($cantidad_ingresada - $cantidad_salida != 0) {

$cantidad_existente = $cantidad_ingresada - $cantidad_salida;

switch ($band){

	case "NO":{
	
		if ($cantidad < $cantidad_existente){// cantidad menor que existencia
		include ("cuentas.php");
		if ($fact == "B"){
		include ("mostrar_detalle_B.php");
		}else{
		include ("mostrar_detalle.php");
		}
		exit;
		}elseif($cantidad == $cantidad_existente){ // cantidad igual que existencia

	
		$cantidad_salida1 = $cantidad_salida1 + $cantidad;
		include ("cuentas.php");
				if ($fact == "B"){
		include ("mostrar_detalle_B.php");
		}else{
		include ("mostrar_detalle.php");
		}
		exit;
		}elseif($cantidad > $cantidad_existente){  // cantidad mayor que existencia
		$dif = $cantidad - $cantidad_existente;
		$cantidad_restante = $cantidad - $dif;
		include ("cuentas_bucle.php");
		$band = "SI";
		$result1->MoveNext();}
break;
	}

	
	case "SI":{
		if ($dif < $cantidad_existente){       // Diferencia menor que existencia
		include ("cuentas.php");
				if ($fact == "B"){
		include ("mostrar_detalle_B.php");
		}else{
		include ("mostrar_detalle.php");
		}
		exit;
		}elseif($dif == $cantidad_existente){   // Diferencia igual que existencia
		include ("cuentas.php");
				if ($fact == "B"){
		include ("mostrar_detalle_B.php");
		}else{
		include ("mostrar_detalle.php");
		}
		exit;
		}elseif($dif > $cantidad_existente){    // Diferencia mayor que existencia
		$dif = $dif - $cantidad_existente;
		$cantidad_restante = $cantidad - $dif;
		include ("cuentas_bucle.php");
		
		$result1->MoveNext();
		
		//include ("mostrar_detalle.php");
		}
		break;
		
	}

}
 


//$result1->MoveNext();
 }
 else
	 {
	 $result1->MoveNext();
	 }// mueve registro
 }