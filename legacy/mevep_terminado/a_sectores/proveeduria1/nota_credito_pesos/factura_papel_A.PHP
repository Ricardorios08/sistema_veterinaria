

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
.Estilo65 {
	font-size: 14px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
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


$nro_factura_afectada= $_REQUEST['nro_factura_afectada'];
$tipo_fact_afectado =$_REQUEST['tipo_fact_afectado'];
$nro_factura_nc =$_REQUEST['nro_factura_nc'];
$nro_factura_detalle = $_REQUEST['nro_factura_nc'];
//$leyenda1 = $_REQUEST['leyenda1'];
$nro_factura_nuevo= $_REQUEST['nro_factura_nuevo'];
 $fact_nuevo= strtoupper($_REQUEST['fact_nuevo']);

$fecha_hoy = date("d-m-y");
$fecha_guardar = date ("Y-m-d");


include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas_encabezado`  WHERE  `nro_factura` = '$nro_factura_afectada' and tipo_fact = '$tipo_fact_afectado'";
$result = $db->Execute($sql2);
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
 $cuit=strtoupper($result2->fields["nro_afip"]);
 $sit_iva=strtoupper($result2->fields["sit_iva"]);

switch ($sit_iva){
	case "RESPONSABLE INSCRIPTO":{
$iva = "Responsable Inscripto";
$tipo_iva = 1;
		break;
	}

	case "EXENTO":{
$iva = "Exento";
$tipo_iva = 3;
		break;
	}

		case "MONOTRIBUTISTA":{
$iva = "Monotributo";
$tipo_iva = 2;
		break;
	}

		case "MON":{
$iva = "Monotributo";
$tipo_iva = 2;
		break;
	}

			case "CONS. FINAL":{
$iva = "Cons. FInal";
$fact = "B";
$tipo_iva = 4;
$leyenda = "Irregular situación AFIP";
include ("../../../alertas/campo_vacio.php");
EXIT;
		break;
	}

}
$todo="Lab. ".$nombre_laboratorio." (".$cuenta.")";
$band = "cuenta";
}

$leyenda= "FACTURA AFECTADA Nº ".$nro_factura_afectada;







if (($nro_factura_nuevo != "") && ($fact_nuevo != "")) {
$caso = 1;

$tipo_fact_afectatado = $fact_nuevo;
$nro_factura_nc = $nro_factura_nuevo;
}
if (($nro_factura_nuevo != "") && ($fact_nuevo == "")) {
$caso = 2;
$nro_factura_nc = $nro_factura_nuevo;
}
if (($nro_factura_nuevo == "") && ($fact_nuevo != "")) {
$caso = 3;
$tipo_fact_afectado = $fact_nuevo;
}
if (($nro_factura_nuevo == "") && ($fact_nuevo == "")) {
$caso = 4;
}
?>
        </span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="3"><div align="right" class="Estilo8 Estilo11 Estilo14"></div>          
          <div align="right" class="Estilo65"> 
            <div align="center">NOTA DE CREDITO </div>
          </div>          
          <div align="right"><span class="Estilo8 Estilo11 Estilo14">

        </span></div></td>
        </tr>
      <tr>
        <td height="28" colspan="2"><div align="left"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo16">Sres:</span> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $denominacion." (".$cuenta.")";?></span></span></span></div></td>
        <td width="171" height="28" valign="bottom"><div align="right"><span class="Estilo16"><span class="Estilo22"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo18"><span class="Estilo14 Estilo22">Fecha:</span> <?echo $fecha_hoy;?></span></span></span></span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="2"><div align="left"><span class="Estilo16">Domicilio:</span><span class="Estilo15"> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $direccion;?></span></span></span></div>          </td>
        <td height="20"><div align="right"><span class="Estilo16"><span class="Estilo22">Operador: <span class="Estilo23"><?echo $operador;?> Control: <?echo $tipo_fact_afectado?> - <?echo $nro_factura_nc?></span></span></span></div></td>
      </tr>
      <tr>
        <td width="320" height="24"><div align="left" class="Estilo15"></div>          <div align="left"></div>          
          <span class="Estilo14  Estilo11">IVA</span><span class="Estilo19"><span class="Estilo15  Estilo17">:</span></span><span class="Estilo15 Estilo17"> <?print("$iva");?> - Cuit: <span class="Estilo22"><?echo $cuit;?> </span></span><span class="Estilo24"></span></span></span></td>
        <td colspan="2" valign="top"><div align="right"><span class="Estilo15  Estilo17"><span class="Estilo11  Estilo14"><span class="Estilo17">COND.  VENTA: <?echo $forma_pago;?></span></span></span></div></td>
        </tr>
      
      </table>

<table width="505" border="0">
  <!--DWLayoutTable-->
        <tr><td width="410" height="21" valign="middle"><div align="center" class="Estilo16"></div>
            <div align="right" class="Estilo4 Estilo11 Estilo14">
              <div align="center"></div>
          </div>            <div align="center" class="Estilo11 Estilo14">Detalle</div>          <div align="center"></div></td>
        <td width="85" valign="top"><div align="center"><span class="Estilo14 Estilo17">Total</span></div></td>
      </tr>


<?

include("../../../conexiones/config_pro.php");


$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura_nc= $nro_factura_nuevo;
}




if ($tipo_fact_afectado == "A"){

$importe11 = $importe1;
$importe12 = $importe2;
$importe13 = $importe3;
$importe14 = $importe4;

$neto_gravado= $importe1 + $importe2 + $importe3 + $importe4;

if ($anular_iva == "NO"){
$iva_debito = round(($neto_gravado * 21)/100,2);
$total_nc = $neto_gravado + $iva_debito;
}
else
	{
$total_nc = $neto_gravado;
	}

}else
{

$neto_gravado = $importe1 + $importe2 + $importe3 + $importe4;

if ($anular_iva == "NO"){
$iva1 = round(($importe1 * 21)/100,2);
$iva2 = round(($importe2 * 21)/100,2);
$iva3 = round(($importe3 * 21)/100,2);
$iva4 = round(($importe4 * 21)/100,2);

$iva_debito = $iva1 + $iva2 + $iva3 + $iva4;

$importe11 = $importe1 + $iva1;
$importe12 = $importe2 + $iva2;
$importe13 = $importe3 + $iva3;
$importe14 = $importe4 + $iva4;

$total_renglon = $importe11 + $importe12 + $importe13 + $importe14;
$total_nc = $total_nc + $total_renglon;
}else{
$importe11 = $importe1;
$importe12 = $importe2;
$importe13 = $importe3;
$importe14 = $importe4;

$total_renglon = $importe11 + $importe12 + $importe13 + $importe14;
$total_nc = $total_nc + $total_renglon;

}
}

if ($importe11 == 0){
$importe11 = "";
}
if ($importe12 == 0){
$importe12 = "";
}
if ($importe13 == 0){
$importe13 = "";
}
if ($importe14 == 0){
$importe14 = "";
}

?>


      <tr>
        <td height="21"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $renglon1;?></span></span></span></td>
        <td><div align="center" class="Estilo25"><span class="Estilo14"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $importe11;?></span></span></span></div></td>
      </tr>
      <tr>
        <td height="21"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $renglon2;?></span></span></span></td>
        <td><div align="center" class="Estilo25"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $importe12;?></span></span></div></td>
      </tr>
      <tr>
        <td height="21"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $renglon3;?></span></span></span></td>
        <td><div align="center" class="Estilo25"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $importe13;?></span></span></div></td>
      </tr>
      <tr>
        <td height="21"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $renglon14;?></span></span></span></td>
        <td><div align="center" class="Estilo25"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $importe14;?></span></span></div></td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
     
	 <?if ($tipo_fact_afectado == "A"){?>
	
<tr>
        <td height="21" colspan="2"><div align="right"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25">Neto Gravado: <?echo $neto_gravado;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; IVA: <?echo $iva_debito;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total $ <?echo $total_nc;?></span></span></span></div></td>
        </tr>


<?}else{?>
	  <tr>
        <td height="21">&nbsp;</td>
        <td><div align="center"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25">$ <?echo number_format($total_nc,2);?></span></span></span></div></td>
      </tr>
<?}?>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20" colspan="2"><div align="center"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $leyenda1;?></span></span></span></div></td>
        </tr>
      <tr>
        <td height="20" colspan="2"><div align="center"><span class="Estilo14 Estilo25"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $leyenda2;?></span></span></span></span></div></td>
        </tr>
    </table>		</td>
    <td width="483" scope="col"><table width="503" height="137" border="0">
      <!--DWLayoutTable-->
      <tr>
        <td height="20" colspan="3"><div align="right"><span class="Estilo8 Estilo11 Estilo14">
            <?include ("../../../conexiones/config_pro.php");

$total_nc = "";
$nro_factura_afectada= $_REQUEST['nro_factura_afectada'];
$tipo_fact_afectado =$_REQUEST['tipo_fact_afectado'];
$nro_factura_nc =$_REQUEST['nro_factura_nc'];
$nro_factura_detalle = $_REQUEST['nro_factura_nc'];
//$leyenda1 = $_REQUEST['leyenda1'];
$nro_factura_nuevo= $_REQUEST['nro_factura_nuevo'];
 $fact_nuevo= strtoupper($_REQUEST['fact_nuevo']);

$fecha_hoy = date("d-m-y");
$fecha_guardar = date ("Y-m-d");


include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas_encabezado`  WHERE  `nro_factura` = '$nro_factura_afectada' and tipo_fact = '$tipo_fact_afectado'";
$result = $db->Execute($sql2);
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
		case "ENERO":{$periodo1= "01".$a&ntilde;o; $mes_actual="01";}break;
		case "FEBRERO":{$periodo1= "02".$a&ntilde;o;$mes_actual="02";}break;
		case "MARZO":{$periodo1= "03".$a&ntilde;o;$mes_actual="03";}break;
		case "ABRIL":{$periodo1= "04".$a&ntilde;o;$mes_actual="04";}break;
		case "MAYO":{$periodo1= "05".$a&ntilde;o;$mes_actual="05";}break;
		case "JUNIO":{$periodo1= "06".$a&ntilde;o;$mes_actual="06";}break;
		case "JULIO":{$periodo1= "07".$a&ntilde;o;$mes_actual="07";}break;
		case "AGOSTO":{$periodo1= "08".$a&ntilde;o;$mes_actual="08";}break;
		case "SETIEMBRE":{$periodo1= "09".$a&ntilde;o;$mes_actual="09";break;}
		case "OCTUBRE":{$periodo1= "10".$a&ntilde;o;$mes_actual="10";}break;
		case "NOVIEMBRE":{$periodo1= "11".$a&ntilde;o;$mes_actual="11";}break;
		case "DICIEMBRE":{$periodo1= "12".$a&ntilde;o;$mes_actual="12";}break;
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
 $cuit=strtoupper($result2->fields["nro_afip"]);
 $sit_iva=strtoupper($result2->fields["sit_iva"]);

switch ($sit_iva){
	case "RESPONSABLE INSCRIPTO":{
$iva = "Responsable Inscripto";
$tipo_iva = 1;
		break;
	}

	case "EXENTO":{
$iva = "Exento";
$tipo_iva = 3;
		break;
	}

		case "MONOTRIBUTISTA":{
$iva = "Monotributo";
$tipo_iva = 2;
		break;
	}

		case "MON":{
$iva = "Monotributo";
$tipo_iva = 2;
		break;
	}

			case "CONS. FINAL":{
$iva = "Cons. FInal";
$fact = "B";
$tipo_iva = 4;
$leyenda = "Irregular situaci&oacute;n AFIP";
include ("../../../alertas/campo_vacio.php");
EXIT;
		break;
	}

}
$todo="Lab. ".$nombre_laboratorio." (".$cuenta.")";
$band = "cuenta";
}

