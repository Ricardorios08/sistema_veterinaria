<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
 <html>
 <style type="text/css">
<!--
.Estilo4 {font-family: Arial, Helvetica, sans-serif}
.Estilo7 {font-size: 12px}
.Estilo8 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo10 {color: #FFFFFF}
.Estilo11 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; }
.Estilo12 {font-weight: bold}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
.Estilo14 {color: #000000}
.Estilo15 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
-->
 </style>

 
 <body>
 
 <table width="816" height="68" border="0">
      <!--DWLayoutTable-->
      <tr bgcolor="#D0F9FB">
        <td height="20" colspan="2"><div align="left" class="Estilo8 Estilo14"><span class="Estilo11 Estilo14  Estilo4"><span class="Estilo16">Sres:</span> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $denominacion." (".$nro.")";?></span></span></span></div></td>
        <td width="344" height="20"><div align="right" class="Estilo15"><span class="Estilo16"><span class="Estilo22"><span class="Estilo11 Estilo14  Estilo4"><span class="Estilo18"><span class="Estilo22">Fecha:</span> <?echo $fecha;?></span></span></span></span></div></td>
      </tr>
      <tr bgcolor="#D0F9FB">
        <td height="20" colspan="2"><div align="left" class="Estilo8"><span class="Estilo16">Domicilio:</span><span class="Estilo15"> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $direccion;?></span></span></span></div>          </td>
        <td height="20"><div align="right" class="Estilo8"><span class="Estilo16"><span class="Estilo22">Operador: <span class="Estilo23"><?echo $operador;?> Control: <?echo $fact?> - <?echo $nro_factura?></span></span></span></div></td>
      </tr>
      <tr bgcolor="#D0F9FB">
        <td width="307" height="20"><div align="left" class="Estilo15 Estilo4 Estilo7"></div>          <div align="left" class="Estilo8"></div>          
        <span class="Estilo14 Estilo11 Estilo4 Estilo7">IVA</span><span class="Estilo19 Estilo4 Estilo7">:</span><span class="Estilo15 Estilo17 Estilo4 Estilo7"> <?print("$tipo_iva");?> - Cuit: <?echo $cuit;?> </span><span class="Estilo8"></span></span></span></td>
        <td colspan="2"><div align="right" class="Estilo8"><span class="Estilo15  Estilo17"><span class="Estilo11  Estilo14"><span class="Estilo17">COND.  VENTA: <?echo $forma_pago;?></span></span></span></div></td>
   </tr>
 </table>

<table width="817" border="0">
        <tr bgcolor="#000099"><td width="51" height="21" valign="middle"><div align="center" class="Estilo16 Estilo4 Estilo7 Estilo10"></div>
            <div align="right" class="Estilo11 Estilo4 Estilo7 Estilo10">
              <div align="center"><span class="Estilo17">Cant</span></div>
          </div>            </td>
        <td colspan="4" valign="middle"><div align="center" class="Estilo11 Estilo4 Estilo7 Estilo10">Detalle - Presentaci&oacute;n -  Lote - Vto Lote </div></td>
        <td width="139"><div align="center" class="Estilo11"><span class="Estilo17">Pr. Unit. </span></div></td>
        <td width="63" height="21"><div align="center" class="Estilo11"><span class="Estilo17">Total</span></div></td>
      </tr>


<?

include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $nro_factura";
$result = $db->Execute($sql);
if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$precio_unitario=strtoupper($result->fields["precio_unitario"]);
$lote=strtoupper($result->fields["lote"]);

$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);

$total=strtoupper($result->fields["total"]);
//$cod_detalle=strtoupper($result->fields["cod_detalle"]);

$neto = $neto + $total;
$iva = ($neto * 21) /100;
$total_factura = round($neto,2) + round($iva,2);

$sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);

$sql3="select * from existencias where cod_mercaderia = $cod_mercaderia";
$result3 = $db->Execute($sql3);
$cantidad_ingresada=strtoupper($result3->fields["cantidad_ingresada"]);


