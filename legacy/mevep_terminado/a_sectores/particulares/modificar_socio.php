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
.Estilo26 {font-family: "Trebuchet MS"; font-size: 12px; }
.Estilo27 {font-size: 12px}
-->
</style>
<BODY onload = "on_load()">

<?php 
include ("../../conexiones/config.inc.php");

$cod_socio=$_REQUEST["cod_socio"];

include ("variables.php");


?>
<form action="modificar.php" method="post">
<table width="850" border="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr bordercolor="#FFFFFF">
      <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>MODIFICAR PARTICUAR</strong></div></td>
      <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>MODIFICAR CONVENIO </strong></div></td>
  </tr>
    
    <tr bordercolor="#FFFFFF">
      <td width="120" height="24" align="center" bgcolor="#FFFF99">
        <div align="right" class="Estilo26">
          <div align="right">N&ordm; PARTICULAR:  </div>
      </div></td>
      <td width="281" align="center" bgcolor="#EDEDED"><div align="left"> <font color="#000000" size="2">
          <input name="cod_socio" type="hidden" id="cod_socio" onKeyPress="return verif_caracter(this,event)" size="8" maxlength="8" value = "<?php echo $cod_socio;?>" tabindex="1"><?php echo $cod_socio;?>
      </font></div></td>
      <td bgcolor="#FFFF99"><div align="right" class="Estilo26">Importe Cuota</div></td>
      <td bgcolor="#F0F0F0"><strong><font color="#000000" size="2">
        <input name="importe_cuota" type="text" id="importe_cuota"onKeyPress="return verif_caracter(this,event)" value="<?php echo $importe_cuota;?>"  size="12" maxlength="cod_postal" tabindex="13">
      </font></strong></td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td height="24" bgcolor="#FFFF99"><div align="right" class="Estilo27"><span class="Estilo25"><font color="#000000">NUEVO NUMEERO </font></span></div></td>
      <td bgcolor="#EDEDED"><font color="#000000" size="2">
        <input name="cod_socio_nuevo" type="text" id="cod_socio_nuevo"onKeyPress="return verif_caracter(this,event)" size="10" maxlength="60" tabindex="2">
      </font></td>
      <td bgcolor="#FFFF99"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td bgcolor="#F0F0F0"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr bordercolor="#FFFFFF">
      <td height="24" bgcolor="#FFFF99"><div align="right" class="Estilo27"><span class="Estilo25"><font color="#000000">APELLIDO</font></span></div></td>
      <td bgcolor="#EDEDED"><font color="#000000" size="2">
        <input name="apellido" type="text" id="apellido"onKeyPress="return verif_caracter(this,event)" value="<?php echo $apellido;?>" size="40" maxlength="60" tabindex="2">
      </font></td>
      <td bgcolor="#FFFF99"><div align="right" class="Estilo26">Fecha Ingreso </div></td>
      <td bgcolor="#F0F0F0"><font color="#000000" size="2"><strong><font color="#000000" size="2"><strong><font color="#000000" size="2">
        <input name="dia_ingreso" type="text" id="dia_ingreso"onKeyPress="return verif_caracter(this,event)" value="<?php echo $dia_ingreso;?>"  size="2" maxlength="2" tabindex="14">
        / <strong><font color="#000000" size="2">
  <input name="mes_ingreso" type="text" id="mes_ingreso"onKeyPress="return verif_caracter(this,event)" value="<?php echo $mes_ingreso;?>"  size="2" maxlength="2" tabindex="15"> 
  </font></strong>/<strong><font color="#000000" size="2">
  <input name="anio_ingreso" type="text" id="anio_ingreso"onKeyPress="return verif_caracter(this,event)" value="<?php echo $anio_ingreso;?>"  size="4" maxlength="4" tabindex="16">
