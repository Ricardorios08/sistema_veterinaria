<?
global $cod_grabacion;
global$porcentaje;
$cod_merca = $_REQUEST['cod_merca'];

$B = 1;


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


 $cod_grabacion=$_REQUEST["cod_grabacion"];
 $cod_merca=$_REQUEST["cod_merca"];

include ("../../../conexiones/config_pro.php");

$sql="select * from mercaderia where cod_merca = '$cod_merca'";
$result = $db->Execute($sql);
$nombre=strtoupper($result->fields["nombre"]);
$cod_merca=strtoupper($result->fields["cod_merca"]);



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
				case "cuenta":
				document.getElementById("laboratorio").focus();
				break;
				case "laboratorio":
				document.getElementById("fecha").focus();
				break;
				case "fecha":
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


<!-- <FORM ACTION="guardar_vtas_pro.php"<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">-->
<!--  <form action="guardar_vtas_pro.php" method="post">-->

<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">
<table width="640" border="1" bordercolor="#FFFFFF">
  <!--DWLayoutTable-->
  <tr>
        <td width="669" height="401" align="left" valign="top">
          <div align="left"></div>                    <div align="center">                  </div>          <div align="left"></div>          <table width="607" border="0">
            <tr bgcolor="#006699">
              <td colspan="9" align="left"><div align="center"><font size="-3"><strong><font color="#FFFFCC">Datos de la Mercaderia </font></strong></font></div></td>
            </tr>
            <!--  trae el nombre de la mercaderia -->
            <tr bgcolor="#E0EDF3">
              <td width="91" height="26" valign="top"><font color="#000000" size="-3" face="Arial, Helvetica, sans-serif">Mercanderia </font>            
              <td width="48" valign="top"><font color="#000000" size="2"><strong><font color="#006600" size="-3">
              <input type = "text" name = "cod_merca" id="cod_merca" size = "8" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="">
              </font></strong>
              </font>                          
              <td width="96" valign="top"><strong><font color="#006600" size="-3">
              <?

$cod_merca = $_REQUEST['cod_merca'];
include ("../../../conexiones/config_pro.php");

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
              <font color="#006633"><strong><strong><font color="#006633"><strong><strong> <font color="#006633"><strong><strong><strong><?echo $nombre." (".$cod_merca.")";?></strong></strong></strong></font></strong></strong></font></strong></strong></font> </font></strong>            
              <td width="92" height="26" valign="top"><font color="#000000" size="-3"><font face="Arial, Helvetica, sans-serif">Presentacion</font></font>
              <td height="26" colspan="3" valign="top"><font color="#000000" size="-3">
              <input type = "text" name = "presentacion" id="presentacion" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
              </font>            
            <tr bgcolor="#E0EDF3">
              <td height="25" colspan="2" valign="top" bgcolor="#E0EDF3"><div align="right"></div>                                                                                                                  <div align="right"></div>                                      
                <font color="#000000" size="-3" face="Arial, Helvetica, sans-serif">Lote</font>                                                                      
<td valign="top" bgcolor="#E0EDF3"><font color="#000000" size="-3">
                              <input type = "text" name = "lote" id="lote" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
              </font>                                    
              <td valign="top" bgcolor="#E0EDF3"><font color="#000000" size="-3">Vencimiento </font>                                    
              <td width="60" valign="top" bgcolor="#E0EDF3"><font color="#000000" size="-3">
                <input type = "text" name = "vto_lote" id="vto_lote" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
              </font>                                    
              <td width="97" valign="top" bgcolor="#E0EDF3"><font color="#000000"><font size="-3" face="Arial, Helvetica, sans-serif">Precio Unitario</font></font>                                    
              <td width="93" valign="top" bgcolor="#E0EDF3"><font color="#000000" size="-3">
                <input type = "text" name = "precio_unitario" id="precio_unitario" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
<?
}

$precio = $_REQUEST['precio'];
include ("../../../conexiones/config_pro.php");

	if (is_numeric($precio))  {
$sql3="select * from grab_ventas_pro where precio = '$precio'";


$result3 = $db->Execute($sql3);

							}
	else {
$sql4 = "select * from grab_ventas_pro where precio like '$precio'";
$result4 = $db->Execute($sql4);
		}
		
		$result4 = $db->Execute($sql4);

 if (!$result4) die("fallo".$db->ErrorMsg());

$precio=ucwords($result->fields["precio"]);
echo$precio=ucwords($result->fields["precio"]);

?>
              </font>                                    
            </table>          
          <font size="-3">Ingrese cantidad del producto a vender
            <input type = "text" name = "cantidad" id="cantidad"  tabindex = "2" size = "15" >
            <input name="Alta" type="submit" value="OK" id ="Alta4" size = "10" >
          </font>
          <table width="610" height="44" border="0">
            <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
              <th width="24" height="0" scope="col"><div align="center"><font color="#FFFFFF" size="-3">N&ordm; </font></div></th>
              <th width="87" height="0" scope="col"><div align="center"><font color="#FFFFFF" size="-3">Mercaderia</font></div></th>
              <th width="97" height="0" scope="col"><font size="-3">Presentacion</font></th>
              <th width="36" height="0" scope="col"><div align="center"><font color="#FFFFFF" size="-3">Lote</font></div></th>
              <th width="57" height="0" scope="col"><font color="#FFFFFF" size="-3">vtoLote</font></th>
              <th width="75" height="0" scope="col"><font color="#FFFFFF" size="-3">Cantidad</font></th>
              <th width="106" height="0" scope="col"><font color="#FFFFFF" size="-3">Precio</font></th>
              <th width="94" height="0" scope="col"><font color="#FFFFFF" size="-3">Eliminar</font></th>
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




