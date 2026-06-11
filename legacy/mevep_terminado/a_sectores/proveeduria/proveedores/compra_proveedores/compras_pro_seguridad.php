<?
global $importe;
global $iva;
global $total;

$nro_os = $_REQUEST['nro_os'];

$B = 1;

$importe= 0;
$iva= 0;
$total= 0;


	
$me=$_POST["mes"];
for ($i=0;$i<count($me);$i++)    
{     
$mes1= $me[$i];    
}

$mes= $mes1;



switch ($mes)
	{
		case "1":{$periodo= "ENERO";}break;
		case "2":{$periodo= "FEBRERO";}break;
		case "3":{$periodo= "MARZO";}break;
		case "4":{$periodo= "ABRIL";}break;
		case "5":{$periodo= "MAYO";}break;
		case "6":{$periodo= "JUNIO";}break;
		case "7":{$periodo= "JULIO";}break;
		case "8":{$periodo= "AGOSTO";}break;
		case "9":{$periodo= "SETIEMBRE";}break;
		case "10":{$periodo= "OCTUBRE";}break;
		case "11":{$periodo= "NOVIEMBRE";}break;
		case "12":{$periodo= "DICIEMBRE";}break;
				}


$cod_merca=$_REQUEST["cod_merca"];

		  include ("../../../../conexiones/config.inc.php");

$sql1="select * from proveedores where cuenta = '$cuenta'";
$result1 = $db->Execute($sql1);
$denominacion=strtoupper($result1->fields["denominacion"]);

$sql="select * from mercaderia where cod_merca = '$cod_merca'";
$result = $db->Execute($sql);
$cod_merca=strtoupper($result->fields["cod_merca"]);
$nombre=strtoupper($result->fields["nombre"]);




//include ("../../../../conexiones/config_pro.php");

//$sql="select * from datos_os where nro_os = '$nro_os'";
//$result = $db->Execute($sql);
//$sigla=strtoupper($result->fields["sigla"]);

?>
<script>
function on_load()
{
document.getElementById("cod_merca").focus();
}


function verif_caracter(obj,evt)

{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	
	{
		switch(obj.id)
		{
				case "nro_proveedor":
				document.getElementById("fecha").focus();
				break;
				case "fecha":
				document.getElementById("factura").focus();
				break;
				case "factura":
				document.getElementById("porcentaje_boni").focus();
				break;
				case "porcentaje_boni":
				document.getElementById("porcentaje_dto").focus();
				break;
				case "porcentaje_dto":
				document.getElementById("cod_merca").focus();
				break;
				case "cod_merca":
				document.getElementById("presentacion").focus();
				break;
				case "presentacion":
				document.getElementById("lote").focus();
				break;
				case "lote":
				document.getElementById("vto_lote").focus();
				break;
				case "vto_lote":
				document.getElementById("precio_unitario").focus();
				break;
				case "precio_unitario":
				document.getElementById("cantidad").focus();
				break;
				
				
				
		}
		return false;
	}
	return true;
}


</script>


