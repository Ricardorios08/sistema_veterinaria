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

 $usuario=$_REQUEST['usuario'];


  $sql="select * from usuario where id = $usuario";
$result = $db->Execute($sql);
  $rol=$result->fields["rol"];

if ($rol == "ADMIN"){
?>

<FORM  method="post" action="nuevo_usuario.php">
   <table width="100%" border="0"   >
    
    <tr bgcolor="#C4D7E6">
      <td height="36" colspan="2" bgcolor="#666666"><div align="center"><span class="Estilo9 Estilo7"><strong>NUEVO USUARIO </strong></span></div></td>
    </tr>
    
    <tr bgcolor="#C4D7E6">
      <td height="21" bgcolor="#FFFFCC"><div align="right">Nombre Usuario </div></td>
      <td height="21" bgcolor="#FFFFCC"><input name="nombre" type="text" id="nombre"  size="15">
	  <input name="id" type="hidden" value="<?php echo $usuario;?>">	  </td>
    </tr>
    <tr bgcolor="#C4D7E6">
      <td width="406" height="21" bgcolor="#FFFFCC"><div align="right" class="Estilo2">Contrase&ntilde;a  </div></td>
      <td width="434" height="21" bgcolor="#FFFFCC"><input name="contra_nueva" type="text" id="contra_nueva" size="15"></td>
    </tr>
    <tr bgcolor="#C4D7E6">
      <td height="21" bgcolor="#FFFFCC"><div align="right" class="Estilo2">Repita Contrase&ntilde;a </div></td>
      <td height="21" bgcolor="#FFFFCC"><input name="contra_repita" type="text" id="contra_repita" size="15"></td>
    </tr>
    <tr bgcolor="#C4D7E6">
      <td height="21" bgcolor="#FFFFCC"><div align="right" class="Estilo2">Rol</div></td>
      <td height="21" bgcolor="#FFFFCC">
      
		<select name="rol[]" id="tipo_afiliado[]"onkeypress="return verif_caracter(this,event)">
		    <option value="ADMIN">ADMIN</option>
		    <optgroup label="SELECCIONADA"> </optgroup>
			<option value="TECNICA">TECNICA/O</option>
			<option value="VALIDACION">VALIDACION</option>
			</optgroup>
		</select>      </td>
    </tr>
    

	 <tr bgcolor="#C4D7E6">
	   <td height="36" colspan="2" bgcolor="#666666"><div align="center">
	     <INPUT type="submit" name="submit" value="Guardar">
       </div></td>
     </tr>
  </table>
  </form>

<?PHP }?>



<table width="100%" border="0">

 
  <tr bordercolor="#0066FF" bgcolor="#FFFFFF"> 
<td><div align="center" class="Estilo2"><font size="2" face="Arial, Helvetica, sans-serif">USUARIO </font></div></td>
<td><div align="center" class="Estilo2"><font size="2" face="Arial, Helvetica, sans-serif">CONTRASENA </font></div></td>
<td><div align="center" class="Estilo2"><font size="2" face="Arial, Helvetica, sans-serif">ROL</font></div></td>
<td><div align="center" class="Estilo2"><font size="2" face="Arial, Helvetica, sans-serif">CAMBIAR</font></div></td>
  <tr bordercolor="#0066FF" bgcolor="#FFFFFF">
    <td height="17"><hr noshade></td>
    <td><hr noshade></td>
    <td colspan="2" valign="top"><hr noshade></td>



    <?php 




 $sql="select * from usuario order by rol";
$result = $db->Execute($sql);



if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
	
 $id=strtoupper($result->fields["id"]);
$usuario1=strtoupper($result->fields["usuario"]);
$contrasena=strtoupper($result->fields["contrasena"]);
$rol=strtoupper($result->fields["rol"]);


?>
  <tr bordercolor="#FFFFFF"> 
<td><div align="center"><?php print("$usuario1");?></div></td>
<td><div align="left">********* </div></td>

<td><div align="center"><?php print("$rol");?></div></td>
<td><div align="center"><a href="cambiar.php?id1=<?php print("$id");?>&&usuario=<?php print("$usuario");?>" onClick="return confirm('&iquest;Est&aacute; seguro de Editar el usuario?');"><img src="../../../imagenes/office//951.ico" alt="Borrar" border = "0"></a></div></td>



<?php 





$result->MoveNext();
	}



?>

</table>

</body>
</html>
