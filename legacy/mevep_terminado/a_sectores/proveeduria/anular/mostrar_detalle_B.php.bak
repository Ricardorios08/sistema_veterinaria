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


<?

include("../../../conexiones/config_pro.php");
 $sql6 = "SELECT * FROM `ventas_encabezado` WHERE  `nro_factura` = $nro_factura_afectada and tipo_fact = '$tipo_fact_afectado'";
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

$sql3 = "SELECT * FROM `ventas_detalle`   WHERE  `nro_factura` = '$nro_factura_afectada' and tipo_fact = '$tipo_fact_afectado'";
$result3 = $db->Execute($sql3);
?>
<table width="650" border="0">
  <tr bgcolor="#CFCFCF" class="Estilo26">
    <td width="6%" scope="col"><div align="center" class="Estilo2 Estilo1">N&ordm;</div></td>
    <td scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46"></span></div>      <div align="center" class="Estilo3"><span class="Estilo6"><span class="Estilo46">Descripcion / Mercaderia</span></span></div></td>
    <td width="8%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Presentacion</span></div></td>
    <td width="6%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Cantidad</span></div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46"> Pr. Unit</span></div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Total</span></div></td>
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
 $precio_actualizado=strtoupper($result3->fields["precio_unitario"]);

$precio_actualizado = round($precio_actualizado,2);
$total_renglon = round($precio_actualizado * $cantidad,2);

$subtotal = round($subtotal + $total_renglon,2);

?>
  <tr bordercolor="#FFFFCC" bgcolor="#E0EDF3">
    <td scope="col"><div align="center"><span class="Estilo47 Estilo48"><span class="Estilo26"><?echo $renglon;?></span></span></div></td>
    <?





?>


    <td height="27" scope="col"><div align="left" class="Estilo47 Estilo48"><span class="Estilo26"><?echo $cod_mercaderia. " - ".$descripcion." (".$cant_exis.")";?></span></div></td>
    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26"><?echo $presentacion;?></span></div></td>
    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26">
	<?echo $cantidad;?>
	
	
	</span></div></td>
    <td scope="col"><div align="right" class="Estilo46"><span class="Estilo26">$ <?echo number_format($precio_actualizado,2);?></span></div></td>
    <td scope="col"><div align="right" class="Estilo46"><span class="Estilo26">$ <?echo number_format($total_renglon,2);?></span></div></td>
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
<table width="650" border="0">
		  <tr bgcolor="#A0A7F5" >
    <td width="18%" height="20" scope="col"><div align="center"><span class="Estilo76">Subtotal</span></div></td>
    <td width="19%" scope="col"><div align="center"><span class="Estilo76">Descuento </span></div></td>
    <td width="17%" scope="col"><div align="center"> <div align="center"><span class="Estilo76">Neto Grav.  </span></div></td>
    <td width="21%" scope="col"><div align="center"><span class="Estilo76">IVA </span></div></td>
    <td width="25%" colspan="4" scope="col"><strong>
      <div align="center"><span class="Estilo76">
         TOTAL</span></div></td>
  </tr>
		  <tr bgcolor="#CFCFCF" >
		    <td height="20" scope="col"><div align="center"><span class="Estilo76"> $ <?echo round($subtotal,2);?></span></div></td>
		    <td scope="col"><div align="center"><span class="Estilo76">$ <?echo round($desc_factura,2);?></span></div></td>
		    <td scope="col"><div align="center"><span class="Estilo76">$ <?echo round($neto_gravado,2);?></span> </div></td>
		    <td scope="col"><div align="center"><span class="Estilo76">$ <?echo number_format($iva_fact,2);?></span></div></td>
		    <td colspan="4" scope="col"><div align="center"><span class="Estilo76">$ <?echo number_format($total_factura,2);?></span></div></td>
  </tr>
</table>
<?}else{?>
<table width="650" border="0">
		  <tr bgcolor="#A0A7F5" >
		    <td height="20" scope="col"><div align="center"><span class="Estilo76">Subtotal</span></div></td>
		    <td scope="col"><div align="center"><span class="Estilo76">Descuento</span></div></td>
		    <td scope="col">&nbsp;</td>
		    <td scope="col">&nbsp;</td>
		    <td colspan="4" scope="col"><div align="center"><span class="Estilo76">TOTAL </span></div></td>
  </tr>
		  <tr bgcolor="#CFCFCF" >
    <td width="18%" height="20" scope="col"><div align="center"><span class="Estilo76">  $ <?echo number_format($subtotal,2);?></span></div></td>
    <td width="19%" scope="col"><div align="center"><span class="Estilo76"> $ <?echo number_format($desc_factura,2);?></span></div></td>
    <td width="17%" scope="col"><div align="center"> <span class="Estilo76"> </span></div></td>
    <td width="17%" scope="col"><div align="center"> </div></td>
    <td width="29%" colspan="4" scope="col"><strong>
      <div align="center"><span class="Estilo76">$         <?echo number_format($total_factura,2);?></span></div></td>
  </tr>
</table>
<?}?>

