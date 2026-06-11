<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<script language="javascript">
function on_load()
{
document.getElementById("renglon1").focus();
document.getElementById("renglon1").style.backgroundColor =  "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "renglon1":
document.getElementById("importe1").focus();
				break;

				case "importe1":
document.getElementById("renglon2").focus();
				break;


				case "renglon2":
document.getElementById("importe2").focus();
				break;

				case "importe2":
document.getElementById("renglon3").focus();
				break;
				
				case "renglon3":
document.getElementById("importe3").focus();
				break;

				case "importe3":
document.getElementById("renglon4").focus();
				break;

				case "renglon4":
document.getElementById("importe4").focus();
				break;

				case "importe4":
document.getElementById("Alta").focus();
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
.Estilo59 {font-size: 14px}
.Estilo81 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
-->



</style>
</head>

<?
$fecha_hoy = date("d/m/y");


 $nro_factura_afectada = $_REQUEST['nro_factura_afectada'];
 $tipo_fact_afectado=$_REQUEST["tipo_fact_afectado"];
 $anular_iva=$_REQUEST["anular_iva"];



include("../../../conexiones/config_pro.php");	


 $sql="select * from ventas_encabezado where tipo_fact = '$tipo_fact_afectado' ORDER BY nro_factura desc";
$result = $db->Execute($sql);

 $nro_factura_nc=($result->fields["nro_factura"] + 1);







 $sql = "SELECT * FROM `ventas_encabezado`  WHERE  `nro_factura` = '$nro_factura_afectada' and tipo_fact = '$tipo_fact_afectado'";


$result = $db->Execute($sql);

$nro_fac=strtoupper($result->fields["nro_factura"]);

/*if ($nro_fac == ""){

$leyenda = "NO EXISTE ESA FACTURA O NO COINCIDE TIPO DE FACTURA";
include ("../../../alertas/campo_informacion2.php");
exit;
}
*/

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



$todo = $denominacion." (".$nro_cliente.")";
$band = "cliente";
}
elseif ($matricula!=""){ 
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


$todo="Lab. ".$nombre_laboratorio." (".$cuenta.")";
$band = "cuenta";
}







//////////

if ($guarda_temp == "SI"){

include("../../../conexiones/config_pro.php");

$sql = "INSERT INTO `notacredito_encab_temp` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `neto_gravado` , `iva` , `retencion` , `neto` , `forma_pago` , `porc_dto`) VALUES ( '$tipo_fact_afectado'  , '$nro_factura_nc' , '$cod_operacion' , '$tipo_iva' , '$nro_cliente' , '$nro_cuenta' , '$plan' , '$operador' , '$denominacion' , '$fecha_original' , '$bruto' , '$descuento' , '$neto_gravado' , '$total_iva' , '$retencion'  , '$total_fact' , '$forma_pago' , '$porc_dto' )";
//mysql_query($sql);

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
$precio_unitario=strtoupper($result3->fields["precio_unitario"]);
$total=strtoupper($result3->fields["total"]);



$sql = "INSERT INTO `notacredito_deta_temp` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact`)  VALUES ('$nro_factura_nc' , '$cod_detalle' ,'$cod_mercaderia' , '$descripcion', '$presentacion' , '$lote' , '$mes_lote' , '$anio_lote' , '$cantidad' , '$precio_unitario' , '$total' , '$tipo_fact')";
//mysql_query($sql);

	 $result3->MoveNext();
				}

}



?>


<body onload = "on_load ()">
<FORM name="form" ACTION="factura_papel.php" METHOD = "POST">

