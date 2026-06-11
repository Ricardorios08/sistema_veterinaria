<table width="700" border="0">
  <tr>
    <th colspan="4" scope="col">FACTURAS QUE NO SE LES HA COBRADO IVA EN ALGUN PRODUCTO </th>
  </tr>
  <tr>
    <th colspan="4" scope="col">POR TENER MAL LA TASA </th>
  </tr>
  <tr bgcolor="#CCCCCC">
    <th scope="col">Producto</th>
    <th scope="col">Denominacion</th>
    <th scope="col">Fecha</th>
    <th scope="col">N&ordm; Factura  </th>
	 <th scope="col">Neto </th>
	  <th scope="col">Saldo</th>
	    <th scope="col">Tipo</th>
		  <th scope="col">Pago</th>
  </tr>
  
  <?

  include ("../../conexiones/config_otro.php");


 $sql = "SELECT * FROM `mercaderia`  WHERE ( `id_tasa` != 1 ) AND ( `id_tasa` != 2 ) AND ( `id_tasa` != 3 )  GROUP BY `cod_merca`";

$result = $db_pro->Execute($sql);

   if (!$result) die("fallo".$db_pro->ErrorMsg());

  while (!$result->EOF) {
	
	
	$cod_mercaderia=$result->fields["cod_merca"];



$sql3="select * from ventas_detalle where (cod_mercaderia = '$cod_mercaderia' and nro_factura > 36325 and tipo_fact like 'A') or (cod_mercaderia = '$cod_mercaderia' and nro_factura > 50776 and tipo_fact like 'B') order by tipo_fact, nro_factura ";
	$result3 = $db_pro->Execute($sql3);

while (!$result3->EOF) {
	
	$tipo_fact=strtoupper($result3->fields["tipo_fact"]);
	$nro_factura=strtoupper($result3->fields["nro_factura"]);

	$sql4="select * from ventas_encabezado where nro_factura = $nro_factura and tipo_fact = '$tipo_fact'";
	$result4 = $db_pro->Execute($sql4);

$fecha=strtoupper($result4->fields["fecha"]);

 $denominacion=strtoupper($result4->fields["denominacion"]);
  $neto=strtoupper($result4->fields["neto"]);
  $forma_pago=strtoupper($result4->fields["forma_pago"]);


if ($fecha > '2010-04-31'){

	
	if ($forma_pago == "CTA/CTE"){
		
		$sql1 = "SELECT * FROM `composicion_saldos`  WHERE  `comprobante` = $nro_factura and tipo_Fact = '$tipo_fact'";
	$result1 = $db_pro->Execute($sql1);


$saldo=strtoupper($result1->fields["saldo"]);
$tipo_cuenta=strtoupper($result1->fields["tipo_cuenta"]);

if ($tipo_cuenta == 1){
	$tipo_cuenta = "ASO";
}
ELSEIF ($tipo_cuenta == 2){
	$tipo_cuenta = "EXT";
}

if (($saldo == 0.00) or ($saldo == "")){
$saldo = "LIQ";
}
	}
?><tr>
    <td><? echo $cod_mercaderia;?></td>
    <td><? echo $denominacion;?></td>
    <td><? echo $fecha;?></td>
    <td><? echo $tipo_fact;?> - <? echo $nro_factura;?></td>
    <td><? echo $neto;?></td>
    <td><? echo $saldo;?></td>
	 <td><? echo $tipo_cuenta;?></td>
	 <td><? echo $forma_pago;?></td>

  </tr>
 

  <?
$cont = $cont + 1;
}

	$result3->MoveNext();
	}

$result->MoveNext();
	}
?>
 <tr>
    <td colspan="4">Cantidad de Facturas <? echo $cont;?></td>
  </tr>
</table>


