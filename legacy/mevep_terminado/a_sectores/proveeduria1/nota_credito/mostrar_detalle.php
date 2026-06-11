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
$sql6 = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura";
$result6 = $db->Execute($sql6);
$forma_pago=strtoupper($result6->fields["forma_pago"]);
$porc_dto=strtoupper($result6->fields["porc_dto"]);


$sql3 = "SELECT * FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $nro_factura";
$result3 = $db->Execute($sql3);
?>
<table width="103%" border="0">
  <tr bgcolor="#C4D7E6" class="Estilo26">
    <td colspan="9" scope="col"><span class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Plan: <span class="Estilo47 Estilo48"><?echo $plan;?>  Forma Pago: <?echo $forma_pago;?></span></span></span></td>
  </tr>
  <tr bgcolor="#CFCFCF" class="Estilo26">
    <td width="6%" scope="col"><div align="center" class="Estilo2 Estilo1">N&ordm;</div></td>
    <td scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46"></span></div>      <div align="center" class="Estilo3"><span class="Estilo6"><span class="Estilo46">Descripcion / Mercaderia</span></span></div></td>
    <td width="8%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Presentacion</span></div></td>
    <td width="6%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Cantidad</span></div></td>
	    <td width="6%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46"> Lote</span></div></td>
		    <td width="8%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46">Vencimiento</span></div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo6 Estilo2 Estilo1"><span class="Estilo46"> Pr. Unit,</span></div></td>
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


$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result = $db->Execute($sql);

$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);
$margendif=strtoupper($result->fields["margendif"]);
//if ($plan == 1){
$margendif = 0;
//}

$porce_margendif = (($precio_actualizado * $margendif) /100);
$precio_actualizado = $precio_actualizado + $porce_margendif;