<html>
<BODY onload = "on_load ()">
<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">
<table width="615" border="1" bordercolor="#FFFFFF">
  <!--DWLayoutTable-->
  <tr bordercolor="#333333" bgcolor="#006699">
    <td height="44" colspan="2" align="left" valign="top"><div align="center"><font color="#FFFFCC" size="6"><strong>Compras Proveeduria</strong></font></div></td>
  </tr>
  <tr>
    <td width="290" height="401" align="left" valign="top"><div align="center">
        <table width="278" border="0">
          <tr bgcolor="#006699">
            <td height="23" colspan="2"><div align="center"><strong><font color="#FFFFCC">Ingreso de Datos</font></strong> </div></td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Proveedor</font></div></td>
            <td width="84" bgcolor="#FFFFCC">
              <div align="left">
                <input type = "text" name = "nro_proveedor" id="nro_proveedor" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['nro_proveedor']))   echo $_REQUEST['nro_proveedor'];?>">
                <font color="#FF0000" size="3"><strong>
                <?
	  echo $bioquimico;
	  ?>
            </strong></font></div></td>
          </tr>

          <tr bgcolor="#FFFFCC">
            <td width="184" height="25" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font></div></td>
            <td><font color="#000000" size="2">
              <input type = "text" name = "fecha" id="fecha" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['fecha']))   echo $_REQUEST['fecha'];?>">
            </font></td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td height="25" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Factura</font></div></td>
            <td><input type = "text" name = "factura" id="factura" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['factura']))   echo $_REQUEST['factura'];?>"></td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Porcentaje de bonificacion </font></div></td>
            <td bgcolor="#FFFFCC"><input type = "text" name = "porcentaje_boni" id="porcentaje_boni" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['porcentaje_boni']))   echo $_REQUEST['porcentaje_boni'];?>"></td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td height="25" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Porcentaje de Descuento</font></div></td>
            <td><input type = "text" name = "porcentaje_dto" id="porcentaje_dto" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['porcentaje_dto']))   echo $_REQUEST['porcentaje_dto'];?>"></td>
          </tr>
        </table>
        <div align="center"><br>
        </div>
        <div align="left"></div>
        <table width="290" border="0">
          <tr bgcolor="#006699">
            <td colspan="4" align="left"><div align="center"><strong></strong></div></td>
          </tr>
          <tr bgcolor="#E0EDF3">
            <td width="162" height="25" align="left" bgcolor="#E0EDF3"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Codigo de Mercanderia </font></div></td>
            <td width="118" colspan="2" bgcolor="#E0EDF3">
              <div align="left"> <strong><font color="#006600">
                <input type = "text" name = "cod_merca" id="cod_merca" size = "4" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="">
        


<?




$cod_merca = $_REQUEST['cod_merca'];
include ("../../../../conexiones/config_pro.php");

	if (is_numeric($cod_merca))  {
$sql1="select * from mercaderia where cod_merca = '$cod_merca%'";
$result1 = $db->Execute($sql1);

								}
	else {
$sql2 = "select * from mercaderia where nombre = '$nombre%'";
$result2 = $db->Execute($sql2);
	

		}
		
		$result = $db->Execute($sql);

 if (!$result) die("fallo".$db->ErrorMsg());





$nombre=ucwords($result->fields["nombre"]);
$cod_merca=ucwords($result->fields["cod_merca"]);



if ($cod_merca == ""){
	?>
                <font color="#FF0000"><?echo "No existe esa mercaderia ".$cod_merca." ";?></font>
                <?
}

else{
?>
                <font color="#006633"><strong><strong><font color="#006633"><strong><strong> <font color="#006633"><strong><strong><strong><?echo $nombre." (".$cod_merca.")";?></strong></strong></strong></font></strong></strong></font></strong></strong></font> </font></strong></div></td>
</tr>
<!--  trae el nombre de la mercaderia -->
<tr bgcolor="#E0EDF3">
<td height="26" valign="top"><div align="right"><font color="#000000"><font size="2" face="Arial, Helvetica, sans-serif">Presentacion </font></font> </div>
<td height="26" valign="top"><font color="#000000" size="2">
<input type = "text" name = "presentacion" id="presentacion" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
</font>
<tr bgcolor="#E0EDF3">
<td height="26" valign="top"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Lote </font><font color="#000000"></font> </div>
<td height="26" valign="top"><font color="#000000" size="2">
<input type = "text" name = "lote" id="lote" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
</font>
<tr bgcolor="#E0EDF3">
<td height="26" valign="top" bgcolor="#E0EDF3"><div align="right"><font color="#000000">Vencimiento del lote</font> </div>
<td height="26" valign="top"><font color="#000000" size="2">
<input type = "text" name = "vto_lote" id="vto_lote" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
</font>
<tr bgcolor="#E0EDF3">
<td height="26" valign="top" bgcolor="#E0EDF3"><div align="right"><font color="#000000"><font size="2" face="Arial, Helvetica, sans-serif">Precio Unitario</font></font> </div>
<td height="26" valign="top"><font color="#000000" size="2">
<input type = "text" name = "precio_unitario" id="precio_unitario" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
</font>
<?
}

