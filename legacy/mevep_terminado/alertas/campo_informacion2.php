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

<style type="text/css">
<!--
.Estilo4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo9 {color: #000000}
.Estilo25 {font-size: 16px}
-->
</style>
<BODY onload = "on_load ()">
<table width="850" border="0">
  <tr>
    <th height="40" bgcolor="#EDEDED" scope="col"><span class="Estilo1 Estilo4 Estilo9"><blink></blink></span><span class="Estilo1 Estilo4 Estilo9"><blink><span class="Estilo25" bgcolor="#000000"><?php echo $leyenda;?></span></blink></span></th>
  </tr>
  <tr>
    <th height="36" bgcolor="#EDEDED" scope="col"><span class="Estilo1 Estilo4">
      <input name="button" type="button" id ="boton" onClick="history.back()" onKeyPress="history.back()" value="Presione ENTER">
    </span></th>
  </tr>
</table>
