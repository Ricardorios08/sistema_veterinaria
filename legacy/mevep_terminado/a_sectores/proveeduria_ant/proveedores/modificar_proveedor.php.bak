<script language="javascript">
function on_load()
{
document.getElementById("cuenta").focus();
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
				document.getElementById("denominacion").focus();
				break;
				case "denominacion":
				document.getElementById("contacto").focus();
				break;
				case "contacto":
				document.getElementById("domicilio").focus();
				break;
				case "domicilio":
				document.getElementById("puerta").focus();
				break;
				case "puerta":
				document.getElementById("referencia").focus();
				break;
				case "referencia":
				document.getElementById("localidad").focus();
				break;
				case "localidad":
				document.getElementById("cod_postal").focus();
				break;
				case "cod_postal":
				document.getElementById("caracteristica_1").focus();
				break;

				case "caracteristica_1":
				document.getElementById("telefono_1").focus();
				break;
				case "telefono_1":
				document.getElementById("caracteristica_2").focus();
				break;

				case "caracteristica_2":
				document.getElementById("telefono_2").focus();
				break;
				case "telefono_2":
				document.getElementById("caracteristica_3").focus();
				break;
				case "caracteristica_3":
				document.getElementById("telefono_3").focus();
				break;
				case "telefono_3":
				document.getElementById("email").focus();
				break;
				case "email":
				document.getElementById("cuit").focus();
				break;
				case "cuit":
				document.getElementById("tipo_iva").focus();
				break;
				case "tipo_iva":
				document.getElementById("ing_bruto").focus();
				break;
				case "ing_bruto":
				document.getElementById("nro_ib").focus();
				break;
				case "nro_ib":
				document.getElementById("pago_orden").focus();
				break;
				
				
				case "pago_orden":
				document.getElementById("observaciones").focus();
				break;
				case "observaciones":
				document.getElementById("guardar").focus();
				break;
				
		}
		return false;
	}
	return true;
}


</script>
<?$hoy = date("d/m/y");

$cuenta = $_REQUEST['cuenta'];
include ("variables.php");
?>
<BODY onload = "on_load ()">
<FORM name="form" ACTION="modificar_proveedores.php" METHOD = "POST">
<table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td height="31" colspan="3"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>ALTA DE PROVEEDOR </strong></font></td>
  </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF"> 
      <td width="36%" bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Numero de Cuenta</font>
      </div></td>
      <td width="64%" colspan="2"><input type="text" name="cuenta" id="cuenta" value = "<?echo $cuenta;?>" onKeyPress="return verif_caracter(this,event)" size="5" >        
      <div align="right"></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#D0F9FB"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Raz&oacute;n social o Apellido y Nombre</font> </div></td>
      <td colspan="2"><input name="denominacion" type="text" id="denominacion" onKeyPress="return verif_caracter(this,event)" value="<?echo $denominacion;?>"  size="25"> 
      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#D0F9FB"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Nombre</font> <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">del Contacto</font></div></td>
      <td colspan="2"><input name="contacto" type="text" id="contacto" onKeyPress="return verif_caracter(this,event)" value="<?echo $contacto;?>"  size="25">        </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Calle</font></div></td>
      <td colspan="2"><input name="domicilio" type="text"  id="domicilio" onKeyPress="return verif_caracter(this,event)" value="<?echo $domicilio;?>"  size="25">
      <font size="2" face="Arial, Helvetica, sans-serif">Nro</font> <input name="puerta" type="text" id="puerta"onKeyPress="return verif_caracter(this,event)" value="<?echo $puerta;?>"  size="4"></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Referencia</font></div></td>
      <td><input name="referencia" type="text" id="referencia"onKeyPress="return verif_caracter(this,event)" value="<?echo $referencia;?>"  size="35"></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Localidad</font></div></td>
      <td colspan="2"><select name="localidad[]" id="localidad" onkeypress="return verif_caracter(this,event)">
        <optgroup label="Opcion Seleccionada">
			<option value selected= "<?"$localidad";?>"> <?print("$localidad");?></option>
	</optgroup>
 <optgroup label="Cambiar por:">
 <optgroup label="Capital">
        <option value="Ciudad">Ciudad<font size="2"></font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        </optgroup>
        <optgroup label="Guaymallén">
        <option value ="Guaymallen">San Jose<font size="2"></font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value ="Guaymallen">Dorrego<font size="2"></font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value ="Guaymallen">Villa Nueva<font size="2"></font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value ="Guaymallen">Pedro Molina<font size="2"></font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value ="Guaymallen">Rodeo del Medio<font size="2"></font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value ="Guaymallen">Rodeo de la Cruz<font size="2"></font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        </optgroup>
        <optgroup label="Godoy Cruz">
        <option value = "Godoy Cruz">Godoy Cruz<font size="2"></font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        </optgroup>
        <optgroup label="Las Heras">
        <option value = "Las Heras"> Las Heras<font size="2"></font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        </optgroup>
		  </optgroup>
      </select>
      <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo Postal 
        <input name="cod_postal" type="text" id ="cod_postal" onKeyPress="return verif_caracter(this,event)" value="<?echo $cuenta;?>" size="5">
