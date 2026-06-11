<script language="javascript">
function on_load()
{
document.getElementById("apellido").focus();
}



function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				
				case "apellido":
				document.getElementById("nombre").focus();
				break;
				case "nombre":
				document.getElementById("direccion").focus();
				break;
				case "direccion":
				document.getElementById("telefono").focus();
				break;
				case "telefono":
				document.getElementById("celular").focus();
				break;
				case "celular":
				document.getElementById("email").focus();
				break;
								case "email":
				document.getElementById("interno").focus();
				break;
								case "interno":
				document.getElementById("sector").focus();
				break;
								case "sector":
				document.getElementById("puesto").focus();
				break;

								case "puesto":
				document.getElementById("mes").focus();
				break;

								case "mes":
				document.getElementById("anio").focus();
				break;

				case "anio":
				document.getElementById("guardar").focus();
				break;
				



				
		}
		return false;
	}
	return true;
}


</script>


<style type="text/css">
<!--
.Estilo12 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>

<?php 
if ($band != 1){
	$dia = date("d");
$mes = date("m");
$anio = date("y");

 $hora =  date("h:i:s"); 
}

?>
<BODY onload = "on_load ()"><CENTER>
<TABLE WIDTH="800" BORDER=0><TR><TD>  
<FORM ACTION="../../validar/usuarios/guardar_trabajo.php" method="post" TARGET = "central">

  <div align="left"><font size="1"> </font>
  </div>
  <table width="103%" border="0">
      <tr bgcolor="#E6E6E6">
        <td colspan="2"><div align="center" class="Estilo12">Trabajo</div></td>
        </tr>
      <tr bgcolor="#F2FACB">
        <td width="46%"><div align="right">Dia</div></td>
        <td width="54%"><input name="dia" type="text" id="dia" onKeyPress="return verif_caracter(this,event)" value="<?php echo $dia;?>" size = "2" maxlength="2">
        / <input name="mes" type="text" id="fecha2" onKeyPress="return verif_caracter(this,event)" value="<?php echo $mes;?>" size = "2" maxlength="2">
        /
        20
        <input name="anio" type="text" id="fecha3" onKeyPress="return verif_caracter(this,event)" value="<?php echo $anio;?>" size = "2" maxlength="2"></td>
      </tr>
      <tr bgcolor="#F2FACB">
        <td><div align="right">Hora</div></td>
        <td><input type="text" name="hora" size = "10" id="hora" value="<?php echo $hora;?>" onKeyPress="return verif_caracter(this,event)"> </td>
      </tr>
      <tr bgcolor="#F2FACB">
        <td><div align="right">Trabajo</div></td>
        <td><input name="trabajo" type="text" id="trabajo" onKeyPress="return verif_caracter(this,event)" value="<?php echo $trabajo;?>" size = "45"> </td>
      </tr>
      <tr bgcolor="#F2FACB">
        <td><div align="right">Para</div></td>
        <td><input name="para" type="text" id="para" onKeyPress="return verif_caracter(this,event)" value="<?php echo $para;?>" size = "15"> </td>
      </tr>
      <tr bgcolor="#F2FACB">
        <td><div align="right">Duracion</div></td>
        <td><input name="duracion" type="text" id="duracion" onKeyPress="return verif_caracter(this,event)" value="<?php echo $duracion;?>" size = "2"> 
        horas 
        </td>
      </tr>
      <tr bgcolor="#E6E6E6">
        <td colspan="2">          <div align="center">
          <input type="Submit" name="bLogin" value="Guardar" id="guardar">
          </div></td>
        </tr>
  </table>

<?php  include ("buscar_trabajo.php");?>
</form>

</body>