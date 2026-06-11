<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="../../menus.css" />
<title>Men? Principal (ADMINISTRADOR)</title>
<style type="text/css">
<!--
body {
	background-image: url(../../imagenes/celeste_nuevo_sulb.jpg);
	background-repeat: repeat-x;
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


<form action="../../a_sectores/autorizacion/buscar_paciente_archivo.php"  method="post" target ="central">
  <table width="808" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="172" height="52"><div align="center" class="Estilo65">
        ORDENES INGRESADAS </div>          
          <div align="center">
          <input type = "text" name = "palabra" size = "12" />
          <input type = "submit" name = "ok" value = "OK" />
          <?php 

include ("../../conexiones/config.inc.php");

 $sql="select * from datos_principales";
$result = $db->Execute($sql);
$nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);


$sql = "SELECT * FROM archivos";
$result = $db->Execute($sql);
$id=$result->fields["id"];


$dia = date ("d");
$mes = date("m");
$anio = date("y");
$anio_a = date("y");


$mes_a = date("m") - 1;

IF ($mes_a < 1){
$anio_a = $anio_a - 1;
$mes_a = 12;
}




?>
        </div></td>
        <td colspan="2"> 
        
          <div align="center">SELECCIONE</div>          <div align="center"><span class="Estilo65">Planillas
              <select name="planillas[]">
                <option value="1" selected="selected">Diaria</option>
                <option value="2">Mega</option>
				 <option value="3">Pacientes</option>
				 		 <option value="4">Practicas</option>
						 	 <option value="5">OS</option>

          </select>
Desde</span>
          <input name = "dia_d" type = "text" id="dia_d" size = "2" maxlength="2"   VALUE  = "21">
          /
          <input name = "mes_d" type = "text" id="mes_d" size = "2" maxlength="2" VALUE  = "<?php echo $mes_a;?>">
          20
          <input name = "anio_d" type = "text" id="anio_d" size = "2" maxlength="2" VALUE  = "<?php echo $anio_a;?>">
          <span class="Estilo65">Hasta</span>
          <input name = "dia_h" type = "text" id="dia_h" size = "2" maxlength="2" VALUE  = "20">
/
<input name = "mes_h" type = "text" id="mes_h" size = "2" maxlength="2" VALUE  = "<?php echo $mes;?>">
20
<input name = "anio_h" type = "text" id="anio_h" size = "2" maxlength="2" VALUE  = "<?php echo $anio;?>">
<input type = "submit" name = "OK" value = "OK"/>
          </div></td>
      </tr>
  </table>	
<div id="menuh">
		<ul>
			 <!-- <li><a href="../../a_sectores/menu_pacientes.php" target = "izquierda">PACIENTES</a></li>  -->
				
			<li><a href="../../a_sectores/auditoria/menu_practicas.php" target = "izquierda">NOMENCLADORES</a></li>
<!-- <li><a href="../../a_sectores/auditoria/menu_modulos.php" target = "izquierda">MODULOS</a></li> -->
			<li><a href="../../a_sectores/secretaria/secretaria.php" target = "izquierda" >OBRAS SOCIALES</a></li>


	<!-- <li><a href="../../a_sectores/facturacion/facturacion.php" target = "izquierda">FACTURACION</a></li> 
	<li><a href="../../a_sectores/gerencia/estadisticas/estadistica.php" target = "izquierda">ESTADISTICAS</a></li> 	
			<li><a href="../../a_sectores/gerencia/gerencia.php" target = "izquierda">CONFIGURACION</a></li>
			<li><a href="../../validar/usuarios/agenda.php" target="izquierda">AGENDA</a></li> -->
			<li><a href="../../index.php" target="_TOP">SALIR</a></li>
			
		</ul>
</div>


<table width="750" border="0" cellpadding="0">
  <tr>
    <td width="459" height="59" valign="bottom"><span class="Estilo66"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  $nombre_laboratorio;?></span></td>
    <td width="537" valign="bottom"><div align="right">
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