</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(1)</font></div></td>
      <td colspan="2"><input name="caracteristica_1" type="text" id="caracteristica_1" onKeyPress="return verif_caracter(this,event)" value="<?echo $caracteristica_1;?>" size="7">
        <input name="telefono_1" type="text" id="telefono_1" onKeyPress="return verif_caracter(this,event)" value="<?echo $telefono_1;?>" size="15">
      <font size="2" face="Arial, Helvetica, sans-serif">      (Fijo)</font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(2)</font></div></td>
      <td colspan="2">        <input name="caracteristica_2" type="text" id="caracteristica_2" onKeyPress="return verif_caracter(this,event)" value="<?echo $caracteristica_2;?>" size="7">       
 <input name="telefono_2" type="text" id="telefono_2" onKeyPress="return verif_caracter(this,event)" value="<?echo $telefono_2;?>" size="15">
 <font size="2" face="Arial, Helvetica, sans-serif">(Fijo) </font> <div align="right"></div>                  </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(3)</font></div></td>
      <td colspan="2"><input name="caracteristica_3" type="text" id="caracteristica_3" onKeyPress="return verif_caracter(this,event)" value="<?echo $caracteristica_3;?>" size="7">   
     <input name="telefono_3" type="text" id="telefono_3" onKeyPress="return verif_caracter(this,event)" value="<?echo $telefono_3;?>" size="15">
        <font size="2" face="Arial, Helvetica, sans-serif">(Celular)
        </font>        <div align="right"></div>
      <div align="left"> </div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td height="24" bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Email</font></div></td>
      <td colspan="2"><input name="email" type="text" id="email" onKeyPress="return verif_caracter(this,event)" value="<?echo $email;?>" size="30">      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#000099">
      <td height="24" colspan="3"><div align="right"></div>        
      <div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>INSCRIPCIONES</strong></font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nro Cuit</font></div></td>
      <td colspan="2"><strong>
        <input name="cuit" type="text" id="cuit" onKeyPress="return verif_caracter(this,event)" value="<?echo $cuit;?>" size ="15">
        </strong><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo de IVA</font><strong> 
        <select name="tipo_iva[]" tabindex="13"id="tipo_iva"onkeypress="return verif_caracter(this,event)">
         <optgroup label="Opcion Seleccionada">
			<option value selected= "<?"$tipo_iva";?>"> <?print("$tipo_iva");?></option>
	</optgroup>
 <optgroup label="Cambiar por:">
  <option value = "1">Responsable Inscripto </option>
          <option value = "2">Monotributista</option>
          <option value = "3">Exento </option>
          <option value = "4">Consumidor Final </option>
        </optgroup>
		</select> 
        </strong></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Convenio</font></div></td>
      <td colspan="2">
        <select name="ing_bruto[]" id="ing_bruto" onkeypress="return verif_caracter(this,event)">
          <optgroup label="Opcion Seleccionada">
			<option value selected= "<?"$ing_bruto";?>"> <?print("$ing_bruto");?></option>
	</optgroup>
 <optgroup label="Cambiar por:">
<option value = "1">Normal</option>
          <option value = "2">Convenio Multilateral </option>
          <option value = "3">Exento</option>
       </optgroup>
	    </select>
        <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nro Ingresos Brutos </font>        <strong>
        <input name="pago_orden2" type="text" id="pago_orden3" onKeyPress="return verif_caracter(this,event)" value="<?echo $nro_ib;?>" size = "25">
        </strong> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Pago a la orden de: </font></div></td>
      <td colspan="2"><strong>
        <input name="pago_orden" type="text" id="pago_orden" onKeyPress="return verif_caracter(this,event)" value="<?echo $pago_orden;?>" size = "25">
      </strong></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Observaciones</font></div></td>
      <td colspan="2"><strong>
        <input name="observaciones" type="text" id="observaciones" onKeyPress="return verif_caracter(this,event)" value="<?echo $observaciones;?>" size = "25">
      </strong></td>
    </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#CCCCCC">
    <td colspan="3"><div align="center">
      <input type="Submit" name="Submit" value="GUARDAR" id = "guardar">
    </div></td>
  </tr>
</table>
<font color="#000000" size="2" face="Arial, Helvetica, sans-serif"></font>