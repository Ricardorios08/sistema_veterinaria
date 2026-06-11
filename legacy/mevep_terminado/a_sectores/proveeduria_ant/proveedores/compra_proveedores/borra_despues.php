<?
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
<table width="591" height="377" border="1" bordercolor="#FFFFFF">
  <!--DWLayoutTable-->
  <tr>
    <td width="157" height="371" align="left" valign="top">
      <div align="left"></div>      <table width="146" border="0">
        <tr bgcolor="#006699">
          <td height="23" colspan="2"><div align="center"><strong><font color="#FFFFCC">Ingreso de Datos</font></strong> </div></td>
        </tr>
        <tr bgcolor="#FFFFCC">
          <td width="106" height="0" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Proveedor</font></div></td>
          <td width="30" height="0" bgcolor="#FFFFCC">
            <div align="left">
              <input type = "text" name = "nro_proveedor" id="nro_proveedor" size = "5" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['nro_proveedor']))   echo $_REQUEST['nro_proveedor'];?>">
              <font color="#FF0000" size="3"><strong>
              <?
	  ?>
          </strong></font></div></td>
        </tr>
  

        <tr bgcolor="#FFFFCC">
          <td width="106" height="0" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha</font></div></td>
          <td width="30" height="0"><font color="#000000" size="2">
            <input type = "text" name = "fecha" id="fecha" size = "5" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['fecha']))   echo $_REQUEST['fecha'];?>">
          </font></td>
        </tr>
        <tr bgcolor="#FFFFCC">
          <td width="106" height="0" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Factura</font></div></td>
          <td width="30" height="0"><input type = "text" name = "factura" id="factura" size = "5" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['factura']))   echo $_REQUEST['factura'];?>"></td>
        </tr>
        <tr bgcolor="#FFFFCC">
          <td width="106" height="0" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">% de bonificacion </font></div></td>
          <td width="30" height="0" bgcolor="#FFFFCC"><input type = "text" name = "porcentaje_boni" id="porcentaje_boni" size = "5" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['porcentaje_boni']))   echo $_REQUEST['porcentaje_boni'];?>"></td>
        </tr>
        <tr bgcolor="#FFFFCC">
          <td width="106" height="0" bgcolor="#FFFF99"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">% de Descuento</font></div></td>
          <td width="30" height="0"><input type = "text" name = "porcentaje_dto" id="porcentaje_dto" size = "5" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="<?php if (isset($_REQUEST['porcentaje_dto']))   echo $_REQUEST['porcentaje_dto'];?>"></td>
        </tr>
        </table>      
      <table width="157" border="0">
          <tr bgcolor="#006699">
            <td colspan="4" align="left"><div align="center"><strong></strong></div></td>
          </tr>
          <tr bgcolor="#E0EDF3">
            <td width="87" height="25" align="left" bgcolor="#E0EDF3"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Mercanderia </font></div></td>
            <td width="60" colspan="2" bgcolor="#E0EDF3">
              <div align="left"> <strong><font color="#006600">
              <input type = "text" name = "cod_merca" id="cod_merca" size = "4" onKeyPress="return verif_caracter(this,event)" maxlength="5"  value="">
            
<?

