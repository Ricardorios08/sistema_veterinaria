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
				document.getElementById("plan").focus();
				document.getElementById("observaciones").style.backgroundColor = "#ffffff";
				document.getElementById("plan").style.backgroundColor = "#CCFFCC";
				break;

				case "plan":
				document.getElementById("guardar").focus();
				document.getElementById("plan").style.backgroundColor = "#ffffff";
				break;
		}
		return false;
	}
	return true;
}


</script>

<?$hoy = date("d/m/y");

include ("../../../conexiones/config_pro.php");
 $sql="select * from clientes GROUP BY cuenta ORDER BY cuenta DESC";
$result = $db->Execute($sql);
 $cuenta=($result->fields["cuenta"] + 1);
?>


<BODY background="../../..//imagenes/logito.png" onload = "on_load ()">
<FORM name="form" ACTION="guardar_clientes.php" METHOD = "POST">
<table width="650" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666"> 
      <td height="34" colspan="2"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>ALTA DE CLIENTES</strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font><font size="2" face="Arial, Helvetica, sans-serif"> de Alta:</font></div></td>
      <td bgcolor="#9FE1BB"><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="fecha" id="fecha" onKeyPress="return verif_caracter(this,event)" size="8" value="<?echo $hoy;?>">
</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="27%" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Cuenta</font>
      </div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="cuenta" id="cuenta" onKeyPress="return verif_caracter(this,event)" size="5" value = "<?echo $cuenta;?>"> 
      </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Denominacion</font> </div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="denominacion" id="denominacion"  size="25" onKeyPress="return verif_caracter(this,event)">
      (Raz&oacute;n social o Apellido y Nombre) </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Domicilio</font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="domicilio"  id="domicilio"  size="25" onKeyPress="return verif_caracter(this,event)">                
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Puerta</font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="puerta" id="puerta"  size="3"onKeyPress="return verif_caracter(this,event)">
      (N&uacute;mero)</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Referencia</font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="referencia" id="referencia"  size="35"onKeyPress="return verif_caracter(this,event)">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo Postal</font></div></td>
    <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="cod_postal" id ="cod_postal" size="5" onKeyPress="return verif_caracter(this,event)">      
    </font></tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Localidad</font></div></td>
      <td bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">
        </font>        <font size="2">
        </font>      </div>        <select name="localidad[]" id="localidad" onkeypress="return verif_caracter(this,event)"><optgroup label="Capital">
        <div align="left">
          <option value="Ciudad"><font size="2" face="Arial, Helvetica, sans-serif">Ciudad</font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font></option>
        </div>
        </optgroup>
        <optgroup label="Guaymallén">
        <div align="left">
          <option value ="Guaymallen"><font size="2" face="Arial, Helvetica, sans-serif">San Jose</font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font></option>
          <option value ="Guaymallen"><font size="2" face="Arial, Helvetica, sans-serif">Dorrego</font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font></option>
          <option value ="Guaymallen"><font size="2" face="Arial, Helvetica, sans-serif">Villa Nueva</font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font></option>
          <option value ="Guaymallen"><font size="2" face="Arial, Helvetica, sans-serif">Pedro Molina</font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font></option>
          <option value ="Guaymallen"><font size="2" face="Arial, Helvetica, sans-serif">Rodeo del Medio</font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font></option>
          <option value ="Guaymallen"><font size="2" face="Arial, Helvetica, sans-serif">Rodeo de la Cruz</font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font></option>
        </div>
        </optgroup>
        <optgroup label="Godoy Cruz">
        <div align="left">
          <option value = "Godoy Cruz"><font size="2" face="Arial, Helvetica, sans-serif">Godoy Cruz</font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font></option>
        </div>
        </optgroup>
        <optgroup label="Las Heras">
        <div align="left">
          <option value = "Las Heras"><font size="2" face="Arial, Helvetica, sans-serif"> Las Heras</font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font><font size="2" face="Arial, Helvetica, sans-serif"></font></option>
        </div>
        </optgroup>
      </select></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(1)</font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="caracteristica_1" type="text" id="caracteristica_1" onKeyPress="return verif_caracter(this,event)" value="0261" size="7">
      <input type="text" name="telefono_1" id="telefono_1" size="10" onKeyPress="return verif_caracter(this,event)"> 
      (Fijo)                </font></td>
    </tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(2)</font></div></td>
      <td bgcolor="#9FE1BB">        <font size="2" face="Arial, Helvetica, sans-serif">
      <input name="caracteristica_2" type="text" id="caracteristica_2" onKeyPress="return verif_caracter(this,event)" value="0261" size="7">       
      <input type="text" name="telefono_2" id="telefono_2" size="10" onKeyPress="return verif_caracter(this,event)">
(Fijo)  </font>        <div align="right"></div>                  </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(3)</font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="caracteristica_3" type="text" id="caracteristica_3" onKeyPress="return verif_caracter(this,event)" value="261" size="7">   
      <input type="text" name="telefono_3" id="telefono_3" size="12" onKeyPress="return verif_caracter(this,event)">
      (Celular)
      </font>        <div align="right"></div>
      <div align="left"> </div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Email</font></div></td>
      <td bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="email" id="email" size="55" onKeyPress="return verif_caracter(this,event)">
      </font>
        <div align="right"></div>
      <div align="left"> </div></td>
    </tr>
</table>
  <br>  
<table width="650" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666">
      <td height="39" colspan="7"><font color="#FFFFff" face="Arial, Helvetica, sans-serif"><strong>CUIT - CONDICIONES DE VENTA </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CUIT</font></div></td>
      <td colspan="3" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input type="text" size ="15" name="cuit" id="cuit" onKeyPress="return verif_caracter(this,event)">
      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td width="28%" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo de IVA </font></div></td>
      <td width="72%" colspan="3" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <select name="iva[]" id="iva" onkeypress="return verif_caracter(this,event)">
       <option value = "1">Resp. Inscripto </option>
          <option value = "3">Monotributo</option>
           <option value = "4">Exento</option>
		

        </select> 
      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Credito $ </font></div></td>
      <td colspan="3" bgcolor="#9FE1BB"> <font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input type="text" size = "8" name="credito" id="credito" onKeyPress="return verif_caracter(this,event)">
      </strong>(M&aacute;ximo credito importe en pesos) </font>        <div align="right"></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#eeeeee">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Observaciones</font></div></td>
      <td colspan="3" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input type="text" size = "55" name="observaciones" id="observaciones" onKeyPress="return verif_caracter(this,event)">
      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#eeeeee">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Plan</font></div></td>
      <td colspan="3" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input type="text" size = "2" name="plan" id="plan">
      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td colspan="4"><div align="center">
          <font size="2" face="Arial, Helvetica, sans-serif">
          <input type="Submit" name="guardar" id= "guardar" value="GUARDAR CLIENTE" target = "arriba">
      </font></div></td>
    </tr>
</table>
</form>
