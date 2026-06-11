<?php
include ("../../../../conexiones/config_pro.php");

 echo $cod_merca = $_GET['cod_merca'];
 echo $nombre = $_GET['nombre'];
 echo $cantidad = $_GET['cantidad'];


 


$SQL="Delete From compras_proveedorese cod_merca = $a and nombre = $b";
$db->Execute($SQL);


include ("borra_despues.php");