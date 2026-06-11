<?php echo $usuario;?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>

<style type="text/css">
<!--
.Estilo1 {font-family: Arial, Helvetica, sans-serif}
.Estilo2 {font-size: 10px}
.Estilo3 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #0000FF; }
.Estilo6 {color: #0000FF}
.Estilo9 {
	font-size: 24px;
	font-family: Arial, Helvetica, sans-serif;
	color: #FF0000;
}
-->
</style>

<script LANGUAGE="JavaScript">
function multicarga(documento1,documento2)
{
parent.izquierda.location.href=documento1;
parent.central.location.href=documento2;
}
</script>

</HEAD>

<!-- <BODY  background="../IMAGENES/botones/barra/fondo3.jpg" onload ="ocultamenu()"> -->
<BODY  background="../IMAGENES/fondo_relleno.png" onload ="ocultamenu()">
<div align="center">
    <!-- <li><a href="../a_sectores/secretaria/secretaria.php" target = "izquierda">Secretaria</a> </li> -->
     <table width="423" border="0">
       <!--DWLayoutTable-->
       <tr>
         <th height="66" colspan="3" scope="col"><img src="..//imagenes/botones/NUEVOS/btn_CONTA.png" width="418" height="66"></th>
       </tr>
       <tr>
         <th width="135" scope="col"><div align="center" class="Estilo1 Estilo2"><span class="Estilo3"><a href="../a_sectores/consulta_bq/consultas_conta.php" target = "izquierda"><img src="../imagenes/botones/barra/auditoria.jpg" alt="Consul. Bioq." width="80" height="80" border = "0" title="Consultas Varias"></a></span></div></th>
         <th width="149" scope="col"><div align="center" class="Estilo3"><span class="Estilo1 Estilo2"><a href="../a_sectores/contaduria/contaduria.php?usuario=<?php print("$usuario");?>" target = "izquierda"><img src="../imagenes/botones/barra/contaduria.jpg" alt="Contadur&iacute;a" width="80" height="80" border = "0" title="Altas de Novedades del mes, alta de conceptos, etc"></a></span></div></th>
         <th width="125" scope="col"><div align="center" class="Estilo3"><a href="../a_sectores/estadistica/estadistica.php" target = "izquierda"><img src="../imagenes/botones/barra/estadistica.jpg" alt="Estadisticas" width="80" height="80" border = "0" title="Diferentes estadisticas, Ordenes, Recepcion, etc"></a></div></th>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo5">CONSULTAS</span></th>
         <th><span class="Estilo5">TESORERIA</span></th>
         <th><span class="Estilo5">ESTADISTICAS</span></th>
       </tr>
       <tr>
         <th scope="row"><div align="center" class="Estilo3"><span class="Estilo1 Estilo2"><a href="../a_sectores/contaduria/sueldos/sueldos.php" target = "izquierda"><img src="../imagenes/botones/barra/sueldos.jpg" alt="Consul. Bioq." width="80" height="80" border = "0" title="Consultas Varias"></a></span></div></th>
         <td><div align="center"><span class="Estilo3"><a href="../a_sectores/facturacion/facturacion_contaduria.php" target = "izquierda"><img src="../imagenes/botones/barra/facturacion.jpg" alt="Facturaci&oacute;n" width="80" height="80" border = "0"  title="Sistema para facturas Obras Sociales, Pre-Facturacion, Consultas"></a></span></div></td>
         <td><div align="center"><span class="Estilo3"><span class="Estilo1 Estilo2"><a href="../a_sectores/contaduria/iva.php" target = "izquierda"><img src="../imagenes/botones/barra/facturacion.jpg" alt="Facturaci&oacute;n" width="80" height="80" border = "0"  title="Sistema para facturas Obras Sociales, Pre-Facturacion, Consultas"></a></span></span></div></td>
       </tr>
       <tr>
         <th height="14" scope="row"><span class="Estilo5">SUELDOS</span></th>
         <td><div align="center"><span class="Estilo5">FACTURACION</span></div></td>
         <th valign="top"><span class="Estilo5">IVA VENTAS </span></th>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo3"><span class="Estilo1 Estilo2"><a href="javascript:multicarga('../a_sectores/contaduria/novedades/menu_novedades.php', '../a_sectores/contaduria/novedades/novedades_conceptos.php')"><img src="../imagenes/botones/barra/grabacion.jpg" alt="Grabacion" width="80" height="80" border = "0" title="Grabacion de Ordenes, Control de Ordenes, Pami, Consultas, etc"></a></span></span></th>
         <th><span class="Estilo3"><span class="Estilo1 Estilo2"><a href="../a_sectores/auditoria/debitos/debitos.php" target = "izquierda"><img src="../imagenes/botones/barra/auditoria.jpg" alt="Auditoria" width="80" height="80" border = "1" title="Altas de Practicas, metodos, Debitos, etc"></a></span></span></th>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo5">NOVEDADES Y CONCEPTOS </span></th>
         <th><span class="Estilo5">DEBITOS</span></th>
         <td>&nbsp;</td>
       </tr>
     </table>   
</div>

</BODY></HTML>