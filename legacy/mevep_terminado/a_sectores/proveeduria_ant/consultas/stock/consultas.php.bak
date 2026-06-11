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
.Estilo13 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
<BODY background="../../../IMAGENES/IZQUIERDA.PNG" class="Estilo4" onload ="ocultamenu()">
<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<table width="60%" border="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#000099" scope="row"><div align="center"><span class="Estilo13">FICHA STOCK</span></div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td width="40%" align="center" scope="row">
      <div align="right">Seleccione tipo de Consulta: 
      
    </div></td>
    <td width="60%" align="center" scope="row"><div align="left">
      <select name="opciones[]" id="select" onkeypress="return verif_caracter(this,event)">
          <option value ="Mercaderia">Mercaderia</option>
          <option value="Rango Fecha ">Rango Fecha</option>
      </select>
      <input type = "hidden" name = "buscador_rapido" value = "2">
    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td align="center" scope="row"><div align="right">Ingrese Mercaderia
            
  </div></td>
    <td align="center" scope="row"><div align="left">
      <input type = "text" name = "busca" size = "7">
    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td align="center" scope="row"><div align="right">Calculo por </div></td>
    <td align="center" scope="row"><div align="left">
      <input name="opcion" type="radio" value="unidades" checked>
      Unidades
      <input name="opcion" type="radio" value="valor">
    Valores</div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td align="center" scope="row"><div align="right">Desde</div></td>
    <td align="center" scope="row"><div align="left">
      <input name = "dia_d" type = "text" id="dia_d" size = "2">
  /
  <input name = "mes_d" type = "text" id="mes_d" size = "2">
  /
  <input name = "anio_d" type = "text" id="anio_d" size = "4">
    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td align="center" scope="row"><div align="right">Hasta</div></td>
    <td align="center" scope="row"><div align="left">
      <input name = "dia_h" type = "text" id="dia_h" size = "2">
  /
    <input name = "mes_h" type = "text" id="mes_h" size = "2">
  /
  <input name = "anio_h" type = "text" id="anio_h" size = "4">
    </div></td>
  </tr>
  <tr bgcolor="#000099">
    <td colspan="2" align="center" scope="row">
        <div align="center">
          <input type="submit" name="Submit" value="CONSULTAR STOCK">
        </div></td>
    </tr>
</table>

<div align="center"></div>
</form>
