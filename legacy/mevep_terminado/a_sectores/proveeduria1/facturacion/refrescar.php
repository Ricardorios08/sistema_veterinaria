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
$tipo_iva=strtoupper($result4->fields["tipo_iva"]);
$porc_dto=strtoupper($result4->fields["porc_dto"]);

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


$cantidad= $_REQUEST['cantidad'];
$cod_mercaderia= $_REQUEST['cod_mercaderia'];
$band= $_REQUEST['band'];

 $sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = '$cod_mercaderia'";
$result = $db->Execute($sql);
$descripcion=strtoupper($result->fields["nombre"]);

$nombre=strtoupper($result->fields["nombre"]);
$tipo_moneda=strtoupper($result->fields["tipo_moneda"]);
$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);



$proveedor=strtoupper($result->fields["proveedor"]);
$cod_tasa=strtoupper($result->fields["cod_tasa"]);

$sql1 = "select * from tasas where cod_tasa = $cod_tasa";
$result1 = $db->Execute($sql1);
$iva_normal=strtoupper($result1->fields["iva_normal"]);


$sql1 = "select * from precio_costos";
$result1 = $db->Execute($sql1);
$dolar_compra=strtoupper($result1->fields["dolar_compra"]);
$dolar_venta=strtoupper($result1->fields["dolar_venta"]);
$costo=strtoupper($result1->fields["costo"]);
$empresas=strtoupper($result1->fields["empresas"]);
$regaleria=strtoupper($result1->fields["regaleria"]);
$por_menor=strtoupper($result1->fields["por_menor"]);

$costo1 = $precio_actualizado - round(($precio_actualizado * $costo)/100,3); // en dolar

IF ($tipo_moneda == "D"){
$en_dolar = round(($costo1 * $dolar_compra),3);
}


$en_empresas_dolar = $costo1 * $empresas;
$en_regaleria_dolar = $costo1 * $regaleria;
$en_por_menor_dolar  = $costo1 * $por_menor;


$en_empresas_pesos= $en_empresas_dolar * $dolar_venta;
$en_regaleria_pesos = $en_regaleria_dolar * $dolar_venta;
$en_por_menor_pesos  = $en_por_menor_dolar * $dolar_venta;



switch ($tipo_precio){
case "1":{// en empresas
$precio_actualizado = $en_empresas_pesos;
	break;
}
case "2":{// en regalerias
$precio_actualizado = $en_regaleria_pesos;
	break;
}
case "3":{// en por menor
$precio_actualizado = $en_por_menor_pesos;
	break;
}
  }


include ("cuentas.php");
include ("mostrar_detalle.php");









/*if (($precio_actualizado == "") or ($precio_actualizado == 0.00)){
$leyenda = "ESE ARTICULO NO TIENE PRECIO CARGADO POR FAVOR CHEQUEE EL PRECIO ACTUALIZADO";
INCLUDE ("../../../alertas/campo_informacion2.php");
exit;
}

*/


/*
if ($hab_lote == "NO"){
$sql1 = "SELECT * FROM existencias  WHERE  (`cod_mercaderia` = '$cod_mercaderia' and anio_lote > '$anio_actual') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '00') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '$anio_actual' and mes_lote >= '$mes_actual') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '00' and mes_lote = '00') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '$anio_actual' and mes_lote >= '$mes_actual') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote = '' and mes_lote = '') order by anio_lote, mes_lote";
}else{
 $sql1 = "SELECT * FROM existencias  WHERE  `cod_mercaderia` = '$cod_mercaderia'";
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
	include_once ("mostrar_detalle.php");
	exit;
}

if ($cantidad_stock == 0){
	//$leyenda = "No alcanza la cantidad requerida en Existencia o no ingreso nada";
	//include ("../../../alertas/campo_informacion.php");
	include_once ("mostrar_detalle.php");
	exit;
}

$band = "NO";


$merca=strtoupper($result1->fields["cod_mercaderia"]);
if ($merca == ""){
$leyenda = "PRODUCTO VENCIDO O INEXISTENTE";
	include ("../../../alertas/campo_informacion.php");
	include_once ("mostrar_detalle.php");
	exit;
}

if (!$result1) die("fallo".$db->ErrorMsg());

 while (!$result1->EOF) { 


$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);


if ($cantidad_ingresada < $cantidad_salida){
	include_once ("mostrar_detalle.php");
	exit;
}


if ($cantidad_ingresada - $cantidad_salida != 0) {

$cantidad_existente = $cantidad_ingresada - $cantidad_salida;



switch ($band){

	case "NO":{
	
		if ($cantidad < $cantidad_existente){// cantidad menor que existencia
		include ("cuentas.php");
			include ("mostrar_detalle.php");
		
		exit;
		}elseif($cantidad == $cantidad_existente){ // cantidad igual que existencia

	
		$cantidad_salida1 = $cantidad_salida1 + $cantidad;
		include ("cuentas.php");
		include ("mostrar_detalle.php");
	
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
		include ("mostrar_detalle.php");
		exit;
		}elseif($dif == $cantidad_existente){   // Diferencia igual que existencia
		include ("cuentas.php");
		include ("mostrar_detalle.php");
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

 casanova 3832 bermejo

 mat hoyos x avellaneda

 hotel 

 pegador

*/