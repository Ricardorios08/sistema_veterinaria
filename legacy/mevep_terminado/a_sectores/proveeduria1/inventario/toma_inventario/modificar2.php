
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
	var cod_detalle = <?echo $cod_detalle;?> 
    open("buscador_rapido_mercaderia.php","miVentana", "width=300,height=600,toolbar=no,directories=no,menubar=no,status=no, scrollbars=01, top = 35");
}

</script>
<?

$fecha = date("Y-m-d");
$fecha1 =date("d-m-Y");
$periodo = date("m"); 
$anio1 = date("y"); 

$cod_mercaderia = $_REQUEST['cod_mercaderia'];
$lote= $_REQUEST['lote'];
$mes_lote= $_REQUEST['mes_lote'];
$anio_lote= $_REQUEST['anio_lote'];
$cantidad_ingresada= $_REQUEST['cantidad_ingresada'];


 include("../../../../conexiones/config_pro.php");
 $sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = '$cod_mercaderia'";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body onload = "on_load ()">
<FORM name="form" ACTION="guardar_modificacion.php" METHOD = "POST">


<table width="650" border="0">
  <tr bgcolor="#666666">
    <td width="33%" height="27"><div align="center"><strong><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">CONLOGO </font> </strong></div></td>
    <td width="40%" height="27"><div align="center"><strong><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><font color="#FFFFFF">CARGA DE EXISTENCIA</font></font></strong></div></td>
    <td width="27%" height="27" colspan="2"><div align="right"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><?echo $fecha1;?></font></strong></div></td>
  </tr>
</table>
 <table width="650" border="0">
  <tr bgcolor="#A0A7F5">
    <td width="9%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"> Nº</font></div></td>
    <td width="38%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Descripcion</font></div></td>
    <td width="7%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cantidad</font></div></td>
    <td width="7%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Agregar</font></div></td>
  </tr>
  <tr bgcolor="#9FE1BB">
    <td height="26"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#006600">
        <input type = "text" name = "cod_mercaderia1" id="cod_mercaderia" size = "6"  value="<?echo $cod_mercaderia;?>" onKeyPress="return verif_caracter(this,event)">
    <!-- <a href="javascript:abrirVentan()"><img src="../../../imagenes/office/005.ico" alt="Buscar" border = "0"></a> --> </font></strong></font></div></td>
    <td><font color="#000000" size="2"><?echo $descripcion;?> - <?echo $presentacion;?>
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
</font></td>
    <td><div align="center">
      <input name = "cantidad" type = "text" id="cantidad"  tabindex = "2" onKeyPress="return verif_caracter(this,event)" value="<?echo $cantidad_ingresada;?>" size = "2">
    </div></td>
    <td><div align="center">

      <input name="Alta" type="submit" value="SI" id ="SI" size = "10" >
    </div></td>
  </tr>
</table>


<?
if(isset($_REQUEST['Alta'])) {

	switch ($_REQUEST['Alta'])
					{
						
			case "SI":
				{

				
$band = "SI";

$mes_lote= $_REQUEST['mes_lote'];
$anio_lote= $_REQUEST['anio_lote'];
$lote= $_REQUEST['lote'];
$cantidad= $_REQUEST['cantidad'];
$cod_mercaderia= $_REQUEST['cod_mercaderia1'];

$dia = 01;
$mes = 09;
$anio= date("Y");
$fecha_ultimo_mov =$anio.$mes.$dia;

$sql = "UPDATE `existencias_nuevo` SET `cantidad_ingresada` = '$cantidad',  `fecha_ultimo_mov` = '$fecha_ultimo_mov' WHERE cod_mercaderia = '$cod_mercaderia'";
mysql_query($sql);


$leyenda = "MERCADERIA MODIFICADA EN EXISTENCIA ".$descripcion;
include ("../../../../alertas/campo_informacion.php");

$cod_mercaderia = "";
$bandera = 1;
//include ("../separar_busqueda.php");
exit;
 break;	}

			


					}
}


?>
