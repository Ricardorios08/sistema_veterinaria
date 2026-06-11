<script language="javascript">
function on_load()
{
document.getElementById("cod_merca").focus();
document.getElementById("cod_merca").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cod_merca":
				document.getElementById("descripcion").focus();
				break;

				case "descripcion":
				document.getElementById("nombre").focus();
				break;

				case "nombre":
				document.getElementById("tipo").focus();
				break;

				case "tipo":
				document.getElementById("presentacion").focus();
				break;

				case "presentacion":
				document.getElementById("factorconver").focus();
				break;

				case "factorconver":
				document.getElementById("cadenafrio").focus();
				break;

				case "cadenafrio":
				document.getElementById("proveedor").focus();
				break;

				case "proveedor":
				document.getElementById("fabricante").focus();
				break;

				case "fabricante":
				document.getElementById("cod_tasa").focus();
				break;

				case "cod_tasa":
				document.getElementById("margendif").focus();
				break;


				case "margendif":
				document.getElementById("guardar").focus();
				break;


				
		}
		return false;
	}
	return true;
}


</script>
<? $cod_merca= $_REQUEST['cod_merca'];
include ("variables.php");
?>

<BODY onload = "on_load ()">

<FORM name="form" ACTION="modificar_mercaderia.php" METHOD = "POST">
  <table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td height="34" colspan="2"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>aALTA DE MERCADERIA</strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="26%" bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo</font>
      </div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="codigo" type="text" id="codigo" onKeyPress="return verif_caracter(this,event)" value="<? echo $cod_merca; ?>" size="6" > 
      (Codigo del articulo)
        </font>        <div align="right"></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Descripci&oacute;n</font> </div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="descripcion" type="text" id="descripcion" onKeyPress="return verif_caracter(this,event)" value="<? echo $descripcion; ?>"  size="35">
      (Descripci&oacute;n del articulo) </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre</font></div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="nombre" type="text"  id="nombre" onKeyPress="return verif_caracter(this,event)" value="<? echo $nombre; ?>"  size="35"> 
      (Nombre comercial)                 </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo</font></div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <select name="tipo[]" id="select2" onkeypress="return verif_caracter(this,event)">
 <option value="<?"$tipo";?>"><?print("$tipo");?></option>
          <option value="Reactivos">Reactivos</option>
          <option value ="Materiales">Materiales</option>
          <option value ="Equipamiento">Equipamiento</option>
        </select>
(Tipo de producto)</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Presentaci&oacute;n</font></div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="presentacion" type="text" id="presentacion2"onKeyPress="return verif_caracter(this,event)" value="<? echo $presentacion; ?>"  size="6">
(unidades y magnitud) </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Factor de Conversión </font></div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="factorconver" type="text" id ="factorconver" onKeyPress="return verif_caracter(this,event)" value="<? echo $factorconver; ?>" size="20">    
    </font></tr>
    <tr bordercolor="#FFFFFF" bgcolor="#DCBB76">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cadena de frio </font></div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <select name="cadenafrio[]" id="cadenafrio" onkeypress="return verif_caracter(this,event)">
  <OPTGROUP LABEL = "Opcion seleccionada">
  <option value="<?"$cadenafrio";?>"><?print("$cadenafrio");?></option>
  </OPTGROUP>
<OPTGROUP LABEL = "Cambiar por">
  <option value="NO">NO</option>
  <option value ="SI">SI</option>
</OPTGROUP>
</select>
    </font></tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Proveedor</font></div></td>
      <td bgcolor="#E1F2EF">    
        <?
include ("../../../conexiones/config_pro.php");
$sql="select * from proveedores order by denominacion";
$result = $db->Execute($sql);
echo "<select name=proveedor[] size=1 id =proveedor onKeyPress='return verif_caracter(this,event)'>";
?><option value="<?"$proveedor";?>"><?print("$denominacion");?></option><?
echo"<option value=''>------</option>";
echo"<option value='0'>Otro</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cuenta"];
$a1=strtoupper($result->fields["denominacion"]);
echo"<option value=$cod>$a1</option>";
$result->MoveNext();
	}
echo"</select>";
?> 
        </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fabricante</font></div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="fabricante" type="text" id ="fabricante" onKeyPress="return verif_caracter(this,event)" value="<? echo $fabricante; ?>" size="20">    
    </font></tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tasa</font></div></td>
    <td bgcolor="#E1F2EF">
      <?
include ("../../../conexiones/config_pro.php");
$sql="select * from tasas order by cod_tasa";
$result = $db->Execute($sql);
echo "<select name=cod_tasa[] size=1 id =cod_tasa onKeyPress='return verif_caracter(this,event)'>";
?>     
<option value="<?"$cod_tasa";?>"><?print("$cod_tasa");?></option><?
    echo"<option value=''>------</option>";
echo"<option value='0'>Ninguna</option>";
      
if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cod_tasa"];
$a1=strtoupper($result->fields["cod_tasa"]);
echo"<option value=$cod>$a1</option>";
$result->MoveNext();
	}
?>
      <?
echo"</select>";
?>
      </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Margen diferencial </font></div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="margendif" type="text" id ="margendif" onKeyPress="return verif_caracter(this,event)" value="<? echo $margendif; ?>" size="5"> 
      (Previo al precio de lista) 
    </font></tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td colspan="2"><div align="center">
        <input type="Submit" name="Submit34" value="GUARDAR" target = "arriba">
      </div></td>
    </tr>
  </table>
</form>