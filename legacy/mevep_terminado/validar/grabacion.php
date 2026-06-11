<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>

<style type="text/css">
<!--
.Estilo1 {font-family: Arial, Helvetica, sans-serif}
.Estilo2 {font-size: 10px}
.Estilo3 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #0000FF; }
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
     <table width="422" border="0" align="center">
<tr>
         <th height="53" colspan="4" scope="col"><span class="Estilo9">SISTEMA DE GRABACION </span></th>
       </tr>
         <th width="140" scope="col"><div align="center" class="Estilo1 Estilo2">
           <div align="center"><span class="Estilo3"><a href="../validar/usuarios/agenda.php" target = "izquierda"><img src="../imagenes/agenda.jpg" alt="Tesorer&iacute;a" width="80" height="80" border = "1" title="Recepcion de Facturas pagadas, Registrar debito global, consulta de Facturas, Estado de Facturas, etc."></a></span></div>
         </div></th>
         <th width="137" scope="col"><div align="center" class="Estilo3">
           <div align="center"><span class="Estilo1 Estilo2"><a href="../a_sectores/consulta_bq/consultas.php" target = "izquierda"><img src="../imagenes/botones/barra/consultas.jpg" alt="Consul. Bioq." width="80" height="80" border = "1" title="Consultas Varias"></a></span></div>
         </div></th>
         <th width="131" scope="col"><div align="center" class="Estilo3">
           <div align="center"><a href="../a_sectores/estadistica/estadistica.php" target = "izquierda"><img src="../imagenes/botones/barra/estadistica.jpg" alt="Estadisticas" width="80" height="80" border = "1" title="Diferentes estadisticas, Ordenes, Recepcion, etc"></a></div>
         </div></th>
       </tr>
       <tr>
         <th scope="row"><div align="center"><span class="Estilo5">MESA DE ENTRADA</span></div></th>
         <th><div align="center"><span class="Estilo5">CONSULTAS</span></div></th>
         <th><div align="center"><span class="Estilo5">ESTADISTICAS</span></div></th>
       </tr>
       <tr>
         <th scope="row"><div align="center" class="Estilo3">
           <div align="center"><a href="javascript:multicarga('../a_sectores/grabacion/grabacion.php', '../a_sectores/grabacion/grabar_nuevo/grabacion_ordenes.php')"><img src="../imagenes/botones/barra/grabacion.jpg" alt="Grabacion" width="80" height="80" border = "1" title="Grabacion de Ordenes, Control de Ordenes, Pami, Consultas, etc"></a></div>
         </div></th>
         <td><div align="center" class="Estilo3">
           <div align="center">
		   
		   <a href="javascript:multicarga('../a_sectores/grabacion/menu_pami.php', '../a_sectores/grabacion/control pami/mes_a_confirmar_pru.php')"><img src="../imagenes/botones/barra/grabacion.jpg" alt="Grabacion" width="80" height="80" border = "1" title="Grabacion de Ordenes, Control de Ordenes, Pami, Consultas, etc"></a>
		   
	</div>
         </div></td>
         <td><div align="center" class="Estilo3">
           <div align="center"><a href="../a_sectores/liquidacion/liquidacion.php"></a><a href="../a_sectores/grabacion/cerrar/periodo.php" target = "central"><img src="../imagenes/recepcion.jpg" alt="Recepci&oacute;n" width="80" height="80" border = "1" title="Recepcion de Ordenes, Consultas, re-impresiones de planillas, etc."></a>
     
         </div>
         </div></td>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo3"><span class="Estilo5">GRABAR</span></span></th>
         <th><span class="Estilo3"><span class="Estilo5">CONTROL PAMI </span></span></th>
         <th><span class="Estilo5">CERRAR PERIODO</span></th>
       </tr>
       <tr>
         <th scope="row"><a href="../a_sectores/grabacion/cambiar/cambiar.php" target = "central"><img src="../imagenes/recepcion.jpg" alt="Recepci&oacute;n" width="80" height="80" border = "1" title="Recepcion de Ordenes, Consultas, re-impresiones de planillas, etc."></a></th>
         <th><a href="javascript:multicarga('../a_sectores/grabacion/cambiar/cambiar_menu.php', '../a_sectores/grabacion/cambiar/cambiar.php')"><img src="../imagenes/botones/barra/grabacion.jpg" alt="Grabacion" width="80" height="80" border = "1" title="Grabacion de Ordenes, Control de Ordenes, Pami, Consultas, etc"></a></th>
         <th><span class="Estilo3"><a href="../a_sectores/gerencia/clave.php" target = "izquierda"><img src="../imagenes/botones/barra/gerencia.jpg" alt="Gerencia" width="80" height="80" border = "1" title="Convenios, Consultas de Convenios, Definir Practicas, convertir nomencladores"></a></span></th>
       </tr>
       <tr>
         <th scope="row"><span class="Estilo3"><span class="Estilo5">CONTROL GRABADAS</span></span></th>
         <th><span class="Estilo3"><span class="Estilo5">CAMBIAR ORDENES </span></span></th>
         <th><span class="Estilo5">GERENCIA</span></th>
       </tr>
     </table>   
         <span class="Estilo3"></span><span class="Estilo3"></span>
         <!--<<li><a href="../archivos varios/importar_tablas.php" target = "central">Importar tablas</a> </li>
<li><a href="../a_sectores/consulta_bq/mail.php" target = "central">Consulta a los Programadores</a> </li>-->
</div>

</BODY>
</HTML>
