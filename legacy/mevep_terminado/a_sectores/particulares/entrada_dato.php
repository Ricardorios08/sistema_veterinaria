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
include ("../../conexiones/config.inc.php");
 $sql="select * from particulares where cod_socio < 82500 ORDER BY cod_socio DESC";
$result = $db->Execute($sql);

$cod_socio=($result->fields["cod_socio"] + 1);

 $sql="select * from particulares  ORDER BY ruta DESC";
$result = $db->Execute($sql);

$ruta=($result->fields["ruta"] + 1);


?>
<form action="guardar.php" method="post">
<table width="850" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF">
      <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>INGRESO PARTICULAR NUEVO</strong></div></td>
      <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>INGRESO MASCOTA </strong></div></td>
  </tr>
    <tr align="center" bordercolor="#FFFFFF">
      <td width="120" height="24"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td width="281"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="2"><div align="left"><strong><font color="#000000" size="2">
      </font></strong></div></td>
  </tr>
    <tr bordercolor="#FFFFFF">
      <td width="120" height="24" align="center">
        <div align="right" class="Estilo25">
          <div align="right">N&ordm; PARTICULAR </div>
      </div></td>
      <td width="281" align="center"><div align="left"> <font color="#000000" size="2">
      <input name="cod_socio" type="text" id="cod_socio" onKeyPress="return verif_caracter(this,event)" size="8" maxlength="8" value = "<?php echo $cod_socio;?>" tabindex="1">
</font></div></td>
      <td width="108" align="center"> <div align="right">MASCOTA </div></td>
      <td width="333"><strong><font color="#000000" size="2">
        <input name="nombre_mascota" type="text" id="nombre_mascota"onKeyPress="return verif_caracter(this,event)" value="<?php echo $nombre_mascota;?>"  size="40" maxlength="40" tabindex="13">
      </font></strong></td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td height="24"><div align="right"><span class="Estilo25"><font color="#000000" size="2">APELLIDO</font></span></div></td>
      <td><font color="#000000" size="2">
        <input name="apellido" type="text" id="apellido"onKeyPress="return verif_caracter(this,event)" value="<?php echo $apellido;?>" size="40" maxlength="60" tabindex="2">
      </font></td>
      <td><div align="right">ESPECIE</div></td>
      <td><strong><font color="#000000" size="2">
        <input name="especie" type="text" id="especie"onKeyPress="return verif_caracter(this,event)" value="<?php echo $especie;?>"  size="40" maxlength="40" tabindex="14">
      </font></strong></td>
  </tr>
    <tr bordercolor="#FFFFFF">
      <td height="24"><div align="right" class="Estilo25">
          <div align="right"><font color="#000000" size="2"> NOMBRE </font></div>
      </div></td>
      <td> <font color="#000000" size="2">
        <input name="nombre" type="text" id="nombre"onKeyPress="return verif_caracter(this,event)" value="<?php echo $nombre;?>" size="40" maxlength="60" tabindex="3">
      </font></td>
      <td><div align="right">RAZA</div></td>
      <td><strong><font color="#000000" size="2">
        <input name="raza" type="text" id="raza"onKeyPress="return verif_caracter(this,event)" value="<?php echo $raza;?>"  size="40" maxlength="40" tabindex="15">
      </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td height="24"><div align="right" class="Estilo25">
        <div align="right"><font color="#000000" size="2">TIPO DOCUMENTO</font></div>
    </div></td>
    <td> <font color="#000000" size="2"><strong><font color="#000000" size="2">
      <select name="tipo_doc[]" id="tipo_doc"onkeypress="return verif_caracter(this,event)" tabindex="4">
        <option value = "D.N.I">D.N.I </option>
        <option value = "L.E">L.E </option>
        <option value = "L.C">L.C </option>
      </select>
    </font></strong> </font></td>
      <td><div align="right">PELAJE</div></td>
      <td><strong><font color="#000000" size="2">
        <input name="pelaje" type="text" id="pelaje"onKeyPress="return verif_caracter(this,event)" value="<?php echo $pelaje;?>"  size="40" maxlength="40" tabindex="16"> 
      </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td height="24"><div align="right" class="Estilo25">
        <div align="right"><font color="#000000" size="2">N&ordm; DOCUMENTO</font></div>
    </div></td>
    <td><strong><font color="#000000" size="2">
      <input name="documento" type="text" id="documento" onKeyPress="return verif_caracter(this,event)" value="<?php echo $documento;?>"  size="8" maxlength="8" tabindex="5">
    </font></strong></td>
    <td><div align="right">TAMA&Ntilde;O</div></td>
    <td><strong><font color="#000000" size="2">
      <input name="tamanio" type="text" id="tamanio"onKeyPress="return verif_caracter(this,event)" value="<?php echo $tamanio;?>"  size="40" maxlength="40" tabindex="17">
    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><div align="right" class="Estilo25">
        <div align="right"><font size="2">TEL. FIJO </font></div>
    </div></td>
    <td><strong><font color="#000000" size="2">
      <input name="telefono" type="text" id="telefono"onKeyPress="return verif_caracter(this,event)" value="<?php echo $telefono;?>"  size="12" maxlength="12" tabindex="6">
    </font></strong></td>
    <td><div align="right">COLOR</div></td>
    <td><strong><font color="#000000" size="2">
    <input name="color" type="text" id="color"onKeyPress="return verif_caracter(this,event)" value="<?php echo $color;?>"  size="40" maxlength="40" tabindex="18">
