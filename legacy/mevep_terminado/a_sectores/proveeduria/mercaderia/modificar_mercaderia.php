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
<table width="860" border="0" cellspacing="0">
    <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666"> 
      <td height="34" colspan="3"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong>MODIFICAR MERCADERIA </strong></font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE"> 
      <td width="27%" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Cod. Barra </font></div></td>
      <td width="80%" colspan="2" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="cod_merca" id="cod_merca" onKeyPress="return verif_caracter(this,event)" size="30" value = "<?php echo $cod_merca;?>">
      Nuevo Codigo: 
      <input type="text" name="cod_merca_nuevo" id="cod_merca_nuevo" onKeyPress="return verif_caracter(this,event)" size="30" > 
      </font><font color="#006633" size="2" face="Arial, Helvetica, sans-serif">&nbsp;
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC"> 
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nombre</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="nombre" type="text"  id="nombre" onKeyPress="return verif_caracter(this,event)" value="<?php  echo $nombre; ?>"  size="100">
</font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Descripcion</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="descripcion" type="text"  id="descripcion" onKeyPress="return verif_caracter(this,event)" value="<?php  echo $descripcion; ?>"  size="100">
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

echo"<option value=''>Seleccione</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cuenta"];
$a1=strtoupper($result->fields["denominacion"]);
echo"<option value=$cod>$a1</option>";
$result->MoveNext();
	}
echo"</select>";
?></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nuevo proveedor</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="nuevo_proveedor" type="text"  id="nuevo_proveedor" onKeyPress="return verif_caracter(this,event)"  size="80">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Categoria</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><?php 
include ("../../../conexiones/config_pro.php");
$sql="select * from categoria order by categoria";
$result = $db->Execute($sql);
echo "<select name=categoria[] size=1 id =categoria onKeyPress='return verif_caracter(this,event)'>";
?>
          <option value="<?php "$cod_categoria";?>"><?php print("$categoria");?></option>
        <?php 

echo"<option value=''>Seleccione</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cod_categoria"];
$a1=strtoupper($result->fields["categoria"]);
echo"<option value=$cod>$a1</option>";
$result->MoveNext();
	}
echo"</select>";
?>      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nueva Categoria </font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="nueva_categoria" type="text"  id="nueva_categoria" onKeyPress="return verif_caracter(this,event)"  size="80">
      </font></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Marca</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><?php 
include ("../../../conexiones/config_pro.php");
$sql="select * from marca1 order by marca";
$result = $db->Execute($sql);
echo "<select name=marca[] size=1 id =marca onKeyPress='return verif_caracter(this,event)'>";
?>
          <option value="<?php "$cod_marca";?>"><?php print("$marca");?></option>
        <?php 
echo"<option value=''>Seleccione</option>";

if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod=$result->fields["cod_marca"];
$a1=strtoupper($result->fields["marca"]);
echo"<option value=$cod>$a1</option>";
$result->MoveNext();
	}
echo"</select>";
?>      </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Nueva marca</font></div></td>
      <td colspan="2" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
        <input name="nueva_marca" type="text"  id="nueva_marca" onKeyPress="return verif_caracter(this,event)"  size="80">
      </font></td>
    </tr>
   
	
 
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
<option value="<?php "$cod_tasa";?>"><?php print("$renglon");?></option><?php 
 
echo"<option value=''>Seleccione</option>";
      
if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cod_tasa=$result->fields["cod_tasa"];
$tasa=$result->fields["iva_normal"];
$iva_recargo=$result->fields["iva_recargo"];
echo"<option value=$cod_tasa>$cod_tasa - Particular: $iva_recargo Desc. Socio: $tasa </option>";
$result->MoveNext();
	}
?>
      <?php 
echo"</select>";
?>
<font size="2" face="Arial, Helvetica, sans-serif">&nbsp;        </font> </td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#666666">
      <td colspan="3"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
          <input type="Submit" name="guardar" id= "guardar" value="MODIFICAR MERCADERIA" target = "arriba">
      </font></div></td>
    </tr>
</table>
 
</form>
  