$leyenda= "FACTURA AFECTADA N&ordm; ".$nro_factura_afectada;







if (($nro_factura_nuevo != "") && ($fact_nuevo != "")) {
$caso = 1;

$tipo_fact_afectatado = $fact_nuevo;
$nro_factura_nc = $nro_factura_nuevo;
}
if (($nro_factura_nuevo != "") && ($fact_nuevo == "")) {
$caso = 2;
$nro_factura_nc = $nro_factura_nuevo;
}
if (($nro_factura_nuevo == "") && ($fact_nuevo != "")) {
$caso = 3;
$tipo_fact_afectado = $fact_nuevo;
}
if (($nro_factura_nuevo == "") && ($fact_nuevo == "")) {
$caso = 4;
}
?>
        </span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="3"><div align="right" class="Estilo8 Estilo11 Estilo14"></div>
            <div align="right" class="Estilo65">
              <div align="center">NOTA DE CREDITO </div>
            </div>
            <div align="right"><span class="Estilo8 Estilo11 Estilo14"> </span></div></td>
      </tr>
      <tr>
        <td height="28" colspan="2"><div align="left"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo16">Sres:</span> <span class="Estilo15"><span class="Estilo18  Estilo17"><?echo $denominacion." (".$cuenta.")";?></span></span></span></div></td>
        <td width="171" height="28" valign="bottom"><div align="right"><span class="Estilo16"><span class="Estilo22"><span class="Estilo8 Estilo11 Estilo14"><span class="Estilo18"><span class="Estilo14 Estilo22">Fecha:</span> <?echo $fecha_hoy;?></span></span></span></span></div></td>
      </tr>
      <tr>
        <td height="20" colspan="2"><div align="left"><span class="Estilo16">Domicilio:</span><span class="Estilo15"> <span class="Estilo18  Estilo17"><?echo $direccion;?></span></span></div></td>
        <td height="20"><div align="right"><span class="Estilo16"><span class="Estilo22">Operador: <span class="Estilo23"><?echo $operador;?> Control: <?echo $tipo_fact_afectado?> - <?echo $nro_factura_nc?></span></span></span></div></td>
      </tr>
      <tr>
        <td width="320" height="24"><div align="left" class="Estilo15"></div>
            <div align="left"></div>
            <span class="Estilo14  Estilo11">IVA</span><span class="Estilo19"><span class="Estilo15  Estilo17">:</span></span><span class="Estilo15 Estilo17"> <?print("$iva");?> - Cuit: <span class="Estilo22"><?echo $cuit;?> </span></span><span class="Estilo24"></span></td>
        <td colspan="2" valign="top"><div align="right"><span class="Estilo15  Estilo17"><span class="Estilo11  Estilo14"><span class="Estilo17">COND. VENTA: <?echo $forma_pago;?></span></span></span></div></td>
      </tr>
    </table>
      <table width="505" border="0">
        <!--DWLayoutTable-->
        <tr>
          <td width="410" height="21" valign="middle"><div align="center" class="Estilo16"></div>
              <div align="right" class="Estilo4 Estilo11 Estilo14">
                <div align="center"></div>
              </div>
              <div align="center" class="Estilo11 Estilo14">Detalle</div>
              <div align="center"></div></td>
          <td width="85" valign="top"><div align="center"><span class="Estilo14 Estilo17">Total</span></div></td>
        </tr>
        <?

