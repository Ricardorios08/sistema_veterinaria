<script language="javascript">
function on_load()
{
document.getElementById("plan").focus();
document.getElementById("plan").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "plan":
				document.getElementById("descuento_1").focus();
				document.getElementById("plan").style.backgroundColor = "#ffffff";
				document.getElementById("descuento_1").style.backgroundColor = "#CCFFCC";

				break;

				case "descuento_1":
				document.getElementById("descuento_2").focus();
				document.getElementById("descuento_1").style.backgroundColor = "#ffffff";
				document.getElementById("descuento_2").style.backgroundColor = "#CCFFCC";
				break;

			case "descuento_2":
				document.getElementById("recargo_1").focus();
				document.getElementById("descuento_2").style.backgroundColor = "#ffffff";
				document.getElementById("recargo_1").style.backgroundColor = "#CCFFCC";
				break;



				case "recargo_1":
				document.getElementById("recargo_2").focus();
				document.getElementById("recargo_1").style.backgroundColor = "#ffffff";
				document.getElementById("recargo_2").style.backgroundColor = "#CCFFCC";
				break;

				case "recargo_2":
				document.getElementById("recargo_flete").focus();
				document.getElementById("recargo_2").style.backgroundColor = "#ffffff";
				document.getElementById("recargo_flete").style.backgroundColor = "#CCFFCC";
				break;
				
				case "recargo_flete":
document.getElementById("recargo_impuesto").focus();
document.getElementById("recargo_flete").style.backgroundColor = "#ffffff";
document.getElementById("recargo_impuesto").style.backgroundColor = "#CCFFCC";
				break;
				

case "recargo_impuesto":
document.getElementById("cuotas").focus();
document.getElementById("recargo_impuesto").style.backgroundColor = "#ffffff";
document.getElementById("cuotas").style.backgroundColor = "#CCFFCC";
				break;



				case "cuotas":
				document.getElementById("recargo_mensual").focus();
				document.getElementById("cuotas").style.backgroundColor = "#ffffff";
				document.getElementById("recargo_mensual").style.backgroundColor = "#CCFFCC";
				break;

				case "recargo_mensual":		
document.getElementById("guardar").focus();
document.getElementById("recargo_mensual").style.backgroundColor = "#ffffff";
				break;
		}
		return false;
	}
	return true;
}


</script>

<?$hoy = date("d/m/y");

include ("../../../conexiones/config_pro.php");
 $sql="select * from tasas_planes ORDER BY cod_plan DESC";
$result = $db->Execute($sql);
 $cod_plan=($result->fields["cod_plan"] + 1);
?>


<BODY background="../../../imagenes/logito.png" onload = "on_load ()">
 <FORM name="form" ACTION="guardar_plan.php" METHOD = "POST">

	  <table width="650" border="0" align="left">
        <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666">
          <td height="34" colspan="2"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>Planes</strong></font></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
          <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font>:<font color="#006633" size="2" face="Arial, Helvetica, sans-serif"> </font></div></td>
          <td width="48%" bgcolor="#9FE1BB"><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">
            <input type="text" name="fecha" id="fecha" onKeyPress="return verif_caracter(this,event)" size="8" value="<?echo $hoy;?>">
          </font></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
          <td width="52%" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Plan </font> </div></td>
          <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type="text" name="plan" id="plan2" onKeyPress="return verif_caracter(this,event)" size="5" value = "<?echo $cod_plan;?>">
          </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp; </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp; </font></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
          <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Descuento 1 </font> </div></td>
          <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type="text" name="descuento_1" id="descuento_1"  size="5" onKeyPress="return verif_caracter(this,event)">
          </font></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
          <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Descuento 2 </font></div></td>
          <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type="text" name="descuento_2"  id="descuento_2"  size="5" onKeyPress="return verif_caracter(this,event)">
          </font></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
          <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Recargo 1 </font></div></td>
          <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type="text" name="recargo_1" id="recargo_1"  size="5"onKeyPress="return verif_caracter(this,event)">
          </font></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
          <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Recargo 2 </font></div></td>
          <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type="text" name="recargo_2" id="recargo_2"  size="5"onKeyPress="return verif_caracter(this,event)">
          </font></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
          <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Recargo Flete </font></div></td>
          <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type="text" name="recargo_flete" id ="recargo_flete" size="5" onKeyPress="return verif_caracter(this,event)">
          </font>       
        </tr>
        <tr bordercolor="#FFFFFF">
          <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Recargo Impuesto </font></div></td>
          <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type="text" name="recargo_impuesto" id ="recargo_impuesto" size="5" onKeyPress="return verif_caracter(this,event)">
          </font></td>
        </tr>
        <tr bordercolor="#FFFFFF">
          <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cuotas</font></div></td>
          <td bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"> </font> <font size="2"> </font> </div>
              <font size="2" face="Arial, Helvetica, sans-serif">
              <input type="text" name="cuotas" id ="cuotas" size="5" onKeyPress="return verif_caracter(this,event)">
            </font></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
          <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Recargo Mensual </font></div></td>
          <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
            <input type="text" name="recargo_mensual" id="recargo_mensual" size="10" onKeyPress="return verif_caracter(this,event)">
            <input type="Submit" name="guardar" id= "guardar2" value="GUARDAR PLAN" target = "arriba">
</font></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
          <td colspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
          </font></div></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
          <td colspan="2"><?include ("buscar_plan.php");?></td>
        </tr>
      </table>
</form>