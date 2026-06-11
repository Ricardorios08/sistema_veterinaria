
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
    <td width="33%" height="27"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><font color="#FFFFFF"><strong>PROVEEDURIA</strong></font> </font> </div></td>
    <td width="40%" height="27"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><font color="#FFFFFF">CARGA DE EXISTENCIA</font></font></div></td>
    <td width="27%" height="27" colspan="2"><div align="right"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><?echo $fecha1;?></font></div></td>
  </tr>
  <tr bgcolor="#E8DCFC">
    <td colspan="4"><div align="left"></div>      
      <div align="left"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Mercaderia: <strong><font color="#006600">
        <input type = "text" name = "cod_mercaderia" id="cod_mercaderia" size = "6" onKeyPress="return verif_caracter(this,event)">
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
        <input name="bande" type="hidden" value ="SI">
        <input name="Alta" type="submit" value="OK" id ="Alta" size = "10" >
        <input name="Alta" type="submit" value= "BUSCAR" id = "Alta6">
      </font></strong></font></div></td>
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


 include("../../../../conexiones/config_pro.php");

 $sql3 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result3 = $db->Execute($sql3);
$descripcion=strtoupper($result3->fields["descripcion"]);


$sql2 = "SELECT * FROM `existencias_nuevo` where cod_mercaderia = $cod_mercaderia and mes_lote = $mes_lote and anio_lote = $anio_lote and lote = $lote";
$result2 = $db->Execute($sql2);
$cod_merca=strtoupper($result2->fields["cod_mercaderia"]);


if ($cod_merca == ""){

$sql = "INSERT INTO `existencias_nuevo` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `lote` ,  `mes_lote` , `anio_lote` , `cantidad_ingresada` , `precio_unitario` , `cantidad_salida` , `fecha_ultimo_mov` )  VALUES ('1' , '' ,'$cod_mercaderia' , '$lote' , '$mes_lote' , '$anio_lote', '$cantidad' , '' , '' , '$fecha_ultimo_mov')";
mysql_query($sql);


}
else{
 $sql = "UPDATE `existencias_nuevo` SET `cantidad_ingresada` = '$cantidad',  `fecha_ultimo_mov` = '$fecha_ultimo_mov' WHERE cod_mercaderia = '$cod_mercaderia' and lote = '$lote' and mes_lote = '$mes_lote' and anio_lote= '$anio_lote'";
mysql_query($sql);
}

$leyenda = "MERCADERIA INGRESADA EN EXISTENCIA ".$descripcion;
include ("../../../../alertas/campo_informacion.php");
 break;	}

			case "BUSCAR":
				{
$band = "SI";
include ("buscar_existencia.php");

 break;	}

 
 
 case "OK":
				{


$band = "SI";
$bande= $_REQUEST['bande'];

$cod_mercaderia= $_REQUEST['cod_mercaderia'];
$mes_lote= $_REQUEST['mes_lote'];
$anio_lote= $_REQUEST['anio_lote'];
$cantidad= $_REQUEST['cantidad'];



$nro_factura= $_REQUEST['nro_factura'];
$porcentaje_boni= $_REQUEST['porcentaje_boni'];
 $porcentaje_dto= $_REQUEST['porcentaje_dto'];

 $periodo= $_REQUEST['periodo'];
$anio= $_REQUEST['anio1'];
 $operador= $_REQUEST['operador'];
 include("../../../../conexiones/config_pro.php");
 $sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);

if ($bande=="SI"){
	if ($cod_mercaderia!=""){
include_once ("pagina3.php");
	}
}

 break;	}




					}
}
?>
