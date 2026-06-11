<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "conlogos");

$B = 1;








?>

<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()">
<table width="650" border="0">
  <!--DWLayoutTable-->
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td colspan="3"><div align="center"><strong>CONLOGO</strong></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td colspan="3"><hr noshade></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td colspan="3" valign="top"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">INVENTARIO 2008/2009 . Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td colspan="3"><hr noshade></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">


    <td width="116"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="417"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>
    <td width="103" valign="top"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">EXISTENCIA</font></div></td>
   <!--  <td width="105"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">PRECIO UNITARIO </font></div></td>
    <td width="105"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">TOTAL</font></div></td> -->
  </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="3"><hr noshade></td>
    </tr>
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
$descripcion=strtoupper($result->fields["nombre"]);
$presentacion=strtoupper($result->fields["presentacion"]);
$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);


$vto_lote = $mes_lote." - ".$anio_lote;



$cantidad_existente = $cantidad_ingresada - $cantidad_salida;
	





	  
$mes = $mes_lote;
$anio = $anio_lote;

$total = $precio_actualizado * $cantidad_existente;

$total_existencia = $total_existencia + $total;


$cont = $cont + 1;




?>
      <blink> <tr bgcolor="#FFFFFF"><td><div align="center"><font color="#000000" size="2"><?print("$cod_mercaderia");?></font></div></td>
    <td><div align="left"><font color="#000000" size="2"><?print("$descripcion");?></font></div></td>
<td valign="top"><div align="center"><font color="#000000" size="2"><?print("$cantidad_existente");?></font></div></td>
<!-- <td><div align="center"><font color="#000000" size="2">$ <?ECHO number_format($precio_actualizado,2);?></font><font color="#000000"></font></div></td>
<td><div align="center"><font color="#000000" size="2">$ <?ECHO NUMBER_FORMAT($total,2);?></font><font color="#000000"></font></div></td> -->
</blink>  <tr bgcolor="#FFFFFF">
      <td colspan="3"><hr noshade></td>
  </tr>


<?
  $result1->MoveNext();

  }

  ?>
    <tr bgcolor="#FFFFFF">
      <td colspan="3"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">CANTIDAD DE PRODUCTOS: </font><font color="#000000" size="2"><?print("$cont");?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font><font face="Arial, Helvetica, sans-serif"><strong>TOTAL INVENTARIO</strong></font> <font color="#000000"><strong>$ <?echo  number_format($total_existencia,2);?></strong></font></div>        </td>
    </tr>
</table>
