<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../menus.css" rel="stylesheet" type="text/css" />
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
include ("../../conexiones/config.inc.php");
 $sql="select ruta from socios where no_imprimir = 'FALSO' order by ruta desc";
$result = $db->Execute($sql);

$ruta=$result->fields["ruta"];


$fecha = date("d/m/Y");

$mes = date("m");

switch ($mes){

case "01":{$mes = "ENERO";break;}
case "02":{$mes = "FEBRERO";break;}
case "03":{$mes = "MARZO";break;}
case "04":{$mes = "ABRIL";break;}
case "05":{$mes = "MAYO";break;}
case "06":{$mes = "JUNIO";break;}
case "07":{$mes = "JULIO";break;}
case "08":{$mes = "AGOSTO";break;}
case "09":{$mes = "SEPTIEMBRE";break;}
case "10":{$mes = "OCTUBRE";break;}
case "11":{$mes = "NOVIEMBRE";break;}
case "12":{$mes = "DICIEMBRE";break;}

}

?>
<table width="152"  border="0">
  <tr bgcolor="#990033"> </tr>
  <tr>
    <td bgcolor="#666666"><div align="center" class="Estilo3">PROCESOS</div></td>
  </tr>
</table>
<div id="menuv">
		<ul>
			<ul>
			<li><a href="proveedores/entrada_dato.php" target = "central" > PROVEEDORES</a></li>
			<li><a href="mercaderia/entrada_mercaderia.php" target = "central" > MERCADERIA</a></li>
			<li><a href="debito/entrada_debito.php" target = "central"> DEBITO AUTOMATICO </a></li>
			<li><a href="debito/generar_archivo.php" target = "central"> GENERAR ARCHIVO</a></li>			
			<li><a href="mercaderia/precio_costos.php" target = "central"> GANAN. Y COSTOS</a></li>
			<li><a href="tasas/entrada_dato.php" target = "central"> TASAS </a></li>
<li><a href="inventario/inventario.php" target = "izquierda"> INVENTARIO </a></li>
			<li><a href="anular/clave.php" target = "izquierda"> BORRAR FACTURA</a></li>
		  </ul>
		</ul>
</div>
  
  <form action="separar_busqueda.php" method="post"  target ="central">
    <table width="152" border="0" align="left">
      <tr>
        <td width="141" colspan="2" align="center" bgcolor="#666666" class="Estilo54 Estilo7 Estilo6 Estilo13" scope="row">CONSULTAS</td>
      </tr>
      
      <tr>
        <td colspan="2" valign="middle" class="Estilo55" scope="row"><select name="opciones[]" id="busqueda">
          <optgroup label="Modificar">
          <option value="mod_deb"><span class="Estilo12">Debitos</span></option>
           <!--  <option value="mod_cli"><span class="Estilo12">Clientes</span></option> -->
          <!--  <option value="clientes">Clientes</option> -->
          <!--    </optgroup> -->
          <!--   <optgroup label="Proveedores"> -->
          <option value ="mod_pro"><span class="Estilo12">Proveedores</span></option>
          <!-- <option value ="proveedores">Proveedor</option> -->
          <!-- </optgroup>
		 -->
          <!-- 		    <optgroup label="Mercaderia"> -->
          <!-- <option value ="mod_mer"><span class="Estilo12">Mercaderia</span></option>-->
          <!-- 	<option value ="mercaderia">Mercaderia</option> -->
          </optgroup>
        </select>
          <span class="Estilo12"><br />
          <input type = "text" name = "busca" size = "10" />
          <input type = "submit" name = "ok" value = "OK" />
          <input type="hidden" name="buscador_rapido" value="2" />
          </span></td>
      </tr>
    </table>


  </form>
</body>
</html>
