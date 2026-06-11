<style type="text/css">
<!--
.Estilo30 {color: #FFFFFF}
.Estilo39 {font-family: Arial, Helvetica, sans-serif}
.Estilo40 {font-size: 10px}
.Estilo41 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo42 {font-size: 12px}
-->
</style>
<table width="96%" border="0">
  <tr bgcolor="#000099">
    <td width="17%" scope="col"><div align="center" class="Estilo1 Estilo30 Estilo39 Estilo42">Cod.</div></td>
    <td width="83%" scope="col"><div align="center" class="Estilo1 Estilo30 Estilo39 Estilo42">Descripcion</div></td>
	    <td width="83%" scope="col"><div align="center" class="Estilo1 Estilo30 Estilo39 Estilo42">Presentación</div></td>
  </tr>

<?
	


$cod_mercaderia = $_REQUEST['palabra'];

include("../../../conexiones/config_pro.php");

if ($cod_mercaderia == ""){
$sql = "SELECT * FROM `mercaderia` order by nombre";
}
else
{
 $sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` like '$cod_mercaderia%' OR descripcion like '$cod_mercaderia%' or nombre like '$cod_mercaderia%'";
}
$result = $db->Execute($sql);

if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$descripcion=strtoupper($result->fields["descripcion"]);
$cod_merca=strtoupper($result->fields["cod_merca"]);
$presentacion=strtoupper($result->fields["presentacion"]);

if ($descripcion == ""){

$result->MoveNext();
}
else
	 {



?>

  <tr bgcolor="#FFFFFF">
    <td scope="col"><span class="Estilo37 Estilo39 Estilo40"><?echo $cod_merca;?></span></td>

    <td scope="col"><div align="left" class="Estilo41"><span class="Estilo37"><?echo $descripcion;?></span></div></td>
	<td scope="col"><div align="left" class="Estilo41"><span class="Estilo37"><?echo $presentacion;?></span></div></td>
  </tr>

<?
   $result->MoveNext();
				}
				}

 


	
	?>	
</table>


