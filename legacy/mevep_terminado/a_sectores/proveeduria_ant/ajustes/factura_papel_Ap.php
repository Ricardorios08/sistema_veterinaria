
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
.Estilo19 {font-size: 10px; font-family: Arial, Helvetica, sans-serif; }
.Estilo22 {font-size: 9px}
.Estilo23 {font-weight: bold; font-family: Arial, Helvetica, sans-serif;}
.Estilo24 {font-size: 9px; font-family: Arial, Helvetica, sans-serif; }
.Estilo25 {font-size: 12px}
-->
</style>
 <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<table width="1089" border="0">
  <tr>
    <td width="596" scope="col"><table width="493" height="137" border="0">
      <!--DWLayoutTable-->
      <tr>
        <td height="20" colspan="3"><div align="right"><span class="Estilo8 Estilo11 Estilo14">
            <?include ("../../../conexiones/config_pro.php");

$nro_factura= $_REQUEST['nro_factura'];
$fact =$_REQUEST['fact'];
$tipo_fact =$_REQUEST['tipo_fact'];
$cuit= $_REQUEST['cuit'];
$direccion= $_REQUEST['direccion'];
$leyenda2 =  $_REQUEST['leyenda1'];

//$leyenda1 = substr($leyenda_12, 0,30);
//$leyenda2 = substr($leyenda_12,30,30);


$nro_factura_nuevo= $_REQUEST['nro_factura_nuevo'];
 $fact_nuevo= strtoupper($_REQUEST['fact_nuevo']);



include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result2 = $db->Execute($sql2);

$nro_cliente=strtoupper($result2->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result2->fields["nro_cuenta"]);
$cod_operacion=strtoupper($result2->fields["cod_operacion"]);

$plan=strtoupper($result2->fields["plan"]);
$operador=strtoupper($result2->fields["operador"]);
$denominacion=strtoupper($result2->fields["denominacion"]);

$fecha=strtoupper($result2->fields["fecha"]);
$dia=substr($fecha,8,2);
$mes=substr($fecha,5,2);
$anio=substr($fecha,0,4);
$fecha_a = $dia."/".$mes."/".$anio;

$forma_pago=strtoupper($result2->fields["forma_pago"]);
$fact=strtoupper($result2->fields["tipo_fact"]);


if ($nro_cliente != 0){
$tipo_cuenta = "2"; //tipo 1 externo;
$leyenda1 = "EXTERNO";
$nro = $nro_cliente;
}
elseif ($nro_cuenta != 0){
$tipo_cuenta = "1"; //tipo 1 asociado;
$leyenda1 = "ABM";
if ($forma_pago == 'CTA/CTE'){
$leyenda3 = "AUTORIZO A DESCONTAR DE MIS HONORARIOS EN LA LIQUIDACION CORRESPONDIENTE";
$leyenda4 = "FIRMA:.........................";
}
$nro = $nro_cuenta;
}

/*$band= $_REQUEST['band'];
$cod_detalle = $_REQUEST['cod_detalle'];
$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio= $_REQUEST['anio'];
$nro_cliente= $_REQUEST['nro_cliente'];
$todo= $_REQUEST['todo'];


$tipo_fact= $_REQUEST['tipo_fact'];

$matricula= $_REQUEST['matricula'];
$forma_pago= $_REQUEST['forma_pago'];
$cantidad= $_REQUEST['cantidad'];
$cod_mercaderia= $_REQUEST['cod_mercaderia'];

$operador = "Sergio, Zavala";
$condicion = "CONTADO";
*/


if (($nro_factura_nuevo != "") && ($fact_nuevo != "")) {
$caso = 1;
}
if (($nro_factura_nuevo != "") && ($fact_nuevo == "")) {
$caso = 2;
}
if (($nro_factura_nuevo == "") && ($fact_nuevo != "")) {
$caso = 3;
}
if (($nro_factura_nuevo == "") && ($fact_nuevo == "")) {
$caso = 4;
}

