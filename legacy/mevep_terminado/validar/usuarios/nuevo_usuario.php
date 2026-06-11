<script language="javascript">
function on_load()
{
document.getElementById("matricula").focus();
}

function pagina2()
{
document.getElementById("titulo").focus();
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "usuario":
				document.getElementById("rol").focus();
				
				break;
				case "rol":
				document.getElementById("password").focus();
				break;
				case "password":
				document.getElementById("password_conf").focus();
				break;
				case "password_conf":
				document.getElementById("password_admin").focus();
				break;
				case "password_admin":
				document.getElementById("apellido").focus();
				break;
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

				
				



				
		}
		return false;
	}
	return true;
}


</script>

<link href="FONDO.css" rel="stylesheet" type="text/css">

<BODY><CENTER><TABLE WIDTH="90%" BORDER=0><TR><TD>  
<FORM ACTION="../../validar/usuarios/guardar_usuario.php" method="post" TARGET = "izquierda">

  <div align="left"><font size="1"> </font>
  </div>
  <table width="51%" height="444" border="0">
      <tr bgcolor="#CCCCCC">
        <td height="24" colspan="2"><div align="center"><strong>Perfil de Usuarios </strong></div>          <div align="center"></div></td>
        </tr>
      <tr bgcolor="#ECFCBC"> 
        <td width="56%" height="24"><div align="right">Nombre de Usuario</div></td>
        <td width="44%"> 
            <div align="left">
              <input type="text" name="usuario" size = "15" id="" onKeyPress="return verif_caracter(this,event)"> 
            </div></td>
      </tr>
      <tr bgcolor="#ECFCBC">
        <td height="24"><div align="right">Sector</div></td>
        <td><select name="rol" id="rol" onkeypress="return verif_caracter(this,event)">

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
		  
		  
        </select></td>
      </tr>
      <tr bgcolor="#ECFCBC">
        <td height="24"><div align="right">Contrase&ntilde;a</div></td>
        <td>
          <div align="left">
            <input type="password" name="password" size = "10" id="" onKeyPress="return verif_caracter(this,event)"> 
          </div></td>
      </tr>
      <tr bgcolor="#ECFCBC"> 
        <td height="24"><div align="right">Confirmar Contraseña</div></td>
        <td> 
            <div align="left">
              <input type="password_conf" name="password_conf" size = "10" id="" onKeyPress="return verif_caracter(this,event)"> 
            </div></td>
      </tr>
      <tr bgcolor="#ECFCBC">
        <td height="24"><div align="right">Contrase&ntilde;a Administrador </div></td>
        <td><input type="password_admin" name="password_admin" size = "10" id="" onKeyPress="return verif_caracter(this,event)"> </td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="24" colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td height="24" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>Datos Personales </strong></div></td>
        </tr>
      <tr bgcolor="#E0FCE6">
        <td height="24"><div align="right">Apellido</div></td>
        <td><input type="text" name="apellido" size = "15" id="" onKeyPress="return verif_caracter(this,event)"> </td>
      </tr>
      <tr bgcolor="#E0FCE6">
        <td height="24"><div align="right">Nombre</div></td>
        <td><input type="text" name="nombre" size = "15" id="" onKeyPress="return verif_caracter(this,event)"> </td>
      </tr>
      <tr bgcolor="#E0FCE6">
        <td height="24"><div align="right">Direcci&oacute;n</div></td>
        <td><input type="text" name="direccion" size = "25" id="" onKeyPress="return verif_caracter(this,event)"> </td>
      </tr>
      <tr bgcolor="#E0FCE6">
        <td height="24"><div align="right">Telefono</div></td>
        <td><input type="text" name="telefono" size = "15" id="" onKeyPress="return verif_caracter(this,event)"> </td>
      </tr>
      <tr bgcolor="#E0FCE6">
        <td height="24"><div align="right">Celular</div></td>
        <td><input type="text" name="celular" size = "15" id="" onKeyPress="return verif_caracter(this,event)"> </td>
      </tr>
      <tr bgcolor="#E0FCE6">
        <td height="24"><div align="right">E-mail</div></td>
        <td><input type="text" name="email" size = "35" id="" onKeyPress="return verif_caracter(this,event)"> </td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <td height="24" colspan="2">
          <div align="center">
          <input type="Submit" name="bLogin" value="Registrarse">
          <input type="button" name="logout" value="Logout">
          </div></td>
        </tr>
  </table>
</form>

</body>