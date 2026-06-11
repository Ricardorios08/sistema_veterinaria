

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
.Estilo28 {font-size: 24px}
-->
</style>
 <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<table width="1089" border="0">
  <tr>
    <td width="596" scope="col"><table width="503" height="137" border="0">
      <!--DWLayoutTable-->
      <tr>
        <td height="20" colspan="3"><div align="right"><span class="Estilo8 Estilo11 Estilo14">
            <?include ("../../../conexiones/config_pro.php");

//$nro_factura= $_REQUEST['nro_factura'];
//$fact =$_REQUEST['fact'];
//$tipo_fact =$_REQUEST['tipo_fact'];
//$cuit= $_REQUEST['cuit'];
//$direccion= $_REQUEST['direccion'];
//$leyenda2 =  $_REQUEST['leyenda1'];
$cantidad_cuotas=  $_REQUEST['cantidad_cuotas'];


if ($cantidad_cuotas == ""){
$cantidad_cuotas = 1;
}

if ($cantidad_cuotas == 0){
$cantidad_cuotas = 1;
}


if (($cantidad_cuotas > 6) or ($cantidad_cuotas < 0) ) {
$leyenda = "Máximo de Cuotas = 6";
	include ("../../../alertas/campo_informacion2.php");
	EXIT;
}

if (($cantidad_cuotas < 7) and ($cantidad_cuotas > 1)){
	$mostrar_recuadro_cuotas = "SI";
}

//$leyenda1 = substr($leyenda_12, 0,30);
//$leyenda2 = substr($leyenda_12,30,30);


