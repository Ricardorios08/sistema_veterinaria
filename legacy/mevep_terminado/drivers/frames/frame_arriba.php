<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="../../menus.css" />
	<link href="../../css/botonera.css" rel="stylesheet" type="text/css" />
<title>Men? Principal (ADMINISTRADOR)</title>
<style type="text/css">
<!--
body {
	background-image: url(../../imagenes/cuadrado.jpg);
	background-repeat: repeat-x;
}
.Estilo47 {
	font-family: "Trebuchet MS";
	font-weight: bold;
}
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


<BODY onLoad="on_load()" class="degrade"> 

<?php

include ("../../conexiones/config.inc.php");
 $usuario = $_REQUEST['usuario'];
$CARATULA1=$_REQUEST["CARATULA1"];
$palabra=$_REQUEST["palabra"];

 $sql="select * from usuario where id = $usuario";
$result = $db->Execute($sql);

$rol=$result->fields["rol"];
$nombre=strtoupper($result->fields["usuario"]);
$contrasena=$result->fields["contrasena"];
 $usuario1 = $nombre." / ".$rol;

?>


<div id="menuh">
		<ul>
			<li><a href="../../a_sectores/facturacion/facturacion.php?usuario=<?php print("$usuario");?>" target = "izquierda">SOCIOS</a></li>
				<li><a href="../../a_sectores/menu_turnos.php?usuario=<?php print("$usuario");?>" target = "izquierda">TURNOS</a></li>
				
				<!-- <li><a href="../../a_sectores/facturacion_old/facturacion.php" target = "izquierda">EPSON</a></li>
			
			<li><a href="../../a_sectores/facturacion/facturacion2.php" target = "izquierda">RECIBO IND</a></li> -->

			<li><a href="../../a_sectores/pagos/pagos.php?usuario=<?php print("$usuario");?>" target = "izquierda">PAGOS</a></li>


			<li><a href="../../a_sectores/proveeduria/ventas.php?usuario=<?php print("$usuario");?>" target = "izquierda">VENTAS</a></li>
			<li><a href="../../a_sectores/proveeduria/compras.php?usuario=<?php print("$usuario");?>" target = "izquierda" > COMPRAS </a></li>
			<li><a href="../../a_sectores/proveeduria/procesos.php?usuario=<?php print("$usuario");?>" target = "izquierda">PROCESOS</a></li>
			<li><a href="../../a_sectores/proveeduria/info+.php?usuario=<?php print("$usuario");?>" target = "izquierda">INFO + </a></li>
			<li><a href="../../validar/usuarios/agenda.php?usuario=<?php print("$usuario");?>" target="izquierda">AGENDA</a></li>
			<li><a href="http://mevep.com.ar" target="_TOP">SALIR</a></li>
		</ul>
</div>




 <table width="946" border="0" cellpadding="0" cellspacing="0">
      
      <tr>
        <td colspan="3"><div align="right" class="Estilo47">
          <div align="left"><a href="../../a_sectores/hc/lista.php?usuario=<?php print("$usuario");?>" target ="central" class="Estilo2">LISTA DE ESPERA</a></div>
        </div>
   <tr>

			 <form action="../../a_sectores/socios/buscar_socios.php" method="post" target ="central">
        <td width="215">
          <div align="center"><span class="Estilo47">SOCIOS</span>
  
            <input type = "text" name = "palabra" size = "10" />
            <input type = "submit" name = "ok" value = "OK" />
          </div>
     </FORM>


	 <form action="../../a_sectores/socios/buscar_socios_mas.php" method="post" target ="central">
       <td width="196">
         <div align="center"><span class="Estilo47">MASCOTA</span>
  
           <input type = "text" name = "palabra2" size = "10" />
           <input type = "submit" name = "ok" value = "OK" />
         </div>
     </FORM>

<form action="../../a_sectores/particulares/buscar_socios.php" method="post" target ="central">
       <td width="211"><div align="center"><span class="Estilo47">PART</span>
          <input type = "text" name = "palabra" size = "10" />
          <input type = "submit" name = "ok2" value = "OK" />       
	     </div>
      </FORM>

	 	 <form action="../../a_sectores/proveeduria/mercaderia/buscar_mercaderia.php" method="post" target ="central">
       <td width="239">
         <div align="center"><span class="Estilo47">MERCADERIA</span>
           <input type = "text" name = "palabra1" size = "10" />
           <input type = "submit" name = "ok" value = "OK" />
         </div>
     </FORM>


  </table>	

          <?php 









$dia = date ("d");
$mes = date("m");
$anio = date("y");


?>



</FORM>

  

</form>
</body>
</html>
