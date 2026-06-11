<!-- <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();"> -->
<style type="text/css">
<!--
.Estilo3 {font-family: "Trebuchet MS"}
.Estilo4 {font-size: 12px}
.Estilo5 {font-family: "Trebuchet MS"; font-size: 12px; }
-->
</style>


<?php

include ("../../conexiones/config.inc.php");
$hoy = date("d/m/y");

switch ($cobrador){
	case "10":{$cobrador1 = $cobrador." - LOCAL";break;}
	case "11":{$cobrador1 = $cobrador." - ARIEL";break;}
	case "12":{$cobrador1 = $cobrador." - JOSE";break;}
	case "13":{$cobrador1 = $cobrador." - GUSTAVO";break;}
    case "14":{$cobrador1 = $cobrador." - RICARDO";break;}
	}



	
?>
<table width="800" border="0" cellspacing="0">

  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
  
    <td><div align="left"><strong><font color="#000000" size="2" face="Trebuchet MS">COBRADOR: </font></strong><strong><font size="2" face="Trebuchet MS"><?php echo $cobrador1;?></font></strong></div>      </td>

	  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><table width="929" border="0" cellspacing="0">
      <tr bgcolor="#CCCCCC">
        <td width="300"><div align="center"><span class="Estilo3 Estilo4">SOCIO</span></div></td>
        <td width="108"><div align="center" class="Estilo3 Estilo4">FECHA CREACION </div></td>
        <td width="52"><div align="center" class="Estilo5">MES</div></td>
        <td width="61"><div align="center" class="Estilo5">A&Ntilde;O</div></td>
        <td width="62"><div align="center" class="Estilo5">IMPORTE</div></td>
        <td width="98"><div align="center" class="Estilo5">ESTADO</div></td>
        <td width="150"><div align="center" class="Estilo5">COBRADOR</div></td>
        <td width="82"><div align="center" class="Estilo5">FECHA PAGO </div></td>
      </tr>



    <?php 


$sql1="select * from pagos where fecha_pago = '$fecha_pago' and estado = 'PAGADO' limit 30";
$result1 = $db->Execute($sql1);

 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {



$cod_socio=strtoupper($result1->fields["cod_socio"]);
$fecha_generacion=strtoupper($result1->fields["fecha_generacion"]);
$mes=strtoupper($result1->fields["mes"]);
$anio=strtoupper($result1->fields["anio"]);
$importe=strtoupper($result1->fields["importe"]);
$cobrador=strtoupper($result1->fields["cobrador"]);
$estado=strtoupper($result1->fields["estado"]);
$observaciones=strtoupper($result1->fields["observaciones"]);
$fecha_pago=strtoupper($result1->fields["fecha_pago"]);


  $sql="select * from socios where cod_socio = $cod_socio";
 $result = $db->Execute($sql);
	
$cod_socio=$result->fields["cod_socio"];
$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);







	  ?>
      <tr>
        <td><div align="left"><strong><font size="2" face="Trebuchet MS"><?echo $cod_socio;?></font></strong>-<strong><font size="2" face="Trebuchet MS"><?echo $apellido;?>, <?echo $nombre;?> </font></strong></div></td>
        <td><div align="center"><strong><font size="2" face="Trebuchet MS"><?echo $fecha_generacion;?></font></strong></div></td>
        <td><div align="center"><strong><font size="2" face="Trebuchet MS"><?echo $mes;?></font></strong></div></td>
        <td><div align="center"><strong><font size="2" face="Trebuchet MS"><?echo $anio;?></font></strong></div></td>
        <td><div align="right"><strong><font size="2" face="Trebuchet MS"><?echo $importe;?></font></strong></div></td>
        <td><div align="center"><strong><font size="2" face="Trebuchet MS"><?echo $estado;?></font></strong></div></td>
        <td><div align="center"><strong><font size="2" face="Trebuchet MS"><?echo $cobrador;?></font></strong></div></td>
        <td><div align="center"><strong><font size="2" face="Trebuchet MS"><?echo $fecha_pago;?></font></strong></div></td>
      </tr>
      <?
	$result1->MoveNext();
	}
	

?>

    </table></td>
  </tr>
  

</table>
