<? 
$mes = date("m");
  ?>
<style type="text/css">
<!--
.Estilo1 {
	color: #000000;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12;
}
.Estilo2 {color: #000000}
.Estilo4 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo37 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo38 {font-size: 10px}
.Estilo39 {color: #FFFFFF}
.Estilo41 {
	font-size: 12;
	color: #000000;
}
.Estilo42 {
	font-size: 12px;
	color: #0000FF;
	font-weight: bold;
}
.Estilo43 {
	color: #FF0000;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo44 {color: #0000FF}
.Estilo45 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
  <table width="555" border="0">
  <!--DWLayoutTable-->
  <tr bgcolor="#000099">
    <td height="21" colspan="4" scope="col"><div align="center" class="Estilo45">FACTURAS DE PROVEEDURIA A DESCONTAR POR LIQUIDACION </div></td>
    </tr>
  <tr bgcolor="#000099">
    <td width="322" height="21" scope="col"><div align="center" class="Estilo37 Estilo39"></div>      <div align="center" class="Estilo4">Laboratorio</div></td>
    <td width="76" scope="col"><div align="center" class="Estilo4">Fecha</div></td>
	<td width="63" scope="col"><div align="center" class="Estilo4">Compr.</div></td>
	<td width="76" scope="col"><div align="center" class="Estilo4">Importe</div></td>
    </tr>
  <?

  include ("../../conexiones/config_grabacion.php");

$sql = "SELECT * FROM `novedades_proveeduria` where  transaccion like 'TR%' and cod_ajuste = 6 order by nro_laboratorio desc";
$result = $db_cont->Execute($sql);

   if (!$result) die("fallo".$db_cont->ErrorMsg());

  while (!$result->EOF) {
	
	$nro_lab = $nro_laboratorio;
	$cod_ajuste=$result->fields["cod_ajuste"];
$transaccion=$result->fields["transaccion"];

	$sql3="select * from ajustes where cod_ajuste = '$cod_ajuste' and tipo_ajuste like '$transaccion'";
	$result3 = $db_cont->Execute($sql3);

	$ajuste=strtoupper($result3->fields["ajuste"]);


	$cod_novedad=$result->fields["cod_novedad"];
	$nro_laboratorio= strtoupper($result->fields["nro_laboratorio"]);
	$comprobante= strtoupper($result->fields["comprobante"]);
	$fecha= strtoupper($result->fields["fecha"]);

$cant = $cant + 1;
$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio = substr($fecha,0,4);
$fecha = $dia."-".$mes."-".$anio;

$sql2="select * from datos_laboratorio where nro_laboratorio = '$nro_laboratorio'";
$result2 = $db_bq->Execute($sql2);
$nombre_laboratorio=strtoupper($result2->fields["nombre_laboratorio"]);
$nombre_laboratorio = substr($nombre_laboratorio,0,20);
	$importe1= strtoupper($result->fields["importe"]);
	
?>

<?if ($nro_lab != $nro_laboratorio){
$sql3 = "SELECT sum(importe) as total FROM `novedades_proveeduria` where  nro_laboratorio = $nro_laboratorio and cod_ajuste = 6 ";
$result3 = $db_cont->Execute($sql3);
$total= strtoupper($result3->fields["total"]);
$total_novedades = $total_novedades + $total;

	?>
  <tr>
    <td colspan="4" scope="row"><hr noshade></td>
  </tr>
  <tr>
    <td height="21" valign="top" scope="row"><span class="Estilo10 Estilo2 Estilo26 Estilo5 Estilo42"><span class="Estilo10 Estilo26 Estilo5  Estilo44"><?echo $nombre_laboratorio." (".$nro_laboratorio.")";?></span></span></td>
    <td height="21" colspan="3" valign="top" scope="row"><div align="right"><span class="Estilo42"><span class="Estilo11 Estilo24 Estilo43"><span class="Estilo44">($ <?echo $total;?>)</span></span></span></div></td>
    </tr>

<?
}?>

  <tr>
    <td scope="row"><div align="left" class="Estilo10 Estilo2 Estilo26 Estilo5 Estilo38"></div></td>
    <td><div align="center" class="Estilo25 Estilo5 Estilo38"><span class="Estilo11"><?echo $fecha;?></span></div></td>
    <td><div align="center" class="Estilo25 Estilo5 Estilo38"><span class="Estilo11"><?echo $comprobante;?></span></div></td>
    <td><div align="right" class="Estilo11 Estilo24 Estilo2 Estilo5 Estilo38">$ <?echo $importe1;?></div></td>
   </tr>
  <?



$total = $total + $importe;
$result->MoveNext();
	}
?>


  <tr>
    <th colspan="4" scope="row"><hr noshade></th>
    </tr>
  <tr>
    <th scope="row"><div align="right" class="Estilo4 Estilo10 Estilo2 Estilo41">TOTAL NOVEDADES </div></th>
    <td colspan="2"><div align="right" class="Estilo1">$ <?echo number_format($total_novedades,2);?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row"><div align="right"><span class="Estilo4 Estilo10 Estilo2 Estilo41">CANTIDAD DE FACTURAS </span></div></th>
    <td colspan="2"><div align="right"><span class="Estilo1"><?echo $cant;?></span></div></td>
    <td>&nbsp;</td>
  </tr>
</table>


