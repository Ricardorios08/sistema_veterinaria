<?php
include ("../../../conexiones/config_pro.php");
$id = $_REQUEST['id'];

$SQL="Delete From stockpro where cod_merca = $cod_merca";
$db->Execute($SQL);

//include ("borra_ficha_si.php");
?>
<style type="text/css">
<!--
.Estilo5 {color: #FFFFFF}
.Estilo6 {color: #FF0000}
-->
</style>
<table width="365" border="1">
 <tr>
   <th height="44" bgcolor="#000099" scope="col"><span class="Estilo5"> Mecaderia(<?ECHO $id;?>)</span></th>
 </tr>
  <tr>
    <td bgcolor="#C1F2FF"><div align="center" class="Estilo6">SE HA ELIMINADO LA MERCADERIA...CARGUELA NUEVAMENTE..</div></td>
  </tr>
</table>