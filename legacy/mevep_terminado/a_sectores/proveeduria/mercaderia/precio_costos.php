<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo3 {font-size: 12px}
.Estilo4 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
body {
	background-image: url(../../../imagenes/logito.png);
}
-->
</style>
</head>

<body>

<?php 

include ("../../../conexiones/config_grabacion.php");
$sql = "select * from precio_costos";
$result = $db_pro->Execute($sql);
$dolar=strtoupper($result->fields["dolar_compra"]);
$dolar1=strtoupper($result->fields["dolar_venta"]);

$costo=strtoupper($result->fields["costo"]);
$empresas=strtoupper($result->fields["empresas"]);
$regaleria=strtoupper($result->fields["regaleria"]);
$por_menor=strtoupper($result->fields["por_menor"]);



?>
<FORM ACTION="guardar_precio.php" METHOD = "POST" name="form" target = "central">

<table width="850" border="0">
  <tr bgcolor="#666666">
    <td height="36" colspan="2"><div align="center" class="Estilo1">PRECIOS Y COSTOS</div></td>
  </tr>
  <tr>
    <td width="321" bgcolor="#A0A7F5"><div align="right" class="Estilo2 Estilo3">DOLAR COMPRA</div></td>
    <td width="313" bgcolor="#9FE1BB"><input name="dolar" type="text" id="dolar" size="4" value = "<?php echo $dolar;?>"></td>
	  </tr>

  <tr>
    <td width="321" bgcolor="#A0A7F5"><div align="right" class="Estilo2 Estilo3">DOLAR VENTA</div></td>
    <td width="313" bgcolor="#9FE1BB"><input name="dolar1" type="text" id="dolar" size="4" value = "<?php echo $dolar1;?>"></td>
	  </tr>

  <tr>
    <td bgcolor="#A0A7F5"><div align="right" class="Estilo4">COSTO</div></td>
    <td bgcolor="#9FE1BB"><input name="costo" type="text" id="costo" size="4" value = "<?php echo $costo;?>" ></td>
  </tr>
  <tr>
    <td bgcolor="#A0A7F5"><div align="right" class="Estilo4">EMPRESA</div></td>
    <td bgcolor="#9FE1BB"><input name="empresas" type="text" size="4" value = "<?php echo $empresas;?>" ></td>
  </tr>
  <tr>
    <td bgcolor="#A0A7F5"><div align="right" class="Estilo4">REGALERIA</div></td>
    <td bgcolor="#9FE1BB"><input name="regaleria" type="text" id="regaleria" size="4" value = "<?php echo $regaleria;?>" ></td>
  </tr>
  <tr>
    <td bgcolor="#A0A7F5"><div align="right" class="Estilo4">POR MENOR </div></td>
    <td bgcolor="#9FE1BB"><input name="por_menor" type="text" id="por_menor" size="4" value = "<?php echo $por_menor;?>"></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td colspan="2"><div align="center">
      <input type="submit" name="Submit" value="CAMBIAR">
    </div></td>
  </tr>
</table>
</form>
</body>

</html>
