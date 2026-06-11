<html>
<BODY onload = "on_load ()">



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



//-------------------------------guarda segun carga anterior-------------------------------//

//$sql2="select * from stockpro";





//$sql3="select * from detalles_compras where cod_merca";


include ("../../../../conexiones/config_pro.php");
$sql3="select * from detalles_compras";
$result3 = $db->Execute($sql3);
if (!$result3) die("fallo".$db->ErrorMsg());

 while (!$result3->EOF) {

$cod_grabacion=strtoupper($result3->fields["cod_grabacion"]);
$cod_merca=strtoupper($result3->fields["cod_merca"]);
$presentacion=strtoupper($result3->fields["presentacion"]);
$lote=strtoupper($result3->fields["lote"]);
$vto_lote=strtoupper($result3->fields["vto_lote"]);
$cantidad=strtoupper($result3->fields["cantidad"]);
$precio_unitario=strtoupper($result3->fields["precio_unitario"]);

$cod_grabacion=$_REQUEST["cod_grabacion"];
$cod_merca=$_REQUEST["cod_merca"];
$presentacion=$_REQUEST["presentacion"];
$lote=$_REQUEST["lote"];
$vto_lote=$_REQUEST["vto_lote"];
$cantidad=$_REQUEST["cantidad"];
$precio_unitario=$_REQUEST["precio_unitario"];



$sql4="select * from compras_proveeduria";

$result4 = $db->Execute($sql4);

$cod_grabacion=strtoupper($result4->fields["cod_grabacion"]);
$nro_proveedor=strtoupper($result4->fields["nro_proveedor"]);
$fecha=strtoupper($result4->fields["fecha"]);
$factura=strtoupper($result4->fields["factura"]);
$porcentaje_boni=strtoupper($result4->fields["porcentaje_boni"]);
$porcentaje_dto=strtoupper($result4->fields["porcentaje_dto"]);


$cod_grabacion=$_REQUEST["cod_grabacion"];
$nro_proveedor=$_REQUEST["nro_proveedor"];
$fecha=$_REQUEST["fecha"];
$factura=$_REQUEST["factura"];
$porcentaje_boni=$_REQUEST["porcentaje_boni"];
$porcentaje_dto=$_REQUEST["porcentaje_dto"];



$sql5="select * from stockpro";

$result5 = $db->Execute($sql5);

$cod_merca1=strtoupper($result4->fields["cod_merca1"]);
$precio_unitario1=strtoupper($result4->fields["precio_unitario1"]);
$cantidad=strtoupper($result4->fields["cantidad"]);
$fecha1=strtoupper($result4->fields["fecha1"]);
$factura1=strtoupper($result4->fields["factura1"]);
$tipo_mov1=strtoupper($result4->fields["tipo_mov1"]);
$condicion1=strtoupper($result4->fields["condicion1"]);
$nro_proveedor1=strtoupper($result4->fields["nro_proveedor1"]);
$lote1=strtoupper($result4->fields["lote1"]);
$vto_lote1=strtoupper($result4->fields["vto_lote1"]);


$cod_merca1=$_REQUEST["cod_merca"];
$precio_unitario1=$_REQUEST["precio_unitario"];
$cantidad1=$_REQUEST["cantidad"];
$fecha1=$_REQUEST["fecha"];
$factura1=$_REQUEST["factura"];
$tipo_mov1=$_REQUEST["tipo_mov"];
$condicion1=$_REQUEST["condicion"];
$nro_proveedor1=$_REQUEST["nro_proveedor"];
$lote1=$_REQUEST["lote"];
$vto_lote1=$_REQUEST["vto_lote"];

//if ($cod_merca2 =! $cod_merca1) {

//	 	         if ($lote2 =! $lote1) {
 
// 	 	        	if ($vto_lote2 =! $vto_lote1) {



$sql = "INSERT INTO `stockpro` (`cod_merca1` , `precio_unitario1` , `cantidad1` , `fecha1` , `factura1` , `tipo_mov1` , `condicion1` , `nro_proveedor1` , `lote1` , `vto_lote1` )VALUES ( '$cod_merca1' ,'$precio_unitario1' , '$cantidad1' , '$fecha1' , '$factura1' , '$tipo_mov1', '$condicion1', '$nro_proveedor1','$lote1', '$vto_lote1')";
mysql_query($sql);

?>

<div align="left"></div>
<table width="311" height="30" border="1">
        <tr>
          <td><font size="-1">Codigo de la Mercaderia </font></td>
          <td><font size="-1">Precio Unitario </font></td>
          <td><font size="-1">Cantidad</font></td>
          <td><font size="-1">Fecha</font></td>
        </tr>
        <tr>
          <td><font size="-1"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?print $cod_merca1;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></td>
          <td><font size="-7"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633" size="-1"><strong><strong><strong><?echo $precio_unitario1;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></td>
          <td><font size="-1"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo$cantidad1;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></td>
          <td><font size="-1"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $fecha1;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></td>
        </tr>
</table>
</td>
  </tr>
</table>
<div align="center"></div>
<table width="71" height="58" border="0" bordercolor="#FFFFFF">
</table>
<?
		$result3->MoveNext();


		}

break;

			
//}
//}
//}

?>
