<?php

include ("../../../conexiones/config_pro.php");

$cuenta = $_GET['cuenta'];
$SQL="Delete From proveedores where cuenta = $cuenta";
$db->Execute($SQL);

$buscador_rapido = 2;
$borrar = 1;
$refre = "SI";
$a = 2;
include ("buscar_proveedores.php");



