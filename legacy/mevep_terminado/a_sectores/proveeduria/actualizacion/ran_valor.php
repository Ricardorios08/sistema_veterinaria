<?php

include("../../../conexiones/config_pro.php");
$cod_mercaderia=$_REQUEST ['cod_mercaderia'];
$precio_nuevo=$_REQUEST ['precio_nuevo'];

$sql = "UPDATE `mercaderia` SET `precio_actualizado` = '$precio_nuevo' WHERE `cod_merca` = '$cod_mercaderia'";
mysql_query($sql);

include ("rango_valor.php");