include ("../../../conexiones/config_pro.php");

$sql = "INSERT INTO `mercaderia` ( `cod_merca` , `descripcion` , `nombre` , `tipo` , `presentacion` , `factorconver` , `cadenafrio` , `proveedor` , `fabricante` , `alicuota` , `margendif` ) VALUES ( '$cod_merca' ,'$descripcion' , '$nombre' , '$tipo' , '$presentacion' , '$factorconver', '$cadenafrio', '$proveedor', '$fabricante', '$alicuota', '$margendif')";
mysql_query($sql);


$sql = "INSERT INTO `ventas_proveeduria` ( `cod_grabacion` ,`nro_proveedor` , `fecha` , `factura` , `porcentaje_boni` , `porcentaje_dto` ) VALUES ( '$cod_grabacion' ,'$nro_proveedor' , '$fecha' , '$factura' , '$porcentaje_boni' , '$porcentaje_dto')";
mysql_query($sql);


$sql = "INSERT INTO `grab_ventas_pro` ( `cod_grabacion` , `cod_merca` , `presentacion` , `lote` , `vto_lote` , `cantidad` , `precio` ) VALUES ( '$cod_grabacion' , '$cod_merca' , '$presentacion' , '$lote' , '$vto_lote', '$cantida' ,'$precio')";
mysql_query($sql);

$sql = "INSERT INTO `detalles_ventas` ( `cod_grabacion` ,`cuenta` , `cod_merca` , `presentacion` , `lote` , `vto_lote` , `cantidad` , `precio_unitario` )VALUES ( '$cod_grabacion' ,'$cuenta' , '$cod_merca' , '$presentacion' , '$lote' , '$vto_lote', '$cantidad' ,'$precio_unitario')";
mysql_query($sql);




$sql9="select * from detalles_ventas where cod_grabacion = '$cod_grabacion'";
$result9 = $db->Execute($sql9);

if (!$result9) die("fallo".$db->ErrorMsg());

 while (!$result9->EOF) {

$cod_merca=ucwords($result9->fields["cod_merca"]);

include ("../../../conexiones/config_pro.php");
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
              <td height="0"><div align="center"><font size="-3"><?print $cod_merca;?></font></div></td>
              <td height="0" colspan="2"><div align="center"><font size="-3"><?print $nombre;?></font></div></td>
              <td height="0" colspan="2"><div align="center"><font size="-3"><?print $lote;?></font></div></td>
              <td height="0"><font size="-3"><?print $cantidad;?></font></td>
              <td height="0"><font size="-3"><?print $precio_unitario;?></font></td>
              <td height="0"><div align="center"><font size="-3"><a href="borra.php?cod_grabacion=<?print("$cod_grabacion");?>
                   &cod_merca=<?print("$cod_merca");?>
				  
				 
">[OK]</a></font></div></td>
              <?
$neto_grabado=round($cantidad * $precio_unitario);

$importe = ($importe) + ($neto_grabado);

 echo$importe;//neto_grabado

include ("../../../conexiones/config_pro.php");
$sql11="select * from condiciones_clientes where cuenta = '$cuenta'";
$result11 = $db->Execute($sql11);
$iva =strtoupper($result11->fields["iva"]);



$porcentaje =round($importe * 21) / 100;
$total = ($importe) + ($porcentaje);


 ?>
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
                      <table width="612" height="30" border="0">
            <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
              <td width="56" height="26" bgcolor="#CCCC99"><div align="center"></div>
                  <div align="left"><font size="-3">NETO GRAVADO </font></div></td>
              <td width="63" bgcolor="#CCCC99"><div align="center"><font size="-3"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?print $importe;?> </strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></div></td>
              <td width="85" bgcolor="#CCCC99"><font size="-3">IVA</font></td>
              <td width="78" bgcolor="#CCCC99"><font size="-3"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo$porcentaje;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></td>
              <td width="91" bgcolor="#CCCC99"><font size="-3">PERCEPCION</font></td>
              <td width="105" bgcolor="#CCCC99"><font size="-3"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $percepcion;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></td>
              <td width="106" bgcolor="#CCCC99"><font size="-3">TOTAL</font></td>
              <td width="213" bgcolor="#CCCC99"><font size="-3"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $total;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></td>
            </tr>
                  </table>          <p align="right">
                    <input name="Alta2" type="submit" value="FACTURAR" id ="Alta22" size = "10" ></td><td width="0" valign="top">
      
	  
	  
	  <div align="center"></div>
      <div align="center"></div>
    <div align="center">    </div></td>
  </tr>
</table>
<div align="center"></div>
<table width="538" height="432" border="0" bordercolor="#FFFFFF">
  <a href="imprimir.php?fecha=<?print("$fecha");?>  && nro_laboratorio=<?print("$nro_laboratorio");?> && operario=<?print("$operario");?>&& observaciones=<?print("$observaciones");?> && nro_recibo=<?print("$nro_recibo");?>">IMPRIMIR</a><tr bordercolor="#333333" bgcolor="#993300">