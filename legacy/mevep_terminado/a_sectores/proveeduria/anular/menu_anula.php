<script type="text/javascript">
function ocultamenu(){
  var menu = document.getElementById("Atributos");
  menu.style.display = "none";
}
function despliega(){
  var menu = document.getElementById("Atributos");
    if(menu.style.display == "none"){
      menu.style.display = "block";
    }
    else{
      menu.style.display = "none";
    }
}
</script>
<script LANGUAGE="JavaScript">
function multicarga(documento1,documento2)
{
parent.izquierda.location.href=documento1;
parent.central.location.href=documento2;
}

ar isCtrl = false; document.onkeyup=function(e){ if(e.which == 17) isCtrl=false; }
document.onkeydown=function(e){ 
	if(e.which == 27) 
	isCtrl=true; if(e.which == 27) { 
alert ("fds");
		//run code for CTRL+S -- ie, save! return false; } if(e.which == 79 && isCtrl == true) { //run code for CTRL+O -- ie, open! return false; } if(e.which == 84 && isCtrl == true) { //run code for CTRL+T -- ie, new tab! return false; 
		} 
		}
</script>


<style type="text/css">
<!--
.Estilo4 {font-size: xx-small}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo54 {font-size: 12px}
.Estilo55 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo58 {color: #FFFFFF}
.Estilo59 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000099; }
body {
	background-image: url(../../../imagenes/logito.png);
}
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	color: #FFFFFF;
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<BODY class="Estilo4" onload ="ocultamenu()">

<FORM ACTION="separar_busqueda.php" METHOD = "POST" name="form" target = "central">
<table width="146" border="0">
  <tr>
    <td width="140" height="36" valign="middle" bgcolor="#666666" class="Estilo7" scope="row"><div align="center"><span class="Estilo55">BORRAR / ANULAR </span></div></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#0000FF" class="Estilo7" scope="row">
      <div align="left" class="Estilo54 Estilo58">
        <div align="left"><a href="entrada_factura.php" target = "central" > <span class="Estilo7"> 1. ANULAR FACTURA </span></a></div>
    </div></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#0000FF" class="Estilo59" scope="row"> <div align="left" class="Estilo58">
      <a href="entrada_anula.php" target = "central" > 2. REGISTRAR ANULADA </a></div></td>
  </tr>
  <!-- <tr>
    <td valign="middle" class="Estilo59" scope="row">&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo59" scope="row">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" valign="middle" bgcolor="#666666" class="Estilo59" scope="row"><div align="center"><span class="Estilo55">IR A </span></div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo59" scope="row"><div align="center"><span class="Estilo10"><a href="../informes.php" target ="izquierda"><font color="#0000FF">Atras</font></a> </span></div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo59" scope="row">&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo59" scope="row">&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo59" scope="row"><div align="center"></div></td>
  </tr> -->
</table>
