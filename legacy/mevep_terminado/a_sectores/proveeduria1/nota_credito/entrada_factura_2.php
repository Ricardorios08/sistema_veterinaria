<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<script language="javascript">
function on_load()
{
document.getElementById("cod_mercaderia").focus();
document.getElementById("cod_mercaderia").style.backgroundColor =  "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "forma_pago":
document.getElementById("cod_mercaderia").style.backgroundColor =  "#CCFFCC";
document.getElementById("cod_mercaderia").focus();
				break;

				case "cod_mercaderia":
document.getElementById("cod_mercaderia").style.backgroundColor = "#ffffff";	document.getElementById("cantidad").style.backgroundColor =  "#CCFFCC";
				document.getElementById("cantidad").focus();
				break;
				
				case "cantidad":
document.getElementById("cod_mercaderia").style.backgroundColor = "#CCFFFF";	document.getElementById("cantidad").style.backgroundColor =  "#CCFFFF";

				document.getElementById("OK").focus();
				break;
				
				
		}
		return false;
	}
	return true;
}

function abrirVentan() {
	var cod_detalle = <?echo $cod_detalle;?> 
    open("buscador_rapido.php","miVentana", "width=300,height=600,toolbar=no,directories=no,menubar=no,status=no, scrollbars=01, location = 01, top = 35");
}

</script>


</script>

