<?php 
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
return	$resultado1 = "000".$palabra1;
		}

		if (strlen($palabra1) == 2){
return	$resultado1 = "00".$palabra1;
		}

		if (strlen($palabra1) == 3){
return	$resultado1 = "000".$palabra1;
		}

		if (strlen($palabra1) == 4){
return	$resultado1 = $palabra1;
		}
}

function ceros_nro_afiliado($palabra1) {
		
		if (strlen($palabra1) == 1){
return	$resultado1 = "0000000000000".$palabra1;
		}

		if (strlen($palabra1) == 2){
return	$resultado1 = "000000000000".$palabra1;
		}

		if (strlen($palabra1) == 3){
return	$resultado1 = "00000000000".$palabra1;
		}

		if (strlen($palabra1) == 4){
return	$resultado1 = "0000000000".$palabra1;
		}

		if (strlen($palabra1) == 5){
return	$resultado1 = "000000000".$palabra1;
		}

if (strlen($palabra1) == 6){
return	$resultado1 = "00000000".$palabra1;
		}

if (strlen($palabra1) == 7){
return	$resultado1 = "0000000".$palabra1;
		}

if (strlen($palabra1) == 8){
return	$resultado1 = "000000".$palabra1;
		}

		if (strlen($palabra1) == 9){
return	$resultado1 = "00000".$palabra1;
		}

if (strlen($palabra1) == 10){
return	$resultado1 = "0000".$palabra1;
		}

if (strlen($palabra1) == 11){
return	$resultado1 = "000".$palabra1;
		}

if (strlen($palabra1) == 12){
return	$resultado1 = "00".$palabra1;
		}

		if (strlen($palabra1) == 13){
return	$resultado1 = "0".$palabra1;
		}

		if (strlen($palabra1) == 14){
return	$resultado1 = $palabra1;
		}

}
?>