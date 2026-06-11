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
     <table width="422" border="0">
       <tr>
         <th height="57" colspan="4" scope="col"><span class="Estilo9">MEGA - ANALIZAR </span></th>
       </tr>
       <tr>
         <th width="143" scope="col"><div align="center" class="Estilo1 Estilo2"><span class="Estilo3"><a href="../a_sectores/consulta_bq/consultas.php" target = "izquierda"><img src="../imagenes/botones/barra/consultas.jpg" alt="Consul. Bioq." width="80" height="80" border = "1" title="Consultas Varias"></a></span></div></th>
         <th width="136" scope="col"><div align="center" class="Estilo3"><span class="Estilo1 Estilo2"><a href="../a_sectores/mega/mega.php" target = "izquierda"><img src="../imagenes/botones/barra/contaduria.jpg" alt="Contadur&iacute;a" width="80" height="80" border = "1" title="Altas de Novedades del mes, alta de conceptos, etc"></a></span></div></th>
         <th width="129" scope="col"><div align="center" class="Estilo3"><a href="../a_sectores/estadistica/estadistica.php" target = "izquierda"><img src="../imagenes/botones/barra/estadistica.jpg" alt="Estadisticas" width="80" height="80" border = "1" title="Diferentes estadisticas, Ordenes, Recepcion, etc"></a></div></th>
         <th width="129" scope="col"><span class="Estilo3"> <A HREF="javascript:multicarga('../a_sectores/mega/mega.php', '../a_sectores/mega/facturacion/facturar.php')">
		 		 <img src="../imagenes/botones/barra/facturacion.jpg" alt="Facturaci&oacute;n" width="80" height="80" border = "1"  title="Sistema para facturas Obras Sociales, Pre-Facturacion, Consultas"></a></span></th>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo5">CONSULTAS</span></th>
         <th><span class="Estilo5">MEGA</span></th>
         <th><span class="Estilo5">ESTADISTICAS</span></th>
         <th><span class="Estilo5"><a href="manual/manual_facturacion.htm">FACTURAR</a></span></th>
       </tr>
       <tr>
         <th scope="row"><div align="center" class="Estilo3"></div></th>
         <td><div align="center" class="Estilo3"></div></td>
         <td><div align="center" class="Estilo3">
<!-- 		 <a href="../a_sectores/grabacion/grabacion.php" target = "izquierda"> -->
		 <A HREF="javascript:multicarga('../a_sectores/grabacion/grabacion.php', '../a_sectores/grabacion/mensaje.php')">		 </a></div></td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <th scope="row">&nbsp;</th>
         <th>&nbsp;</th>
         <th>&nbsp;</th>
         <th>&nbsp;</th>
       </tr>
     </table>   
         <span class="Estilo3"></span><span class="Estilo3"></span>
         <!--<<li><a href="../archivos varios/importar_tablas.php" target = "central">Importar tablas</a> </li>
<li><a href="../a_sectores/consulta_bq/mail.php" target = "central">Consulta a los Programadores</a> </li>-->
</div>

</BODY>
</HTML>
