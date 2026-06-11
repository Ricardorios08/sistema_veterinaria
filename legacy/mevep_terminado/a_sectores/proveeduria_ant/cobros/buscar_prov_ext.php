<style type="text/css">
<!--
.Estilo17 {font-size: 10px}
.Estilo18 {font-family: Arial, Helvetica, sans-serif}
.Estilo19 {font-size: 10px; font-family: Arial, Helvetica, sans-serif; }
.Estilo20 {color: #000000}
-->
</style>
 <table width="420" border="0">
    <tr bgcolor="#F2FACB">
      <td height="27" colspan="4"><div align="center"><span class="Estilo1"><font color="#000000"><font color="#000000">
        <font face="Arial, Helvetica, sans-serif">
        <?
$nro_os=$_REQUEST ['nro_os'];
$nro_factura=$_REQUEST ['nro_factura'];
$cuenta=$_REQUEST ['cuenta'];

$hoy = date("d/m/y");



?>
        </font></font><font face="Arial, Helvetica, sans-serif"> ABM PROVEEDURIA </font></font></span></div></td>
    </tr>

<tr bgcolor="#FFFFFF">
       <td><div align="center" class="Estilo17 Estilo18 Estilo20">Comp.</div></td>
       <td><div align="center" class="Estilo19">Denominaci&oacute;n</div></td>
       <td><div align="center"><span class="Estilo19">Saldo</span></div></td>
       <td><div align="center" class="Estilo19">Vto</div></td>
     </tr>
	 <?
include ("../../../conexiones/config_grabacion.php");

	 if ($cuenta == "")
	 {
$sql="select * from composicion_saldos where ((tipo_cuenta = 2) or (tipo_cuenta = 2)) and saldo > 0";
	 }
	 else
	 {

$sql="select * from composicion_saldos where ((tipo_cuenta = 2) or (tipo_cuenta = 2)) and saldo > 0 and cuenta = $cuenta";
	 }

$result = $db_pro->Execute($sql);

  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$nro_laboratorio=strtoupper($result->fields["cuenta"]);
$comprobante=strtoupper($result->fields["comprobante"]);
$vencimiento=strtoupper($result->fields["vencimiento"]);
$saldo=round($result->fields["saldo"],2);

$dia = substr($vencimiento,8,2);
$mes= substr($vencimiento,5,2);
$anio= substr($vencimiento,0,4);

$vencimiento = $dia."/".$mes."/".$anio;

$sql1="select * from clientes where cuenta like '$nro_laboratorio'";
$result1 = $db_pro->Execute($sql1);
$nombre_laboratorio=strtoupper($result1->fields["denominacion"]);
$todo = $nombre_laboratorio." - ".$nro_laboratorio;


?>
  <tr bgcolor="#FFFFFF"> 

   <td width="47"><div align="left" class="Estilo6 Estilo17">
     <div align="center"><font color="#336600" face="Arial, Helvetica, sans-serif"><?echo $tipo_fact." - ".$comprobante;?></font></div>
   </div>      </td>
    <td width="190"><span class="Estilo6 Estilo17"><font color="#336600" face="Arial, Helvetica, sans-serif"><?echo $todo;?></font></span></td>
    <td width="79"><div align="center"><span class="Estilo6 Estilo17"><font color="#336600" face="Arial, Helvetica, sans-serif">$ <?echo $saldo;?></font></span></div></td>
    <td width="86"><div align="right"><span class="Estilo6 Estilo17"><font color="#336600" face="Arial, Helvetica, sans-serif"><font color="#336600" face="Arial, Helvetica, sans-serif"><?echo $vencimiento;?></font></font></span></div></td>
 </tr>





<?
	$result->MoveNext();
	}


	?>
</table>
</td>
  </tr>