<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

$B = 1;



$a = "inventario.xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$a");




?>
<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close(); cerrar()"> 
<table width="93%" height="24" border="0">
  <?



$anio_actual = date("y");
$mes_actual = date ("m");

echo $sql1="select * from existencias where (cantidad_ingresada - cantidad_salida) > 0 order by cod_mercaderia";
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
$descripcion=strtoupper($result->fields["descripcion"]);
$presentacion=strtoupper($result->fields["presentacion"]);
$precio_actualizado=number_format($result->fields["precio_actualizado"],2);

list($precio_entero1,$precio_decimal1) = explode(".",$precio_actualizado);
if (strlen($precio_decimal1) == 1){
$precio_decimal1 = $precio_decimal1."0";
}
$valor1 = $precio_entero1.",".$precio_decimal1;



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

    <tr bgcolor="#FFFFFF"><td width="15%" height="20"><div align="center"><font size="2"><?print("$cod_mercaderia");?></font></div></td>
    <td width="32%"><div align="left"><font size="2"><?print("$descripcion");?></font></div></td>
    <td width="39%"><div align="center"><font size="2"><?print("$presentacion");?></font></div></td>
<td width="14%"><div align="center"><font size="2"><?print("$cantidad_existente");?></font></div></td>
<td width="14%"><div align="center"><font size="2"><?print("$valor1");?></font></div></td>
  </tr>
<?

$result1->MoveNext();
	}
  

?>
</table>
