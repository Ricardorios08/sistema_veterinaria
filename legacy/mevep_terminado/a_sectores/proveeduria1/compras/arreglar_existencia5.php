<?	
include("../../../conexiones/config_pro.php");


$sql2 = "SELECT * FROM `ventas_encabezado` order by fecha desc";
$result2 = $db->Execute($sql2);


if (!$result2) die("fallo".$db->ErrorMsg());
 while (!$result2->EOF) {


$nro_factura=$result2->fields["nro_factura"];
$nro_proveedor=$result2->fields["nro_proveedor"];
$fecha=$result2->fields["fecha"];


$sql3 = "SELECT * FROM `ventas_detalle` where nro_factura = '$nro_factura' order by 'cod_mercaderia'";
$result3 = $db->Execute($sql3);

$cod_mercaderia=$result3->fields["cod_mercaderia"];
$lote=$result3->fields["lote"];
$mes_lote=$result3->fields["mes_lote"];
$anio_lote=$result3->fields["anio_lote"];
$precio_unitario=$result3->fields["precio_unitario"];
$cantidad= $result3->fields["cantidad"]; 

$cont = $cont  + 1;



echo $sql6 = "SELECT sum(cantidad_salida) as cantidad_salida  FROM `existencia_arreglada` where cod_mercaderia = '$cod_mercaderia' and anio_lote = '$anio_lote' and mes_lote = '$mes_lote' and lote = '$lote'";
$result6 = $db->Execute($sql6);

$cantidad_salida=strtoupper($result6->fields["cantidad_salida"]);

$cantidad_guardar = $cantidad + $cantidad_salida;

 echo $sql = "UPDATE `existencia_arreglada` SET `cantidad_salida` = '$cantidad_guardar'  WHERE cod_mercaderia = '$cod_mercaderia' and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote= '$anio_lote'";
mysql_query($sql);


//mysql_query($sql);
echo "<br>";

$cantidad_guardar = "";

$result2->MoveNext();
				}

				echo $cont;