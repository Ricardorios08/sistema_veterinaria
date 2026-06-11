<?php 
$id = $_REQUEST['id'];
$hoy = date("d/m/y");
include ("variables.php");
?>
<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">

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

<link href="FONDO.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.Estilo11 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo12 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
<BODY onload = "on_load ()"><CENTER><TABLE WIDTH="90%" BORDER=0><TR><TD>  
<FORM ACTION="../../validar/usuarios/guardar_empl_mod.php" method="post" TARGET = "central">

  <div align="left"><font size="1"> </font>
  </div>
  <table width="103%" height="281" border="0">
      <tr bgcolor="#FFFFFF">
        <td height="24" colspan="3" bgcolor="#FFFFFF"><div align="center" class="Estilo11">AGENDA ASOCIACION BIOQUIMICA DE MZA</div></td>
        <td width="6%" bgcolor="#FFFFFF"><div align="center"><?php echo $hoy;?></div></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4"><hr noshade></td>
        </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" bgcolor="#FFFFFF"><div align="left" class="Estilo12">Apellido y Nombre: <strong><?php echo $apellido;?>, <?php echo $nombre;?></strong></div>          <div align="right" class="Estilo12"> </div></td>
        <td height="21" colspan="2" bgcolor="#FFFFFF"><span class="Estilo12"></span></td>
        </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4"><div align="left" class="Estilo12">Direcci&oacute;n: <strong><?php echo $direccion;?></strong></div> </td>
        </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4"><div align="left" class="Estilo12">Telefono: <strong><?php echo $telefono;?> </strong></div>          </td>
        </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4"><span class="Estilo12">Celular: <strong><?php echo $celular;?> </strong></span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4"><span class="Estilo12">Interno: <strong><?php echo $interno;?></strong></span><span class="Estilo12"></span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4"><div align="left" class="Estilo12">E-mail: <strong><?php echo $email;?></strong></div> </td>
        </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4"><span class="Estilo12">Cumplea&ntilde;os: <strong><?php echo $mes;?>/<?php echo $anio;?></strong></span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4"><div align="left" class="Estilo12">Sector de Trabajo: <strong><?php print("$sector");?></strong></div>          </td>
        </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4"><span class="Estilo12">Puesto: <strong><?php echo $puesto;?></strong></span></td>
        </tr>
      <tr bgcolor="#FFFFFF">
        <td height="21" colspan="4" bgcolor="#FFFFFF"><hr noshade></td>
        </tr>
  </table>
</form>

</body>