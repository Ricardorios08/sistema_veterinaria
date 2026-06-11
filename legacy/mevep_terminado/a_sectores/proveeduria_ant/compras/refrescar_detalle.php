<?php include("../../../conexiones/config_pro.php");
$nro_factura;
if ($nro_factura != ""){
$sql = "SELECT * FROM `compras1_deta_temp`  WHERE  `nro_factura` = $nro_factura";
}

$result = $db->Execute($sql);





?>
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif}
.Estilo7 {font-size: 12px}
.Estilo9 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo11 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo12 {color: #FF0000}
-->
</style>

<table width="750" border="0">
  <tr bgcolor="#FFBC79">
    <td colspan="2" scope="col"><div align="center" class="Estilo26">Descripcion / Mercaderia</div></td>
	    <td width="11%" scope="col"><div align="center" class="Estilo26">Presentacion</div></td>
    <td width="7%" scope="col"><div align="center" class="Estilo28">Cantidad</div></td>
	    <td width="4%" scope="col"><div align="center" class="Estilo28"> Lote</div></td>
		    <td width="9%" scope="col"><div align="center" class="Estilo28"> Vencimiento</div></td>
    <td width="10%" scope="col"><div align="center" class="Estilo28"> C/U</div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo28">Total</div></td>
    <td width="5%" class="Estilo28" scope="col"><div align="center">Borrar</div></td>
  </tr><?php 

if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$lote=strtoupper($result->fields["lote"]);
$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);
$precio_unitario=strtoupper($result->fields["precio_unitario"]);
$total=strtoupper($result->fields["total"]);
$cod_detalle=strtoupper($result->fields["cod_detalle"]);

$vto_lote = $mes_lote." / ".$anio_lote;



$sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["nombre"]);
$presentacion=strtoupper($result2->fields["presentacion"]);

?><tr bgcolor="#FFFFFF">
    <td height="34" colspan="2" scope="col"><div align="left" class="Estilo6 Estilo7"><span class="Estilo28"><?php echo $cod_mercaderia. " - ".$descripcion;?></span></div></td>
    <td scope="col"><div align="center" class="Estilo9"><span class="Estilo26"><?php echo $presentacion;?></span></div></td>
    <td scope="col"><div align="center" class="Estilo9"><span class="Estilo28"><?php echo $cantidad;?></span></div></td>
	    <td scope="col"><div align="center" class="Estilo9"><span class="Estilo26"><?php echo $lote;?></span></div></td>
		    <td scope="col"><div align="center" class="Estilo9"><span class="Estilo28"><?php echo $vto_lote;?></span></div></td>

    <td scope="col"><div align="right" class="Estilo9"><span class="Estilo28">$ <?php echo $precio_unitario;?></span></div></td>
    <td scope="col"><div align="right" class="Estilo9"><span class="Estilo28">$ <?php echo $total;?></span></div></td>
   <td width="5%" class="Estilo6"><div align="center">   <a href="borrar_item.php?cod_detalle=<?php print("$cod_detalle");?>&&nro_factura=<?php print("$nro_factura");?>&&nro_proveedor=<?php print("$nro_proveedor");?>&&fecha=<?php print("$fecha");?>&&denominacion=<?php print("$denominaciono");?>&&porcentaje_dto=<?php print("$porcentaje_dto");?>&&porcentaje_boni=<?php print("$porcentaje_boni");?>&&band=<?php print("$band");?>"><IMG SRC="../../../imagenes/botones/btn_anular.gif" alt="Anular" border = "0"></a></div></td>
  </tr>
<?php 


	        $total_cantidad = $total_cantidad + $cantidad;
	        $total_unitario = $precio_unitario + $cantidad;
	        $total_neto = $total_neto + $total;

			$descuento = ($total_neto * $porcentaje_dto) /100;
$total_gral = $total_neto - $descuento;
									
$total_item = $total_item + 1;
	 $result->MoveNext();
				}

?>

<tr bgcolor="#FFFFFF">
  <td height="21" colspan="9" scope="col"><hr noshade></td>
  </tr>
<tr bgcolor="#E6E6E6">
    <td width="15%" height="21" scope="col"><div align="right"><span class="Estilo11">Sub Total  $<span class="Estilo6 Estilo7 Estilo28"><span class="Estilo9"><strong><span class="Estilo28"><?php echo number_format($total_neto,2);?></span></strong></span></span> </span></div></td>
    <td scope="col"><div align="center"><span class="Estilo11">Descuento $ <span class="Estilo6 Estilo7 Estilo28"><span class="Estilo9"><strong><span class="Estilo28"><?php echo number_format($descuento,2);?></span></strong></span></span> </span></div>      <div align="center"></div></td>
    <td height="21" colspan="4" scope="col"><span class="Estilo11"></span>      <div align="left"><span class="Estilo6 Estilo7 Estilo28"><span class="Estilo9"><strong></strong></span></span></div>      <div align="right" class="Estilo9">
      <div align="left"><strong><span class="Estilo11">% Descuento <span class="Estilo6 Estilo7 Estilo28"><strong><span class="Estilo28"><?php echo number_format($porcentaje_dto,2);?></span></strong></span> </span></strong></div>
    </div>      <div align="right" class="Estilo9"><strong></strong></div>      <span class="Estilo11"></span></td>
    <td height="21" colspan="3" scope="col"><span class="Estilo11">Neto Grabado $ <span class="Estilo6 Estilo7 Estilo28"><span class="Estilo9"><strong><span class="Estilo28"><?php echo number_format($total_gral,2);?></span></strong></span></span></span></td>
  </tr>
<tr bgcolor="#E6E6E6">
  <td height="21" scope="col"><div align="right" class="Estilo11"><strong>Cantidad Items: <span class="Estilo6 Estilo7 Estilo28"><strong><?php echo $total_item;?></strong></span> </strong></div></td>
  <td height="21" scope="col"><span class="Estilo11"></span></td>
  <td height="21" colspan="7" scope="col"><span class="Estilo11">Cantidad de Mercaderia Ingresada: <span class="Estilo6 Estilo7 Estilo28"><strong><?php echo $total_cantidad;?></strong></span></span><span class="Estilo6 Estilo7 Estilo28"></span></td>
  </tr>
<tr bgcolor="#E6E6E6">
  <td height="21" colspan="3" scope="col"><div align="right" class="Estilo12"><BLINK>Presione actulizar para guardar la compra </BLINK></div></td>
  <td colspan="6" scope="col"><span class="Estilo6 Estilo7 Estilo28"><strong>
   

<A HREF="actualizar_stock.php"><IMG SRC="../../../imagenes/botones/stock.png" alt="Imprimir" border = "0"></A> 

<a href="informe.php"><IMG SRC="../../../imagenes/botones//btn_imprimir.gif" alt="Imprimir" border = "0"></a>
  
  </strong></span></td>
</tr>
</table>


