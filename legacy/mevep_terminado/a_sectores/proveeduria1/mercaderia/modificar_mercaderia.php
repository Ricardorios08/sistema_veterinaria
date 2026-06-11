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

<?$hoy = date("d/m/y");

$cod_merca= $_REQUEST['cod_merca'];
include ("variables.php");
?>


<BODY onload = "on_load ()">
<FORM name="form" ACTION="modificar.php" METHOD = "POST">
<table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td height="34" colspan="3"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>ALTA DE MERCADERIA </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="27%" bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cod. Mercaderia </font></div></td>
      <td width="40%" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="cod_merca" id="cod_merca" onKeyPress="return verif_caracter(this,event)" size="5" value = "<?echo $cod_merca;?>"> 
      </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      
      </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;     </font>      
      <div align="right"></div></td>
      <td width="40%" bgcolor="#E1F2EF"><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      </font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font>:<font color="#006633" size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="fecha" id="fecha" onKeyPress="return verif_caracter(this,event)" size="8" value="<?echo $hoy;?>">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Descripcion</font> </div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="descripcion" type="text" id="descripcion" onKeyPress="return verif_caracter(this,event)" value="<? echo $descripcion; ?>"  size="35">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="nombre" type="text"  id="nombre" onKeyPress="return verif_caracter(this,event)" value="<? echo $nombre; ?>"  size="35">
</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <select name="tipo[]" id="tipo" onkeypress="return verif_caracter(this,event)">
          <option value="<?"$tipo";?>"><?print("$tipo_p");?></option>
          <option value="1">Reactivos</option>
          <option value ="2">Materiales</option>
          <option value ="3">Equipamiento</option>
        </select>
(Tipo de producto)
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Presentacion</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="presentacion" type="text" id="presentacion"onKeyPress="return verif_caracter(this,event)" value="<? echo $presentacion; ?>"  size="6">
(unidades y magnitud) 
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Factor de Conversi&oacute;n</font></div></td>
    <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="factorconver" type="text" id ="factorconver" onKeyPress="return verif_caracter(this,event)" value="<? echo $factorconver; ?>" size="20">
    </font></tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cadena de fr&iacute;o</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">
        </font>        <font size="2" face="Arial, Helvetica, sans-serif">
        <select name="cadenafrio[]" id="cadenafrio" onkeypress="return verif_caracter(this,event)">
          <OPTGROUP LABEL = "Opcion seleccionada">
          <option value="<?"$cadenafrio";?>"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cadenafrio");?></font></option>
          </OPTGROUP>
          <OPTGROUP LABEL = "Cambiar por">
          <option value="NO"><font size="2" face="Arial, Helvetica, sans-serif">NO</font></option>
          <option value ="SI"><font size="2" face="Arial, Helvetica, sans-serif">SI</font></option>
          </OPTGROUP>
        </select>
        </font> </div>        </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Proveedor</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF">
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
</td>
    </tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fabricante</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="fabricante" type="text" id ="fabricante" onKeyPress="return verif_caracter(this,event)" value="<? echo $fabricante; ?>" size="20">
      </font>        <font size="2" face="Arial, Helvetica, sans-serif">&nbsp;
</font>        <div align="right"></div>                  </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tasa</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF">
        <?
include ("../../../conexiones/config_pro.php");
$sql="select * from tasas order by cod_tasa";
$result = $db->Execute($sql);
echo "<select name=cod_tasa[] size=1 id =cod_tasa onKeyPress='return verif_caracter(this,event)'>";
?>     
<option value="<?"$por_iva";?>"><?print("$por_iva");?></option><?
    echo"<option value=''>------</option>";
echo"<option value='0'>Ninguna</option>";
      
if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cod_tasa"];
$iva_normal=$result->fields["iva_normal"];
$tasa = "Tasa ".$cod." - Porc.: ".$iva_normal;
echo"<option value=$cod>$tasa</option>";
$result->MoveNext();
	}
?>
      <?
echo"</select>";
?>
<font size="2" face="Arial, Helvetica, sans-serif">&nbsp;
        </font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Margen Diferencial </font></div></td>
      <td colspan="2" bgcolor="#E1F2EF">
        <font size="2" face="Arial, Helvetica, sans-serif">
        <input name="margendif" type="text" id ="margendif" onKeyPress="return verif_caracter(this,event)" value="<? echo $margendif; ?>" size="5">
(Previo al precio de lista) </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB">&nbsp;</td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="Submit" name="guardar" id= "guardar" value="MODIFICAR MERCADERIA" target = "arriba">
      </font></td>
    </tr>
</table>
 
</form>
  