$sql1 = "SELECT * FROM existencias  WHERE  `cod_mercaderia` = $cod_mercaderia";
$result1 = $db->Execute($sql1);
$lote=strtoupper($result1->fields["lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$cantidad_ingresada =$result1->fields["cantidad_ingresada"];
$cantidad_salida =$result1->fields["cantidad_salida"];


$sql18 = "SELECT SUM(cantidad_ingresada) as cant FROM existencias  WHERE  `cod_mercaderia` = '$cod_mercaderia' ";
$result18 = $db->Execute($sql18);
$cant_lotes=strtoupper($result18->fields["cant"]);

$sql18 = "SELECT SUM(cantidad_salida) as salid FROM existencias  WHERE  `cod_mercaderia` = '$cod_mercaderia' ";
$result18 = $db->Execute($sql18);
$cant_salid_lotes=strtoupper($result18->fields["salid"]);


$sql98 = "SELECT sum(cantidad) as cant_temp FROM `ventas1_deta_temp`  WHERE  `cod_mercaderia` = $cod_mercaderia";
$result98 = $db->Execute($sql98);
$cant_temp=$result98->fields["cant_temp"];

$cant_exis = ($cant_lotes - $cant_salid_lotes) - $cant_temp;

$cantidad_existente = ($cantidad_ingresada - $cantidad_salida) - $cant_temp;

$sql6 = "SELECT * FROM `tasas_planes`  WHERE  `cod_plan` = $plan";
$result6 = $db->Execute($sql6);

$descuento_1=strtoupper($result6->fields["descuento_1"]);
$porc_descuento_1= (($precio_actualizado * $descuento_1)/100);
$precio_actualizado = $precio_actualizado - $porc_descuento_1;


$descuento_2=strtoupper($result6->fields["descuento_2"]);
$porc_descuento_2= (($precio_actualizado * $descuento_2)/100);
$precio_actualizado = $precio_actualizado - $porc_descuento_2;

$recargo_1=strtoupper($result6->fields["recargo_1"]);
$porc_recargo_1= (($precio_actualizado * $recargo_1)/100);
$precio_actualizado = $precio_actualizado + $porc_recargo_1;

$recargo_2=strtoupper($result6->fields["recargo_2"]);
$porc_recargo_2= (($precio_actualizado * $recargo_2)/100);
$precio_actualizado = $precio_actualizado + $porc_recargo_2;

$recargo_impuesto=strtoupper($result6->fields["recargo_impuestos"]);
$porc_recargo_impuesto= (($precio_actualizado * $recargo_impuesto)/100);
$precio_actualizado = $precio_actualizado + $porc_recargo_impuesto;


$precio_actualizado = round($precio_actualizado,2);


 $total = $precio_actualizado * $cantidad; //subtotal

$sql_update = "UPDATE `ventas1_deta_temp` SET `precio_unitario` = '$precio_actualizado','`total` = '$total' WHERE `cod_detalle` = '$cod_detalle'";
mysql_query($sal_update);

$sql_ventas = "UPDATE `ventas1_encab_temp` SET `plan` = '$plan' WHERE nro_factura = $nro_factura ";
mysql_query($sql_ventas);



$suma_total = $suma_total + $total;

$desc_factura = ($suma_total * $porc_dto)/100;
$subtotal = $suma_total - $desc_factura; // neto grabado
$iva = ($subtotal * 21) /100;
$total_factura = round($subtotal,2) + round($iva,2);

$cont = $cont + 1;



?>
  <tr bordercolor="#FFFFCC" bgcolor="#E0EDF3">
    <td scope="col"><div align="center"><span class="Estilo47 Estilo48"><span class="Estilo26"><?echo $renglon;?></span></span></div></td>
    <?

			



?>


    <td height="27" scope="col"><div align="left" class="Estilo47 Estilo48"><span class="Estilo26"><?echo $cod_mercaderia. " - ".$descripcion." (".$cant_exis.")";?></span></div></td>
    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26"><?echo $presentacion;?></span></div></td>
    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26"><?echo $cantidad;?></span></div></td>
	    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26"><?echo $lote1;?></span></div></td>
		    <td scope="col"><div align="center" class="Estilo46"><span class="Estilo26"><?echo $vto_lote;?></span></div></td>

    <td scope="col"><div align="right" class="Estilo46"><span class="Estilo26">$ <?echo number_format($precio_actualizado,2);?></span></div></td>
    <td scope="col"><div align="right" class="Estilo46"><span class="Estilo26">$ <?echo number_format($total,2);?></span></div></td>
   <td width="4%" bgcolor="#E0EDF3" class="Estilo6"><div align="center">
   <a href="borrar_item.php?cod_detalle=<?print("$cod_detalle");?>&&nro_factura=<?print("$nro_factura");?>&&nro_cliente=<?print("$nro_cliente");?>&&matricula=<?print("$matricula");?>&&pasada=1&&forma_pago=<?print("$forma_pago");?>&&dia=<?print("$dia");?>&&mes=<?print("$mes");?>&&anio=<?print("$año");?>&&mes=<?print("$mes");?>&&band=<?print("$band");?>&&operador=<?print("$operador");?>" onclick="return confirm('¿Está seguro de borrar este producto?');"><IMG SRC="../../../imagenes/office/095.ico" alt="Anular"  border = "0"></a>
   
 
   </div></td>
  </tr>
<?

	 $result3->MoveNext();
				}


 $sumatoria = $cont;
		$cont = 0;

//include ("espacios_en_blancos_detalle.php");
$sumatoria = 0;

?>
</table>
<table width="103%" border="0">
		  <tr bgcolor="#CFCFCF" >
    <td width="18%" height="20" scope="col"><span class="Estilo76">Subtotal     
  $ <?echo round($suma_total,2);?></span></td>
    <td width="19%" scope="col"><span class="Estilo76">Descuento $ <?echo round($desc_factura,2);?></span></td>
    <td width="17%" scope="col"><div align="center"> <div align="center"><span class="Estilo76">Neto Grav.  $ <?echo round($subtotal,2);?></span> </div></td>
    <td width="21%" scope="col"><div align="center"><span class="Estilo76">IVA $ <?echo number_format($iva,2);?></span></div></td>
    <td width="25%" colspan="4" scope="col"><strong><span class="Estilo76">
       TOTAL $ <?echo number_format($total_factura,2);?></span></td>
  </tr>
<?

?></table>


