<style type="text/css">
<!--
.Estilo2 {
	font-size: 12px;
	font-family: "Trebuchet MS";
}
.Estilo3 {font-family: "Trebuchet MS"}
-->
</style>

<?PHP
include ("../../conexiones/config.inc.php");

$cod_socio = $_REQUEST["cod_socio"];
$fecha_pago = date("Y-m-d");
$cod_socio;

   $sql="select * from socios where cod_socio  like '$cod_socio' limit 1";
 $result = $db->Execute($sql);

 ?>


<table width="800" border="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
  
    <td width="179"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">SOCIO</font></strong></div></td>
    <td width="370"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"> APELLIDO Y NOMBRE </font></strong></div></td>
    <td width="104"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">TELEFONO</font></strong></div></td>
    <td width="67"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">LOCALIDAD</font></strong></div></td>
    <td width="70"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">BORRAR</font></strong></div></td>
    
<?PHP
$cod_socio=$result->fields["cod_socio"];
$cod_socio1=$result->fields["cod_socio"];
$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$departamento=strtoupper($result->fields["departamento"]);
$telefono=strtoupper($result->fields["telefono"]);
$cod_postal=strtoupper($result->fields["cod_postal"]);
$motivo=strtoupper($result->fields["motivo"]);
$fecha_ingreso=strtoupper($result->fields["fecha_ingreso"]);
$cobrador=strtoupper($result->fields["cobrador"]);

switch ($cobrador){
	case "10":{$cobrador1 = $cobrador." - LOCAL";break;}
	case "11":{$cobrador1 = $cobrador." - DANIEL";break;}
	case "12":{$cobrador1 = $cobrador." - JORGE";break;}
	case "13":{$cobrador1 = $cobrador." - GUSTAVO";break;}
    case "14":{$cobrador1 = $cobrador." - RICARDO";break;}
	}


$ruta=strtoupper($result->fields["ruta"]);

$no_imprimir=strtoupper($result->fields["no_imprimir"]);

switch ($no_imprimir){case "VERDADERO":{$tipo_pago_mostrar = "LOCAL";BREAK;}case "FALSO":{$tipo_pago_mostrar = "COBRADOR";BREAK;}}



if ($telefono == 0){
$telefono = "-";
}



    ?>  
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
	<td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"><?php print("$cod_socio");?></font></strong></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="left"><strong><font face="Trebuchet MS"><a href="modificar_socio.php?cod_socio=<?php print("$cod_socio");?>" class="Estilo5"><?php print("$apellido");?>, <?php print("$nombre");?></a></font></strong></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"> <?php echo $telefono;?></font></strong></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"> <?php echo $departamento;?></font></strong></div></td>
   


	<td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"></font></strong></div></td>
  </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td colspan="5" bordercolor="#E8DCFC"><font color="#000000" size="2" face="Trebuchet MS">Domicilio: <strong><font size="2" face="Trebuchet MS"><?php echo $domicilio;?></font></strong></font>        <div align="left"><strong></strong></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bordercolor="#E8DCFC"><font size="2" face="Trebuchet MS">Modo Pago: <?php echo $tipo_pago_mostrar;?> </font></td>
      <td bordercolor="#E8DCFC"><div align="center"></div></td>
      <td bordercolor="#E8DCFC"><div align="center"></div></td>
      <td bordercolor="#E8DCFC"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"><a href="../profesionales/entrada_turno_socio.php?cod_socio=<?php print("$cod_socio");?>"></a></font></strong></div></td>
      <td bordercolor="#E8DCFC">&nbsp;</td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bordercolor="#E8DCFC"><font size="2" face="Trebuchet MS">Observaciones<?php echo $motivo;?></font> </td>
      <td bordercolor="#E8DCFC"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="3" bordercolor="#E8DCFC"><div align="center"><strong></strong></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td colspan="5" bordercolor="#E8DCFC" bgcolor="#F0F0F0"><div align="center" class="Estilo3">Boletas Pagadas </div></td>
    </tr>

    

   
</TABLE>

<form action="corregir_boleta.php" method="post" target = "central">


<table width="798" border="0" cellspacing="0">
<tr>
<?php 





include ("../../conexiones/config.inc.php");

  $sql4="select * from pagos where cod_socio = $cod_socio and estado = 'PAGADO' order by anio, mes";
 $result4 = $db->Execute($sql4);

  if (!$result4) die("fallo".$db->ErrorMsg());
  while (!$result4->EOF) {

	$cont = $cont + 1;
$anio=$result4->fields["anio"];
$mes=$result4->fields["mes"];
$mes_mostrar = $mes;

switch ($mes){
case "1":{$mes_mostrar = "ENERO";break;}
case "2":{$mes_mostrar = "FEBRERO";break;}
case "3":{$mes_mostrar = "MARZO";break;}
case "4":{$mes_mostrar = "ABRIL";break;}
case "5":{$mes_mostrar = "MAYO";break;}
case "6":{$mes_mostrar = "JUNIO";break;}
case "7":{$mes_mostrar = "JULIO";break;}
case "8":{$mes_mostrar = "AGOSTO";break;}
case "9":{$mes_mostrar = "SEPTIEMBRE";break;}
case "10":{$mes_mostrar = "OCTUBRE";break;}
case "11":{$mes_mostrar = "NOVIEMBRE";break;}
case "12":{$mes_mostrar = "DICIEMBRE";break;}


}

$mes_pagar=$result4->fields["mes"];
$anio_pagar=$result4->fields["anio"];

$importe=$result4->fields["importe"];
 $cobrador=$result4->fields["cobrador"];
 $nro_boleta=$result4->fields["nro_boleta"];


$total_importe = $total_importe + $importe;

  

?>
    <td width="372" bgcolor="#FFCC00">  <div  class="Estilo1 Estilo2"><?php echo $mes_mostrar."/".$anio;?> </div></td>
    <td width="119" bgcolor="#FFCC00"><div align="right"><span class="Estilo1 Estilo2">$<?php echo $importe;?> </span></div></td>
    <td width="56" bgcolor="#FFCC00"><div align="center">
      <input type="checkbox" name="<?php echo estudios.$nro_boleta;?>" value ="<?php echo $nro_boleta;?>">
    </div></td>

    <td width="199" bgcolor="#FFCC00"><div align="center"><span class="Estilo1 Estilo2">N&deg; Boleta <?php echo $nro_boleta;?></span></div></td>

    <td width="42" bgcolor="#FFCC00">&nbsp;</td><tr>
    <?php



$result4->MoveNext();
	}

?>
</table>

<table width="800" border="0" cellspacing="0">
<tr>
  <td width="372" bgcolor="#CCCCCC"><div align="center">  <input type="hidden" name="cod_socio" value="<?php echo $cod_socio;?>">
  Seguridad: 
      <input type="password" name="seguridad"> 
      </div></td>
  <td width="178" bgcolor="#CCCCCC"><div align="right">$<?php echo $total_importe;?></div></td>
  <td bgcolor="#CCCCCC"><div align="center">
    <input type="submit" name="Submit" value="CORREGIR">
  </div></td>
  </tr>
</table>
</form>

