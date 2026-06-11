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
.Estilo58 {color: #000099}
.Estilo59 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000099; }
.Estilo60 {font-size: 12px; color: #000099; }
.Estilo61 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
<BODY background="../../IMAGENES/logito.PNG" class="Estilo4" onload ="ocultamenu()">

<FORM ACTION="separar_busqueda.php" METHOD = "POST" name="form" target = "central">
<table width="140" border="0">
  <tr>
    <td height="26" valign="middle" bgcolor="#666666" class="Estilo7" scope="row"><div align="center"><span class="Estilo55">ACTUALIZACIONES</span></div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo7" scope="row">
      <div align="left" class="Estilo54 Estilo58">
        <div align="left"><a href="clientes/entrada_dato.php" target = "central" > <span class="Estilo7"> 1. CLIENTES</span></a></div>
    </div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo59" scope="row"> <font color="#0000FF">
      <div align="left"><a href="proveedores/entrada_dato.php" target = "central" > 2. PROVEEDORES</a></div>
    </font></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo60" scope="row"> <font color="#0000FF">
      <div align="left"><a href="mercaderia/entrada_mercaderia.php" target = "central" ><span class="Estilo7"> 3. MERCADERIA</span></a></div>
    </font></td>
  </tr>

  <tr>
    <td valign="middle" class="Estilo60" scope="row"> <font color="#0000FF">
      <div align="left"><a href="mercaderia/precio_costos.php" target = "central" ><span class="Estilo7"> 4. GANANCIAS Y COSTOS</span></a></div>
    </font></td>
  </tr>


  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="left" class="Estilo60">
        <div align="left"><a href="planes/entrada_dato.php" target = "central" ><span class="Estilo7"> 4. PLANES </span></a></div>
    </div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="left" class="Estilo60">
        <div align="left"><a href="tasas/entrada_dato.php" target = "central" ><span class="Estilo7"> 5. TASAS</span></a></div>
    </div></td>
  </tr>
  <tr>
    <td valign="middle" class="Estilo4" scope="row"><div align="left"><span class="Estilo60"><a href="actualizacion/actualizar.php" target = "central" > <span class="Estilo7"> 5. PRECIOS </span></a></span></div></td>
  </tr>

  <tr>
    <td valign="middle" class="Estilo4" scope="row"><span class="Estilo60"><a href="anular/clave.php" target = "izquierda" > 7. BORRAR FACTURA <span class="Estilo7"></span></a></span></td>
  </tr>

  <tr>
    <td valign="middle" class="Estilo4" scope="row"><span class="Estilo60"><a href="libro_iva/libro_iva.php" target = "izquierda" > 8. LIBROS IVA <span class="Estilo7"></span></a></span></td>
  </tr>
  <tr>
    <td height="21" colspan="4"><div align="center"></div></td>
  </tr>
</table>

<div align="center"></div>
<table width="140" border="0">
    <tr>
      <td bgcolor="#666666" scope="col"><div align="center"><span class="Estilo55">CONSULTAS</span></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" scope="col"><span class="Estilo8">

    <select name="opciones[]" id="busqueda">
      <optgroup label="Externos">
        <option value="mod_cli">Mod. Clientes</option>
      <option value="clientes">Clientes</option>
      </optgroup>
	  
      <optgroup label="Proveedores">
		<option value ="mod_pro">Mod. Prov.</option>
		<option value ="proveedores">Proveedor</option>
	
		</optgroup>
		
		    <optgroup label="Mercaderia">
        <option value ="mod_mer">Mod. Mercaderia</option>
		<option value ="mercaderia">Mercaderia</option>
	
</optgroup>
    
          
    </select>
    <br>
    <input type = "text" name = "busca" size = "10">  
        
<input type = "submit" name = "ok" value = "OK">
<input type="hidden" name="buscador_rapido" value="2">  
</span></td>
    </tr>
    <tr>
      <td width="132" bgcolor="#FFFFFF" scope="col"><div align="center" class="Estilo61"></div></td>
    </tr>
	<td><p align="center" class="Estilo10"><a href="procesos.php" target ="izquierda"><font color="#0000FF">Atrás</font></a> </p>      </td>
  </tr>
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
