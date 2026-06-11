<!-- <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();"> -->
<style type="text/css">
<!--
.Estilo4 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>


<?php

include ("../../../conexiones/config.inc.php");


global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
$palabra=$_POST["busca"];
}

$palabra=$_REQUEST["palabra"];


$hoy = date("d/m/y");



$B = 1;


  $sql="select * from cobradores ";
 $result = $db->Execute($sql);

	
?>
<table width="800" border="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="10"><div align="center"><font color="#FFFFFF" size="2" face="Trebuchet MS"><font color="#000000">LISTADO DE COBRADORES. Emitido el <?php echo $hoy;?></font></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
  
    <td width="154"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">COD COBRADOR</font></strong></div></td>
    <td width="265"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"> NOMBRE COBRADOR </font></strong></div></td>
    <td width="100"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">PLAN</font></strong></div></td>
    
    <td width="57"><div align="center"><span class="Estilo4">1 - 10 </span></div></td>
    <td width="57"><div align="center"><span class="Estilo4">11 - 20 </span></div></td>
    <td width="57"><div align="center"><span class="Estilo4">21 - 31</span></div></td>
    <td width="57"><div align="center"><span class="Estilo4">DEUDA</span></div></td>
    <td width="57"><strong><font color="#000000" size="2" face="Trebuchet MS">MODIFICAR</font></strong></td>
    <td width="57"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">BORRAR</font></strong></div></td>
    <?php 


  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cod_cobrador=$result->fields["cod_cobrador"];
$nombre_cobrador=$result->fields["nombre_cobrador"];
$plan=strtoupper($result->fields["plan"]); 
	

$sql1="select * from plan_cobrador where cod_plan = $plan ";
 $result1 = $db->Execute($sql1);
$a1_10=strtoupper($result1->fields["1_10"]); 
$a11_20=strtoupper($result1->fields["11_20"]);
$a21_31=strtoupper($result1->fields["21_31"]);
$deuda=strtoupper($result1->fields["deuda"]);


    ?>  
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
	<td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"><?php print("$cod_cobrador");?></font></strong></div></td>
  
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"> <?php echo $nombre_cobrador;?></font></strong></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"> <?php echo $plan;?></font></strong></div></td>
   


	<td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><span class="Estilo4"><strong><?php echo $a1_10;?></strong> % </span></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><span class="Estilo4"><strong><?php echo $a11_20;?></strong> % </span></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><span class="Estilo4"><strong><?php echo $a21_31;?></strong> % </span></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><span class="Estilo4"><strong><?php echo $deuda;?></strong> %</span></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"><a href="mod_cobrador.php?cod_cobrador=<?php print("$cod_cobrador");?>" onClick="return confirm('&iquest;Est&aacute; seguro de Modificar el Cobrador?');"><img src="../../../imagenes/office//005.ico" alt="Modificar" border = "0"></a></font></strong></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"><a href="bor_cobrador.php?cod_cobrador=<?php print("$cod_cobrador");?>" onClick="return confirm('&iquest;Est&aacute; seguro de Modificar el Cobrador?');"><img src="../../../imagenes/office//1047.ico" alt="Borrar" border = "0"></a></font></strong></div></td>
  </tr>


 


 
<?php

$result->MoveNext();
	}

 

?>
</table>

