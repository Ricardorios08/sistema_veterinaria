<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo3 {color: #000000}
.Estilo4 {font-family: Arial, Helvetica, sans-serif}
-->
</style>

<FORM name="form" ACTION="<?php php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">
<table width="307" border="0">
  <tr bgcolor="#0033CC">
    <th height="31" colspan="2" scope="col"><span class="Estilo1">
      <?php include ("prueba.php");?></span></th>
  </tr>
  <tr bgcolor="#0033CC">
    <th height="31" colspan="2" scope="col"><span class="Estilo1">EXPORTAR - ORDENES </span></th>
  </tr>
  <tr bgcolor="#DAFAFC">
    <td width="175"><div align="right">Nombre del Archivo
    </div></td>
    <td width="122"><input type = "text" name = "archivo" id="archivo2" value = "PAMI" size = "10" onKeyPress="return verif_caracter(this,event)"> </td>
  </tr>
  <tr bgcolor="#DAFAFC">
    <td><div align="right">Mes a Exportar
    </div></td>
    <td><select name="mes[]" id="select4"onkeypress="return verif_caracter(this,event)">
        <option value = "1">ENE</option>
        <option value = "2">FEB</option>
        <option value = "3">MAR</option>
        <option value = "4">ABR </option>
        <option value = "5">MAY </option>
        <option value = "6">JUN </option>
        <option value = "7">JUL </option>
        <option value = "8">AGO </option>
        <option value = "9">SET</option>
        <option value = "10">OCT </option>
        <option value = "11">NOV </option>
        <option value = "12">DIC</option>
      </select></td>
  </tr>
  <tr bgcolor="#DAFAFC">
    <td><div align="right">A&ntilde;o</div></td>
    <td><span class="Estilo4">
	<?php $anio = date("y"); ?>
      <input type="text" name="anio" value= "<?php echo $anio;?>" size ="4">
    </span></td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td colspan="2"><div align="center">
      <input name="Alta" type="submit" value="EXPORTAR" id ="Alta" size = "10" onKeyPress="return verif_caracter(this,event)">
    </div></td>
  </tr>
</table>
</form>


<?php 
if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{

case "EXPORTAR":
				{

$archivo=$_REQUEST["archivo"];
$anio=$_REQUEST["anio"];

$me=$_POST["mes"];
for ($i=0;$i<count($me);$i++)    
{     
$mes= $me[$i];    
}

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


include ("archivo_cobol.php");
include ("../conexiones/config_gb.php");
$ruta="../../www/archivos/planillas/".$archivo."_".$periodo.$anio;
//$ruta="../../www/archivos/planillas/".$archivo."_".$periodo.$anio;

$sql= "SELECT * FROM para_cobol INTO OUTFILE '$ruta' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n'";
mysql_query($sql);
?>
<table width="307" border="0">
  <tr>
    <th width="291" bgcolor="#C9FADF" scope="col"><div align="center"><span class="Estilo3">ARCHIVO GRABADO CON EXITO EN</span> </div>      
    <?php  echo $ruta;?></th>
	  <th width="291" bgcolor="#C9FADF" scope="col"><div align="center"><span class="Estilo3">cantidad de registros </span> </div>      
    <?php  echo $cont;?></th>
  </tr>


</table>
<?php 
	break;
}
	}
}



?>

