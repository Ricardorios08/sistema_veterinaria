<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="../../menus.css" />
<title>Men? Principal (ADMINISTRADOR)</title>
<style type="text/css">
<!--
body {
	background-image: url(../../imagenes/celeste.jpg);
	background-repeat: no-repeat;
}
.Estilo65 {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-weight: bold;
}
.Estilo66 {
	font-family: "Trebuchet MS";
	font-size: 12px;
	color: #FFFFFF;
}
.Estilo2 {font-family: "Trebuchet MS"; font-size: 12px; }
.Estilo67 {color: #FFFFFF}
-->
</style>


<script language="javascript">
<!--




function on_load()
{
document.getElementById("palabra").focus();
}


function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "usuario5":
				document.getElementById("password3").focus();
				
				break;
				case "password3":
				document.getElementById("entrar").focus();
				break;
			
		}
		return false;
	}
	return true;
}




</script>



</head>


<BODY onLoad="on_load()" > 


<form action="../../a_sectores/pacientes/buscar_paciente.php" method="post" target ="central">

<?php

include ("../../conexiones/config.inc.php");
$usuario = $_REQUEST['usuario'];
$CARATULA1=$_REQUEST["CARATULA1"];
$palabra=$_REQUEST["palabra"];


?>
<div id="menuh">
		<ul>
<li><a href="../../a_sectores/pacientes.php?usuario=<?php print("$usuario");?>" target = "izquierda">PACIENTES</a></li> 
<!--<li><a href="../../a_sectores/auditoria/menu_practicas.php?usuario=<?php print("$usuario");?>" target = "izquierda">PRACTICAS</a></li>
<li><a href="../../a_sectores/auditoria/menu_modulos.php?usuario=<?php print("$usuario");?>" target = "izquierda">MODULOS</a></li>
<li><a href="../../a_sectores/secretaria/secretaria.php?usuario=<?php print("$usuario");?>" target = "izquierda" >OBRAS SOCIALES</a></li>
 <li><a href="../../a_sectores/facturacion/facturacion.php?usuario=<?php print("$usuario");?>" target = "izquierda">FACTURACION</a></li>  
<li><a href="../../a_sectores/derivaciones.php?usuario=<?php print("$usuario");?>" target = "izquierda">DERIVACIONES</a></li> 
<li><a href="../../a_sectores/gerencia/estadisticas/estadistica.php?usuario=<?php print("$usuario");?>" target = "izquierda">ESTADISTICAS</a></li> 	
<li><a href="../../a_sectores/gerencia/gerencia_aut.php?usuario=<?php print("$usuario");?>" target = "izquierda">CONFIGURACION</a></li>
<!-- <li><a href="../../validar/usuarios/agenda.php?usuario=<?php print("$usuario");?>" target="izquierda">AGENDA</a></li> -->
<li><a href="" target="_TOP">SALIR</a></li>
			
		</ul>
</div>
</table>


</FORM>

 
  <input type="hidden" name="usuario"  value="<?php echo $usuario;?>">
  <input type="hidden" name="palabra"  value="<?php echo $palabra;?>"> </td>
    <td width="300" valign="bottom"><div align="right">
      <object classid="clsid:166B1BCA-3F9C-11CF-8075-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=8,5,0,0" width="300" height="20" align="middle" accesskey="q" title="Diseño y Programación Ricardo E. Rios Rolla">
        <param name="src" value="../../imagenes/ricardo.swf" />
        <param name="wmode" value="transparent" />
        <embed src="../../imagenes/ricardo.swf" width="300" height="20" align="middle" pluginspage="http://www.macromedia.com/shockwave/download/" wmode="transparent"></embed>
      </object>
    </div></td>
  </tr>
</table>

</form>
</body>
</html>