include("../../../conexiones/config_pro.php");


$cont = $cont + 1;

if ($nro_factura_nuevo != ""){
$nro_factura_nc= $nro_factura_nuevo;
}




if ($tipo_fact_afectado == "A"){

$importe11 = $importe1;
$importe12 = $importe2;
$importe13 = $importe3;
$importe14 = $importe4;

$neto_gravado= $importe1 + $importe2 + $importe3 + $importe4;

if ($anular_iva == "NO"){
$iva_debito = round(($neto_gravado * 21)/100,2);
$total_nc = $neto_gravado + $iva_debito;
}
else
	{
$total_nc = $neto_gravado;
	}

}else
{

$neto_gravado = $importe1 + $importe2 + $importe3 + $importe4;

if ($anular_iva == "NO"){
$iva1 = round(($importe1 * 21)/100,2);
$iva2 = round(($importe2 * 21)/100,2);
$iva3 = round(($importe3 * 21)/100,2);
$iva4 = round(($importe4 * 21)/100,2);

$iva_debito = $iva1 + $iva2 + $iva3 + $iva4;

$importe11 = $importe1 + $iva1;
$importe12 = $importe2 + $iva2;
$importe13 = $importe3 + $iva3;
$importe14 = $importe4 + $iva4;

$total_renglon = $importe11 + $importe12 + $importe13 + $importe14;
$total_nc = $total_nc + $total_renglon;
}else{
$importe11 = $importe1;
$importe12 = $importe2;
$importe13 = $importe3;
$importe14 = $importe4;

$total_renglon = $importe11 + $importe12 + $importe13 + $importe14;
$total_nc = $total_nc + $total_renglon;

}
}