include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas_encabezado`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result2 = $db->Execute($sql2);

$nro_cliente=strtoupper($result2->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result2->fields["nro_cuenta"]);
$cod_operacion=strtoupper($result2->fields["cod_operacion"]);

$plan=strtoupper($result2->fields["plan"]);
$operador=strtoupper($result2->fields["operador"]);
$denominacion=strtoupper($result2->fields["denominacion"]);
$tipo_iva=strtoupper($result2->fields["tipo"]);

$bruto_ng=strtoupper($result2->fields["bruto"]);
$descuento_ng=strtoupper($result2->fields["descuento"]);
$neto_gravado_ng=strtoupper($result2->fields["neto_gravado"]);
$iva_ng=strtoupper($result2->fields["iva"]);
$neto_ng=strtoupper($result2->fields["neto"]);







$fecha=strtoupper($result2->fields["fecha"]);
$dia=substr($fecha,8,2);
$mes=substr($fecha,5,2);
$anio=substr($fecha,0,4);
$fecha_a = $dia."/".$mes."/".$anio;

$forma_pago=strtoupper($result2->fields["forma_pago"]);
$fact=strtoupper($result2->fields["tipo_fact"]);
$porc_dto=strtoupper($result2->fields["porc_dto"]);

if ($nro_cliente != 0){
$tipo_cuenta = "2"; //tipo 1 externo;
$leyenda1 = "EXTERNO";
$nro = $nro_cliente;
$sql="select * from clientes where cuenta like '$nro_cliente'";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);
$domicilio=$result->fields["domicilio"];
$puerta=$result->fields["puerta"];
$localidad=$result->fields["localidad"];
$direccion = $domicilio." ".$puerta." - ".$localidad;
$cuit=$result->fields["cuit"];


$sql7="select * from condiciones_clientes where cuenta like '$nro_cliente'";
$result7 = $db->Execute($sql7);
$plan=strtoupper($result7->fields["plan"]);
$tipo_fact=strtoupper($result7->fields["iva"]);  // letras
$tipo_iva=strtoupper($result7->fields["iva"]); // numero
$iva =$result7->fields["iva"];




switch ($iva){
	case "1":{
$iva = "Responsable Inscripto";

		break;
	}

	case "4":{
$iva = "Exento";

		break;
	}

		case "3":{
$iva = "Monotributo";

		break;
	}

		
	
}


}
elseif ($nro_cuenta != 0){
$tipo_cuenta = "1"; //tipo 1 asociado;
$leyenda1 = "ABM";
 include("../../../conexiones/config.inc.php");
$sql="select * from datos_laboratorio where nro_laboratorio like '$nro_cuenta'";
$result=$db->Execute($sql);

$nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);
$matricula1=$result->fields["matricula"];
$domicilio=$result->fields["domicilio"];
$nro_domicilio=$result->fields["nro_domicilio"];
$departamento=$result->fields["departamento"];


$direccion = $domicilio." ".$nro_domicilio." - ".$departamento;

$sql2="select * from afip where nro_laboratorio like '$nro_cuenta'";
$result2 = $db->Execute($sql2);
$cuit=strtoupper($result2->fields["nro_afip"]);
$tipo_fact1=strtoupper($result2->fields["sit_iva"]);
$iva=strtoupper($result2->fields["sit_iva"]);

switch ($iva){
	case "RESPONSABLE INSCRIPTO":{

$fact = "A";
$tipo_iva = 1;
		break;
	}

	case "EXENTO":{

$fact = "B";
$tipo_iva = 4;
		break;
	}

		case "MONOTRIBUTISTA":{

$tipo_iva = 3;
$fact = "B";
		break;
	}

			case "CONS. FINAL":{

$fact = "B";
$tipo_iva = 5;
$leyenda = "Irregular situación AFIP";
include ("../../../alertas/campo_vacio.php");
EXIT;
		break;
	}

}


if ($forma_pago == 'CTA/CTE'){

if ($mostrar_recuadro_cuotas = "SI"){
$leyenda3 = "AUTORIZO A DESCONTAR EN LA LIQUIDACION. FIRMA...................";
}
ELSE
{
$leyenda3 = "AUTORIZO A DESCONTAR DE MIS HONORARIOS EN LA LIQUIDACION CORRESPONDIENTE";
$leyenda4 = "FIRMA:.........................";
}

}
$nro = $nro_cuenta;
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
        <td width="171" height="28" valign="bottom"><div align="right"><span class="Estilo16"><span class="Estilo22"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo18"><span class="Estilo14 Estilo22">Fecha:</span> <?echo $fecha_a;?></span></span></span></span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="2"><div align="left"><span class="Estilo16">Domicilio:</span><span class="Estilo15"> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $direccion;?></span></span></span></div>          </td>
        <td height="20"><div align="right"><span class="Estilo16"><span class="Estilo22">Operador: <span class="Estilo23"><?echo $operador;?> Control: <?echo $fact?> - <?echo $nro_factura?></span></span></span></div></td>
      </tr>
      <tr>
        <td width="320" height="24"><div align="left" class="Estilo15"></div>          <div align="left"></div>          
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
$sql = "SELECT * FROM `ventas_detalle`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result = $db->Execute($sql);
if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$precio_actualizado=strtoupper($result->fields["precio_unitario"]);
$lote=strtoupper($result->fields["lote"]);

$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);

///////////////////////////////////

$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result5 = $db->Execute($sql);
$descripcion=strtoupper($result5->fields["descripcion"]);
$presentacion=strtoupper($result5->fields["presentacion"]);
$precio_actualizado=strtoupper($result5->fields["precio_actualizado"]);
$margendif=strtoupper($result5->fields["margendif"]);
$id_tasa=strtoupper($result5->fields["id_tasa"]);

$sql3="select * from tasas where cod_tasa = $id_tasa";
$result3 = $db->Execute($sql3);

$iva_normal=strtoupper($result3->fields["iva_normal"]);

//if ($plan == 1){
$margendif = 0;
//}

$porce_margendif = (($precio_actualizado * $margendif) /100);
$precio_actualizado = $precio_actualizado + $porce_margendif;


$sql3="select * from existencias where cod_mercaderia = $cod_mercaderia and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' ";
$result3 = $db->Execute($sql3);
$nro_fact_compra=strtoupper($result3->fields["nro_factura"]);
$cantidad_ingresada=strtoupper($result3->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result3->fields["cantidad_salida"]);
$cantidad_vendida = $cantidad_ingresada - $cantidad;
$cantidad_a_guardar = $cantidad + $cantidad_salida;


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
///////////////////////////////////

$precio_act_guardar = $precio_actualizado;
/////desc por articulo //////////////

$precio_neto = $precio_actualizado - $desc_articulo;
$precio_bruto = round($precio_neto * $cantidad,2);

if ($tipo_iva != 4){
$iva_articulo = round(($precio_actualizado * $iva_normal)/100,2);
$precio_actualizado = $precio_actualizado + $iva_articulo;
$iva_total = $iva_total + $iva_articulo;
}



$total = $precio_actualizado * $cantidad;
$desc_articulo = round(($total * $porc_dto)/100,2); // descuento por articulo 
$desc_factura1 = $desc_factura1 + $desc_articulo; // suma descuento total

$subtotal = $subtotal + $total;
$total_factura = $subtotal - $desc_factura1;



//$total_factura = round($neto,2) + round($iva,2);




$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura= $nro_factura_nuevo;
}



$sql = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_a_guardar' WHERE cod_mercaderia = $cod_mercaderia and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' and lote = '$lote'";
//mysql_query($sql);

$sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` ,  `tipo_fact` , `cod_movimiento` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` ,  `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , '$fact' , '5' , '$nro_factura' , '$cantidad' , '$precio_act_guardar' , '$lote' , '$mes_lote' , '$anio_lote' , '$nro' ,  '$tipo_cuenta')" ;
//mysql_query($sql);