</font></strong></font></strong></font></strong></font></td>
  </tr>
    <tr bordercolor="#FFFFFF">
      <td height="24" bgcolor="#FFFF99"><div align="right" class="Estilo26">
          <div align="right"><font color="#000000"> NOMBRE </font></div>
      </div></td>
      <td bgcolor="#EDEDED"> <font color="#000000" size="2">
        <input name="nombre" type="text" id= "nombre"onKeyPress="return verif_caracter(this,event)" value="<?php echo $nombre;?>" size="40" maxlength="60" tabindex="3">
      </font></td>
      <td bgcolor="#FFFF99"><div align="right" class="Estilo26">Modo de Pago</div></td>
      <td bgcolor="#F0F0F0"><font color="#000000" size="2">
        <select name="tipo_pago[]" id="tipo_pago" onkeypress="return verif_caracter(this,event)">
          <optgroup label = "Opcion Seleccionada">
          <option value selected = "<?php print("$no_imprimir");?>"><?php print("$tipo_pago_mostrar");?></option>
          </optgroup>
          <optgroup label = "Seleccione">
          <option value="VERDADERO" >LOCAL</option>
          <option value="FALSO">COBRADOR</option>
        </select>
      </font></td>
    <tr bordercolor="#FFFFFF">
      <td height="24" bgcolor="#FFFF99"><span class="Estilo27"></span></td>
      <td bgcolor="#EDEDED"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td bgcolor="#FFFF99"><div align="right" class="Estilo26">Ruta:</div></td>
      <td bgcolor="#F0F0F0"><strong><font color="#000000" size="2"><?php echo $ruta;?></font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td height="24" bgcolor="#FFFF99"><div align="right" class="Estilo26">
        <div align="right"><font color="#000000">TIPO DOCUMENTO</font></div>
    </div></td>
    <td bgcolor="#EDEDED"> <font color="#000000" size="2"><strong><font color="#000000" size="2">
      <select name="tipo_doc[]" id="tipo_doc"onkeypress="return verif_caracter(this,event)" tabindex="4">
	   <optgroup label = "Opcion Seleccionada">
        <option value selected = "<?php print("$tipo_doc");?>"><font color="#000000" size="2"><?php print("$tipo_doc");?></font></option>
        </optgroup>
        <option value = "D.N.I">D.N.I </option>
        <option value = "L.E">L.E </option>
        <option value = "L.C">L.C </option>
      </select>
</font></strong> </font></td>
    <td bgcolor="#FFFF99"><div align="right" class="Estilo26">Cobrador</div></td>
      <td bgcolor="#F0F0F0"><strong><font color="#000000" size="2">
        
        
      <?php 
$sql = "SELECT * FROM cobradores";
$result = $db->Execute($sql);
echo "<select name=cobrador[] size=1 id =nro_os onKeyPress='return verif_caracter(this,event)'>";
?>   <optgroup label = "Opcion Seleccionada">
          <option value selected = "<?php print("$cobrador");?>"><font color="#000000" size="2"><?php print("$cobrador");?></font></option>
          </optgroup>
<?php 

echo"<option value=''>Seleccione COBRADOR</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {

$nombre_cobrador=strtoupper($result->fields["nombre_cobrador"]);

$cod_cobrador=$result->fields["cod_cobrador"];
 

echo"<option value=$cod_cobrador>$cod_cobrador - $nombre_cobrador</option>";
$result->MoveNext();
	}
