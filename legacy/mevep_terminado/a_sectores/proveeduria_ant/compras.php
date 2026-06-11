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
.Estilo6 {
	color: #FFFFFF;
	font-size: 12px;
}
.Estilo13 {font-family: "Trebuchet MS"}
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
    <td bgcolor="#666666"><div align="center" class="Estilo3">COMPRAS</div></td>
  </tr>
</table>
<div id="menuv">
		<ul>
			<ul>
			<li><a href="compras/pagina1.php" target = "central"> INGRESO</a></li>
		  </ul>
		</ul>
</div>
  
<FORM ACTION="buscar/compras.php" method="post" TARGET = "central">
    <table width="152" border="0" align="left">
      <tr>
        <td width="141" colspan="2" align="center" bgcolor="#666666" class="Estilo54 Estilo7 Estilo6 Estilo13" scope="row">BUSCAR FACTURAS </td>
      </tr>
      
      <tr>
        <td align="center" scope="row"><div align="right" class="Estilo13"><span class="Estilo5"><font size="2">A&ntilde;o<font size="2">
          <input name = "anio" type = "text" id="anio" value="<?php echo $anio;?>" size = "9" />
        </font></font></span></div></td>
      </tr>
      <tr>
        <td align="center" scope="row"><div align="right" class="Estilo13"> <span class="Estilo5"><font size="2">Periodo </font></span>
                <select name="mes[]" id="select3" onkeypress="return verif_caracter(this,event)">
                  <option value = "<?php $mes;?>"><?php echo $periodo;?></option>
                  <option value = "13">TODOS</option>
                  <option value = "01">ENE</option>
                  <option value = "02">FEB</option>
                  <option value = "03">MAR</option>
                  <option value = "04">ABR</option>
                  <option value = "05">MAY</option>
                  <option value = "06">JUN</option>
                  <option value = "07">JUL</option>
                  <option value = "08">AGO</option>
                  <option value = "09">SET</option>
                  <option value = "10">OCT</option>
                  <option value = "11">NOV</option>
                  <option value = "12">DIC</option>
                </select>
        </div></td>
      </tr>
      <tr>
        <td align="center" scope="row"><div align="right" class="Estilo13"><span class="Estilo5"><font size="2">Tipo
                <select name="tipo[]" id="select2" onkeypress="return verif_caracter(this,event)">
                  <option value="TODOS">TODOS</option>
                  <option value="FACTURAS">FACTURAS</option>
                  <option value="ANULADA">ANULADA</option>
                  <option value="CREDITO">CREDITO</option>
                  <option value="DEBITO">DEBITO</option>
                </select>
        </font></span></div></td>
      </tr>
      <tr>
        <td align="center" scope="row"><div align="right" class="Estilo13"><span class="Estilo5"><font size="2">N&ordm;
          <input type = "text" name = "nro_factura" size = "9" />
        </font></span></div></td>
      </tr>
      <tr>
        <td align="center" scope="row"><div align="right" class="Estilo13"><span class="Estilo5"><font size="2">Cli/Pro
          <input name = "cliente_proveedor" type = "text" id="cliente_proveedor3" size = "9" />
        </font></span></div></td>
      </tr>
      <tr>
        <td align="center" scope="row"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">
          <input type = "submit" name = "ok" value = "BUSCAR" />
        </font></font></td>
      </tr>
    </table>


  </form>
</body>
</html>
