<?php 
global $buscador_rapido;
include("../../conexiones/config_grabacion.php");







?>
<table width="103%" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td colspan="13"><div align="right"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><strong> TRABAJO</strong> <?php echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">

	<td width="7%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">FECHA</font></div></td>
    <td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">HORA</font></div></td>

    <td width="58%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">REALIZACION</font></div></td>
    <td width="13%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PARA</font></div></td>


	<td width="7%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">DURACION</font></div></td>
    <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">BORRAR</font></div></td>
  </tr>

  <?php 


 $sql="select * from trabajo order by fecha, hora";
$result = $db_bq->Execute($sql);





  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {


	$fec = $fecha;

$fecha=strtoupper($result->fields["fecha"]);

$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio= substr($fecha,0,4);
$fecha = $dia."-".$mes."-".$anio;
$hora=strtoupper($result->fields["hora"]);
$trabajo=strtoupper($result->fields["trabajo"]);
 $para=strtoupper($result->fields["para"]);
$duracion=strtoupper($result->fields["duracion"]);
$cod_operacion=strtoupper($result->fields["cod_operacion"]);

if ($fec != $fecha){
?> <tr>
      <td colspan="6"><hr noshade></td>
    </tr><?php 
}

?>
    <tr><td><div align="center"><font size="2"><?php print("$fecha");?></font></div></td>
    <td><div align="center"><font size="2"><?php print("$hora");?></font></div></td>
    <td><div align="left"><font size="2"><?php print("$trabajo");?></font></div></td>
    <td><div align="left"><font size="2"><?php print("$para");?></font></div></td>
	<td><div align="right"><font size="2"><?php echo $duracion;?> Hs.</font></div></td>

    <td><div align="center"><a href="borrar_trabajo.php?cod_operacion=<?php print("$cod_operacion");?>&&trabajo=<?php print("$trabajo");?>&&hora=<?php print("$hora");?>&&para1=<?php print("$para");?>&&duracion=<?php print("$duracion");?>&&dia=<?php print("$dia");?>&&mes=<?php print("$mes");?>&&anio=<?php print("$anio");?>" target="central"><IMG SRC="../../imagenes/office//027.ico" alt="Modificar" border = "0"></a></div></td>
  </tr>
  
 
  
<?php 

$result->MoveNext();
	}
  
  ?>

 
</table>
