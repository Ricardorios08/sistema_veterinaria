<script language="javascript">
function on_load()
{
document.getElementById("usuario").focus();
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
				document.getElementById("contrasena").focus();
				break;
				case "contrasena":
				document.getElementById("rol").focus();
				break;
				case "rol":
				document.getElementById("nombre").focus();
				break;
				case "nombre":
				document.getElementById("guardar").focus();
				break;
		}
		return false;
	}
	return true;
}
</script>
<BODY background="../../../imagenes/logito.png" onload = "on_load ()">
<FORM name="form" ACTION="guardar_usuario.php" METHOD = "POST">
<table width="850" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666">
      <td height="31" colspan="3"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>ALTA DE USUARIO </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td width="36%" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Usuario</font>
      </div></td>
      <td width="64%" colspan="2" bgcolor="#9FE1BB"><input type="text" name="usuario" id="usuario" size="15" onKeyPress="return verif_caracter(this,event)">
      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#A0A7F5"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Contraseña</font> </div></td>
      <td colspan="2" bgcolor="#9FE1BB"><input type="password" name="contrasena" id="contrasena"  size="10" onKeyPress="return verif_caracter(this,event)">      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#A0A7F5"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Rol</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB">
        <select name="rol" id="rol" onkeypress="return verif_caracter(this,event)">
          <option value="admin">Admin</option>
          <option value="veterinario">Veterinario</option>
       
        </select>
      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre Completo</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><input type="text" name="nombre"  id="nombre"  size="50" onKeyPress="return verif_caracter(this,event)">
      </td>
    </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#CCCCCC">
    <td colspan="3"><div align="center">
      <input type="Submit" name="Submit" value="GUARDAR" id = "guardar">
    </div></td>
  </tr>
</table>