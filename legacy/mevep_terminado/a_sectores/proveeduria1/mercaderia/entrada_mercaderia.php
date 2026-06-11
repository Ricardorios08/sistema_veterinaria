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

<BODY onload = "on_load ()">

<FORM name="form" ACTION="guardar_mercaderia.php" METHOD = "POST">
<table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td height="34" colspan="3"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>
        <?$hoy = date("d/m/y");

include ("../../../conexiones/config_pro.php");
 $sql="select * from mercaderia GROUP BY cod_merca ORDER BY cod_merca DESC";
$result = $db->Execute($sql);
 $cod_merca=($result->fields["cod_merca"] + 1);
?>
      ALTA DE MERCADERIA </strong></font></td>
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
      <input type="text" name="descripcion" id="descripcion" onKeyPress="return verif_caracter(this,event)">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="nombre"  id="nombre"  size="35" onKeyPress="return verif_caracter(this,event)">
</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <select name="tipo[]" id="tipo" onkeypress="return verif_caracter(this,event)">
          <option value="Reactivos">Reactivos</option>
          <option value ="Materiales">Materiales</option>
          <option value ="Equipamiento">Equipamiento</option>
        </select>
(Tipo de producto)
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Presentacion</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="presentacion" id="presentacion"  size="6"onKeyPress="return verif_caracter(this,event)">
(unidades y magnitud) 
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Factor de Conversi&oacute;n</font></div></td>
    <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="factorconver" id ="factorconver" size="20" onKeyPress="return verif_caracter(this,event)">
    </font></tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cadena de fr&iacute;o</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">
        </font>        <font size="2" face="Arial, Helvetica, sans-serif">
        <select name="cadenafrio[]" id="cadenafrio" onkeypress="return verif_caracter(this,event)">
          <option value="NO">NO</option>
          <option value ="SI">SI</option>
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
echo"<option value='0'>Otro</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cuenta"];
$a1=strtoupper($result->fields["denominacion"]);
echo"<option value=$cod>$a1</option>";
$result->MoveNext();
	}
echo"</select>";
?>      </td>
    </tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fabricante</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="fabricante" id ="fabricante" size="20" onKeyPress="return verif_caracter(this,event)">
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
if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cod_tasa"];
$iva_normal=$result->fields["iva_normal"];
$tasa = "Tasa ".$cod_tasa." - Porc.: ".$iva_normal;
echo"<option value=$cod>$tasa</option>";
$result->MoveNext();
	}
echo"</select>";
?> <font size="2" face="Arial, Helvetica, sans-serif">&nbsp;
        </font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Margen Diferencial </font></div></td>
      <td colspan="2" bgcolor="#E1F2EF">
        <input type="text" name="margendif" id ="margendif" size="5" onKeyPress="return verif_caracter(this,event)">
        <font size="2" face="Arial, Helvetica, sans-serif">(Previo al precio de lista)      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB">&nbsp;</td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="Submit" name="guardar" id= "guardar4" value="GUARDAR MERCADERIA" target = "arriba">
      </font></td>
    </tr>
</table>
 
</form>
  