echo"</select>";
?>



		


    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td height="24" bgcolor="#FFFF99"><div align="right" class="Estilo26">
        <div align="right"><font color="#000000">N&ordm; DOCUMENTO</font></div>
    </div></td>
    <td bgcolor="#EDEDED"><strong><font color="#000000" size="2">
      <input name="documento" type="text" id="documento" onKeyPress="return verif_caracter(this,event)" value="<?php echo $documento;?>"  size="8" maxlength="8" tabindex="5">
    </font></strong></td>
    <td bgcolor="#FFFF99"><div align="right" class="Estilo26">Observaciones</div></td>
    <td bgcolor="#F0F0F0"><strong><font color="#000000" size="2">
      <input name="motivo" type="text" id="motivo" value="<?php echo $motivo;?>"  size="50" maxlength="50" tabindex="18">
    </font></strong></td>
  <tr bordercolor="#FFFFFF">
    <td height="26" bgcolor="#FFFF99"><div align="right" class="Estilo26">
        <div align="right">TEL. FIJO </div>
    </div></td>
    <td bgcolor="#EDEDED"><strong><font color="#000000" size="2">
      <input name="telefono" type="text" id="telefono"onKeyPress="return verif_caracter(this,event)" value="<?php echo $telefono;?>"  size="12" maxlength="12">
    </font></strong></td>
    <td bgcolor="#FFFF99"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td bgcolor="#F0F0F0"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26" bgcolor="#FFFF99"><div align="right" class="Estilo26">
        <div align="right">TEL. CELULAR </div>
    </div></td>
    <td bgcolor="#EDEDED"><strong><font color="#000000" size="2">
      <input name="celular" type="text" id="celular"onKeyPress="return verif_caracter(this,event)" value="<?php echo $celular;?>"  size="12" maxlength="12" tabindex="6">
    </font></strong></td>
    <td colspan="2" bgcolor="#B8B8B8"><div align="center"><font color="#000000" size="2">
      <input type="Submit" name="Submit" id ="Submit" value="MODIFICAR SOCIO" onClick="return confirm('Esta seguro de modificar este Socio');">
    </font></div></td>
  <tr bordercolor="#FFFFFF">
    <td height="26" bgcolor="#FFFF99"><div align="right" class="Estilo26">
        <div align="right">DOMICILIO</div>
    </div></td>
    <td bgcolor="#EDEDED"><font size="2">
      <input name="domicilio" type="text"  id="domicilio" onKeyPress="return verif_caracter(this,event)" value="<?php echo $domicilio;?>" size="40" maxlength="60" tabindex="7">
    </font></td>
    
	<?php if ($habilitar_hc == 0){?>  
	  <td bgcolor="#FFFF99"><div align="center"><span class="Estilo26">Habilitar HC </span></div></td>
      <td bgcolor="#F0F0F0"><input name="habilitar_hc" type="checkbox" id="habilitar_hc" value="1">
      <span class="Estilo26">Codigo Seguridad <strong><font color="#000000" size="2">
      <input name="codigo_seguridad" type="password" id="codigo_seguridad" onKeyPress="return verif_caracter(this,event)"  size="8"  tabindex="5">
      </font></strong></span></td>
<?php }else{?>
	  <td bgcolor="#FFFF99"><div align="center"><span class="Estilo26">Habilitar HC </span></div></td>
      <td bgcolor="#F0F0F0"><input name="habilitar_hc" type="checkbox" id="habilitar_hc" value="0" checked>
      <span class="Estilo26">Codigo Seguridad <strong><font color="#000000" size="2">
      <input name="codigo_seguridad" type="password" id="codigo_seguridad" onKeyPress="return verif_caracter(this,event)"  size="8"  tabindex="5" >
      </font></strong></span></td>
	  <?php }?>



  <tr bordercolor="#FFFFFF">
    <td height="26" bgcolor="#FFFF99"><div align="right" class="Estilo26">
        <div align="right">LOCALIDAD</div>
    </div></td>
    <td bgcolor="#EDEDED"><font color="#000000" size="2"><strong><font color="#000000" size="2">
    <strong><font color="#000000" size="2">
    <input name="localidad" type="text" id="localidad"onKeyPress="return verif_caracter(this,event)" value="<?php echo $localidad;?>"  size="40" maxlength="60" tabindex="8">
    </font></strong> </font></strong> </font></td>
    <td bgcolor="#FFFF99"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td bgcolor="#F0F0F0"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26" bgcolor="#FFFF99"><div align="right" class="Estilo26">
        <div align="right">DEPARTAMENTO</div>
    </div></td>
    <td bgcolor="#EDEDED"><font color="#000000" size="2"><strong><font color="#000000" size="2">
      <select name="departamento[]" id="departamento"onkeypress="return verif_caracter(this,event)" tabindex="9">
         <optgroup label = "Opcion Seleccionada">
        <option value selected = "<?php print("$departamento");?>"><font color="#000000" size="2"><?php print("$departamento");?></font></option>
        </optgroup>
		<optgroup label="Gran Mendoza">
        <option value="Ciudad"><font size="2">Capital</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value="Godoy Cruz"><font size="2">Godoy Cruz</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value="Las Heras"><font size="2">Las Heras</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value="Guaymallen"><font size="2">Guaymallen</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
        <option value="Otro"><font size="2">Otro</font><font size="2"></font><font size="2"></font><font size="2"></font></option>
      </select>
</font></strong> </font></td>
    <td bgcolor="#FFFF99"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td bgcolor="#F0F0F0"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26" bgcolor="#FFFF99"><div align="right" class="Estilo27">COD POSTAL </div></td>
    <td bgcolor="#EDEDED"><strong><font color="#000000" size="2">
      <input name="cod_postal" type="text" id="cod_postal"onKeyPress="return verif_caracter(this,event)" value="<?php echo $cod_postal;?>"  size="12" maxlength="cod_postal" tabindex="10">
    </font></strong></td>
    <td bgcolor="#FFFF99"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td bgcolor="#F0F0F0"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26" bgcolor="#FFFF99"><div align="right" class="Estilo27">MAIL </div></td>
    <td bgcolor="#EDEDED"><font color="#000000" size="2"><strong><font color="#000000" size="2">
      <input name="mail" type="text" id="mail"onKeyPress="return verif_caracter(this,event)" value="<?php echo $mail;?>"  size="40" maxlength="100" tabindex="11">
    </font></strong></font></td>
    <td bgcolor="#FFFF99"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td bgcolor="#F0F0F0"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr bordercolor="#FFFFFF">
    <td height="26" bgcolor="#FFFF99"><div align="right" class="Estilo26">SEXO</div></td>
    <td bgcolor="#EDEDED"><font color="#000000" size="2">
      <select name="sexo[]" id="sexo" onkeypress="return verif_caracter(this,event)" tabindex="12">

        <optgroup label = "Opcion Seleccionada">
        <option value selected = "<?php print("$sexo");?>"><?php print("$sexo_mostrar");?></option>
        </optgroup>
        <optgroup label = "Cambiar por">
          <option value="M">Masculino</option>
        <option value="F">Femenino</option>>        </optgroup>
      </select>
    </font></td>
    <td bgcolor="#FFFF99"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td bgcolor="#F0F0F0"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
    <td height="0"></td>
    <td colspan="2"></td>
    <td></td>
  </tr>  
</table>
