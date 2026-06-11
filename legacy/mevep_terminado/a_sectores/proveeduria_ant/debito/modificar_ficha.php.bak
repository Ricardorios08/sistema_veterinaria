<?php
global $nro_os;
global $matricula;
global $mesano;
global $cantidad;
global $total;
global $bandera;

$nro_os=0;
$matricula=1;
$mesano=0;
$cantidad=0;
$total=0;
$band = 0;




$nro_recibo= $_REQUEST['id'];

include ("../../conexiones/config_or.php");
$sql7="select * from recibos where nro_recibo = '$nro_recibo'";
$result7 = $db->Execute($sql7);

 $operario=ucwords($result7->fields["operador"]);
$nro_laboratorio=ucwords($result7->fields["nro_laboratorio"]);
$observaciones=ucwords($result7->fields["observaciones"]);
$nro_os=ucwords($result7->fields["nro_os"]);


include ("../../conexiones/config.inc.php");
$sql= "select * from usuarios where id = '$operario'" ;
$result = $db->Execute($sql);

$nombre_operario=strtoupper($result->fields["usuario"]);



?>



<script language="javascript">
function on_load()
{
document.getElementById("nro_os").focus();
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "nro_os":
				document.getElementById("cantidad").focus();
				break;
			
				
		}
		return false;
	}
	return true;
}

</script>


<BODY onload = "on_load ()">


<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "GET">
<table width="638" border="0">
  <!--DWLayoutTable-->
  <tr bgcolor="#0066FF">
    <td height="33"><div align="center"><font color="#FFFFCC" size="6"><strong>
        <?php



// Obtenemos y traducimos el nombre del d&iacute;a
$dia=date("l");
if ($dia=="Monday") $dia="Lunes";
if ($dia=="Tuesday") $dia="Martes";
if ($dia=="Wednesday") $dia="Mi&eacute;rcoles";
if ($dia=="Thursday") $dia="Jueves";
if ($dia=="Friday") $dia="Viernes";
if ($dia=="Saturday") $dia="Sabado";
if ($dia=="Sunday") $dia="Domingo";

// Obtenemos el n&uacute;mero del d&iacute;a
$dia2=date("d");

// Obtenemos y traducimos el nombre del mes
$mes=date("F");
if ($mes=="January") $mes="Ene";
if ($mes=="February") $mes="Feb";
if ($mes=="March") $mes="Mar";
if ($mes=="April") $mes="Abr";
if ($mes=="May") $mes="May";
if ($mes=="June") $mes="Jun";
if ($mes=="July") $mes="Jul";
if ($mes=="August") $mes="Agosto";
if ($mes=="September") $mes="Set";
if ($mes=="October") $mes="Oct";
if ($mes=="November") $mes="Nov";
if ($mes=="December") $mes="Dic";

// Obtenemos el a&ntilde;o
$ano=date("Y");

// Imprimimos la fecha completa

include ("../../conexiones/config.inc.php");

$sql1="select * from datos_personales ORDER BY apellido";
$result1 = $db->Execute($sql1);

$a = 0;



?>
        <font size="4">RECEPCION DE ORDENES</font></strong></font></div></td>
    <td width="333" height="33"><div align="center"><font color="#FFFFFF"><strong><font size="2">
        <input name="Alta" type="submit" value="1" id ="Alta" size = "10" >
      </font><font color="#FFFFFF"><font size="2">SIGUIENTE </font>
      <input name="Alta" type="submit" value="2" id ="Alta" size = "10" >
      </font><font color="#FFFFFF"><font size="2">REFRESCAR </font>
  </font></div></td>
  </tr>
  <tr bgcolor="#FFFFCC">
    <td width="295" height="24" bgcolor="#C4D7E6"><div align="right"><font color="#000000">Obra Social:</font></div></td>
    <td bgcolor="#C4D7E6"><strong><font color="#006600">
      <input type = "text" name = "nro_os"  id="nro_os" size = "10"  onKeyPress="return verif_caracter(this,event)">
    </font></strong></td>
    </tr>
  <tr bgcolor="#FFFFCC">
    <td height="24" bgcolor="#C4D7E6"><div align="right"><font color="#000000">Cantidad:</font></div></td>
    <td bgcolor="#C4D7E6"><strong><font color="#006600">
    <input type ="text" name = "cantidad" size = "10"  id="cantidad">
</font></strong></td>
    </tr>
  <tr bgcolor="#FFFFCC">
    <td height="26" colspan="2" valign="top" bgcolor="#E0EDF3"><font color="#000000">
      <?
       echo $fecha ="$dia2 de $mes de $ano";
	   ?>
    <?echo "  -  ";?> Planilla de Recepci&oacute;n N&ordm;</font>: <font color ="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#000000"><strong>