$sql = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_actualizado' , '$total' , '$fact' )";
//mysql_query($sql);

?><tr bgcolor="#FFFFFF">
    <td height="21" valign="top" class="Estilo25" scope="col"><div align="center" class="Estilo17"><span class="Estilo40 Estilo14 Estilo17"><?echo $cantidad;?></span></div>      </td>

    <td colspan="4" valign="top" scope="col"><div align="center" class="Estilo40 Estilo14 Estilo17">
          <div align="left"><span class="Estilo38 Estilo39 Estilo14 Estilo17"><?echo $cod_mercaderia. " - ".$descripcion." - ".$presentacion. " - ".$lote." - ".$mes_lote." - ".$anio_lote;?></span></div>
    </div></td>
    <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
        <div align="center"><?echo number_format($precio_actualizado,2);?></div>
    </div></td>
    <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
      <div align="center"><?echo number_format($total,2);?></div>
    </div></td>
   
  </tr>
<?

	 $result->MoveNext();
		}


$desc_iva= round(($iva_total * $porc_dto)/100,2);
$iva_neto = $iva_total - $desc_iva;
$neto_gravado = $total_factura - $iva_neto;



$sql = "UPDATE `ventas_encabezado` SET `bruto` = '$subtotal', `descuento` = '$desc_factura1' , `neto_gravado` = '$neto_gravado' , `iva` = '$iva_neto' , `retencion` = '$retencion', `neto` = '$total_factura' WHERE `tipo_fact` = '$fact' AND `nro_factura` = '$nro_factura'";
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
          <div align="left"></span></span></span></div>
          </div>          
          <div align="center" class="Estilo14 Estilo25"><?echo number_format($bruto_ng,2);?></div></td>
        <td><div align="center" class="Estilo14 Estilo25"><?echo number_format($descuento_ng,2);?></span></span></span></div></td>
        <td><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></div></td>
        <td colspan="2"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></strong></span></div></td>
        <td><div align="center" class="Estilo14"><strong><span class="Estilo25"><?echo number_format($neto_ng,2);?>

              <?


