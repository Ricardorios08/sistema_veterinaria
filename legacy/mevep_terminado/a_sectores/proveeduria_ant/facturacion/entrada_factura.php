<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<script language="javascript">
function on_load()
{
document.getElementById("operador").focus();
document.getElementById("operador").style.backgroundColor = "#CCFFCC";
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
				document.getElementById("dia").focus();

document.getElementById("operador").style.backgroundColor = "#FFFFFF";
document.getElementById("dia").style.backgroundColor = "#CCFFCC";
				break;
				
			
				
				
				case "dia":
				document.getElementById("mes").focus();
document.getElementById("dia").style.backgroundColor = "#FFFFFF";
document.getElementById("mes").style.backgroundColor = "#CCFFCC";


				break;
				case "mes":
				document.getElementById("anio").focus();
document.getElementById("mes").style.backgroundColor = "#FFFFFF";
document.getElementById("anio").style.backgroundColor = "#CCFFCC";
				break;

				case "anio":
document.getElementById("cod_cliente").focus();
document.getElementById("anio").style.backgroundColor = "#FFFFFF";
document.getElementById("cod_cliente").style.backgroundColor = "#CCFFCC";
				break;

				case "cod_cliente":
document.getElementById("cod_laboratorio").focus();
document.getElementById("cod_cliente").style.backgroundColor = "#FFFFFF";
document.getElementById("cod_laboratorio").style.backgroundColor = "#CCFFCC";
				break;
				
				case "cod_laboratorio":
document.getElementById("forma_pago").focus();
document.getElementById("cod_laboratorio").style.backgroundColor = "#FFFFFF";
document.getElementById("forma_pago").style.backgroundColor = "#CCFFCC";
				break;

				case "forma_pago":
document.getElementById("porc_dto").focus();
document.getElementById("forma_pago").style.backgroundColor = "#FFFFFF";
document.getElementById("porc_dto").style.backgroundColor = "#CCFFCC";
				break;


				case "porc_dto":
				document.getElementById("ok").focus();
				break;

				
		}
		return false;
	}
	return true;
}


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
.Estilo3 {font-size: 10px}
.Estilo8 {
	color: #000000;
	font-weight: bold;
}
.Estilo9 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }
-->