switch ($caso){

	case "1":{
 $sql = "UPDATE `ventas1_encab_temp` SET `nro_factura` = '$nro_factura_nuevo' , `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
//mysql_query($sql);

 $sql = "UPDATE `ventas1_deta_temp` SET `nro_factura` = '$nro_factura_nuevo' , `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
//mysql_query($sql);

$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` ) VALUES ( '$fact_nuevo' , '$nro_factura_nuevo' , 'FACTURA' , '$tipo_fact' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' )";
//mysql_query($sql);

$fact = $fact_nuevo;
$nro_factura = $nro_factura_nuevo;
break;
	}

	case "2":{
 $sql = "UPDATE `ventas1_encab_temp` SET `nro_factura` = '$nro_factura_nuevo'   WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
//mysql_query($sql);

 $sql = "UPDATE `ventas1_deta_temp` SET `nro_factura` = '$nro_factura_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";
//mysql_query($sql);

 $sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` ) VALUES ( '$fact' , '$nro_factura_nuevo' , 'FACTURA' , '$tipo_fact' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' )";
//mysql_query($sql);
$nro_factura = $nro_factura_nuevo;
break;
	}

		case "3":{
 $sql = "UPDATE `ventas1_encab_temp` SET `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact_nuevo' ";
//mysql_query($sql);

 $sql = "UPDATE `ventas1_deta_temp` SET `tipo_fact` = '$fact_nuevo'  WHERE `nro_factura` = '$nro_factura' and `tipo_fact` = '$fact' ";

//mysql_query($sql);

 $sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` ) VALUES ( '$fact_nuevo' , '$nro_factura' , 'FACTURA' , '$tipo_fact' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' )";
//mysql_query($sql);
$fact = $fact_nuevo;
break;
	}

		case "4":{
$sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` ) VALUES ( '$fact' , '$nro_factura' , 'FACTURA' , '$tipo_fact' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha' , '$bruto' ,  '$descuento' , '$iva' , '$retencion' , '$neto' , '$forma_pago' )";
//mysql_query($sql);

break;
	}


}







?>
        </span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="3"><div align="right" class="Estilo8 Estilo11 Estilo14"></div>          
          <div align="right"></div>          <div align="right"><span class="Estilo8 Estilo11 Estilo14">

        </span></div></td>
        </tr>
      <tr>
        <td height="28" colspan="2"><div align="left"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo16">Sres:</span> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $denominacion." (".$nro.")";?></span></span></span></div></td>
        <td width="159" height="28" valign="bottom"><div align="right"><span class="Estilo16"><span class="Estilo22"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo18"><span class="Estilo14 Estilo22">Fecha:</span> <?echo $fecha_a;?></span></span></span></span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="2"><div align="left"><span class="Estilo16">Domicilio:</span><span class="Estilo15"> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $direccion;?></span></span></span></div>          </td>
        <td height="20"><div align="right"><span class="Estilo16"><span class="Estilo22">Operador: <span class="Estilo23"><?echo $operador;?> Control: <?echo $fact?> - <?echo $nro_factura?></span></span></span></div></td>
      </tr>
      <tr>
        <td width="323" height="24"><div align="left" class="Estilo15"></div>          <div align="left"></div>          
          <span class="Estilo14  Estilo11">IVA</span><span class="Estilo19"><span class="Estilo15  Estilo17">:</span></span><span class="Estilo15 Estilo17"> <?print("$tipo_fact");?> - Cuit: <span class="Estilo22"><?echo $cuit;?> </span></span><span class="Estilo24"></span></span></span></td>
        <td colspan="2" valign="top"><div align="right"><span class="Estilo15  Estilo17"><span class="Estilo11  Estilo14"><span class="Estilo17">COND.  VENTA: <?echo $forma_pago;?></span></span></span></div></td>
        </tr>
      
      </table>

<table width="505" border="0">
  <!--DWLayoutTable-->
        <tr><td width="25" height="21" valign="middle"><div align="center" class="Estilo16"></div>
            <div align="right" class="Estilo4 Estilo11 Estilo14">
              <div align="center"><span class="Estilo14 Estilo17">Cant</span></div>
          </div>            </td>
        <td colspan="4" valign="middle"><div align="center" class="Estilo11 Estilo14">Detalle - Presentaci&oacute;n -  Lote - Vto Lote </div></td>
        <td width="58" valign="top"><div align="center"><span class="Estilo14 Estilo17">Pr. Unit.</span></div></td>
        <td width="67" valign="top"><div align="center"><span class="Estilo14 Estilo17">Total</span></div></td>
      </tr>


