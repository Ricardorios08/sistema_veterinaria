
<?php

include ("../../conexiones/config.inc.php");




$cod_socio= $_REQUEST['cod_socio'];
$anio= "20".$_REQUEST['anio'];


$ene=$_POST["ene"];
$feb=$_POST["feb"];
$mar=$_POST["mar"];

$abr=$_POST["abr"];
$may=$_POST["may"];
$jun=$_POST["jun"];

$jul=$_POST["jul"];
$ago=$_POST["ago"];
$set=$_POST["set"];

$oct=$_POST["oct"];
$nov=$_POST["nov"];
$dic=$_POST["dic"];


if ($ene == 1){$mes = 1;include ("rutina_deuda.php");}
if ($feb == 2){$mes = 2;include ("rutina_deuda.php");}
if ($mar == 3){$mes = 3;include ("rutina_deuda.php");}
if ($abr == 4){$mes = 4;include ("rutina_deuda.php");}
if ($may == 5){$mes = 5;include ("rutina_deuda.php");}
if ($jun == 6){$mes = 6;include ("rutina_deuda.php");}
if ($jul == 7){$mes = 7;include ("rutina_deuda.php");}
if ($ago == 8){$mes = 8;include ("rutina_deuda.php");}
if ($set == 9){$mes = 9;include ("rutina_deuda.php");}
if ($oct == 10){$mes = 10;include ("rutina_deuda.php");}
if ($nov == 11){$mes = 11;include ("rutina_deuda.php");}
if ($dic == 12){$mes = 12;include ("rutina_deuda.php");}

$leyenda = "DEUDA INGRESADA";
include ("../../alertas/campo_informacion.php");


include ("generar_deuda.php");