<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
.Estilo67 {color: #FFFFFF; font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
.Estilo70 {color: #FFFFFF}
.Estilo71 {font-size: 10px}
.Estilo72 {font-size: 12px; color: #FFFFFF; }
-->

<!--
.Estilo79 {color: #000000}
.Estilo80 {color: #000000; font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
.Estilo59 {font-size: 14px}
.Estilo63 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo64 {color: #0000FF}
.Estilo65 {font-size: 14px; color: #0000FF; }
-->



</style>
</head>

<?
//$fecha_hoy = date("d/m/y");

$dia = $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio = $_REQUEST['anio'];

$$fecha_nc = $anio."-".$mes."-".$dia;
$fecha_hoy = $dia."-".$mes."-".$anio;


 //$nro_factura= $_REQUEST['nro_factura'];

$guarda_temp = $_REQUEST['guarda_temp'];

if ($band !=1){
$nro_factura_nc=$_REQUEST["nro_factura_nc"];
$nro_factura_afectada = $_REQUEST['nro_factura_afectada'];
$tipo_fact_afectado=$_REQUEST["tipo_fact_afectado"];

$dia = $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio = $_REQUEST['anio'];

$$fecha_nc = $anio."-".$mes."-".$dia;
$fecha_hoy = $dia."-".$mes."-".$anio;

include("../../../conexiones/config_pro.php");	

if ($guarda_temp == "SI"){
 $sql="select * from ventas_encabezado where tipo_fact = '$tipo_fact_afectado' ORDER BY nro_factura desc";
$result = $db->Execute($sql);

 $nro_factura_nc=($result->fields["nro_factura"] + 1);
}
else
{
$nro_factura_nc=$_REQUEST["nro_factura_nc"];
}
}




IF ($guarda_temp == "SI"){
 $sql = "SELECT * FROM `ventas_encabezado`  WHERE  `nro_factura` = '$nro_factura_afectada' and tipo_fact = '$tipo_fact_afectado'";
}
else
{
$sql = "SELECT * FROM `notacredito_encab_temp`  WHERE  `nro_factura` = '$nro_factura_nc' and tipo_fact = '$tipo_fact_afectado'";
}
$result = $db->Execute($sql);

$tipo_fact=strtoupper($result->fields["tipo_fact"]);

$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$operador=strtoupper($result->fields["operador"]);
$nro_cuenta=strtoupper($result->fields["nro_cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$fecha_original=strtoupper($result->fields["fecha"]);



$dia = substr($fecha,8,2);
$mes=substr($fecha,5,2);
$anio =substr($fecha,2,2);
$forma_pago=strtoupper($result->fields["forma_pago"]);

$bruto=strtoupper($result->fields["bruto"]);
$descuento=strtoupper($result->fields["descuento"]);
$total_iva=strtoupper($result->fields["iva"]);
$retencion=strtoupper($result->fields["retencion"]);
$total_fact=strtoupper($result->fields["neto"]);

$periodo=strtoupper($result->fields["periodo"]);
$anio=strtoupper($result->fields["anio"]);

Switch ($operador){
	case "101":{
		$nombre_operador = "Sergio Zavala";
		break;
	}

	case "201":{
$nombre_operador = "Juan Tomas";
break;
	}
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


 
if ($nro_cliente != 0){
$cuenta=$nro_cliente;
}elseif ($nro_cuenta != 0){
$cuenta=$nro_cuenta;
}


if ($nro_cliente!=0){
 include("../../../conexiones/config_pro.php");
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

$iva =$result7->fields["iva"];
$tipo_iva =$result7->fields["iva"];

switch ($tipo_iva){
	case "1":{
$tipo_fact = "Responsable Inscripto";
$fact = "A";
$tipo_iva= "1";

		break;
	}

	case "4":{
$tipo_fact = "Exento";
$fact = "B";
$tipo_iva= "4";

		break;
	}

		case "3":{
$tipo_fact = "Monotributo";
$fact = "B";
$tipo_iva= "3";
		break;
	}

}


$todo = $denominacion." (".$nro_cliente.")";
$band = "cliente";
}
elseif ($nro_cuenta!=""){ 
 include("../../../conexiones/config.inc.php");
$sql="select * from datos_laboratorio where nro_laboratorio like '$nro_cuenta'";
$result=$db->Execute($sql);

$nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);
$matricula1=$result->fields["matricula"];
$domicilio=$result->fields["domicilio"];
$nro_domicilio=$result->fields["nro_domicilio"];
$departamento=$result->fields["departamento"];


$direccion = $domicilio." ".$nro_domicilio." - ".$departamento;



$sql1="select * from datos_personales where matricula like '$nro_cuenta'";
$result1 = $db->Execute($sql1);

$nombre=strtoupper($result1->fields["nombre"]);
$apellido=strtoupper($result1->fields["apellido"]);

$sql2="select * from afip where nro_laboratorio like '$nro_cuenta'";
$result2 = $db->Execute($sql2);
$cuit=strtoupper($result2->fields["cuit"]);
$sit_iva=strtoupper($result2->fields["sit_iva"]);

switch ($sit_iva){
	case "RESPONSABLE INSCRIPTO":{
$tipo_iva = 1;
		break;
	}

	case "RI":{
$tipo_iva = 1;
		break;
	}

	case "EXENTO":{
$tipo_iva = 4;
		break;
	}

		case "MONOTRIBUTISTA":{
$tipo_iva = 3;
		break;
	}
}


$todo="Lab. ".$nombre_laboratorio." (".$cuenta.")";
$band = "cuenta";
}



$fecha_nc;



//////////

if ($guarda_temp == "SI"){

include("../../../conexiones/config_pro.php");
$dia = $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio = $_REQUEST['anio'];

$fecha_nc = $anio."-".$mes."-".$dia;
$fecha_hoy = $dia."-".$mes."-".$anio;
$sql = "INSERT INTO `notacredito_encab_temp` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `neto_gravado` , `iva` , `retencion` , `neto` , `forma_pago` , `porc_dto` , `tipo_iva`) VALUES ( '$tipo_fact_afectado'  , '$nro_factura_nc' , '$cod_operacion' , '$tipo_iva' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha_nc' , '$bruto' , '$descuento' , '$neto_gravado' , '$total_iva' , '$retencion'  , '$total_fact' , '$forma_pago' , '$porc_dto' , '$tipo_iva' )";
mysql_query($sql);

$nro_factura_afectada;

$sql3 = "SELECT * FROM `ventas_detalle`  WHERE  `nro_factura` = '$nro_factura_afectada' and tipo_fact = '$tipo_fact_afectado'";
$result3 = $db->Execute($sql3);


if (!$result3) die("fallo".$db->ErrorMsg());

 while (!$result3->EOF) {
$renglon = $renglon + 1;
$cod_mercaderia=strtoupper($result3->fields["cod_mercaderia"]);
$cantidad=strtoupper($result3->fields["cantidad"]);
$presentacion=strtoupper($result3->fields["presentacion"]);
$descripcion=strtoupper($result3->fields["descripcion"]);
$cod_detalle=strtoupper($result3->fields["cod_detalle"]);
$lote=strtoupper($result3->fields["lote"]);
$mes_lote=strtoupper($result3->fields["mes_lote"]);
$anio_lote=strtoupper($result3->fields["anio_lote"]);
 $precio_unitario=$result3->fields["precio_unitario"];
$total=$result3->fields["total"];



 $sql = "INSERT INTO `notacredito_deta_temp` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact`)  VALUES ('$nro_factura_nc' , '$cod_detalle' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_unitario' , '$total' , '$tipo_fact_afectado')";
mysql_query($sql);

	 $result3->MoveNext();
				}

}



?>


<body onload = "on_load ()">
<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">

<table width="99%" border="0">
          <!--DWLayoutTable-->
          <tr bgcolor="#000099">
            <td width="368" height="31" bordercolor="#000000" class="Estilo67"><div align="center"><span class="Estilo26"><span class="Estilo70"><span class="Estilo4 Estilo6  Estilo16 Estilo70"><span class="Estilo4 Estilo16  Estilo6"><span class="Estilo71"><span class="Estilo72">&nbsp;              &nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo72"> NOTA DE CREDITO N&ordm;:</span> <span class="Estilo72"><?echo $tipo_fact_afectado;?> - <?echo $nro_factura_nc;?> &nbsp;&nbsp;&nbsp;</span><span class="Estilo26">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo26"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo72">&nbsp;&nbsp;</span></span></span><span class="Estilo72"><span class="Estilo26">&nbsp;&nbsp;&nbsp;</span><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26">  </span></span></span></span></span></div></td>
            <td colspan="4" bordercolor="#000000" class="Estilo67"><div align="center"></div>              <div align="center"><span class="Estilo72">FECHA: <?echo $fecha_hoy;?> - Operador: <?echo $operador;?> <span class="Estilo26">&nbsp;</span></span></div></td>
          </tr>
          <tr bgcolor="#E6E6E6">
            <td height="28" colspan="2" valign="middle" bordercolor="#000000" class="Estilo67"><div align="right" class="Estilo18 Estilo79">
              <div align="left"><span class="Estilo14 Estilo41 Estilo27"><strong>CLIENTE: <?print("$denominacion");?> - </strong>FORMA DE PAGO: <?echo $forma_pago;?></span> </div>
            </div></td>
            <td colspan="2" valign="middle" bordercolor="#000000" class="Estilo80"><div align="center">Factura Afectada Nº: <?echo $nro_factura_afectada;?> - Fecha Emisi&oacute;n: <?echo $fecha_original;?></div></td>
            <td width="263" valign="top" bordercolor="#000000" class="Estilo67"><div align="center" class="Estilo79">Total  $ <?echo number_format($total_fact,2);?></div></td>
          </tr>


		  
          <tr bgcolor="#C4D7E6">
            <td height="20" colspan="3" valign="top" bgcolor="#E8DCFC"><div align="center"> <span class="Estilo16 Estilo59 Estilo64"><strong>Mercaderia:     <?echo $cod_mercaderia1."  ".$descripcion1."  ".$presentacion1; ?>                                 <strong>&nbsp;&nbsp;</strong>Lote: <?echo $lote1;?> &nbsp;&nbsp;&nbsp;&nbsp; Mes: <?echo $mes_lote1;?> &nbsp;&nbsp;&nbsp; Anio: <?echo $anio_lote1;?></strong></span><span class="Estilo65">
            <span class="Estilo63"><strong>&nbsp;&nbsp;</strong></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div></td>
            <td colspan="2" rowspan="2" valign="middle" bgcolor="#E8DCFC"><div align="center"><span class="Estilo26">&nbsp;</span><span class="Estilo16"><a href="control_nro_factura.php?&&nro_factura_nc=<?print("$nro_factura_nc");?>&&nro_factura_afectada=<?print("$nro_factura_afectada");?>&&tipo_fact_afectado=<?print("$tipo_fact_afectado");?>"><img src="../../../imagenes/office/1049.ico" alt="Confirmar" border = "0">CONFIRMAR NOTA DE CREDITO</a></span></div></td>
    </tr>
          <tr bgcolor="#C4D7E6">
            <td height="26" colspan="3" bgcolor="#E8DCFC"><div align="center"><span class="Estilo59">
              <span class="Estilo16 Estilo59"><strong>Cantidad:</strong></span>
              <input name="cantidad" type="text" value="<?echo $cantidad1;?>" id="cantidad8" size = "5">
            <input name="anio_lote1" type="hidden" value ="<?echo $anio_lote1;?>">
            <input name="nro_factura_nc" type="hidden" value ="<?echo $nro_factura_nc;?>">
            <input name="nro_factura_afectada" type="hidden" value ="<?echo $nro_factura_afectada;?>">
            <input name="nro_factura" type="hidden" value ="<?echo $nro_factura;?>">
            <input name="tipo_fact_afectado" type="hidden" value ="<?echo $tipo_fact_afectado;?>">
            <input name="mes_lote1" type="hidden" value ="<?echo $mes_lote1;?>">
            <input name="lote1" type="hidden" value ="<?echo $lote1;?>">
            <input name="cod_detalle1" type="hidden" value ="<?echo $cod_detalle1;?>">
            <input name="operador" type="hidden" value ="<?echo $operador;?>">
            <input name="porc_dto" type="hidden" value ="<?echo $porc_dto;?>">
			<input name="fecha_nc" type="hidden" value ="<?echo $fecha_nc;?>">

            <input name="guarda_temp" type="hidden" value ="NO">
            <input name="pasada" type="hidden" value ="1">
            <input name="Alta" type="submit" value= "Cambiar Cantidad" id = "Alta5">
            </span></div></td>
          </tr>
          <tr>
            <td height="3"></td>
            <td width="158"></td>
            <td width="357"></td>
            <td width="65"></td>
            <td></td>
          </tr>
  </table>
</form>


		
<?


		if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{
		case "OK":
				{

	 
$tipo_fact_afectado = $_REQUEST['tipo_fact_afectado'];
 $nro_factura_afectada = $_REQUEST['nro_factura_afectada'];
$nro_factura_nc= $_REQUEST['nro_factura_nc'];

//$nro_factura = $_REQUEST['nro_factura'];

 include ("refrescar.php");

			break;
				}


case "Cambiar Cantidad":
				{

	 
$tipo_fact_afectado = $_REQUEST['tipo_fact_afectado'];
$nro_factura_afectada = $_REQUEST['nro_factura_afectada'];
$nro_factura_nc= $_REQUEST['nro_factura_nc'];
$cantidad_a_guardar= $_REQUEST['cantidad'];
$lote1= $_REQUEST['lote1'];
$mes_lote1= $_REQUEST['mes_lote1'];
$anio_lote1= $_REQUEST['anio_lote1'];
$cod_detalle1= $_REQUEST['cod_detalle1'];

include("../../../conexiones/config_pro.php");	
 $sql3 = "SELECT * FROM `ventas_detalle`  WHERE  `nro_factura` = '$nro_factura_afectada' and tipo_fact = '$tipo_fact_afectado' and lote = '$lote1' and mes_lote = '$mes_lote1' and anio_lote = '$anio_lote1'";
$result3 = $db->Execute($sql3);
 $cantidad_original=$result3->fields["cantidad"];

if ($cantidad_a_guardar > $cantidad_original){
$leyenda = "NO PUEDE CAMBIAR CANTIDAD SUPERIOR A LA VENDIDA";
	include ("../../../alertas/campo_informacion2.php");
	EXIT;
}ELSE
					{

$sql = "UPDATE `notacredito_deta_temp` SET `cantidad` = '$cantidad_a_guardar' WHERE `cod_detalle` = '$cod_detalle1'";
mysql_query($sql);
					}
$cantidad_a_guardar = "";
//$nro_factura = $_REQUEST['nro_factura'];

 //include_once ("mostrar_detalle_B.php");

			break;
				}



	}
 }
 include_once ("mostrar_detalle_B.php");
?>
