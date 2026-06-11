

<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">

<?
$nro_proveedor= $_REQUEST['nro_proveedor'];
$fecha = $_REQUEST['fecha'];
$factura= $_REQUEST['factura'];
$porcentaje_boni = $_REQUEST['porcentaje_boni'];

$porcentaje_dto=$_REQUEST["porcentaje_dto"];
$cod_merca = $_REQUEST['cod_merca'];
$presentacion = $_REQUEST['presentacion'];
$lote = $_REQUEST['lote'];
$vto_lote = $_REQUEST['vto_lote'];
$precio_unitario = $_REQUEST['precio_unitario'];
$cantidad = $_REQUEST['cantidad'];





include ("../../../../conexiones/config_pro.php");


 $sql="select * from compras_proveeduria ORDER BY nro_proveedor";
$result = $db->Execute($sql);
 if (!$result) die("fallo".$db->ErrorMsg());


$nro_proveedor=ucwords($result->fields["nro_proveedor"]);
$factura=ucwords($result->fields["factura"]);
$fecha=ucwords($result->fields["fecha"]);
$cod_merca=ucwords($result->fields["cod_merca"]);
$precio_unitario=ucwords($result->fields["precio_unitario"]);
$cantidad=ucwords($result->fields["cantidad"]);




?>

<table width="714" border="0">
      <tr bgcolor="#FFFFFF">
        <td width="399"><div align="center">
          <p align="left"><?echo "Fecha: ".$fecha;?><BR>
        </div></td>
        <td width="305" colspan="2"><div align="right">Planilla de Ventas  Nº: <?echo " ".$factura;?></div></td>
      </tr>
      <tr>
        <td colspan="3"><hr></td>
      </tr>
  <tr>
    <td colspan="3"><div align="center">
      <p class="Estilo6"><strong><font color="#FF0000">ASOCIACION BIOQUIMICA DE MENDOZA <BR>
      BELGRANO 925 - 5500 - MENDOZA </strong><strong>Telefono: 423-9333 / 9125 / 6647 <BR>
	  Ventas Proveeduria</font></strong></p>
      </div>      </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="3"><hr>      <em>Proveedor: <font color="#0000CC"><?echo " ".$denominacion." (".$nro_proveedor.")";?></font></em></td>
  </tr>
  
</table>
<div align="left">
 
  
  <table width="713" border="0">
    <tr bgcolor="#FFFFFF">
      <td height="21" colspan="7"><hr></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="160"><div align="center"><strong>CODIGO DE LA MERCADERIA</strong></div></td>
      <td colspan="6"><div align="center"><strong><?echo "     "?>CANTIDAD</strong></div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="23" colspan="2"><div align="center"></div>        <div align="center"><strong><?echo "     ".$cod_merca;?></strong></div></td>
      <td width="134">&nbsp;</td>
      <td width="68">&nbsp;</td>
      <td width="101">&nbsp;</td>
      <td width="101"><strong><?echo "     ".$cantidad;?></strong></td>
      <td width="121" height="23">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="34" colspan="7"><hr></td>
    </tr>
 
		
	
	

	
	
	<tr bordercolor="#000000" bgcolor="#FFFFFF">
      <td height="23" colspan="7"><hr></td>
    </tr>
    <tr bordercolor="#000000" bgcolor="#FFFFFF">

	  
	  
	  
	  
	  <td height="28" colspan="7"><div align="right"><strong>TOTAL DE LA COMPRA:<span class="Estilo1">..........</span><?echo "     ".$cantidad;?></strong></div>
        <div align="center"></div></td>
    </tr>
  </table>
  <br>
</div>
