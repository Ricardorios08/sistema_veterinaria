<link href="../../../laboratorio/css/fondo.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function on_load()
{
document.getElementById("cod_socio").focus();
}


function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cod_socio":
				document.getElementById("apellido").focus();
				break;
				case "apellido":
				document.getElementById("nombre").focus();
				break;
				case "nombre":
				document.getElementById("tipo_doc").focus();
				break;
				case "tipo_doc":
				document.getElementById("documento").focus();
				break;
				case "documento":
				document.getElementById("telefono").focus();
				break;

				case "telefono":
				document.getElementById("celular").focus();
				break;
				case "celular":
				document.getElementById("domicilio").focus();
				break;
				case "domicilio":
				document.getElementById("localidad").focus();
				break;
				case "localidad":
				document.getElementById("departamento").focus();
				break;
				case "departamento":
				document.getElementById("cod_postal").focus();
				break;
				case "cod_postal":
				document.getElementById("mail").focus();
				break;

				case "mail":
				document.getElementById("sexo").focus();
				break;
			
				
				
				case "sexo":
				document.getElementById("nombre_mascota").focus();
				break;				
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
				document.getElementById("sexo_mascota").focus();
				break;				
				case "sexo_mascota":
				document.getElementById("dia_nac").focus();
				break;				
				case "dia_nac":
				document.getElementById("mes_nac").focus();
				break;				
				case "mes_nac":
				document.getElementById("anio_nac").focus();
				break;				
				case "anio_nac":
				document.getElementById("importe_cuota").focus();
				break;				
				
				
				
				
				
				
				
				
				case "importe_cuota":
				document.getElementById("dia_ingreso").focus();
				break;				
				case "dia_ingreso":
				document.getElementById("mes_ingreso").focus();
				break;
				case "mes_ingreso":
				document.getElementById("anio_ingreso").focus();
				break;
				case "anio_ingreso":
				document.getElementById("tipo_pago").focus();
				break;				
				case "tipo_pago":
				document.getElementById("ruta").focus();
				break;
				case "ruta":
				document.getElementById("motivo").focus();
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
.Estilo26 {font-size: 12px}
-->
</style>
<BODY onload = "on_load()">

<?php 

$anio = date("Y");
include ("../../conexiones/config.inc.php");
 $sql="select * from socios where cod_socio < 82500 ORDER BY cod_socio DESC";
$result = $db->Execute($sql);

$cod_socio=($result->fields["cod_socio"] + 1);

 $sql="select * from socios  ORDER BY ruta DESC";
$result = $db->Execute($sql);

$ruta=($result->fields["ruta"] + 1);


?>
<form action="generar_cuota.php" method="post">
<table width="728" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF">
      <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>GENERA CUOTAS</strong></div></td>
  </tr>
    <tr bordercolor="#FFFFFF">
      <td width="254" height="24" align="center">
        <div align="right" class="Estilo25 Estilo26">
          <div align="right">Mes</div>
      </div></td>
      <td width="470" align="center"><div align="left"> <font color="#000000" size="2">
      <strong><font color="#000000" size="2">
      <select name="mes[]" id="mes"onkeypress="return verif_caracter(this,event)" tabindex="4">
<option value = "01">ENERO</option>
<option value = "02">FEBRERO</option>
<option value = "03">MARZO</option>
<option value = "04">ABRIL</option>
<option value = "05">MAYO</option>
<option value = "06">JUNIO</option>
<option value = "07">JULIO</option>
<option value = "08">AGOSTO</option>
<option value = "09">SEPTIEMBRE</option>
<option value = "10">OCTUBRE</option>
<option value = "11">NOVIEMBRE</option>
<option value = "12">DICIEMBRE</option>
      </select>
      </font></strong>
      
</font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td height="24"><div align="right"><span class="Estilo25"><font color="#000000" size="2">A&ntilde;o</font></span></div></td>
      <td><font color="#000000" size="2">
        <input name="anio" type="text" id="anio"onKeyPress="return verif_caracter(this,event)" value="<?php echo $anio;?>" size="40" maxlength="60" tabindex="2">
        
      </font></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td height="26"> <div align="right">Seguridad: </div></td>
    <td height="26"><input name="seg" type="password" id="seg"onKeyPress="return verif_caracter(this,event)" size="6" maxlength="6" tabindex="2"></td>
  <tr bordercolor="#FFFFFF">
    <td height="26" colspan="2"><div align="center"><font color="#000000" size="2">
        <input type="Submit" name="Submit" id ="Submit" value="GENERAR CUOTA" tabindex="29" onClick="return confirm('Si esta todo correcto Presione Aceptar');">
    </font></div></td>
  <tr>
    <td height="0"></td>
    <td></td>
  </tr>  
</table>
