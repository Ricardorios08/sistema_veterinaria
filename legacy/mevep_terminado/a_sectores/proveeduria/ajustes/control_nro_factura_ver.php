
<style type="text/css">
<!--
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

<script language="JavaScript">

function cerrar() {
var ventana = window.self;
ventana.opener = window.self;
ventana.close();
}

</script> 

<style type="text/css">
<!--
.Estilo17 {font-size: 10px}
.Estilo18 {font-weight: bold}
.Estilo22 {font-size: 9px}
.Estilo23 {font-weight: bold; font-family: Arial, Helvetica, sans-serif;}
.Estilo25 {font-size: 12px}
.Estilo84 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo85 {font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<FORM ACTION="actualiza_A.php" METHOD = "POST" enctype="multipart/form-data" name="form">
<table width="616" height="205" border="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="21" colspan="4"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td width="178" rowspan="2"><div align="center"><span class="Estilo8 Estilo14 Estilo25"><span class="Estilo8 Estilo11  Estilo14">
    </span></span></div>      
    <div align="center"><span class="Estilo8 Estilo14 Estilo25"><span class="Estilo8 Estilo11  Estilo14">
    </span></span></div></td>
    <td height="21"><div align="center"><strong>AJUSTES DE PROVEEDURIA </strong></div></td>
    <td height="21" colspan="2"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr valign="middle">
    <td width="253" height="21" valign="top"><HR noshade></td>
    <td colspan="2" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td height="20"><div align="center"><span class="Estilo8 Estilo14 Estilo25"><span class="Estilo8 Estilo11  Estilo14">
    </span></span></div></td>
    <td height="20"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="107" height="20"><div align="right"><span class="Estilo8 Estilo14 Estilo25"><span class="Estilo8 Estilo11  Estilo14"><span class="Estilo25">FECHA:</span> 
         </span></span></div></td>
    <td width="60"><span class="Estilo8 Estilo14 Estilo25"><span class="Estilo8 Estilo11  Estilo14">
      <?include ("../../../conexiones/config_grabacion.php");

$nro_factura= $_REQUEST['nro_factura'];
$fact =$_REQUEST['fact'];
$tipo_fact =$_REQUEST['tipo_fact'];
$cuit= $_REQUEST['cuit'];
$direccion= $_REQUEST['direccion'];
$leyenda2 =  $_REQUEST['leyenda1'];
$cantidad_cuotas=  $_REQUEST['cantidad_cuotas'];



include("../../../conexiones/config_grabacion.php");
 $sql2 = "SELECT * FROM `ventas_encabezado` where nro_factura = $nro_factura";
$result2 = $db_aj->Execute($sql2);



$cod_operacion=strtoupper($result2->fields["cod_operacion"]);
$fact=strtoupper($result2->fields["tipo_fact"]);
$tipo_iva=strtoupper($result2->fields["tipo"]);


$operador=strtoupper($result2->fields["operador"]);
$denominacion=strtoupper($result2->fields["denominacion"]);

$fecha=strtoupper($result2->fields["fecha"]);
$dia=substr($fecha,8,2);
$mes=substr($fecha,5,2);
$anio=substr($fecha,0,4);
$fecha_a = $dia."/".$mes."/".$anio;

$fact=strtoupper($result2->fields["tipo_fact"]);


?>
      <?echo $fecha_a;?></span></span></td>
  </tr>
  <tr>
    <td height="20"><div align="right" class="Estilo84">
        </div>      <div align="right"><span class="Estilo8 Estilo11 Estilo14"> </span></div></td>
    <td height="20"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td height="20"><div align="right"><span class="Estilo84">N&ordm; INFORME:&nbsp;</span></div></td>
    <td height="20"><span class="Estilo84"><?echo $nro_factura?></span></td>
  </tr>
  <tr>
    <td height="21"><div align="left"><span class="Estilo8 Estilo11 Estilo14"></span></div>      <div align="right" class="Estilo84">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
    <td height="21"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td height="21"><div align="right"><span class="Estilo84">OPERADOR:</span></div></td>
    <td height="21"><span class="Estilo84"><?echo $operador;?></span></td>
  </tr>
  <tr>
    <td height="22" colspan="4"><HR noshade></td>
  </tr>
  <tr>
    <td height="20" colspan="4"><div align="left"><span class="Estilo8 Estilo11  Estilo14"><span class="Estilo16">MOTIVO DEL AJUSTE:</span></span><span class="Estilo8 Estilo11 Estilo14"> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $denominacion;?></span></span></span> </div></td>
  </tr>
  <tr>
    <td height="24" colspan="4"><div align="left" class="Estilo15"></div>
        <div align="center"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo15"></span></span>
          <HR noshade>
        <span class="Estilo15  Estilo17"><span class="Estilo11  Estilo14"></span></span></div></td>
  </tr>
</table>
<table width="618" border="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="57" valign="middle"><div align="center" class="Estilo16"></div>
        <div align="right" class="Estilo4 Estilo11 Estilo14">
          <div align="center"><span class="Estilo14 Estilo17">Cant</span></div>
      </div></td>
    <td colspan="3"><div align="center" class="Estilo11 Estilo14">Detalle - Presentaci&oacute;n - Lote - Vto Lote </div></td>
    <td width="94"><div align="center"><span class="Estilo14 Estilo17">Pr. Unit.</span></div></td>
    <td width="96"><div align="center"><span class="Estilo14 Estilo17">Total</span></div></td>
  </tr>
  <tr>
    <td colspan="6" valign="middle"><HR noshade></td>
  </tr>
  <?


 $sql = "SELECT * FROM `ventas_detalle`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result = $db_aj->Execute($sql);
if (!$result) die("fallo".$db_aj->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);

$lote=strtoupper($result->fields["lote"]);

$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);

