<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
 include("../../../../conexiones/config_pro.php");


$B = 1;








?>
<table width="113%" height="92" border="0">
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
  <tr bordercolor="#FFFFFF" bgcolor="#000099">


    <td width="116" height="19"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="303"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>

<td width="127"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">PRESENTACION</font></div></td>
	<td width="127"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">LOTE</font></div></td>
<td width="127"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">VTO</font></div></td>
    <td width="105"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">EXISTENCIA</font></div></td>
  </tr>
   <!--  <tr bgcolor="#FFFFFF">
      <td height="22" colspan="7"><hr noshade></td>
    </tr> -->
  <?



$anio_actual = date("y");
$mes_actual = date ("m");

$sql1="select * from existencias_nuevo order by cod_mercaderia";
$result1 = $db->Execute($sql1);
 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {


$cod_mercaderia=strtoupper($result1->fields["cod_mercaderia"]);
$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
$lote=strtoupper($result1->fields["lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$fecha_ultimo_mov=strtoupper($result1->fields["fecha_ultimo_mov"]);

$sql="select * from mercaderia where cod_merca like '$cod_mercaderia' ";
$result = $db->Execute($sql);
$descripcion=strtoupper($result->fields["descripcion"]);
$presentacion=strtoupper($result->fields["presentacion"]);
$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);


$cont = $cont + 1;





?> 
    <tr bgcolor="#E1F2EF"><td height="20"><div align="center"><font color="#000000" size="2"><?print("$cod_mercaderia");?></font></div></td>
    <td><div align="left"><font color="#000000" size="2"><?print("$descripcion");?></font></div></td>
    <td><div align="center"><font color="#000000" size="2"><?print("$presentacion");?></font></div></td>
<td><div align="center"><font color="#000000" size="2"><?print("$lote");?></font></div></td>
<td><div align="center"><font color="#000000" size="2"><?print("$mes_lote");?> / <?print("$anio_lote");?></font></div></td>
<td><div align="center"><font color="#000000" size="2"><?print("$cantidad_ingresada");?></font></div></td>
 </tr>

   <?



$result1->MoveNext();
	}
  
  
?>






 <tr bgcolor="#FFFFFF">
      <td height="22" colspan="7"><hr noshade></td>
  </tr>
  <tr bgcolor="#E1F2EF">
      <td height="21" colspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">CANTIDAD DE PRODUCTOS: </font><font color="#000000" size="2"><?print("$cont");?></font></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3"><div align="right"></div></td>
  </tr>
</table>
