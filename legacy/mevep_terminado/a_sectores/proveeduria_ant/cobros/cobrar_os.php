<style type="text/css">
<!--
.Estilo1 {
	color: #000000;
	font-weight: bold;
}
.Estilo5 {font-size: 10px}
.Estilo8 {font-family: Arial, Helvetica, sans-serif}
.Estilo11 {color: #000000}
.Estilo14 {color: #FF0000}
.Estilo17 {color: #FFFFFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; }
.Estilo19 {font-size: 12px}
.Estilo20 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo21 {
	color: #FF0000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
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


</script>

<?php






if ($band != "segunda_vuelta"){
$nro_recibo=$_REQUEST['nro_recibo'];
}


include ("../../../conexiones/config_grabacion.php");

$sql="truncate table recibos1_encab_temp ";
$result = $db_cont->Execute($sql);
$sql="truncate table recibos1_deta_temp ";
$result = $db_cont->Execute($sql);


if ($nro_recibo == ""){
$sql="select * from recibos order by nro_recibo desc";
$result = $db_cont->Execute($sql);
$nro_recibo=strtoupper($result->fields["nro_recibo"])+1;
}



$sql1="select * from datos_os where nro_os like '$busca'";
$result1 = $db_os->Execute($sql1);
$sigla=ucwords($result1->fields["sigla"]);

 $sql = "INSERT INTO `recibos1_encab_temp` ( `nro_recibo` , `fecha_pago` , `cuenta` , `tipo_cuenta` , `cant_fact` , `importe_pagado` , `periodo` , `anio` , `operador`  ) values ( '$nro_recibo' , '$fecha_guardar' , '$busca' , '$tipo_cuenta' , '$cant_fact' , '$importe_pagado' , '$mes' , '$anio' , '$operador')";
mysql_query($sql);

$result = $db_cont->Execute($sql);

?>



<BODY onload = "on_load ()">
 
<FORM name="form" ACTION="cobrar_os1.php" METHOD = "POST">

<!-- <FORM name="form" ACTION="cobros/a.php" METHOD = "POST"> -->
<table width="682" border="0">
	     <!--DWLayoutTable-->
         <tr bgcolor="#000099">
           <td height="21" colspan="4"><div align="center"><span class="Estilo17">REGISTRAR COBROS</span></div></td>
           <td width="40%" height="21" bgcolor="#000099"><div align="center"><a href="actualizar.php?nro_deta_recibo=<?print("$nro_deta_recibo");?>&&nro_factura=<?print("$nro_factura");?>&&monto=<?print("$monto");?>&&debito=<?print("$debito");?>" onclick="return confirm('¿Está seguro de Genera pago?');"><IMG SRC="../../../imagenes/botones/nuevos/btn_aceptar.png" alt="Actualizar"  border = "0"></a></div></td>
         </tr>
		 
         <tr bgcolor="#E8DCFC">
           <td height="21" colspan="5"><span class="Estilo20">Obra Social: <?echo $sigla." (".$busca.")";?>  <span class="Estilo21">&nbsp;&nbsp;&nbsp;&nbsp;Fecha:<?ECHO $fecha;?></span></span> <span class="Estilo20"><span class="Estilo21">&nbsp;&nbsp;&nbsp;</span></span> <span class="Estilo20">Recibo N&ordm;: <span class="Estilo14"><?echo $nro_recibo;?></span></span>             <div align="center"> </div>             <div align="center">
   
    
           </div></td>
         </tr>
         <tr>
           <td width="19%" bgcolor="#E1F2EF"><div align="center" class="Estilo11 Estilo1 Estilo8 Estilo19"> </div>
               <div align="right" class="Estilo20">N&ordm; Factura: </div></td>
           <td width="33%" bgcolor="#E1F2EF"><span class="Estilo11"><span class="Estilo5">
             <input name="nro_factura" type="text" size="6" tabindex = "1" id = "nro_factura" onKeyPress="return verif_caracter(this,event)">
             <input name="importe" type="hidden" value = "<?echo $importe;?>">
             <input name="nro_os" type="hidden" value = "<?echo $nro_os;?>">
             <input name="nro_recibo" type="hidden" value = "<?echo $nro_recibo;?>">
			 <input name="busca" type="hidden" value = "<?echo $busca;?>">
           </span></span></td>
           <td colspan="3" rowspan="4" valign="top" bgcolor="#FFFFFF"> <iframe src="fact_pendientes1.php?nro_factura=<?print("$nro_factura");?>&&busca=<?print("$busca");?>" width="320" height="100" align="center" border = "0">
    </iframe></td>
         </tr>
         <tr>
           <td bgcolor="#E1F2EF"><div align="right" class="Estilo20">Importe $ </div></td>
           <td bgcolor="#E1F2EF"><span class="Estilo8">
             <input name="monto" id= "monto" type="text" size="8" tabindex ="2" onKeyPress="return verif_caracter(this,event)">
           </span></td>
         </tr>
         <tr>
           <td bgcolor="#E1F2EF"><div align="right" class="Estilo20">D&eacute;bito </div></td>
           <td bgcolor="#E1F2EF"><span class="Estilo8">
             <input type="text" name="debito" id="debito"  size="8">
             <span class="Estilo11"><span class="Estilo5"><span class="Estilo1"> </span></span></span></span></td>
         </tr>
         <tr>
           <td colspan="2" bgcolor="#E1F2EF"><div align="center"><span class="Estilo8"><span class="Estilo11"><span class="Estilo5"><span class="Estilo1">
         <!--  <input name="Alta" type="image" value= "BUSCAR" src="../../imagenes/botones/btn_anadir.gif" id = "Alta"> -->
	
              <input name="Alta" type="submit" value= "PAGO TOTAL" id = "Alta">
              <input name="Alta" type="submit" value= "PAGO PARCIAL" id = "Alta">
			  <input name="Alta" type="submit" value= "VER" id = "Alta">

</span></span></span></span></div></td>
         </tr>
  </table>

   <?








		








/*

		if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
									
		case "OK":
				{

		echo "dfsfsdfsdfsd-2";
ECHO "FDS".$nro_factura=$_REQUEST['nro_factura'];
ECHO $fecha=$_REQUEST['fecha'];
ECHO $tipo_pago="COMPLETA";
ECHO $nro_recibo=$_REQUEST['nro_recibo'];
ECHO $nro_os=$_REQUEST['nro_os'];
ECHO $cant_fact=$_REQUEST['cant_fact'];
ECHO $monto=$_REQUEST['monto'];
ECHO $debito=$_REQUEST['debito'];


break;
			    }

				
						}

*/
/*
include ("../../conexiones/config_cont.php");
 $sql = "INSERT INTO `recibos` ( `nro_recibo` , `fecha_pago` , `cant_fact` , `importe_pagado` )  VALUES ('$nro_recibo' , '$fecha' , '$cant_fact' , '$importe')";
mysql_query($sql);


include ("../../conexiones/config_fa.php");
$sql1="select * from factura where nro_factura like '$nro_factura' and nro_os like '$nro_os' ";
$result1 = $db->Execute($sql1);

 $fecha_facturado=ucwords($result1->fields["fecha"]);
$fact=ucwords($result1->fields["nro_factura"]);
$estado=ucwords($result1->fields["estado"]);

if ($fact == ""){
	$leyenda =  "Factura Inexistente o Factura de otra Obra Social";
include ("../../alertas/campo_vacio.php");
	exit;
}

switch ($estado){
	case "COBRADA":{
$leyenda = "Esta Factura ya fue recepcionada y pagada por Obra Social";
include ("../../alertas/campo_vacio.php");
	exit;
break;
}

	case "LIQUIDADA":{
$leyenda = "Esta Factura ya fue Liquidada a sus respectivos Laboratorios";
include ("../../alertas/campo_vacio.php");
	exit;
break;
}
}


 $periodo=ucwords($result1->fields["periodo"]);
$total=ucwords($result1->fields["total"]);

 $nro_os;
 */
//	include ("guardar_completa.php");



?>

</table>
   
</FORM>