$precio = $_REQUEST['precio'];
include ("../../../../conexiones/config_pro.php");

	if (is_numeric($precio))  {
$sql3="select * from grab_compras_pro where precio = '$precio'";
$result3 = $db->Execute($sql3);

							}
	else {
$sql4 = "select * from grab_compras_pro where precio like '$precio'";
$result4 = $db->Execute($sql4);
		}
		
		$result4 = $db->Execute($sql4);

 if (!$result4) die("fallo".$db->ErrorMsg());

$precio=ucwords($result->fields["precio"]);
echo$precio=ucwords($result->fields["precio"]);

?>
</table>
        <div align="center"><br>
          Ingrese cantidad del producto 
            <input type = "text" name = "cantidad" id="cantidad"  tabindex = "2" size = "15" >
            <input name="Alta" type="submit" value="OK" id ="OK" size = "10" >

<br>
            <br>
        </div>
    </div></td>
    <td width="309" valign="top">
      
	  
	  
	 <table width="302" height="52" border="0">
        <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
          <th width="22" scope="col"><div align="center"><font color="#FFFFFF">N&ordm; </font></div></th>
          <th width="68" scope="col"><div align="center"><font color="#FFFFFF">Practica</font></div></th>
          <th width="67" scope="col"><font color="#FFFFFF">Cantidad</font></th>
          <th width="55" scope="col"><font color="#FFFFFF">Precio</font></th>
          <th width="68" scope="col"><div align="center"><font color="#FFFFFF">Eliminar</font></div></th>
        </tr>

	    <?

		if(isset($_REQUEST['Alta'])) {

	switch ($_REQUEST['Alta'])
					{
			case "OK":
						{

 $nro_proveedor=$_REQUEST["nro_proveedor"];
 $fecha=$_REQUEST["fecha"];
 $factura=$_REQUEST["factura"];
 $porcentaje_boni=$_REQUEST["porcentaje_boni"];
 $porcentaje_dto=$_REQUEST["porcentaje_dto"];


 //$cod_grabacion=$_REQUEST["cod_grabacion"];
 $cod_merca=$_REQUEST["cod_merca"];
 $presentacion=$_REQUEST["presentacion"];
 $lote=$_REQUEST["lote"];
 $vto_lote=$_REQUEST["vto_lote"];
 $cantidad=$_REQUEST["cantidad"];
 $precio_unitario=$_REQUEST["precio_unitario"];


//$cod_grabacion=$factura;
$cod_grabacion=$factura.$fecha.$factura;
$cod_grabacion1=$factura.$fecha.$factura.$cod_merca;




include ("../../../../conexiones/config_pro.php");

$sql = "INSERT INTO `mercaderia` ( `cod_merca` , `descripcion` , `nombre` , `tipo` , `presentacion` , `factorconver` , `cadenafrio` , `proveedor` , `fabricante` , `alicuota` , `margendif` ) VALUES ( '$cod_merca' ,'$descripcion' , '$nombre' , '$tipo' , '$presentacion' , '$factorconver', '$cadenafrio', '$proveedor', '$fabricante', '$alicuota', '$margendif')";
mysql_query($sql);


$sql = "INSERT INTO `compras_proveeduria` ( `cod_grabacion` ,`nro_proveedor` , `fecha` , `factura` , `porcentaje_boni` , `porcentaje_dto` ) VALUES ( '$cod_grabacion' ,'$nro_proveedor' , '$fecha' , '$factura' , '$porcentaje_boni' , '$porcentaje_dto')";
mysql_query($sql);


$sql = "INSERT INTO `grab_compras_pro` ( `cod_grabacion` , `cod_merca` , `presentacion` , `lote` , `vto_lote` , `cantidad` , `precio` ) VALUES ( '$cod_grabacion' , '$cod_merca' , '$presentacion' , '$lote' , '$vto_lote', '$cantida' ,'$precio')";
mysql_query($sql);

$sql = "INSERT INTO `detalles_compras` ( `cod_grabacion` , `cod_merca` , `presentacion` , `lote` , `vto_lote` , `cantidad` , `precio_unitario` )VALUES ( '$cod_grabacion' , '$cod_merca' , '$presentacion' , '$lote' , '$vto_lote', '$cantidad' ,'$precio_unitario')";
mysql_query($sql);




$sql9="select * from detalles_compras where cod_grabacion = '$cod_grabacion'";
$result9 = $db->Execute($sql9);

if (!$result9) die("fallo".$db->ErrorMsg());

 while (!$result9->EOF) {

$cod_merca=ucwords($result9->fields["cod_merca"]);

include ("../../../../conexiones/config_pro.php");
$sql0="select * from mercaderia where cod_merca = '$cod_merca'";
$result0 = $db->Execute($sql0);

$nombre=strtoupper($result0->fields["nombre"]);
$cantidad=strtoupper($result9->fields["cantidad"]);
$precio_unitario=strtoupper($result9->fields["precio_unitario"]);

$nombre = substr($nombre,0,8);


if ($B==0) {

?>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <?

$B=1;
				}
	ELSE	{

	$B=0;
?>
  <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
   
	
	<?
					
			}


?>

<td height="21"><div align="center"><?print $cod_merca;?></div></td>
<td height="21"><div align="center"><?print $nombre;?></div></td>
<td height="21"><div align="center"><?print $cantidad;?></div></td>
<td height="21"><div align="center"><?print $precio_unitario;?></div></td>
 <?
$neto_grabado=round($cantidad * $precio_unitario);

$importe = ($importe) + ($neto_grabado);

 echo$importe;//neto_grabado

include ("../../../../conexiones/config_pro.php");
$sql11="select * from proveedores where cuenta = '$cuenta'";
$result11 = $db->Execute($sql11);
$tipo_iva=strtoupper($result11->fields["tipo_iva"]);



$tipo_iva=round($importe * 21) / 100;
$total = ($importe) + ($tipo_iva);


 ?>

<td bgcolor="#B5D0EE"><div align="center"><a href="borra.php?cod_grabacion=<?print("$cod_grabacion");?>
                   &cod_merca=<?print("$cod_merca");?>
				  
				 
">[OK]</a></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
        
		 
		 <?
		$result9->MoveNext();
		

		}
		break;

		}
		

		}
		 		
		
}



