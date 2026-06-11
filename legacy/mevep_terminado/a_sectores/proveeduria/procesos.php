<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../menus.css" rel="stylesheet" type="text/css" />
<link href="../../css/botonera.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo3 {
	font-family: "Trebuchet MS";
	color: #FFFFFF;
}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo6 {
	color: #FFFFFF;
	font-size: 12px;
}
.Estilo13 {font-family: "Trebuchet MS"}
.Estilo15 {font-family: "Trebuchet MS"; font-size: 12px; }
.Estilo16 {color: #FFFFFF}
-->
</style>
</head>

<body>

<?php 

?>
<table width="166"  border="0">
  <tr bgcolor="#990033"> </tr>
  <tr>
    <td bgcolor="#666666"><div align="center" class="titulo">PROCESOS</div></td>
  </tr>
</table>
<div id="menuv">
		<ul>
			<ul>
			<li><a href="usuarios/entrada_dato.php" target = "central" > 1. USUARIOS</a></li>
			<li><a href="proveedores/entrada_dato.php" target = "central" > 2. PROVEEDORES</a></li>
			
			<li><a href="mercaderia/entrada_mercaderia.php" target = "central" > 3. MERCADERIA</a></li>
			<li><a href="mercaderia/entrada_mercaderia.php" target = "central" > 4. CLIENTES</a></li>
 			<li><a href="listados.php" target = "izquierda" >5. LISTADOS</a></li>
			<li><a href="tasas/entrada_dato.php" target = "central">6. TASAS </a></li>
			<li><a href="consultas/diario_vta/consultas.php?cheque=1" target = "central" >7. DIARIO DE VENTAS </a></li>
			<li><a href="consultas/stock/tabla.php" target = "central" >8. TABLA AJUSTES</a></li>
			<li><a href="consultas/precios/cambiar_precios.php" target = "central" >9. CAMBIAR PRECIOS</a></li>
  <li><a href="inventario/inventario.php" target = "izquierda">10. INVENTARIO </a></li>

			<!--<li><a href="anular/clave.php" target = "izquierda"> BORRAR FACTURA</a></li> -->
		  </ul>
		</ul>
</div>
  
  <form action="separar_busqueda.php" method="post"  target ="central">
    <table width="166" border="0" align="left">
      <tr>
        <td width="141" colspan="2" align="center" bgcolor="#666666" class="titulo" scope="row">CONSULTAS</td>
      </tr>
      
      <tr>
        <td colspan="2" valign="middle" class="Estilo55" scope="row"><select name="opciones[]" id="busqueda">
          <optgroup label="Modificar">
		 <option value ="usuarios"><span class="Estilo12">Usuarios</span></option>
		 <option value ="mercaderia"><span class="Estilo12">Mercaderia</span></option>
          <option value ="mod_pro"><span class="Estilo12">Proveedores</span></option>
		         <option value ="mod_cli"><span class="Estilo12">Clientes</span></option>
		  <!-- <option value ="marcas"><span class="Estilo12">Marcas</span></option>
		  <option value ="categoria"><span class="Estilo12">Categoria</span></option>
		  <option value ="tasas"><span class="Estilo12">Tasas</span></option> -->
    
          </optgroup>
        </select>
          <span class="Estilo12"><br />
          <input type = "text" name = "palabra1" size = "10"class="ctxt" />
          <input type = "submit" name = "ok" value = "OK" class="bot1" />
          <input type="hidden" name="buscador_rapido" value="2" />
          </span></td>
      </tr>
    </table>


  </form>
</body>
</html>
