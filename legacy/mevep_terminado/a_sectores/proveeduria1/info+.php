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

function multicarg(documento1,documento2)
{
parent.izquierda.location.href=documento1;
parent.central.location.href=documento2;
}
</script>


<style type="text/css">
<!--
.Estilo4 {font-size: xx-small}
.Estilo6 {color: #FFFFFF}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo54 {font-size: 12px}
-->
</style>
<link href="../..//plantillas/azul.css" rel="stylesheet" type="text/css">
<BODY background="../../IMAGENES/logito.PNG" class="Estilo4" onload ="ocultamenu()">

<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<div align="left"></div>
<table width="151" border="0" align="left">
  <tr>
    <td width="145" height="44" align="center" bgcolor="#666666" scope="row"><span class="Estilo54 Estilo7 Estilo6 Estilo13"><strong>INFO + </strong></span></td>
  </tr>
  <!-- <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo7" scope="row">
      <div align="left"><a href="stock/consultas.php" target = "central" ><span class="Estilo2 Estilo54"> 1. FICHA STOCK </span></a></div></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo12" scope="row"><div align="left"><span class="Estilo7"><a href="informes/consultas.php?opciones=Existencias" target = "central" > <span class="Estilo2"> 2. EXISTENCIAS</span></a></span></div></td>
  </tr> -->
  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo12" scope="row"> 
      <div align="left"><font color="#0000FF"><a href="consultas/CTACTE/consultas.php" target = "central" > 1. MAYOR CTA-CTE </a> </font></div></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo12" scope="row"><div align="left"><a href="consultas/ana_saldos/consultas.php" target = "central" > 2. AN&Aacute;LISIS.DE SALDOS</a></div></td>
  </tr>
<!--   <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo12" scope="row"><div align="left"><a href="consultas/balance/consultas.php" target = "central" > 5. BALANCE CTA-CTE </a></div></td>
  </tr> -->
  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo12" scope="row"><div align="left"><a href="consultas/diario_vta/consultas.php?cheque=1" target = "central" > 3. DIARIO DE VENTAS </a></div></td>
  </tr>
  <!-- <tr>
    <td valign="middle" class="Estilo12" scope="row"><div align="left"><a href="consultas/informes/fact_vencidas.php?opciones=Facturas Vencidas" target = "central" >7. FACTURAS VENCIDAS</a></div></td>
  </tr> -->
  <!-- <tr>
    <td valign="middle" class="Estilo12" scope="row"><div align="left"><a href="consultas/proveedores/entrada_dato.php" target = "central" >8. LIBRO IVA VENTAS </a></div></td>
  </tr> -->
  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo12" scope="row"><div align="left"><a href="consultas/informes/consultas.php?opciones=Lista de Precios" target = "central" >4. LISTA DE PRECIOS </a></div></td>
  </tr>
  <!-- <tr>
    <td valign="middle" class="Estilo12" scope="row"><div align="left"><a href="consultas/informes/consultas.php?opciones=Vencimiento de Lotes" target = "central" >10. LISTAR VTO - LOTES</a></div></td>
  </tr> -->
  <!-- <tr>
    <td valign="middle" class="Estilo12" scope="row"><div align="left"><a href="consultas/informes/consultas.php?opciones=Lotes Vencidos" target = "central" >11. LOTES VENCIDOS</a></div></td>
  </tr> -->
  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo12" scope="row"><div align="left"><a href="consultas/stock/tabla.php" target = "central" >5. TABLA AJUSTES</a></div></td>
  </tr>
 <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo12" scope="row"><div align="left"><a href="libro_iva/libro_iva.php" target = "izquierda" >6. LIBROS IVA</a></div></td>
  </tr>
  
</table>

<div align="center"></div>
<div align="center"></div>
<div align="center"></div>
</form><script type="text/javascript">
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
