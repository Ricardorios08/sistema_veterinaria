<style type="text/css">
<!--
.Estilo15 {color: #FFFFFF}
.Estilo16 {font-family: Arial, Helvetica, sans-serif}
.Estilo17 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
<BODY onload = "on_load()">
<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">

<table width="200" border="0">
  <!--DWLayoutTable-->
  <tr bgcolor="#000099">
    <td height="24" colspan="5" valign="top"><div align="center" class="Estilo15 Estilo16">Consulta N&ordm; Cuenta: 
          <input name="cuenta" type="text" id="cuenta" size="10">
      </div></td>
    </tr>
  <tr>
    <td width="41"><input type="submit" name="Alta" value="ABM" id="Alta1"></td>
    <td width="70"><input type="submit" name="Alta" value="Prov ABM" id="Alta2"></td>
	<td width="94"><input type="submit" name="Alta" value="Prov Externos" id="Alta2"></td>
    <td width="76"><input type="submit" name="Alta" value="O.Sociales" id="Alta6"></td>
    <td width="47"><input type="submit" name="Alta" value="Mega" id="Alta4"></td>
  </tr>
</table>
</form>


<?
if(isset($_REQUEST['Alta'])) {

	switch ($_REQUEST['Alta'])
					{
						
			case "O.Sociales":	{
 
$cuenta=$_REQUEST ['cuenta'];
 include ("buscar_impagas.php");
 break;	}

 case "ABM":	{
 
$cuenta=$_REQUEST ['cuenta'];
 include ("buscar_deudas.php");
 break;	}



case "Prov ABM":
				{

 include ("buscar_prov_abm.php");

 break;	}

 case "Prov Externos":
				{

 include ("buscar_prov_ext.php");

 break;	}



					}
}
?>