<input type = "hidden" name = "nro_recibo" id="nro_recibo"size = "15" value="<?echo $nro_recibo;?>" onKeyPress="return verif_caracter(this,event)">
<?echo " (".$nro_recibo.") ";?></strong></font></strong></strong></font></strong></strong></font><font color="#000000">&nbsp; Operador:
        <input type = "hidden" name = "operario" id="operario"size = "15" value="<?php if (isset($_REQUEST['operario'])) echo $_REQUEST['operario'];?>" onKeyPress="return verif_caracter(this,event)">
</font> <?echo "(".$nombre_operario.")";?> <font color="#000000">&nbsp;    </font></td>
  </tr>


  <input type = "hidden" name = "operario" id="operario" size = "15" value="<?echo $operario;?>" onKeyPress="return verif_caracter(this,event)">
<?echo "(".$operario.") ";?><?echo $nombre_operario;?>


  <tr bgcolor="#FFFFCC">
    <td height="26" colspan="2" valign="top" bgcolor="#E0EDF3">    <div align="left"><font color="#FFFFFF"><font color="#000000">Lab. / Bioq.:</font><strong> 
            <input type = "hidden" name = "nro_laboratorio" id="nro_laboratorio" size = "6" maxlength="4" value="<?echo $nro_laboratorio;?>" onKeyPress="return verif_caracter(this,event)">
            <?


//$nro_laboratorio = $_REQUEST['nro_laboratorio'];

include ("../../conexiones/config.inc.php");

$sql1="select * from datos_laboratorio where nro_laboratorio = '$nro_laboratorio'";
$result = $db->Execute($sql1);
 if (!$result) die("fallo".$db->ErrorMsg());


$nro_laboratorio=ucwords($result->fields["nro_laboratorio"]);
$nombre_laboratorio=ucwords($result->fields["nombre_laboratorio"]);



?>
            <font color="#006633"><strong><strong><font color="#006633"><strong><strong> <font color="#006633"><strong><strong><strong><?echo $nombre_laboratorio." (".$nro_laboratorio.")";?></strong></strong></strong></font></strong></strong></font></strong></strong></font> </strong></font><font color="#000000">Observaciones:</font>
            <input type = "hidden" id="observaciones12" name = "observaciones" size = "30" value="<?php if (isset($_REQUEST['observaciones'])) echo $_REQUEST['observaciones'];?>" onKeyPress="return verif_caracter(this,event)">
            <?echo "(".$observaciones.")";?> <font color="#FFFFFF"><strong><font size="2">
            </font></strong></font></div></td>
  </tr>
    <a href="imprimir.php?fecha=<?print("$fecha");?>  && nro_laboratorio=<?print("$nro_laboratorio");?> && observaciones=<?print("$observaciones");?> && nro_recibo=<?print("$nro_recibo");?>">IMPRIMIR</a>
</table>
<table width="637" border="0">
  <tr bgcolor="#993300">
    <th width="243" bgcolor="#0066FF" scope="col"><font color="#FFFFCC">Obra Social</font></th>
    <th width="192" bgcolor="#0066FF" scope="col"><font color="#FFFFCC">Cantidad</font></th>
    <th width="188" bgcolor="#0066FF" scope="col"><font color="#FFFFCC">Eliminar</font></th>
  </tr>

  
  
  <?

	include ("../../conexiones/config_or.php");
		
			include ("../../conexiones/config_os.php");


$nro_os=$_REQUEST["nro_os"];
//$nro_laboratorio=$_REQUEST["nro_laboratorio"];
//$nro_recibo=$mesano;
$cantidad=$_REQUEST["cantidad"];
$e=$_REQUEST["nro_recibo"];


