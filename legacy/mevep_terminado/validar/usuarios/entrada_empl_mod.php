<link href="../../css/fondo.css" rel="stylesheet" type="text/css" />

<?php 
$id = $_REQUEST['id'];
include ("variables.php");
?>


<script language="javascript">
function on_load()
{
document.getElementById("apellido").focus();
}



function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				
				case "apellido":
				document.getElementById("nombre").focus();
				break;
				case "nombre":
				document.getElementById("direccion").focus();
				break;
				case "direccion":
				document.getElementById("telefono").focus();
				break;
				case "telefono":
				document.getElementById("celular").focus();
				break;
				case "celular":
				document.getElementById("email").focus();
				break;
								case "email":
				document.getElementById("interno").focus();
				break;
								case "interno":
				document.getElementById("sector").focus();
				break;
								case "sector":
				document.getElementById("puesto").focus();
				break;

								case "puesto":
				document.getElementById("mes").focus();
				break;

								case "mes":
				document.getElementById("anio").focus();
				break;

				case "anio":
				document.getElementById("guardar").focus();
				break;
				



				
		}
		return false;
	}
	return true;
}


</script>


<BODY onload = "on_load ()">
<FORM ACTION="../../validar/usuarios/guardar_empl_mod.php" method="post" TARGET = "central">


  <table width="800" height="314" border="0">
      <tr>
        <td height="24" colspan="2" bgcolor="#CCCCCC"><div align="center"><img src="../../imagenes/agendas.jpg" width="846" height="35"></div></td>
        </tr>
      <tr>
        <td width="46%" height="24"><div align="right">Apellido</div></td>
        <td width="54%"><input name="apellido" type="text" id="apellido" onKeyPress="return verif_caracter(this,event)" value="<?php echo $apellido;?>" size = "15"> </td>
      </tr>
      <tr>
        <td height="24"><div align="right">Nombre</div></td>
        <td><input name="nombre" type="text" id="nombre" onKeyPress="return verif_caracter(this,event)" value="<?php echo $nombre;?>" size = "15"> </td>
      </tr>
      <tr>
        <td height="24"><div align="right">Direcci&oacute;n</div></td>
        <td><input name="direccion" type="text" id="direccion" onKeyPress="return verif_caracter(this,event)" value="<?php echo $direccion;?>" size = "45"> </td>
      </tr>
      <tr>
        <td height="24"><div align="right">Telefono</div></td>
        <td><input name="telefono" type="text" id="telefono" onKeyPress="return verif_caracter(this,event)" value="<?php echo $telefono;?>" size = "15"> </td>
      </tr>
      <tr>
        <td height="24"><div align="right">Celular</div></td>
        <td><input name="celular" type="text" id="celular" onKeyPress="return verif_caracter(this,event)" value="<?php echo $celular;?>" size = "15"> </td>
      </tr>
      <tr>
        <td height="24"><div align="right">E-mail</div></td>
        <td><input name="email" type="text" id="email" onKeyPress="return verif_caracter(this,event)" value="<?php echo $email;?>" size = "45"> </td>
      </tr>
      <tr>
        <td height="24"><div align="right">Interno</div></td>
        <td><input name="interno" type="text" id="interno" onKeyPress="return verif_caracter(this,event)" value="<?php echo $interno;?>" size = "4"></td>
      </tr>
      <tr>
        <td height="24"><div align="right">Sector de Trabajo </div></td>
        <td><select name="sector[]" id="sector" onkeypress="return verif_caracter(this,event)">
<optgroup label = "Opción seleccionada">
<option value selected= "<?php "$sector";?>"> <?php print("$sector");?></option>
</optgroup>
<optgroup label = "Cambiar por:">
          <option value="Otro">Otro</option>
		  <option value="Secretaria">Secretaria</option>
		   <option value="Recepcion">Recepcion</option>
		   <option value="Grabacion">Grabacion</option>
          <option value ="Auditoria">Auditoria</option>
          <option value ="Contaduria">Baja</option>
          <option value ="Liquidacion">Liquidacion</option>
          <option value ="Tesoreria">Tesoreria</option>
		  <option value ="Gerencia">Gerencia</option>
          <option value ="Facturacion">Facturacion</option>
		  <option value ="Proveeduria">Proveeduria</option>
  		  <option value ="Mensajeria">Mensajeria</option>
</optgroup>		  
		  
        </select></td>
      </tr>
      <tr>
        <td height="24"><div align="right">Puesto</div></td>
        <td><input name="puesto" type="text" id="puesto" onKeyPress="return verif_caracter(this,event)" value="<?php echo $puesto;?>" size = "45"></td>
      </tr>
      <tr>
        <td height="24"><div align="right">Cumplea&ntilde;os</div></td>
        <td><input name="mes" type="text" id="mes" onKeyPress="return verif_caracter(this,event)" value="<?php echo $mes;?>" size = "2">
          /
          <input name="anio" type="text" id="anio" onKeyPress="return verif_caracter(this,event)" value="<?php echo $anio;?>" size = "2"></td>
      </tr>
      <tr>
        <td height="24" colspan="2">          <div align="center">
<input type="hidden" name="id" value="<?php echo $id;?>">
          <input type="Submit" name="bLogin" value="Guardar Modificación" id="guardar">
          </div></td>
        </tr>
  </table>
</form>

</body>