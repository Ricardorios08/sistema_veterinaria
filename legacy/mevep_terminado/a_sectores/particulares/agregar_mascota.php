<link href="../../../laboratorio/css/fondo.css" rel="stylesheet" type="text/css" />


<script language="javascript">
function on_load()
{
document.getElementById("nro_paciente").focus();
}


function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "nro_paciente":
				document.getElementById("nro_afiliado").focus();
				break;
				case "nro_afiliado":
				document.getElementById("nombre").focus();
				break;
				case "nombre":
				document.getElementById("nro_documento").focus();
				break;
				case "nro_documento":
				document.getElementById("nro_os").focus();
				break;
				case "nro_os":
				document.getElementById("domicilio").focus();
				break;

				case "domicilio":
				document.getElementById("telefono").focus();
				break;
				case "telefono":
				document.getElementById("celular").focus();
				break;
				case "celular":
				document.getElementById("dia").focus();
				break;
				case "dia":
				document.getElementById("mes").focus();
				break;
				case "mes":
				document.getElementById("anio").focus();
				break;
				case "anio":
				document.getElementById("GUARDAR").focus();
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
//$cod_animal=$_REQUEST["cod_animal"];

//include ("variables_animal.php");
?>
<form action="agrega_mas.php" method="post">

<?php 

$sql="select * from particulares where cod_socio = $cod_socio";
 $result = $db->Execute($sql);


$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$departamento=strtoupper($result->fields["departamento"]);
$telefono=strtoupper($result->fields["telefono"]);
$cod_postal=strtoupper($result->fields["cod_postal"]);


if ($telefono == 0){
$telefono = "-";
}

	
?>
<table width="850" border="0" cellspacing="0">
  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
  
    <td width="5%"><div align="center"><font color="#000000" size="2" face="Trebuchet MS">SOCIO</font></div></td>
    <td width="21%"><div align="center"><font color="#000000" size="2" face="Trebuchet MS"> APELLIDO Y NOMBRE </font></div></td>
    <td width="8%"><div align="center"><font color="#000000" size="2" face="Trebuchet MS">TELEFONO</font></div></td>
    <td width="15%"><div align="center"><font color="#000000" size="2" face="Trebuchet MS">DOMICILIO</font></div></td>
    <td width="45%"><div align="center"><font color="#000000" size="2" face="Trebuchet MS">LOCALIDAD</font></div></td>
  

   <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
	<td bordercolor="#E8DCFC"><div align="center"><font size="2" face="Trebuchet MS"><strong><?php print("$cod_socio");?></strong></font></div></td>
    <td bordercolor="#E8DCFC"><div align="left"><font size="2" face="Trebuchet MS"><strong><?php print("$apellido");?>, <?php print("$nombre");?></strong></font></div></td>
    <td bordercolor="#E8DCFC"><div align="center"><font size="2" face="Trebuchet MS"> <?php echo $telefono;?></font></div></td>
    <td bordercolor="#E8DCFC"><div align="left"><font size="2" face="Trebuchet MS"><?php echo $domicilio;?></font></div></td>
    <td bordercolor="#E8DCFC"><div align="center"><font size="2" face="Trebuchet MS"> <?php echo $departamento;?></font></div></td>
   	</tr>

</table>


<table width="850" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF">
      <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>AGREGAR MASCOTA </strong></div></td>
  </tr>

    <tr bordercolor="#FFFFFF">
      <td width="366" align="center"><div align="right">MASCOTA </div></td>
      <td width="480"><strong><font color="#000000" size="2">
        <input name="nombre_mascota" type="text" id="nombre_mascota"onKeyPress="return verif_caracter(this,event)" value="<?php echo $nombre_mascota;?>"  size="40" maxlength="40">
      </font></strong></td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td><div align="right">ESPECIE</div></td>
      <td><strong><font color="#000000" size="2">
        <input name="especie" type="text" id="especie"onKeyPress="return verif_caracter(this,event)" value="<?php echo $especie;?>"  size="40" maxlength="40">
      </font></strong></td>
  </tr>
    <tr bordercolor="#FFFFFF">
      <td><div align="right">RAZA</div></td>
      <td><strong><font color="#000000" size="2">
        <input name="raza" type="text" id="raza"onKeyPress="return verif_caracter(this,event)" value="<?php echo $raza;?>"  size="40" maxlength="40">

		<input name="cod_socio" type="hidden" value="<?php echo $cod_socio;?>">




      </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td><div align="right">PELAJE</div></td>
    <td><strong><font color="#000000" size="2">
      <input name="pelaje" type="text" id="pelaje"onKeyPress="return verif_caracter(this,event)" value="<?php echo $pelaje;?>"  size="40" maxlength="40">
    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td><div align="right">TAMA&Ntilde;O</div></td>
    <td><strong><font color="#000000" size="2">
      <input name="tamanio" type="text" id="tamanio"onKeyPress="return verif_caracter(this,event)" value="<?php echo $tamanio;?>"  size="40" maxlength="40">
    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td><div align="right">COLOR</div></td>
    <td><strong><font color="#000000" size="2">
      <input name="color" type="text" id="color"onKeyPress="return verif_caracter(this,event)" value="<?php echo $color;?>"  size="40" maxlength="40">
    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td><div align="right"><font color="#000000" size="2"><font color="#000000">SEXO</font> </font></div></td>
    <td><font color="#000000" size="2">
      <select name="sexo_mascota[]" id="sexo_mascota" onkeypress="return verif_caracter(this,event)">
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
      <input name="dia_nac" type="text" id="dia_nac4"onKeyPress="return verif_caracter(this,event)" value="<?php echo $dia_nac;?>"  size="2" maxlength="2">
      / <strong><font color="#000000" size="2">
  <input name="mes_nac" type="text" id="mes_nac"onKeyPress="return verif_caracter(this,event)" value="<?php echo $mes_nac;?>"  size="2" maxlength="2">
  </font></strong>/<strong><font color="#000000" size="2">
  <input name="anio_nac" type="text" id="anio_nac"onKeyPress="return verif_caracter(this,event)" value="<?php echo $anio_nac;?>"  size="4" maxlength="4">
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
