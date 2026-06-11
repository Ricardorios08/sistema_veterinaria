<?global $band;

?>
<script>
function on_load()
{
document.getElementById("cod_mercaderia").focus();
}

function enter()
{
document.getElementById("cod_mercaderia").focus();
}


function verif_caracter(obj,evt)

{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	
	{
		switch(obj.id)
		{
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
				document.getElementById("cantidad").focus();
				break;

				case "cantidad":
				document.getElementById("OK").focus();
				break;

				
				
		}
		return false;
	}
	return true;
}


function abrirVentan() {
	var cod_detalle = <?echo $cod_detalle;?> 
    open("buscador_rapido_mercaderia.php","miVentana", "width=300,height=600,toolbar=no,directories=no,menubar=no,status=no, scrollbars=01, top = 35");
}

</script>
<?if ($band != "SI"){
$nro_proveedor = $_REQUEST['nro_proveedor'];

include ("../../../conexiones/config_pro.php");
$sql="select * from proveedores where cuenta = $nro_proveedor";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);

if ($denominacion == ""){
	$leyenda = "NO EXISTE PROVEEDOR CON ESE NUMERO";
	INCLUDE ("../../../alertas/campo_vacio.php");
	exit;
}



$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio= $_REQUEST['anio'];
$fecha = $anio."-".$mes."-".$dia;

$operador= $_REQUEST['operador'];

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



$nro_factura= $_REQUEST['nro_factura'];
$porcentaje_boni= $_REQUEST['porcentaje_boni'];
$porcentaje_dto= $_REQUEST['porcentaje_dto'];



if ($nro_proveedor == ""){
	$leyenda = "NO PUEDE DEJAR EL CAMPO NRO DE PROVEEDOR EN BLANCO";
	INCLUDE ("../../../alertas/campo_vacio.php");
	exit;
}

if ($nro_factura == ""){
	$leyenda = "NO PUEDE DEJAR EL CAMPO NRO DE COMPROBANTE EN BLANCO";
	INCLUDE ("../../../alertas/campo_vacio.php");
	exit;
}

//include ("../comprobar_fechas.php");

$periodo = date("m"); 
$anio1 = date("y"); 

$sql = "INSERT INTO `compras1_encab_temp` ( `nro_factura` , `cod_operacion` , `nro_proveedor` , `denominacion` , `fecha` , `descuento` , `bonificacion` , `periodo` , `anio` , `operador` ) VALUES ( '$nro_factura' , '$cod_operacion' , '$nro_proveedor' , '$denominacion', '$fecha' , '$porcentaje_dto' , '$porcentaje_boni' , '$periodo' , '$anio1' , '$nombre_operador' )";
mysql_query($sql);

}




?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body onload = "on_load ()">
<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">


<table width="99%" border="0">
  <tr bgcolor="#000099">
    <td height="27" colspan="6"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"> COMPRAS</font> </div></td>
    <td height="27" colspan="2"><div align="right"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><font size="2">Operador:</font> <font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><?echo $nombre_operador;?></font></font></div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="5"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"> Proveedor: </font>        <font color="#FF0000" size="3"></font></div>      <div align="center"></div>      <div align="center"><font color="#000000" size="2"> </font>
      </div></td>
    <td><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha/Compra: </font></div></td>
    <td><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Comprobante </font></div></td>
    <td><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Descuento</font></div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="5"><div align="center">   <?echo $nro_proveedor;?> - <?echo $denominacion;?></div>      <div align="center"><font color="#000000" size="2">
    </font></div>      <div align="center">
      </div></td>
    <td><div align="center"><font color="#000000" size="2"><?echo $fecha;?></font></div></td>
    <td><div align="center"><?echo $nro_factura;?></div></td>
    <td><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">% <?echo $porcentaje_dto;?></font><font color="#000000" size="2"> </font></div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="8"><div align="left">
      <hr noshade>
    </div></td>
  </tr>
  <tr bgcolor="#E8DCFC">
    <td width="15%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Mercanderia</font></div></td>
    <td width="12%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Lote</font></div></td>
    <td colspan="2"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Mes - A&ntilde;o </font></div></td>
    <td width="17%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Precio Unitario</font></div></td>
    <td width="14%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cantidad</font></div></td>
    <td width="17%"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">% Bonificaci&oacute;n</font> </div></td>
    <td width="13%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Agregar</font></div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td height="45"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#006600">
        <input type = "text" name = "cod_mercaderia" id="cod_mercaderia" size = "6" onKeyPress="return verif_caracter(this,event)">
        <!-- <a href="javascript:abrirVentan()"><img src="../../../imagenes/office/005.ico" alt="Buscar" border = "0"></a> --> </font></strong></font></div></td>
    <td><div align="center"><font color="#000000" size="2">
        <input type = "text" name = "lote" id="lote" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
    </font></div></td>
    <td width="4%"><div align="center"><font color="#000000" size="2">
        <input type = "text" name = "mes_lote" id="mes_lote" size = "2" onKeyPress="return verif_caracter(this,event)" >
    </font></div></td>
    <td width="8%"><div align="center"><font color="#000000" size="2">
        20
        <input name = "anio_lote" type = "text" id="anio_lote" onKeyPress="return verif_caracter(this,event)" size = "2" maxlength="2" >
    </font></div></td>
    <td><div align="center"><font color="#000000" size="2">
        <input type = "text" name = "precio_unitario" id="precio_unitario" size = "5" onKeyPress="return verif_caracter(this,event)" >



    </font></div></td>
    <td><div align="center">
      <input type = "text" name = "cantidad" id="cantidad"  tabindex = "2" size = "5" onKeyPress="return verif_caracter(this,event)">
    </div></td>
    <td><div align="center">