$cod_merca = $_REQUEST['cod_merca'];
include ("../../../../conexiones/config_pro.php");

	if (is_numeric($cod_merca))  {

$sql="select * from mercaderia where cod_merca = '$cod_merca%'";
$result = $db->Execute($sql);

								}
	else {
$sql = "select * from mercaderia where nombre = '$nombre%'";
$result = $db->Execute($sql);
	
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
              <font color="#006633"><strong><strong><font color="#006633"><strong><strong> <font color="#006633"><strong><strong><strong><?echo $nombre;?></strong></strong></strong></font></strong></strong></font></strong></strong></font> </font></strong></div></td>
  </tr>
  <!--  trae el nombre de la mercaderia -->
  <tr bgcolor="#E0EDF3">
  <td height="25" valign="top"><div align="right"><font color="#000000"><font size="2" face="Arial, Helvetica, sans-serif">Presentacion </font></font> </div>
  <td height="25" valign="top"><font color="#000000" size="2">
  <input type = "text" name = "presentacion" id="presentacion" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
  </font>
  <tr bgcolor="#E0EDF3">
  <td height="25" valign="top"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Lote </font><font color="#000000"></font> </div>
  <td height="25" valign="top"><font color="#000000" size="2">
  <input type = "text" name = "lote" id="lote" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
  </font>
  <tr bgcolor="#E0EDF3">
  <td height="26" valign="top" bgcolor="#E0EDF3"><div align="right"><font color="#000000">Vto del lote</font> </div>
  <td height="26" valign="top"><font color="#000000" size="2">
  <input type = "text" name = "vto_lote" id="vto_lote" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
  </font>
  <tr bgcolor="#E0EDF3">
  <td height="25" valign="top" bgcolor="#E0EDF3"><div align="right"><font color="#000000"><font size="2" face="Arial, Helvetica, sans-serif">Precio Unitario</font></font> </div>
  <td height="25" valign="top"><font color="#000000" size="2">
  <input type = "text" name = "precio_unitario" id="precio_unitario" size = "10" onKeyPress="return verif_caracter(this,event)" value="">
  </font>
  <?
}

$precio = $_REQUEST['precio'];
include ("../../../../conexiones/config_pro.php");

	if (is_numeric($precio))  {

$sql="select * from grab_compras_pro where precio = '$precio'";
$result = $db->Execute($sql);

							}

		$result = $db->Execute($sql);

 if (!$result) die("fallo".$db->ErrorMsg());

$precio=ucwords($result->fields["precio"]);

?>
      </table>      <div align="center">            Ingrese cantidad del producto 
              
              <input type = "text" name = "cantidad" id="cantidad"  tabindex = "2" size = "15" >
              <input name="Alta" type="submit" value="OK" id ="OK" size = "10" >
</div></td><td width="418" height="200" valign="top">
      
	  
	  
	 <table width="418" height="52" border="0">
       <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
         <th width="27" scope="col"><div align="left"><font color="#FFFFFF">N&ordm;</font> <font color="#FFFFFF"> </font></div></th>
         <th width="107" scope="col"><div align="left"><font color="#FFFFFF">Mercaderia</font></div></th>
         <th width="82" scope="col"><div align="left"><font color="#FFFFFF">Cantidad</font></div></th>
         <th width="61" scope="col"><div align="left"><font color="#FFFFFF">Precio</font></div></th>
         <th width="42" scope="col"><div align="left"><font color="#FFFFFF">Lote</font></div></th>
         <th width="74" scope="col"><div align="left"><font color="#FFFFFF">VtoLote</font></div></th>
         <th width="68" scope="col"><div align="left"><font color="#FFFFFF">Eliminar</font></div></th>
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
$cod_grabacion=$factura.$fecha.$cod_merca.$cantidad.$lote.$precio_unitario;
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

//$SQL="Delete From detalle where cod_grabacion = $a";

$sql9="Delete From detalles_compras where cod_grabacion = $cod_grabacion";

//$sql9="select * from detalles_compras where cod_grabacion = '$cod_grabacion'";
$result9 = $db->Execute($sql9);

