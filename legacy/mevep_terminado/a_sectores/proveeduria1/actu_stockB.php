<?
include("../../conexiones/config_pro.php");
$sql="select * from stock where cod_movimiento = 5 and tipo_fact = 'B' order by cod_mercaderia";
$result = $db->Execute($sql);

if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cod_merca = $cod_mercaderia;
echo $cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
echo "--";
echo $lote=strtoupper($result->fields["lote"]);
echo "--";
echo $cantidad=strtoupper($result->fields["cantidad"]);
echo "--";

$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);

 $sql1 = "SELECT cantidad_salida FROM `existencias` WHERE cod_mercaderia = '$cod_mercaderia' and lote = '$lote' and anio_lote = '$anio_lote' and mes_lote = '$mes_lote'";
$result1 = $db->Execute($sql1);
echo $cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
echo "<br>";

$cantidad_a_guardar = $cantidad_salida + $cantidad;

echo $sql3 = "UPDATE `existencias_mod` SET `cantidad_salida` = '$cantidad_a_guardar' WHERE cod_mercaderia = $cod_mercaderia and lote = $lote and anio_lote = $anio_lote and mes_lote = $mes_lote";
//mysql_query($sql3);
//actulizando salida en existencia

$cantidad_a_guardar = 0;

$cont = $cont +1;


$result->MoveNext();
	}

echo "<br>";
echo $cont;
?>
