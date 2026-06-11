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
      <td height="34" colspan="3"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>ALTA DE CLIENTES NO ASOCIADOS</strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="27%" bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Cuenta</font>
      </div></td>
      <td width="40%" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="cuenta" id="cuenta" value = "<?echo $a;?>" onKeyPress="return verif_caracter(this,event)" size="5" > 
      </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      
      </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;     </font>      
      <div align="right"></div></td>
      <td width="40%" bgcolor="#E1F2EF"><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      </font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font>:<font color="#006633" size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="fecha" id="fecha" onKeyPress="return verif_caracter(this,event)" size="8" value="<?echo $hoy;?>">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Estado</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input type="radio" name="estado" id="estado" value="1" onKeyPress="return verif_caracter(this,event)"  checked="TRUE">
        </strong>Activo
      <input type="radio" name="estado" id="estado1" value="2"  onKeyPress="return verif_caracter(this,event)"> 
      Suspendido
      <input type="radio" name="estado" id="estado2" value="3"  onKeyPress="return verif_caracter(this,event)">
Baja </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Denominacion</font> </div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="denominacion" type="text" id="denominacion" onKeyPress="return verif_caracter(this,event)" value="<?echo $denominacion;?>"  size="25">
      (Raz&oacute;n social o Apellido y Nombre) </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Domicilio</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="domicilio" type="text"  id="domicilio" onKeyPress="return verif_caracter(this,event)" value="<?echo $domicilio;?>"  size="25">                
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Puerta</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="puerta" type="text" id="puerta"onKeyPress="return verif_caracter(this,event)" value="<?echo $puerta;?>"  size="3">
      (N&uacute;mero)</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Referencia</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="referencia" type="text" id="referencia"onKeyPress="return verif_caracter(this,event)" value="<?echo $referencia;?>"  size="35">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo Postal</font></div></td>
    <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="cod_postal" type="text" id ="cod_postal" onKeyPress="return verif_caracter(this,event)" value="<?echo $cod_postal;?>" size="5">      
    </font></tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Localidad</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">
        </font>        <font size="2">
        </font>      </div>        
		
	<select name="localidad[]" id="localidad" onkeypress="return verif_caracter(this,event)">
	<optgroup label="Opcion Seleccionada">
	<option value selected= "<?ECHO $localidad;?>"> <?print("$localidad");?></option>
	</optgroup>
	<optgroup label="Cambiar por:">
    <option value="Ciudad">Ciudad</option>
    </optgroup>
    <optgroup label="Guaymallén">
    <option value ="Guaymallen">San Jose</option>
    <option value ="Guaymallen">Dorrego</option>
    <option value ="Guaymallen">Villa Nueva</option>
    <option value ="Guaymallen">Pedro Molina</option>
    <option value ="Guaymallen">Rodeo del Medio</option>
    <option value ="Guaymallen">Rodeo de la Cruz</option>
    </optgroup>
    <optgroup label="Godoy Cruz">
    <option value = "Godoy Cruz">Godoy Cruz</option>
    </optgroup>
    <optgroup label="Las Heras">
    <option value = "Las Heras">Las Heras</option>
   	</optgroup>
    </select></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(1)</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="caracteristica_1" type="text" id="caracteristica_1" onKeyPress="return verif_caracter(this,event)" value="<?echo $caracteristica_1;?>" size="7">
      <input name="telefono_1" type="text" id="telefono_1" onKeyPress="return verif_caracter(this,event)" value="<?echo $telefono_1;?>" size="10"> 
      (Fijo)                </font></td>
    </tr>
    <tr bordercolor="#FFFFFF"> 
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(2)</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF">        <font size="2" face="Arial, Helvetica, sans-serif">
      <input name="caracteristica_2" type="text" id="caracteristica_2" onKeyPress="return verif_caracter(this,event)" value="<?echo $caracteristica_2;?>" size="7">       
      <input name="telefono_2" type="text" id="telefono_2" onKeyPress="return verif_caracter(this,event)" value="<?echo $telefono_2;?>" size="10">