if ($mostrar_recuadro_cuotas == "SI"){
$cuota = ($total_factura / $cantidad_cuotas);
$fecha;
$dia_vto = substr($fecha,8,2);
$mes_1 = substr($fecha,5,2)+1;
$anio_vto = substr($fecha,0,4);

if ($mes_1 > 12){
	$mes_1 = 1;
	$anio_vto = $anio_vto + 1;
}

if (strlen($mes_1) == 1){
	$mes_1 = "0".$mes_1;
}

$vencimiento1 = $dia_vto."/".$mes_1;



$mes_2 = $mes_1+1;


if ($mes_2 > 12){
	$mes_2 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_2) == 1){
	$mes_2 = "0".$mes_2;
}

$vencimiento2 = $dia_vto."/".$mes_2;

$mes_3 = $mes_2+1;


if ($mes_3 > 12){
	$mes_3 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_3) == 1){
	$mes_3 = "0".$mes_3;
}

$vencimiento3 = $dia_vto."/".$mes_3;

$mes_4 = $mes_3+1;


if ($mes_4 > 12){
	$mes_4 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_4) == 1){
	$mes_4 = "0".$mes_4;
}

$vencimiento4 = $dia_vto."/".$mes_4;

/////////////////////////////

$mes_5 = $mes_4+1;


if ($mes_5 > 12){
	$mes_5 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_5) == 1){
	$mes_5 = "0".$mes_5;
}

$vencimiento5 = $dia_vto."/".$mes_5;


$mes_6 = $mes_5+1;


if ($mes_6 > 12){
	$mes_6 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_6) == 1){
	$mes_6 = "0".$mes_6;
}

$vencimiento6 = $dia_vto."/".$mes_6;



switch ($cantidad_cuotas){
	case "1":{

$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
		break;
	}

	case "2":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
		break;}

			case "3":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
		break;}

			case "4":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento4.")";

		break;}


			case "5":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento4.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento5.")";


		break;}

					case "6":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento4.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento5.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento6.")";
		break;}

}


$leyenda4 = $leyenda1;

}


////////////termina cuotas


