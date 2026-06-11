<link href="../css/fondo.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function on_load()
{
document.getElementById("boton").focus();
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				

				case "nro_laboratorio":
				document.getElementById("matricula").focus();
				break;
				
				case "matricula":
				document.getElementById("participacion").focus();
				break;

				
				break;
		}
		return false;
	}
	return true;
}



</script>

<BODY onload = "on_load ()">
<table width="850" border="0">
  <tr>
    <th width="800" bgcolor="#FFBC79" scope="col"><span class="Estilo1"><blink><?php echo $leyenda;?> </blink><input type="button" value="Volver" onKeyPress="history.back()" id ="boton" style="font-family: Verdana; font-size: 8 pt"> </span></th>
  </tr>
</table>