<?

include("../../../conexiones/config_pro.php");
 $sql = "SELECT * FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
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
$cantidad_salida=strtoupper($result3->fields["cantidad_salida"]);


$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura= $nro_factura_nuevo;
}

$cantidad_vendida = $cantidad_ingresada - $cantidad;
$cantidad_a_guardar = $cantidad + $cantidad_salida;

$sql = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_a_guardar' WHERE cod_mercaderia = $cod_mercaderia";
//mysql_query($sql);

$sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` ,  `tipo_fact` , `cod_movimiento` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` ,  `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , '$fact' , '5' , '$nro_factura' , '$cantidad_vendida' , '$precio_unitario' , '$lote' , '$mes_lote' , '$anio_lote' , '$nro' ,  '$tipo_cuenta')" ;
//mysql_query($sql);


 $sql = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_actualizado' , '$total' , '$fact' )";
//mysql_query($sql);

?><tr bgcolor="#FFFFFF">
    <td height="21" valign="top" scope="col"><div align="center" class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $cantidad;?></span></span></div></td>

    <td colspan="4" valign="top" scope="col"><div align="center" class="Estilo40 Estilo14 Estilo22">
          <div align="left"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo $cod_mercaderia. " - ".$descripcion." - ".$presentacion. " - ".$lote." - ".$mes_lote." - ".$anio_lote;?></span></span></div>
    </div></td>
    <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
        <div align="center"><span class="Estilo28 Estilo22"><?echo $precio_unitario;?></span></div>
    </div></td>
    <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
      <div align="center"><span class="Estilo28 Estilo22"><?echo $total;?></span></div>
    </div></td>
   
  </tr>
<?

	 $result->MoveNext();
		}


$total = number_format($total,2);
$descuento = number_format($descuento,2);
$iva_guardar = number_format($iva_guardar,2);
$total_factura = number_format($total_factura,2);



$sql = "UPDATE `ventas_encabezado` SET `bruto` = '$neto', `descuento` = '$descuento' , `iva` = '$iva' , `retencion` = '$retencion', `neto` = '$total_factura' WHERE `tipo_fact` = '$fact' AND `nro_factura` = '$nro_factura'";
//mysql_query($sql);


 $sumatoria = $cont;
		$cont = 0;

include ("espacios_en_blancos.php");
$sumatoria = 0;
?>
      <tr>
        <td height="21">&nbsp;</td>
        <td width="73">&nbsp;</td>
        <td width="95">&nbsp;</td>
        <td width="95">&nbsp;</td>
        <td width="62">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>


      <tr>
        <td height="21" colspan="2"><div align="center"></div>          <div align="center" class="Estilo22 Estilo14">
            <div align="left"></div>
          </div>          
          <div align="center"><span class="Estilo22 Estilo14"><span class="Estilo28"></span> <span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo number_format($neto,2);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></div>          <span class="Estilo22 Estilo14"><span class="Estilo28"></span></span></td>
        <td><div align="center"><span class="Estilo22 Estilo14"><span class="Estilo28"></span></span></div></td>
        <td><div align="center"><span class="Estilo22 Estilo14"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo number_format($neto,2);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></div></td>
        <td colspan="2"><div align="center"><span class="Estilo22 Estilo14"><span class="Estilo28"></span></span>          <span class="Estilo16 Estilo22"><strong><span class="Estilo22 Estilo14"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo number_format($iva,2);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></strong></span></div></td>
        <td><div align="center"><span class="Estilo16 Estilo22"><strong><?echo number_format($total_factura,2);?>

<?

$dia_vto = substr($fecha,8,2);
$mes_vto = substr($fecha,5,2)+1;
$anio_vto = substr($fecha,0,4);

if ($mes_vto > 12){
	$mes_vto = 1;
	$anio_vto = $anio_vto + 1;
}

if (strlen($mes_vto) == 1){
	$mes_vto = "0".$mes_vto;
}

$vencimiento = $anio_vto."-".$mes_vto."-".$dia_vto;

if ($forma_pago == 'CTA/CTE'){
$sql = "INSERT INTO `resumen_cta_vta` ( `cuenta` , `tipo_cuenta` , `fecha` , `tipo_fact` , `comprobante` , `cod_movimiento` , `importe` , `vencimiento` , `referencia` , `afectacion` ) VALUES ( '$nro' , '$tipo_cuenta' ,'$fecha' , '$fact' , '$nro_factura' , '5' , '$total_factura' , '$vencimiento' , '$referencia' , '$afectacion')";
//mysql_query($sql);
}

if ($forma_pago == 'CTA/CTE'){
 $sql = "INSERT INTO `composicion_saldos` ( `cuenta` , `tipo_cuenta` , `tipo_fact` , `comprobante` , `fecha_emision` , `importe_original` , `fecha_pago` , `saldo` , `vencimiento` , `cuotas` , `cuotas_pagadas` , `cod_movimiento` ) VALUES ( '$nro' , '$tipo_cuenta' , '$fact' ,  '$nro_factura' , '$fecha' , '$total_factura' , '' , '$total_factura' , '$vencimiento' , '0' , '0', 'PROVEEDURIA' )";
//mysql_query($sql);
}

//11 ventas
//12 nota de debito

//21 pago
//22 nota de credito

$total_factura = 0;
$neto = 0;
$iva = 0;
	?>
        </strong></span></div></td>
      </tr>
      <tr>
        <td height="21" colspan="6">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20" colspan="7"><div align="center"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $leyenda1;?></span></span></span></div></td>
        </tr>
      <tr>
        <td height="20" colspan="7"><div align="center"><span class="Estilo14 Estilo25"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $leyenda2;?></span></span></span></span></div></td>
        </tr>
    </table>		</td>
    <td width="483" scope="col"><table width="493" height="137" border="0">
      <!--DWLayoutTable-->
      <tr>
        <td height="20" colspan="3"><div align="right"><span class="Estilo8 Estilo11 Estilo14">
            <?include ("../../../conexiones/config_pro.php");


include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result2 = $db->Execute($sql2);

$nro_cliente=strtoupper($result2->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result2->fields["nro_cuenta"]);
$cod_operacion=strtoupper($result2->fields["cod_operacion"]);

$plan=strtoupper($result2->fields["plan"]);
$operador=strtoupper($result2->fields["operador"]);
$denominacion=strtoupper($result2->fields["denominacion"]);
$fecha=strtoupper($result2->fields["fecha"]);
$dia=substr($fecha,8,2);
$mes=substr($fecha,5,2);
$anio=substr($fecha,0,4);
$fecha_a = $dia."/".$mes."/".$anio;
$forma_pago=strtoupper($result2->fields["forma_pago"]);


if ($nro_cliente != 0){
$tipo_cuenta = "2"; //tipo 1 externo;
$leyenda1 = "EXTERNO";
$nro = $nro_cliente;
}
elseif ($nro_cuenta != 0){
$tipo_cuenta = "1"; //tipo 1 asociado;
$leyenda1 = "ABM";
if ($forma_pago == 'CTA/CTE'){
$leyenda3 = "AUTORIZO A DESCONTAR DE MIS HONORARIOS EN LA LIQUIDACION CORRESPONDIENTE";
$leyenda4 = "FIRMA:.........................";
}
$nro = $nro_cuenta;
}


?>
        </span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="3"><div align="right" class="Estilo8 Estilo11 Estilo14"></div>
            <div align="right"></div>
            <div align="right"><span class="Estilo8 Estilo11 Estilo14"> </span></div></td>
      </tr>
      <tr>
        <td height="29" colspan="2"><div align="left"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo16">Sres:</span> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $denominacion." (".$nro.")";?></span></span></span></div></td>
        <td width="143" height="29" valign="bottom"><div align="right"><span class="Estilo16"><span class="Estilo22"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo18"><span class="Estilo14 Estilo22">Fecha:</span> <?echo $fecha_a;?></span></span></span></span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="2"><div align="left"><span class="Estilo16">Domicilio:</span><span class="Estilo15"> <span class="Estilo18  Estilo17"><?echo $direccion;?></span></span></div></td>
        <td height="20"><div align="right"><span class="Estilo16"><span class="Estilo22">Operador: <span class="Estilo23"><?echo $operador;?> Control: <?echo $nro_factura?></span></span></span></div></td>
      </tr>
      <tr>
        <td width="325" height="26"><div align="left" class="Estilo15"></div>
            <div align="left"></div>
          <span class="Estilo14  Estilo11">IVA</span><span class="Estilo19"><span class="Estilo15  Estilo17">:</span></span><span class="Estilo15 Estilo17"> <?print("$tipo_iva");?> - Cuit: <span class="Estilo22"><?echo $cuit;?> </span></span><span class="Estilo24"></span></td>
        <td colspan="2" valign="top"><div align="right"><span class="Estilo15  Estilo17"><span class="Estilo11  Estilo14"><span class="Estilo17">COND. VENTA: <?echo $forma_pago;?></span></span></span></div></td>
      </tr>
    </table>
      <table width="489" border="0">
        <!--DWLayoutTable-->
        <tr>
          <td width="25" height="21" valign="middle"><div align="center" class="Estilo16"></div>
              <div align="right" class="Estilo4 Estilo11 Estilo14">
                <div align="center"><span class="Estilo14 Estilo17">Cant</span></div>
            </div></td>
          <td colspan="4" valign="middle"><div align="center" class="Estilo11 Estilo14">Detalle - Presentaci&oacute;n - Lote - Vto Lote </div></td>
          <td width="58" valign="top"><div align="center"><span class="Estilo14 Estilo17">Pr. Unit.</span></div></td>
          <td width="60" valign="top"><div align="center"><span class="Estilo14 Estilo17">Total</span></div></td>
        </tr>
        <?

include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
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


?>
        <tr bgcolor="#FFFFFF">
          <td height="21" valign="top" scope="col"><div align="center" class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $cantidad;?></span></span></div></td>
          <td colspan="4" valign="top" scope="col"><div align="center" class="Estilo40 Estilo14 Estilo22">
              <div align="left"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo $cod_mercaderia. " - ".$descripcion." - ".$presentacion. " - ".$lote." - ".$mes_lote." - ".$anio_lote;?></span></span></div>
          </div></td>
          <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
              <div align="center"><span class="Estilo28 Estilo22"><?echo $precio_unitario;?></span></div>
          </div></td>
          <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
              <div align="center"><span class="Estilo28 Estilo22"><?echo $total;?></span></div>
          </div></td>
        </tr>
        <?

	 $result->MoveNext();
		}

 $sumatoria = $cont;
		$cont = 0;

include ("espacios_en_blancos.php");
$sumatoria = 0;
?>
        <tr>
          <td height="21">&nbsp;</td>
          <td width="73">&nbsp;</td>
          <td width="95">&nbsp;</td>
          <td width="97">&nbsp;</td>
          <td width="41">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21" colspan="2"><div align="center"></div>
              <div align="center" class="Estilo22 Estilo14">
                <div align="left"></div>
              </div>
              <div align="center"><span class="Estilo22 Estilo14"><span class="Estilo28"></span> <span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo number_format($neto,2);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></div>
              <span class="Estilo22 Estilo14"><span class="Estilo28"></span></span></td>
          <td><div align="center"><span class="Estilo22 Estilo14"><span class="Estilo28"></span></span></div></td>
          <td><div align="center"><span class="Estilo22 Estilo14"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo number_format($neto,2);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></div></td>
          <td colspan="2"><div align="center"><span class="Estilo22 Estilo14"><span class="Estilo28"></span></span> <span class="Estilo16 Estilo22"><strong><span class="Estilo22 Estilo14"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22"><?echo number_format($iva,2);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></strong></span></div></td>
          <td><div align="center"><span class="Estilo16 Estilo22"><strong><?echo number_format($total_factura,2);?>
                      <?


$sql = "TRUNCATE TABLE `ventas1_deta_temp`";
//mysql_query($sql);
$sql = "TRUNCATE TABLE `ventas1_encab_temp`";
//mysql_query($sql);

$total_factura = 0;
$neto = 0;
$iva = 0;
	?>
          </strong></span></div></td>
        </tr>
        <tr>
          <td height="21" colspan="6">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="20" colspan="7"><div align="center"><span class="Estilo14 Estilo25"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $leyenda3;?></span></span></span></span></div></td>
        </tr>
        <tr>
          <td height="20" colspan="7"><div align="center"><span class="Estilo14 Estilo25"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $leyenda4;?></span></span></span></span></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>



</html>


