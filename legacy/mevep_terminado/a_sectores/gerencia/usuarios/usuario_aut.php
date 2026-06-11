<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo2 {color: #000000}
.Estilo3 {font-size: 14px}
-->
</style>

<body>
<?php 

	include ("../../../conexiones/config.inc.php");

 echo $usuario=$_REQUEST['usuario'];


  $sql="select * from usuario where id = $usuario";
$result = $db->Execute($sql);
 
 $id=strtoupper($result->fields["id"]);
$usuario1=strtoupper($result->fields["usuario"]);
$contrasena=strtoupper($result->fields["contrasena"]);
$rol=strtoupper($result->fields["rol"]);
 $programa=strtoupper($result->fields["programa"]);

 $sql2="select * from datos_osde where cuenta_abm = $usuario";
$result2 = $db->Execute($sql2);

$prestador=strtoupper($result2->fields["prestador"]);
$cuit=strtoupper($result2->fields["cuit"]);
?>

<FORM  method="post" action="nuevo_usuario_aut.php">
   <table width="850" border="0"   >
    
    <tr bgcolor="#C4D7E6">
      <td height="36" colspan="2" bgcolor="#666666"><div align="center"><span class="Estilo9 Estilo7"><strong>MODIFICAR USUARIO </strong></span></div></td>
    </tr>
    <tr bgcolor="#C4D7E6">
      <td height="21" bgcolor="#FFFFCC"><div align="right">Prestador</div></td>
      <td height="21" bgcolor="#FFFFCC">	<?php echo $prestador;?>  <input name="id" type="hidden" value="<?php echo $usuario;?>">	  </td>
    </tr>
    <tr bgcolor="#C4D7E6">
      <td height="21" bgcolor="#FFFFCC"><div align="right"><span class="Estilo2">Contrase&ntilde;a</span> actual</div></td>
      <td height="21" bgcolor="#FFFFCC"><input name="contra_actual" type="password" id="contra_actual"  size="15"></td>
    </tr>
    <tr bgcolor="#C4D7E6">
      <td width="406" height="21" bgcolor="#FFFFCC"><div align="right" class="Estilo2">Contrase&ntilde;a  </div></td>
      <td width="434" height="21" bgcolor="#FFFFCC"><input name="contra_nueva" type="password" id="contra_nueva" size="15"></td>
    </tr>
    <tr bgcolor="#C4D7E6">
      <td height="21" bgcolor="#FFFFCC"><div align="right" class="Estilo2">Repita Contrase&ntilde;a </div></td>
      <td height="21" bgcolor="#FFFFCC"><input name="contra_repita" type="password" id="contra_repita" size="15"></td>
    </tr>

    
	 <tr bgcolor="#C4D7E6">
	   <td height="36" colspan="2" bgcolor="#666666"><div align="center">
	     <INPUT type="submit" name="submit" value="Guardar">
       </div></td>
     </tr>
  </table>
</form>

 



</body>
</html>
