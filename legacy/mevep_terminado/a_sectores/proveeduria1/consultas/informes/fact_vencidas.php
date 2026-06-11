<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo4 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo5 {font-size: 12px}
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo7 {
	font-size: 14px;
	font-weight: bold;
	color: #0000FF;
}
.Estilo8 {font-size: 14px}
.Estilo10 {
	font-size: 14px;
	color: #FF0000;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
 

<!-- 
<a href="imp_pendientes.php?a='excel'&&buscar_por=<?print("$buscar_por");?>"><IMG SRC="../../imagenes/botones//btn_exportar.gif" alt="Exportar" border = "0"></a> -->





<?

$nro_factura;
$hoy = date("d/m/y");



?>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo4 {font-size: 9px}
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 9px; font-family: Arial, Helvetica, sans-serif; }
.Estilo8 {
	font-family: Arial, Helvetica, sans-serif;
	color: #0000CC;
	font-weight: bold;
}
-->
</style>



<table width="103%" height="86" border="0">
  <!--DWLayoutTable-->
<tr bgcolor="#000099">
    <td height="21" colspan="8" valign="top"><div align="center"><span class="Estilo5"><span class="Estilo1">Listado de FACTURAS VENCIDAS : <?ECHO $hoy;?></span> </span></div></td>
  </tr>
   <tr bgcolor="#DAFAFC">
     <td width="4%" height="21"><div align="center"><span class="Estilo6 Estilo2  Estilo5"><span class="Estilo6">Tipo</span>     
     <td width="9%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">N&ordf; Factura</span></div></td>
     <td width="8%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Fecha</span></div></td>
     <!-- <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Proveedor</span></div></td> -->
<td width="11%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Bruto</span></div></td>
<td width="14%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Descuento</span></div></td>

     <td width="10%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">IVA</span></div></td>
	      <td width="11%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Retencion</span></div></td>
          <td width="14%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">TOTAL</span></div></td>
   </tr>

	 <?

include ("../../../../conexiones/config_pro.php");

$HOY = 22102008;




$dia = date("d");
$mes = date("m")+1;
$anio = date("Y");

$fecha_vto = $anio."-".$mes."-".$dia;
 
$sql="select * from ventas_encabezado  where fecha > '$fecha_vto' ORDER by nro_factura, fecha desc, periodo, anio";

	
	 
$result = $db->Execute($sql);

  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cuent = $cuenta;

$nro_cliente=strtoupper($result->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result->fields["nro_cuenta"]);

if ($nro_cliente != 0){
$cuenta=$nro_cliente;
}elseif ($nro_cliente != 0){
$cuenta=$nro_cuenta;
}

$nro_factura=strtoupper($result->fields["nro_factura"]);

$denominacion=strtoupper($result->fields["denominacion"]);
$fecha=strtoupper($result->fields["fecha"]);
$descuento=strtoupper($result->fields["descuento"]);
$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$bonificacion=strtoupper($result->fields["bonificacion"]);
$subtotal=strtoupper($result->fields["subtotal"]);
$iva=strtoupper($result->fields["iva"]);
$total=strtoupper($result->fields["total"]);
$periodo=strtoupper($result->fields["periodo"]);
$anio=strtoupper($result->fields["anio"]);


//$cuenta = "(".$cuenta.") ".$denominacion;
 if ($cuent != $cuenta){?>
   <tr>
     <td height="42" colspan="8" valign="top"><span class="Estilo10"><?print("$cuenta");?> - <?print("$denominacion");?></span>       <hr>     </td>
   </tr>
<?}?>
<tr>
<td><div align="center" class="Estilo4 Estilo5"><span class="Estilo6"><?print("$tipo_fact");?></span></strong></div></td>
<td><div align="center" class="Estilo4 Estilo7"><span class="Estilo2"><?print("$nro_factura");?></span></strong></div></td>
<td><div align="left" class="Estilo6"> <div align="center"><strong><?print("$fecha");?></strong></div></td>
    <!-- <td><div align="center" class="Estilo6"><span class="Estilo4 Estilo5"><?print("$proveedor");?></span></div></td> -->
<td><div align="center" class="Estilo6">     <?echo "$ ".number_format($bruto,2);?></div>     </td>
<td><div align="center" class="Estilo6">     <?echo "$ ".number_format($descuento,2);?></div> </td>
<td><div align="center" class="Estilo6">     <?echo "$ ".number_format($iva,2);?></div>     </td>
<td><div align="center" class="Estilo8 Estilo6"> <div align="center"><strong><?echo "$ ".number_format($retencion,2);?></strong></div>
   	</div></td>
<td><div align="center" class="Estilo6"><strong><?echo "$ ".number_format($total,2);?></strong></div></td>
</tr>





<?
	$result->MoveNext();
	}


	?>
</table>




