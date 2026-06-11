<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>

<style type="text/css">
<!--
.Estilo1 {font-family: Arial, Helvetica, sans-serif}
.Estilo2 {font-size: 10px}
.Estilo3 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #0000FF; }
.Estilo8 {
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
         <th height="53" colspan="2" scope="col"><span class="Estilo8">AUDITORIA</span></th>
       </tr>
       <tr>
         <th scope="col"><div align="center" class="Estilo1 Estilo2"><span class="Estilo3"><a href="../validar/usuarios/agenda.php" target = "izquierda"><img src="../imagenes/agenda.jpg" alt="Tesorer&iacute;a" width="80" height="80" border = "1" title="Recepcion de Facturas pagadas, Registrar debito global, consulta de Facturas, Estado de Facturas, etc."></a></span></div></th>
         <th scope="col"><div align="center" class="Estilo3"><span class="Estilo1 Estilo2"><a href="../a_sectores/auditoria/auditoria_facturacion.php" target = "izquierda"><img src="../imagenes/botones/barra/auditoria.jpg" alt="Auditoria" width="80" height="80" border = "1" title="Altas de Practicas, metodos, Debitos, etc"></a></span></div></th>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo5">MESA DE ENTRADA</span></th>
         <th><span class="Estilo5"><a href="manual/manual.htm">AUDITORIA</a></span></th>
       </tr>
       <tr>
         <th scope="row"><div align="center" class="Estilo3"><a href="../a_sectores/facturacion/facturacion.php" target = "izquierda"><img src="../imagenes/botones/barra/facturacion.jpg" alt="Facturaci&oacute;n" width="80" height="80" border = "1"  title="Sistema para facturas Obras Sociales, Pre-Facturacion, Consultas"></a></div></th>
         <td><div align="center" class="Estilo3"><a href="../a_sectores/recepcion/recepcion.php" target = "izquierda"><img src="../imagenes/recepcion.jpg" alt="Recepci&oacute;n" width="80" height="80" border = "1" title="Recepcion de Ordenes, Consultas, re-impresiones de planillas, etc."></a></div></td>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo5"><a href="manual/manual_facturacion.htm">FACTURACION</a></span></th>
         <th><span class="Estilo5">RECEPCION</span></th>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo1 Estilo2"><span class="Estilo3"><a href="../a_sectores/consulta_bq/consultas_conta.php" target = "izquierda"><img src="../imagenes/botones/barra/auditoria.jpg" alt="Consul. Bioq." width="80" height="80" border = "0" title="Consultas Varias"></a></span></span></th>
         <td><div align="center" class="Estilo3">
             <!-- 		 <a href="../a_sectores/grabacion/grabacion.php" target = "izquierda"> -->
             <A HREF="javascript:multicarga('../a_sectores/grabacion/grabacion.php', '../a_sectores/grabacion/mensaje.php')"> <img src="../imagenes/botones/barra/grabacion.jpg" alt="Grabacion" width="80" height="80" border = "1" title="Grabacion de Ordenes, Control de Ordenes, Pami, Consultas, etc"></a></div></td>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo5">CONSULTAS</span></th>
         <th><span class="Estilo5">GRABACION</span></th>
       </tr>
     </table>   
         <span class="Estilo3"></span><span class="Estilo3"></span>
         <!--<<li><a href="../archivos varios/importar_tablas.php" target = "central">Importar tablas</a> </li>
<li><a href="../a_sectores/consulta_bq/mail.php" target = "central">Consulta a los Programadores</a> </li>-->
</div>

</BODY>
</HTML>
