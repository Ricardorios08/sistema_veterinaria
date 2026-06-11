<?php 
global $palabra;
global $palabra1;
global $resultado;
global $a;


/*
function ceros($palabra) {
		if (strlen($palabra) == 1){
return	$resultado = "000".$palabra;
		}

if (strlen($palabra) == 2){
return	$resultado = "00".$palabra;
		}
		}

$cualquiera= 12;
echo ceros($cualquiera);


*/
$a= 21;
function ceros_nro_laboratorio($palabra) {
		
		if (strlen($palabra) == 1){
return	$resultado = "000".$palabra;
		}

		if (strlen($palabra) == 2){
return	$resultado = "00".$palabra;
		}

if (strlen($palabra) == 3){
return	$resultado = "0".$palabra;
		}

if (strlen($palabra) == 4){
return	$resultado = $palabra;
		}

						}


function ceros_nro_orden($palabra) {
		
		if (strlen($palabra) == 1){
return	$resultado = "0000000".$palabra;
		}

		if (strlen($palabra) == 2){
return	$resultado = "000000".$palabra;
		}

if (strlen($palabra) == 3){
return	$resultado = "00000".$palabra;
		}

		if (strlen($palabra) == 4){
return	$resultado = "0000".$palabra;
		}

		if (strlen($palabra) == 5){
return	$resultado = "000".$palabra;
		}

if (strlen($palabra) == 6){
return	$resultado = "00".$palabra;
		}

if (strlen($palabra) == 7){
return	$resultado = "0".$palabra;
		}

if (strlen($palabra) == 8){
return	$resultado = $palabra;
		}

						}


function ceros_nro_practica($palabra1) {
		
		if (strlen($palabra1) == 1){
return	$resultado1 = "00".$palabra1;
		}

		if (strlen($palabra1) == 2){
return	$resultado1 = "0".$palabra1;
		}

		if (strlen($palabra1) == 3){
return	$resultado1 = $palabra1;
		}
}



include ("../conexiones/config_gb.php");

$sqls = "TRUNCATE TABLE `para_cobol";
mysql_query($sqls);

echo $sql="select cod_grabacion from confirmada where confirmada = 1 and periodo = 6";
$result = $db->Execute($sql);
echo "ESTE PROCESO PUEDE TARDAR VARIOS MINUTOS POR FAVOR NO DESESPERARSE";

if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {
$cod_grabacion=$result->fields["cod_grabacion"];

echo $sql1 = "SELECT nro_laboratorio, nro_orden, nro_afiliado, fecha, medico FROM `ordenes`  WHERE `cod_grabacion` = $cod_grabacion";
$result1 = $db->Execute($sql1);

 if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {


$nro_laboratorio=$result1->fields["nro_laboratorio"];
$nro_laboratori= ceros_nro_laboratorio($nro_laboratorio);


$nro_orden=$result1->fields["nro_orden"];
$nro_ord = ceros_nro_orden($nro_orden);


if ($nro_orden == "0"){
	$nro_orden = $result1->fields["autorizacion"];
	$nro_ord = ceros_nro_orden($nro_orden);
}


$nro_afiliado=$result1->fields["nro_afiliado"];
$fecha=$result1->fields["fecha"];
$prescriptor=$result1->fields["medico"];

$sql2 = "SELECT nro_practica FROM `detalle`  WHERE `cod_grabacion` = $cod_grabacion";
$result2 = $db->Execute($sql2);

 if (!$result2) die("fallo".$db->ErrorMsg());
  while (!$result2->EOF) {

$practica=$result2->fields["nro_practica"];
$practic= ceros_nro_practica($practica);

$contenido = $nro_laboratorio.",".$nro_orden.",".$afiliado.",".$fecha.",".$practica.",".$prescriptor;

$result2->MoveNext();
echo $sql12 = "INSERT INTO `para_cobol` ( `nro_laboratorio` , `nro_orden` , `afiliado` , `fecha` , `prescriptor` , `practica` ) VALUES ('$nro_laboratori' , '$nro_ord' , '$nro_afiliado' , '$fecha' , '$prescriptor' , '$practic')";
mysql_query($sql12);

}



$result1->MoveNext();
}

$result->MoveNext();
}


