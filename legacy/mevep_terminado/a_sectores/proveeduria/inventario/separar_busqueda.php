<?

if ($banderas != 1){
$emisio=$_REQUEST["emision"];
	for ($i=0;$i<count($emisio);$i++)    
	{     
	$emision = $emisio[$i];    
	}
}else



switch ($emision){

	case "2":{ //imprimir
echo "Dsf";
?> <body background="../../..//imagenes/logito.png" onLoad="window.print(); window.close(); cerrar()" onUnload="window.opener.openedImprimir=0;"><?
		break;
	}

		case "3":{ //excel

		break;
	}



}

if ($bandera != 1){

if ($banderas != 1){
$cod_mercaderia = $_REQUEST['cod_mercaderia'];
}

 include("../../../conexiones/config_pro.php");
}else{
 include("../../../../conexiones/config_pro.php");
}






$B = 1;








?>

<!-- <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> -->
<table width="650" border="0">
  <!--DWLayoutTable-->
  <!-- <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td height="21" colspan="4"><div align="center"><strong>ASOCIACION BIOQUIMICA DE MENDOZA</strong></div></td>
    <td colspan="3"> <div align="right">PROVEEDURIA</div></td>
  </tr> -->

<!--   <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td height="20" colspan="7" valign="top"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">EXISTENCIA CARGADA. Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td height="22" colspan="7"><hr noshade></td>
  </tr> -->
  <tr bordercolor="#FFFFFF" bgcolor="#666666">


    <td width="61"><div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">CODIGO</font></strong></div></td>
    <td width="302"><div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">PRODUCTO</font></strong></div></td>
    <td width="90"><div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">EXISTENCIA</font></strong></div></td>
	<td width="87"><div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">MODIFICAR</font></strong></div></td>
	<td width="84"><div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">BORRAR</font></strong></div></td>
		   </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">
    <td colspan="5" bgcolor="#FFFFFF"><hr noshade></td>
  </tr>
   <!--  <tr bgcolor="#FFFFFF">
      <td height="22" colspan="7"><hr noshade></td>
    </tr> -->
  <?



$anio_actual = date("y");
$mes_actual = date ("m");

if ($cod_mercaderia == ""){
 $sql1="select * from existencias_nuevo order by cod_mercaderia";
}
else
{
$sql1="select * from existencias_nuevo where cod_mercaderia = '$cod_mercaderia' order by cod_mercaderia";
}
$result1 = $db->Execute($sql1);
 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {


$cod_mercaderia=strtoupper($result1->fields["cod_mercaderia"]);
$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
$$fecha_ultimo_mov=strtoupper($result1->fields["fecha_ultimo_mov"]);

$sql="select * from mercaderia where cod_merca like '$cod_mercaderia' ";
$result = $db->Execute($sql);
$descripcion=strtoupper($result->fields["nombre"]);
$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);


$cont = $cont + 1;





?> 
    <tr bgcolor="#A0A7F5"><td><div align="center"><font color="#000000" size="2"><?print("$cod_mercaderia");?></font></div></td>
    <td><div align="left"><font color="#000000" size="2"><?print("$descripcion");?></font></div></td>

<td><div align="center"><font color="#000000" size="2"><?print("$cantidad_ingresada");?></font></div></td>





<td><div align="center"><font color="#000000" size="2"><a href="toma_inventario/modificar2.php?cod_mercaderia=<?print("$cod_mercaderia");?>&&lote=<?print("$lote");?>&&anio_lote=<?print("$anio_lote");?>&&mes_lote=<?print("$mes_lote");?>&&cantidad_ingresada=<?print("$cantidad_ingresada");?>" target="central"><img src="../../../imagenes/office//027.ico" alt="Modificar" border = "0" ></a></font></div></td>
<td><div align="center"><font color="#000000" size="2"><a href="borrar.php?cod_mercaderia=<?print("$cod_mercaderia");?>&&lote=<?print("$lote");?>&&anio_lote=<?print("$anio_lote");?>&&mes_lote=<?print("$mes_lote");?>" target="central"><img src="../../../imagenes/office//095.ico" alt="Borrar" border = "0" onClick="return confirm('¿Esta seguro de borrar la existencia del producto?');"></a></font></div></td>
</tr>
<?


$result1->MoveNext();
	}
  
  
?>






 <tr bgcolor="#FFFFFF">
      <td colspan="5"><hr noshade></td>
  </tr>
  <tr bordercolor="#CCCCCC" bgcolor="#CCCCCC">
      <td colspan="5"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">CANTIDAD DE PRODUCTOS: </font><font color="#000000" size="2"><?print("$cont");?></font></div></td>
  </tr>
</table>
