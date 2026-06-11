<style type="text/css">
<!--
.Estilo1 {
	color: #000000;
	font-weight: bold;
}
.Estilo5 {font-size: 10px}
.Estilo8 {font-family: Arial, Helvetica, sans-serif}
.Estilo17 {color: #FFFFFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; }
.Estilo20 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo21 {font-size: 14px}
-->
</style>

<script language="javascript">
function on_load()
{
document.getElementById("nro_factura").focus();
document.getElementById("nro_factura").style.backgroundColor = "#F7A4B3";
}



function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				
				case "nro_factura":
				document.getElementById("monto").focus();
				document.getElementById("nro_factura").style.backgroundColor = "#ffffff";
				document.getElementById("monto").style.backgroundColor = "#FFFF99";

				break;

				case "monto":
				document.getElementById("debito").focus();
				document.getElementById("monto").style.backgroundColor = "#ffffff";
				document.getElementById("debito").style.backgroundColor = "#66FF00";
				break;


				
		}
		return false;
	}
	return true;
}


function abrirVentan() {
	var busca = <?echo $busca;?> 
    open("fact_pendientes_prov.php?busca='<?echo $busca;?>'","SALDOS DEUDORES", "width=450,height=450,toolbar=no,directories=no,menubar=no,status=no, scrollbars=01, top = 35");
}
</script>

<?php


include ("../../../conexiones/config_grabacion.php");
$sql="select * from recibos1_encab_temp_pro";
$result = $db_cont->Execute($sql);
$nro_recibo=strtoupper($result->fields["nro_recibo"]);
$busca=strtoupper($result->fields["cuenta"]);
$cant_fact=strtoupper($result->fields["cant_fact"]);
$tipo_cuenta=strtoupper($result->fields["tipo_cuenta"]);
 $cuenta =strtoupper($result->fields["cuenta"]);
$fecha=strtoupper($result->fields["fecha_pago"]);
$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio = substr($fecha,0,4);
$fecha = $dia."/".$mes."/".$anio;



if ($tipo_cuenta == 1){

$sql1="select * from datos_personales where matricula like '$busca'";
$result1 = $db_bq->Execute($sql1);

$nombre=strtoupper($result1->fields["nombre"]);
$apellido=strtoupper($result1->fields["apellido"]);
$todo= $apellido." ".$nombre." (".$busca.")";
$tipo = "ASOCIADO";
}
else
{
 include("../../../conexiones/config_pro.php");
$sql="select * from clientes where cuenta like '$nro_cliente'";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);
$todo = $denominacion." (".$busca.")";
$tipo = "EXTERNO";
}

?>



<BODY onload = "on_load ()">
 
<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">

