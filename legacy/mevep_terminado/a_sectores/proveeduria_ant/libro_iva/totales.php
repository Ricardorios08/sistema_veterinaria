<? switch ($mes)
	{
		case "1":{$periodo= "ENERO";}break;
		case "2":{$periodo= "FEBRERO";}break;
		case "3":{$periodo= "MARZO";}break;
		case "4":{$periodo= "ABRIL";}break;
		case "5":{$periodo= "MAYO";}break;
		case "6":{$periodo= "JUNIO";}break;
		case "7":{$periodo= "JULIO";}break;
		case "8":{$periodo= "AGOSTO";}break;
		case "9":{$periodo= "SETIEMBRE";}break;
		case "10":{$periodo="OCTUBRE";}break;
		case "11":{$periodo="NOVIEMBRE";}break;
		case "12":{$periodo="DICIEMBRE";}break;
				}


$hoy = date("d/m/y");

?>

<style type="text/css">
<!--
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo5 {font-size: 12px}
-->
</style>



<?

$nro_factura;
$hoy = date("d/m/y");



?>
<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo17 {font-size: 12px}
.Estilo17 {font-family: Arial, Helvetica, sans-serif}
.Estilo69 {color: #FFFFFF}
.Estilo70 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; }
-->
</style>

<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">

<table width="102%" height="168" border="0">
  <!--DWLayoutTable-->
<tr valign="middle" bgcolor="#E6E6E6">
    <td height="26" colspan="7"><div align="center" class="Estilo2">
      <div align="center"><span class="Estilo5"><span class="Estilo8">Sub Diario de Ventas del Mes: <?ECHO $mes;?></span> </span></div>
    </div></td>
  </tr>
   <tr bgcolor="#C9FADF">
     <td width="10%" height="21"><div align="center">
     </div>
     <!-- <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Proveedor</span></div></td> -->
<td width="12%" colspan="3" ><div align="center" class="Estilo5"><span class="Estilo2">Ventas Diferidas</span></span></div></td>
     <td width="12%" colspan="3" ><div align="center" class="Estilo2 Estilo5"><span class="Estilo2 Estilo5">Ventas Contado 
        </div>
     </div></td>
  </tr>
     <tr bgcolor="#000099">
      <td height="21"><div align="center" class="Estilo69"><span class="Estilo17">Fecha</span></div></td>
      <td><div align="right" class="Estilo70">FACTURAS</div></td>
      <td><div align="right" class="Estilo70">N/CREDITOS</div></td>
      <td><div align="right" class="Estilo70">TOTAL</div></td>
      <td><div align="right" class="Estilo70">FACTURAS</div></td>
      <td><div align="right" class="Estilo70">N/CREDITOS</div></td>
      <td><div align="right" class="Estilo70">TOTAL</div></td>
  </tr>
  <tr>
    <?

include ("../../../conexiones/config_grabacion.php");

if ($anio == ""){
	$anio = '08';
}


$fecha_desde = $anio."-".$mes."-01"; 
$fecha_hasta =$anio."-".$mes."-31";

$sql="select * from ventas_encabezado where fecha BETWEEN '$fecha_desde' and '$fecha_hasta' GROUP by fecha order by fecha";

$result = $db_pro->Execute($sql);

  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


$fecha=strtoupper($result->fields["fecha"]);

$dia = substr($fecha, 8,2);
$mes = substr($fecha, 5,2);
$anio = substr($fecha, 0,4);

$fecha1 = $dia."-".$mes."-".$anio;

 $sql1="select sum(neto) as contado from ventas_encabezado where fecha = '$fecha'  and forma_pago = 'CONTADO' and cod_operacion = 1 ORDER by $ordenar";
$result1 = $db_pro->Execute($sql1);

 $contado1=strtoupper($result1->fields["contado"]);

 $sql1="select sum(neto) as contado_nc  from ventas_encabezado where fecha = '$fecha' and forma_pago = 'CONTADO' and cod_operacion = 3 ORDER by $ordenar";
$result1 = $db_pro->Execute($sql1);

 $contado_nc=strtoupper($result1->fields["contado_nc"]);


$sql1="select sum(neto) as ctacte from ventas_encabezado where fecha = '$fecha' and forma_pago = 'CTA/CTE' and cod_operacion = 1 ORDER by $ordenar";
$result1 = $db_pro->Execute($sql1);

 $ctacte=strtoupper($result1->fields["ctacte"]);

 $sql1="select sum(neto) as ctacte_nc from ventas_encabezado where fecha = '$fecha' and forma_pago = 'CTA/CTE' and cod_operacion = 3 ORDER by $ordenar";
$result1 = $db_pro->Execute($sql1);

 $ctacte_nc=strtoupper($result1->fields["ctacte_nc"]);


$cta_cte_total = $ctacte - $ctacte_nc;


$contado_total = $contado1 - $contado_nc;


$suma_cta_cte = $suma_cta_cte + $cta_cte_total;
$suma_contado = $suma_contado + $contado_total;

$suma_contado1 = $suma_contado1 + $contado1;
$suma_ctacte = $suma_ctacte + $ctacte;
$suma_contado_nc = $suma_contado_nc + $contado_nc;
$suma_ctacte_nc = $suma_ctacte_nc + $ctacte_nc;

if ($contado_nc == "0.00"){
	$contado_nc = "";
}


?>
  
  <td height="21"><div align="center" "><?print("$fecha1");?></div></td>
<td><div align="center">
  <div align="right"><?echo $ctacte;?>
  </div>
</div></td>
<td><div align="right">-<?echo $ctacte_nc;?>
  </div>
  <div align="right"></div></td>
<td bgcolor="#E6E6E6">  <div align="right"><?echo $cta_cte_total;?>
  </div>
  <div align="right"></div></td>
<td><div align="center" >
  <div align="right"><?echo $contado1;?></div>
</div></td>
<td><div align="right">-<?echo $contado_nc;?></div></td>
<td bgcolor="#E6E6E6"><div align="right"><?echo $contado_total;?></div></td>
</tr>





<?

$cuenta = "";
	

	$result->MoveNext();
	}


	?>

	<tr>
	  <td height="21" colspan="7"><hr noshade></td>
  </tr>
	<tr>
  <td height="21"><div align="right" class="Estilo74"><strong>TOTAL</strong></div></td>
  <td><div align="center" class="Estilo74 Estilo72">
    <div align="right"><strong><span class="Estilo72">$ <?echo number_format($suma_ctacte,2);?></span></strong></div>
  </div></td>
  <td><div align="right"><strong><span class="Estilo72">$ -<?echo  number_format($suma_ctacte_nc,2);?></span></strong></div></td>
  <td bgcolor="#E6E6E6"><div align="right"><strong><span class="Estilo72">$ <?echo  number_format($suma_cta_cte,2);?></span></strong></div></td>
  <td><div align="center" class="Estilo74 Estilo72">
    <div align="right"><strong><span class="Estilo72">$ <?echo number_format( $suma_contado1,2);?></span></strong></div>
  </div></td>
  <td><div align="right"><strong><span class="Estilo72">$ -<?echo  number_format($suma_contado_nc,2);?></span></strong></div></td>
  <td bgcolor="#E6E6E6"><div align="right"><strong><span class="Estilo72">$ <?echo number_format($suma_contado,2);?></span></strong></div></td>
  </tr>
</table>
