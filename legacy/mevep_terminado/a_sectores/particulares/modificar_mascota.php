<link href="../../../laboratorio/css/fondo.css" rel="stylesheet" type="text/css" />


<script language="javascript">
function on_load()
{
document.getElementById("nombre_mascota").focus();
}


function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "nombre_mascota":
				document.getElementById("especie").focus();
				break;
				case "especie":
				document.getElementById("raza").focus();
				break;
				case "raza":
				document.getElementById("pelaje").focus();
				break;
				case "pelaje":
				document.getElementById("tamanio").focus();
				break;
				case "tamanio":
				document.getElementById("color").focus();
				break;

				case "color":
				document.getElementById("sexo").focus();
				break;
				case "sexo":
				document.getElementById("dia_nac").focus();
				break;
				case "dia_nac":
				document.getElementById("mes_nac").focus();
				break;
				case "mes_nac":
				document.getElementById("anio_nac").focus();
				break;
				

				


				
		}
		return false;
	}
	return true;
}


</script>

<style type="text/css">
<!--
.Estilo25 {font-family: "Trebuchet MS"}
-->
</style>
<BODY onload = "on_load()">

<?php 
include ("../../conexiones/config.inc.php");

$cod_socio=$_REQUEST["cod_socio"];
$cod_animal=$_REQUEST["cod_animal"];

include ("variables_particular.php");
?>
<form action="modificar_mas.php" method="post">
<table width="850" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF">
      <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>MODIFICAR MASCOTA </strong></div></td>
  </tr>
    
    <tr bordercolor="#FFFFFF">
      <td align="center"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td width="366" align="center"><div align="right">MASCOTA </div></td>
      <td width="480"><strong><font color="#000000" size="2">
        <input name="nombre_mascota" type="text" id="nombre_mascota"onKeyPress="return verif_caracter(this,event)" value="<?php echo $nombre_mascota;?>"  size="40" maxlength="40" tabindex="1">
      </font></strong></td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td><div align="right">ESPECIE</div></td>
      <td><strong><font color="#000000" size="2">
        <input name="especie" type="text" id="especie"onKeyPress="return verif_caracter(this,event)" value="<?php echo $especie;?>"  size="40" maxlength="40" tabindex="2">
      </font></strong></td>
  </tr>
    <tr bordercolor="#FFFFFF">
      <td><div align="right">RAZA</div></td>
      <td><strong><font color="#000000" size="2">
        <input name="raza" type="text" id="raza"onKeyPress="return verif_caracter(this,event)" value="<?php echo $raza;?>"  size="40" maxlength="40" tabindex="3">

		<input name="cod_socio" type="hidden" value="<?php echo $cod_socio;?>">
		<input name="cod_animal" type="hidden" value="<?php echo $cod_animal;?>">



      </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td><div align="right">PELAJE</div></td>
    <td><strong><font color="#000000" size="2">
      <input name="pelaje" type="text" id="pelaje"onKeyPress="return verif_caracter(this,event)" value="<?php echo $pelaje;?>"  size="40" maxlength="40" tabindex="4">
    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td><div align="right">TAMA&Ntilde;O</div></td>
    <td><strong><font color="#000000" size="2">
      <input name="tamanio" type="text" id="tamanio"onKeyPress="return verif_caracter(this,event)" value="<?php echo $tamanio;?>"  size="40" maxlength="40" tabindex="5">
    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td><div align="right">COLOR</div></td>
    <td><strong><font color="#000000" size="2">
      <input name="color" type="text" id="color"onKeyPress="return verif_caracter(this,event)" value="<?php echo $color;?>"  size="40" maxlength="40" tabindex="6">
    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td><div align="right"><font color="#000000" size="2"><font color="#000000">SEXO</font> </font></div></td>
    <td><font color="#000000" size="2">
      <select name="sexo_mascota[]" id="sexo_mascota" onkeypress="return verif_caracter(this,event)" tabindex="7">
        <optgroup label = "Opcion Seleccionada">
        <option value selected = "<?php print("$sexo_mascota");?>"><font size="2"><?php print("$sexo_mascota");?></font></option>
        </optgroup>
        <optgroup label = "Cambiar por">
        <option value="Hembra">Hembra</option>
        <option value="Macho">Macho</option>
        </optgroup>
      </select>
    </font></td>
  <tr bordercolor="#FFFFFF">
    <td><div align="right"> NACIMIENTO</div></td>
    <td><font color="#000000" size="2"><strong><font color="#000000" size="2"> <strong><font color="#000000" size="2">
      <input name="dia_nac" type="text" id="dia_nac"onKeyPress="return verif_caracter(this,event)" value="<?php echo $dia_nac;?>"  size="2" maxlength="2" tabindex="8">
      / <strong><font color="#000000" size="2">
  <input name="mes_nac" type="text" id="mes_nac"onKeyPress="return verif_caracter(this,event)" value="<?php echo $mes_nac;?>"  size="2" maxlength="2" tabindex="9">
  </font></strong>/<strong><font color="#000000" size="2">
  <input name="anio_nac" type="text" id="anio_nac"onKeyPress="return verif_caracter(this,event)" value="<?php echo $anio_nac;?>"  size="4" maxlength="4" tabindex="10">
</font></strong></font></strong> </font></strong> </font></td>
  <tr bordercolor="#FFFFFF">
    <td height="26" colspan="2"><div align="center"><font color="#000000" size="2">
      <input type="Submit" name="Submit" id ="Submit" value="MODIFICAR MASCOTA">
    </font></div></td>
  <tr>
    <td height="0"></td>
    <td></td>
  </tr>  
</table>
