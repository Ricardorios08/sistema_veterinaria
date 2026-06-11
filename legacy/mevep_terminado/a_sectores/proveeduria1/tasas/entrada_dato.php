<script language="javascript">
function on_load()
{
document.getElementById("cod_tasa").focus();
document.getElementById("cod_tasa").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cod_tasa":
				document.getElementById("iva_normal").focus();
				document.getElementById("cod_tasa").style.backgroundColor = "#ffffff";
				document.getElementById("iva_normal").style.backgroundColor = "#CCFFCC";

				break;

				case "iva_normal":
				document.getElementById("iva_recargo").focus();
				document.getElementById("iva_normal").style.backgroundColor = "#ffffff";
				document.getElementById("iva_recargo").style.backgroundColor = "#CCFFCC";
				break;

			case "iva_recargo":
				document.getElementById("iva_especial").focus();
				document.getElementById("iva_recargo").style.backgroundColor = "#ffffff";
				document.getElementById("iva_especial").style.backgroundColor = "#CCFFCC";
				break;



				case "iva_especial":
				document.getElementById("percepcion_dgr").focus();
				document.getElementById("iva_especial").style.backgroundColor = "#ffffff";
				document.getElementById("percepcion_dgr").style.backgroundColor = "#CCFFCC";
				break;

				case "percepcion_dgr":
				document.getElementById("multa_dgr").focus();
				document.getElementById("percepcion_dgr").style.backgroundColor = "#ffffff";
				document.getElementById("multa_dgr").style.backgroundColor = "#CCFFCC";
				break;
				
				case "multa_dgr":
document.getElementById("tasa_ig").focus();
document.getElementById("multa_dgr").style.backgroundColor = "#ffffff";
document.getElementById("tasa_ig").style.backgroundColor = "#CCFFCC";
				break;
				

				case "tasa_ig":		
document.getElementById("guardar").focus();
document.getElementById("tasa_ig").style.backgroundColor = "#ffffff";
				break;
		}
		return false;
	}
	return true;
}


</script>

<?$hoy = date("d/m/y");

include ("../../../conexiones/config_grabacion.php");
 $sql="select * from tasas ORDER BY cod_tasa DESC";
$result = $db_pro->Execute($sql);
 $cod_tasa=($result->fields["cod_tasa"] + 1);
?>


<BODY background="../../../imagenes/logito.png" onload = "on_load ()">
<FORM name="form" ACTION="guardar_tasa.php" METHOD = "POST">
  <table width="650" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666">
      <td height="34" colspan="2"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>A&ntilde;adir Tasas </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font>:<font color="#006633" size="2" face="Arial, Helvetica, sans-serif"> </font></div></td>
      <td width="48%" bgcolor="#9FE1BB"><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="fecha" id="fecha2" onKeyPress="return verif_caracter(this,event)" size="8" value="<?echo $hoy;?>">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td width="52%" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cod. Tasa </font> </div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="cod_tasa" id="cod_tasa2" onKeyPress="return verif_caracter(this,event)" size="5" value = "<?echo $cod_tasa;?>">
      </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp; </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp; </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Iva Normal</font> </div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="iva_normal" id="iva_normal2"  size="5" onKeyPress="return verif_caracter(this,event)">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Iva Recargo </font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="iva_recargo"  id="iva_recargo2"  size="5" onKeyPress="return verif_caracter(this,event)">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Iva Especial </font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="iva_especial" id="iva_especial2"  size="5"onKeyPress="return verif_caracter(this,event)">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Percepcion DGR </font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="percepcion_dgr" id="percepcion_dgr2"  size="5"onKeyPress="return verif_caracter(this,event)">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Multa DGR </font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="multa_dgr" id ="multa_dgr2" size="5" onKeyPress="return verif_caracter(this,event)">
      </font> 
    </tr>
    <tr bordercolor="#FFFFFF">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tasa Ingresos Brutos </font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="tasa_ig" id ="tasa_ig2" size="5" onKeyPress="return verif_caracter(this,event)">
        <input type="Submit" name="guardar" id= "guardar3" value="GUARDAR TASA" target = "arriba">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td colspan="2"><div align="center">
          <?include ("buscar_tasa.php");?>
      </div></td>
    </tr>
  </table>
</form>
