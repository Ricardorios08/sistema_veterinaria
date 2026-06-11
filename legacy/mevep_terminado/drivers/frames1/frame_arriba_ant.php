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
-->
</style></head>
<body>


<form action="../../a_sectores/pacientes/buscar_paciente.php" method="post" target ="central">
  <table width="997" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="387" height="52"><div align="center" class="Estilo65">
        BUSCAR PACIENTE </div>          
          <div align="center">
          <input type = "text" name = "palabra" size = "30" />
          <input type = "submit" name = "ok" value = "OK" />
          <?php 

include ("../../conexiones/config.inc.php");
$usuario = $_REQUEST['usuario'];

 $sql="select * from datos_principales where id = $usuario";
$result = $db->Execute($sql);
$nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);


$sql = "SELECT * FROM archivos";
$result = $db->Execute($sql);
$id=$result->fields["id"];


$dia = date ("d");
$mes = date("m");
$anio = date("y");


?>
        </div></td>
        <td width="610" colspan="2"> 
        
          <div align="center">SELECCIONE</div>          <div align="center"><span class="Estilo65">Planillas
              <select name="planillas[]">
                <option value="1" selected="selected">Diaria</option>
                <option value="2">Mega</option>
				 <option value="3">Pacientes</option>
				 		 <option value="4">Practicas</option>
						 	 <option value="5">OS</option>

          </select>
Desde</span>
          <input name = "dia_d" type = "text" id="dia_d" size = "2" maxlength="2"   VALUE  = "<?php echo $dia;?>">
          /
          <input name = "mes_d" type = "text" id="mes_d" size = "2" maxlength="2" VALUE  = "<?php echo $mes;?>">
          20
          <input name = "anio_d" type = "text" id="anio_d" size = "2" maxlength="2" VALUE  = "<?php echo $anio;?>">
          <span class="Estilo65">Hasta</span>
          <input name = "dia_h" type = "text" id="dia_h" size = "2" maxlength="2" VALUE  = "<?php echo $dia;?>">
/
<input name = "mes_h" type = "text" id="mes_h" size = "2" maxlength="2" VALUE  = "<?php echo $mes;?>">
20
<input name = "anio_h" type = "text" id="anio_h" size = "2" maxlength="2" VALUE  = "<?php echo $anio;?>">

<input type = "hidden" name = "usuario" value="<?php echo $usuario;?>">
<input type = "submit" name = "ok2" value = "OK"/>
        </div></td>
      </tr>
  </table>	
<div id="menuh">
		<ul>
			 <li><a href="../../a_sectores/menu_pacientes.php?usuario=<?php print("$usuario");?>" target = "izquierda">PACIENTES</a></li> 
				
			<li><a href="../../a_sectores/auditoria/menu_practicas.php?usuario=<?php print("$usuario");?>" target = "izquierda">PRACTICAS</a></li>
<li><a href="../../a_sectores/auditoria/menu_modulos.php?usuario=<?php print("$usuario");?>" target = "izquierda">MODULOS</a></li>
			<li><a href="../../a_sectores/secretaria/secretaria.php?usuario=<?php print("$usuario");?>" target = "izquierda" >OBRAS SOCIALES</a></li>
	<li><a href="../../a_sectores/facturacion/facturacion.php?usuario=<?php print("$usuario");?>" target = "izquierda">FACTURACION</a></li> 
		<li><a href="../../a_sectores/derivaciones.php?usuario=<?php print("$usuario");?>" target = "izquierda">DERIVACIONES</a></li> 
	<li><a href="../../a_sectores/gerencia/estadisticas/estadistica.php?usuario=<?php print("$usuario");?>" target = "izquierda">ESTADISTICAS</a></li> 	
			<li><a href="../../a_sectores/gerencia/gerencia.php?usuario=<?php print("$usuario");?>" target = "izquierda">CONFIGURACION</a></li>
			<li><a href="../../validar/usuarios/agenda.php?usuario=<?php print("$usuario");?>" target="izquierda">AGENDA</a></li>
			<li><a href="../../index.php" target="_TOP">SALIR</a></li>
			
		</ul>
</div>


<table width="1002" border="0" cellpadding="0">
  <tr>
    <td width="588" height="34" valign="bottom"><span class="Estilo66"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LABORATORIO <?php echo $nombre_laboratorio;?></span></td>
    <td width="256" valign="bottom"><div align="right">
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
