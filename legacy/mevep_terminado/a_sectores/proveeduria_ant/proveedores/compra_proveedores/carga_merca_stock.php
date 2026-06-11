 <?
include ("../../../../conexiones/config_pro.php");


//$sql1="select * from detalles_compras where cod_merca like '$cod_merca'";
//$sql1="select * from detalles_compras order by cod_merca desc";
// $sql="select * from detalles_compras ORDER BY cod_grabacion";


$sql1="select * from detalles_compras";
$result1 = $db->Execute($sql1);
  
 
 if (!$result1) die("fallo".$db->ErrorMsg());
  
  while (!$result1->EOF) {


$cod_grabacion=ucwords($result1->fields["cod_grabacion"]);
$cod_merca=ucwords($result1->fields["cod_merca"]);
$lote=ucwords($result1->fields["lote"]);
$vto_lote=ucwords($result1->fields["vto_lote"]);
$cantidad=ucwords($result1->fields["cantidad"]);
$precio_unitario=ucwords($result1->fields["precio_unitario"]);
$result1->MoveNext();
	}
echo $cod_merca;

 

//$sql2="select * from compras_proveeduria where cod_grabacion like '$cod_grabacion'";
 
$sql2="select * from compras_proveeduria";
$result2 = $db->Execute($sql2);
 
 if (!$result2) die("fallo".$db->ErrorMsg());
  while (!$result2->EOF) {

$cod_grabacion=ucwords($result2->fields["cod_grabacion"]);
$nro_proveedor=ucwords($result2->fields["nro_proveedor"]);
$fecha=ucwords($result2->fields["fecha"]);
$factura=ucwords($result2->fields["factura"]);
$cod_grabacion=ucwords($result2->fields["cod_grabacion"]);
$result2->MoveNext();
	}



$sql="select * from stockpro";

$result = $db->Execute($sql);

if (!$result) die("fallo".$db->ErrorMsg());

while (!$result->EOF) {
echo $cod_merca;

$cod_merca=ucwords($result->fields["cod_merca"]);


$sql="select * from mercaderia where cod_merca = '$cod_merca'";
$result = $db->Execute($sql);

$cod_merca1=strtoupper($result->fields["cod_merca1"]);
$lote1=strtoupper($result->fields["lote1"]);
$vto_lote1=strtoupper($result->fields["vto_lote1"]);
$cantidad1=strtoupper($result->fields["cantidad1"]);



$cod_merca1 = substr($cod_merca1,0,8);


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
       
        <table width="311" height="30" border="0">
        <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
		  <td width="92" height="1" bgcolor="#CCCC99"><div align="left"><font size="-1">NETO GRABADO </font></div></td>
          <td width="43" height="1" bgcolor="#CCCC99"><div align="center"><font size="-1"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong><strong>
    
          </strong></strong></strong></font><font size="-1"><?print $cod_merca1;?></font></strong></strong></font></strong></strong></font></font></strong></font></div></td>
          <td width="71" bgcolor="#CCCC99"><font size="-1">PERCEPCION</font></td>
          <td width="70" bgcolor="#CCCC99"><font size="-7"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633" size="-1"><strong><strong></strong></strong></font><font size="-1"><?print $cantidad1;?></font></strong></strong></font></strong></strong></font></font></strong></font></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td height="1" bgcolor="#CCCC99"><font size="-1">IVA</font></td>
          <td width="43" height="1" bgcolor="#CCCC99"><div align="center"><font size="-1"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong></strong></strong></font><font size="-1"><?print $lote1;?></font></strong></strong></font></strong></strong></font></font></strong></font></div></td>
          <td width="71" height="1" bgcolor="#CCCC99"><div align="center"><font size="-1">TOTAL</font></div></td>
          <td width="70" height="1" bgcolor="#CCCC99"><div align="center"><font size="-1"><strong><font color="#006600"><font color="#006633"><strong><strong><font color="#006633"><strong><strong><font color="#006633"><strong><strong></strong></strong></font><font size="-1"><?print $vto_lote1;?></font></strong></strong></font></strong></strong></font></font></strong></font></div></td>
        </tr>
</table>
		<?






	if ($cod_merca == $cod_merca1) {

	 	         if ($lote == $lote1) {
 
  	 	        	if ($vto_lote == $vto_lote1) {

$cod_merca1 = ($cod_merca1) + ($cod_merca);


include ("../../../../conexiones/config_pro.php");

echo$sql = "INSERT INTO `stockpro` (`cod_merca1` , `precio_unitario1` , `cantidad1` , `fecha1` , `factura1` , `tipo_mov1` , `condicion1` , `nro_proveedor1` , `lote1` , `vto_lote1` )VALUES ( '$cod_merca1' ,'$precio_unitario1' , '$cantidad1' , '$fecha1' , '$factura1' , '$tipo_mov1', '$condicion1', '$nro_proveedor1', '$lote1', '$vto_lote1')";
mysql_query($sql);

	$result->MoveNext();
		
		}

		}
		
		}
	break;		
}
	