</font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><div align="right" class="Estilo25">
        <div align="right"><font size="2">TEL. CELULAR </font></div>
    </div></td>
    <td><strong><font color="#000000" size="2">
      <input name="celular" type="text" id="celular"onKeyPress="return verif_caracter(this,event)" value="<?php echo $celular;?>"  size="12" maxlength="12" tabindex="7">
    </font></strong></td>
    <td><div align="right"><font color="#000000" size="2"><font color="#000000">SEXO</font> </font></div></td>
    <td><font color="#000000" size="2">
      <select name="sexo_mascota[]" id="sexo_mascota" onkeypress="return verif_caracter(this,event)" tabindex="19">
        <option value="Hembra">Hembra</option>
        <option value="Macho">Macho</option>
      </select>
    </font></td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><div align="right" class="Estilo25">
        <div align="right"><font size="2">DOMICILIO</font></div>
    </div></td>
    <td><font size="2">
      <input name="domicilio" type="text"  id="domicilio" onKeyPress="return verif_caracter(this,event)" value="<?php echo $domicilio;?>" size="40" maxlength="60" tabindex="8">
    </font></td>

      <td><div align="right"> NACIMIENTO</div></td>
      <td><font color="#000000" size="2"><strong><font color="#000000" size="2">
       <strong><font color="#000000" size="2">
       <input name="dia_nac" type="text" id="dia_nac"onKeyPress="return verif_caracter(this,event)" value="<?php echo $dia_nac;?>"  size="2" maxlength="2" tabindex="20">
/ <strong><font color="#000000" size="2">
<input name="mes_nac" type="text" id="mes_nac"onKeyPress="return verif_caracter(this,event)" value="<?php echo $mes_nac;?>"  size="2" maxlength="2" tabindex="21">
</font></strong>/<strong><font color="#000000" size="2">
<input name="anio_nac" type="text" id="anio_nac"onKeyPress="return verif_caracter(this,event)" value="<?php echo $anio_nac;?>"  size="4" maxlength="4" tabindex="22">
</font></strong></font></strong> </font></strong>
      </font></td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><div align="right" class="Estilo25">
        <div align="right"><font size="2">LOCALIDAD</font></div>
    </div></td>
    <td><font color="#000000" size="2"><strong><font color="#000000" size="2">
      <input name="localidad" type="text" id="localidad"onKeyPress="return verif_caracter(this,event)" value="<?php echo $localidad;?>"  size="40" maxlength="60">
    </font></strong> </font></td>
    <td colspan="2"><div align="right"></div>      
    <div align="center"></div></td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><div align="right" class="Estilo25">
        <div align="right"><font size="2">DEPARTAMENTO</font></div>
    </div></td>
    <td><font color="#000000" size="2"><strong><font color="#000000" size="2">
      <select name="departamento[]" id="departamento"onkeypress="return verif_caracter(this,event)" tabindex="9">
        <optgroup label="Gran Mendoza">
        <option value="Ciudad"><font size="2">Capital</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value="Godoy Cruz"><font size="2">Godoy Cruz</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value="Las Heras"><font size="2">Las Heras</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value="Guaymallen"><font size="2">Guaymallen</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value="Lujan"><font size="2">Otro</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
      </select>
    </font></strong> </font></td>
    <td colspan="2" bgcolor="#CCCCCC"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><div align="right"><font size="2">COD POSTAL </font></div></td>
    <td><strong><font color="#000000" size="2">
    <input name="cod_postal" type="text" id="cod_postal"onKeyPress="return verif_caracter(this,event)" value="<?php echo $cod_postal;?>"  size="12" maxlength="cod_postal" tabindex="10">
</font></strong></td>
    <td><div align="center">Observaciones</div></td>
    <td><strong><font color="#000000" size="2">
      <input name="motivo" type="text" id="motivo2"onKeyPress="return verif_caracter(this,event)" value="<?php echo $observaciones;?>"  size="50" maxlength="50" tabindex="28">
    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><div align="right">MAIL<font size="2"> </font></div></td>
    <td><font color="#000000" size="2"><strong><font color="#000000" size="2">
      <input name="mail" type="text" id="mail"onKeyPress="return verif_caracter(this,event)" value="<?php echo $mail;?>"  size="40" maxlength="100" tabindex="11">
    </font></strong></font></td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><div align="right" class="Estilo25"><font size="2">SEXO</font></div></td>
    <td><font color="#000000" size="2">
      <select name="sexo[]" id="sexo" onkeypress="return verif_caracter(this,event)" tabindex="12">
        <option value="M">Masculino</option>
        <option value ="F">Femenino</option>
      </select>
    </font></td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26" colspan="2"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26" colspan="2"><div align="center"><font color="#000000" size="2">
    <input type="Submit" name="Submit" id ="Submit" value="GUARDAR PARTICULAR" tabindex="29" onClick="return confirm('Si esta todo correcto Presione Aceptar');">
</font></div></td>
    <td><div align="right"></div></td>
    <td><strong><font color="#000000" size="2">
    </font></strong></td>
  <tr>
    <td height="0"></td>
    <td colspan="2"></td>
    <td></td>
  </tr>  
</table>