//$total=strtoupper($result->fields["total"]);
//$cod_detalle=strtoupper($result->fields["cod_detalle"]);

$sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db_pro->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);
$precio_actualizado=strtoupper($result2->fields["precio_actualizado"]);
$id_tasa=strtoupper($result2->fields["id_tasa"]);

$sql3="select * from tasas where cod_tasa = $id_tasa";
$result3 = $db_pro->Execute($sql3);

$iva_normal=strtoupper($result3->fields["iva_normal"]);







$total = round($precio_actualizado * $cantidad,2);


$subtotal = $subtotal + $total;




$sql3="select * from existencias where cod_mercaderia = $cod_mercaderia and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' ";
$result3 = $db_pro->Execute($sql3);
$nro_fact_compra=strtoupper($result3->fields["nro_factura"]);
$cantidad_ingresada=strtoupper($result3->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result3->fields["cantidad_salida"]);
$cantidad_vendida = $cantidad_ingresada - $cantidad;
$cantidad_a_guardar = $cantidad + $cantidad_salida;



$total = $total;





$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura= $nro_factura_nuevo;
}



 $sql = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_a_guardar' WHERE cod_mercaderia = $cod_mercaderia and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' and lote = '$lote' and nro_factura = '$nro_factura_compra'";
//$result3 = $db_pro->Execute($sql);

 $sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` ,  `tipo_fact` , `cod_movimiento` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` ,  `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , '$fact' , '7' , '$nro_factura' , '$cantidad' , '$precio_unitario' , '$lote' , '$mes_lote' , '$anio_lote' , '$nro' ,  '$tipo_cuenta')" ;
//$result3 = $db_pro->Execute($sql);

$sql = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_actualizado' , '$total' , '$fact' )";
//$result3 = $db_aj->Execute($sql);

?>
  <tr bgcolor="#FFFFFF">
    <td valign="top" scope="col"><div align="center" class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $cantidad;?></span></span></div></td>
    <td colspan="3" valign="top" scope="col"><div align="center" class="Estilo40 Estilo14 Estilo22">
        <div align="left"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo $cod_mercaderia. " - ".$descripcion." - ".$presentacion. " - ".$lote." - ".$mes_lote." - ".$anio_lote;?></span></span></div>
    </div></td>
    <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
        <div align="center"><span class="Estilo28 Estilo22"><?echo $precio_actualizado;?></span></div>
    </div></td>
    <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
        <div align="center"><span class="Estilo28 Estilo22"><?echo $total;?></span></div>
    </div></td>
  </tr>
  <?

	 $result->MoveNext();
		}


$desc_fact = round(($subtotal * $porc_dto)/100,2);
$neto_gravado = $subtotal - $desc_fact;
$iva = round(($neto_gravado * $iva_normal) /100,2);
$total_factura = $neto_gravado + $iva;


 $sumatoria = $cont;
		$cont = 0;

include ("espacios_en_blancos.php");
$sumatoria = 0;
?>
  <tr>
    <td colspan="6"><HR noshade></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><span class="Estilo14 Estilo17"><em>SUBTOTAL</em></span></div></td>
    <td width="142"><div align="center"><span class="Estilo14 Estilo17"><em>DESCUENTO</em></span></div></td>
    <td width="137"><div align="center"><span class="Estilo14 Estilo17"><em>NETO GRAVADO </em></span></div></td>
    <td><div align="center"><span class="Estilo14 Estilo17"><em>IVA</em></span></div></td>
    <td><div align="center" class="Estilo14 Estilo17"><em>TOTAL</em></div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><div align="center" class="Estilo85"></div>      <div align="center" class="Estilo14 Estilo25">
        </div>      
      <div align="center"><span class="Estilo14 Estilo25"><?echo number_format($subtotal,2);?></span></div></td>
    <td valign="top"><div align="center"><span class="Estilo14 Estilo25"><?echo number_format($desc_fact,2);?></span></div></td>
    <td valign="top"><div align="center"><span class="Estilo14 Estilo25"><?echo number_format($neto_gravado,2);?></span></div></td>
    <td valign="top"><div align="center"><span class="Estilo14 Estilo25"><?echo number_format($iva,2);?></span></div></td>
    <td><div align="center"><span class="Estilo14 Estilo25"><?echo number_format($total_factura,2);?>
                  <?


$sql = "UPDATE `ventas_encabezado` SET `bruto` = '$subtotal', `descuento` = '$desc_fact' , `iva` = '$iva' , `retencion` = '$retencion', `neto` = '$total_factura' , `neto_gravado` = '$neto_gravado' WHERE `tipo_fact` = '$fact' AND `nro_factura` = '$nro_factura'";
//$result3 = $db_aj->Execute($sql);


$total_factura = 0;
$subtotal = 0;
$neto_gravado = 0;
$desc_fact= 0;
$iva = 0;


	?>
        </strong></span>
        </div>
    </span></div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" valign="top"><div align="center">
    </div></td>
  </tr>
</table>

<input name="nro_factura" type="Hidden"  value="<?echo $nro_factura;?>">
</body>



</html>

<?
$sql = "TRUNCATE TABLE `ventas1_deta_temp`";
//$result3 = $db_aj->Execute($sql);
$sql = "TRUNCATE TABLE `ventas1_encab_temp`";
//$result3 = $db_aj->Execute($sql);

$total_factura = 0;
$neto = 0;
$iva = 0;
?>