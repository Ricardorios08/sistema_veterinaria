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
echo $cod_socio=$_REQUEST["cod_socio"];
echo $cod_animal=$_REQUEST["cod_animal"];

?>

<form action="borrar_mas.php" method="post">
<table width="850" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF">
      <td height="30" colspan="4" bgcolor="#CCCCCC"><div align="center"><strong>PARA BORRAR LA MASCOTAS MARCADAS ESCRIBA LA CONTRASE&Ntilde;A </strong></div>        
        <div align="center"></div></td>
  </tr>
    <tr align="center" bordercolor="#FFFFFF">
      <td height="24" colspan="4"><font color="#000000" size="2">CONTRASE&Ntilde;A</font>        <font color="#000000" size="2">
        <input name="contra" type="password" id="contra" onKeyPress="return verif_caracter(this,event)" size="20">
        <input type="Submit" name="Submit" id ="Submit" value="OK">
        <input name="cod_socio" type="hidden" value = "<?php echo $cod_socio;?>">
		<input name="cod_animal" type="hidden" value = "<?php echo $cod_animal;?>">
      </font>
        <div align="left"></div>        <div align="left"><strong><font color="#000000" size="2">
      </font></strong></div></td>
  </tr>
    
  <tr>
    <td width="120" height="0"></td>
    <td width="108" colspan="2"></td>
    <td width="333"></td>
  </tr>  
</table>
