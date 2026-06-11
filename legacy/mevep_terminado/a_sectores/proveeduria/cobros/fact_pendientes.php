<table width="565" height="46" border="0">
         <tr bgcolor="#E1F2EF">
           <td colspan="4"><div align="center"><span class="Estilo1"><font color="#000000"><font color="#000000"><font face="Arial, Helvetica, sans-serif"> </font></font><font face="Arial, Helvetica, sans-serif">Facturas Pendientes</font></font></span> </div></td>
         </tr>
         <tr bgcolor="#E8DCFC">
           <td width="122"><div align="center" class="Estilo6"><font size="2" face="Arial, Helvetica, sans-serif">N&ordm; Factura</font></div></td>
           <td width="192"><div align="center" class="Estilo6">
               <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Obra Social</font></div>
           </div></td>
           <td width="113"><div align="center" class="Estilo6"><font size="2" face="Arial, Helvetica, sans-serif">Fecha</font></div></td>
           <td width="120"><div align="center" class="Estilo6"><font size="2" face="Arial, Helvetica, sans-serif">Total </font> <font size="2" face="Arial, Helvetica, sans-serif"> </font></div></td>
         </tr>
         <?
include ("../../../conexiones/config_grabacion.php");

	 if ($nro_factura == "")
	 {
$sql="select * from factura where estado like 'PENDIENTE' and nro_os = $busca ORDER by fecha desc";
	 }
	 else
	 {

$sql="select * from factura where nro_os = $busca and  estado like 'PENDIENTE'";
	 }

$result = $db_fa->Execute($sql);

  if (!$result) die("fallo".$db_fa->ErrorMsg());
  while (!$result->EOF) {


$nro_factura=strtoupper($result->fields["nro_factura"]);
$fecha=strtoupper($result->fields["fecha"]);
$periodo=strtoupper($result->fields["periodo"]);
$nro_os=strtoupper($result->fields["nro_os"]);
$total=strtoupper($result->fields["total"]);
$cant_bioq=strtoupper($result->fields["cant_bioquimicos"]);
$cant_ordenes=strtoupper($result->fields["cant_ordenes"]);
$estado=strtoupper($result->fields["estado"]);




$sql1="select * from datos_os where nro_os like '$nro_os'";
$result1 = $db_os->Execute($sql1);
$sigla=strtoupper($result1->fields["sigla"]);


?>
  <td width="122"><div align="center" class="Estilo4 Estilo5">
        <div align="center"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><span class="Estilo6"><?print("$nro_factura");?></span></font></div>
    </div></td>
      <td width="192"><div align="left" class="Estilo6"><font color="#336600" size="2" face="Arial, Helvetica, sans-serif"><?echo $nro_os." - ".$sigla;?></font></div></td>
      <td width="113"><div align="center" class="Estilo6">
          <div align="center"><font color="#0000CC" face="Arial, Helvetica, sans-serif"><span class="Estilo4 Estilo19"><?print("$fecha");?></span></font></div>
      </div></td>
      <td width="120" align="center"><div align="center" class="Estilo6">
          <div align="right"><strong><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?echo "$ ".number_format($total,2);?></font></strong></div>
      </div></td>
  </tr>
  <?
	$result->MoveNext();
	}


	?>
       </table>