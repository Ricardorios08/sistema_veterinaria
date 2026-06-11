
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
.Estilo28 {color: #FFFFFF}
.Estilo30 {color: #000000}
.Estilo31 {font-size: 12px; color: #000000; }
.Estilo32 {font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
-->
</style>

<script language="javascript">
function on_load()
{
document.getElementById("cantidad").focus();
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				

					case "cantidad":
				document.getElementById("cod_mercaderia").focus();
				break;
				
				case "cod_mercaderia":
				document.getElementById("lote").focus();
				break;

				case "lote":
				document.getElementById("mes_lote").focus();
				break;
				case "mes_lote":
				document.getElementById("anio_lote").focus();
				break;
				case "anio_lote":
				document.getElementById("precio_unitario").focus();
				break;
				case "precio_unitario":
				document.getElementById("total").focus();
				break;

				case "total":
				document.getElementById("enviar").focus();
				break;

		}
		return false;
	}
	return true;
}



</script>

<!--  <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()">  -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<body onload = "on_load ()">
<FORM name="form" ACTION="guardar_renglon.php" METHOD = "POST">
  <table width="727" border="0">
    <tr>
      <td width="721"><div align="right"><span class="Estilo8 Estilo11 Estilo14">
          <?include ("../../../conexiones/config_pro.php");

//$nro_factura= $_REQUEST['nro_factura'];
//$fact =$_REQUEST['fact'];
//$tipo_fact =$_REQUEST['tipo_fact'];
$cuit= $_REQUEST['cuit'];
$direccion= $_REQUEST['direccion'];
$leyenda2 =  $_REQUEST['leyenda1'];
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


$nro_factura_nuevo= $_REQUEST['nro_factura_nuevo'];
$fact_nuevo= strtoupper($_REQUEST['fact_nuevo']);

$fact = "B";
$fact1 = $fact;
include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas_encabezado`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result2 = $db->Execute($sql2);


$abruto=$result2->fields["bruto"];
$adescuento=$result2->fields["descuento"];
$aneto_gravado=$result2->fields["neto_gravado"];
$aiva=$result2->fields["iva"];
$aretencion=$result2->fields["retencion"];
$aneto=$result2->fields["neto"];



$nro_cliente=strtoupper($result2->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result2->fields["nro_cuenta"]);
$cod_operacion=strtoupper($result2->fields["cod_operacion"]);
$fact=strtoupper($result2->fields["tipo_fact"]);
$tipo_iva=strtoupper($result2->fields["tipo"]);

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
    <tr bgcolor="#FFFFCC">
      <td height="29"><div align="left" class="Estilo23">
        <div align="center">Sres: <?echo $denominacion." (".$nro.")";?></div>
      </div></td>
    </tr>
    <tr bgcolor="#FFFFCC">
      <td><div align="left"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo15"><span class="Estilo18  Estilo17"><span class="Estilo22"><span class="Estilo18"><span class="Estilo14 Estilo22">
        <input name="cuenta" type="text" value="<?echo $nro;?>" size="10">
          <input name="tipo_cuenta" type="text" id="tipo_cuenta" value="<?echo $tipo_cuenta;?>" size="10">
</span></span></span></span></span></span><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo18"><span class="Estilo14 Estilo22">Fecha
                      <input name="fecha" type="text" value="<?echo $fecha;?>" size="10">
          FACTURA:</span> </span></span><span class="Estilo8 Estilo11  Estilo14"><span class="Estilo16"><span class="Estilo23"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo18"><span class="Estilo14 Estilo22">
          <input name="tipo_fact" type="text" id="tipo_fact" value="<?echo $fact;?>" size="2">
          <input name="nro_factura" type="text" id="nroi_factura3" value="<?echo $nro_factura;?>" size="10"> 
          cod_movimiento
          <input name="cod_movimiento" type="text" id="nro_factura" value="5" size="1" maxlength="1">
          </span></span></span></span></span></span></div>        <div align="right" class="Estilo22"></div></td>
    </tr>
  </table>
  <table width="96%" border="0">
    <!--DWLayoutTable-->
    <tr bgcolor="#FFFFCC">
      <td width="9%" valign="middle"><div align="center" class="Estilo16"></div>
          <div align="right" class="Estilo4 Estilo11 Estilo14">
            <div align="center"><span class="Estilo14 Estilo17">Cant</span></div>
      </div></td>
      <td colspan="4" valign="middle"><div align="center" class="Estilo11 Estilo14">Detalle - Presentaci&oacute;n - Lote - Vto Lote </div></td>
      <td width="9%" valign="top"><div align="center"><span class="Estilo14 Estilo17">Pr. Unit.</span></div></td>
      <td width="11%" valign="top"><div align="center"><span class="Estilo14 Estilo17">Total</span></div></td>
    </tr>
    <?

include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `ventas_detalle`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result = $db->Execute($sql);
if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);

$lote=strtoupper($result->fields["lote"]);

$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);

//$total=strtoupper($result->fields["total"]);
//$cod_detalle=strtoupper($result->fields["cod_detalle"]);

$sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);
$precio_actualizado=strtoupper($result2->fields["precio_actualizado"]);
$id_tasa=strtoupper($result2->fields["id_tasa"]);

$sql3="select * from tasas where cod_tasa = $id_tasa";
$result3 = $db->Execute($sql3);

$iva_normal=strtoupper($result3->fields["iva_normal"]);



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

$total = $precio_actualizado * $cantidad;

$total = round($total,2);

$subtotal = $subtotal + $total;









$sql3="select * from existencias where cod_mercaderia = $cod_mercaderia and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' ";
$result3 = $db->Execute($sql3);
$nro_fact_compra=strtoupper($result3->fields["nro_factura"]);

$cantidad_ingresada=strtoupper($result3->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result3->fields["cantidad_salida"]);
$cantidad_vendida = $cantidad_ingresada - $cantidad;
$cantidad_a_guardar = $cantidad + $cantidad_salida;


//$precio_actualizado= number_format($precio_actualizado,2);
$total = number_format($total,2);

//$precio_actualizado= round($precio_actualizado,2);



$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura= $nro_factura_nuevo;
}



$sql = "UPDATE `existencias` SET `cantidad_salida` = '$cantidad_a_guardar' WHERE cod_mercaderia = $cod_mercaderia and mes_lote = '$mes_lote' and anio_lote = '$anio_lote' and lote = '$lote' and nro_factura = '$nro_factura_compra'";
//mysql_query($sql);

$sql = "INSERT INTO `stock` ( `cod_mercaderia` , `fecha` ,  `tipo_fact` , `cod_movimiento` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` , `mes_lote` , `anio_lote` , `cuenta` ,  `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha' , '$fact' , '5' , '$nro_factura' , '$cantidad' , '$precio_unitario' , '$lote' , '$mes_lote' , '$anio_lote' , '$nro' ,  '$tipo_cuenta')" ;
//mysql_query($sql);


$sql = "INSERT INTO `ventas_detalle` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_actualizado' , '$total' , '$fact' )";
//mysql_query($sql);

?>
    <tr bgcolor="#000000">
      <td scope="col"><div align="center" class="Estilo22 Estilo28"><span class="Estilo40 Estilo17  Estilo14"><?echo $cantidad;?></span></div></td>
      <td colspan="4" scope="col"><div align="center" class="Estilo40 Estilo14 Estilo22 Estilo28">
          <div align="left"><span class="Estilo28 Estilo38 Estilo39 Estilo14  Estilo22"><?echo $cod_mercaderia. " - ".$descripcion." - ".$presentacion. " - ".$lote." - ".$mes_lote." - ".$anio_lote;?></span></div>
      </div></td>
      <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17 Estilo28">
          <div align="center">
            <p class="Estilo22"><?echo $precio_actualizado;?></p>
          </div>
      </div></td>
      <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17 Estilo28">
          <div align="center"><span class="Estilo22"><?echo $total;?></span></div>
      </div></td>
    </tr>
    <?

	 $result->MoveNext();
		}

$desc_fact = round(($subtotal * $porc_dto)/100,2);
$neto_gravado = $subtotal - $desc_fact;
$iva = round(($neto_gravado * $iva_normal) /100,2);
$total_factura = $neto_gravado + $iva;


/*
$subtotal= number_format($subtotal,2);
$neto_gravado = number_format($neto_gravado,2);
$desc_fact = number_format($desc_fact,2);
$iva = number_format($iva,2);
$total_factura = number_format($total_factura,2);

*/



 $sumatoria = $cont;
		$cont = 0;

$sumatoria = 0;
?>
    <tr>
      <td colspan="7" class="Estilo25"><hr noshade>   </td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td colspan="2" class="Estilo25 Estilo30"><div align="center" class="Estilo25"></div>
          <div align="center" class="Estilo14  Estilo25">
            <div align="left" class="Estilo30"></div>
          </div>
          <div align="center"><?echo number_format($abruto,2);?>j</div></td>
      <td width="14%" class="Estilo25"><div align="center" ><?echo number_format($adescuento,2);?></span></div></td>
      <td width="10%" ><span class="Estilo30"><span class="Estilo32">j<?echo number_format($aneto_gravado,2);?>&nbsp;</span></span></td>
      <td colspan="2" class="Estilo25"><div align="center" class="Estilo31"> <span class="Estilo14 Estilo25"><span ><?echo number_format($aiva,2);?></span></span></div></td>
      <td><div align="center" class="Estilo31"><span class="Estilo14"><strong><?echo number_format($aneto,2);?></strong></span></div>
    </tr>
    <tr bgcolor="#0000FF">
      <td valign="middle"><div align="center" class="Estilo16 Estilo28"></div>
          <div align="right" class="Estilo4 Estilo11 Estilo14 Estilo28">
            <div align="center"><span class="Estilo14  Estilo17">CANTIDAD</span></div>
        </div></td>
      <td valign="middle"><div align="center" class="Estilo11 Estilo14 Estilo28">
        <div align="center">COD MERCADERIA</div>
      </div></td>
      <td valign="middle"><div align="center"><span class="Estilo11 Estilo14 Estilo28">lote</span></div></td>
      <td valign="middle"><div align="center"><span class="Estilo11 Estilo14 Estilo28">mes</span></div></td>
      <td valign="middle"><div align="center"><span class="Estilo11 Estilo14 Estilo28">anio</span></div></td>
      <td valign="top"><div align="center" class="Estilo28"><span class="Estilo14  Estilo17">Pr. Unit.</span></div></td>
      <td valign="top"><div align="center" class="Estilo28"><span class="Estilo14  Estilo17">Total</span></div></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td valign="top" scope="col"><div align="center" class="Estilo22">
        <div align="center"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22">
            <input name="cantidad" type="text" size="10" id="cantidad" onKeyPress="return verif_caracter(this,event)">
        </span></span></span></div>
      </div></td>
      <td valign="top" scope="col"><div align="center" class="Estilo40 Estilo14 Estilo22">
          <div align="center"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22">
            <input name="cod_mercaderia" type="text" size="10" id="cod_mercaderia" onKeyPress="return verif_caracter(this,event)">
          </span></span></div>
      </div></td>
      <td valign="top" scope="col"><div align="center"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22">
          <input name="lote" type="text"  size="10" id="lote" onKeyPress="return verif_caracter(this,event)">
      </span></span></div></td>
      <td valign="top" scope="col"><div align="center"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22">
          <input name="mes_lote" type="text" size="10" id="mes_lote" onKeyPress="return verif_caracter(this,event)">
      </span></span></div></td>
      <td valign="top" scope="col"><div align="center"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22">
          <input name="anio_lote" type="text"  size="10" id="anio_lote" onKeyPress="return verif_caracter(this,event)">
      </span></span></div></td>
      <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
          <div align="center"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22">
            <input name="precio_unitario" type="text" size="10" id="precio_unitario" onKeyPress="return verif_caracter(this,event)">>
          </span></span></div>
      </div></td>
      <td valign="top" scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17">
          <div align="center"><span class="Estilo28"><span class="Estilo28 Estilo38 Estilo39 Estilo14 Estilo22">
            <input name="total" type="text" size="10" id="total" onKeyPress="return verif_caracter(this,event)">>
          </span></span></div>
      </div></td>
    </tr>
    <?





?>
    <tr>
      <td colspan="7">
        <div align="center">
          <input type="submit" name="Submit" value="Enviar">
      </div></td>
    </tr>
  </table>

</form>
</body>



</html>

<?


$total_factura = 0;
$neto = 0;
$iva = 0;
?>