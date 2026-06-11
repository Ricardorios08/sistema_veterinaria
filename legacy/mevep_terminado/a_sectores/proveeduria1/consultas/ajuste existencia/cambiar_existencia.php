<?
$cod_detalle=$_REQUEST["cod_detalle"];

include ("../../../../conexiones/config_pro.php");
$sql1 = "SELECT * FROM existencias  WHERE  `cod_detalle` = $cod_detalle";
$result1 = $db->Execute($sql1);
$cod_mercaderia=strtoupper($result1->fields["cod_mercaderia"]);

$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result = $db->Execute($sql);

$presentacion=strtoupper($result->fields["presentacion"]);
$nombre=strtoupper($result->fields["nombre"]);


$lote=strtoupper($result1->fields["lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$cantidad_ingresada =$result1->fields["cantidad_ingresada"];
$cantidad_salida =$result1->fields["cantidad_salida"];

?>


<script language="javascript">
function on_load()
{
document.getElementById("cantidad_ingresada").focus();
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cantidad_ingresada":
				document.getElementById("cantidad_salida").focus();
				break;

				case "cantidad_salida":
				document.getElementById("OK").focus();
				break;


				
		}
		return false;
	}
	return true;
}


</script>

<?$hoy = date("d/m/y");

?>


<BODY onload = "on_load ()">
<FORM name="form" ACTION="modificar_existencia.php" METHOD = "POST">
<table width="103%" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td height="34" colspan="3"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>MODIFICAR EXISTENCIA DE UN PRODUCTO </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="27%" bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cod. Mercaderia </font></div></td>
      <td width="40%" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <?echo $cod_mercaderia;?>      </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      
      </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;     </font>      
      <div align="right"></div></td>
      <td width="40%" bgcolor="#E1F2EF">
        <div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha Actualizaci&oacute;n</font>: <font color="#006633" size="2" face="Arial, Helvetica, sans-serif">
          <?echo $hoy;?>
        </font></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
      <? echo $nombre; ?></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Presentacion</font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">        <? echo $presentacion; ?> </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right">Lote</div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $lote; ?>
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right">Vencimiento Lote </div></td>
      <td colspan="2" bgcolor="#E1F2EF"><? echo $mes_lote."/".$anio_lote; ?></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Cantidad Ingresada </font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="cantidad_ingresada" id="cantidad_ingresada" onKeyPress="return verif_caracter(this,event)" size="2" value = "<?echo $cantidad_ingresada;?>">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#D0F9FB"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Cantidad Salida </font></div></td>
      <td colspan="2" bgcolor="#E1F2EF"><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="cantidad_salida" id="cantidad_salida" onKeyPress="return verif_caracter(this,event)" size="2" value = "<?echo $cantidad_salida;?>">
</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#E6E6E6">
      <td>&nbsp;</td>
      <td colspan="2"><font size="2" face="Arial, Helvetica, sans-serif">

<input type="hidden" name="cod_detalle" value="<?echo $cod_detalle;?>">

      <input type="Submit" name="guardar" id= "OK" value="MODIFICAR EXISTENCIA" target = "arriba">
      </font></td>
    </tr>
</table>
 
</form>
  
