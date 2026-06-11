	 <table width="418" height="52" border="0">
       <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
         <th width="27" scope="col"><div align="left"><font color="#FFFFFF">N&ordm;</font> <font color="#FFFFFF"> </font></div></th>
         <th width="107" scope="col"><div align="left"><font color="#FFFFFF">Mercaderia</font></div></th>
         <th width="82" scope="col"><div align="left"><font color="#FFFFFF">Cantidad</font></div></th>
         <th width="61" scope="col"><div align="left"><font color="#FFFFFF">Precio</font></div></th>
         <th width="42" scope="col"><div align="left"><font color="#FFFFFF">Lote</font></div></th>
         <th colspan="2" scope="col"><div align="left"><font color="#FFFFFF">VtoLote</font></div>           </th>
       </tr>
       <?

global $cod_merca2;
global $precio_unitario2;
global $cantidad2;
global $fecha2;
global $factura2;
global $tipo_mov2;
global $condicion2;
global $nro_proveedor2;
global $lote2;
global $vto_lote2;


global $cod_merca3;
global $precio_unitario3;
global $cantidad3;
global $fecha3;
global $factura3;
global $tipo_mov3;
global $condicion3;
global $nro_proveedor3;
global $lote3;
global $vto_lote3;	


global $cantidad4;	



include ("../../../../conexiones/config_pro.php");


$sql9="select * from stockpro";

$result9 = $db->Execute($sql9);

