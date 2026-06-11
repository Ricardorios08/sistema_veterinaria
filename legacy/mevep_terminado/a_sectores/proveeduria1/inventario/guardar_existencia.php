<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
 include("../../../conexiones/config_pro.php");


$B = 1;

?>



<table width="650" border="0">
  <tr>
    <td height="51" colspan="3" bordercolor="#000000" bgcolor="#FFFFFF"><div align="center"></div>      <div align="center"><font color="#000099"><strong><font size="+7" face="Arial, Helvetica, sans-serif">CONLOGO</font></strong></font></div>      <div align="center"></div></td>
  </tr>
  <td height="51" bordercolor="#000000" bgcolor="#FFFFFF">  
      <font color="#000099">
      </form>
      <div align="center"><strong><font face="Arial, Helvetica, sans-serif">POR FAVOR ESPERE ESTE PROCESO PUEDE DEMORARSE </font></strong>
      </div>
      </font>
  <tr>
    <td height="51" bordercolor="#000000" bgcolor="#FFFFFF">  <div align="center">
      <font color="#000099">
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="264" height="110">
          <param name="movie" value="../../../swf/circulo.swf">
          <param name="quality" value="high">
          <param name="wmode" value="transparent">
          <embed src="../../../swf/circulo.swf" width="264" height="110" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent"></embed>
      </object>
      </font></div>

      <font color="#000099">
      <?
  $anio_actual = date("y");
$mes_actual = date ("m");




$sql1="select nombre, cod_merca from mercaderia order by cod_merca";
$result1 = $db->Execute($sql1);


 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

$cod_mercaderia=strtoupper($result1->fields["cod_merca"]);
$descripcion=strtoupper($result1->fields["nombre"]);
$cantidad = $_POST[cantidad_ingresada.$cod_mercaderia];


$sql10="select * from existencias_nuevo where cod_mercaderia = '$cod_mercaderia'";
$result10 = $db->Execute($sql10);
$cantidad_ingresada=strtoupper($result10->fields["cantidad_ingresada"]);
$cod_merca=strtoupper($result10->fields["cod_mercaderia"]);

if ($cod_merca == "") {
	$sql = "INSERT INTO `existencias_nuevo` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `lote` ,  `mes_lote` , `anio_lote` , `cantidad_ingresada` , `precio_unitario` , `cantidad_salida` , `fecha_ultimo_mov` )  VALUES ('1' , '' ,'$cod_mercaderia' , '' , '' , '', '$cantidad' , '' , '' , '$fecha_ultimo_mov')";
mysql_query($sql);

 $sql = "INSERT INTO `stock_nuevo` ( `cod_mercaderia` , `fecha` , `cod_movimiento` , `tipo_fact` , `nro_comprobante` , `cantidad` , `precio_unitario` , `lote` ,  `mes_lote` , `anio_lote` , `cuenta` , `tipo_cuenta` ) VALUES ('$cod_mercaderia' , '$fecha_ultimo_mov' , '1' ,  '0' , '1' , '$cantidad' , '' , '' , '', '' , '0' , '1')";
mysql_query($sql);


}
else{
$sql = "UPDATE `existencias_nuevo` SET `cantidad_ingresada` = '$cantidad',  `fecha_ultimo_mov` = '$fecha_ultimo_mov' ,   `lote` = '$descripcion' WHERE cod_mercaderia = '$cod_mercaderia'";
mysql_query($sql);

 $sql = "UPDATE `stock_nuevo` SET `cantidad` = '$cantidad',  `fecha_ultimo_mov` = '$fecha_ultimo_mov' WHERE cod_mercaderia = '$cod_mercaderia'";
mysql_query($sql);


}




$leyenda = "MERCADERIA INGRESADA EN EXISTENCIA ".$descripcion;
//include ("../../../../alertas/campo_informacion.php");



	  $result1->MoveNext();
	}


  ?>
      </font>
	   <tr>
    <td height="51" colspan="3" bordercolor="#000000" bgcolor="#FFFFFF"><div align="center"></div>      <div align="center"><font color="#000099"><strong><font size="+7" face="Arial, Helvetica, sans-serif">FINALIZADO</font></strong></font></div>      <div align="center"></div></td>
  </tr>

</table>

