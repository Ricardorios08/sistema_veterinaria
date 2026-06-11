<script language="javascript">
function on_load()
{
document.getElementById("cuenta").focus();
document.getElementById("cuenta").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cuenta":
				document.getElementById("estado").focus();
				document.getElementById("cuenta").style.backgroundColor = "#ffffff";
				document.getElementById("estado").style.backgroundColor = "#CCFFCC";

				break;

				case "estado":
				document.getElementById("estado1").focus();
				break;

				case "estado1":
				document.getElementById("estado2").focus();
				break;

				case "estado2":
				document.getElementById("denominacion").focus();
				
				document.getElementById("denominacion").style.backgroundColor = "#CCFFCC";
				break;

				case "denominacion":
				document.getElementById("domicilio").focus();
				document.getElementById("denominacion").style.backgroundColor = "#ffffff";
				document.getElementById("domicilio").style.backgroundColor = "#CCFFCC";
				break;

				case "domicilio":
				document.getElementById("puerta").focus();
				document.getElementById("domicilio").style.backgroundColor = "#ffffff";
				document.getElementById("puerta").style.backgroundColor = "#CCFFCC";
				break;
				case "puerta":
				document.getElementById("referencia").focus();
				document.getElementById("puerta").style.backgroundColor = "#ffffff";
				document.getElementById("referencia").style.backgroundColor = "#CCFFCC";
				break;
				case "referencia":
				document.getElementById("cod_postal").focus();
				document.getElementById("referencia").style.backgroundColor = "#ffffff";
				document.getElementById("cod_postal").style.backgroundColor = "#CCFFCC";
				break;
				case "cod_postal":
				document.getElementById("localidad").focus();
				document.getElementById("cod_postal").style.backgroundColor = "#ffffff";
				document.getElementById("localidad").style.backgroundColor = "#CCFFCC";
				break;
				case "localidad":
				document.getElementById("caracteristica_1").focus();
				document.getElementById("localidad").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_1").style.backgroundColor = "#CCFFCC";
				break;

				case "caracteristica_1":
				document.getElementById("telefono_1").focus();			
				document.getElementById("caracteristica_1").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_1").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_1":
				document.getElementById("caracteristica_2").focus();
				document.getElementById("telefono_1").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_2").style.backgroundColor = "#CCFFCC";
				break;

				case "caracteristica_2":
				document.getElementById("telefono_2").focus();
				document.getElementById("caracteristica_2").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_2").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_2":
				document.getElementById("caracteristica_3").focus();
				document.getElementById("telefono_2").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_3").style.backgroundColor = "#CCFFCC";
				break;
				case "caracteristica_3":
				document.getElementById("telefono_3").focus();
				document.getElementById("caracteristica_3").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_3").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_3":
				document.getElementById("email").focus();
				document.getElementById("telefono_3").style.backgroundColor = "#ffffff";
				document.getElementById("email").style.backgroundColor = "#CCFFCC";
				break;

				case "email":
				document.getElementById("cuit").focus();
				document.getElementById("email").style.backgroundColor = "#ffffff";
				document.getElementById("cuit").style.backgroundColor = "#CCFFCC";
				break;

				case "cuit":
				document.getElementById("iva").focus();
				document.getElementById("cuit").style.backgroundColor = "#ffffff";
				document.getElementById("iva").style.backgroundColor = "#CCFFCC";
				break;

				case "iva":
				document.getElementById("ingresos_brutos").focus();
				document.getElementById("iva").style.backgroundColor = "#ffffff";
				document.getElementById("ingresos_brutos").style.backgroundColor = "#CCFFCC";
				break;

				case "ingresos_brutos":
				document.getElementById("condiciones").focus();
				document.getElementById("ingresos_brutos").style.backgroundColor = "#ffffff";
				document.getElementById("condciones").style.backgroundColor = "#CCFFCC";
				break;

				case "condiciones":
				document.getElementById("credito").focus();
				document.getElementById("condiciones").style.backgroundColor = "#ffffff";
				document.getElementById("credito").style.backgroundColor = "#CCFFCC";
				break;

				case "credito":
				document.getElementById("flete").focus();
				document.getElementById("credito").style.backgroundColor = "#ffffff";
				document.getElementById("flete").style.backgroundColor = "#CCFFCC";
				break;

				case "flete":
				document.getElementById("observaciones").focus();
				document.getElementById("flete").style.backgroundColor = "#ffffff";
				document.getElementById("observaciones").style.backgroundColor = "#CCFFCC";
				break;

				case "observaciones":
				document.getElementById("guardar").focus();
				document.getElementById("flete").style.backgroundColor = "#ffffff";
				break;
		}
		return false;
	}
	return true;
}


</script>

<?$hoy = date("d/m/y");
$a = $_GET['id'];

?>


<BODY onload = "on_load ()">
<FORM name="form" ACTION="modificar_clientes.php" METHOD = "POST">

<?
include ("variables.php");

?>
<table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td height="34" colspan="2"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>CAMBIO DE CUENTA DE CLIENTES EXTERNOS </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="27%" bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Cuenta</font>
      </div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="cuenta" id="cuenta" value = "<?echo $a;?>" onKeyPress="return verif_caracter(this,event)" size="5" > 
      ACTUAL
</font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Cuenta</font> </div></td>
      <td bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="cuenta2" id="cuenta2" value = "<?echo $a;?>" onKeyPress="return verif_caracter(this,event)" size="5" >
        NUEVA </font></td>
    </tr>
</table>
  <br>  
<table width="103%" border="0">
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td width="676%" colspan="4"><div align="center">
          <font size="2" face="Arial, Helvetica, sans-serif">
          <input type="Submit" name="guardar" id= "guardar" value="CAMBIAR" target = "arriba">
      </font></div></td>
    </tr>
</table>
</form>
  
