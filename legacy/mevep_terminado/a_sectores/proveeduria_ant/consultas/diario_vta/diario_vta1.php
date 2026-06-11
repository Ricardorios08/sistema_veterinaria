<style type="text/css">
<!--
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo5 {font-size: 12px}
.Estilo8 {font-size: 14px}
.Estilo74 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
 

<!-- 
<a href="imp_pendientes.php?a='excel'&&buscar_por=<?print("$buscar_por");?>"><IMG SRC="../../imagenes/botones//btn_exportar.gif" alt="Exportar" border = "0"></a> -->


<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 



<?

// este mismo programa con seleccion de bioquimico corte por mes sera estadistica de venta

/*  mes    CONTADO   CTA CTE
	01         $5000
 	02                   $600
	03
*/


$nro_factura;




?>
<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo70 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo72 {font-size: 12px}
.Estilo72 {font-family: Arial, Helvetica, sans-serif}
.Estilo74 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>



<table width="102%" height="145" border="0">
  <!--DWLayoutTable-->
<tr valign="middle" bgcolor="#000099">
    <td height="26" colspan="5"><div align="center" class="Estilo2">
      <div align="center"><span class="Estilo5"><span class="Estilo8">Diario de Ventas del dia: <?ECHO $fecha_a;?></span> </span></div>
    </div></td>
  </tr>
   <tr bgcolor="#DAFAFC">
     <td width="10%" height="21"><div align="center"><span class="Estilo2">Movimiento</span>
     </div>
     <td width="12%"><div align="center"><span class="Estilo2">Comprobante</span></span></div></td>
     <!-- <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Proveedor</span></div></td> -->
<td width="54%" ><div align="center"><span class="Estilo2">Titular</span></span></div></td>
<td width="12%" ><div align="center"><span class="Estilo2">Ventas Diferidas</span></span></div></td>
     <td width="12%" ><div align="center" class="Estilo2"><span class="Estilo2 Estilo5">Ventas Contado 
        </div>
     </div></td>
   </tr>
   <tr valign="top" bgcolor="#DAFAFC">
     <td height="21" colspan="5">  <hr noshade>     </tr>

	 <?

include ("../../../../conexiones/config_pro.php");

$sql="select * from ventas_encabezado where fecha = '$fecha' ORDER by tipo_fact , nro_factura, fecha desc";
$result = $db->Execute($sql);

  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cuent = $cuenta;

$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result->fields["nro_cuenta"]);

if ($nro_cliente != 0){
$cuenta=$nro_cliente;
}elseif ($nro_cuenta != 0){
$cuenta=$nro_cuenta;

}

 $cod_movimiento=strtoupper($result->fields["cod_operacion"]);
 $forma_pago=strtoupper($result->fields["forma_pago"]);
$nro_factura=strtoupper($result->fields["nro_factura"]);
$cod_operacion = strtoupper($result->fields["cod_operacion"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);

$fecha=strtoupper($result->fields["fecha"]);
$descuento=strtoupper($result->fields["descuento"]);

$bonificacion=strtoupper($result->fields["bonificacion"]);
$subtotal=strtoupper($result->fields["subtotal"]);
$iva=strtoupper($result->fields["iva"]);
$total=strtoupper($result->fields["total"]);
$periodo=strtoupper($result->fields["periodo"]);
$anio=strtoupper($result->fields["anio"]);
$neto=strtoupper($result->fields["neto"]);

SWITCH ($cod_movimiento){

case "1":{
$entrada = $precio_renglon;
$movimiento = "FACTURA";
BREAK;
}

case "2":{
$entrada = $precio_renglon;
$movimiento = "NOTA DE DEBITO";
BREAK;
}

case "3":{
$salida = $precio_renglon;
$movimiento = "NOTA DE CREDITO";


BREAK;
}

case "4":{
$salida = $precio_renglon;
$movimiento = "PAGO POR CAJA";
BREAK;
}


CASE "5":{
$salida = $precio_renglon;
$movimiento = "DESC X LIQUIDACION";
BREAK;
}

CASE "6":{
$salida = ($precio_renglon * -1);
$movimiento = "ANULADA";
BREAK;
}

}


if ($forma_pago == 'CTA/CTE'){
$cta_cte = $neto;
if ($cod_movimiento == 3){//nota
$cta_cte = ($cta_cte * -1);
}

$suma_cta_cte = $suma_cta_cte + $cta_cte;


}
ELSEIF($forma_pago == 'CONTADO'){
$contado = $neto;

if ($cod_movimiento == 3){//nota
$contado = ($contado * -1);
}

$suma_contado = $suma_contado + $contado;
}



if ($cta_cte == 0.00){
	$cta_cte = "-";
}
else

	  {
$cta_cte = "$ ".number_format($cta_cte,2);
	  }

if ($contado == 0.00){
	$contado = "-";
}
else
{
$contado = "$ ".number_format($contado,2);
	  }




//$cuenta = "(".$cuenta.") ".$denominacion;
?>
<tr>
  <td height="21"><div align="center" class="Estilo70"><?print("$movimiento");?></div></td>
<td><div align="center" class="Estilo5"><?print("$tipo_fact");?> - <?print("$nro_factura");?></div></td>
<td><div align="center" class="Estilo5"> <div align="left"><?print("$cuenta");?> 
 - <?print("$denominacion");?></div>
</div>    </td>



<td><div align="center" class="Estilo5">
  <div align="right"><?echo $cta_cte;?></div>
</div></td>
<td><div align="center" class="Estilo5">
  <div align="right"><?echo $contado;?></div>
</div></td>
</tr>





<?

$cuenta = "";
	

	$result->MoveNext();
	}


	?>

	<tr>
	  <td height="21" colspan="5"><hr noshade></td>
  </tr>
	<tr>
  <td height="21" colspan="3"><div align="right" class="Estilo74"><strong>TOTAL</strong></div></td>
  <td><div align="center" class="Estilo74 Estilo72">
    <div align="right"><strong><span class="Estilo72">$ <?echo number_format($suma_cta_cte,2);?></span></strong></div>
  </div></td>
  <td><div align="center" class="Estilo74 Estilo72">
    <div align="right"><strong><span class="Estilo72">$ <?echo number_format($suma_contado,2);?></span></strong></div>
  </div></td>
  </tr>

</table>




