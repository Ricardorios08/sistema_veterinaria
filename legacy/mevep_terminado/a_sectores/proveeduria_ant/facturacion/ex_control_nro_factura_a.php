
<table width="95%" border="0">
        <tr bgcolor="#000099"><td width="4%" height="21" valign="middle"><div align="center" class="Estilo4 Estilo7 Estilo10 Estilo21 Estilo16"></div>
            <div align="right" class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16">
              <div align="center"><span class="Estilo4">Cant</span></div>
          </div>            </td>
        <td colspan="3" valign="middle"><div align="center" class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16">
          <div align="center">Detalle</div>
        </div></td>
        <td width="13%" valign="middle"><div align="center"><span class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16">Presentaci&oacute;n</span></div></td>
        <td width="8%" valign="middle"><div align="center"><span class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16"> Lote</span></div></td>

        <td width="9%" valign="middle"><div align="center"><span class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16"> Vto Lote</span></div></td>
        <td width="9%"><div align="center" class="Estilo11 Estilo21 Estilo16"><span class="Estilo4">Pr. Unit. </span></div></td>
        <td width="12%" height="21"><div align="center" class="Estilo11 Estilo21 Estilo16"><span class="Estilo4">Total</span></div></td>
      </tr>


<?

include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result3 = $db->Execute($sql);
if (!$result3) die("fallo".$db->ErrorMsg());

 while (!$result3->EOF) {
$renglon = $renglon + 1;
$cod_mercaderia=strtoupper($result3->fields["cod_mercaderia"]);
$cantidad=strtoupper($result3->fields["cantidad"]);
$presentacion=strtoupper($result3->fields["presentacion"]);
$descripcion=strtoupper($result3->fields["descripcion"]);
$cod_detalle=strtoupper($result3->fields["cod_detalle"]);
$lote1=strtoupper($result3->fields["lote"]);
$lote = $lote1;
$mes_lote=strtoupper($result3->fields["mes_lote"]);
$anio_lote=strtoupper($result3->fields["anio_lote"]);
$vto_lote = $mes_lote."/".$anio_lote;

$precio_actualizado=strtoupper($result3->fields["precio_unitario"]);
$total=strtoupper($result3->fields["total"]);



$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result = $db->Execute($sql);
$id_tasa=strtoupper($result->fields["id_tasa"]);

$sql2="select * from tasas where cod_tasa = $id_tasa";
$result2 = $db->Execute($sql2);

$iva_normal=strtoupper($result2->fields["iva_normal"]);


 
$margendif=strtoupper($result->fields["margendif"]);
//if ($plan == 1){
$margendif = 0;
//}

 
 
 $total = $precio_actualizado * $cantidad; //subtotal

$sql_update = "UPDATE `ventas1_deta_temp` SET `precio_unitario` = '$precio_actualizado','`total` = '$total' WHERE `cod_detalle` = '$cod_detalle'";
//mysql_query($sal_update);

$sql_ventas = "UPDATE `ventas1_encab_temp` SET `plan` = '$plan' WHERE nro_factura = $nro_factura ";
//mysql_query($sql_ventas);




$subtotal = $subtotal + $total;
$desc_fact = ($subtotal * $porc_dto)/100;
$neto_gravado = $subtotal - $desc_fact;
$iva = ($neto_gravado * $iva_normal) /100;
$total_factura = round($neto_gravado,2) + round($iva,2);



$cont = $cont + 1;


?><tr bgcolor="#E8DCFC">
    <td height="20" scope="col"><div align="center" class="Estilo7 Estilo4 Estilo16"><span class="Estilo40 Estilo17  Estilo14"><?echo $cantidad;?></span></div></td>

    <td height="20" colspan="3" scope="col"><div align="center"  ">
        <div align="left" class="Estilo17" ><?echo $cod_mercaderia. " - ".$descripcion?></div>
    </div></td>
    <td height="20" scope="col"><div align="center"><span class="Estilo17"><?echo $presentacion;?></span></div></td>
    <td height="20" scope="col"><div align="center"><span class="Estilo17"><?echo $lote;?></span></div></td>
    <td scope="col"><div align="center"><span class="Estilo17"><?echo $mes_lote." - ".$anio_lote;?></span></div></td>
    <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17 Estilo7 Estilo4 Estilo16">
      <div align="right">$ <?echo number_format($precio_actualizado,3);?></div>
    </div></td>
    <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17 Estilo7 Estilo4 Estilo16">
      <div align="right">$ <?echo number_format($total,2);?></div>
    </div></td>
   
  </tr>

<?
	 $result3->MoveNext();
		}
 
?>



<tr bgcolor="#E6E6E6">
  <td height="20" colspan="3" scope="col"><div align="right"><span class="Estilo4 Estilo28"></span></div>    <div align="right"></div>    
    <div align="center"><span class="Estilo4 Estilo28"></span><span class="Estilo4 Estilo28"><strong>SubTotal: $ <?echo number_format($subtotal,2);?></strong></span></div></td>
  <td width="22%" scope="col"><div align="center"><span class="Estilo4 Estilo28"><span class="Estilo4 Estilo13"><span class="Estilo23"><span class="Estilo24"><span class="Estilo28"><strong>Descuento $ <?echo number_format($desc_fact,2);?></strong></span></span></span></span></span></div></td>
  <td height="20" scope="col"><div align="right"><span class="Estilo4 Estilo13"><span class="Estilo23"><span class="Estilo24"><span class="Estilo28"><span class="Estilo4 Estilo28"><strong>Neto Grav. $ <?echo number_format($neto_gravado,2);?></strong></span></span></span></span></span></div></td>
  <td height="20" scope="col">&nbsp;</td>
  <td height="20" scope="col"><span class="Estilo4 Estilo13"><span class="Estilo23"><span class="Estilo24"><span class="Estilo28"><span class="Estilo14 Estilo39 Estilo38 Estilo28  Estilo4">IVA: $ <?echo number_format($iva,2);?></span></span></span></span></span></td>
  <td colspan="2" scope="col"><div align="right"><span class="Estilo4 Estilo13"><span class="Estilo23"><span class="Estilo24"><span class="Estilo28"></span></span></span></span></div>    <div align="right"><span class="Estilo14 Estilo39 Estilo38 Estilo28  Estilo4"><strong>TOTAL: $ <?echo number_format($total_factura,2);?>
   </strong></span></span></div></td>
  </tr>



 </table>


<?$total_factura = 0;
$neto = 0;
$iva = 0;
$sumatoria = $cont;
		$cont = 0;

//include ("espacios_en_blancos.php");
$sumatoria = 0;?>
</html>
</form>
</body>