


<?php
global $buscador_rapido;
include("../../../../conexiones/config_grabacion.php");
if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");

$B = 1;

?>
<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">
<table width="114%" height="114" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
    <td colspan="9"><div align="right"><font color="#000000" face="Arial, Helvetica, sans-serif"><strong>  DEUDORES POR VENTA PROVEEDURIA AL: <?echo $fecha_hasta1;?></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Impreso el:<?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">

	<td width="16%" height="19"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">CUENTA</font></div></td>
    <td width="40%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">DENOMINACION</font></div></td>
    <td width="24%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">TIPO CUENTA </font></div></td>
    <td width="20%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
</tr>

<?
$palabra=$_POST["busca"];


SWITCH ($opciones){
	case "TODOS":{
		 $sql_pr = "SELECT DISTINCT (cuenta), tipo_cuenta FROM `resumen_cta_vta` ORDER BY `tipo_cuenta` , cuenta";
$result_pr = $db_pro->Execute($sql_pr);

		BREAK;
	}

	CASE "ASOCIADOS":{
		 $sql_pr = "SELECT DISTINCT (cuenta), tipo_cuenta FROM `resumen_cta_vta` WHERE tipo_cuenta = 1 ORDER BY `tipo_cuenta` , cuenta";
$result_pr = $db_pro->Execute($sql_pr);

		BREAK;
	}

	CASE "EXTERNOS":{
 $sql_pr = "SELECT DISTINCT (cuenta), tipo_cuenta FROM `resumen_cta_vta` WHERE tipo_cuenta = 2 ORDER BY `tipo_cuenta` , cuenta";
$result_pr = $db_pro->Execute($sql_pr);
		BREAK;
	}
}






 if (!$result_pr) die("fallo".$db_pro->ErrorMsg());
  while (!$result_pr->EOF) {

$tipo = $result_pr->fields["tipo_cuenta"];
$palabra= $result_pr->fields["cuenta"];



if ($tipo == '2'){
$sql3="select * from clientes where cuenta like '$palabra'";
$result3 = $db_pro->Execute($sql3);
$denominacion=strtoupper($result3->fields["denominacion"]);
$tipo_cuenta = "EXTERNO";
}elseif ($tipo == "1"){
$sql4="select * from datos_laboratorio where nro_laboratorio like '$palabra'";
$result4=$db_bq->Execute($sql4);
$denominacion=strtoupper($result4->fields["nombre_laboratorio"]);
$tipo_cuenta = "ASOCIADO";
}

$tipo = $result_pr->fields["tipo_cuenta"];
$palabra= $result_pr->fields["cuenta"];

$sql="select sum(importe) as composicion from resumen_cta_vta where cuenta like '$palabra' and tipo_cuenta = $tipo and fecha <= '$fecha_hasta' and ((cod_movimiento = '1') or (cod_movimiento = '01') or (cod_movimiento = '2') or (cod_movimiento = '02')) ";
$result = $db_pro->Execute($sql);
 $suma=strtoupper($result->fields["composicion"]);

 $sql="select sum(importe) as composicion from resumen_cta_vta where cuenta like '$palabra' and tipo_cuenta = $tipo and fecha <= '$fecha_hasta' and ((cod_movimiento = '3') or (cod_movimiento = '03') or (cod_movimiento = '05') or (cod_movimiento = '5') OR  (cod_movimiento = '4') or (cod_movimiento = '04'))";
$result = $db_pro->Execute($sql);
$resta=strtoupper($result->fields["composicion"]);


$saldo = $suma - $resta;

$suma_saldo = $suma_saldo + $saldo;


if ($saldo > 0.00){
?>

  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$palabra");?></font></div></td>
    <td><font face="Arial, Helvetica, sans-serif"><strong><font size="1"><?print("$denominacion");?></font></strong></font></td>
    <td><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><?print("$tipo_cuenta");?></font></div></td>
    <td><div align="right"><font size="1" face="Arial, Helvetica, sans-serif"><?echo number_format($saldo,2);?></font></div></td>
  </tr>
  

<?

  }

	$error = "";
	$suma = "";
	$resta= "";
	$saldo = "";

	$result_pr->MoveNext();

	}
 

  ?> 

	<tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td><hr noshade></td>
    <td><hr noshade></td>
    <td><hr noshade></td>
    <td><hr align="right" noshade></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td colspan="3"><div align="right"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">TOTALES</font></div></td>
    <td><div align="right"><font size="1" face="Arial, Helvetica, sans-serif">$ <?echo number_format($suma_saldo,2);?></font></div></td>
  </tr>
</table>