<!-- <FORM name="form" ACTION="cobros/a.php" METHOD = "POST"> -->
<table width="682" border="0">
         <tr bgcolor="#999999">
           <td width="408" valign="top"><table width="100%" border="0">
             <!--DWLayoutTable-->
             <tr bgcolor="#000099">
               <td height="32" colspan="2"><div align="left"><span class="Estilo17"><span class="Estilo21"> COBROS PROVEEDURIA </span><span class="Estilo20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha: <?ECHO $fecha;?></span></span></div></td>
             </tr>
             <tr bgcolor="#E1F2EF">
               <td height="28" colspan="2"><div align="center"><span class="Estilo20">Laboratorio: <?echo $todo;?><br>
               Recibo N&ordm;: <?echo $nro_recibo;?></span></div></td>
             </tr>
             <tr bgcolor="#E1F2EF">
               <td width="50%" bgcolor="#E6E6E6"><div align="right"><span class="Estilo20">Factura:</span></div></td>
               <td width="50%" valign="top" bgcolor="#E6E6E6"><span class="Estilo20"><span class="Estilo5">
                 <input name="nro_factura" type="text" size="8" tabindex = "1" id = "nro_factura" onKeyPress="return verif_caracter(this,event)">
                 <span class="Estilo8"><span class="Estilo1">
               </span></span> </span></span></td>


             </tr>
             <tr bgcolor="#E1F2EF">
               <td bgcolor="#E6E6E6"><div align="right"><span class="Estilo20"><span class="Estilo8">Importe $</span></span></div></td>
               <td valign="top" bgcolor="#E6E6E6"><span class="Estilo20"><span class="Estilo5"><span class="Estilo8">
                 <input name="monto" id= "monto" type="text" size="8" tabindex ="2" onKeyPress="return verif_caracter(this,event)">
                 <span class="Estilo1">                 <input name="importe" type="hidden" value = "<?echo $importe;?>">
                 <input name="nro_os" type="hidden" value = "<?echo $nro_os;?>">
                 <input name="nro_recibo" type="hidden" value = "<?echo $nro_recibo;?>">
				   <input name="tipo_cuenta" type="hidden" value = "<?echo $tipo_cuenta;?>">
				   <input name="cuenta" type="hidden" value = "<?echo $cuenta;?>">

               </span> </span></span></span></td>
             </tr>
             <tr bgcolor="#E1F2EF">
               <td colspan="2" bgcolor="#E6E6E6"><div align="center"><span class="Estilo20"><span class="Estilo5"><span class="Estilo8"> <span class="Estilo1">
                <input name="Alta" type="submit" value= "OK" id = "Alta">
                <input name="Alta" type="submit" value= "VER" id = "Alta">
				<a href="actualizar_proveeduria.php?nro_deta_recibo=<?print("$nro_deta_recibo");?>&&nro_factura=<?print("$nro_factura");?>&&monto=<?print("$monto");?>&&debito=<?print("$debito");?>" onClick="return confirm('¿Está seguro de Genera pago?');"><img src="../../../imagenes/botones/generar_pago.png" alt="Actualizar"  border = "0"></a>
               </span></span></span></span></div></td>
             </tr>
           </table></td>
    <td width="264" valign="middle"> <iframe src="fact_pendientes_prov.php?busca=<?print("$busca");?>&&tipo_cuenta=<?print("$tipo_cuenta");?>" width="302" height="122" align="center"></iframe></td>
         </tr>
  </table>
	   </th>
     </tr>

   <?



		if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
			{				
		case "OK":
				{

include ("../../../conexiones/config_grabacion.php");
$nro_factura=$_REQUEST['nro_factura'];
$fecha=$_REQUEST['fecha'];
$tipo_pago="COMPLETA";

$nro_recibo=$_REQUEST['nro_recibo'];

$busca=$_REQUEST['busca'];
$cuenta =$_REQUEST['cuenta'];
$cant_fact=$_REQUEST['cant_fact'];
 $monto=$_REQUEST['monto'];

$tipo_cuenta;
$debito=$_REQUEST['debito'];
$periodo=ucwords($result1->fields["periodo"]);
$total=ucwords($result1->fields["total"]);

if ($tipo_cuenta == 1)  {
$sql1="select * from ventas_encabezado where nro_factura like '$nro_factura' and nro_cuenta = $cuenta";
 }
else
					{
 $sql1="select * from ventas_encabezado where nro_factura like '$nro_factura' and nro_cliente = $cuenta";
					}

$result1 = $db_pro->Execute($sql1);

 $fecha_facturado=ucwords($result1->fields["fecha"]);
$fact=ucwords($result1->fields["nro_factura"]);
$estado=ucwords($result1->fields["estado"]);
$tipo_fact=ucwords($result1->fields["tipo_fact"]);

if ($fact == ""){
$sql2="select * from ventas_encabezad where nro_factura like '$nro_factura'";
$result2 = $db_pro->Execute($sql2);
 $fecha_facturado=ucwords($result1->fields["fecha"]);
$fact=ucwords($result2->fields["nro_factura"]);
$estado=ucwords($result2->fields["estado"]);
$tipo_fact=ucwords($result2->fields["tipo_fact"]);
}


$sql4="select * from recibos1_deta_temp_pro where nro_factura_afectado like '$nro_factura' and tipo_fact like '$tipo_fact' ";
$result4 = $db_cont->Execute($sql4);

$nro_factura_afectado=$result4->fields["nro_factura_afectado"];
$tipo_fact_afectado=$result4->fields["tipo_fact"];

 //$sql_pr = "select  * from composicion_saldos where  comprobante = '$fact' and tipo_fact = '$tipo_fact' order by fecha_emision, tipo_fact, comprobante";
 $sql_pr = "select  * from composicion_saldos where  comprobante = '$fact' order by fecha_emision, tipo_fact, comprobante";

$result_pr = $db_pro->Execute($sql_pr);

$cuotas= $result_pr->fields["cuotas"];
$cuotas_pagadas= $result_pr->fields["cuotas_pagadas"];
$importe_original= $result_pr->fields["importe_original"];
 $saldo= $result_pr->fields["saldo"];


if ($monto > $saldo){
$leyenda =  "MONTO MAYOR QUE SALDO";
include ("../../../alertas/campo_informacion2.php");
	exit;
}

if ($monto < $saldo){
$pago = "PARCIAL";
}
ELSE
					{
$pago = "TOTAL";
					}

if ($nro_factura_afectado == $fact){

	$leyenda =  "YA CARGO ESA FACTURA";
include ("../../../alertas/campo_informacion2.php");
	exit;
}



if ($fact == ""){
	$leyenda =  "Factura Inexistente o Factura de otra Obra Social";
include ("../../../alertas/campo_informacion2.php");
	exit;
}




switch ($estado){
	case "COBRADA":{
$leyenda = "Esta Factura ya fue recepcionada y pagada por Obra Social";
include ("../../../alertas/campo_informacion2.php");
	exit;
break;
}

	case "LIQUIDADA":{
$leyenda = "Esta Factura ya fue Liquidada a sus respectivos Laboratorios";
include ("../../../alertas/campo_informacion2.php");
	exit;
break;
}
}





 $sql = "INSERT INTO `recibos1_deta_temp_pro` ( `nro_recibo` , `tipo_fact` , `nro_factura_afectado` , `importe_pagado` , `debito` , `pago`)  VALUES ('$nro_recibo' , '$tipo_fact' , '$nro_factura' , '$monto' , '$debito' , '$pago' )";
$result1 = $db_cont->Execute($sql);
 include_once ("mostrar_detalle.php");
//	include ("guardar_completa.php");
break;
			    }

				case "VER":
				{

include_once ("mostrar_detalle.php");
break;
				}

				
						}


		}



?>


</table>
   
</FORM>