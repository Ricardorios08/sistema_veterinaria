<style type="text/css">
<!--

.Estilo6 {color: #FF0000}
-->
H1.SaltoDePagina
{
PAGE-BREAK-AFTER: always
}
.Estilo27 {color: #000000}
.Estilo41 {font-family: Arial, Helvetica, sans-serif}
.Estilo14 {font-size: 12px}
.Estilo15 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo18 {color: #000000; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo47 {font-size: 10px}
.Estilo48 {color: #FFFFFF}
.Estilo49 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo50 {font-size: 14px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif;}
.Estilo52 {color: #000000; font-weight: bold; }
</STYLE>

<?


include ("../../../conexiones/config_pro.php");
$nro_factura=$_REQUEST["nro_factura"];


$sql="select * from compras_encabezado where nro_factura like '$nro_factura'  ORDER by nro_factura, fecha desc, periodo, anio";
$result = $db->Execute($sql);

$nro_proveedor=strtoupper($result->fields["nro_proveedor"]);

$sql1="select * from proveedores where cuenta like '$nro_proveedor'";
$result1 = $db->Execute($sql1);


$denominacion=strtoupper($result1->fields["denominacion"]);
$domicilio=strtoupper($result1->fields["domicilio"]);
$puerta=strtoupper($result1->fields["puerta"]);
$localidad=strtoupper($result1->fields["localidad"]);

$direccion = $domicilio." ".$puerta. " - ".$localidad;

$tipo_fact=strtoupper($result1->fields["tipo_iva"]);
$cuit=$result1->fields["cuit"];

switch ($tipo_fact){
	case "1":{
$tipo_fact = "RESP. INSCRIPTO";
		break;
	}

	case "2":{
$tipo_fact = "RNI";
		break;
	}

case "3":{
$tipo_fact = "Monotributo";
		break;
	}

		case "4":{
$tipo_fact = "EXENTO";
		break;
	}

		case "5":{
$tipo_fact = "Consumidor Final";
		break;
	}

}




$fecha=strtoupper($result->fields["fecha"]);
$descuento=strtoupper($result->fields["descuento"]);

$bonificacion=strtoupper($result->fields["bonificacion"]);
$subtotal=strtoupper($result->fields["subtotal"]);
$iva=strtoupper($result->fields["iva"]);
$total_fact=strtoupper($result->fields["total"]);
$periodo=strtoupper($result->fields["periodo"]);
$anio=strtoupper($result->fields["anio"]);
$operador=strtoupper($result->fields["operador"]);



if (strlen($anio) == 4){
$anio = substr($anio,2);
}

switch ($mes)
					{
		case "ENERO":{$periodo1= "01".$año; $mes_actual="01";}break;
		case "FEBRERO":{$periodo1= "02".$año;$mes_actual="02";}break;
		case "MARZO":{$periodo1= "03".$año;$mes_actual="03";}break;
		case "ABRIL":{$periodo1= "04".$año;$mes_actual="04";}break;
		case "MAYO":{$periodo1= "05".$año;$mes_actual="05";}break;
		case "JUNIO":{$periodo1= "06".$año;$mes_actual="06";}break;
		case "JULIO":{$periodo1= "07".$año;$mes_actual="07";}break;
		case "AGOSTO":{$periodo1= "08".$año;$mes_actual="08";}break;
		case "SETIEMBRE":{$periodo1= "09".$año;$mes_actual="09";break;}
		case "OCTUBRE":{$periodo1= "10".$año;$mes_actual="10";}break;
		case "NOVIEMBRE":{$periodo1= "11".$año;$mes_actual="11";}break;
		case "DICIEMBRE":{$periodo1= "12".$año;$mes_actual="12";}break;
					}


 


//*********************** encabezados *******************************************************************

?>


<table width="91%" border="0">
    <tr>
      <td height="33" colspan="4" bgcolor="#000099"><div align="center"><span class="Estilo49">FACTURA DE COMPRA</span><span class="Estilo27"><span class="Estilo50"> (</span></span><span class="Estilo50">PERIODO <?print("$periodo");?> - <?print("$anio");?></span><span class="Estilo27"><span class="Estilo50"><span class="Estilo48">) </span></span></span></div>        <div align="center"></div>        <div align="right" class="Estilo18"></div>        <div align="left" class="Estilo27"></div></td>
  </tr>
  <tr bgcolor="#E1F2EF" class="Estilo6">
    <td colspan="2" class="Estilo14 Estilo41 Estilo27">PROVEEDOR:<strong> <?print("$denominacion");?> </strong></td>
    <td width="9%" class="Estilo14 Estilo41 Estilo27"><div align="right"><span class="Estilo18">Factura Nº:</span></div></td>
    <td width="16%" class="Estilo14 Estilo41 Estilo27"><span class="Estilo52"><?echo $nro_factura;?></span></td>
  </tr>
  <tr bgcolor="#E1F2EF" class="Estilo6">
    <td colspan="2" class="Estilo14 Estilo41  Estilo27">DOMICILIO:<strong> <?print("$domicilio");?> <?print("$puerta");?> <?print("$localidad");?>
    </strong>      
    <div align="right"><span class="Estilo41"><span class="Estilo14"><span class="Estilo14 Estilo41 Estilo27"><span class="Estilo14 Estilo41  Estilo27"></span></span></span></span></div></td>
    <td><div align="right"><span class="Estilo41"><span class="Estilo14"><span class="Estilo14 Estilo41  Estilo27"><span class="Estilo18">Fecha</span></span></span></span></div></td>
    <td><span class="Estilo41"><span class="Estilo14"><span class="Estilo14 Estilo41 Estilo27"><span class="Estilo14 Estilo41  Estilo27"><span class="Estilo52"><?echo $fecha;?></span></span></span></span></span></td>
  </tr>
  <tr bgcolor="#E1F2EF" class="Estilo6">
    <td width="43%" class="Estilo14 Estilo41 Estilo27">I.V.A:<strong> <?print("$tipo_fact");?></strong>
      <div align="right"><span class="Estilo15"><span class="Estilo27"><span class="Estilo41"><span class="Estilo14"><span class="Estilo14 Estilo41 Estilo27"></span></span></span></span></span></div></td>
    <td width="32%" class="Estilo14 Estilo41 Estilo27"><span class="Estilo14 Estilo41  Estilo27">C.U.I.T.<strong> <?print("$cuit");?></strong></span></td>
    <td class="Estilo14 Estilo41  Estilo27"><div align="right"><span class="Estilo15"><span class="Estilo27"><span class="Estilo41"><span class="Estilo14"><span class="Estilo14 Estilo41  Estilo27">Operador::</span></span></span></span></span></div></td>
    <td class="Estilo14 Estilo41  Estilo27"><span class="Estilo15"><span class="Estilo27"><span class="Estilo41"><span class="Estilo14"><span class="Estilo14 Estilo41 Estilo27"><strong><?print("$operador");?></strong></span></span></span> </span></span></td>
  </tr>
</table>


 <table width="707" border="0">
 
<?
$hora_inicio  = time();
//include ("../../../conexiones/config_grabacion.php");?>

<table width="91%" border="0">
  <tr bgcolor="#FFBC79">
    <td height="23" colspan="2" scope="col"><div align="center" class="Estilo26 Estilo41 Estilo14">Descripcion / Mercaderia</div></td>
	    <td width="16%" scope="col"><div align="center" class="Estilo26 Estilo41 Estilo14">Presentacion</div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo15">Cantidad</div></td>
	    <td width="8%" scope="col"><div align="center" class="Estilo15"> Lote</div></td>
		    <td width="12%" scope="col"><div align="center" class="Estilo15"> Vencimiento</div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo15"> C/U</div></td>
    <td width="10%" scope="col"><div align="center" class="Estilo15">Total</div></td>
  </tr><?


include ("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `compras_detalle`  WHERE  `nro_factura` = $nro_factura";
$result3 = $db->Execute($sql);
if (!$result3) die("fallo".$db->ErrorMsg());

 while (!$result3->EOF) {

$cod_mercaderia=strtoupper($result3->fields["cod_mercaderia"]);
$cantidad=strtoupper($result3->fields["cantidad"]);
$presentacion=strtoupper($result3->fields["presentacion"]);
$descripcion=strtoupper($result3->fields["descripcion"]);
$cod_detalle=strtoupper($result3->fields["cod_detalle"]);
$lote=strtoupper($result3->fields["lote"]);
$mes_lote=strtoupper($result3->fields["mes_lote"]);
$anio_lote=strtoupper($result3->fields["anio_lote"]);

$precio_unitario=strtoupper($result3->fields["precio_unitario"]);
$total=strtoupper($result3->fields["total"]);

$vto_lote = $mes_lote."/".$anio_lote;


$sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);

?><tr bgcolor="#F2FACB">

    <td height="34" colspan="2" scope="col"><div align="left" class="Estilo6 Estilo7 Estilo41 Estilo14"><?echo $cod_mercaderia. " - ".$descripcion;?></div></td>
    <td scope="col"><div align="center" class="Estilo9 Estilo41 Estilo14"><span class="Estilo26"><?echo $presentacion;?></span></div></td>
    <td scope="col"><div align="center" class="Estilo9 Estilo41 Estilo14"><?echo $cantidad;?></div></td>
    <td scope="col"><div align="center" class="Estilo9 Estilo41 Estilo14"><span class="Estilo26"><?echo $lote;?></span></div></td>
    <td scope="col"><div align="center" class="Estilo9 Estilo41 Estilo14"><?echo $vto_lote;?></div></td>

    <td scope="col"><div align="right" class="Estilo9 Estilo41 Estilo14">$ <?echo $precio_unitario;?></div></td>
    <td scope="col"><div align="right" class="Estilo9 Estilo41 Estilo14">$ <?echo $total;?></div></td>
   </tr>
<?


	        $total_cantidad = $total_cantidad + $cantidad;
	        $total_unitario = $precio_unitario + $cantidad;
	        $total_neto = $total_neto + $total;

			$descuento = ($total_neto * $porcentaje_dto) /100;
$total_gral = $total_neto - $descuento;
									
$total_item = $total_item + 1;


	 $result3->MoveNext();
				}
$sumatoria = $total_item;
//include ("../facturacion/espacios_en_blancos.php");
?>

<tr bgcolor="#FFFFFF">
  <td height="21" colspan="8" scope="col"><hr noshade></td>
  </tr>
<tr bgcolor="#E6E6E6">
    <td width="18%" height="21" scope="col"><div align="right" class="Estilo15"><span class="Estilo11">Sub Total  $ <span class="Estilo7 Estilo41  Estilo6"><span class="Estilo9"><strong><?echo number_format($subtotal,2);?></strong></span></span> </span></div></td>
    <td width="18%" scope="col"><div align="center" class="Estilo15"><span class="Estilo11">Descuento $ <span class="Estilo7 Estilo41  Estilo6"><span class="Estilo9"><strong><?echo number_format($descuento,2);?></strong></span></span> </span></div>      
      <div align="center" class="Estilo15"></div></td>
    <td height="21" colspan="2" scope="col">      <div align="left" class="Estilo15"></div>      <div align="right" class="Estilo9 Estilo41 Estilo14">
      <div align="left"> <span class="Estilo11">Retenci&oacute;n: $ </span><strong><span class="Estilo11"> <span class="Estilo7 Estilo41  Estilo6"><strong><?echo number_format($retencion,2);?></strong></span> </span></strong></div>
    </div>      <div align="right" class="Estilo9 Estilo41 Estilo14"></div>      </td>
    <td height="21" colspan="2" scope="col"><span class="Estilo11 Estilo41 Estilo14">IVA: <span class="Estilo47">$ </span></span><span class="Estilo47"><strong> <span class="Estilo7 Estilo41  Estilo6"><strong><?echo number_format($iva,2);?></strong></span> </strong></span></td>
    <td height="21" colspan="2" scope="col"><span class="Estilo11 Estilo41 Estilo14">Total $ <span class="Estilo7 Estilo41  Estilo6"><strong><?echo number_format($total_fact,2);?></strong></span></span></td>
  </tr>
<tr bgcolor="#E6E6E6">
  <td height="21" scope="col"><div align="right" class="Estilo11 Estilo41 Estilo14"><strong>Cantidad Items: <span class="Estilo7 Estilo41  Estilo6"></span> </strong></div></td>
  <td height="21" scope="col"><span class="Estilo11 Estilo41 Estilo14"><strong><span class="Estilo7 Estilo41  Estilo6"><strong><?echo $total_item;?></strong></span></strong></span></td>
  <td height="21" colspan="6" scope="col"><span class="Estilo11 Estilo14 Estilo41">Cantidad de Mercaderia Ingresada: <span class="Estilo7 Estilo41  Estilo6"><strong><?echo $total_cantidad;?></strong></span></span></td>
  </tr>
</table>

