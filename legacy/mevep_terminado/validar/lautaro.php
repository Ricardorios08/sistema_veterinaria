
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


<BODY background="../IMAGENES/IZQUIEDA.PNG" onload ="ocultamenu()">

 <img src="../imagenes/indice.gif" alt="indiceWgif (5908 bytes)" WIDTH="100" HEIGHT="80">
 <li><a href="../LAUTARO/configuracion.php" target = "izquierda">Configuracion</a> </li>


 <li><a href="../a_sectores/grabacion/grabar_rapido/grabacion_ordenes.php" target = "central">Grabar Rapido</a> </li>


<!--<<li><a href="../archivos varios/importar_tablas.php" target = "central">Importar tablas</a> </li>
<li><a href="../a_sectores/consulta_bq/mail.php" target = "central">Consulta a los Programadores</a> </li>-->



