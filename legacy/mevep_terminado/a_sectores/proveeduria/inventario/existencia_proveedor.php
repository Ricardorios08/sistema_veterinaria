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

 <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 


<FORM name="form" ACTION="guardar_existencia.php" METHOD = "POST">
<table width="1000" border="0">
  <tr>
    <td colspan="3"><div align="center"></div>      <div align="center"><strong><font face="Arial, Helvetica, sans-serif">MEVEP</font></strong></div>      <div align="center"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">PLANILLA TOMA DE INVENTARIO. Emitido el <?php echo $hoy;?> </font></div></td>
  </tr>
</table>

<table width="1000" border="1" cellspacing="0">
  
  <tr>
    <td width="98"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="378"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>
    <td width="203"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PROVEEDOR</font></div></td>
    <td width="41"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Costo</font></div></td>
    <td width="42"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Socio</font></div></td>
    <td width="62"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Particular</font></div></td>
  </tr>


<?php 
  $anio_actual = date("y");
$mes_actual = date ("m");

$sql1="select nombre, cod_merca, proveedor from mercaderia order by proveedor, nombre, cod_merca";
$result1 = $db->Execute($sql1);


 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

$cod_mercaderia=strtoupper($result1->fields["cod_merca"]);
$descripcion=strtoupper($result1->fields["nombre"]);
$proveedor=strtoupper($result1->fields["proveedor"]);

$sql10="select cantidad_ingresada from existencias_nuevo where cod_mercaderia = '$cod_mercaderia'";
$result10 = $db->Execute($sql10);
$cantidad_ingresada=strtoupper($result10->fields["cantidad_ingresada"]);

$sql4="select * from proveedores where cuenta = $proveedor";
 $result4 = $db->Execute($sql4);
 $denominacion=strtoupper($result4->fields["denominacion"]);




?>
   <tr>
    <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $cod_mercaderia;?></font></div></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $descripcion;?></font></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $denominacion;?></font></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>



  

  <?php  
	  $result1->MoveNext();
	}


  ?>

   
  </table>

  
