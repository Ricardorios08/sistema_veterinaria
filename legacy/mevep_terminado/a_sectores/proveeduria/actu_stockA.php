<?
include("../../conexiones/config_pro.php");
$sql="select * from stock order by cod_mercaderia";
$result = $db->Execute($sql);

if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cod_merca = $cod_mercaderia;

echo $cod_movimiento = strtoupper($result->fields["cod_movimiento"]);
echo $cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
echo "--";
echo $lote=strtoupper($result->fields["lote"]);
echo "--";
echo $cantidad=strtoupper($result->fields["cantidad"]);
echo "--";

$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);







$sql1 = "SELECT cantidad_salida, cantidad_ingresada FROM `existencias` WHERE cod_mercaderia = '$cod_mercaderia' and lote = '$lote' and anio_lote = '$anio_lote' and mes_lote = '$mes_lote'";
$result1 = $db->Execute($sql1);
echo $cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
echo $cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);
echo "<br>";




switch ($cod_movimiento){

case "1":{
$cantidad_ingresada = $cantidad_ingresada + $cantidad;	
	break;
}

case "2":{
$cantidad_ingresada = $cantidad_ingresada + $cantidad;	
break;
}

case "3":{
$cantidad_ingresada = $cantidad_ingresada + $cantidad;	
break;
}

case "5":{
$cantidad_salida = $cantidad_salida + $cantidad;
break;
}

case "6":{
$cantidad_salida = $cantidad_salida + $cantidad;
break;
}
}




echo $sql3 = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_salida' , `cantidad_ingresada` = '$cantidad_ingresada' WHERE cod_mercaderia = $cod_mercaderia and lote = $lote and anio_lote = $anio_lote and mes_lote = $mes_lote";
mysql_query($sql3);
//actulizando salida en existencia

$cantidad_a_guardar = 0;

$cont = $cont +1;


$result->MoveNext();
	}

echo "<br>";
echo $cont;
?>
