<style type="text/css">
<!--
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
-->
</style>
 
 <script language="javascript">
function on_load()
{
document.getElementById("nro_os").focus();
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "texfile":
				document.getElementById("nro_os").focus();
				
				break;
				case "nro_os":
				document.getElementById("cargar").focus();
				break;
		
		}
		return false;
	}
	return true;
}


</script>

<BODY onload = "on_load()">
<FORM  action="importar_nn.php" method="post">

<!-- <input name="server" value="1" type="hidden">
<input name="db" value="usuario" type="hidden">
<input name="table" value="onco" type="hidden"> -->
<table width="103%" border="0">
  <tr bgcolor="#000099">
    <td height="36" colspan="2"><div align="center" class="Estilo2">CARGAR NOMENCLADOR DESDE ARCHIVO TXT GENERADO EN COBOL</div></td>
    </tr>
  <tr bgcolor="#E1F2EF">
    <td width="19%"><div align="right">Ingresar TXT</div></td>
    <td width="81%"><input name="textfile" type="file" size = "95" ID = "textfile" onKeyPress="return verif_caracter(this,event)"></td>
   
    </tr>
  <tr bgcolor="#E1F2EF">
    <td><div align="right">Ingrese Obra Social </div></td>
    <td><input name="nro_os" type="text" size = "10" id = "nro_os" onKeyPress="return verif_caracter(this,event)">
      <input name="enviar" value="Cargar" id = "cargar" type="submit"></td>
   
  </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor="#E8DCFC">
    <td colspan="2"><div align="left">Copie el diskette con los nomencladores en el directorio c:\utiles\easyphp1-1\www\archivos\nomencladores\</div></td>
    </tr>
  <tr bgcolor="#E8DCFC">
    <td colspan="2"><div align="left">utilizando MI PC o Explorador de Windows. </div></td>
  </tr>
  <tr bgcolor="#E8DCFC">
    <td colspan="2"><div align="left">Luego presione &quot;Examinar&quot; busque el correspondiente directorio y el archivo a copiar. ej: c:\utiles\easyphp1-1\www\archivos\nomencladores\EXNUPI5073</div></td>
  </tr>
  <tr bgcolor="#E8DCFC">
    <td colspan="2"><div align="left">Ingrese la Obra Social. ej 5073 y luego presione ..&quot;Cargar&quot; </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
    </div></td>
    </tr>
</table>
</form>
</BODY>