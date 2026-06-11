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
.Estilo50 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo51 {font-size: 14px}
</STYLE>

<?


include ("../../../conexiones/config_pro.php");

$nro_factura=$_REQUEST["nro_factura"];
$tipo_fact=$_REQUEST["tipo_fact"];


$sql="select * from ventas_encabezado where nro_factura like '$nro_factura' and tipo_fact = '$tipo_fact' ORDER by nro_factura, fecha desc, periodo, anio";
$result = $db->Execute($sql);

$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$operador=strtoupper($result->fields["operador"]);
$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$fecha=strtoupper($result->fields["fecha"]);

$subtotal=strtoupper($result->fields["subtotal"]);
$descuento=strtoupper($result->fields["descuento"]);
$neto_gravado=strtoupper($result->fields["neto_gravado"]);
$iva=strtoupper($result->fields["iva"]);
$total=strtoupper($result->fields["total"]);
$tipo_iva=strtoupper($result->fields["tipo_iva"]);



Switch ($operador){
	case "1":{
		$nombre_operador = "Francisco";
		break;
	}

	case "2":{
$nombre_operador = "Florencia";
break;
	}
}


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


 




switch ($tipo_iva){
	case "1":{
$tipo_iva1 = "Resp. Inscripto";
		break;
	}

	case "4":{
$tipo_iva1 = "Exento";
		break;
	}

		case "3":{
$tipo_iva1 = "Mototributo";
		break;
	}

		case "5":{
$tipo_iva1 = "Consumidor Final";
		break;
	}

}



$sql="select * from clientes where cuenta like '$nro_cliente'";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);
$domicilio=$result->fields["domicilio"];
$puerta=$result->fields["puerta"];
$localidad=$result->fields["localidad"];
$direccion = $domicilio." ".$puerta." - ".$localidad;
$cuit=$result->fields["cuit"];

$todo = $denominacion." (".$nro_cliente.")";
$band = "cliente";
//*********************** encabezados *******************************************************************

?>


<table width="650" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr bgcolor="#E6E6E6">
    <td height="70" colspan="5" valign="top"><div align="center">
        <div align="center" class="Estilo67 Estilo72"><strong>FRANCISCO M. LOPEZ</strong></div>
        <div align="center" class="Estilo69 Estilo73"><strong>_________ VENTAS _______ </strong></div>
        <div align="center" class="Estilo71 Estilo23 Estilo14 Estilo41">RIOJA 0000 - 5500 MENDOZA </div>
        <div align="center" class="Estilo71 Estilo23 Estilo14 Estilo41">IVA RESPONSABLE INSCRIPTO </div>
    </div>      <div align="right" class="Estilo15"></div>      <div align="right" class="Estilo18">
        <div align="right"> </div>
    </div>      <div align="right"><span class="Estilo41"><span class="Estilo14"><span class="Estilo14 Estilo41 Estilo27"><span class="Estilo14 Estilo41  Estilo27"><strong></strong></span></span></span></span></div></td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td height="19" colspan="5" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr bgcolor="#FFEB84" class="Estilo6">
    <td width="108">
      <div align="right" class="Estilo18">CLIENTE
    </div></td>
    <td colspan="3"><span class="Estilo14 Estilo41 Estilo27"><strong>&nbsp; <strong> </strong><?print("$denominacion");?></strong></span></td>
    <td width="187"><div align="right"><span class="Estilo18">Factura N&ordm;: <span class="Estilo14 Estilo41 Estilo27"><strong>&nbsp;</strong></span><?echo $tipo_fact;?> - <?echo $nro_factura;?></span></div></td>
  </tr>
  <tr bgcolor="#FFEB84" class="Estilo6">
    <td><div align="right" class="Estilo18">
      <div align="right"><span class="Estilo14 Estilo41  Estilo27">DOMICILIO</span></div>
    </div></td>
    <td colspan="3"><span class="Estilo14 Estilo41  Estilo27"><strong><span class="Estilo14 Estilo41 Estilo27"><strong><strong>&nbsp;</strong> </strong></span><?print("$domicilio");?> <?print("$puerta");?> <?print("$localidad");?> </strong><span class="Estilo41"><span class="Estilo14"><span class="Estilo14 Estilo41 Estilo27"></span></span></span></span></td>
    <td><div align="right"><span class="Estilo18">Fecha: <span class="Estilo14 Estilo41 Estilo27"><strong>&nbsp;</strong></span><?echo $fecha;?></span></div></td>
  </tr>
  <tr bgcolor="#FFEB84">
    <td><div align="right" class="Estilo18">
      <div align="right"><span class="Estilo14 Estilo41 Estilo27">I.V.A </span></div>
    </div></td>
    <td width="104"><span class="Estilo14 Estilo41 Estilo27"><strong><strong>&nbsp;</strong><strong>&nbsp;</strong><?print("$tipo_iva1");?></strong></span></td>
    <td width="71"><div align="right"><span class="Estilo14 Estilo41 Estilo27"><span class="Estilo14 Estilo41  Estilo27">C.U.I.T </span></span></div></td>
    <td width="158"><span class="Estilo14 Estilo41 Estilo27"><span class="Estilo14 Estilo41  Estilo27"><strong><strong>&nbsp;</strong><strong>&nbsp;</strong><?print("$cuit");?></strong></span></span></td>
    <td><div align="right"><span class="Estilo18">Operador:<span class="Estilo14 Estilo41 Estilo27"><strong>&nbsp;</strong></span> <?print("$nombre_operador");?></span></div></td>
  </tr>
  <tr bgcolor="#FFEB84">
    <td colspan="5" bgcolor="#FFFFFF"><hr noshade></td>
  </tr>
