<table width="103%" border="0">
  <tr>
    <td height="21" colspan="3" scope="col"><div align="right" class="Estilo40">Fecha: <?echo $dia."/".$mes."/".$año;?></div></td>
  </tr>
  <tr>
    <th height="21" colspan="2" scope="col"><div align="left" class="Estilo40">Se&ntilde;ores: <?echo $matricula;?></div>      </th>
    <td width="34%" scope="col"><span class="Estilo40">Cuenta: <?echo $matricula;?></span></td>
  </tr>
  <tr>
    <td height="21" scope="col"><div align="left" class="Estilo40">Domicilio: <?echo $domicilio;?></div></td>
    <td colspan="2" scope="col"><div align="left" class="Estilo40">Cuit: <?echo $domicilio;?></div></td>
  </tr>
  <tr>
    <td height="21" scope="col"><p align="left" class="Estilo40">Condici&oacute;n de Venta: <?echo $forma_pago;?></p>    </td>
    <td colspan="2" scope="col"><span class="Estilo40">Remito: <?echo remito;?></span></td>
  </tr>
  <tr>
    <td height="21" colspan="3" scope="col"><hr noshade></td>
  </tr>
</table>



 <?


include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `deta_fact`  WHERE  `nro_factura` = $nro_factura";
$result = $db->Execute($sql);
?><table width="103%" border="0">
  <tr bgcolor="#FFFFFF">
    <td width="62%" scope="col"><div align="center" class="Estilo26 Estilo38 Estilo39">Descripcion / Mercaderia</div></td>
    <td width="16%" scope="col"><div align="center" class="Estilo28 Estilo38 Estilo39">Cantidad</div></td>
    <td width="11%" scope="col"><div align="center" class="Estilo28 Estilo38 Estilo39"> C/U</div></td>
    <td width="11%" scope="col"><div align="center" class="Estilo28 Estilo38 Estilo39">Total</div></td>
    
  </tr><?

if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$precio_unitario=strtoupper($result->fields["precio_unitario"]);
$total=strtoupper($result->fields["total"]);
$cod_detalle=strtoupper($result->fields["cod_detalle"]);

$neto = $neto + $total;
$iva = ($neto * 21) /100;
$total_factura = round($neto,2) + round($iva,2);

$sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);

?><tr bgcolor="#FFFFFF">
    <td height="34" scope="col"><span class="Estilo28 Estilo38 Estilo39"><?echo $cod_mercaderia. " - ".$descripcion;?></span></td>
    <td scope="col"><div align="center" class="Estilo40"><span class="Estilo28"><?echo $cantidad;?></span></div></td>
    <td scope="col"><div align="right" class="Estilo40"><span class="Estilo28">$ <?echo $precio_unitario;?></span></div></td>
    <td scope="col"><div align="right" class="Estilo40"><span class="Estilo28">$ <?echo $total;?></span></div></td>
   
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
		  <tr bgcolor="#FFFFFF" class="Estilo26">
    <td width="13%" scope="col"><div align="center" class="Estilo35 Estilo36 Estilo38 Estilo39">
      <div align="right">Neto Grabado </div>
    </div></td>
    <td width="13%" scope="col"><div align="right" class="Estilo40">$ <?echo round($neto,2);?></div></td>
    <td width="12%" scope="col"><div align="right" class="Estilo40">IVA</div></td>
    <td width="18%" class="Estilo26 Estilo38 Estilo39" scope="col">$ <?echo round($iva,2);?></td>
    <td width="7%" scope="col"><span class="Estilo40">Percepci&oacute;n</span></td>
    <td width="5%" scope="col"><div align="right"><span class="Estilo38"><span class="Estilo39"></span></span></div></td>
    <td scope="col"><div align="right" class="Estilo40"></div>      <div align="right" class="Estilo40">TOTAL</div></td>
    <td width="10%" class="Estilo6 Estilo35 Estilo36"><div align="left" class="Estilo40">$<?echo $total_factura;?></div>      </td>
  </tr>
<?

?></table>