$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura= $nro_factura_nuevo;
}

$cantidad_vendida = $cantidad_ingresada - $cantidad;

$sql = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad' WHERE cod_mercaderia = $cod_mercaderia";
//mysql_query($sql);

$sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` ,  `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , 'EGRESOS' , '$nro_factura' , '$cantidad_vendida' , '$precio_unitario' , '$lote' , '$mes_lote' , '$anio_lote' , '$nro' ,  '$tipo_cuenta')" ;
//mysql_query($sql);


$sql = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_actualizado' , '$total')";
//mysql_query($sql);

?><tr bgcolor="#E8DCFC">
    <td height="20" scope="col"><div align="center" class="Estilo22 Estilo4 Estilo7"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $cantidad;?></span></span></div></td>

    <td height="20" colspan="4" scope="col"><div align="center" class="Estilo40 Estilo14 Estilo22 Estilo4 Estilo7">
        <div align="left"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo $cod_mercaderia. " - ".$descripcion." - ".$presentacion. " - ".$lote." - ".$mes_lote." - ".$anio_lote;?></span></span></div>
    </div></td>
    <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17 Estilo4 Estilo7">
      <div align="center"><span class="Estilo28 Estilo22"><?echo $precio_unitario;?></span></div>
    </div></td>
    <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17 Estilo4 Estilo7">
      <div align="center"><span class="Estilo28 Estilo22"><?echo $total;?></span></div>
    </div></td>
   
  </tr>
<?

	 $result->MoveNext();
		}

 $sumatoria = $cont;
		$cont = 0;

//include ("espacios_en_blancos.php");
$sumatoria = 0;
?>
      <tr>
        <td>&nbsp;</td>
        <td width="51">&nbsp;</td>
        <td width="95">&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>


      <tr bgcolor="#FFFFFF">
        <td height="40" colspan="3"><div align="center" class="Estilo13"></div>          <div align="center" class="Estilo22 Estilo14 Estilo4 Estilo12">
            <div align="center">Neto Gravado: <span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo number_format($neto,2);?></span></span></div>
        </div>          
        <div align="center" class="Estilo13"> </div>          <div align="center" class="Estilo13"></div></td>
        <td width="97"><div align="center"></div></td>
        <td colspan="2"><div align="center" class="Estilo13">          <span class="Estilo16 Estilo22"><span class="Estilo22 Estilo14"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22">IVA: <?echo number_format($iva,2);?></span></span></span></span></div></td>
        <td><div align="center" class="Estilo13"><span class="Estilo16 Estilo22">TOTAL: <?echo number_format($total_factura,2);?>

        <?


$sql = "INSERT INTO `resumen_cta_vta` ( `cuenta` , `tipo_cuenta` , `fecha` , `comprobante` , `cod_movimiento` , `importe` , `vencimiento` , `referencia` , `afectacion` ) VALUES ( '$nro' , '$tipo_cuenta' ,'$fecha' , '$nro_factura' , 'COMPRA' , '$total_factura' , '$vencimiento' , '$referencia' , '$afectacion')";
//mysql_query($sql);

$sql = "INSERT INTO `composicion_saldos` ( `cuenta` , `tipo_cuenta` , `comprobante` , `fecha_emision` , `importe_original` , `fecha_pago` , `saldo` , `vencimiento` , `cuotas` , `cuotas_pagadas` ) VALUES ( '$nro' , '$tipo_cuenta' , '$nro_factura' , '$fecha' , '$total_factura' , '' , '$total_factura' , '$vencimiento' , '0' , '0' )";
//mysql_query($sql);


//11 ventas
//12 nota de debito

//21 pago
//22 nota de credito

$sql = "TRUNCATE TABLE `ventas1_deta_temp`";
//mysql_query($sql);
$sql = "TRUNCATE TABLE `ventas1_encab_temp`";
//mysql_query($sql);

$total_factura = 0;
$neto = 0;
$iva = 0;
	?>
        </span></div></td>
      </tr>
 </table>
 </body>



</html>


