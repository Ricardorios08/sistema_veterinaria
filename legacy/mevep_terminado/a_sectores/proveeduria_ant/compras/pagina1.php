<script>
function on_load()
{
document.getElementById("operador").focus();
}

function enter()
{
document.getElementById("nro_proveedor").focus();
}


function verif_caracter(obj,evt)

{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	
	{
		switch(obj.id)
		{
				case "operador":
				document.getElementById("nro_proveedor").focus();
				break;
				case "nro_proveedor":
				document.getElementById("dia").focus();
				break;
				case "dia":
				document.getElementById("mes").focus();
				break;
				
				
				case "mes":
				document.getElementById("anio").focus();
				break;
				case "anio":
				document.getElementById("nro_factura").focus();
				break;
						
				
				case "nro_factura":
				document.getElementById("porcentaje_boni1").focus();
				break;

				case "porcentaje_boni1":
				document.getElementById("porcentaje_boni").focus();
				break;

				case "porcentaje_boni":
				document.getElementById("porcentaje_dto").focus();
				break;

				case "cod_mercaderia":
				document.getElementById("porcentaje_dto").focus();
				break;
						

				
				
		}
		return false;
	}
	return true;
}


function abrirVentan() {
	var cod_detalle = <?php echo $cod_detalle;?> 
    open("buscador_rapido.php","miVentana", "width=300,height=600,toolbar=no,directories=no,menubar=no,status=no, scrollbars=01, top = 35");
}


</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<?php include("../../../conexiones/config_pro.php");

$sql = "TRUNCATE TABLE compras1_encab_temp";
$result = $db->Execute($sql);
$sql = "TRUNCATE TABLE compras1_deta_temp";
$result = $db->Execute($sql);


$sql = "SELECT * FROM factura_temp";
$result = $db->Execute($sql);

$nro_factura=strtoupper($result->fields["nro_factura"]);

if ($nro_factura == ""){
?>
<body onload = "on_load ()">
<FORM ACTION="pagina2.php" METHOD = "POST" enctype="multipart/form-data" name="form">
<table width="850" border="0">
  <tr bgcolor="#000099">
    <td height="32" colspan="3"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">INGRESOS PRODUCTOS</font></div></td>
  </tr>
  <tr>
    <td bgcolor="#E8DCFC"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Operador</font></div></td>
    <td bgcolor="#E1F2EF"><input type = "text" name = "operador" id="operador" size = "8" onKeyPress="return verif_caracter(this,event)"> 
      * 101  </td>
    <td width="32%" rowspan="6" align="center" valign="top" bgcolor="#E1F2EF"><img src="../../../imagenes/glumaterial.jpg" width="296" height="131" align="middle"></td>
  </tr>
  <tr>
    <td width="35%" bgcolor="#E8DCFC"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Proveedor: </font> <font color="#FF0000" size="3"></font></div></td>
    <td width="33%" bgcolor="#E1F2EF"><input type = "text" name = "nro_proveedor" id="nro_proveedor" size = "8" onKeyPress="return verif_caracter(this,event)">
      <a href="javascript:abrirVentan()"><img src="../../../imagenes/office/005.ico" alt="Imprimir" border = "0"></a></td>
    </tr>
  <tr>
    <td bgcolor="#E8DCFC"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha de Compra: </font></div></td>
    <td bgcolor="#E1F2EF"><font color="#000000" size="2">
      <input type = "text" name = "dia" id="dia" size = "2" onKeyPress="return verif_caracter(this,event)" value = "<?php echo $dia;?>" maxlength="2">
/
<input type = "text" name = "mes" id="mes" size = "2" onKeyPress="return verif_caracter(this,event)" value = "<?php echo $mes;?>" maxlength="2">
/ 20
<input type = "text" name = "anio" id="anio" size = "4" onKeyPress="return verif_caracter(this,event)" value = "<?php echo $anio;?>" maxlength="2">
    </font></td>
    </tr>
  <tr>
    <td bgcolor="#E8DCFC"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Comprobante </font></div></td>
    <td bgcolor="#E1F2EF"><input type = "text" name = "nro_factura" id="nro_factura" size = "10" value = "<?php $nro_factura;?>" onKeyPress="return verif_caracter(this,event)"></td>
    </tr>
  <tr>
    <td bgcolor="#E8DCFC"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">&iquest;Tiene</font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"> Bonificaci&oacute;n?</font> </div></td>
    <td bgcolor="#E1F2EF"><font color="#000000" size="2">
      <input name="porcentaje_boni" type="radio" value="SI" id = "porcentaje_boni1" onKeyPress="return verif_caracter(this,event)">
SI
<input name="porcentaje_boni" type="radio" value="NO" id = "porcentaje_boni" onKeyPress="return verif_caracter(this,event)" checked >
NO</font></td>
    </tr>
  <tr>
    <td bgcolor="#E8DCFC"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">% de Descuento </font></div></td>
    <td bgcolor="#E1F2EF"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">
      <input type = "text" name = "porcentaje_dto" id="porcentaje_dto" size = "5" >
      <input type = "hidden" name = "band" value = "NO">
      <input name="Alta" type="submit" value="OK" id ="Alta" size = "10" onClick = "enter()" >
</font></td>
    </tr>
<tr bgcolor="#FFFFFF">
    <td colspan="3"><iframe src="buscar_proveedor.php" width="100%" height="160" align="center">


</iframe> </td>
  </tr>
</table>
</form>
</body>
<?php }else{
		$refrescar = "SI";
		include ("ver_compra.php");
	}
	?>

</html>
