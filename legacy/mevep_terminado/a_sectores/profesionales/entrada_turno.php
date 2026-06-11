


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
      <td height="24"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26" colspan="2" valign="top" bgcolor="#B8B8B8"><div align="center">
      <input type="Submit" name="Submit" id ="GUARDAR" value="SELECCIONAR">
    </div></td>
  <tr>
    <td height="0"></td>
    <td width="630"></td>
  </tr>  
</table>
