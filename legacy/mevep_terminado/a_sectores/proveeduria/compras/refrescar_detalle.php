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
.Estilo14 {font-family: "Trebuchet MS"; font-size: 16px; font-weight: bold; }
.Estilo15 {font-family: "Trebuchet MS"}
.Estilo16 {font-family: "Trebuchet MS"; font-size: 12px; }
-->
</style>

<table width="860" border="1" cellspacing="0">
  <tr bgcolor="#FFBC79">
    <td colspan="2" bgcolor="#B8B8B8" scope="col"><div align="center" class="Estilo26 Estilo15 Estilo7">Descripcion / Mercaderia</div></td>
	    <td width="82" bgcolor="#B8B8B8" scope="col"><div align="center" class="Estilo26 Estilo15 Estilo7">Presentacion</div></td>
    <td width="56" bgcolor="#B8B8B8" scope="col"><div align="center" class="Estilo28 Estilo15 Estilo7">Cantidad</div></td>
	    <td width="30" bgcolor="#B8B8B8" scope="col"><div align="center" class="Estilo28 Estilo15 Estilo7"> Lote</div></td>
		    <td width="73" bgcolor="#B8B8B8" scope="col"><div align="center" class="Estilo28 Estilo15 Estilo7"> Vencimiento</div></td>
    <td width="81" bgcolor="#B8B8B8" scope="col"><div align="center" class="Estilo28 Estilo15 Estilo7"> C/U</div></td>
    <td width="73" bgcolor="#B8B8B8" scope="col"><div align="center" class="Estilo28 Estilo15 Estilo7">Total</div></td>
    <td width="38" bgcolor="#B8B8B8" class="Estilo28" scope="col"><div align="center" class="Estilo16">Borrar</div></td>
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
   <td width="38" class="Estilo6"><div align="center">   <a href="borrar_item.php?cod_detalle=<?php print("$cod_detalle");?>&&nro_factura=<?php print("$nro_factura");?>&&nro_proveedor=<?php print("$nro_proveedor");?>&&fecha=<?php print("$fecha");?>&&denominacion=<?php print("$denominaciono");?>&&porcentaje_dto=<?php print("$porcentaje_dto");?>&&porcentaje_boni=<?php print("$porcentaje_boni");?>&&band=<?php print("$band");?>"><IMG SRC="../../../imagenes/botones/btn_anular.gif" alt="Anular" border = "0"></a></div></td>
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
</table>


<table width="860" border="0" cellspacing="0">
  
  <?php 

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

?>
  
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
  
  <tr bgcolor="#E6E6E6">
    <td height="21" colspan="3" bgcolor="#B8B8B8" scope="col">
    
      <div align="right"><span class="Estilo16">Total</span></span>
        </div>     
      </div></td>
    <td width="12%" height="21" bgcolor="#B8B8B8" scope="col"><div align="right"><span class="Estilo14">  $<strong><?php echo number_format($total_neto,2);?></strong></span></div></td>
    <td width="5%" height="21" bgcolor="#B8B8B8" scope="col">&nbsp;</td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td height="21" bgcolor="#FFFFFF" scope="col"><div align="right"><span class="Estilo11"><strong>Cantidad Items:</strong></span></div></td>
    <td width="22%" height="21" bgcolor="#FFFFFF" scope="col"><span class="Estilo11"><strong><span class="Estilo6 Estilo7 Estilo28"><strong><?php echo $total_item;?></strong></span></strong></span></td>
    <td colspan="3" rowspan="2" bgcolor="#FFFFFF" scope="col"><div align="right"><span class="Estilo6 Estilo7 Estilo28"><strong><A HREF="actualizar_stock.php"><IMG SRC="../../../imagenes/botones/stock.png" alt="Imprimir" border = "0"></A> <a href="informe.php"></a></strong></span></div></td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td width="31%" height="21" bgcolor="#FFFFFF" scope="col"><div align="right" class="Estilo11">Cantidad Ingresada: </div></td>
    <td height="21" bgcolor="#FFFFFF" scope="col"><span class="Estilo11"><span class="Estilo6 Estilo7 Estilo28"><strong><?php echo $total_cantidad;?></strong></span></span></td>
  </tr>
</table>
