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
.Estilo13 {
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo15 {font-size: 12}
.Estilo16 {font-family: Arial, Helvetica, sans-serif}
.Estilo17 {font-size: 12; font-family: Arial, Helvetica, sans-serif; }
body {
	background-image: url(../../../../imagenes/logito.png);
}

-->
</style>

<?
$dia = date("d");
$mes= date("m");
$anio = date("y");
$cheque = $_REQUEST['cheque'];

?>

<BODY class="Estilo4" onload ="ocultamenu()">
<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<table width="650" border="0">
  <tr bgcolor="#CCCCCC">
    <td height="39" colspan="2" align="center" scope="row"><div align="center"><span class="Estilo13">DIARIO DE VENTAS </span></div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td width="40%" align="center" bgcolor="#A0A7F5" scope="row"><div align="right" class="Estilo15 Estilo16">Fecha </div></td>
    <td align="center" bgcolor="#9FE1BB" scope="row"><div align="left" class="Estilo17">
      <input name = "dia" type = "text" id="dia_d" value = "<?echo $dia;?>" maxlength = "2" size = "2">
  /
  <input name = "mes" type = "text" id="mes_d" value = "<?echo $mes;?>" maxlength = "2" size = "2">
  / 20
  <input name = "anio" type = "text" id="anio_d" value = "<?echo $anio;?>" size = "2" maxlength = "2">
    <input name="cheque" type="hidden" value="<?echo $cheque;?>">
    </div></td>
    </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="2" align="center" bgcolor="#CCCCCC" scope="row"><input type="submit" name="Submit" value="CONSULTAR"></td>
    </tr>
</table>

<div align="center"></div>
</form>