?>
      </table> 
		  
		  <table width="297" height="94" border="0">
        <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
		  <td height="21" colspan="2" bgcolor="#CCCC99"><div align="center"></div>
              <div align="left">NETO GRABADO </div></td>
          <td width="106" bgcolor="#CCCC99"><div align="center"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?print $importe;?>

 </strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td height="21" colspan="2" bgcolor="#CCCC99">IVA</td>
          <td bgcolor="#CCCC99"><div align="center"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo$tipo_iva;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td height="21" colspan="2" bgcolor="#CCCC99">PERCEPCION</td>
          <td bgcolor="#CCCC99"><div align="center"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $percepcion;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td height="21" colspan="2" bgcolor="#CCCC99">TOTAL</td>
          <td bgcolor="#CCCC99"><div align="center"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $total;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></div></td>
        </tr>
</table> 



      <div align="center"></div>
      <div align="center"></div>
    <div align="center"></div></td>
  </tr>
</table>
<div align="center"></div>
<table width="538" height="432" border="0" bordercolor="#FFFFFF">
  <a href="imprimir.php?fecha=<?print("$fecha");?>  && nro_laboratorio=<?print("$nro_laboratorio");?> && operario=<?print("$operario");?>&& observaciones=<?print("$observaciones");?> && nro_recibo=<?print("$nro_recibo");?>">IMPRIMIR</a><tr bordercolor="#333333" bgcolor="#993300">
    <td height="36" colspan="3" align="left"><div align="center"></div></td>
</tr><tr><td colspan="3" valign="top"><div align="center"></div>	  <div align="center"></div>	  <div align="center">
        <div align="right"></div>
      </div>	</tr>
        <div align="center"></div>
        <div align="center"></div>
        <div align="center"></div>
      
<div align="right"></div>
<div align="center"></div>