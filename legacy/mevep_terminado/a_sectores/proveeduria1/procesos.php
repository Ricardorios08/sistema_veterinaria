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


<link href="../..//plantillas/azul.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo6 {color: #FFFFFF}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: 12px}
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
<BODY background="../../IMAGENES/logito.PNG" class="Estilo4" onload ="ocultamenu()">

<FORM ACTION="separar_busqueda.php" METHOD = "POST" name="form" target = "central">
<table width="151" border="0">
  <tr>
    <td height="40" valign="middle" bgcolor="#666666" class="Estilo7" scope="row"><div align="center"><span class="Estilo8 Estilo7 Estilo6 Estilo55"><strong>ALTAS</strong></span></div></td>
  </tr>
  <tr>
    <td valign="middle" bordercolor="#000099" bgcolor="#000099" class="Estilo7" scope="row">
      <div align="left" class="Estilo7 Estilo6 Estilo8">
        <div align="left"><a href="clientes/entrada_dato.php" target = "central" > <span class="Estilo7"> 1. CLIENTES</span></a></div>
    </div></td>
  </tr>
  <tr>
    <td valign="middle" bordercolor="#000099" bgcolor="#000099" class="Estilo7 Estilo6 Estilo8" scope="row">      <font color="#0000FF"><div align="left"><a href="proveedores/entrada_dato.php" target = "central" > 2. PROVEEDORES</a></div>
    </font></td>
  </tr>
  <tr>
    <td valign="middle" bordercolor="#000099" bgcolor="#000099" class="Estilo7 Estilo6 Estilo8" scope="row">      <font color="#0000FF"><div align="left"><a href="mercaderia/entrada_mercaderia.php" target = "central" ><span class="Estilo7 Estilo6 Estilo8"> 3. MERCADERIA</span></a></div>
    </font></td>
  </tr>
  <tr>
    <td valign="middle" bordercolor="#000099" bgcolor="#000099" class="Estilo67" scope="row"><font color="#0000FF"><a href="debito/entrada_debito.php" target = "central" ><span class="Estilo7 Estilo6  Estilo8">4</span><span class="Estilo7 Estilo6 Estilo8">. </span><span class="Estilo7 Estilo6  Estilo8">DEBITO AUTOMATICO </span></a></font></td>
  </tr>
    <tr>
    <td valign="middle" bordercolor="#000099" bgcolor="#000099" class="Estilo67" scope="row"><font color="#0000FF"><a href="debito/generar_archivo.php" target = "central" ><span class="Estilo7 Estilo6  Estilo8">5</span><span class="Estilo7 Estilo6 Estilo8">. </span><span class="Estilo7 Estilo6  Estilo8">GENERAR ARCHIVO</span></a></font></td>
  </tr>

  <tr>
    <td valign="middle" bordercolor="#000099" bgcolor="#000099" class="Estilo67" scope="row">&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#666666" class="Estilo60" scope="row"><div align="center"><span class="Estilo7 Estilo8 Estilo6 Estilo55"><strong>CAMBIAR EN </strong></span></div></td>
  </tr>
<!--   <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo60" scope="row"><a href="inventario/inventario.php" target = "izquierda" class="Estilo7 Estilo6 Estilo8" >4. INVENTARIO</a></td>
  </tr> -->
  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo60" scope="row"><font color="#0000FF"><a href="mercaderia/precio_costos.php" target = "central" class="Estilo7 Estilo6 Estilo8" >6. GANAN. Y COSTOS</span></a></font></td>
  </tr>
 <!--  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo60" scope="row"><a href="planes/entrada_dato.php" target = "central" ><span class="Estilo7 Estilo6 Estilo8">6. PLANES </span></a></td>
  </tr> -->
  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo60" scope="row"><a href="tasas/entrada_dato.php" target = "central" ><span class="Estilo7 Estilo6 Estilo8">7. TASAS</span></a></td>
  </tr>
 <!--  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo60" scope="row"><a href="actualizacion/actualizar.php" target = "central" ><span class="Estilo7 Estilo6 Estilo8">6. PRECIOS </span></a></td>
  </tr> -->
<!--   <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo60" scope="row"><a href="consultas/ajuste existencia/consultas.php" target = "central" ><span class="Estilo7 Estilo6 Estilo8">8. AJUS. EXISTENCIA</span></a></td>
  </tr> -->
  <tr>
    <td valign="middle" bgcolor="#000099" class="Estilo7 Estilo6 Estilo8" scope="row"><a href="anular/clave.php" target = "izquierda"  >8. BORRAR FACTURA</a></td>
  </tr>


  <tr>
    <td height="21" colspan="4" bgcolor="#000099"><div align="center"><span class="Estilo8"><span class="Estilo7"></span></span></div></td>
  </tr>
</table>

<div align="center"></div>
<table width="151" border="0">
    <tr>
      <td bgcolor="#666666" scope="col"><div align="center"><span class="Estilo8 Estilo55 Estilo7 Estilo6"><strong>CONSULTA Y MODIFICACION </strong></span></div></td>
    </tr>
    <tr>
      <td bgcolor="#000099" scope="col">

  
            <span class="Estilo13">            </span><span class="Estilo8">
            
            </span>        <span class="Estilo8">
            
            </span>            <span class="Estilo8">
            </span>            <span class="Estilo8">
            
            </span>            <select name="opciones[]" id="busqueda"><optgroup label="Modificar">

<option value="mod_deb"><span class="Estilo13">Debitos</span></option>
          <option value="mod_cli"><span class="Estilo13">Clientes</span></option>
       <!--  <option value="clientes">Clientes</option> -->
     <!--    </optgroup> -->
	    
    <!--   <optgroup label="Proveedores"> -->
		  <option value ="mod_pro"><span class="Estilo13">Proveedores</span></option>
		  <!-- <option value ="proveedores">Proveedor</option> -->
	  
		<!-- </optgroup>
		 -->
  <!-- 		    <optgroup label="Mercaderia"> -->
          <option value ="mod_mer"><span class="Estilo13">Mercaderia</span></option>
	  <!-- 	<option value ="mercaderia">Mercaderia</option> -->
	  
</optgroup>
      
          
      </select>
            <span class="Estilo13"><br>
            <input type = "text" name = "busca" size = "10">  
        
            <input type = "submit" name = "ok" value = "OK">
            <input type="hidden" name="buscador_rapido" value="2">  
      </span></td>
    </tr>
  
<!-- 	<td bgcolor="#000099"><p align="center" class="Estilo7 Estilo6 Estilo8"><a href="procesos.php" target ="izquierda">Atrás</a> </p>      </td>
  </tr> -->
<!--     <tr>
      <td scope="col"><div align="center"><A HREF="javascript:multicarga('../../../validar/admin.php', '../../validar/cuadros.htm')">Principal</A></div></td>
    </tr> -->
  </table>


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