if ($forma_pago == 'CTA/CTE'){
$sql = "INSERT INTO `resumen_cta_vta` ( `cuenta` , `tipo_cuenta` , `fecha` , `tipo_fact` , `comprobante` , `cod_movimiento` , `importe` , `vencimiento` , `referencia` , `afectacion` ) VALUES ( '$nro' , '$tipo_cuenta' ,'$fecha' , '$fact' , '$nro_factura' , '1' , '$total_factura' , '$vencimiento' , '$referencia' , '$afectacion')";
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

$desc_factura1= 0;
$subtotal= 0;

$total_factura = 0;
$neto = 0;
$iva = 0;
	?>
        </span>        </strong></span></strong></div></td>
      </tr>
      <tr>
        <td height="21" colspan="6">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20" colspan="7"><div align="center" class="Estilo25"><span class="Estilo40 Estilo17  Estilo14"><?echo $leyenda1;?></span></div></td>
        </tr>
      <tr>
        <td height="20" colspan="7"><div align="center" class="Estilo25"><span class="Estilo14"><span class="Estilo40 Estilo17  Estilo14"><?echo $leyenda2;?></span></span></div></td>
        </tr>
    </table>		</td>
    <td width="483" scope="col"><table width="503" height="137" border="0">
      <!--DWLayoutTable-->
      <tr>
        <td height="20" colspan="3"><div align="right"><span class="Estilo8 Estilo11 Estilo14">
            <?include ("../../../conexiones/config_pro.php");

//$nro_factura= $_REQUEST['nro_factura'];
//$fact =$_REQUEST['fact'];
//$tipo_fact =$_REQUEST['tipo_fact'];
//$cuit= $_REQUEST['cuit'];
//$direccion= $_REQUEST['direccion'];
//$leyenda2 =  $_REQUEST['leyenda1'];
$cantidad_cuotas=  $_REQUEST['cantidad_cuotas'];


if ($cantidad_cuotas == ""){
$cantidad_cuotas = 1;
}

if ($cantidad_cuotas == 0){
$cantidad_cuotas = 1;
}


if (($cantidad_cuotas > 6) or ($cantidad_cuotas < 0) ) {
$leyenda = "M&aacute;ximo de Cuotas = 6";
	include ("../../../alertas/campo_informacion2.php");
	EXIT;
}

if (($cantidad_cuotas < 7) and ($cantidad_cuotas > 1)){
	$mostrar_recuadro_cuotas = "SI";
}

//$leyenda1 = substr($leyenda_12, 0,30);
//$leyenda2 = substr($leyenda_12,30,30);


include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas_encabezado`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result2 = $db->Execute($sql2);

$nro_cliente=strtoupper($result2->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result2->fields["nro_cuenta"]);
$cod_operacion=strtoupper($result2->fields["cod_operacion"]);

$plan=strtoupper($result2->fields["plan"]);
$operador=strtoupper($result2->fields["operador"]);
$denominacion=strtoupper($result2->fields["denominacion"]);
$tipo_iva=strtoupper($result2->fields["tipo"]);

$fecha=strtoupper($result2->fields["fecha"]);
$dia=substr($fecha,8,2);
$mes=substr($fecha,5,2);
$anio=substr($fecha,0,4);
$fecha_a = $dia."/".$mes."/".$anio;

$forma_pago=strtoupper($result2->fields["forma_pago"]);
$fact=strtoupper($result2->fields["tipo_fact"]);
$porc_dto=strtoupper($result2->fields["porc_dto"]);

if ($nro_cliente != 0){
$tipo_cuenta = "2"; //tipo 1 externo;
$leyenda1 = "EXTERNO";
$nro = $nro_cliente;
$sql="select * from clientes where cuenta like '$nro_cliente'";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);
$domicilio=$result->fields["domicilio"];
$puerta=$result->fields["puerta"];
$localidad=$result->fields["localidad"];
$direccion = $domicilio." ".$puerta." - ".$localidad;
$cuit=$result->fields["cuit"];

$sql7="select * from condiciones_clientes where cuenta like '$nro_cliente'";
$result7 = $db->Execute($sql7);
$plan=strtoupper($result7->fields["plan"]);
$tipo_fact=strtoupper($result7->fields["iva"]);  // letras
$tipo_iva=strtoupper($result7->fields["iva"]); // numero
$iva =$result7->fields["iva"];

switch ($iva){
	case "1":{
$iva = "Responsable Inscripto";

		break;
	}

	case "4":{
$iva = "Exento";

		break;
	}

		case "3":{
$iva = "Monotributo";

		break;
	}

		
	
}


}
elseif ($nro_cuenta != 0){
$tipo_cuenta = "1"; //tipo 1 asociado;
$leyenda1 = "ABM";
 include("../../../conexiones/config.inc.php");
$sql="select * from datos_laboratorio where nro_laboratorio like '$nro_cuenta'";
$result=$db->Execute($sql);

$nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);
$matricula1=$result->fields["matricula"];
$domicilio=$result->fields["domicilio"];
$nro_domicilio=$result->fields["nro_domicilio"];
$departamento=$result->fields["departamento"];


$direccion = $domicilio." ".$nro_domicilio." - ".$departamento;

$sql2="select * from afip where nro_laboratorio like '$nro_cuenta'";
$result2 = $db->Execute($sql2);
$cuit=strtoupper($result2->fields["nro_afip"]);
$tipo_fact1=strtoupper($result2->fields["sit_iva"]);
$iva=strtoupper($result2->fields["sit_iva"]);

switch ($iva){
	case "RESPONSABLE INSCRIPTO":{

$fact = "A";
$tipo_iva = 1;
		break;
	}

	case "EXENTO":{

$fact = "B";
$tipo_iva = 4;
		break;
	}

		case "MONOTRIBUTISTA":{

$tipo_iva = 3;
$fact = "B";
		break;
	}

			case "CONS. FINAL":{

$fact = "B";
$tipo_iva = 5;
$leyenda = "Irregular situaci&oacute;n AFIP";
include ("../../../alertas/campo_vacio.php");
EXIT;
		break;
	}

}


if ($forma_pago == 'CTA/CTE'){

if ($mostrar_recuadro_cuotas = "SI"){
$leyenda3 = "AUTORIZO A DESCONTAR EN LA LIQUIDACION. FIRMA...................";
}
ELSE
{
$leyenda3 = "AUTORIZO A DESCONTAR DE MIS HONORARIOS EN LA LIQUIDACION CORRESPONDIENTE";
$leyenda4 = "FIRMA:.........................";
}

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
        <td height="28" colspan="2"><div align="left"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo16">Sres:</span> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $denominacion." (".$nro.")";?></span></span></span></div></td>
        <td width="171" height="28" valign="bottom"><div align="right"><span class="Estilo16"><span class="Estilo22"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo18"><span class="Estilo14 Estilo22">Fecha:</span> <?echo $fecha_a;?></span></span></span></span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="2"><div align="left"><span class="Estilo16">Domicilio:</span><span class="Estilo15"> <span class="Estilo18  Estilo17"><?echo $direccion;?></span></span></div></td>
        <td height="20"><div align="right"><span class="Estilo16"><span class="Estilo22">Operador: <span class="Estilo23"><?echo $operador;?> Control: <?echo $fact?> - <?echo $nro_factura?></span></span></span></div></td>
      </tr>
      <tr>
        <td width="320" height="24"><div align="left" class="Estilo15"></div>
            <div align="left"></div>
            <span class="Estilo14  Estilo11">IVA</span><span class="Estilo19"><span class="Estilo15  Estilo17">:</span></span><span class="Estilo15 Estilo17"> <?print("$tipo_fact");?> - Cuit: <span class="Estilo22"><?echo $cuit;?> </span></span><span class="Estilo24"></span></td>
        <td colspan="2" valign="top"><div align="right"><span class="Estilo15  Estilo17"><span class="Estilo11  Estilo14"><span class="Estilo17">COND. VENTA: <?echo $forma_pago;?></span></span></span></div></td>
      </tr>
    </table>
      <table width="505" border="0">
        <!--DWLayoutTable-->
        <tr>
          <td width="25" height="21" valign="middle"><div align="center" class="Estilo16"></div>
              <div align="right" class="Estilo4 Estilo11 Estilo14">
                <div align="center"><span class="Estilo14 Estilo17">Cant</span></div>
            </div></td>
          <td colspan="4" valign="middle"><div align="center" class="Estilo11 Estilo14">Detalle - Presentaci&oacute;n - Lote - Vto Lote </div></td>
          <td width="58" valign="top"><div align="center"><span class="Estilo14 Estilo17">Pr. Unit.</span></div></td>
          <td width="67" valign="top"><div align="center"><span class="Estilo14 Estilo17">Total</span></div></td>
        </tr>
        <?

include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `ventas_detalle`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result = $db->Execute($sql);
if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$precio_actualizado=strtoupper($result->fields["precio_unitario"]);
$lote=strtoupper($result->fields["lote"]);

$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);

///////////////////////////////////

$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result5 = $db->Execute($sql);
$descripcion=strtoupper($result5->fields["descripcion"]);
$presentacion=strtoupper($result5->fields["presentacion"]);
$precio_actualizado=strtoupper($result5->fields["precio_actualizado"]);
$margendif=strtoupper($result5->fields["margendif"]);
$id_tasa=strtoupper($result5->fields["id_tasa"]);

$sql3="select * from tasas where cod_tasa = $id_tasa";
$result3 = $db->Execute($sql3);

$iva_normal=strtoupper($result3->fields["iva_normal"]);

//if ($plan == 1){
$margendif = 0;
//}

$porce_margendif = (($precio_actualizado * $margendif) /100);
$precio_actualizado = $precio_actualizado + $porce_margendif;


$sql3="select * from existencias where cod_mercaderia = $cod_mercaderia and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' ";
$result3 = $db->Execute($sql3);
$nro_fact_compra=strtoupper($result3->fields["nro_factura"]);
$cantidad_ingresada=strtoupper($result3->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result3->fields["cantidad_salida"]);
$cantidad_vendida = $cantidad_ingresada - $cantidad;
$cantidad_a_guardar = $cantidad + $cantidad_salida;


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
///////////////////////////////////

$precio_act_guardar = $precio_actualizado;
/////desc por articulo //////////////

$precio_neto = $precio_actualizado - $desc_articulo;
$precio_bruto = round($precio_neto * $cantidad,2);

if ($tipo_iva != 4){
$iva_articulo = round(($precio_actualizado * $iva_normal)/100,2);
$precio_actualizado = $precio_actualizado + $iva_articulo;
$iva_total = $iva_total + $iva_articulo;
}



$total = $precio_actualizado * $cantidad;
$desc_articulo = round(($total * $porc_dto)/100,2); // descuento por articulo 
$desc_factura1 = $desc_factura1 + $desc_articulo; // suma descuento total

$subtotal = $subtotal + $total;
$total_factura = $subtotal - $desc_factura1;



//$total_factura = round($neto,2) + round($iva,2);




$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura= $nro_factura_nuevo;
}



$sql = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_a_guardar' WHERE cod_mercaderia = $cod_mercaderia and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' and lote = '$lote'";
//mysql_query($sql);

$sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` ,  `tipo_fact` , `cod_movimiento` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` ,  `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , '$fact' , '5' , '$nro_factura' , '$cantidad' , '$precio_act_guardar' , '$lote' , '$mes_lote' , '$anio_lote' , '$nro' ,  '$tipo_cuenta')" ;
//mysql_query($sql);


