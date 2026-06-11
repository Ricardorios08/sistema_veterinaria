<!-- <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();"> -->
<style type="text/css">
<!--
.Estilo2 {font-weight: bold}
.Estilo3 {font-family: "Trebuchet MS"}
.Estilo4 {font-size: 12px}
.Estilo5 {font-family: "Trebuchet MS"; font-size: 12px; }
-->
</style>


<?php

include ("../../conexiones/config.inc.php");


 

$palabra=$_REQUEST["cod_socio"];


$hoy = date("d/m/y");
  $sql="select * from socios where cod_socio = $cod_socio";
 $result = $db->Execute($sql);

	
?>
<table width="800" border="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="4"><div align="center"><font color="#FFFFFF" size="2" face="Trebuchet MS"><font color="#000000">LISTADO DE SOCIOS. Emitido el <?php echo $hoy;?></font></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
  
    <td width="154"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">SOCIO</font></strong></div></td>
    <td width="265"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"> APELLIDO Y NOMBRE </font></strong></div></td>
    <td width="100"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">TELEFONO</font></strong></div></td>
    <td width="100"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">LOCALIDAD</font></strong></div></td>
    <?php 






	
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

$ruta=strtoupper($result->fields["ruta"]);

$no_imprimir=strtoupper($result->fields["no_imprimir"]);

switch ($no_imprimir){case "VERDADERO":{$tipo_pago_mostrar = "LOCAL";BREAK;}case "FALSO":{$tipo_pago_mostrar = "COBRADOR";BREAK;}}



if ($telefono == 0){
$telefono = "-";
}



    ?>  
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
	<td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"><?php print("$cod_socio");?></font></strong></div></td>
    <td bordercolor="#E8DCFC"><div align="center"><strong><font size="2" face="Trebuchet MS"><a href="modificar_socio.php?cod_socio=<?php print("$cod_socio");?>"><?php print("$apellido");?>, <?php print("$nombre");?></a></font></strong></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFFCC"><div align="center"><strong><font size="2" face="Trebuchet MS"> <?php echo $telefono;?></font></strong></div></td>
    <td bordercolor="#E8DCFC"><div align="center"><strong><font size="2" face="Trebuchet MS"> <?php echo $departamento;?></font></strong></div></td>
  </tr>

  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
    <td colspan="4" bordercolor="#E8DCFC" bgcolor="#FFFF99"><table width="800" border="0">
      <tr bgcolor="#CCCCCC">
        <td width="125"><div align="center" class="Estilo3 Estilo4">FECHA CREACION </div></td>
        <td width="80"><div align="center" class="Estilo5">MES</div></td>
        <td width="93"><div align="center" class="Estilo5">A&Ntilde;O</div></td>
        <td width="77"><div align="center" class="Estilo5">IMPORTE</div></td>
        <td width="115"><div align="center" class="Estilo5">ESTADO</div></td>
        <td width="169"><div align="center" class="Estilo5">COBRADOR</div></td>
        <td width="111"><div align="center" class="Estilo5">FECHA PAGO </div></td>
      </tr>


<?php

$sql1="select * from pagos where cod_socio = $cod_socio";
 $result1 = $db->Execute($sql1);

 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

$fecha_generacion=strtoupper($result1->fields["fecha_generacion"]);
$mes=strtoupper($result1->fields["mes"]);
$anio=strtoupper($result1->fields["anio"]);
$importe=strtoupper($result1->fields["importe"]);
$cobrador=strtoupper($result1->fields["cobrador"]);
$estado=strtoupper($result1->fields["estado"]);
$observaciones=strtoupper($result1->fields["observaciones"]);
$fecha_pago=strtoupper($result1->fields["fecha_pago"]);


$cod_cobrador = $cobrador;
  $sql11="select *  from cobradores where cod_cobrador = $cobrador";
$result11 = $db->Execute($sql11);

$nombre_cobrador=strtoupper($result11->fields["nombre_cobrador"]);

$cobrador = $cobrador." - ".$nombre_cobrador;





	  ?>

      <tr>
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
	

	IF ($cant >= 22){?>
    <tr bordercolor="#FFFFFF" bgcolor="#FF0000">
      <td colspan="5" bordercolor="#E8DCFC"><div align="center"><font color="#FFFFFF" size="6" face="Trebuchet MS"><BLINK><strong>INHABILITADO POR DEUDA </strong><BLINK></font> </div>  </TR>
<?}?>
  
 </table></td>
  </tr>
  

</table>
