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
<script LANGUAGE="JavaScript">
function multicarga(documento1,documento2)
{
parent.izquierda.location.href=documento1;
parent.central.location.href=documento2;
}
</script>
<style type="text/css">
<!--
.Estilo4 {font-size: 12px}
.Estilo8 {color: #FFFFFF}
.Estilo11 {font-family: Arial, Helvetica, sans-serif}
.Estilo18 {font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
.Estilo19 {font-size: 12px}
.Estilo20 {
	font-size: 16px;
	font-weight: bold;
	color: #0000FF;
}
.Estilo21 {
	color: #FF0000;
	font-weight: bold;
	font-style: italic;
}
-->
</style>
<? $anio = date("y");?>
<BODY class="Estilo4" onload ="ocultamenu()">


<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">
<table width="714" border="0"> 
        <tr bgcolor="#000099">
          <td colspan="2"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>PROVEEDURIA</strong></font></div></td>
        </tr>
        <tr bgcolor="#000099">
          <td colspan="2"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>IVA VENTAS ERRORES</strong></font></div></td>
    </tr>
        <tr>
          <td width="345"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif">A&ntilde;o: </font></div></td>
          <td width="359"><font size="2" face="Arial, Helvetica, sans-serif">
          20 <input name = "anio" type = "text" value="<?echo $anio;?>" size = "2" maxlength ="2">
          </font></td>
        </tr>
        <tr>
          <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Mes:
          </font></div></td>
          <td><font size="2" face="Arial, Helvetica, sans-serif">
            <select name="mes[]" id="select3" onkeypress="return verif_caracter(this,event)">
              <option value = "01" >ENE</option>
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
          </font></td>
        </tr>
        <tr>
          <td>
            <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2">SUMAR</font>
          </font></div></td>
          <td><font size="2" face="Arial, Helvetica, sans-serif">
            <select name="buscar_por[]" id="select2" onkeypress="return verif_caracter(this,event)">
              <option value ="iva" selected>IVA</option>
              <option value ="neto_gravado">Neto Gravado</option>
              <option value ="bruto">Bruto</option>
              <option value ="descuento">Descuento</option>
              <option value ="neto">Neto</option>
          </select>
          </font></td>
        </tr>
			<tr><td>
              <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2">TIPO</font>              </font></div></td>
			  <td><font size="2" face="Arial, Helvetica, sans-serif">
			    <select name="cod_operaciom[]" id="select6" onkeypress="return verif_caracter(this,event)">
                  <option value ="1" selected>FACTURAS</option>
                  <option value ="3">NOTA DE CREDITO</option>
                </select>
			  </font></td>
			</tr>
			<tr>
			  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2">TIPO</font></font> IVA </div></td>
			  <td><font size="2" face="Arial, Helvetica, sans-serif">
			    <select name="tipo[]" id="tipo[]" onkeypress="return verif_caracter(this,event)">
                  <option value ="1" selected>RI</option>
                  <option value ="3">MONOTRIBUTISTA</option>
                   <option value ="4">EXENTO</option>
                                </select>
			  </font></td>
    </tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><font size="2" face="Arial, Helvetica, sans-serif">
			    <input type = "submit" name = "Alta" value = "CONSULTAR">
			  </font></td>
    </tr>
</table>
</form>

	<?

		if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{
		case "CONSULTAR":
				{

$nro_os=$_REQUEST ['nro_os'];
$buscar_po=$_REQUEST ['buscar_por'];
$nro_factura=$_REQUEST ['nro_factura'];
$anio=$_REQUEST ['anio'];
 $cliente_proveedor=$_REQUEST ['cliente_proveedor'];

$hoja=$_REQUEST ['hoja'];
 $registro=$_REQUEST ['registro'];


$cod_operacio=$_POST["cod_operaciom"];
for ($i=0;$i<count($cod_operacio);$i++)    
	{     
	$cod_operacion = $cod_operacio[$i];    
	}


$buscar_po=$_POST["buscar_por"];
for ($i=0;$i<count($buscar_po);$i++)    
	{     
	$buscar_por = $buscar_po[$i];    
	}

	$me=$_POST["mes"];
	for ($i=0;$i<count($me);$i++)    
	{     
	$mes= $me[$i];    
	}

	$tip=$_POST["tipo"];
	for ($i=0;$i<count($tip);$i++)    
	{     
	$tipo= $tip[$i];    
	}



$fecha_desde = "20".$anio."-".$mes."-01"; 
$fecha_hasta ="20".$anio."-".$mes."-31";
$ordenar;

include ("../../../conexiones/config_grabacion.php");


 $sql="select sum($buscar_por) as TOTAL from ventas_encabezado where fecha BETWEEN '$fecha_desde' and '$fecha_hasta' and cod_operacion = $cod_operacion and tipo_iva = $tipo;";
$result = $db_pro->Execute($sql);

$TOTAL=strtoupper($result->fields["TOTAL"]);

?>
<table width="715" border="0">
  <tr bgcolor="#000099">
    <th height="42" colspan="2" scope="col"><span class="Estilo6 Estilo8">LIBRO IVA PROVEEDURIA - TOTALES </span></th>
  </tr>
  <tr>
    <th colspan="2" scope="col"><span class="Estilo18">Facturas Desde <?echo $fecha_desde;?> Hasta <?echo $fecha_hasta;?></span></th>
  </tr>
  <tr>
    <td colspan="2"><div align="left"></div>      <div align="center" class="Estilo11 Estilo19">
      <div align="left"><span class="Estilo18"><span class="Estilo21"><?echo $sql;?></span></span></div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center" class="Estilo18">
      <HR noshade>
    </div></td>
  </tr>
  <tr>
    <td><div align="center" class="Estilo18">
      <div align="right">TIPO DE COLUMNA A SUMAR: <?echo strtoupper($buscar_por);?></div>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><span class="Estilo18">COD OPERACION: <?echo $cod_operacion;?></span></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><span class="Estilo18">TIPO DE IVA: <?echo $cod_operacion;?></span></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="Estilo19"></span></td>
    <td><HR noshade></td>
  </tr>
  <tr>
    <td width="396"><div align="right" class="Estilo18">TOTAL SUMA </div></td>
    <td width="309"><div align="center" class="Estilo1 Estilo11 Estilo20">$ <?echo $TOTAL;?></div></td>
  </tr>
</table>

<?
break;
				}

	}

		}
?>