$sql = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_actualizado' , '$total' , '$fact' )";
//mysql_query($sql);

?>
        <tr bgcolor="#FFFFFF">
          <td height="21" valign="top" class="Estilo25" scope="col"><div align="center" class="Estilo17"><span class="Estilo40 Estilo14 Estilo17"><?echo $cantidad;?></span></div></td>
          <td colspan="4" valign="top" scope="col"><div align="center" class="Estilo40 Estilo14 Estilo17">
              <div align="left"><span class="Estilo38 Estilo39 Estilo14 Estilo17"><?echo $cod_mercaderia. " - ".$descripcion." - ".$presentacion. " - ".$lote." - ".$mes_lote." - ".$anio_lote;?></span></div>
          </div></td>
          <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
              <div align="center"><?echo number_format($precio_actualizado,2);?></div>
          </div></td>
          <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
              <div align="center"><?echo number_format($total,2);?></div>
          </div></td>
        </tr>
        <?

	 $result->MoveNext();
		}


$desc_iva= round(($iva_total * $porc_dto)/100,2);
$iva_neto = $iva_total - $desc_iva;
$neto_gravado = $total_factura - $iva_neto;



$sql = "UPDATE `ventas_encabezado` SET `bruto` = '$subtotal', `descuento` = '$desc_factura1' , `neto_gravado` = '$neto_gravado' , `iva` = '$iva_neto' , `retencion` = '$retencion', `neto` = '$total_factura' WHERE `tipo_fact` = '$fact' AND `nro_factura` = '$nro_factura'";
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
          <td height="21" colspan="2"><div align="center"></div>
              <div align="center" class="Estilo22 Estilo14">
                <div align="left"></div>
              </div>
              <div align="center" class="Estilo14 Estilo25"><?echo number_format($bruto_ng,2);?></div></td>
          <td><div align="center" class="Estilo14 Estilo25"><?echo number_format($descuento_ng,2);?></div></td>
          <td><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
          <td colspan="2"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
          <td><div align="center" class="Estilo14"><strong><span class="Estilo25"><strong><?echo number_format($neto_ng,2);?></strong>
                      <?


