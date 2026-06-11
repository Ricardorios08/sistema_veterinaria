<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../menus.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo3 {
	font-family: "Trebuchet MS";
	color: #FFFFFF;
}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo6 {
	color: #FFFFFF;
	font-size: 12px;
}
.Estilo13 {font-family: "Trebuchet MS"}
.Estilo15 {font-family: "Trebuchet MS"; font-size: 12px; }
.Estilo16 {color: #FFFFFF}
-->
</style>
</head>

<body>

<?php 
include ("../../conexiones/config.inc.php");
 $sql="select ruta from socios where no_imprimir = 'FALSO' order by ruta desc";
$result = $db->Execute($sql);

$ruta=$result->fields["ruta"];


$fecha = date("d/m/Y");

$mes = date("m");

switch ($mes){

case "01":{$mes = "ENERO";break;}
case "02":{$mes = "FEBRERO";break;}
case "03":{$mes = "MARZO";break;}
case "04":{$mes = "ABRIL";break;}
case "05":{$mes = "MAYO";break;}
case "06":{$mes = "JUNIO";break;}
case "07":{$mes = "JULIO";break;}
case "08":{$mes = "AGOSTO";break;}
case "09":{$mes = "SEPTIEMBRE";break;}
case "10":{$mes = "OCTUBRE";break;}
case "11":{$mes = "NOVIEMBRE";break;}
case "12":{$mes = "DICIEMBRE";break;}

}

?>
<table width="152"  border="0">
  <tr bgcolor="#990033"> </tr>
  <tr>
    <td bgcolor="#666666"><div align="center" class="Estilo3">INFO + </div></td>
  </tr>
</table>
<div id="menuv">
		<ul>
			<ul>
			<li><a href="consultas/stock/consultas.php" target = "central" >  FICHA STOCK</a></li>
			<li><a href="consultas/informes/consultas.php?opciones=Existencias" target = "central" > EXISTENCIAS</a></li>
			<li><a href="consultas/CTACTE/consultas.php" target = "central" > MAYOR CTA-CTE </a></li>
			<li><a href="consultas/ana_saldos/consultas.php" target = "central" > AN&Aacute;LISIS.DE SALDOS</a></li>			
			
			<li><a href="consultas/diario_vta/consultas.php?cheque=1" target = "central" > DIARIO DE VENTAS </a></li>
<li><a href="consultas/informes/consultas.php?opciones=Lista de Precios" target = "central" > LISTA DE PRECIOS</a></li>
<li><a href="consultas/stock/tabla.php" target = "central" >TABLA AJUSTES</a></li>
<li><a href="libro_iva/libro_iva.php" target = "izquierda" >LIBRO IVA</a></li>
		  </ul>
		</ul>
</div>
  
</body>
</html>
