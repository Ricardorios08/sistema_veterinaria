<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
 include("../../../conexiones/config_pro.php");

$a = "inventario.xls";

/*
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$a");
*/

$B = 1;


?>

<!-- <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()">   -->


<FORM name="form" ACTION="guardar_existencia.php" METHOD = "POST">
<table width="650" border="0">
  <tr>
    <td colspan="3"><div align="center"></div>      <div align="center"><strong><font face="Arial, Helvetica, sans-serif">CONLOGO</font></strong></div>      <div align="center"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">PLANILLA TOMA DE INVENTARIO. Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr>
    <td colspan="3"><HR noshade></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="104"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="447"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">PRODUCTO</font></td>
    <td width="85"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">CANT</font></div></td>
  </tr>
 <tr>
    <td colspan="3"><HR noshade></td>
  </tr>
<?
  $anio_actual = date("y");
$mes_actual = date ("m");

$sql1="select nombre, cod_merca from mercaderia order by cod_merca";
$result1 = $db->Execute($sql1);


 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

$cod_mercaderia=strtoupper($result1->fields["cod_merca"]);
$descripcion=strtoupper($result1->fields["nombre"]);

$sql10="select cantidad_ingresada from existencias_nuevo where cod_mercaderia = '$cod_mercaderia'";
$result10 = $db->Execute($sql10);
$cantidad_ingresada=strtoupper($result10->fields["cantidad_ingresada"]);



?>
 
  <tr>
    <td><?echo $cod_mercaderia;?></td>
    <td><?echo $descripcion;?></td>
    <td><div align="center">   <input  name="<?echo cantidad_ingresada.$cod_mercaderia;?>" type="text"  value="<?echo $cantidad_ingresada;?>" size = "4">
	</div></td>
  </tr>


  <? 
	  $result1->MoveNext();
	}


  ?>
      <input name="Alta" type="submit" value="ACTUALIZAR" id ="Alta" size = "10" >
  </form>

</table>
