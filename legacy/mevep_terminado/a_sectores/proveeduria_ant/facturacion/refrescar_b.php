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
.Estilo3 {font-size: 10px}
.Estilo5 {color: #006633}
.Estilo8 {color: #FFFFFF}
.Estilo9 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }
.Estilo10 {font-size: 12px}
-->


<!--
.Estilo52 {color: #000000}
.Estilo53 {font-size: 12px; color: #000000; }
-->



</style>
	<?	



include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `deta_fact`  WHERE  `nro_factura` = $nro_factura";
$result = $db->Execute($sql);
?><table width="99%" border="0">
  <tr bgcolor="#FFBC79">
    <td width="53%" scope="col"><div align="center" class="Estilo26">Descripcion / Mercaderia</div></td>
	    <td width="7%" scope="col"><div align="center" class="Estilo26">Presentacion</div></td>
    <td width="6%" scope="col"><div align="center" class="Estilo28">Cantidad</div></td>
	    <td width="7%" scope="col"><div align="center" class="Estilo28"> Lote</div></td>
		    <td width="8%" scope="col"><div align="center" class="Estilo28"> Vencimiento</div></td>
    <td width="7%" scope="col"><div align="center" class="Estilo28"> C/U</div></td>
    <td width="7%" scope="col"><div align="center" class="Estilo28">Total</div></td>
    <td width="5%" class="Estilo28" scope="col"><div align="center">Borrar</div></td>
  </tr><?

if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);

$total=strtoupper($result->fields["total"]);
$cod_detalle=strtoupper($result->fields["cod_detalle"]);



$sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);

$sql3 = "SELECT * FROM existencias  WHERE  `cod_merca` = $cod_mercaderia";
$result3 = $db->Execute($sql3);
$cod_lote=strtoupper($result3->fields["cod_lote"]);
$vencimiento_lote=strtoupper($result3->fields["vencimiento_lote"]);
$precio_unitario=strtoupper($result3->fields["precio_unitario"]);


$neto = $neto + $total;
$iva = round(($neto * 21) /100,3);
$total_factura = round($neto,2) + round($iva,2);



?><tr bgcolor="#FFFFFF">
    <td height="34" scope="col"><div align="left"><span class="Estilo28"><?echo $cod_mercaderia. " - ".$descripcion;?></span></div></td>
    <td scope="col"><div align="center"><span class="Estilo26"><?echo $presentacion;?></span></div></td>
    <td scope="col"><div align="center"><span class="Estilo28"><?echo $cantidad;?></span></div></td>
	    <td scope="col"><div align="center"><span class="Estilo26"><?echo $cod_lote;?></span></div></td>
		    <td scope="col"><div align="center"><span class="Estilo28"><?echo $vencimiento_lote;?></span></div></td>

    <td scope="col"><div align="right"><span class="Estilo28">$ <?echo $precio_unitario;?></span></div></td>
    <td scope="col"><div align="right"><span class="Estilo28">$ <?echo $total;?></span></div></td>
   <td width="5%" class="Estilo6"><div align="center"><a href="borrar_item.php?cod_detalle=<?print("$cod_detalle");?>&&nro_factura=<?print("$nro_factura");?>&&nro_cliente=<?print("$nro_cliente");?>&&matriculae=<?print("$matricula");?>&&forma_pago=<?print("$forma_pago");?>&&dia=<?print("$dia");?>&&mes=<?print("$mes");?>&&anio=<?print("$año");?>&&mes=<?print("$mes");?>&&band=<?print("$band");?>"><IMG SRC="../../../imagenes/botones/btn_anular.gif" alt="Anular" border = "0"></a></div></td>
  </tr>
<?

	 $result->MoveNext();
				}

?>
</table>
<table width="103%" border="0">
		  <tr bgcolor="#FFFFFF" class="Estilo26">
		    <td colspan="8" scope="col"><hr noshade></td>
  </tr>
		  <tr bgcolor="#E1F2EF" class="Estilo26">
    <td width="13%" scope="col"><div align="center" class="Estilo35 Estilo36">
      <div align="right">Neto Grabado </div>
    </div></td>
    <td width="13%" scope="col"><div align="right">$ <?echo round($neto,2);?></div></td>
    <td width="12%" scope="col"><div align="right"><span class="Estilo37">IVA</span></div></td>
    <td width="18%" class="Estilo26" scope="col">$ <?echo round($iva,2);?></td>
    <td width="7%" scope="col"><span class="Estilo37">Percepci&oacute;n</span></td>
    <td width="5%" scope="col"><div align="right"></div></td>
    <td scope="col"><div align="right"></div>      <div align="right">TOTAL</div></td>
    <td width="10%" class="Estilo6 Estilo35 Estilo36"><div align="left">$<?echo $total_factura;?></div>      </td>
  </tr>
<?

?></table>


