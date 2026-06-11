<style type="text/css">
<!--
.Estilo4 {
	color: #006633;
	font-size: 10px;
	font-weight: bold;
}
.Estilo6 {font-size: 12}
.Estilo16 {font-family: Arial, Helvetica, sans-serif}
.Estilo21 {font-size: 10px; color: #006633; }
.Estilo22 {color: #006633; font-size: 10px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; }
.Estilo26 {
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->


<!--
.Estilo30 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; }
.Estilo67 {color: #FFFFFF; font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
.Estilo69 {font-size: 12px}
.Estilo70 {color: #FFFFFF}
.Estilo71 {font-size: 10px}
.Estilo72 {font-size: 12px; color: #FFFFFF; }
.Estilo73 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->

<!--
.Estilo76 {font-family: Arial, Helvetica, sans-serif}
-->



</style>


<?include("../../../conexiones/config_pro.php");
$sql6 = "SELECT * FROM `notacredito_encab_temp`  WHERE  `nro_factura` = $nro_factura_nc";
$result6 = $db->Execute($sql6);
$forma_pago=strtoupper($result6->fields["forma_pago"]);

$plan=strtoupper($result6->fields["plan"]);
$descuento=strtoupper($result6->fields["descuento"]);
$bruto=strtoupper($result6->fields["bruto"]);


if ($descuento != 0.00){
$porc_dto = round($descuento / $bruto,2);
}

//$tipo_fact_afectado=strtoupper($result6->fields["tipo_fact"]);
$desc_fact = 0;

$sql3 = "SELECT * FROM `notacredito_deta_temp`  WHERE  `nro_factura` = $nro_factura_nc";
$result3 = $db->Execute($sql3);
?>
<table width="103%" border="0">
  <tr bgcolor="#CFCFCF" class="Estilo26">
    <td width="6%" scope="col"><div align="center" class="Estilo2 Estilo1">N&ordm;</div></td>
    <td scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46"></span></div>      <div align="center" class="Estilo3"><span class="Estilo6"><span class="Estilo46">Descripcion / Mercaderia</span></span></div></td>
    <td width="8%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Presentacion</span></div></td>
    <td width="6%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Cantidad</span></div></td>
	    <td width="6%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46"> Lote</span></div></td>
		    <td width="8%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Vencimiento</span></div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46"> Pr. Unit</span></div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Total</span></div></td>
    <td width="4%" scope="col"><div align="center"><span class="Estilo1">Borrar</span></div></td>
  </tr><?

if (!$result3) die("fallo".$db->ErrorMsg());

 while (!$result3->EOF) {
$renglon = $renglon + 1;
$cod_mercaderia=strtoupper($result3->fields["cod_mercaderia"]);
$cantidad=strtoupper($result3->fields["cantidad"]);
$presentacion=strtoupper($result3->fields["presentacion"]);
$descripcion=strtoupper($result3->fields["descripcion"]);
$cod_detalle=strtoupper($result3->fields["cod_detalle"]);
$lote1=strtoupper($result3->fields["lote"]);
$mes_lote=strtoupper($result3->fields["mes_lote"]);
$anio_lote=strtoupper($result3->fields["anio_lote"]);
$vto_lote = $mes_lote."/".$anio_lote;
$precio_actualizado=$result3->fields["precio_unitario"];


$total_renglon = round($precio_actualizado * $cantidad,3);

$subtotal = round($subtotal + $total_renglon,3);

?>
  <tr bordercolor="#FFFFCC" bgcolor="#E0EDF3">
    <td scope="col"><div align="center"><span class="Estilo47 Estilo48"><span class="Estilo26"><?echo $renglon;?></span></span></div></td>
    <?





?>


    <td height="27" scope="col"><div align="left" class="Estilo47 Estilo48"><span class="Estilo26"><?echo $cod_mercaderia. " - ".$descripcion." (".$cant_exis.")";?></span></div></td>
    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26"><?echo $presentacion;?></span></div></td>
    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26">
	<a href="borrar_cantidad.php?cod_detalle=<?print("$cod_detalle");?>&&tipo_fact_afectado=<?print("$tipo_fact_afectado");?>&&nro_factura_afectada=<?print("$nro_factura_afectada");?>&&nro_factura_nc=<?print("$nro_factura_nc");?>&&pasada=1&&forma_pago=<?print("$forma_pago");?>&&dia=<?print("$dia");?>&&mes=<?print("$mes");?>&&anio=<?print("$año");?>&&mes=<?print("$mes");?>&&mes_lote=<?print("$mes_lote");?>&&mes=<?print("$mes");?>&&anio_lote=<?print("$anio_lote");?>&&descripcion=<?print("$descripcion");?>&&presentacion=<?print("$presentacion");?>&&lote=<?print("$lote1");?>&&cod_mercaderia=<?print("$cod_mercaderia");?>&&cantidad=<?print("$cantidad");?>" onclick="return confirm('¿Está seguro de borrar este producto?');"><?echo $cantidad;?></a>
	
	
	</span></div></td>
	    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26"><?echo $lote1;?></span></div></td>
		    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26"><?echo $vto_lote;?></span></div></td>

    <td scope="col"><div align="right" class="Estilo46"><span class="Estilo26">$ <?echo number_format($precio_actualizado,2);?></span></div></td>
    <td scope="col"><div align="right" class="Estilo46"><span class="Estilo26">$ <?echo number_format($total_renglon,2);?></span></div></td>
   <td width="4%" bgcolor="#E0EDF3" class="Estilo6"><div align="center">
   <a href="borrar_item.php?cod_detalle=<?print("$cod_detalle");?>&&tipo_fact_afectado=<?print("$tipo_fact_afectado");?>&&nro_factura_afectada=<?print("$nro_factura_afectada");?>&&nro_factura_nc=<?print("$nro_factura_nc");?>&&pasada=1&&forma_pago=<?print("$forma_pago");?>&&dia=<?print("$dia");?>&&mes=<?print("$mes");?>&&anio=<?print("$año");?>&&mes=<?print("$mes");?>&&band=<?print("$band");?>&&operador=<?print("$operador");?>" onclick="return confirm('¿Está seguro de cambiar la cantidad?');"><IMG SRC="../../../imagenes/office/095.ico" alt="Anular"  border = "0"></a>
   
 
   </div></td>
  </tr>
<?

	 $result3->MoveNext();
				}

if ($tipo_fact_afectado == "A"){

$neto_gravado= $subtotal;

$porc_dto;
$desc_factura = round($neto_gravado * $porc_dto,2);
$subtotal = $subtotal - $desc_factura;
$iva_fact = round(($subtotal * 21)/100,2);

$total_factura = $subtotal + $iva_fact;
}

else

{

$desc_factura = round($subtotal * $porc_dto,2);
$neto_gravado = round(($subtotal/1.21),2);
$iva_fact = $subtotal - $neto_gravado;
$total_factura = $subtotal - $desc_factura;
}



 $sumatoria = $cont;
// $desc_fact = 0;
		$cont = 0;

//include ("espacios_en_blancos_detalle.php");
$sumatoria = 0;

?>
</table>

<?if ($tipo_fact_afectado =="A"){?>
<table width="103%" border="0">
		  <tr bgcolor="#CFCFCF" >
    <td width="18%" height="20" scope="col"><span class="Estilo76">Subtotal     
  $ <?echo round($subtotal,2);?></span></td>
    <td width="19%" scope="col"><span class="Estilo76">Descuento $ <?echo round($desc_factura,2);?></span></td>
    <td width="17%" scope="col"><div align="center"> <div align="center"><span class="Estilo76">Neto Grav.  $ <?echo round($neto_gravado,2);?></span> </div></td>
    <td width="21%" scope="col"><div align="center"><span class="Estilo76">IVA $ <?echo number_format($iva_fact,2);?></span></div></td>
    <td width="25%" colspan="4" scope="col"><strong><span class="Estilo76">
       TOTAL $ <?echo number_format($total_factura,2);?></span></td>
  </tr>
</table>
<?}else{?>
<table width="103%" border="0">
		  <tr bgcolor="#CFCFCF" >
    <td width="18%" height="20" scope="col"><span class="Estilo76">Subtotal     
  $ <?echo number_format($subtotal,2);?></span></td>
    <td width="19%" scope="col"><span class="Estilo76">Descuento $ <?echo number_format($desc_factura,2);?></span></td>
    <td width="17%" scope="col"><div align="center"> <span class="Estilo76"> </span></div></td>
    <td width="17%" scope="col"><div align="center"> </div></td>
    <td width="29%" colspan="4" scope="col"><strong>
      <div align="right"><span class="Estilo76">
         TOTAL $ <?echo number_format($total_factura,2);?></span></div></td>
  </tr>
</table>
<?}?>