(Fijo)  </font>        <div align="right"></div>                  </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Telefono(3)</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="caracteristica_3" type="text" id="caracteristica_3" onKeyPress="return verif_caracter(this,event)" value="<?echo $caracteristica_3;?>" size="7">   
      <input name="telefono_3" type="text" id="telefono_3" onKeyPress="return verif_caracter(this,event)" value="<?echo $telefono_3;?>" size="12">
      (Celular)
      </font>        <div align="right"></div>
      <div align="left"> </div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Email</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="email" type="text" id="email" onKeyPress="return verif_caracter(this,event)" value="<?echo $email;?>" size="55">
      </font>
        <div align="right"></div>
      <div align="left"> </div></td>
    </tr>
</table>
  <br>  
<table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#000099">
      <td height="39" colspan="7"><font color="#FFFFff" face="Arial, Helvetica, sans-serif"><strong>CUIT - CONDICIONES DE VENTA </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CUIT</font></div></td>
      <td colspan="3" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input name="cuit" type="text" id="cuit" onKeyPress="return verif_caracter(this,event)" value="<?echo $cuit;?>" size ="15">
      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td width="28%" bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tipo de IVA </font></div></td>
      <td width="72%" colspan="3" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>

	  <?switch ($iva){
		  case "1":{
			  $iva = "Resp. Inscripto";
			  break;
		  }

		  case "2":{
			   $iva = "Monotributista";
			  break;
		  }

		  case "3":{
				$iva = "Exento";
			  break;
		  }

	  }
		  
		  
		  ?>
        <select name="iva[]" id="iva" onkeypress="return verif_caracter(this,event)">
		<optgroup label="Opcion Seleccionada">
			<option value selected= "<?"$iva";?>"> <?print("$iva1");?></option>
	</optgroup>
 <optgroup label="Cambiar por:">
   
		  <option value = "1">Resp. Inscripto </option>
          <option value = "3">Monotributo</option>
           <option value = "4">Exento</option>


        </select> 
		<optgroup>
      </strong>(codigo de la relacion con el IVA)</font></td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nro Ingresos Brutos </font></div></td>
      <td colspan="3" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
      <input name="ingresos_brutos" type="text" id="credito3" onKeyPress="return verif_caracter(this,event)" value="<?print("$ingresos_brutos");?>" size = "8">
      </strong>(codigo de inscripci&oacute;n) </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Credito $ </font></div></td>
      <td colspan="3" bgcolor="#E1F2EF"> <font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input name="credito" type="text" id="credito" onKeyPress="return verif_caracter(this,event)" value="<?echo $credito;?>" size = "8">
        </strong>(
M&aacute;ximo credito importe en pesos) </font>        <div align="right"></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#eeeeee">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Flete</font></div></td>
      <td colspan="3" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <select name="flete[]" id="flete" onkeypress="return verif_caracter(this,event)">
		<optgroup label="Opcion Seleccionada">
	<option value selected= "<?"$flete";?>"> <?print("$flete");?></option>
	</optgroup>
 <optgroup label="Cambiar por:">
          <option value = "Recarga">Recarga</option>
          <option value = "No Recarga">No Recarga</option>
          <option value = "">Cargo</option>
		  </optgroup>
        </select>

      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#eeeeee">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Observaciones</font></div></td>
      <td colspan="3" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input name="observaciones" type="text" id="observaciones" onKeyPress="return verif_caracter(this,event)" value="<?echo $observaciones;?>" size = "55">
      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#eeeeee">
      <td bgcolor="#C1F2FF"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Plan</font></div></td>
      <td colspan="3" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
        <input name="plan" type="text" id="observaciones3" onKeyPress="return verif_caracter(this,event)" value="<?echo $plan;?>" size = "2">
      </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td colspan="4"><div align="center">
          <font size="2" face="Arial, Helvetica, sans-serif">
          <input type="Submit" name="guardar" id= "guardar" value="GUARDAR CLIENTE NO ASOCIADO" target = "arriba">
      </font></div></td>
    </tr>
</table>
</form>
  
