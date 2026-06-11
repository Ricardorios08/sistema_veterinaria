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
-->
</style>
<BODY onload = "on_load()">

<?php 
include ("../../../conexiones/config.inc.php");



?>
<form action="guardar.php" method="post">
<table width="850" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF">
      <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>NUEVO PLAN </strong></div></td>
  </tr>
    
    
    <tr bordercolor="#FFFFFF">
      <td width="430" height="24"><div align="right" class="Estilo25"> 01 AL 10 
          <div align="right"> </div>
      </div></td>
      <td width="416"> <font color="#000000" size="2">
        <input name="a1_10" type="text" id="a1_10"onKeyPress="return verif_caracter(this,event)" value="<?php echo $a1_10;?>" size="3" maxlength="3" tabindex="3">
      </font></td>
    <tr bordercolor="#FFFFFF">
      <td width="430" height="24"><div align="right" class="Estilo25"> 11 AL 20
          <div align="right"> </div>
      </div></td>
      <td><font color="#000000" size="2">
        <input name="a11_20" type="text" id="a11_20"onKeyPress="return verif_caracter(this,event)" value="<?php echo $a11_20;?>" size="3" maxlength="3" tabindex="3">
      </font></td>
    <tr bordercolor="#FFFFFF">
      <td width="430" height="24"><div align="right" class="Estilo25"> 21 AL 31
          <div align="right"> </div>
      </div></td>
      <td><font color="#000000" size="2">
        <input name="a21_31" type="text" id="a21_31"onKeyPress="return verif_caracter(this,event)" value="<?php echo $a21_31;?>" size="3" maxlength="3" tabindex="3">
      </font></td>
    <tr bordercolor="#FFFFFF">
      <td width="430" height="24"><div align="right" class="Estilo25"> Deuda
          <div align="right"> </div>
      </div></td>
      <td><font color="#000000" size="2">
        <input name="deuda" type="text" id="deuda"onKeyPress="return verif_caracter(this,event)" value="<?php echo $deuda;?>" size="3" maxlength="3" tabindex="3">
      </font></td>
  <tr bordercolor="#FFFFFF">
    <td height="26" colspan="2"><div align="center"><font color="#000000" size="2">
        <input type="submit" name="Submit" id ="Submit" value="GUARDAR">
    </font></div></td>
  <tr>
    <td height="0"></td>
    <td></td>
  </tr>  
</table>
