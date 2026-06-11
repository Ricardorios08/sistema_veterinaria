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
				document.getElementById("nombre").focus();
				break;

				case "nombre":
				document.getElementById("proveedor").focus();
				break;

				case "proveedor":
				document.getElementById("d").focus();
				break;

				case "d":
				document.getElementById("p").focus();
				break;

				case "p":
				document.getElementById("precio_actualizado").focus();
				break;

				case "precio_actualizado":
				document.getElementById("cod_tasa").focus();
				break;

				
				
		}
		return false;
	}
	return true;
}


</script>

<BODY background="../../../imagenes/logito.png" onload = "on_load ()">

<FORM name="form" ACTION="guardar.php" METHOD = "POST">
<table width="650" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666"> 
      <td height="34" colspan="2"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>
        <?$hoy = date("d/m/Y");

include ("../../../conexiones/config_pro.php");
 $sql="select * from mercaderia GROUP BY cod_merca ORDER BY cod_merca DESC";
$result = $db->Execute($sql);
 $cod_merca=($result->fields["cod_merca"] + 1);
?>
      ALTA DE DEBITO AUTOMATICO NEVADA </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="27%" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Mevep </font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="cod_mevep" id="cod_mevep" onKeyPress="return verif_caracter(this,event)" size="5"> 
      </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      
      </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;     </font>      
      <div align="right"></div>      <div align="center"><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">
      </font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre</font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="nombre"  id="nombre"  size="35" onKeyPress="return verif_caracter(this,event)">
</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Documento</font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="documento"  id="documento3"  size="8" onKeyPress="return verif_caracter(this,event)">
      </font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Nº tarjeta</font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="cbu" type="text"  id="cbu3" onKeyPress="return verif_caracter(this,event)"  size="20" maxlength="16">
16 digitos (obligatorios)
        </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Fecha Ingreso </font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="fecha_ingreso" type="text" id ="fecha_ingreso" onKeyPress="return verif_caracter(this,event)" value="<?echo $hoy;?>" size="10" maxlength="10"> 
        dd/mm/yy
</font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Monto a Descontar</font></div></td>
      <td bgcolor="#9FE1BB"><input type="text" name="monto_descontar" id ="monto_descontar" size="5" onKeyPress="return verif_caracter(this,event)"></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td colspan="2" bgcolor="#666666"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
          <input type="Submit" name="guardar" id= "guardar4" value="GUARDAR SOCIO" target = "arriba">
      </font></div></td>
    </tr>
</table>
 
</form>