</table>
<table width="707" border="0">
<?
$hora_inicio  = time();
//include ("../../../conexiones/config_grabacion.php");?>
<table width="650" border="0">
  <tr bgcolor="#FFEB84">
    <td colspan="2" scope="col"><div align="center" class="Estilo26 Estilo41 Estilo14">Descripcion / Mercaderia</div></td>
    <td width="12%" scope="col"><div align="center" class="Estilo15">Cantidad </div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo15"> C/U</div></td>
    <td width="10%" scope="col"><div align="center" class="Estilo15">Total</div></td>
  </tr><?


include ("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `ventas_detalle`  WHERE  `nro_factura` = $nro_factura and `tipo_fact` = '$tipo_fact'";
$result3 = $db->Execute($sql);
if (!$result3) die("fallo".$db->ErrorMsg());

 while (!$result3->EOF) {

$cod_mercaderia=strtoupper($result3->fields["cod_mercaderia"]);
$cantidad=strtoupper($result3->fields["cantidad"]);
$presentacion=strtoupper($result3->fields["presentacion"]);
$descripcion=strtoupper($result3->fields["descripcion"]);
$cod_detalle=strtoupper($result3->fields["cod_detalle"]);
$precio_unitario=strtoupper($result3->fields["precio_unitario"]);
$total=strtoupper($result3->fields["total"]);





?><tr bgcolor="#FFFFFF">
    <td colspan="2" bgcolor="#E6E6E6" scope="col"><div align="left" class="Estilo6 Estilo7 Estilo41 Estilo14"><?echo $cod_mercaderia. " - ".$descripcion;?></div></td>
    <td bgcolor="#E6E6E6" scope="col"><div align="center" class="Estilo9 Estilo41 Estilo14"><?echo $cantidad;?></div></td>

    <td bgcolor="#E6E6E6" scope="col"><div align="right" class="Estilo9 Estilo41 Estilo14"><?echo $precio_unitario;?></div></td>
    <td bgcolor="#E6E6E6" scope="col"><div align="right" class="Estilo9 Estilo41 Estilo14"><?echo $total;?></div></td>
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

?>

<tr bgcolor="#FFFFFF">
  <td colspan="5" scope="col"><hr noshade></td>
  </tr>
<tr bgcolor="#FFEB84">
    <td width="18%" scope="col"><div align="right" class="Estilo15">
      <div align="center"><span class="Estilo11">Sub Total<span class="Estilo7 Estilo41  Estilo6"><span class="Estilo9"></span></span> </span></div>
    </div></td>
    <td width="18%" scope="col"><div align="center" class="Estilo15"><span class="Estilo11">Descuento<span class="Estilo7 Estilo41  Estilo6"><span class="Estilo9"></span></span> </span></div>      
      <div align="center" class="Estilo15"></div></td>
    <td scope="col"><div align="center"><span class="Estilo11 Estilo41 Estilo14">IVA</span><span class="Estilo47"><strong> </strong></span></div></td>
    <td scope="col"><div align="center"></div></td>
    <td scope="col"><div align="center"><span class="Estilo11 Estilo41 Estilo14">Total</span></div></td>
</tr>
<tr bgcolor="#E6E6E6">
  <td scope="col"><div align="center"><span class="Estilo50"><?echo number_format($subtotal,2);?>
      </span>
    </div>
    <div align="right" class="Estilo50"></div></td>
  <td scope="col"><div align="center"><span class="Estilo50"><?echo number_format($descuento,2);?>
      </span>
    </div>
    <div align="right" class="Estilo50"></div></td>
  <td scope="col"><div align="center"><span class="Estilo50"><?echo number_format($iva,2);?>
      </span>
    </div>
    <div align="right" class="Estilo50"></div></td>
  <td scope="col"><div align="right"><span class="Estilo14"><span class="Estilo41"><span class="Estilo51"></span></span></span></div></td>
  <td scope="col"><div align="right" class="Estilo50">$ <?echo number_format($total,2);?></div></td>
</tr>
</table>
