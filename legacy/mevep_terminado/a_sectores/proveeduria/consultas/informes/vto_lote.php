<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
include ("../../../conexiones/config_pro.php");

$B = 1;








?>
<table width="750" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#993300">
    <td colspan="10" bgcolor="#E1F2EF"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE EXISTENCIA. Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">


    <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>

<td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRESENTACION</font></div></td>
	<td width="4%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOTE</font></div></td>
    <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">VTO LOTE</font></div></td>
<td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
<td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ESTADO</font></div></td>
<td width="18%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ULT-MOV</font></div></td>

  </tr>
  <?



$anio_actual = date("y");
$mes_actual = date ("m");

$sql1="select * from existencias";
$result1 = $db->Execute($sql1);
 
  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {


$cod_mercaderia=strtoupper($result1->fields["cod_mercaderia"]);
$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);
$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
$lote=strtoupper($result1->fields["lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$fecha_ultimo_mov=strtoupper($result1->fields["fecha_ultimo_mov"]);

$sql="select * from mercaderia where cod_merca like '$cod_mercaderia' ";
$result = $db->Execute($sql);
$descripcion=strtoupper($result->fields["nombre"]);
$presentacion=strtoupper($result->fields["presentacion"]);


$vto_lote = $mes_lote." - ".$anio_lote;



$cantidad_existente = $cantidad_ingresada - $cantidad_salida;
	
$mes = $mes_lote;
$anio = $anio_lote;

if ($anio == ""){
	$anio = $anio_actual;
}
else
		  {
$estado = "-";
		  }



if (($anio != "00") && ($mes != "00") or ($anio != "00") or ($mes != "00") ){

if ($anio < $anio_actual){
$estado = "VENCIDO";
}
else{

if ($anio > $anio_actual){
$estado = "-";}
else{

if ($mes < $mes_actual){
$estado = "VENCIDO";
}
else{
	$estado ="-";
}
}
}
}









?>

    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cod_mercaderia");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$descripcion");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$presentacion");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$lote");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$vto_lote");?></font></div></td>
	<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cantidad_existente");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$estado");?></font></div></td>
<td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$fecha_ultimo_mov");?></font></div></td>

 
  </tr>
<?

$result1->MoveNext();
	}
  

?>
</table>