<table width="99%" border="0">
          <!--DWLayoutTable-->
          <tr bgcolor="#000099">
            <td width="239" height="33" bordercolor="#000000" class="Estilo67"><div align="center"><span class="Estilo26"><span class="Estilo70"><span class="Estilo4 Estilo6  Estilo16 Estilo70"><span class="Estilo4 Estilo16  Estilo6"><span class="Estilo71"><span class="Estilo72">&nbsp;              &nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo72"><span class="Estilo26"><span class="Estilo79">
              <input name="actua" type="submit" id ="button"  value="Actualizar Stock">
            </span></span> </span><span class="Estilo72"><span class="Estilo26">&nbsp;&nbsp;</span><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26">  </span></span></span></span></span></div></td>
            <td height="33" colspan="2" bordercolor="#000000" class="Estilo67"><div align="center"><span class="Estilo72">NOTA DE CREDITO N&ordm;:</span> <span class="Estilo72"><?echo $tipo_fact_afectado;?> - <?echo $nro_factura_nc;?> &nbsp;&nbsp;&nbsp;</span><span class="Estilo26">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo26"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo72">&nbsp;&nbsp;</span><span class="Estilo72"><span class="Estilo26">&nbsp;</span></span></div></td>
            <td colspan="3" valign="middle" bordercolor="#000000" class="Estilo67"><div align="center"></div>              
              <div align="right"><span class="Estilo72">FECHA: <?echo $fecha_hoy;?> - Operador: <?echo $operador;?> <span class="Estilo26">&nbsp;<span class="Estilo79">
              </span></span></span></div></td>
          </tr>
          <tr bgcolor="#E6E6E6">
            <td height="28" colspan="5" valign="middle" bordercolor="#000000" class="Estilo67"><div align="right" class="Estilo18 Estilo79">
              <div align="left"><span class="Estilo14 Estilo41 Estilo27 Estilo79"><strong>CLIENTE: <?print("$denominacion");?></strong></span> </div>
            </div>              <div align="center"></div></td>
            <td width="153" valign="top" bordercolor="#000000" class="Estilo67"><div align="center" class="Estilo79">
              <div align="right"></div>
            </div></td>
          </tr>
          <tr bgcolor="#E6E6E6">
            <td height="28" valign="middle" bordercolor="#000000" class="Estilo67"><span class="Estilo14 Estilo41 Estilo27 Estilo79"><strong> </strong>FORMA DE PAGO: <?echo $forma_pago;?></span></td>
            <td height="28" colspan="4" valign="middle" bordercolor="#000000" class="Estilo67"><div align="center" class="Estilo79">Factura Afectada Nº: <?echo $nro_factura_afectada;?> - Fecha Emisi&oacute;n: <?echo $fecha_original;?></div></td>
            <td height="28" valign="middle" bordercolor="#000000" class="Estilo67"><div align="center" class="Estilo79">Total $ <?echo number_format($total_fact,2);?></div></td>
          </tr>
          <tr bgcolor="#E6E6E6">
            <td height="28" valign="middle" bordercolor="#000000" class="Estilo67"><div align="right" class="Estilo17 Estilo79"><span class="Estilo18">En caso de no coincidir Cambiar por: </span></div></td>
            <td colspan="5" valign="middle" bordercolor="#000000" class="Estilo67"><span class="Estilo14 Estilo17">
              <input name="fact_nuevo" type="text" size="1" id ="fact" onKeyPress="return verif_caracter(this,event)">
              <input name="nro_factura_nuevo" type="text" size="4" id ="nro_factura_nuevo" onKeyPress="return verif_caracter(this,event)">
              <input name="nro_factura_nc" type="hidden" value ="<?echo $nro_factura_nc;?>">
              <input name="nro_factura_afectada" type="hidden" value ="<?echo $nro_factura_afectada;?>">
              <input name="nro_factura" type="hidden" value ="<?echo $nro_factura_nc;?>">
              <input name="tipo_fact_afectado" type="hidden" value ="<?echo $tipo_fact_afectado;?>">
                        </span></td>
          </tr>
          <tr bgcolor="#E6E6E6">
            <td height="38" valign="middle" bordercolor="#000000" class="Estilo67"><div align="right" class="Estilo17 Estilo79"><span class="Estilo18"> Ingrese Leyenda rengl&oacute;n 1 </span></div></td>
            <td colspan="5" valign="middle" bordercolor="#000000" class="Estilo67"><span class="Estilo14 Estilo17">
              <input name="leyenda1" type="text" id="leyenda12" size="30" maxlength="30"  value = "<?echo $leyenda;?>"onKeyPress="return verif_caracter(this,event)">
              <input type="image" name="imprimir" src="../../../imagenes/botones/btn_imprimir.gif" value = "imprimir" id = "ok">
                        </span></td>
          </tr>
          <tr bgcolor="#C4D7E6">
            <td height="26" colspan="6" bgcolor="#E8DCFC"><span class="Estilo81">RENGL&Oacute;N 1: 		
	
	<input name="renglon1" type="text"  id="renglon1" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['renglon1']))   echo $_REQUEST['renglon1'];?>" size = "30" maxlength="30">


              Importe $
                  <input name="importe1" type="text"  id="importe1" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['importe1']))   echo $_REQUEST['importe1'];?>" size = "10" maxlength="10">
            </span>              <div align="center"></div></td>
          </tr>
          <tr bgcolor="#C4D7E6">
            <td height="26" colspan="6" bgcolor="#E8DCFC"><span class="Estilo81">RENGL&Oacute;N 2: 
                <input name="renglon2" type="text"  id="renglon2" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['renglon2']))   echo $_REQUEST['renglon2'];?>" size = "30" maxlength="30">
Importe $
                  <input name="importe2" type="text"  id="importe2" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['importe2']))   echo $_REQUEST['importe2'];?>" size = "10" maxlength="10">
            </span></td>
          </tr>
          <tr bgcolor="#C4D7E6">
            <td height="26" colspan="6" bgcolor="#E8DCFC"><span class="Estilo81">RENGL&Oacute;N 3: 
                <input name="renglon3" type="text"  id="renglon3" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['renglon3']))   echo $_REQUEST['renglon3'];?>" size = "30" maxlength="30">
Importe $
                  <input name="importe3" type="text"  id="importe3" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['importe3']))   echo $_REQUEST['importe3'];?>" size = "10" maxlength="10">
