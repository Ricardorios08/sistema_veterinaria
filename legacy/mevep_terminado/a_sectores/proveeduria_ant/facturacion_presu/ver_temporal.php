<style type="text/css">
<!--
.Estilo9 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFF00;
	font-size: 36px;
}
.Estilo10 {font-family: Arial, Helvetica, sans-serif}
.Estilo12 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FF0000;
	font-size: 36px;
	font-weight: bold;
}
.Estilo13 {
	color: #000000;
	font-size: 16px;
}
.Estilo14 {font-family: Arial, Helvetica, sans-serif; color: #000000; }
.Estilo19 {font-size: 16px}
.Estilo22 {color: #000000; font-weight: bold; font-size: 16px; }
.Estilo23 {font-family: Arial, Helvetica, sans-serif; color: #000000; font-size: 16px; font-weight: bold; }
-->
</style>

<?
include ("../../../conexiones/config_pro.php");

$sql = "TRUNCATE TABLE `ventas1_deta_temp_pc2`";
mysql_query($sql);
$sql = "TRUNCATE TABLE `ventas1_encab_temp_pc2`";
mysql_query($sql);


$sql = "SELECT * FROM `ventas1_encab_temp_pc2`";
$result = $db->Execute($sql);

$operador=$result->fields["operador"];
$nro_factura=$result->fields["nro_factura"];
$tipo_fact=$result->fields["tipo_fact"];
$denominacion=$result->fields["denominacion"];
$fecha=$result->fields["fecha"];



if ($nro_factura == ""){
include ("entrada_factura.php");
}else{
?>

<FORM ACTION="actualiza_pendiente.php" METHOD = "POST">
<table width="571" border="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="60" colspan="3" bgcolor="#FF0000"><div align="center" class="Estilo9"><BLINK><strong>FACTURA SIN ACTUALIZAR </strong></BLINK></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF99"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td colspan="2" bgcolor="#FFFFCC"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td width="126" bgcolor="#FFFF99"><div align="right" class="Estilo13 Estilo10"><strong>N&ordm; FACTURA </strong></div></td>
    <td colspan="2" bgcolor="#FFFFCC"><span class="Estilo22"><?ECHO $tipo_fact;?> - <?ECHO $nro_factura;?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF99"><div align="right" class="Estilo14 Estilo19"><strong>OPERADOR</strong></div></td>
    <td colspan="2" bgcolor="#FFFFCC"><span class="Estilo22"><?ECHO $operador;?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF99"><div align="right" class="Estilo23">CUENTA</div></td>
    <td colspan="2" bgcolor="#FFFFCC"><span class="Estilo22"><?ECHO $denominacion;?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF99"><div align="right" class="Estilo23">FECHA</div></td>
    <td colspan="2" bgcolor="#FFFFCC"><span class="Estilo22"><?ECHO $fecha;?></span></td>
  </tr>
  <tr>
    <td height="120" colspan="3" bgcolor="#FFFF99"><div align="center"><span class="Estilo12">¿DESEA ACTUALIZARLA?</span></div></td>
    </tr>
  <tr>
    <td height="21" colspan="2" valign="top" bgcolor="#FFFF99"><div align="right">
      <input name="confirma" type="text" class="Estilo12" size="2" maxlength="2">
	        <input name="fact" type="hidden" value = "<?echo $tipo_fact;?>">
			<input name="tipo_factura" type="hidden" value = "<?echo $tipo_fact;?>">
			<input name="nro_factura" type="hidden" value = "<?echo $nro_factura;?>">

			
    </div></td>
    <td width="303" valign="middle" bgcolor="#FFFFCC"><span class="Estilo10"><strong>ESCRIBA SI / NO </strong></span></td>
  </tr>
  <tr>
    <td height="21" colspan="3" valign="top" bgcolor="#FFFF99"><div align="center">
      <input name="Submit" type="submit" class="Estilo12" value="ACEPTAR">
    </div></td>
  </tr>
</table>
</form>
<?

}


?>
