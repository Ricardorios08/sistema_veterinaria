<style type="text/css">
<!--
.Estilo5 {font-size: 12px}
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
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FF0000;
	font-size: 12px;
	font-weight: bold;
}
.Estilo9 {font-size: 12px}
.Estilo9 {font-family: Arial, Helvetica, sans-serif}
.Estilo10 {font-size: 12px}
.Estilo10 {font-family: Arial, Helvetica, sans-serif}
.Estilo11 {font-size: 12px}
.Estilo11 {font-family: Arial, Helvetica, sans-serif}
.Estilo12 {font-size: 12px}
.Estilo12 {font-family: Arial, Helvetica, sans-serif}
.Estilo13 {
	color: #FFFFFF;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo14 {font-size: 12px}
.Estilo14 {font-family: Arial, Helvetica, sans-serif}
.Estilo15 {font-size: 12px}
.Estilo15 {font-family: Arial, Helvetica, sans-serif}
.Estilo17 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo17 {font-family: Arial, Helvetica, sans-serif}
.Estilo19 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo21 {font-family: Arial, Helvetica, sans-serif; color: #0000FF; font-size: 12px; font-weight: bold; }
-->
</style>


<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">

<table width="750" border="0">
  <!--DWLayoutTable-->
<tr bgcolor="#000099">
    <td colspan="6" valign="top"><div align="center">
      <div align="center" class="Estilo13"><span class="Estilo6"><span class="Estilo5"><span class="Estilo1">Listado de FACTURAS VENCIDAS : <?ECHO $hoy;?></span></div></td>
  </tr>
   <tr bgcolor="#DAFAFC">
     <td width="6%"><div align="center"><span class="Estilo5">
        Tipo    
       </span>
     </div>
     <td width="10%"><div align="center"><span class="Estilo5">N&ordf; Factura</span></div></td>
     <td width="13%"><div align="center"><span class="Estilo10">Forma Pag </span></div></td>
     <td width="10%"><div align="center"><span class="Estilo5">Fecha</span></div></td>
     <!-- <td width="5%"><div align="center"><span class="Estilo6 Estilo2  Estilo5">Proveedor</td> -->
<td width="11%"><div align="center"><span class="Estilo5">TOTAL</span></div></td>
          <td width="13%"><div align="center"><span class="Estilo9">SALDO</span></div></td>
   </tr>

	 <?

include ("../../../../conexiones/config_grabacion.php");

$HOY = 22102008;




$dia = date("d");
$mes = date("m")+1;
$anio = date("Y");
$mes = $mes - 1;

if ($mes == 1){
	$mes =12;
}


$fecha_vto = $anio."-".$mes."-".$dia;
 


 $sql="select * from composicion_saldos  where fecha_emision < '$fecha_vto' and saldo > 0 order by tipo_cuenta, cuenta, fecha_emision, comprobante";
$result = $db_pro->Execute($sql);

  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


$cuent = $cuenta;





$cuenta=strtoupper($result->fields["cuenta"]);
 $tipo_cuenta =strtoupper($result->fields["tipo_cuenta"]);


switch ($tipo_cuenta){
case "1":{
$sql2="select * from datos_laboratorio where nro_laboratorio like '$cuenta'";
$result2=$db_bq->Execute($sql2);
$denominacion=strtoupper($result2->fields["nombre_laboratorio"]);
	break;
}


case "2":{

$sql3="select * from clientes where cuenta like '$cuenta'";
$result3 = $db_pro->Execute($sql3);
$denominacion=strtoupper($result3->fields["denominacion"]);

	break;
}

}

$importe_original= $result->fields["importe_original"];

$nro_factura=strtoupper($result->fields["comprobante"]);
$saldo = $result->fields["saldo"];

$suma_saldo = $suma_saldo + $saldo;


$fecha=strtoupper($result->fields["fecha_emision"]);
$dia =  substr($fecha,8,2);
$mes =  substr($fecha,5,2);
$anio = substr($fecha,0,4);
$fecha = $dia."-".$mes."-".$anio;
$tipo_fact=strtoupper($result->fields["tipo_fact"]);


 $sql1="select denominacion, forma_pago from ventas_encabezado  where nro_factura = $nro_factura";
$result1 = $db_pro->Execute($sql1);
//$denominacion=strtoupper($result1->fields["denominacion"]);

$forma_pago=strtoupper($result1->fields["forma_pago"]);



if ($saldo == 0.00){
	$saldo = "SALDADA";
}else{
	$saldo = number_format($saldo,2);
	  }

 if ($cuent != $cuenta){
	 
  $sql10="select sum(saldo) as adeudado from composicion_saldos where cuenta = $cuenta and tipo_cuenta = $tipo_cuenta";

$result10 = $db_pro->Execute($sql10);
$adeudado=strtoupper($result10->fields["adeudado"]);

	 ?>
     <tr>
       <td colspan="6" valign="top"><hr></td>
     </tr>
   <tr>
     <td colspan="4" valign="top"> <span class="Estilo8"><?print("$cuenta");?> - <?print("$denominacion");?> </span>       <div align="center"></div></td>
     <td colspan="2" valign="top"><div align="right"><span class="Estilo8"><span class="Estilo21">(Adeudado: $ <?print("$adeudado");?>)</span></span></div></td>
   </tr>
   <tr>
     <td colspan="4" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
     <td colspan="2" valign="top"><hr></td>
   </tr>
<?}?>
<tr>
<td><div align="center" class="Estilo5"><?print("$tipo_fact");?></div></td>
<td><div align="center" class="Estilo5"><?print("$nro_factura");?></div></td>
<td><div align="center"><span class="Estilo15"><span class="Estilo14"><span class="Estilo12"><?print("$forma_pago");?></span></span></span></div></td>
<td><div align="center" class="Estilo5"><?print("$fecha");?>
    </div></td>
<td><div align="right" class="Estilo5"><?echo number_format($importe_original,2);?></div></td>
<td><div align="right"><span class="Estilo11"><?echo $saldo;?></span></div></td>
</tr>






<?
	$result->MoveNext();
	}
  



	?>


	<tr>
  <td colspan="6"><hr></td>
  </tr>
<tr>
  <td colspan="3"><span class="Estilo19">Cantidad de Facturas: <?print("$cont");?></span></td>
  <td><!--DWLayoutEmptyCell-->&nbsp;</td>
  <td colspan="2"><div align="center" class="Estilo17">Total: <?print("$suma_saldo");?></div></td>
  </tr>

</table>




