

<?php

include ("../../../conexiones/config_pro.php");

$cod_merca = $_GET['cod_merca'];
$SQL="Delete From mercaderia where cod_merca = $cod_merca";
$db->Execute($SQL);

$SQL="Delete From cod_barra_propio where cod_barra = $cod_merca";
$db->Execute($SQL);


$buscador_rapido = 2;
$palabra = $a;
$borrar = 1;
//include ("buscar_mercaderia.php");
echo "Mercaderia Eliminada";