</span></td>
          </tr>
          <tr bgcolor="#C4D7E6">
            <td height="26" colspan="6" bgcolor="#E8DCFC"><span class="Estilo81">RENGL&Oacute;N 4: 
                <input name="renglon4" type="text"  id="renglon4" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['renglon4']))   echo $_REQUEST['renglon4'];?>" size = "30" maxlength="30">
Importe $
                  <input name="importe4" type="text"  id="importe4" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['importe4']))   echo $_REQUEST['importe4'];?>" size = "10" maxlength="10">
                  <span class="Estilo59">
                <!--   <input name="Alta" type="submit" value= "Calcular" id = "Alta"> -->
                  <input name="anio_lote1" type="hidden" value ="<?echo $anio_lote1;?>">
                  <input name="nro_factura_nc" type="hidden" value ="<?echo $nro_factura_nc;?>">
                  <input name="nro_factura_afectada" type="hidden" value ="<?echo $nro_factura_afectada;?>">
				  <input name="anular_iva" type="hidden" value ="<?echo $anular_iva;?>">
                  <input name="nro_factura" type="hidden" value ="<?echo $nro_factura;?>">
                  <input name="tipo_fact_afectado" type="hidden" value ="<?echo $tipo_fact_afectado;?>">
                  <input name="mes_lote1" type="hidden" value ="<?echo $mes_lote1;?>">
                  <input name="lote1" type="hidden" value ="<?echo $lote1;?>">
                  <input name="cod_detalle1" type="hidden" value ="<?echo $cod_detalle1;?>">
                  <input name="operador" type="hidden" value ="<?echo $operador;?>">
                  <input name="porc_dto" type="hidden" value ="<?echo $porc_dto;?>">
                  <input name="guarda_temp" type="hidden" value ="NO">
                  <input name="pasada" type="hidden" value ="1">
</span></span></td>
            <?


		if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{
		case "OK":
				{

	 
$tipo_fact_afectado = $_REQUEST['tipo_fact_afectado'];
 $nro_factura_afectada = $_REQUEST['nro_factura_afectada'];
$nro_factura_nc= $_REQUEST['nro_factura_nc'];
$anular_iva= $_REQUEST['anular_iva'];

//$nro_factura = $_REQUEST['nro_factura'];

 include ("refrescar.php");

			break;
				}


case "Calcular":
				{

	 
$tipo_fact_afectado = $_REQUEST['tipo_fact_afectado'];
$nro_factura_afectada = $_REQUEST['nro_factura_afectada'];
$nro_factura_nc= $_REQUEST['nro_factura_nc'];
$anular_iva= $_REQUEST['anular_iva'];


$renglon1= $_REQUEST['renglon1'];
$renglon2= $_REQUEST['renglon2'];
$renglon3= $_REQUEST['renglon3'];
$renglon4= $_REQUEST['renglon4'];

$importe1= $_REQUEST['importe1'];
$importe2= $_REQUEST['importe2'];
$importe3= $_REQUEST['importe3'];
$importe4= $_REQUEST['importe4'];

$total_debito = $importe1 + $importe2 + $importe3 + $importe4;



if ($anular_iva == "NO"){
$neto_gravado = round(($total_debito  / 1.21),2);
$iva_debito = $total_debito - $neto_gravado;
}


if (($total_debito == 0) or ($total_debito == "")){
$leyenda = "NO INGRESO NINGUN IMPORTE";
INCLUDE ("../../../alertas/campo_informacion.php");
EXIT;

}
?>
</tr>


<?IF ($tipo_fact_afectado == "A"){?>
          <tr bgcolor="#000099">
            <td height="26" colspan="2" valign="top"><div align="center"><span class="Estilo16 Estilo70"><strong>Neto Gravado: <strong><span class="Estilo14 Estilo41 Estilo27"><?echo $neto_gravado;?></span></strong></strong> <strong></strong></span></div></td>
            <td colspan="3" valign="top"><div align="center"><span class="Estilo16 Estilo70"><strong>IVA: <strong><strong><span class="Estilo14 Estilo41 Estilo27"><?echo $iva_debito;?><strong> </strong></span></strong></strong></strong></span></div></td>
            <td><div align="center"><span class="Estilo16 Estilo70"><strong><strong><strong><span class="Estilo14 Estilo41 Estilo27"><strong>TOTAL: <strong><?echo $total_debito;?></strong></strong></span></strong></strong></strong></span></div></td>
          </tr>
          <tr>
            <td height="3"></td>
            <td width="32"></td>
            <td width="436"></td>
            <td width="0"></td>
            <td width="77"></td>
            <td></td>
          </tr>
<?}else{?>
       <tr bgcolor="#000099">
            <td height="26" colspan="6"><div align="center" class="Estilo16 Estilo70"><strong>TOTAL  $ <span class="Estilo14 Estilo41 Estilo27"><?echo $total_debito;?></span></strong></div></td>
          </tr>


<?}
					


			break;
				}

case "Calcular":
				{


include ("control_nro_factura.php");

				}

	}
		}

 
 ?>
   </table>
</form>

