
 <script type="text/javascript">
function ocultamenu(){
  var menu = document.getElementById("Facturacion");
  menu.style.display = "none";
}
function despliega(){
  var menu = document.getElementById("Facturacion");
    if(menu.style.display == "none"){
      menu.style.display = "block";
    }
    else{
      menu.style.display = "none";
    }
}



</script>

<!-- background="../IMAGENES/IZQUIERDA.PNG" -->
<BODY background="../imagenes/presentacion/fondo4.jpg" onload ="ocultamenu()">

 <div align="center">
    <!-- <li><a href="../a_sectores/secretaria/secretaria.php" target = "izquierda">Secretaria</a> </li> -->
  <IMG SRC="../imagenes/botones/menu/principal.gif" alt="Principal" border = "0">
   <a href="../a_sectores/auditoria/Auditoria.php" target = "izquierda"><img src="../imagenes/botones/menu/auditoria.gif" alt="Auditoria" border = "1" title="Altas de Practicas, metodos, Debitos, etc"></a>
   <a href="../a_sectores/consulta_bq/consultas.php" target = "izquierda"><img src="../imagenes/botones/menu/consulta.png" alt="Consulas." border = "1" title="Consultas Varias"></a>
   <a href="../a_sectores/contaduria/contaduria.php?id=<?print("$usuario");?>" target = "izquierda"><img src="../imagenes/botones/menu/contaduria.gif" alt="Contaduría" border = "1" title="Altas de Novedades del mes, alta de conceptos, etc"></a>
   <a href="../a_sectores/estadistica/estadistica.php" target = "izquierda"><img src="../imagenes/botones/menu/estadisticas.gif" alt="Estadisticas" border = "1" title="Diferentes estadisticas, Ordenes, Recepcion, etc"></a>
   <a href="../a_sectores/facturacion/facturacion.php" target = "izquierda">
      <img src="../imagenes/botones/menu/facturacion.gif" alt="Facturación" border = "1" title="Sistema para facturas Obras Sociales, Pre-Facturacion, Consultas"></a>

  <!-- <a href="../a_sectores/gerencia/gerencia.php" target = "izquierda"><img src="../imagenes/botones/menu/gerencia.gif" alt="Gerencia" border = "1" title="Convenios, Consultas de Convenios, Definir Practicas, convertir nomencladores"></a> -->


   <a href="../a_sectores/grabacion/grabacion.php" target = "izquierda"><img src="../imagenes/botones/menu/grabacion.gif" alt="Grabacion" border = "1" title="Grabacion de Ordenes, Control de Ordenes, Pami, Consultas, etc"></a>
   <a href="../a_sectores/liquidacion/liquidacion.php" target = "izquierda"><img src="../imagenes/botones/menu/liquidacion.gif" alt="Liquidación" border = "1" title="Armar lista de Facturas, Liquidar, Consultar, Imprimir, etc"></a>
   <a href="../a_sectores/proveeduria/proveeduria.php" target = "izquierda"><img src="../imagenes/botones/menu/proveeduria.gif" alt="Proveeduría" border = "1" title=""></a>
   <a href="../a_sectores/recepcion/recepcion.php" target = "izquierda"><img src="../imagenes/botones/menu/recepcion.gif" alt="Recepción" border = "1" title="Recepcion de Ordenes, Consultas, re-impresiones de planillas, etc."></a>
   <A HREF="../a_sectores/secretaria/secretaria.php"><IMG SRC="../imagenes/botones/menu/secretaria.gif" alt="Secretaria" border = "1" title="Alta de Socios, Obras Sociales, Bioquimicos. Consultas, listados para imprimir, etc"></A>   
   <a href="../a_sectores/tesoreria/tesoreria.php" target = "izquierda" ><IMG SRC="../imagenes/botones/menu/tesoreria.gif" alt="Tesorería" border = "1" title="Recepcion de Facturas pagadas, Registrar debito global, consulta de Facturas, Estado de Facturas, etc."></a> 
   <!--<<li><a href="../archivos varios/importar_tablas.php" target = "central">Importar tablas</a> </li>
<li><a href="../a_sectores/consulta_bq/mail.php" target = "central">Consulta a los Programadores</a> </li>-->
  

  
 </div>
