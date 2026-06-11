<?php
global $buscador_rapido;

$cod_proveedor=$_POST["cod_proveedor"];


$hoy = date("d/m/Y");

 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

$B = 1;
$palabra=$_POST["busca"];



if ($palabra == ""){
include ("consultas.php");
exit;
}
else{
$sql="select * from mercaderia where cod_merca like '$palabra'";
}
$result = $db->Execute($sql);


$cod_merca=strtoupper($result->fields["cod_merca"]);

if ($cod_merca == ""){
include ("consultas.php");
exit;
}


?>
<table width="113%" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="12
	"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE EXISTENCIA. Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">
 

    <td width="6%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="20%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>

<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRESENTACION</font></div></td>
	<td width="8%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOTE</font></div></td>
    <td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">VTO LOTE</font></div></td>
<td width="8%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ENTRADAS</font></div></td>
<td width="9%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALIDAS</font></div></td>
<td width="7%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">SALDO</font></div></td>
<td width="8%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ESTADO</font></div></td>
<td width="7%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">ULT-MOV</font></div></td>
<td width="7%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CORREGIR</font></div></td>

  </tr>
  <?



$anio_actual = date("y");
$mes_actual = date ("m");


 


$sql1="select * from existencias where cod_mercaderia = $cod_merca";
$result1 = $db->Execute($sql1);



  if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {


$cod_merquita=strtoupper($result1->fields["cod_mercaderia"]);
$cod_detalle=strtoupper($result1->fields["cod_detalle"]);



if ($cod_merquita == ""){

$result1->MoveNext();
}
else
	  {

$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);


$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
$lote=strtoupper($result1->fields["lote"]);
$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$fecha_ultimo_mov=strtoupper($result1->fields["fecha_ultimo_mov"]);

$vto_lote = $mes_lote." - ".$anio_lote;

$nombre=strtoupper($result->fields["nombre"]);
$presentacion=strtoupper($result->fields["presentacion"]);
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








if ($B == 1) {

?>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
    <?
$B = 0;
				}
	ELSE	{
	$B=1;
		 	
?>
  <tr bordercolor="#FFFFCC" bgcolor="#FFCC99">
    <?

			}




?>
    <td><div align="center"><font size="2"><?print("$cod_merca");?></font></div></td>
    <td><div align="center"><font size="2"><?print("$nombre");?></font></div></td>
    <td><div align="center"><font size="2"><?print("$presentacion");?></font></div></td>
<td><div align="center"><font size="2"><?print("$lote");?></font></div></td>
<td><div align="center"><font size="2"><?print("$vto_lote");?></font></div></td>

	<td><div align="center"><font size="2"><?print("$cantidad_ingresada");?></font></div></td>
	<td><div align="center"><font size="2"><?print("$cantidad_salida");?></font></div></td>
	<td><div align="center"><font size="2"><?print("$cantidad_existente");?></font></div></td>
<td><div align="center"><font size="2"><?print("$estado");?></font></div></td>
<td><div align="center"><font size="2"><?print("$fecha_ultimo_mov");?></font></div></td>

<td><div align="center"><font size="2"><a href="cambiar_existencia.php?cod_detalle=<?print("$cod_detalle");?>" onclick="return confirm('¿Está seguro de Modificar existencia de este producto?');"><IMG SRC="../../../../imagenes/office/009.ico" alt="Anular"  border = "0"></a></font></div></td>

 
<?

$result1->MoveNext();
	}
  }

?>
</table>