if ($mostrar_recuadro_cuotas == "SI"){
$cuota = ($total_factura / $cantidad_cuotas);
$fecha;
$dia_vto = substr($fecha,8,2);
$mes_1 = substr($fecha,5,2)+1;
$anio_vto = substr($fecha,0,4);

if ($mes_1 > 12){
	$mes_1 = 1;
	$anio_vto = $anio_vto + 1;
}

if (strlen($mes_1) == 1){
	$mes_1 = "0".$mes_1;
}

$vencimiento1 = $dia_vto."/".$mes_1;



$mes_2 = $mes_1+1;


if ($mes_2 > 12){
	$mes_2 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_2) == 1){
	$mes_2 = "0".$mes_2;
}

$vencimiento2 = $dia_vto."/".$mes_2;

$mes_3 = $mes_2+1;



if ($mes_3 > 12){
	$mes_3 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_3) == 1){
	$mes_3 = "0".$mes_3;
}

$vencimiento3 = $dia_vto."/".$mes_3;

$mes_4 = $mes_3+1;


if ($mes_4 > 12){
	$mes_4 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_4) == 1){
	$mes_4 = "0".$mes_4;
}

$vencimiento4 = $dia_vto."/".$mes_4;

/////////////////////////////

$mes_5 = $mes_4+1;


