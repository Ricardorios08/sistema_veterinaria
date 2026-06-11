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
</script>
<style type="text/css">
<!--
.Estilo4 {font-size: xx-small}
.Estilo5 {
	font-size: 16px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo6 {color: #FFFFFF}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo13 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }
.Estilo2 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #0000FF; }
-->
</style>
<BODY background="../../../IMAGENES/IZQUIERDA.PNG" class="Estilo4" onload ="ocultamenu()">

<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<table width="140" border="0">
  <tr>
    <th bgcolor="#000099" scope="col"><span class="Estilo6">INVENTARIO</span></th>
  </tr>
  <tr>
    <td valign="middle" class="Estilo7" scope="row">      <div align="center"><a href="clientes/entrada_dato.php" target = "central" ><span class="Estilo2"> TOMA INVENTARIO </span></a></div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo12" scope="row"><div align="center"><span class="Estilo7"><a href="clientes/entrada_dato.php" target = "central" > <span class="Estilo2"> CARGA EXISTENCIA </span></a></span></div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo12" scope="row"><div align="center"><span class="Estilo7"><a href="clientes/entrada_dato.php" target = "central" ><span class="Estilo2">CONTROL EXISTENCIA</span></a></span></div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo12" scope="row">     <font color="#0000FF">
      <div align="center"><a href="proveedores/entrada_dato.php" target = "central" > EMISION INVENTARIO </a></div></td>
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
      <td width="132" bgcolor="#000099" scope="col"><div align="center" class="Estilo6">Ir a...</div></td>
    </tr>
    <tr>
      <td scope="col"><div align="center"><A HREF="javascript:multicarga('../../../validar/admin.php', '../../validar/cuadros.htm')">Principal</A></div></td>
    </tr>
    <tr>
      <td scope="col"><div align="center"><font color="#0000FF"><a href="../../../index.html" target ="_parent">Salir</a></font><font color="#0000FF"></font><font color="#0000FF"></font></div></td>
    </tr>
  </table>


</form>