if (!$result9) die("fallo".$db->ErrorMsg());

 while (!$result9->EOF) {

$cod_merca=ucwords($result9->fields["cod_merca"]);


$sql="select * from mercaderia where cod_merca = '$cod_merca'";
$result = $db->Execute($sql);

$nombre=strtoupper($result->fields["nombre"]);
$cantidad=strtoupper($result9->fields["cantidad"]);
$precio_unitario=strtoupper($result9->fields["precio_unitario"]);
$lote=strtoupper($result9->fields["lote"]);
$vto_lote=strtoupper($result9->fields["vto_lote"]);


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
         <td height="1"><font size="-1"><?print $cod_merca;?> </font>
             <div align="left"></div></td>
         <td height="1"><font size="-1"><?print $nombre;?> </font>
             <div align="left"></div></td>
         <td height="1"><font size="-1"><?print $cantidad;?> </font>
             <div align="left"></div></td>
         <td height="1"><font size="-1"><?print $precio_unitario;?> </font>
             <div align="left"></div></td>
         <td height="1"><font size="-1"><?print $lote;?> </font>
             <div align="left"></div></td>
         <td height="1"><font size="-1"><?print $vto_lote;?> </font>
             <div align="left"></div></td>
         <?
$neto_grabado=round($cantidad * $precio_unitario);

$importe = ($importe) + ($neto_grabado);


$sql1="select * from proveedores where cuenta = '$cuenta'";
$result11 = $db->Execute($sql1);
$tipo_iva=strtoupper($result1->fields["tipo_iva"]);



$tipo_iva=round($importe * 21) / 100;
$total = ($importe) + ($tipo_iva);


 ?>
         <td height="1" bgcolor="#B5D0EE"><div align="center"><font size="-7"><font size="-6"><font size="-1"><a href="borra_despues.php?cod_grabacion=<?print("$cod_grabacion");?>
                   &cod_merca=<?print("$cod_merca");?>
				  
				 
">[OK]</a></font><font size="-7"></font></font></font></div></td>
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
	 <table width="311" height="30" border="0">
        <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
		  <td width="92" height="1" bgcolor="#CCCC99"><div align="left"><font size="-1">NETO GRABADO </font></div></td>
          <td width="43" height="1" bgcolor="#CCCC99"><div align="center"><font size="-1"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?print $importe;?>
    
          </strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></div></td>
          <td width="71" bgcolor="#CCCC99"><font size="-1">PERCEPCION</font></td>
          <td width="70" bgcolor="#CCCC99"><font size="-7"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633" size="-1"><strong><strong><strong><?echo $percepcion;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td height="1" bgcolor="#CCCC99"><font size="-1">IVA</font></td>
          <td width="43" height="1" bgcolor="#CCCC99"><div align="center"><font size="-1"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo$tipo_iva;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></div></td>
          <td width="71" height="1" bgcolor="#CCCC99"><div align="center"><font size="-1">TOTAL</font></div></td>
          <td width="70" height="1" bgcolor="#CCCC99"><div align="center"><font size="-1"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong><?echo $total;?></strong></strong></strong></font></strong></strong></font></strong></strong></font></font></strong></font></div></td>
        </tr>
</table>
		  <a href="imprimir.php?fecha=<?print("$fecha");?>  && nro_laboratorio=<?print("$nro_laboratorio");?> && operario=<?print("$operario");?>&& observaciones=<?print("$observaciones");?> && nro_recibo=<?print("$nro_recibo");?>"><font size="-7">IMPRIMIR</font></a>      <div align="left"></div>
          <div align="center"></div>
      <div align="center"></div>
    <div align="center">
      
<a href="carga_merca_stock.php?cod_merca=<?print("$cod_merca");?>  && precio_unitario=<?print("$precio_unitario");?> && cantidad=<?print("$cantidad");?>&& fecha=<?print("$fecha");?> && factura=<?print("$factura");?> && cod_grabacion=<?print("$cod_grabacion");?> && tipo_mov=<?print("$tipo_mov");?> && condicion=<?print("$condicion");?>&& nro_proveedor=<?print("$nro_proveedor");?>&& lote=<?print("$lote");?>&& vto_lote=<?print("$vto_lote");?>"><font size="-7">GUARDAR MERCADERIA INGRESADA A LA LISTA DE STOCK</font></a>	  





<!--<font color="#0000FF"><a href="carga_merca_stock.php" target = "central" >
  <input name="Alta2" type="submit" value="GUARDAR MERCADERIA INGRESADA A LA LISTA DE STOCK" id ="Alta2" size = "10" >
</a>-->


    </font></div></td>
  </tr>
</table>
<div align="center"></div>
<table width="538" height="432" border="0" bordercolor="#FFFFFF"></table>