//if (!$result9) die("fallo".$db->ErrorMsg());

 while (!$result9->EOF) {


$cod_merca1=strtoupper($result9->fields["cod_merca1"]);



$precio_unitario1=strtoupper($result9->fields["precio_unitario1"]);
$cantidad1=strtoupper($result9->fields["cantidad1"]);
$fecha1=strtoupper($result9->fields["fecha1"]);
$factura1=strtoupper($result9->fields["factura1"]);
$tipo_mov1=strtoupper($result9->fields["tipo_mov1"]);
$condicion1=strtoupper($result9->fields["condicion1"]);
$nro_proveedor1=strtoupper($result9->fields["nro_proveedor1"]);
$lote1=strtoupper($result9->fields["lote1"]);
$vto_lote1=strtoupper($result9->fields["vto_lote1"]);


$cod_merca2=$_REQUEST["cod_merca1"];
$precio_unitario2=$_REQUEST["precio_unitario1"];
$cantidad2=$_REQUEST["cantidad1"];
$fecha2=$_REQUEST["fecha1"];
$factura2=$_REQUEST["factura1"];
$tipo_mov2=$_REQUEST["tipo_mov1"];
$condicion2=$_REQUEST["condicion1"];
$nro_proveedor2=$_REQUEST["nro_proveedor1"];
$lote2=$_REQUEST["lote1"];
$vto_lote2=$_REQUEST["vto_lote1"];


include ("../../../../conexiones/config_pro.php");

$sql3="select * from detalles_compras ORDER BY cod_grabacion";
//$sql3="select * from detalles_compras";

$result3 = $db->Execute($sql3);

$cod_merca=strtoupper($result3->fields["cod_merca"]);
$precio_unitario=strtoupper($result3->fields["precio_unitario"]);
$cantidad=strtoupper($result3->fields["cantidad"]);
$lote=strtoupper($result3->fields["lote"]);
$vto_lote=strtoupper($result3->fields["vto_lote"]);



include ("../../../../conexiones/config_pro.php");

//$sql4="select * from compras_proveeduria";
$sql4="select * from compras_proveeduria ORDER BY cod_grabacion";

$result4 = $db->Execute($sql4);

$fecha=strtoupper($result4->fields["fecha"]);
$factura=strtoupper($result4->fields["factura"]);
$nro_proveedor=strtoupper($result4->fields["nro_proveedor"]);




$cod_merca3=$_REQUEST["cod_merca"];
$precio_unitario3=$_REQUEST["precio_unitario"];
$cantidad3=$_REQUEST["cantidad"];
$fecha3=$_REQUEST["fecha"];
$factura3=$_REQUEST["factura"];
$tipo_mov3=$_REQUEST["tipo_mov1"];
$condicion3=$_REQUEST["condicion1"];
$nro_proveedor3=$_REQUEST["nro_proveedor"];
$lote3=$_REQUEST["lote"];
$vto_lote3=$_REQUEST["vto_lote"];

$cantidad4=$_REQUEST["cantidad"];


include ("../../../../conexiones/config_pro.php");

$sql="select * from mercaderia where cod_merca = '$cod_merca'";
$result = $db->Execute($sql);

$nombre=strtoupper($result->fields["nombre"]);
$nombre = substr($nombre,0,8);


if ($B==0) {

?>
       <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
         <?
					
			}
?>
         <td height="1"><font size="-1"><?print $cod_merca1;?> </font>
             <div align="left"></div></td>
         <td height="1"><font size="-1"><?print $nombre;?> </font>
             <div align="left"></div></td>
         <td height="1"><font size="-1"><?print $cantidad1;?> </font>
             <div align="left"></div></td>
         <td height="1"><font size="-1"><?print $precio_unitario1;?> </font>
             <div align="left"></div></td>
         <td height="1"><font size="-1"><?print $lote1;?> </font>
             <div align="left"></div></td>
         <td width="74" height="1"><font size="-1"><?print $vto_lote1;?> </font>
             <div align="left"></div></td>
         <?



		
		
		if ($cod_merca2 != $cod_merca3) {

	 	         if ($lote2 != $lote3) {
 
  	 	        	if ($vto_lote2 != $vto_lote3) {

?>
              <font color="#FF0000"><?echo "11111111111111111111111".$cantidad1." ";?></font>
              <?


$cod_merca1=$_REQUEST["cod_merca"];
$precio_unitario1=$_REQUEST["precio_unitario"];
$cantidad1=$_REQUEST["cantidad"];
$fecha1=$_REQUEST["fecha"];
$factura1=$_REQUEST["factura"];
$tipo_mov1=$_REQUEST["tipo_mov1"];
$condicion1=$_REQUEST["condicion1"];
$nro_proveedor1=$_REQUEST["nro_proveedor"];
$lote1=$_REQUEST["lote"];
$vto_lote1=$_REQUEST["vto_lote"];
	
$cantidad4=$_REQUEST["cantidad4"];
		
		$cantidad1 = ($cantidad1) + ($cantidad4);

		include ("../../../../conexiones/config_pro.php");

$sql = "INSERT INTO `stockpro` (`cod_merca1` , `precio_unitario1` , `cantidad1` , `fecha1` , `factura1` , `tipo_mov1` , `condicion1` , `nro_proveedor1` , `lote1` , `vto_lote1` )VALUES ( '$cod_merca1' ,'$precio_unitario1' , '$cantidad1' , '$fecha1' , '$factura1' , '$tipo_mov1', '$condicion1', '$nro_proveedor1','$lote1', '$vto_lote1')";
mysql_query($sql);
		
				}
				}
				}

if ($cod_merca2 == $cod_merca3) {

	 	         if ($lote2 == $lote3) {
 
  	 	        	if ($vto_lote2 == $vto_lote3) {

?>
              <font color="#FF0000"><?echo "222222222222222222222 ".$cod_merca." ";?></font>
              <?


$cod_merca1=$_REQUEST["cod_merca1"];
$precio_unitario1=$_REQUEST["precio_unitario1"];
$cantidad1=$_REQUEST["cantidad1"];
$fecha1=$_REQUEST["fecha1"];
$factura1=$_REQUEST["factura1"];
$tipo_mov1=$_REQUEST["tipo_mov1"];
$condicion1=$_REQUEST["condicion1"];
$nro_proveedor1=$_REQUEST["nro_proveedor1"];
$lote1=$_REQUEST["lote1"];
$vto_lote1=$_REQUEST["vto_lote1"];

$cantidad1 = ($cantidad1) + ($cantidad);

		
		include ("../../../../conexiones/config_pro.php");

$sql = "INSERT INTO `stockpro` (`cod_merca1` , `precio_unitario1` , `cantidad1` , `fecha1` , `factura1` , `tipo_mov1` , `condicion1` , `nro_proveedor1` , `lote1` , `vto_lote1` )VALUES ( '$cod_merca1' ,'$precio_unitario1' , '$cantidad1' , '$fecha1' , '$factura1' , '$tipo_mov1', '$condicion1', '$nro_proveedor1','$lote1', '$vto_lote1')";
mysql_query($sql);

				}
				}
				}


				$result9->MoveNext();

		
		
		}
		break;

	

?>
      </table>
