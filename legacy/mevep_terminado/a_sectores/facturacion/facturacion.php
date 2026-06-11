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
include ("../../conexiones/config.inc.php");
 $sql="select ruta from socios where no_imprimir = 'FALSO' order by ruta desc";
$result = $db->Execute($sql);

$ruta=$result->fields["ruta"];


$fecha = date("d/m/Y");

$mes = date("m");

$anio = date ("Y");
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
<table width="166"  border="0">
  <tr bgcolor="#990033"> </tr>
  <tr>
    <td bgcolor="#666666"><div align="center"class="titulo">SOCIOS</div></td>
  </tr>
</table>
<div id="menuv">
		<ul>
			<ul>
			 			  
			<li><a href="../socios/entrada_dato.php" target = "central" onmouseover="window.status='Ingreso Nuevo Paciente';return true" onmouseout="window.status='';return true">Dar Ingreso Nuevo </a></li>


<li><a href="../particulares/entrada_dato.php" target = "central" onmouseover="window.status='Ingreso Nuevo Paciente';return true" onmouseout="window.status='';return true">Dar Ingreso Particular </a></li>



			<li><a href="socios_ruta.php" target = "central" onmouseover="window.status='Ingreso Nuevo Paciente';return true" onmouseout="window.status='';return true">Listado Rutas Control F</a></li>

			<li><a href="socios_ruta1.php" target = "central" onmouseover="window.status='Ingreso Nuevo Paciente';return true" onmouseout="window.status='';return true">Listado Socios (Nuevo)</a></li>


			<li><a href="socios_local.php" target = "central" onmouseover="window.status='Ingreso Nuevo Paciente';return true" onmouseout="window.status='';return true">Listado Local</a></li>
            <li><a href="acomodar_ruta.php" target = "central" onmouseover="window.status='Ingreso Nuevo Paciente';return true" onmouseout="window.status='';return true">Acomodar Ruta</a></li>
			
<!-- 			<li><a href="animales_sin_socios.php" target = "central" onmouseover="window.status='Ingreso Nuevo Paciente';return true" onmouseout="window.status='';return true">Mascotas sin Socios</a></li>
			<li><a href="socios_sin_animales.php" target = "central" onmouseover="window.status='Ingreso Nuevo Paciente';return true" onmouseout="window.status='';return true">Socios sin Mascotas</a></li>
			
			<li><a href="compara_direccion.php" target = "central" onmouseover="window.status='Ingreso Nuevo Paciente';return true" onmouseout="window.status='';return true">Compara Dirección</a></li> -->


		  </ul>
		</ul>
</div>
  
  <form action="socios_pdf_A4.php" method="post"  target ="central">
    <table width="152" border="0" align="left">
      <tr>
        <td colspan="2" align="center" bgcolor="#666666" class="titulo" scope="row">FACTURACION</td>
      </tr>
      <tr>
        <td width="71" valign="middle" class="Estilo12" scope="row"><div align="right"><span class="Estilo13">Desde:</span>          </div>
        </div></td>
        <td width="70" valign="middle" class="Estilo12" scope="row">
          <div align="left">
            <input name="desde" type="text" id="desde3" size="8" / VALUE = "1">
        </div></td>
      </tr>
      <tr>
        <td valign="middle" class="Estilo55" scope="row"><div align="right" class="Estilo15">
          <div align="right">Hasta: </div>
        </div></td>
        <td valign="middle" class="Estilo12" scope="row">
          <div align="left">
            <input name="hasta" type="text" id="desde22" size="8" / class ="ctext">
        </div></td>
      </tr>
      <tr>
        <td valign="middle" class="Estilo55" scope="row"><div align="center" class="Estilo15">
          <div align="right">MES</div>
        </div></td>
        <td valign="middle" class="Estilo12" scope="row"><select name="mes[]" id="mes" onkeypress="return verif_caracter(this,event)" tabindex="4">
          <option value="01">ENERO</option>
          <option value="02">FEBRERO</option>
          <option value="03">MARZO</option>
          <option value="04">ABRIL</option>
          <option value="05">MAYO</option>
          <option value="06">JUNIO</option>
          <option value="07">JULIO</option>
          <option value="08">AGOSTO</option>
          <option value="09">SEPTIEMBRE</option>
          <option value="10">OCTUBRE</option>
          <option value="11">NOVIEMBRE</option>
          <option value="12">DICIEMBRE</option>
        </select></td>
      </tr>
      <tr>
        <td valign="middle" class="Estilo55" scope="row"><div align="right">
          <div align="center" class="Estilo15">
            <div align="right">A&Ntilde;O</div>
          </div>
        </div></td>
        <td valign="middle" class="Estilo12" scope="row"><input name="anio" type="text" id="anio" size="10" value ="<?php echo $anio;?>" /></td>
      </tr>
      <tr>
        <td valign="middle" class="Estilo55" scope="row"><div align="center" class="Estilo15">
          <div align="right">FECHA</div>
        </div></td>
        <td valign="middle" class="Estilo12" scope="row"><input name="fecha_fac" type="text" id="hasta2" size="10" value ="<?php echo $fecha;?>" class ="ctext"></td>
      </tr>
      <tr>
        <td colspan="2" valign="middle" class="Estilo55" scope="row"><div align="center">Observaciones</div></td>
      </tr>
      <tr>
        <td colspan="2" valign="middle" class="Estilo55" scope="row">          <div align="center">
          <textarea name="observaciones" cols="15" rows="3" id="observaciones"></textarea>        
        </div></td>
      </tr>
      <tr>
        <td colspan="2" valign="middle" class="Estilo12" scope="row"><div align="center">
            <input type="submit" name="Submit" value="Imprimir Factura" / class ="bot1">
        </div></td>
      </tr>
 
      <tr>
        <td colspan="2" valign="middle" class="Estilo12" scope="row"><div align="center">Rutas <?php echo $ruta;?></div></td>
      </tr>

    </table>


  </form>
</body>
</html>
