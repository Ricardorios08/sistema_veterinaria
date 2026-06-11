<?php global $band;

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
				document.getElementById("SI").focus();
				break;

				
				
		}
		return false;
	}
	return true;
}


function abrirVentan() {
	var cod_detalle = <?php echo $cod_detalle;?> 
    open("buscador_rapido_mercaderia.php","miVentana", "width=300,height=600,toolbar=no,directories=no,menubar=no,status=no, scrollbars=01, top = 35");
}

</script>

<?php 

$cod_merca= $_REQUEST['cod_merca'];
include ("../../../conexiones/config_pro.php");


$sql="select * from compras1_encab_temp";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);
$nro_proveedor=strtoupper($result->fields["nro_proveedor"]);
$fecha_compra=strtoupper($result->fields["fecha"]);

$dia= substr($fecha_compra,8,2);
$mes= substr($fecha_compra,5,2);
$anio= substr($fecha_compra,0,4);
$fecha = $anio."-".$mes."-".$dia;

$periodo1=strtoupper($result->fields["mes_lote"]);
$anio1=strtoupper($result->fields["anio_lote"]);

 $nombre_operador=strtoupper($result->fields["operador"]);
$nro_factura=strtoupper($result->fields["nro_factura"]);
$porcentaje_boni=strtoupper($result->fields["porcentaje_boni"]);
$porcentaje_dto=strtoupper($result->fields["porcentaje_dto"]);


Switch ($nombre_operador){
	case "":{
		$operador = "101";
		break;
	}

	case "":{
$operador = "201";
break;
	}
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


<table width="750" border="0">
  <tr bgcolor="#000099">
    <td width="56%" height="27" colspan="2"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"> COMPRAS</font> </div></td>
    <td width="30%" height="27" colspan="2"><div align="right"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><font size="2">Operador:</font> <font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><?php echo $nombre_operador;?></font></font></div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="4"><div align="left"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"> Proveedor: </font>        <font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"> <?php echo $denominacion;?> (<?php echo $nro_proveedor;?>) &nbsp;&nbsp;&nbsp;&nbsp;</font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">Fecha/Compra: </font><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?php echo $fecha1;?> &nbsp;&nbsp;&nbsp;&nbsp;</font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">N&ordm; Comprobante:</font> <font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?php echo $nro_factura;?> &nbsp;&nbsp;&nbsp;&nbsp;</font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">Descuento %:</font> <font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?php echo $porcentaje_dto;?></font></div></td>
  </tr>
  <tr bgcolor="#E8DCFC">
    <td colspan="4"><div align="left"></div>      
      <div align="left"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Mercaderia: <strong><font color="#006600">
        <input type = "text" name = "cod_mercaderia" id="cod_mercaderia" size = "6" VALUE ="<?php echo $cod_merca;?>" onKeyPress="return verif_caracter(this,event)">
        <input name="nro_proveedor" type="hidden" value ="<?php echo $nro_proveedor;?>">
        <input name="dia" type="hidden" value ="<?php echo $dia;?>">
        <input name="mes" type="hidden" value ="<?php echo $mes;?>">
        <input name="anio" type="hidden" value ="<?php echo $anio;?>">
        <input name="denominacion" type="hidden" value ="<?php echo $denominacion;?>">
        <input name="nro_factura" type="hidden" value ="<?php echo $nro_factura;?>">
        <input name="porcentaje_dto" type="hidden" value ="<?php echo $porcentaje_dto;?>">
        <input name="porcentaje_boni" type="hidden" value ="<?php echo $porcentaje_boni;?>">
        <input name="periodo" type="hidden" value ="<?php echo $periodo;?>">
        <input name="anio1" type="hidden" value ="<?php echo $anio1;?>">
        <input name="operador" type="hidden" value ="<?php echo $operador;?>">
        <input name="bande" type="hidden" value ="SI">
        <input name="Alta" type="submit" value="OK" id ="Alta" size = "10" >
        <input name="Alta" type="submit" value= "BUSCAR" id = "Alta6">
      </font></strong></font></div></td>
  </tr>
</table>


<?php 
if(isset($_REQUEST['Alta'])) {

	switch ($_REQUEST['Alta'])
					{
						
			case "SI":
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

$cod_mercaderia= $_REQUEST['cod_mercaderia1'];


 include ("refrescar.php");

 break;	}

			case "BUSCAR":
				{
 $band = "SI";
 $dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio= $_REQUEST['anio'];
$fecha = $anio."-".$mes."-".$dia;
$fecha1 = $dia."-".$mes."-".$anio;

include ("refrescar1.php");

 break;	}

 
 
 case "OK":
				{
$band = "SI";
$bande= $_REQUEST['bande'];
$nro_proveedor = $_REQUEST['nro_proveedor'];
$cod_mercaderia= $_REQUEST['cod_mercaderia'];

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
if ($bande=="SI"){
	if ($cod_mercaderia!=""){
include_once ("pagina3.php");
	}
}

 break;	}




					}
}
?>