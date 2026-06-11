<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="../../menus.css" />
<title>Men? Principal (ADMINISTRADOR)</title>
<style type="text/css">
<!--
body {
	
		background-image: url(../../imagenes/celeste_nuevo.jpg);
	background-repeat: repeat;
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
<table width="966" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="349" height="52" rowspan="2"><div align="center" class="Estilo65"> BUSCAR PACIENTE </div>
        <div align="center">
          <input type = "text" name = "palabra2" size = "27"  id = "palabra" / value = "<?php echo $palabra?>" />
          <input type = "submit" name = "ok" value = "OK" />
          <input type = "submit" name = "ok" value = "PRO" />
          <?php 



if ($CARATULA1 == "CARATULA"){
 
$modelo=$_REQUEST["modelo"];
 
 //$sql = "UPDATE `ei000052_laboratorio`.`informe` SET `modelo` = '$modelo' where id = '$usuario' LIMIT 1;";
 $sql = "UPDATE `informe` SET `modelo` = '$modelo' where id = '$usuario' LIMIT 1;";


mysql_query($sql);

}






 $sql="select * from datos_principales where id = $usuario";
$result = $db->Execute($sql);
$nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);


$sql = "SELECT * FROM archivos";
$result = $db->Execute($sql);
$id=$result->fields["id"];

$sql="select * from informe where id = $usuario";
 $result = $db->Execute($sql);

$caratula=strtoupper($result->fields["caratula"]);
$hoja=strtoupper($result->fields["hoja"]);
$firma=strtoupper($result->fields["firma"]);
$modelo=strtoupper($result->fields["modelo"]);



$dia = date ("d");
$mes = date("m");
$anio = date("y");


?>
      </div></td>
    <td width="59"><div align="center"><span class="Estilo65">Tipo</span></div></td>
    <td width="558"><span class="Estilo65">
      <select name="planillas[]">
        <option value="1" selected="selected">Busqueda Diaria</option>
        <option value="6">Busqueda x Protocolo</option>
        <option value="2">Planilla Megalaboratorio</option>
        <option value="3">Listado de Pacientes</option>
        <option value="4">Ocurrencias x Practicas</option>
        <option value="5">Ocurrencias x Obras Sociales</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td><div align="center"><span class="Estilo65">Desde</span></div></td>
    <td><input name = "dia_d" type = "text" id="dia_d" size = "2" maxlength="2"   value  = "<?php echo $dia;?>" />
      /
      <input name = "mes_d" type = "text" id="mes_d" size = "2" maxlength="2" value  = "<?php echo $mes;?>" />
      20
      <input name = "anio_d" type = "text" id="anio_d" size = "2" maxlength="2" value  = "<?php echo $anio;?>" />
      <span class="Estilo65">Hasta</span>
      <input name = "dia_h" type = "text" id="dia_h" size = "2" maxlength="2" value  = "<?php echo $dia;?>" />
      /
      <input name = "mes_h" type = "text" id="mes_h" size = "2" maxlength="2" value  = "<?php echo $mes;?>" />
      20
      <input name = "anio_h" type = "text" id="anio_h" size = "2" maxlength="2" value  = "<?php echo $anio;?>" />
      <input type = "hidden" name = "usuario2" value="<?php echo $usuario;?>" />
      <input type = "submit" name = "ok2" value = "OK"/></td>
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
			<li><a href="http://www.bioquimicosmendoza.com.ar" target="_TOP">SALIR</a></li>
			
		</ul>
</div>
</table>


</FORM>

  <table width="850" border="0" cellpadding="0" cellspacing="0">
<form action="frame_arriba.php" method="post" target ="arriba">

  <tr>
    <td width="850" height="34" valign="bottom"><span class="Estilo66">  
      <?php switch ($modelo){

		  case "A":{?>
</span>      <div align="left" class="Estilo66">
        <input name="modelo" type="radio" value="A" checked="checked" />
  PROSALUD
  <input name="modelo" type="radio" value="B" />
  MONTES
  <input name="modelo" type="radio" value="C" />
  FLORIDA
  <input name="modelo" type="radio" value="D" />
  BRINDAR 
  <input name = "CARATULA1" type = "submit" id="CARATULA1" value = "CARATULA"/>
      </div>
      <div align="left" class="Estilo66"></div>
      <div align="left" class="Estilo66"></div>
      <div align="left" class="Estilo66"></div>
      <span class="Estilo67">
      <?php break;}


		  case "B":{?>      
      </span>
      <div align="left" class="Estilo66">
        <input name="modelo" type="radio" value="A"  />
PROSALUD
<input name="modelo" type="radio" value="B" checked="checked"/>
MONTES
<input name="modelo" type="radio" value="C" />
FLORIDA
<input name="modelo" type="radio" value="D" />
BRINDAR
<input name = "CARATULA1" type = "submit" id="CARATULA1" value = "CARATULA"/>
      </div>
      <div align="left" class="Estilo66"></div>
      <div align="left" class="Estilo66"></div>
      <div align="left" class="Estilo66"></div>
      <span class="Estilo67">
      <?php break;}

		  case "C":{?>      
      </span>
      <div align="left" class="Estilo66">
        <input name="modelo" type="radio" value="A" />
PROSALUD
<input name="modelo" type="radio" value="B" />
MONTES
<input name="modelo" type="radio" value="C" checked="checked"  />
FLORIDA
<input name="modelo" type="radio" value="D" />
BRINDAR
<input name = "CARATULA1" type = "submit" id="CARATULA1" value = "CARATULA"/>
      </div>
      <div align="left" class="Estilo66"></div>
      <div align="left" class="Estilo66"></div>
      <div align="left" class="Estilo66"></div>
      <span class="Estilo67">
      <?php break;}

		  case "D":{?>      
      </span>
      <div align="left" class="Estilo66">
        <input name="modelo" type="radio" value="A"   />
PROSALUD
<input name="modelo" type="radio" value="B" />
MONTES
<input name="modelo" type="radio" value="C" />
FLORIDA
<input name="modelo" type="radio" value="D" checked="checked"  />
BRINDAR
<input name = "CARATULA1" type = "submit" id="CARATULA1" value = "CARATULA"/>
      </div>
      <div align="left" class="Estilo66"></div>
      <div align="left" class="Estilo66"></div>
      <div align="left" class="Estilo66"></div>
      <span class="Estilo67">
      <?php break;}





 case "":{?>      
      </span>
      <div align="left" class="Estilo66">
        <input name="modelo" type="radio" value="A" checked="checked" />
PROSALUD
<input name="modelo" type="radio" value="B" />
MONTES
<input name="modelo" type="radio" value="C" />
FLORIDA
<input name="modelo" type="radio" value="D" />
BRINDAR
<input name = "CARATULA1" type = "submit" id="CARATULA1" value = "CARATULA"/>
      </div>
      <div align="left" class="Estilo2"></div>
      <div align="left" class="Estilo2"></div>
      <div align="left" class="Estilo2"></div>
      <?php break;}

	


 }?>
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