if ($importe11 == 0){
$importe11 = "";
}
if ($importe12 == 0){
$importe12 = "";
}
if ($importe13 == 0){
$importe13 = "";
}
if ($importe14 == 0){
$importe14 = "";
}

?>
        <tr>
          <td height="21"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $renglon1;?></span></span></span></td>
          <td><div align="center" class="Estilo25"><span class="Estilo14"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $importe11;?></span></span></span></div></td>
        </tr>
        <tr>
          <td height="21"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $renglon2;?></span></span></span></td>
          <td><div align="center" class="Estilo25"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $importe12;?></span></span></div></td>
        </tr>
        <tr>
          <td height="21"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $renglon3;?></span></span></span></td>
          <td><div align="center" class="Estilo25"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $importe13;?></span></span></div></td>
        </tr>
        <tr>
          <td height="21"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $renglon14;?></span></span></span></td>
          <td><div align="center" class="Estilo25"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $importe14;?></span></span></div></td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?if ($tipo_fact_afectado == "A"){?>
        <tr>
          <td height="21" colspan="2"><div align="right"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25">Neto Gravado: <?echo $neto_gravado;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; IVA: <?echo $iva_debito;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total $ <?echo $total_nc;?></span></span></span></div></td>
        </tr>
        <?}else{?>
        <tr>
          <td height="21">&nbsp;</td>
          <td><div align="center"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25">$ <?echo number_format($total_nc,2);?></span></span></span></div></td>
        </tr>
        <?}?>
        <tr>
          <td height="21">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="20" colspan="2"><div align="center"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28 Estilo25"><?echo $leyenda1;?></span></span></span></div></td>
        </tr>
        <tr>
          <td height="20" colspan="2"><div align="center"><span class="Estilo14 Estilo25"><span class="Estilo22"><span class="Estilo40 Estilo17  Estilo14"><span class="Estilo28"><?echo $leyenda2;?></span></span></span></span></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>

</html>



