<script language="javascript">
function on_load()

{
document.getElementById("nro_os").focus();
}



</script>

<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo3 {font-family: Arial, Helvetica, sans-serif}
.Estilo4 {font-size: 10px}
.Estilo37 {font-size: 12px}
.Estilo41 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo42 {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>


<?php 
$anio_a_fact = date("y"); 
$mes = date("m");

switch ($mes)
	{
		case "1":{$periodo= "ENE";}break;
		case "2":{$periodo= "FEB";}break;
		case "3":{$periodo= "MAR";}break;
		case "4":{$periodo= "ABR";}break;
		case "5":{$periodo= "MAY";}break;
		case "6":{$periodo= "JUN";}break;
		case "7":{$periodo= "JUL";}break;
		case "8":{$periodo= "AGO";}break;
		case "9":{$periodo= "SET";}break;
		case "10":{$periodo="OCT";}break;
		case "11":{$periodo="NOV";}break;
		case "12":{$periodo="DIC";}break;
				}


?>


<BODY onload = "on_load ()" >
<form action ="separar.php" method="post">


  <div align="left"></div>
  <table width="103%" border="0">
    <tr bgcolor="#0000CC">
      <td height="33" colspan="4"><div align="center"><span class="Estilo1 Estilo3">SEPARAR ORDENES PARA FACTURAR</span><br>
      </div></td>
    </tr>
    <tr bgcolor="#E1F2EF" class="Estilo4">
      <td height="22" colspan="2"><div align="center" class="Estilo42">ORDENES ACTUALES </div></td>
      <td colspan="2" bgcolor="#E6E6E6"><div align="center"><span class="Estilo42">ORDENES NUEVAS</span></div></td>
    </tr>
    <tr bgcolor="#E1F2EF" class="Estilo4">
      <td><div align="right" class="Estilo3 Estilo37">Periodo</div></td>
      <td width="255">
	  
		  <span class="Estilo3">
		<select name="mes[]" id="mes">
	      <option value="<?php echo $mes;?>"><font size="01"><?php echo $periodo;?></font><font size="01"></font></option>
	      <option value="01"><font size="01">ENE</font><font size="01"></font></option>
          <option value="02"><font size="02">FEB</font><font size="02"></font></option>
          <option value="03"><font size="03">MAR</font><font size="03"></font></option>
          <option value="04"><font size="04">ABR</font><font size="04"></font></option>
          <option value="05"><font size="05">MAY</font><font size="05"></font></option>
          <option value="06"><font size="06">JUN</font><font size="06"></font></option>
          <option value="07"><font size="07">JUL</font><font size="07"></font></option>
          <option value="08"><font size="08">AGO</font><font size="08"></font></option>
          <option value="09"><font size="09">SET</font><font size="09"></font></option>
	      <option value="10"><font size="10">OCT</font><font size="10"></font></option>
          <option value="11"><font size="11">NOV</font><font size="11"></font></option>
	      <option value="12"><font size="12">DIC</font><font size="12"></font></option>
        </select>
		<input type="text" name="anio_a_fact" value= "<?php echo $anio_a_fact;?>" size ="4"> 
		  </span></td>
      <td bgcolor="#E6E6E6"><div align="right"><span class="Estilo41">Nuevo Lote</span></div></td>
      <td width="255" bgcolor="#E6E6E6"><span class="Estilo3">
        <input type="text" name="lote2" id= "lote2" size ="30">
      </span></td>
    </tr>
    <tr bgcolor="#E1F2EF" class="Estilo4">
      <td width="184"><div align="right" class="Estilo41">Obra Social</div></td>
      <td><span class="Estilo3">
        <input type="text" name="nro_os" id= "nro_os" size ="3">
      </span></td>
	      <td width="184" bgcolor="#E6E6E6"><div align="right" class="Estilo41"></div></td>
	      <td bgcolor="#E6E6E6"><span class="Estilo3">
	        <input name="boton2" type="submit" value="Convertir">
</span></td>
    </tr>
		    <tr bgcolor="#E1F2EF">
		      <td class="Estilo4"><div align="right"><span class="Estilo41">Desde</span></div></td>
		      <td> <input name = "dia_d" type = "text" id="dia_d" value="01" size = "2">
  /
  <input name = "mes_d" type = "text" id="mes_d" size = "2">
  /
  <input name = "anio_d" type = "text" id="anio_d" value="<?php echo $anio_a_fact;?>" size = "4"></td>
              <td bgcolor="#E6E6E6" class="Estilo4">&nbsp;</td>
              <td bgcolor="#E6E6E6">&nbsp;</td>
    </tr>
		    <tr bgcolor="#E1F2EF">
		      <td class="Estilo4"><div align="right"><span class="Estilo41">Hasta</span></div></td>
		      <td> <input name = "dia_h" type = "text" id="dia_h" value="31" size = "2">
  /
  <input name = "mes_h" type = "text" id="mes_h" size = "2">
  /
  <input name = "anio_h" type = "text" id="anio_h" value="<?php echo $anio_a_fact;?>" size = "4"></td>
              <td bgcolor="#E6E6E6" class="Estilo4">&nbsp;</td>
              <td bgcolor="#E6E6E6">&nbsp;</td>
    </tr>
		    <tr bgcolor="#E1F2EF">
		      <td class="Estilo4"><div align="right" class="Estilo41">Lote</div></td>
		      <td><span class="Estilo3">
		        <input type="text" name="lote" id= "lote" size ="30">
</span></td>
              <td bgcolor="#E6E6E6" class="Estilo4"><div align="right" class="Estilo41"></div></td>
              <td bgcolor="#E6E6E6"><span class="Estilo3">              </span></td>
    </tr>
  </table>
</form>
