<script type="text/javascript">
function ocultamenu(){
  var menu = document.getElementById("Atributos");
  menu.style.display = "none";
}
function despliega(){
  var menu = document.getElementById("Atributos");
    if(menu.style.display == "none"){
      menu.style.display = "block";
    }
    else{
      menu.style.display = "none";
    }
}
</script>


<BODY background="../IMAGENES/IZQUIERDA.PNG" onload ="ocultamenu()">
<form action="buscar_grabadas.php" method="post"  target ="central">

    <table width="138" border="0">
      <tr bgcolor="#990033">
        <td width="132" height="29" bgcolor="#006699"><div align="center"><font color="#FFFFFF"><strong>Configurac&oacute;n</strong></font> </div></td>
      </tr>
      <tr>
        <td><div align="right"><font color="#FF0000">PAMI</font></div></td>
      </tr>
      <tr>
        <td><div align="right"><a href="../a_sectores/grabacion/control pami/importar/importar_tablas.php" target = "central" >Ingresar BIOSOFT </a></div></td>
      </tr>
      <tr>
        <td><div align="right"><a href="../a_sectores/grabacion/control pami/importar/importar_cobol.php" target = "central" >Importar de Cobol </a></div></td>
      </tr>
      <tr>
        <td><div align="right"><a href="../a_sectores/grabacion/control pami/importar/borrar_periodo.php" target = "central" >Borrar Periodo</a></div></td>
  </tr>
  <tr>
        <td><div align="right"><a href="atrasadas.php" target = "central" >Confir atrasadas</a></div></td>
  </tr>
 <tr>
		<td><div align="center"><a href="separar_ordenes.php" target = "central" >Separar Ordenes</a></div></td>
	  </tr> 
	   <tr>
		<!-- <td><div align="center"><a href="calculadora.php" target = "central" >Calculadora</a></div></td>
	  </tr> -->

	  <!-- <tr>
        <td><p align="center"><a href="depurar_pami.php" target = "central">Depurar </a> </p></td>
      </tr> -->

	      <tr>
          <td><p align="right"><a href="../LAUTARO/cobol_exp.php" target = "central">Exportar Ordenes </a> </p></td>
      </tr>


	   <!--  <td><div align="center"><a href="facturacion/pami.php" target = "central" >fact pami</a></div></td>
      </tr> -->
	  <tr>
        <td><p align="right"><a href="popup.php" target = "central">popup </a></p></td>
      </tr>
	  <tr>
        <td><p align="right"><a href="../a_sectores/facturacion/depurar.php" target = "central">Borrar 998,677,999 </a></p></td>
      </tr>
	  <tr>
	    <td><div align="center"><a href="../validar/usuarios/entrada_trabajo.php"  target = "central">Trabajo </a></div></td>
      </tr>
	  <tr>
	    <td><div align="left"><font color="#FF0000">VARIOS</font></div></td>
      </tr>

	  <tr>
	    <td><a href="../validar/usuarios/entrada_empleado.php" target = "central" >Usuarios</a></td>
      </tr>
	   <tr>
	    <td><a href="../a_sectores/grabacion/grabar_con_nueva_base/grabacion_ordenes.php" target = "central" >GRABAR</a></td>
      </tr>
	  <tr>
	    <td><a href="../a_sectores/facturacion_con_nueva_base/facturacion.php" target = "izquierda" >Facturar</a></td>
      </tr>
	  <tr>
        <td><p align="left"><a href="../LAUTARO/cambia_mes.php" target = "central">Cambiar Mes </a> </p></td>
      </tr>
	  <tr>
	    <td><div align="left"><a href="../chat/login.php" target = "central" >Chat</a></div></td>
      </tr>

	    <tr>
        <td><a href="../a_sectores/gerencia/borrar_nomenclador.php" target = "central">Borrar Nomenc. </a> </td>
      </tr>
	 <td><a href="../a_sectores/grabacion_ordenes/grabar.php" target = "central">Grabar</a> </li>
<tr><td><a href="../LAUTARO/PRUEBA.php" target = "central">Texto</a></td> 
<tr><td><a href="../LAUTARO/PRUEBA1.php" target = "central">Popup</a></td> 
      
      <tr>
        <td><div align="center"><a href="../a_sectores/consulta_bq/laboratorios/pasar compo.php" target = "central">Generar Resumen</a> bq </div></td>
      <tr>
        <td><a href="../a_sectores/consulta_bq/laboratorios/pasar compo_os.php" target = "central">Generar Resumen</a> os </td>
      <tr bgcolor="#993300">
        <td bgcolor="#006699"><div align="center"><font color="#FFFFFF"><strong>IR A....</strong></font> </div></td>
      </tr>
      <tr>
        <td><ul>
          <li><a href="../validar/lautaro.php" target ="izquierda"><font color="#0000FF">Principal</font></a></li>
          <li> <font color="#0000FF"><a href="../index.html" target ="_top".>Salir</a></font></li>
        </ul></td>
      </tr>
    </table>
</FORM>	

</body>