<!--
.Estilo53 {font-size: 12px; color: #000000; }
.Estilo32 {font-size: 12px; color: #000000; font-family: Arial, Helvetica, sans-serif; }
.Estilo10 {font-size: 12px}
body {
	background-image: url(../../../imagenes/logito.png);
}
.Estilo57 {color: #000000}
.Estilo58 {font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
.Estilo59 {font-size: 10px; font-family: Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<?php 
include ("../../../conexiones/config_pro.php");

$dia = date("d");
$mes = date("m");
$anio = date("Y");
$forma_pago = "contado";

?>
<body onload = "on_load ()" >

<FORM ACTION="entrada_factura_2.php" METHOD = "POST" enctype="multipart/form-data" name="form">
  <table width="850" border="0">
        <tr>
          <td colspan="2"><div align="center" class="Estilo16 Estilo8">VENTA PRODUCTOS </div></td>
        </tr>
        <tr bgcolor="#E6E6E6">
          <td width="28%" bgcolor="#A0A7F5"><div align="right"><span class="Estilo32">VETERINARIO</span></div></td>
          <td width="72%" bgcolor="#9FE1BB"><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26"><span class="Estilo53"><span class="Estilo16"><span class="Estilo3"><span class="Estilo4 Estilo16 Estilo6"><span class="Estilo57">
            <input name="operador" type="text" id="operador" onKeyPress="return verif_caracter(this,event)" value="1" size = "5">
</span></span></span></span></span></span></span></span></span></td>
        </tr>
        <tr bgcolor="#E8DCFC">
          <td bgcolor="#A0A7F5"><div align="right" class="Estilo53"><span class="Estilo16">FECHA</span></div></td>
          <td bgcolor="#9FE1BB"><div align="left" class="Estilo57"><span class="Estilo4 Estilo6  Estilo16"><span class="Estilo3"><span class="Estilo58">
              <input name="dia" type="text" id="dia" onKeyPress="return verif_caracter(this,event)" value = <?php echo $dia;?> size = "1" maxlength="2">
          /
          <input name="mes" type="text" id="mes" onKeyPress="return verif_caracter(this,event)" value = <?php echo $mes;?> size = "1" maxlength="2">
          /
          <input name="anio" type="text" id="anio" onKeyPress="return verif_caracter(this,event)" value = <?php echo $anio;?> size = "3" maxlength="4">
          </span></span></span></div></td>
        </tr>
        <tr bgcolor="#E8DCFC">
          <td bgcolor="#A0A7F5"><div align="right" class="Estilo32">CLIENTES</span></span></span></div></td>
          <td bgcolor="#9FE1BB"><div align="left" class="Estilo57"><span class="Estilo4 Estilo6  Estilo16"><span class="Estilo3"><span class="Estilo58"><span class="Estilo59">
              <!-- <input name="nro_cliente" type="text" id="nro_cliente" size = "4" onKeyPress="return verif_caracter(this,event)"> -->
              <span class="Estilo10"><span class="Estilo16"><span class="Estilo3"><span class="Estilo4 Estilo16  Estilo6">
              <?php include ("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM socios order by cod_socio";
$result = $db->Execute($sql);
echo "<select name=nro_cliente[] size=1 id =nro_cliente onKeyPress='return verif_caracter(this,event)'>";
echo"<option value='0'>Seleccione Cliente</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod_socio=$result->fields["cod_socio"];
$apellido=$result->fields["apellido"];
$nombre=$result->fields["nombre"];


if (strlen($cod_socio) == 1){
$cod = "&nbsp;&nbsp;&nbsp;&nbsp;".$cod_socio;
}
if (strlen($cod_socio) == 2){
$cod = "&nbsp;&nbsp;&nbsp;".$cod_socio;
}
if (strlen($cod_socio) == 3){
$cod = "&nbsp;".$cod_socio;
}
if (strlen($cod_socio) == 4){
$cod = $cod_socio;
}

$a1=strtoupper($apellido.", ".$nombre);
echo"<option value=$cuenta>$cod - $a1</option>";
$result->MoveNext();
	}
echo"</select>";
?>
</span></span></span></span></span></span></span></span></div></td>
        </tr>
        <tr bgcolor="#E8DCFC">
          <td bgcolor="#A0A7F5"><div align="right" class="Estilo32">FORMA DE PAGO </div></td>
          <td bgcolor="#9FE1BB"><span class="Estilo57">
            <select name="forma_pago[]" id="forma_pago"onkeypress="return verif_caracter(this,event)">
              <option value = "CONTADO">CONTADO</option>
              <option value SELECTED= "CTA/CTE">CTA/CTE</option>
            </select>
          </span></td>
        </tr>
        <tr bgcolor="#E8DCFC">
          <td bgcolor="#A0A7F5"><div align="right"><span class="Estilo32">LISTA DE PRECIOS </span></div></td>
          <td bgcolor="#9FE1BB"><span class="Estilo57">
            <select name="tipo_precio[]" id="tipo_precio"onkeypress="return verif_caracter(this,event)">
              <option value = "1" selected>LISTA 1</option>
			  <option value = "2">LISTA 2</option>
			  <option value = "3">LISTA 3</option>
                        </select>
          </span></td>
        </tr>
        <!-- <tr bgcolor="#E8DCFC">
          <td bgcolor="#A0A7F5"><div align="right" class="Estilo16 Estilo10 Estilo57">DESCUENTO</div></td>
          <td bgcolor="#9FE1BB"><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26"><span class="Estilo53"><span class="Estilo16"><span class="Estilo3"><span class="Estilo4 Estilo16 Estilo6"><span class="Estilo57">
            <input name="porc_dto" type="text" id="porc_dto" size = "5" onKeyPress="return verif_caracter(this,event)">
            <span class="Estilo10">% </span> </span></span></span></span></span></span></span></span></span>            <div align="center"> <span class="Estilo32">
          </span></div></td>
        </tr> -->
        <tr bgcolor="#E8DCFC">
          <td bgcolor="#A0A7F5"><div align="right"><span class="Estilo16 Estilo10 Estilo57">BIENES DE USO</span></div></td>
          <td bgcolor="#9FE1BB"><span class="Estilo32">
            <input name="bien_uso" type="radio" value="SI">
SI
<input name="bien_uso" type="radio" value="NO" checked>
NO</span></td>
        </tr>
        <tr>
          <td colspan="2"><div align="right"><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26"><span class="Estilo9">
          <input name="Alta" type="submit" value= "Siguiente" id = "ok">
          </span></span></span></span></span></div></td>
        </tr>
  </table>
</form>
<?php //INCLUDE ("buscar_cliente.php");?>
</table>
</body>


</html>
