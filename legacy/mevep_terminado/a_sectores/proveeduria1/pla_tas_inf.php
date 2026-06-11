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
.Estilo6 {color: #FFFFFF}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo54 {font-size: 12px}
.Estilo55 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo58 {color: #000099}
.Estilo59 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000099; }
.Estilo60 {font-size: 12px; color: #000099; }
.Estilo61 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
<BODY background="../../IMAGENES/IZQUIERDA.PNG" class="Estilo4" onload ="ocultamenu()">

<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<table width="140" border="0">
  <tr>
    <th bgcolor="#000099" scope="col"><span class="Estilo6">Opciones Varias </span></th>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="left" class="Estilo60">
      <div align="left"><a href="planes/entrada_dato.php" target = "central" ><IMG SRC="../../imagenes/merca.jpg" width ="20" height= "20" alt="Proveedores" border = "0"><span class="Estilo7"> PLANES </span></a></div>
    </div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="left" class="Estilo60">
      <div align="left"><a href="tasas/entrada_dato.php" target = "central" ><IMG SRC="../../imagenes/merca.jpg" width ="20" height= "20" alt="Proveedores" border = "0"><span class="Estilo7"> TASAS</span></a></div>
    </div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="left"><span class="Estilo60"><a href="actualizacion/actualizar.php" target = "central" ><IMG SRC="../../imagenes/merca.jpg" width ="20" height= "20" alt="Proveedores" border = "0"> <span class="Estilo7"> ACT. PRECIOS  </span></a></span></div></td>
  </tr>
  <tr>
    <!-- <td class="Estilo4" scope="row">      <p align="left" class="Estilo12"><font color="#0000FF"><a href="facturacion/facturapro1.php" target = "central" >Ventas</a></font></p></td> -->
  </tr>
  <tr>
   <!--  <td scope="row">      <p align="left"><span class="Estilo5"><font color="#0000FF"><a href="facturacion/facturapro.php" target = "central" >Pre-facturaci&oacute;n</a></font><font color="#0000FF"></font></span></p></td> -->
  </tr>
</table>

<div align="center"></div>
<table width="140" border="0">
    <tr>
      <td width="132" bgcolor="#000099" scope="col"><div align="center" class="Estilo61">Ir a...</div></td>
    </tr>
    <tr>
      <td scope="col"><div align="center"><A HREF="informes.php">Atras</A></div></td>
    </tr>
    <tr>
      <td scope="col"><div align="center"><A HREF="javascript:multicarga('../../validar/admin.php', '../../validar/cuadros.htm')">Principal</A></div></td>
    </tr>
    <tr>
      <td scope="col"><div align="center"><font color="#0000FF"><a href="../../index.html" target ="_parent">Salir</a></font><font color="#0000FF"></font><font color="#0000FF"></font></div></td>
    </tr>
  </table>


</form>