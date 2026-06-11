<style type="text/css">
<!--
.Estilo16 {font-family: Arial, Helvetica, sans-serif}
.Estilo26 {
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->


<!--
.Estilo67 {color: #FFFFFF; font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
.Estilo69 {font-size: 12px}
-->

<!--
.Estilo79 {color: #000099}
.Estilo80 {color: #000099; font-size: 12px; }
-->



</style>


<table width="750" border="0">
  <tr bgcolor="#E6E6E6">
    <td width="7%" scope="col"><div align="center" class="Estilo1 Estilo39 Estilo42 Estilo45 Estilo16 Estilo60 Estilo67 Estilo69 Estilo79">Cod.</div></td>
    <td width="30%" scope="col"><div align="center" class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60 Estilo67 Estilo69 Estilo79">Descripcion</div></td>
    <td width="13%" scope="col"><div align="center" class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60 Estilo67 Estilo69 Estilo79">Presentaci&oacute;n</div></td>
    
    <td width="7%" scope="col"><div align="center" class="Estilo80"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo60  Estilo16">Precio</span></div></td>
  </tr>

<?
	



$busca == "SI";

include("../../../../conexiones/config_grabacion.php");

if ($cod_mercaderia == ""){
$sql = "SELECT * FROM `mercaderia` order by proveedor, descripcion";
}
else
{
 $sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` like '$cod_mercaderia%' OR descripcion like '$cod_mercaderia%' or nombre like '$cod_mercaderia%'";
}
$result = $db_pro->Execute($sql);

if (!$result) die("fallo".$db_pro->ErrorMsg());

 while (!$result->EOF) {

$cod_merca=$result->fields["cod_merca"];
$precio_actualizado=$result->fields["precio_actualizado"];
$descripcion=strtoupper($result->fields["descripcion"]);
$presentacion=strtoupper($result->fields["presentacion"]);

$prov = $proveedor;
$proveedor=strtoupper($result->fields["proveedor"]);

$sql8="select * from proveedores where cuenta = $proveedor";
$result8 = $db_pro->Execute($sql8);
$denominacion=strtoupper($result8->fields["denominacion"]);



$precio_actualizado = number_format($precio_actualizado,2);




 if ($B == 1) {

?>
  <tr bordercolor="#FFFFFF" bgcolor="#CCFFCC" class="Estilo26" >
    <?
$B = 0;
				}
	ELSE	{
	$B=1;
		 	
?>
  <tr bordercolor="#FFFFCC" bgcolor="#E1F2EF" class="Estilo26">
    <?

			}



if ($prov != $proveedor){
?>
  <tr bordercolor="#FFFFCC" bgcolor="#E1F2EF" class="Estilo26">
    <td height="20" colspan="7" bgcolor="#CFCFCF" class="Estilo61" scope="col"><div align="left"><span class="Estilo80"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo60  Estilo16">Proveedor: </span></span><?echo $denominacion;?>  </div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#E1F2EF" class="Estilo26">
    <?
}

?>
<td height="20" class="Estilo61" scope="col"><div align="center"><?echo $cod_merca;?></span></div></div></td>
    <td scope="col"><span class="Estilo60"><?echo $descripcion;?></span></td>
    <td scope="col"><div align="center" class="Estilo60"><?echo $presentacion;?></div></td>
    
      <div align="center" class="Estilo60"></div></td>
    <td scope="col"><div align="center"><span class="Estilo60">$ <?echo $precio_actualizado;?></span></div></td>
  </tr>

<?
   $result->MoveNext();
				}
				

 

	?>	
</table>

