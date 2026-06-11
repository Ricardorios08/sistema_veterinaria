

?><table width="103%" border="0">
  <tr bgcolor="#FFFFFF">
    <td width="62%" scope="col"><div align="center" class="Estilo26 Estilo38 Estilo39">Descripcion / Mercaderia</div></td>
    <td width="16%" scope="col"><div align="center" class="Estilo28 Estilo38 Estilo39">Cantidad</div></td>
    <td width="11%" scope="col"><div align="center" class="Estilo28 Estilo38 Estilo39"> C/U</div></td>
    <td width="11%" scope="col"><div align="center" class="Estilo28 Estilo38 Estilo39">Total</div></td>
    
  </tr><?



?>
</table>



<?//*************************************************?>

<style type="text/css">
<!--
.Estilo1 {font-family: "Courier New", Courier, mono}
.Estilo4 {font-family: "Courier New", Courier, mono; font-size: 10px; }
.Estilo8 {font-family: "Courier New", Courier, mono; font-size: 12; font-weight: bold; }
.Estilo11 {font-size: 11px}
.Estilo14 {font-family: Arial, Helvetica, sans-serif}
.Estilo15 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo16 {font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
-->
</style>

<style type="text/css" media="print">
div.page {
writing-mode: tb-rl;
height: 80%;
margin: 10% 0%;
}
</style>



<style type="text/css">
<!--
.Estilo17 {font-size: 10px}
.Estilo18 {font-weight: bold}
.Estilo19 {font-size: 10px; font-family: Arial, Helvetica, sans-serif; }
.Estilo22 {font-size: 9px}
-->
</style>
<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">

<?



include ("../../../conexiones/config_pro.php");
$cod_detalle = $_REQUEST['cod_detalle'];
$nro_factura= $_REQUEST['nro_factura'];
$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$año= $_REQUEST['anio'];
$nro_cliente= $_REQUEST['nro_cliente'];
$matricula= $_REQUEST['matricula'];
$forma_pago= $_REQUEST['forma_pago'];
$cantidad= $_REQUEST['cantidad'];
$cod_mercaderia= $_REQUEST['cod_mercaderia'];
$band= $_REQUEST['band'];






?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<table width="121%" border="0">
  <tr>
    <td width="49%" scope="col"><table width="432" border="0">
      <!--DWLayoutTable-->
      <tr>
        <td height="20" colspan="4"><div align="right" class="Estilo8 Estilo11 Estilo14"></div>          <span class="Estilo8 Estilo11 Estilo14"></span>          <div align="right"><span class="Estilo8 Estilo11 Estilo14"></span></div></td>
        </tr>
      <tr>
        <td height="21" colspan="4"><div align="right"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo18"><span class="Estilo14 Estilo22">Fecha:</span> <?echo $dia."/".$mes."/".$año;?></span></span></div></td>
      </tr>
      <tr>
        <td height="21" colspan="4"><div align="left"><span class="Estilo16">Sres::</span><span class="Estilo15"> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $matricula;?></span></span></div>          </td>
        </tr>
      <tr>
        <td height="21" colspan="4"><div align="left"><span class="Estilo16">Domicilio:</span><span class="Estilo15"> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $domicilio;?></span></span></span></div>          </td>
        </tr>
      <tr>
        <td height="21" colspan="3"><div align="left" class="Estilo15"></div>          <div align="left"></div>          
          <span class="Estilo14  Estilo11">IVA</span><span class="Estilo19"><span class="Estilo15  Estilo17">:</span></span><span class="Estilo15  Estilo17"></span><span class="Estilo15 Estilo17"> <?print("$tipo_fact");?></span></td>
        <td width="90" valign="top" class="Estilo11 Estilo14"><span class="Estilo17"><span class="Estilo16">Cuit: </span></span><strong><span class="Estilo18  Estilo17"><?echo $cuit;?></span></strong></td>
      </tr>
      <tr>

        <td width="155" height="21" valign="top"><div align="center" class="Estilo16"></div>
            <div align="right" class="Estilo4 Estilo11 Estilo14">
              <div align="center">Descripcion / Mercaderia </div>
            </div>            <div align="right" class="Estilo16"></div>            </td>
        <td width="113"><div align="center"><span class="Estilo14 Estilo17">Cantidad</span></div></td>
        <td width="56"><div align="center"><span class="Estilo14 Estilo17">C/U</span></div></td>
        <td height="21"><div align="center"><span class="Estilo14 Estilo17">Total</span></div></td>
      </tr>


<?

include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `deta_fact`  WHERE  `nro_factura` = $nro_factura";
$result = $db->Execute($sql);
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
    <td height="21" scope="col"><span class="Estilo28 Estilo38 Estilo39"><?echo $cod_mercaderia. " - ".$descripcion;?></span></td>
    <td scope="col"><div align="center" class="Estilo40"><span class="Estilo28"><?echo $cantidad;?></span></div></td>
    <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17"><span class="Estilo28">$ <?echo $precio_unitario;?></span></div></td>
    <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17"><span class="Estilo28">$ <?echo $total;?></span></div></td>
   
  </tr>
<?

	 $result->MoveNext();
		

		}
?>
      <tr>
        <td colspan="4"><div align="right"><span class="Estilo16"><strong>$ <?echo number_format($total_factura,2,",",".");?></strong></span></div></td>
      </tr>
    </table></td>
    <td width="8%" scope="col">&nbsp;</td>
    <td width="43%" scope="col">&nbsp;</td>
  </tr>
</table>
</body>



</html>





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