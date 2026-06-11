<?php
include ("../../../../conexiones/config_pro.php");

$a = $_GET['id'];
$SQL="Delete From detalle where cod_grabacion = $a";
$db->Execute($SQL); 
$a = $_GET['id'];
$SQL="Delete From detalle where cod_merca = $a";
$db->Execute($SQL); 
$a = $_GET['id'];
$SQL="Delete From detalle where nombre = $a";
$db->Execute($SQL);
$a = $_GET['id'];
$SQL="Delete From detalle where cantidad = $a";
$db->Execute($SQL);
 
 echo $cod_grabacion = $_GET['cod_grabacion'];
 echo $cod_merca = $_GET['cod_merca'];
 echo $nombre = $_GET['nombre'];
 echo $cantidad = $_GET['cantidad'];


include ("borra_despues.php");

//DELETE FROM `detalles´ WHERE `cod_grabacion´ =´´ AND   LIMIT 1