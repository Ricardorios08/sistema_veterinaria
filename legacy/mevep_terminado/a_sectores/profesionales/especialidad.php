


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
				case "nro_paciente":
				document.getElementById("nro_afiliado").focus();
				break;
				case "nro_afiliado":
				document.getElementById("apellido").focus();
				break;
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
.Estilo44 {	color: #FF0000;
	font-family: "Trebuchet MS";
}
.Estilo45 {font-family: "Trebuchet MS"; font-size: 12px; }
-->
</style>
<BODY onload = "on_load()">


<?php
$borra=$_REQUEST["borra"];


include ("../../conexiones/config.inc.php");


if ($borra == 1){

$cod_operacion=$_REQUEST["cod_operacion"];
 $sql = "delete FROM especialidad WHERE cod_operacion = '$cod_operacion'";
  mysql_query($sql);

}


  $sql2="select * from especialidad order by cod_operacion desc";
$result2 = $db->Execute($sql2);



  $nro_especialidad=$result2->fields["nro_especialidad"]+1;


?>

<form action="guardar_especialidad.php" method="post">
<table width="850" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td height="37" colspan="2" bgcolor="#B8B8B8"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">AGREGAR ESPECIALIDAD </font></div></td>
    </tr>
    <tr align="center" bordercolor="#FFFFFF">
      <td width="146" height="24">
      <div align="right" class="Estilo25">
        <div align="left"><font color="#000000" size="2"> N&ordm; ESPECIALIDAD </font></div>
      </div></td>
      <td><div align="left">
          <font color="#000000" size="2">
          <input name="nro_especialidad" type="text" id="nro_especialidad" onKeyPress="return verif_caracter(this,event)" size="8" maxlength="8" value = "<?php echo $nro_especialidad;?>">
      </font></div></td>
  </tr>
    
    <tr bordercolor="#FFFFFF">
      <td height="24"><div align="right" class="Estilo25">
        <div align="left"><font color="#000000" size="2">ESPECIALIDAD</font></div>
      </div></td>
      <td>        <font color="#000000" size="2">
      <input name="especialidad" type="text" id="especialidad"onKeyPress="return verif_caracter(this,event)" size="30" maxlength="30">      
      </font><font size="2"><span class="Estilo44">* Obligatorio</span></font></td>
  </tr>

  <tr bordercolor="#FFFFFF">
    <td height="26" colspan="2" valign="top" bgcolor="#B8B8B8"><div align="center">
      <input type="Submit" name="Submit" id ="GUARDAR" value="AGREGAR">
    </div></td>
  <tr>
    <td height="0"></td>
    <td width="442"></td>
  </tr>  
</table>

<table width="850" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="98">&nbsp;</td>
    <td width="596">&nbsp;</td>
    <td width="156">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#B8B8B8"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">MODIFICAR/ ELIMINAR  ESPECIALIDAD </font></div></td>
  </tr>
  
<?php

   $sql2="select * from especialidad order by especialidad";
$result2 = $db->Execute($sql2);

 if (!$result2) die("fallo".$db->ErrorMsg());
  while (!$result2->EOF) {
  

  $especialidad=strtoupper($result2->fields["especialidad"]);
  $nro_especialidad=strtoupper($result2->fields["nro_especialidad"]);
  $cod_operacion=strtoupper($result2->fields["cod_operacion"]);


  ?>

  <tr>
    <td bgcolor="#EDEDED"><div align="center" class="Estilo45">N&deg;</div></td>
    <td bgcolor="#EDEDED"><div align="center" class="Estilo45">Especialidad</div></td>
    <td bgcolor="#EDEDED"><div align="center" class="Estilo45">Borrar</div></td>
  </tr>
  <tr>
    <td><?php echo $nro_especialidad;?></td>
    <td><?php echo $especialidad;?></td>
    <td><div align="center"><a href="especialidad.php?borra=1&&cod_operacion=<?php print("$cod_operacion");?>" onclick="return confirm('¿Está seguro de Borrar la orden y sus RESULTADOS?');"><IMG SRC="../../imagenes/office//1047.ico" alt="Borrar" border = "0"></a></div></td>
  </tr>

<?php
$result2->MoveNext();
		}
		
		?>
</table>
