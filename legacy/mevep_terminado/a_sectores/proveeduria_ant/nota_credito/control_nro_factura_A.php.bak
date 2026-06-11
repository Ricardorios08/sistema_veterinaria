 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<script language="javascript">
function on_load()
{
document.getElementById("fact").focus();
document.getElementById("fact").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{


				case "fact":
				document.getElementById("nro_factura_nuevo").focus();

document.getElementById("fact").style.backgroundColor = "#FFFFFF";
document.getElementById("nro_factura_nuevo").style.backgroundColor = "#CCFFCC";
				break;
				
				case "nro_factura_nuevo":
				document.getElementById("leyenda1").focus();

document.getElementById("nro_factura_nuevo").style.backgroundColor = "#FFFFFF";
document.getElementById("leyenda1").style.backgroundColor = "#CCFFCC";
				break;
				
				
				case "leyenda1":
				document.getElementById("ok").focus();
document.getElementById("leyenda1").style.backgroundColor = "#FFFFFF";
document.getElementById("ok").style.backgroundColor = "#CCFFCC";


				break;
								
		}
		return false;
	}
	return true;
}


</script>

<style type="text/css">
<!--
.Estilo4 {font-family: Arial, Helvetica, sans-serif}
.Estilo14 {color: #000000}
.Estilo15 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo16 {font-size: 12px}
.Estilo17 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo18 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
.Estilo21 {color: #FFFFFF}
.Estilo23 {font-weight: bold; font-size: 12px; }
.Estilo24 {font-weight: bold; color: #000000; }
.Estilo26 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF;}
.Estilo27 {color: #000000; font-size: 12px;}
.Estilo28 {font-size: 14px}
-->
 </style>
<body onload = "on_load ()">
<?
$nro_factura= $_REQUEST['nro_factura'];
$fact =$_REQUEST['fact'];
$tipo_fact =$_REQUEST['tipo_fact'];
$cuit= $_REQUEST['cuit'];
$direccion= $_REQUEST['direccion'];


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
$forma_pago=strtoupper($result2->fields["forma_pago"]);
$porc_dto=strtoupper($result2->fields["porc_dto"]);





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

<!-- <?if ($fact == "A"){?>
<FORM name="form" ACTION="factura_papel_prueba.php" METHOD = "POST">
<?}else{?>
<FORM name="form" ACTION="factura_papel_prueba.php" METHOD = "POST">
<?}?> -->


<FORM name="form" ACTION="factura_papel_A.php" METHOD = "POST">


<table width="95%" border="0">
  <tr bgcolor="#E6E6E6">
    <td height="32" colspan="2" ><div align="center" class="Estilo15" >
      <div align="center" class="Estilo14">REVISAR  FACTURA E IMPRIMIR</div>
    </div></td>
    <td width="32%" > <input type="button" value="Corregir" onKeyPress="history.back()" onCLICK="history.back()" id ="boton" style="font-family: Verdana; font-size: 14 pt"></td>
  </tr>
  <tr bgcolor="#C1F2FF">
    <td bgcolor="#C9FADF"><div align="right" class="Estilo4 Estilo16"><span class="Estilo17  Estilo14">N&ordm; FACTURA EMITIDO POR SISTEMA: </span></div></td>
    <td colspan="2" bgcolor="#F2FACB"><span class="Estilo14 Estilo4"><?echo $fact;?> - <?echo $nro_factura;?> </span></td>
  </tr>
  <tr bgcolor="#C1F2FF">
    <td width="45%" bgcolor="#C9FADF"><div align="right" class="Estilo17"><span class="Estilo18">En caso de no coincidir Cambiar por:
      </span></div></td>
    <td colspan="2" bgcolor="#F2FACB"><span class="Estilo14 Estilo17">
      <input name="fact_nuevo" type="text" size="1" id ="fact" onKeyPress="return verif_caracter(this,event)">
      <input name="nro_factura_nuevo" type="text" size="4" id ="nro_factura_nuevo" onKeyPress="return verif_caracter(this,event)">
      <input name="nro_factura" type="hidden" value ="<?echo $nro_factura;?>">
      <input name="fact" type="hidden" value ="<?echo $fact;?>">
      <input name="tipo_fact" type="hidden" value ="<?echo $tipo_fact;?>">
      <input name="direccion" type="hidden" value ="<?echo $direccion;?>">
      <input name="cuit" type="hidden" value ="<?echo $cuit;?>">
	  <input name="nro" type="hidden" value ="<?echo $nro;?>">

    </span></td>
  </tr>
  <tr bgcolor="#C1F2FF">
    <td bgcolor="#C9FADF"><div align="right" class="Estilo17"><span class="Estilo18">
        Ingrese Leyenda rengl&oacute;n 1
              
  </span></div></td>
    <td colspan="2" bgcolor="#F2FACB"><span class="Estilo14 Estilo17">
      <input name="leyenda1" type="text" id="leyenda1" size="30" maxlength="30"  onKeyPress="return verif_caracter(this,event)">
      <input type="image" name="Submit" src="../../../imagenes/botones/btn_imprimir.gif" id = "ok">
    </span></td>
  </tr>
</table>


 <table width="95%" height="68" border="0">
      <!--DWLayoutTable-->
      <tr bgcolor="#C4D7E6">
        <td height="20" colspan="2"><div align="left" class="Estilo8  Estilo14"><span class="Estilo11 Estilo14  Estilo4"><span class="Estilo16">Sres:</span> <span class="Estilo21"><span class="Estilo18"><?echo $denominacion." (".$nro.")";?></span></span></span></div></td>
        <td width="54%" height="20"><div align="right" class="Estilo26"><span class="Estilo16"><span class="Estilo11 Estilo4 Estilo14"><span class="Estilo27">Fecha: <?echo $fecha;?></span></span></span></div></td>
      </tr>
      <tr bgcolor="#C4D7E6">
        <td height="20" colspan="2"><div align="left" class="Estilo8 Estilo4"><span class="Estilo16">Domicilio:</span><span class="Estilo21"> <span class="Estilo21"><span class="Estilo18"><?echo $direccion;?></span></span></span></div>          </td>
        <td height="20"><div align="right" class="Estilo8 Estilo4"><span class="Estilo16">Operador: <span class="Estilo16"><?echo $operador;?> Control: <?echo $fact?> - <?echo $nro_factura?></span></span></div></td>
      </tr>
      <tr bgcolor="#C4D7E6">
        <td width="34%" height="20"><div align="left" class="Estilo7 Estilo4  Estilo21"></div>          <div align="left" class="Estilo8 Estilo16"></div>          
        <span class="Estilo7 Estilo4 Estilo11  Estilo14 Estilo16">IVA</span><span class="Estilo7 Estilo19  Estilo4 Estilo16">:</span><span class="Estilo7 Estilo4 Estilo17 Estilo14 Estilo16"> <?print("$tipo_fact");?> - Cuit: <?echo $cuit;?> </span><span class="Estilo16"></span></span></span></td>
        <td colspan="2"><div align="right" class="Estilo8"><span class="Estilo26"><span class="Estilo11  Estilo14"><span class="Estilo17">COND.  VENTA: <?echo $forma_pago;?></span></span></span></div></td>
   </tr>
 </table>

<table width="95%" border="0">
        <tr bgcolor="#000099"><td width="4%" height="21" valign="middle"><div align="center" class="Estilo4 Estilo7 Estilo10 Estilo21 Estilo16"></div>
            <div align="right" class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16">
              <div align="center"><span class="Estilo4">Cant</span></div>
          </div>            </td>
        <td colspan="3" valign="middle"><div align="center" class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16">
          <div align="center">Detalle</div>
        </div></td>
        <td width="13%" valign="middle"><div align="center"><span class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16">Presentaci&oacute;n</span></div></td>
        <td width="8%" valign="middle"><div align="center"><span class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16"> Lote</span></div></td>

        <td width="9%" valign="middle"><div align="center"><span class="Estilo11 Estilo4 Estilo7 Estilo10 Estilo21 Estilo16"> Vto Lote</span></div></td>
        <td width="9%"><div align="center" class="Estilo11 Estilo21 Estilo16"><span class="Estilo4">Pr. Unit. </span></div></td>
        <td width="12%" height="21"><div align="center" class="Estilo11 Estilo21 Estilo16"><span class="Estilo4">Total</span></div></td>
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

$subtotal = $subtotal + $total;


$desc_fact = ($subtotal * $porc_dto)/100;

$neto_gravado = $subtotal - $desc_fact;


$iva = ($neto_gravado * 21) /100;
$total_factura = round($neto_gravado,2) + round($iva,2);



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
    <td height="20" scope="col"><div align="center" class="Estilo7 Estilo4 Estilo16"><span class="Estilo40 Estilo17  Estilo14"><?echo $cantidad;?></span></div></td>

    <td height="20" colspan="3" scope="col"><div align="center"  ">
        <div align="left" class="Estilo17" ><?echo $cod_mercaderia. " - ".$descripcion?></div>
    </div></td>
    <td height="20" scope="col"><div align="center"><span class="Estilo17"><?echo $presentacion;?></span></div></td>
    <td height="20" scope="col"><div align="center"><span class="Estilo17"><?echo $lote;?></span></div></td>
    <td scope="col"><div align="center"><span class="Estilo17"><?echo $mes_lote." - ".$anio_lote;?></span></div></td>
    <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17 Estilo7 Estilo4 Estilo16">
      <div align="right">$ <?echo $precio_unitario;?></div>
    </div></td>
    <td scope="col"><div align="right" class="Estilo40 Estilo14 Estilo17 Estilo7 Estilo4 Estilo16">
      <div align="right">$ <?echo $total;?></div>
    </div></td>
   
  </tr>

<?
	 $result->MoveNext();
		}
 
?>



<tr bgcolor="#E6E6E6">
  <td height="20" colspan="3" scope="col"><div align="right"><span class="Estilo4 Estilo28"></span></div>    <div align="right"></div>    
    <div align="center"><span class="Estilo4 Estilo28"></span><span class="Estilo4 Estilo28"><strong>SubTotal: $ <?echo number_format($subtotal,2);?></strong></span></div></td>
  <td width="22%" scope="col"><div align="center"><span class="Estilo4 Estilo28"><span class="Estilo4 Estilo13"><span class="Estilo23"><span class="Estilo24"><span class="Estilo28"><strong>Descuento $ <?echo number_format($desc_fact,2);?></strong></span></span></span></span></span></div></td>
  <td height="20" scope="col"><div align="right"><span class="Estilo4 Estilo13"><span class="Estilo23"><span class="Estilo24"><span class="Estilo28"><span class="Estilo4 Estilo28"><strong>Neto Grav. $ <?echo number_format($neto_gravado,2);?></strong></span></span></span></span></span></div></td>
  <td height="20" scope="col">&nbsp;</td>
  <td height="20" scope="col"><span class="Estilo4 Estilo13"><span class="Estilo23"><span class="Estilo24"><span class="Estilo28"><span class="Estilo14 Estilo39 Estilo38 Estilo28  Estilo4">IVA: $ <?echo number_format($iva,2);?></span></span></span></span></span></td>
  <td colspan="2" scope="col"><div align="right"><span class="Estilo4 Estilo13"><span class="Estilo23"><span class="Estilo24"><span class="Estilo28"></span></span></span></span></div>    <div align="right"><span class="Estilo14 Estilo39 Estilo38 Estilo28  Estilo4"><strong>TOTAL: $ <?echo number_format($total_factura,2);?>
   </strong></span></span></div></td>
  </tr>



 </table>


<?$total_factura = 0;
$neto = 0;
$iva = 0;
$sumatoria = $cont;
		$cont = 0;

//include ("espacios_en_blancos.php");
$sumatoria = 0;?>
</html>
</form>
</body>