<script language="javascript">
function on_load()
{
document.getElementById("busca").focus();
document.getElementById("busca").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cod_merca":
				document.getElementById("descripcion").focus();
				break;

					
		}
		return false;
	}
	return true;
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

<?$opciones=$_REQUEST["opciones"];?>
<BODY class="Estilo4" onload ="on_load()">
<FORM ACTION="separar_busqueda.php" method="post" TARGET = "central">
<table width="650" border="0">
  <tr bgcolor="#666666">
    <td colspan="2" align="center" scope="row"><div align="center"><span class="Estilo13">CONSULTAS VARIAS: <?echo $opciones;?></span></div></td>
  </tr>
  <tr>
    <td width="36%" align="center" bgcolor="#A0A7F5" scope="row">      <div align="right">Ingrese Nº Mercaderia </div></td>
    <td width="64%" align="center" bgcolor="#9FE1BB" scope="row"><div align="left">
        <input type = "text" name = "busca" size = "7" id = "busca">
        <input type = "hidden" name = "buscador_rapido" value = "2">
        <input type = "hidden" name = "opciones" value = "<?echo $opciones;?>">
</div></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td colspan="2" align="center" scope="row"><input type="submit" name="Submit" value="CONSULTAR"></td>
    </tr>
</table>
<div align="center"></div>
</form>