if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{
		case "1":
				{

			if ($nro_os !="" ) {
			if ($cantidad !="" ) {

include ("../../conexiones/config_os.php");

 $sql8="select * from datos_os where nro_os = '$nro_os'";
$result8 = $db->Execute($sql8);

$os=ucwords($result8->fields["sigla"]);
if ($os == "") {
	echo "No existe esa Obra Social (".$nro_os.")";

include ("../../conexiones/config_or.php");
$sql7="select * from detalle where nro_recibo = '$nro_recibo'";
$result7 = $db->Execute($sql7);

if (!$result7) die("fallo".$db->ErrorMsg());

 while (!$result7->EOF) {
 $nro_os1=ucwords($result7->fields["nro_os"]);
$cantidad=ucwords($result7->fields["cantidad"]);

if ($nro_os1 == 0){
	if ($cantidad == 0){
			$result7->MoveNext();
	}}
else
	 {

include ("../../conexiones/config_os.php");

 $sql8="select * from datos_os where nro_os = '$nro_os1'";
$result8 = $db->Execute($sql8);
$os=ucwords($result8->fields["sigla"]);

	

?>
  <tr align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td><div align="center"><?print $os." (".$nro_os1.")";?></div></td>
    <td><div align="center"><?print $cantidad;?></div></td>
<td><a href="borra.php?id=<?print("$nro_os1");?> && id1=<?print("$cantidad");?> && nro_laboratorio=<?print("$nro_laboratorio");?> && bandera_mod=<?print("$bandera_mod");?> && observaciones=<?print("$observaciones");?> && nro_recibo=<?print("$nro_recibo");?>">[Eliminar]</a></td>
  
  </tr>

<?
	$total=$total + $cantidad;

$result7->MoveNext();

	}} 
}
else
				{

$mes = date('m');
$hoy = date("d/m/y");
include ("../../conexiones/config_or.php");

$sql = "INSERT INTO detalle ( `mes` , `nro_recibo` , `nro_os` , `cantidad` ) VALUES ('$mes' , '$nro_recibo' , '$nro_os' , '$cantidad')";
mysql_query($sql);

$sql = "INSERT INTO detalle_historial ( `mes` , `nro_recibo` , `nro_os` , `cantidad` ) VALUES ('$mes' , '$nro_recibo' , '$nro_os' , '$cantidad')";
mysql_query($sql);



$observaciones=$_REQUEST["observaciones"];


$sql = "INSERT INTO recibos (`nro_recibo` , `operario` , `nro_laboratorio` , `observaciones` , `fecha` , `operador`) VALUES ('$nro_recibo' , '$nombre_operario' , '$nro_laboratorio', '$observaciones' , '$hoy' , '$operario' )";
 mysql_query($sql);

 $sql = "INSERT INTO recibos_historial (`nro_recibo` , `operario` , `nro_laboratorio` , `observaciones` , `fecha` , `operador`) VALUES ('$nro_recibo' , '$nombre_operario' , '$nro_laboratorio', '$observaciones' , '$hoy' , '$operario' )";
 mysql_query($sql);

$bandera=2;
include ("../../conexiones/config_or.php");
$sql7="select * from detalle where nro_recibo = '$nro_recibo'";
$result7 = $db->Execute($sql7);

if (!$result7) die("fallo".$db->ErrorMsg());

 while (!$result7->EOF) {
 $nro_os1=ucwords($result7->fields["nro_os"]);
$cantidad=ucwords($result7->fields["cantidad"]);

if ($nro_os1 == 0){
	if ($cantidad == 0){
			$result7->MoveNext();
	}}
else
	 {

include ("../../conexiones/config_os.php");

 $sql8="select * from datos_os where nro_os = '$nro_os1'";
$result8 = $db->Execute($sql8);
$os=ucwords($result8->fields["sigla"]);

?>
  <tr align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td><div align="center"><?print $os." (".$nro_os1.")";?></div></td>
    <td><div align="center"><?print $cantidad;?></div></td>
<td><a href="borra.php?id=<?print("$nro_os1");?> && id1=<?print("$cantidad");?> && nro_laboratorio=<?print("$nro_laboratorio");?> && observaciones=<?print("$observaciones");?> && nro_recibo=<?print("$nro_recibo");?>">[Eliminar]</a></td>
  
  </tr>
  <?

$total=$total + $cantidad;

$result7->MoveNext();

	}}


?>

 <font color="#990000" size="4"><strong>TOTAL DE ORDENES:</strong></font><strong><font color="#006699" size="5">(<?ECho $total;?>) </font></strong> 
</table>
  <?



					}}}
					break;}
					
					case "2":
				{
						 ?><input type = "hidden" name = "bandera_mod" id="bandera_mod" size = "15" value="2";? onKeyPress="return verif_caracter(this,event)"><?


ECHO $bandera_mod = 2;
	    include ("../../conexiones/config_or.php");
 $sql7="select * from detalle where nro_recibo = '$nro_recibo'";
$result7 = $db->Execute($sql7);

if (!$result7) die("fallo".$db->ErrorMsg());

 while (!$result7->EOF) {
 

 $nro_os1=ucwords($result7->fields["nro_os"]);
 $cantidad=ucwords($result7->fields["cantidad"]);

include ("../../conexiones/config_os.php");

 $sql8="select * from datos_os where nro_os = '$nro_os1'";
$result8 = $db->Execute($sql8);
$os=ucwords($result8->fields["sigla"]);

?>
  <tr align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td><div align="center"><?print $os." (".$nro_os1.")";?></div></td>
    <td><div align="center"><?print $cantidad;?></div></td>
    <td><a href="borra.php?id=<?print("$nro_os1");?> && id1=<?print("$cantidad");?> && nro_laboratorio=<?print("$nro_laboratorio");?> && observaciones=<?print("$observaciones");?> && nro_recibo=<?print("$nro_recibo");?>">[Eliminar]</a></td>
  </tr>
  <?

$total=$total + $cantidad;

$result7->MoveNext();

	}}
	

	?>

 <font color="#990000" size="4"><strong>TOTAL DE ORDENES:</strong></font><strong><font color="#006699" size="5">(<?ECho $total;?>) </font></strong> 
</table>
  <?
	BREAK;

					
					case "3":
				{
					
					
									}
					BREAK;
					
					case "OK":
				{
					

									}
					BREAK;
					
					
					
					
					}}



?>
</table>

