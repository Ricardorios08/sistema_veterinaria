<style type="text/css">
<!--
.Estilo30 {color: #FFFFFF}
.Estilo39 {font-family: Arial, Helvetica, sans-serif}
.Estilo42 {font-size: 12px}
.Estilo43 {font-size: 14px}
.Estilo44 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo45 {color: #009900}
-->
</style>
<table width="860" border="0">
  <tr bgcolor="#000099">
    <td width="7%" scope="col"><div align="center" class="Estilo1 Estilo30 Estilo39 Estilo42">Cod.</div></td>
    <td width="53%" scope="col"><div align="center" class="Estilo1 Estilo30 Estilo39 Estilo42">Descripcion</div></td>
	<td width="23%" scope="col"><div align="center" class="Estilo1 Estilo30 Estilo39 Estilo42">Presentación</div></td>
	<td width="17%" scope="col"><div align="center" class="Estilo1 Estilo30 Estilo39 Estilo42">Precio Actualizado</div></td>
  </tr>

<?php 
	


$cod_mercaderia = $_REQUEST['cod_mercaderia'];

include ("../../../conexiones/config_pro.php");

if ($cod_mercaderia == ""){
echo $sql = "SELECT * FROM `mercaderia` order by nombre";
}
else
{
 $sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` like '$cod_mercaderia%' OR descripcion like '$cod_mercaderia%' or nombre like '$cod_mercaderia%'";
}
$result = $db->Execute($sql);

if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$descripcion=strtoupper($result->fields["nombre"]);
$cod_merca=strtoupper($result->fields["cod_merca"]);
$presentacion=strtoupper($result->fields["presentacion"]);
$fabricante=strtoupper($result->fields["fabricante"]);
$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);

$precio_actualizado = number_format($precio_actualizado,2);
if ($descripcion == ""){

$result->MoveNext();
}
else
	 {



?>

  <tr bgcolor="#FFFFFF">
    <td scope="col"><span class="Estilo43"><span class="Estilo37 Estilo39 Estilo40"><a href="ver_compra.php?cod_merca=<?php print("$cod_merca");?>&&fecha=<?php print("$fecha1");?>"><span class="Estilo39"><?php print("$cod_merca");?>
</span></td>
    <td scope="col"><div align="left" class="Estilo44"><span class="Estilo37"><?php echo $descripcion;?></span></div></td>
	<td scope="col"><div align="left" class="Estilo44">
	  <div align="center"><span class="Estilo37"><?php echo $presentacion;?></span></div>
	</div></td>
	<td scope="col"><div align="left" class="Estilo44">
	  <div align="center"><span class="Estilo37 Estilo45"><strong>$ <?php echo $precio_actualizado;?></strong></span></div>
	</div></td>
  </tr>

<?php 
   $result->MoveNext();
				}
				}

 


	
	?>	
</table>

