<style type="text/css">
<!--
.Estilo17 {font-size: 10px}
.Estilo18 {font-family: Arial, Helvetica, sans-serif}
.Estilo19 {font-size: 10px; font-family: Arial, Helvetica, sans-serif; }
.Estilo20 {color: #000000}
-->
</style>
 <table width="330" border="0">
    <tr bgcolor="#C9FADF">
      <td height="27" colspan="3"><div align="center"><span class="Estilo1"><font color="#000000"><font color="#000000">
        <font face="Arial, Helvetica, sans-serif">
        <?
$nro_os=$_REQUEST ['nro_os'];
$nro_factura=$_REQUEST ['nro_factura'];


$hoy = date("d/m/y");



?>
        </font></font><font face="Arial, Helvetica, sans-serif">Cuentas Corrientes ABM </font></font></span></div></td>
    </tr>


	 <?
include ("../../../conexiones/config_grabacion.php");

	 if ($cuenta == "")
	 {
$sql="select * from deudas";
	 }
	 else
	 {

$sql="select * from deudas where nro_laboratorio like '$cuenta'";
	 }

$result = $db_liq->Execute($sql);

  if (!$result) die("fallo".$db_liq->ErrorMsg());
  while (!$result->EOF) {


$periodo=strtoupper($result->fields["periodo"]);
$anio=strtoupper($result->fields["anio"]);
$nro_liquidacion=strtoupper($result->fields["nro_liquidacion"]);

$fecha_origen=strtoupper($result->fields["fecha_origen"]);
$nro_laboratorio=strtoupper($result->fields["nro_laboratorio"]);


$cod_ajuste=strtoupper($result->fields["cod_ajuste"]);
$tipo_ajuste=strtoupper($result->fields["tipo_ajuste"]);
$nro_factura=strtoupper($result->fields["nro_factura"]);
$importe_original=strtoupper($result->fields["importe_original"]);
$importe_pagado=strtoupper($result->fields["importe_pagado"]);
$saldo=strtoupper($result->fields["saldo"]);
$fecha_ultimo_pago=strtoupper($result->fields["fecha_ultimo_pago"]);
$cod_operacion=strtoupper($result->fields["cod_operacion"]);
$cod_prioridad=strtoupper($result->fields["cod_prioridad"]);





$sql1="select * from datos_laboratorio where nro_laboratorio like '$nro_laboratorio'";
$result1 = $db_bq->Execute($sql1);
$nombre_laboratorio=strtoupper($result1->fields["nombre_laboratorio"]);
$todo = $nro_laboratorio." - ".$nombre_laboratorio;


?>


     <tr bgcolor="#FFFFFF">
       <td><div align="center" class="Estilo17 Estilo18 Estilo20">Periodo</div></td>
       <td><div align="center" class="Estilo19">Denominaci&oacute;n</div></td>
       <td><div align="center" class="Estilo19">Saldo</div></td>
     </tr>
  <tr bgcolor="#FFFFFF"> 

   <td width="48"><div align="left" class="Estilo6">
     <div align="center"><font color="#336600" size="2" face="Arial, Helvetica, sans-serif"><?echo $periodo." - ".$anio;?></font></div>
   </div>      </td>
    <td width="202"><span class="Estilo6"><font color="#336600" size="2" face="Arial, Helvetica, sans-serif"><?echo $todo;?></font></span></td>
    <td width="66"><div align="right"><span class="Estilo6"><font color="#336600" size="2" face="Arial, Helvetica, sans-serif">$ <?echo $saldo;?></font></span></div></td>
 </tr>





<?
	$result->MoveNext();
	}


	?>
</table>
</td>
  </tr>