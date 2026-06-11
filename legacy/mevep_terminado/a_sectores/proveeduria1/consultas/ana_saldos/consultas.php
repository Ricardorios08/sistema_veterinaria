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

body {
	background-image: url(../../../../imagenes/logito.png);
}
-->
</style>

<?
$cuenta = $_REQUEST['cuenta'];
$denominacion = $_REQUEST['denominacion'];
?>
<BODY background="../../../IMAGENES/IZQUIERDA.PNG" class="Estilo4" onload ="ocultamenu()">
<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<table width="650" border="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#000099" scope="row"><div align="center"><span class="Estilo13">ANALISIS DE FACTURAS DE: <?echo $denominacion;?></span></div></td>
  </tr>
<!--   <tr bgcolor="#E1F2EF">
    <td width="40%" align="center" scope="row">
      <div align="right">Seleccione tipo de Consulta:</div></td>
    <td width="60%" align="center" scope="row"><div align="left">
      <select name="opciones[]" id="select" onkeypress="return verif_caracter(this,event)">
           <option value="EXTERNOS">EXTERNOS</option>
           <option value="ASOCIADOS">ASOCIADOS</option>
      </select>
      <input type = "hidden" name = "buscador_rapido" value = "2">
    </div></td>
  </tr> -->
  <tr bgcolor="#E1F2EF">
    <td align="center" scope="row"><div align="right">Ingrese N&ordm; Cuenta:</div></td>
    <td align="center" scope="row"><div align="left">
      <input type = "text" name = "busca" size = "7" value = "<?echo $cuenta;?>">
    </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td align="center" scope="row"><div align="right">Detalle: </div></td>
    <td align="center" scope="row"><div align="left">
      <input name="ver" type="radio" value="1">
      Hist&oacute;rico
      <input name="ver" type="radio" value="2" checked>
    Adeudadas</div></td>
  </tr>
  <tr bgcolor="#000099">
    <td colspan="2" align="center" scope="row">
        <div align="center">
          <input type="submit" name="Submit" value="MOSTRAR DETALLE">
</div></td>
    </tr>
</table>

<div align="center"></div>
</form>
