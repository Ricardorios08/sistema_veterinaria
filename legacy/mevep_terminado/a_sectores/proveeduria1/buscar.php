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
.Estilo6 {color: #FFFFFF}
.Estilo1 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<BODY background="../../IMAGENES/IZQUIERDA.PNG" class="Estilo4" onload ="ocultamenu()">
 <FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">

<table width="140" border="0">
	<tr bgcolor="#000099">
	  <td colspan="2" scope="col"><div align="center" class="Estilo6 Estilo1">BUSCAR</div></td>
    </tr>
	<tr>
      <td colspan="2" bgcolor="#FFFFFF" scope="col"><div align="center">
        
		
		<select name="opciones[]" id="opciones" onkeypress="return verif_caracter(this,event)">
            <option value ="Mercaderia">Mercaderia</option>
			<option value="Clientes">Clientes</option>
            <option value ="Proveedores">Proveedores</option>
            <option value ="Facturas">Facturas</option>
        </select>


      </div></td>
    </tr>
    <tr>
      <td width="57" bgcolor="#FFFFFF" scope="col">Ingrese</td>
      <td width="73" bgcolor="#FFFFFF" scope="col"><input type = "text" name = "busca" size = "7">
	  <input type = "hidden" name = "buscador_rapido" value = "2"></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF" scope="col"><div align="center">
        <input type="submit" name="Submit" value="Buscar">
      </div></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000099" scope="col"><div align="center" class="Estilo6">Ir a...</div></td>
    </tr>
    <tr>
      <td colspan="2" scope="col"><div align="center"><a href="../../a_sectores/proveeduria/proveeduria.php" target ="izquierda"><font color="#0000FF">Volver</font></a></div></td>
    </tr>
 <!--    <tr>
      <td colspan="2" scope="col"><div align="center"><A HREF="javascript:multicarga('../../validar/admin.php', '../../validar/cuadros.htm')">Principal</A></div></td>
    </tr> -->
    <tr>
      <td colspan="2" scope="col"><div align="center"><font color="#0000FF"><a href="../../index.html" target ="_parent">Salir</a></font><font color="#0000FF"></font><font color="#0000FF"></font></div></td>
    </tr>
  </table>
</form>