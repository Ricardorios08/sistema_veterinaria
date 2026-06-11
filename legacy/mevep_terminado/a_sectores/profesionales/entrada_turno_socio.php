


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
				document.getElementById("nro_documento").focus();
				break;
				case "nro_documento":
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
.Estilo46 {font-family: "Trebuchet MS"; font-size: 12px; }
-->
</style>
<BODY onload = "on_load()">

<?php

$mes = date("m");$anio = date("y");


$cod_socio = $_REQUEST['cod_socio'];


include ("../../conexiones/config.inc.php");

 $sql="select * from socios where cod_socio = $cod_socio";
 $result = $db->Execute($sql);

	
$cod_socio=$result->fields["cod_socio"];
$apellido1=strtoupper($result->fields["apellido"]);
$nombre1=strtoupper($result->fields["nombre"]);


$nombre_socio = $apellido1." ".$nombre1;

$sql1="select * from animal where cod_socio = $cod_socio";
$result1 = $db->Execute($sql1);

$nombre_mascota=strtoupper($result1->fields["nombre"]);
$especie=strtoupper($result1->fields["especie"]);
$raza=strtoupper($result1->fields["raza"]);
$pelaje=strtoupper($result1->fields["pelaje"]);
$tamanio=strtoupper($result1->fields["tamanio"]);
$color=strtoupper($result1->fields["color"]);
$sexo_mascota=strtoupper($result1->fields["sexo"]);
$fecha_nac=strtoupper($result1->fields["fecha_nac"]);
$cod_animal=strtoupper($result1->fields["cod_animal"]);


?>

<form action="ver_turnos.php" method="post">
<table width="850" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td height="37" colspan="2" bgcolor="#B8B8B8"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">ENTRADA TURNO </font></div></td>
    </tr>
    
    
    

    <tr bordercolor="#FFFFFF">
      <td width="216" height="24"><div align="right" class="Estilo25">
        <div align="center"><font color="#000000" size="2">PROFESIONAL</font></div>
      </div></td>
      <td>        <font color="#000000" size="2"><strong><font color="#000000" size="2">


	    <?php 
		include ("../../conexiones/config.inc.php");
$sql = "SELECT * FROM profesionales order by especialidad";
$result = $db->Execute($sql);
echo "<select name=profesionales[] id =profesionales onKeyPress='return verif_caracter(this,event)'>";
echo"<option value=''>Seleccione</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$nro_profesional=$result->fields["nro_profesional"];
 $apellido=strtoupper($result->fields["apellido"]);
 $nombre=strtoupper($result->fields["nombre"]);
 $profe = $apellido." ".$nombre;



echo"<option value='$nro_profesional'>$profe</option>";
$result->MoveNext();
	}
echo"</select>";



?>



    
      </font></strong>
      </font></td>
    <tr bordercolor="#FFFFFF">
      <td height="24"><div align="center" class="Estilo46">PERIODO</div></td>
      <td><label>
        <input name="mes" type="text" id="mes" value="<?php echo $mes;?>" size="2" maxlength="2">
        20
        <input name="anio" type="text" id="anio" value="<?php echo $anio;?>" size="2" maxlength="2">
      </label></td>
    <tr bordercolor="#FFFFFF">
      <td height="24" bgcolor="#FFFFFF"><div align="center">
        <div align="center" class="Estilo46">SOCIO:</div>
      </div></td>
      <td bgcolor="#FFFFFF"><?php echo $nombre_socio;?>&nbsp;</td>
  <tr bordercolor="#FFFFFF">
      <td height="24" bgcolor="#FFFFFF"><div align="center"><font color="#000000" size="2">
    <span class="Estilo25"><font color="#000000" size="2">MASCOTA</font><font color="#000000" size="2"></font></span><font color="#000000" size="2"><strong>:</strong></font></font></div></td>
      <td bgcolor="#FFFFFF"><?php echo $nombre_mascota;?></td>
  <tr bordercolor="#FFFFFF">
    <td height="26" colspan="2" valign="top" bgcolor="#B8B8B8"><div align="center">

	        <input type="hidden" name="cod_socio" value="<?php echo $cod_socio;?>">


	  <input type="Submit" name="Submit" id ="GUARDAR" value="SELECCIONAR">



    </div></td>
  <tr>
    <td height="0"></td>
    <td width="630"></td>
  </tr>  
</table>
