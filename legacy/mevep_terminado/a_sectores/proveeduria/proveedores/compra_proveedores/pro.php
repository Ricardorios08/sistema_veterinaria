            <input type = "hidden" name = "nro_laboratorio" id="nro_laboratorio" size = "6" maxlength="4" value="<?echo $nro_laboratorio;?>"onKeyPress="return verif_caracter(this,event)">
            <?


$nro_laboratorio = $_REQUEST['nro_laboratorio'];
include ("../../conexiones/config.inc.php");

	if (is_numeric($nro_laboratorio))  {
$sql="select * from datos_laboratorio where nro_laboratorio = '$nro_laboratorio%'";
$result = $db->Execute($sql);

								}
	else {
$sql = "select * from datos_laboratorio where nombre_laboratorio like '$nro_laboratorio%'";
$result = $db->Execute($sql);
		}
		
		$result = $db->Execute($sql);

 if (!$result) die("fallo".$db->ErrorMsg());


$nro_laboratorio=ucwords($result->fields["nro_laboratorio"]);
$nombre_laboratorio=ucwords($result->fields["nombre_laboratorio"]);

if ($nombre_laboratorio == ""){
	?>
            <font color="#FF0000"><?echo "No existe ese Laboratorio o cuenta (".$nro_laboratorio.")";?></font><?
}

else{
?>
            <font color="#006633"><strong><strong><font color="#006633"><strong><strong> 
			<font color="#006633"><strong><strong><strong><?echo $nombre_laboratorio." (".$nro_laboratorio.")";?>
			</strong></strong></strong>
			</font></strong></strong></font></strong></strong></font> </strong></font><font color="#000000">Observaciones:</font>
            <input type = "hidden" id="observaciones" name = "observaciones" size = "30" value="<?php if (isset($_REQUEST['observaciones'])) echo $_REQUEST['observaciones'];?>" onKeyPress="return verif_caracter(this,event)">
            <?echo "(".$observaciones.")";?> <font color="#FFFFFF"><strong><font size="2">
            </font></strong></font></div></td>