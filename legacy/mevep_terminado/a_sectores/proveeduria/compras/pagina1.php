 
<script>
function on_load()
{
document.getElementById("nro_factura").focus();
document.getElementById("nro_factura").select();
}

function enter()
{
document.getElementById("nro_factura").focus();
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
				case "nro_factura":
				document.getElementById("dia").focus();
					document.getElementById("dia").select();
				break;
				case "dia":
				document.getElementById("mes").focus();
				document.getElementById("mes").select();
				break;
				
				
				case "mes":
				document.getElementById("anio").focus();
				document.getElementById("anio").select();
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


<?php 
$id = $_REQUEST['id'];


include("../../../conexiones/config.inc.php");

$sql = "TRUNCATE TABLE compras1_encab_temp";
$result = $db->Execute($sql);
$sql = "TRUNCATE TABLE compras1_deta_temp";
$result = $db->Execute($sql);

$dia = date("d");
$mes= date("m");
$anio = date("y");




?>
<body onload = "on_load ()">
<FORM ACTION="pagina2.php" METHOD = "POST" enctype="multipart/form-data" name="form">
<table width="860" border="0" cellspacing="0">
  <tr bgcolor="#000099">
    <td height="32" colspan="2" bgcolor="#999999"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">INGRESAR COMPRA </font></div></td>
  </tr>
  <tr>
    <td bgcolor="#EDEDED"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Operador</font></div></td>
    <td bgcolor="#EDEDED"><input type = "text" name = "operador" id="operador" size = "8" value = "<?PHP echo $id;?>" onKeyPress="return verif_caracter(this,event)"></td>
    </tr>
  <tr>
    <td width="47%" bgcolor="#EDEDED">

<div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Proveedor: </font> <font color="#FF0000" size="3"></font></div></td>
    <td width="53%" bgcolor="#EDEDED"><?php 
include ("../../../conexiones/config.inc.php");
$sql = "SELECT * FROM proveedores order by denominacion";
$result = $db->Execute($sql);
echo "<select name=nro_proveedor[] size=1 id =nro_os onKeyPress='return verif_caracter(this,event)'>";
echo"<option value=''>Seleccione PROVEEDOR</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cuenta=$result->fields["cuenta"];
$denominacion=strtoupper($result->fields["denominacion"]);


echo"<option value=$cuenta>$denominacion ($cuenta)</option>";
$result->MoveNext();
	}
echo"</select>";
?> </td>
    </tr>
  <tr>
    <td bgcolor="#EDEDED"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Comprobante</font></div></td>
    <td bgcolor="#EDEDED"><input type = "text" name = "nro_factura" id="nro_factura" size = "10" value = "<?php $nro_factura;?>" onKeyPress="return verif_caracter(this,event)"></td>
  </tr>
  <tr>
    <td bgcolor="#EDEDED"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha de Compra: </font></div></td>
    <td bgcolor="#EDEDED"><font color="#000000" size="2">
      <input type = "text" name = "dia" id="dia" size = "2" onKeyPress="return verif_caracter(this,event)" value = "<?php echo $dia;?>" maxlength="2">
/
<input type = "text" name = "mes" id="mes" size = "2" onKeyPress="return verif_caracter(this,event)" value = "<?php echo $mes;?>" maxlength="2">
/ 20
<input type = "text" name = "anio" id="anio" size = "4" onKeyPress="return verif_caracter(this,event)" value = "<?php echo $anio;?>" maxlength="2">
    </font></td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#999999"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">
      <input name="Alta" type="submit" value="OK" id ="Alta" size = "10" onClick = "enter()" >
    </font></div></td>
    </tr>
  
<!-- <tr bgcolor="#FFFFFF">
    <td colspan="2"><iframe src="buscar_proveedor.php" width="100%" height="200" align="center">


</iframe>  -->
  </tr>
</table>
</form>
</body>


</html>
