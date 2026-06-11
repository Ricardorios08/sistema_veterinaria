<style type="text/css">
<!--
.Estilo1 {font-size: 10px}
.Estilo2 {font-size: 12px}
.Estilo3 {color: #000000}
.Estilo4 {font-size: 12px; color: #000000; }
.Estilo5 {color: #FFFFFF}
.Estilo6 {font-family: Arial, Helvetica, sans-serif}
.Estilo7 {font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
.Estilo9 {color: #FFFFFF; font-size: 12px; }
-->
</style>
<table width="288" height="114" border="0">
         <tr bgcolor="#000099">
           <td height="22" colspan="3"><div align="center"><span class="Estilo1"> <span class="Estilo9"><font face="Arial, Helvetica, sans-serif">Facturas Pendientes</font></span></span> </div></td>
         </tr>
         <tr bgcolor="#E8DCFC">
           <td width="74"><div align="center" class="Estilo6"><font size="2" face="Arial, Helvetica, sans-serif">N&ordm; Factura</font></div></td>
           <td width="94"><div align="center" class="Estilo6"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">Total</font></font></div></td>
           <td width="99"><div align="center" class="Estilo6"> <font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">Fecha</font> </font></div></td>
         </tr>
         <?
include ("../../../conexiones/config_fa.php");

$busca =$_REQUEST['busca'];
$nro_factura=$_REQUEST['nro_factura'];

	 if ($nro_factura == "")
	 {
$sql="select * from factura where estado like 'PENDIENTE' and nro_os = $busca ORDER by fecha desc";
	 }
	 else
	 {

$sql="select * from factura where nro_os = $busca and  estado like 'PENDIENTE'";
	 }

$result = $db->Execute($sql);

  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {


$nro_factura=strtoupper($result->fields["nro_factura"]);
$fecha=strtoupper($result->fields["fecha"]);

$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio = substr($fecha,0,4);
$fecha = $dia."/".$mes."/".$anio;


$periodo=strtoupper($result->fields["periodo"]);
$nro_os=strtoupper($result->fields["nro_os"]);
$total=strtoupper($result->fields["total"]);
$cant_bioq=strtoupper($result->fields["cant_bioquimicos"]);
$cant_ordenes=strtoupper($result->fields["cant_ordenes"]);
$estado=strtoupper($result->fields["estado"]);


$total_final = $total_final + $total;

include ("../../../conexiones/config_os.php");
$sql1="select * from datos_os where nro_os like '$nro_os'";
$result1 = $db->Execute($sql1);
$sigla=strtoupper($result1->fields["sigla"]);


?>
  <tr bgcolor="#E6E6E6"><td width="74"><div align="center" class="Estilo4 Estilo5">
        <div align="center"><font face="Arial, Helvetica, sans-serif"><span class="Estilo6 Estilo2 Estilo3"><?print("$nro_factura");?></span></font></div>
    </div></td>
      <td width="94"><div align="center" class="Estilo6">
          <div align="center"><font face="Arial, Helvetica, sans-serif"><span class="Estilo4 Estilo19 Estilo2  Estilo3"><font face="Arial, Helvetica, sans-serif"><?echo "$ ".number_format($total,2);?></font></span></font></div>
    </div></td>
      <td width="99" align="center"><div align="center" class="Estilo6">
          <div align="center"><font face="Arial, Helvetica, sans-serif"><span class="Estilo4 Estilo19 Estilo2 Estilo3"><?print("$fecha");?></span></font></div>
    </div></td>
  </tr>
  <?
	$result->MoveNext();
	}


	?>
  <tr bgcolor="#E8DCFC">
    <td colspan="3" bgcolor="#FFFFFF"><hr noshade></td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td><div align="center" class="Estilo7">Saldo</div></td>
    <td colspan="2"><div align="center"><font face="Arial, Helvetica, sans-serif"><span class="Estilo4 Estilo19 Estilo2  Estilo3"><font face="Arial, Helvetica, sans-serif"> <?echo "$ ".number_format($total_final,2);?></font></span></font></div></td>
  </tr>
</table>