<? if ($porcentaje_boni == "SI"){?>
      <input type = "text" name = "bonificacion" id="bonificacion"  tabindex = "2" size = "5" >
<?}else{?>
     <input type = "text" name = "bonificacion" id="bonificacion"  tabindex = "2" size = "5" disabled = "true">

<?}?>



    </div></td>
    <td><div align="center">

              <input name="nro_proveedor" type="hidden" value ="<?echo $nro_proveedor;?>">

              <input name="dia" type="hidden" value ="<?echo $dia;?>">
              <input name="mes" type="hidden" value ="<?echo $mes;?>">
              <input name="anio" type="hidden" value ="<?echo $anio;?>">

              <input name="denominacion" type="hidden" value ="<?echo $denominacion;?>">
              <input name="nro_factura" type="hidden" value ="<?echo $nro_factura;?>">
              <input name="porcentaje_dto" type="hidden" value ="<?echo $porcentaje_dto;?>">
			  <input name="porcentaje_boni" type="hidden" value ="<?echo $porcentaje_boni;?>">

  			  <input name="periodo" type="hidden" value ="<?echo $periodo;?>">
  			  <input name="anio1" type="hidden" value ="<?echo $anio1;?>">
			  <input name="operador" type="hidden" value ="<?echo $operador;?>">
			

      <input name="Alta" type="submit" value="OK" id ="Alta" size = "10" >
	    <input name="Alta" type="submit" value= "BUSCAR" id = "Alta">
    </div></td>
  </tr>
</table>


<?
if(isset($_REQUEST['Alta'])) {

	switch ($_REQUEST['Alta'])
					{
						
			case "OK1":
				{
 $band = "SI";
$nro_proveedor = $_REQUEST['nro_proveedor'];

$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio= $_REQUEST['anio'];
$fecha = $anio."-".$mes."-".$dia;

$nro_factura= $_REQUEST['nro_factura'];
$porcentaje_boni= $_REQUEST['porcentaje_boni'];
 $porcentaje_dto= $_REQUEST['porcentaje_dto'];

 $periodo= $_REQUEST['periodo'];
$anio= $_REQUEST['anio1'];
 $operador= $_REQUEST['operador'];

 include ("refrescar.php");

 break;	}

			case "BUSCAR":
				{
 $band = "SI";
include ("refrescar1.php");

 break;	}

 case "OK":
				{
$band = "SI";
$nro_proveedor = $_REQUEST['nro_proveedor'];
echo "dsf".$cod_mercaderia= $_REQUEST['cod_mercaderia'];

$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio= $_REQUEST['anio'];
$fecha = $anio."-".$mes."-".$dia;

$nro_factura= $_REQUEST['nro_factura'];
$porcentaje_boni= $_REQUEST['porcentaje_boni'];
 $porcentaje_dto= $_REQUEST['porcentaje_dto'];

 $periodo= $_REQUEST['periodo'];
$anio= $_REQUEST['anio1'];
 $operador= $_REQUEST['operador'];
 
 $sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);
$precio_actualizado=strtoupper($result2->fields["precio_actualizado"]);
include_once ("pagina3.php"); 


 break;	}




					}
}
?>