<script language="javascript">
function on_load()

{
document.getElementById("nro_factura").focus();
}



</script>

<style type="text/css">
<!--
.Estilo3 {font-family: Arial, Helvetica, sans-serif}
.Estilo4 {font-size: 10px}
.Estilo35 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; font-weight: bold; }
-->
</style>

<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

<?
include ("../../../conexiones/config_grabacion.php");

$hoy = date("d-m-Y");
$anio_actual = $_REQUEST['anio_actual'];
$anio_actual = date ("y");
$dia = date("d");
$mes=date("m");   
	

 $nueva_tabla = "existencias_".$dia.$mes.$anio_actual;
$nueva_tabla2 = "stock_".$dia.$mes.$anio_actual;

$sql1 = "DROP TABLE $nueva_tabla";
$result1 = $db_pro->Execute($sql1);

$sql2 = "DROP TABLE $nueva_tabla2";
$result2 = $db_pro->Execute($sql2);

$sql1 = "CREATE TABLE $nueva_tabla SELECT * FROM existencias";
$result1 = $db_pro->Execute($sql1);

$sql2 = "CREATE TABLE $nueva_tabla2 SELECT * FROM stock";
$result2 = $db_pro->Execute($sql2);

?>


<BODY onload = "on_load ()" >




  <div align="left"></div>
  <table width="103%" border="0">
    <tr bgcolor="#FF0000">
      <td height="29" colspan="2"><div align="center"><span class="Estilo35 Estilo1"> BACKUP DE EXISTENCIA Y FICHA DE STOCK </span><br>
      </div></td>
    </tr>
    <tr bgcolor="#DAFAFC" >
      <td height="65" colspan="2" bgcolor="#FFBC79" class="Estilo3"><div align="center">EL BACKUP SE REALIZO CON EXITO </div></td>
    </tr>
		    <tr bgcolor="#DAFAFC">
              <!-- <td bgcolor="#FFBC79"><div align="right" class="Estilo10">Rengl&oacute;n 4</span></div></td>
              <td bgcolor="#F2FACB"><span class="Estilo4"><span class="Estilo3">
                <input name="renglon4" type="text" id= "renglon4" size ="40" maxlength="40"> -->
              
              <td width="276"></span></span></td>
    </tr>
  </table>





<?

include ("../../../conexiones/config_grabacion.php");

?>
<table width="790" border="0">
  <tr>
    <td width="371"><div align="left"><strong>TABLAS EXISTENCIAS</strong></div></td>
    <td width="409"><div align="left"><strong>TABLAS DE FICHAS DE STOCK </strong></div></td>
  </tr>
  <tr>
    <td valign="top"><em><?$sql = "SHOW TABLES like 'exist%'";
$result1 = $db_pro->Execute($sql);

if (!$result1) die("fallo".$db_pro->ErrorMsg());
while (!$result1->EOF) {
$tabla=strtoupper($result1->fields["Tables_in_proveeduria (exist%)"]);

echo $tabla;
if (strtoupper($nueva_tabla) == $tabla){
?> <input name="checkbox2" type="checkbox" value="checkbox" checked><?
}

ECHO "<br>";
$result1->MoveNext();
	}?></em></td>
    <td valign="top"><em><?$sql3 = "SHOW TABLES like 'sto%'";
$result3 = $db_pro->Execute($sql3);

if (!$result3) die("fallo".$db_pro->ErrorMsg());
while (!$result3->EOF) {
$tabla1=strtoupper($result3->fields["Tables_in_proveeduria (sto%)"]);
echo $tabla1;
if (strtoupper($nueva_tabla2) == $tabla1){
?> <input name="checkbox2" type="checkbox" value="checkbox" checked><?
}
ECHO "<br>";
$result3->MoveNext();
	}?></em></td>
  </tr>
</table>
