<script language="javascript">
function on_load()
{
document.getElementById("cod_merca").focus();
document.getElementById("cod_merca").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "cod_merca":
				document.getElementById("nombre").focus();
				break;

				case "nombre":
				document.getElementById("proveedor").focus();
				break;

				case "proveedor":
				document.getElementById("d").focus();
				break;

				case "d":
				document.getElementById("p").focus();
				break;

				case "p":
				document.getElementById("precio_actualizado").focus();
				break;

				case "precio_actualizado":
				document.getElementById("cod_tasa").focus();
				break;

				
				
		}
		return false;
	}
	return true;
}


</script>


<?php $hoy = date("d/m/y");

$cod_merca= $_REQUEST['cod_merca'];
include ("variables.php");
?>


<BODY onload = "on_load ()">
<FORM name="form" ACTION="modificar.php" METHOD = "POST">
<table width="850" border="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666"> 
      <td height="34" colspan="3"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>MODIFICAR MERCADERIA </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="27%" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cod. Mercaderia </font></div></td>
      <td width="80%" colspan="2" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="cod_merca" id="cod_merca" onKeyPress="return verif_caracter(this,event)" size="30" value = "<?php echo $cod_merca;?>">  <input type="text" name="cod_merca_nuevo" id="cod_merca_nuevo" onKeyPress="return verif_caracter(this,event)" size="30" > 
      </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="nombre" type="text"  id="nombre" onKeyPress="return verif_caracter(this,event)" value="<?php  echo $nombre; ?>"  size="70">
</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Proveedor</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB">
        <?php 
include ("../../../conexiones/config_pro.php");
$sql="select * from proveedores order by denominacion";
$result = $db->Execute($sql);
echo "<select name=proveedor[] size=1 id =proveedor onKeyPress='return verif_caracter(this,event)'>";
?><option value="<?php "$proveedor";?>"><?php print("$denominacion");?></option><?php 
echo"<option value=''>------</option>";
echo"<option value='0'>Otro</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cuenta"];
$a1=strtoupper($result->fields["denominacion"]);
echo"<option value=$cod>$a1</option>";
$result->MoveNext();
	}
echo"</select>";
?> 
</td>
    </tr>
   
	
	<?php if ($tipo_moneda == "d"){?>
	<tr bordercolor="#FFFFFF"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Moneda</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">
        </font>        <font size="2" face="Arial, Helvetica, sans-serif">
        </font>        <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">&nbsp; Dolar</font>
        <input name="tipo_moneda" type="radio" value="d" checked>
        <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Pesos</font>
        <input name="tipo_moneda" type="radio" value="p">
      </div></td>
    </tr>
<?php }else{?>
	<tr bordercolor="#FFFFFF"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Moneda</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">
        </font>        <font size="2" face="Arial, Helvetica, sans-serif">
        </font>        <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">&nbsp; Dolar</font>
        <input name="tipo_moneda" type="radio" value="d" >
        <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Pesos</font>
        <input name="tipo_moneda" type="radio" value="p" checked>
      </div></td>
    </tr>

<?php }?>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Precio</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="precio_actualizado" type="text" id ="precio_actualizado" onKeyPress="return verif_caracter(this,event)" value="<?php  echo $precio_actualizado; ?>" size="5">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Tasa</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB">
        <?php 
include ("../../../conexiones/config_pro.php");
$sql="select * from tasas order by cod_tasa";
$result = $db->Execute($sql);
echo "<select name=cod_tasa[] size=1 id =cod_tasa onKeyPress='return verif_caracter(this,event)'>";
?>     
<option value="<?php "$por_iva";?>"><?php print("$por_iva");?></option><?php 
    echo"<option value=''>------</option>";
echo"<option value='0'>Ninguna</option>";
      
if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cod_tasa"];
$iva_normal=$result->fields["iva_normal"];
$iva_recargo=$result->fields["iva_recargo"];
$tasa = "Tasa ".$cod." - Socios: ".$iva_normal." - Part.: ".$iva_recargo;
echo"<option value=$cod>$tasa</option>";
$result->MoveNext();
	}
?>
      <?php 
echo"</select>";
?>
<font size="2" face="Arial, Helvetica, sans-serif">&nbsp;
        </font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#666666">
      <td colspan="3"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
          <input type="Submit" name="guardar" id= "guardar" value="MODIFICAR MERCADERIA" target = "arriba">
      </font></div></td>
    </tr>
</table>
 
</form>
  