if ($mes_5 > 12){
	$mes_5 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_5) == 1){
	$mes_5 = "0".$mes_5;
}

$vencimiento5 = $dia_vto."/".$mes_5;


$mes_6 = $mes_5+1;


if ($mes_6 > 12){
	$mes_6 = 1;
	$anio_vto = $anio_vto + 1;
}


if (strlen($mes_6) == 1){
	$mes_6 = "0".$mes_6;
}

$vencimiento6 = $dia_vto."/".$mes_6;



switch ($cantidad_cuotas){
	case "1":{

$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
		break;
	}

	case "2":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
		break;}

			case "3":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
		break;}

			case "4":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento4.")";

		break;}


			case "5":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento4.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento5.")";


		break;}

					case "6":{
$leyenda1 = "($ ".number_format($cuota,2)."-".$vencimiento1.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento2.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento3.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento4.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento5.")";
$leyenda1 = $leyenda1." ($ ".number_format($cuota,2)."-".$vencimiento6.")";
		break;}

}


$leyenda4 = $leyenda1;

}


////////////termina cuotas


if ($forma_pago == 'CTA/CTE'){
$sql = "INSERT INTO `resumen_cta_vta` ( `cuenta` , `tipo_cuenta` , `fecha` , `tipo_fact` , `comprobante` , `cod_movimiento` , `importe` , `vencimiento` , `referencia` , `afectacion` ) VALUES ( '$nro' , '$tipo_cuenta' ,'$fecha' , '$fact' , '$nro_factura' , '1' , '$total_factura' , '$vencimiento' , '$referencia' , '$afectacion')";
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

$desc_factura1= 0;
$subtotal= 0;

$total_factura = 0;
$neto = 0;
$iva = 0;
	?>
          </span> </strong></div></td>
        </tr>
        <tr>
          <td height="21" colspan="6">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="20" colspan="7"><div align="center" class="Estilo25"><span class="Estilo40 Estilo17  Estilo14"><?echo $leyenda3;?></span></div></td>
        </tr>
        <tr>
          <td height="20" colspan="7"><div align="center" class="Estilo25"><span class="Estilo14"><span class="Estilo40 Estilo17  Estilo14"><?echo $leyenda4;?></span></span></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>



</html>



