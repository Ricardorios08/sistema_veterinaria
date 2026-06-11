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
<?php
// Assuming 'id' is passed as a GET parameter to identify the user to modify
$id = $_REQUEST['id'];

// --- Start of placeholder for 'variables.php' content for user data ---
// In a real application, you would fetch user data from the database here.
// For demonstration, let's mock some data.
// Replace this with your actual database query to get user details by $id
/*
include ("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM usuario WHERE id = " . intval($id);
$result = mysql_query($sql); // or use mysqli/PDO
if ($row = mysql_fetch_assoc($result)) { // or mysqli_fetch_assoc/PDO fetch
    $usuario_val = $row['usuario'];
    $contrasena_val = $row['contrasena']; // Be cautious with displaying passwords directly
    $rol_val = $row['rol'];
    $nombre_val = $row['nombre'];
} else {
    // Handle case where user is not found, e.g., redirect or show error
    $usuario_val = '';
    $contrasena_val = '';
    $rol_val = '';
    $nombre_val = '';
}
*/

// Placeholder values for demonstration purposes
$usuario_val = "john.doe";
$contrasena_val = "password123"; // In a real app, don't pre-fill passwords or handle securely
$rol_val = "Editor";
$nombre_val = "John Doe";
// --- End of placeholder for 'variables.php' content ---
?>
<BODY background="../../../imagenes/logito.png" onload = "on_load ()">
<FORM name="form" ACTION="modificar_usuario.php" METHOD = "POST">
<table width="850" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666">
      <td height="31" colspan="3"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>MODIFICAR USUARIO </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td width="36%" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">ID de Usuario</font>
      </div></td>
      <td width="64%" colspan="2" bgcolor="#9FE1BB"><input type="text" name="id" id="id" value = "<?php echo htmlspecialchars($id);?>" size="5" readonly>
      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Usuario</font>
      </div></td>
      <td colspan="2" bgcolor="#9FE1BB"><input type="text" name="usuario" id="usuario" value="<?php echo htmlspecialchars($usuario_val);?>" size="15" onKeyPress="return verif_caracter(this,event)">
      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#A0A7F5"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Contraseña</font> </div></td>
      <td colspan="2" bgcolor="#9FE1BB"><input type="password" name="contrasena" id="contrasena" value="<?php echo htmlspecialchars($contrasena_val);?>" size="10" onKeyPress="return verif_caracter(this,event)">      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#A0A7F5"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Rol</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB">
        <select name="rol" id="rol" onkeypress="return verif_caracter(this,event)">
          <option value="Administrador" <?php if ($rol_val == "Administrador") echo "selected"; ?>>Administrador</option>
          <option value="Editor" <?php if ($rol_val == "Editor") echo "selected"; ?>>Editor</option>
          <option value="Visor" <?php if ($rol_val == "Visor") echo "selected"; ?>>Visor</option>
        </select>
      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E1F2EF">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre Completo</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><input type="text" name="nombre"  id="nombre" value="<?php echo htmlspecialchars($nombre_val);?>" size="50" onKeyPress="return verif_caracter(this,event)">
      </td>
    </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#CCCCCC">
    <td colspan="3"><div align="center">
      <input type="Submit" name="Submit" value="GUARDAR CAMBIOS" id = "guardar">
    </div></td>
  </tr>
</table>
</FORM>