<?php

// The 'a' variable seems to control the path to 'logito.png'.
// Ensure it's set appropriately before this script is included or accessed.
// For example, it might be passed as a GET or POST parameter, or set in a config file.
// If 'a' is not set, it might cause an undefined variable notice.
$a = isset($a) ? $a : null; // Initialize $a to avoid undefined variable notice

if ($a == 1){
?><body background="../../imagenes/logito.png"><?php
}
else
{
?><body background="../imagenes/logito.png"><?php
}

// Ensure $refre is set if it's meant to be used for conditional assignment
$refre = isset($refre) ? $refre : null;

global $buscador_rapido; // This global declaration might not be necessary depending on usage

if ($refre != "SI"){
    // Ensure 'buscador_rapido' is available in $_POST if this branch is taken
    $buscador_rapido = isset($_POST["buscador_rapido"]) ? $_POST["buscador_rapido"] : "";
} else {
    // If $refre is "SI" and $buscador_rapido is not defined, it could lead to issues.
    // Consider how $buscador_rapido should be initialized or re-used in this case.
    // For now, it will retain its value from a previous scope if globally defined.
}


$hoy = date("d/m/y");
include("../../conexiones/config_pro.php"); // Assuming this file establishes $db connection


$palabra = isset($_POST["busca"]) ? $_POST["busca"] : "";

// Build the SQL query for searching users
if ($palabra == ""){
    $sql="SELECT id, usuario, rol, nombre FROM usuario ORDER BY id, usuario";
} else {
    // Search by id, usuario, rol, or nombre
    $sql="SELECT id, usuario, rol, nombre FROM usuario WHERE id LIKE '%$palabra%' OR usuario LIKE '%$palabra%' OR rol LIKE '%$palabra%' OR nombre LIKE '%$palabra%' ORDER BY id ASC";
}

$result = $db->Execute($sql); // Execute the query
?>
<table width="850" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="7"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE USUARIOS . Emitido el <?php echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#000099">

    <td width="71"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>ID</strong></font></div></td>
    <td width="200"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>USUARIO</strong></font></div></td>
    <td width="200"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>NOMBRE COMPLETO</strong></font></div></td>
    <td width="133"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>ROL</strong></font></div></td>
    <td width="55"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>MODIFICAR </strong></font></div></td>
    <td width="47"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>ELIMINAR </strong></font></div></td>
    <td width="36"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><strong>FICHA </strong></font></div></td>
  </tr>

 <?php

  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

    $id = htmlspecialchars($result->fields["id"]);
    $usuario = htmlspecialchars(strtoupper($result->fields["usuario"]));
    $nombre = htmlspecialchars(strtoupper($result->fields["nombre"]));
    $rol = htmlspecialchars(strtoupper($result->fields["rol"]));

?>

  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">

    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php print("$id");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="left"><font size="2"><?php print("$usuario");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="left"><font size="2"><?php print("$nombre");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?php print("$rol");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="usuarios/modificar_usuario.php?id=<?php print("$id");?>"><IMG SRC="../../imagenes/office/027.ico" alt="Modificar" border = "0"></a></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="usuarios/borra_usuario.php?id=<?php print("$id");?>"><IMG SRC="../../imagenes/office/1047.ico" alt="Eliminar" border = "0"></a></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#E8DCFC"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"> <a href="usuarios/ficha_usuario.php?id=<?php print("$id");?>"><IMG SRC="../../imagenes/office/005.ico" alt="Ficha" border = "0"></a></font></div></td>
  </tr>
  <?php

$result->MoveNext();
    }

?>
</table>