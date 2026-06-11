<?php

include ("../../../conexiones/config_pro.php");

$a = $_GET['id'];
$SQL="Delete From clientes where cuenta = $a";
$db->Execute($SQL);

$buscador_rapido = 2;
$palabra = $a;
$borrar = 1;
include ("buscar_clientes.php");



