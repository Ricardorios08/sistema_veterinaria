<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
include ("../../../../conexiones/config_grabacion.php");


$B = 1;
$palabra=$_POST["busca"];

$sql="select * from mercaderia where cod_merca like '%$palabra%' or  nombre like '%$palabra%' or proveedor like '%$palabra%'";

	$result = $db_pro->Execute($sql);
?><body background="../../../../imagenes/logito.png">
<table width="777" height="62" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#666666">
    <td colspan="12"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">LISTADO DE MERCADERIA . Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#A0A7F5">
 


    <td width="13%" height="14"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="54%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>

    <td width="5%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">MON</font></div></td>
    <td width="10%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">EMPRESAS</font></div></td>
<td width="11%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">REGALERIAS</font></div></td>
<td width="7%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">MENOR </font></div></td>
  </tr>
 
 
 <?





 
  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {

	
$cod_merca=$result->fields["cod_merca"];
$nombre=strtoupper($result->fields["nombre"]);
$tipo_moneda=strtoupper($result->fields["tipo_moneda"]);
 $precio_actualizado=strtoupper($result->fields["precio_actualizado"]);
$proveedor=strtoupper($result->fields["proveedor"]);

$sql1 = "select * from precio_costos";
$result1 = $db_pro->Execute($sql1);
$dolar_compra=strtoupper($result1->fields["dolar_compra"]);
$dolar_venta=strtoupper($result1->fields["dolar_venta"]);
$costo=strtoupper($result1->fields["costo"]);
$empresas=strtoupper($result1->fields["empresas"]);
$regaleria=strtoupper($result1->fields["regaleria"]);
$por_menor=strtoupper($result1->fields["por_menor"]);


$costo1 = $precio_actualizado - round(($precio_actualizado * $costo)/100,3); // en dolar

IF ($tipo_moneda == "D"){
$en_dolar = round(($costo1 * $dolar_compra),3);
}


$en_empresas_dolar = $costo1 * $empresas;
$en_regaleria_dolar = $costo1 * $regaleria;
$en_por_menor_dolar  = $costo1 * $por_menor;


$en_empresas_pesos= $en_empresas_dolar * $dolar_venta;
$en_regaleria_pesos = $en_regaleria_dolar * $dolar_venta;
$en_por_menor_pesos  = $en_por_menor_dolar * $dolar_venta;



/// MUESTRA EN DISTINTAS MONEDAS //
if ($moneda == "p"){?>

    <tr><td height="20" bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cod_merca");?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$nombre");?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $tipo_moneda;?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo number_format($en_empresas_pesos,2);?></font></div></td>

    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo number_format($en_regaleria_pesos,2);?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo number_format($en_por_menor_pesos,2);?></font></div></td>
  </tr>
    
  <?}

  else{?>


    <tr><td height="20" bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cod_merca");?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$nombre");?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $tipo_moneda;?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo number_format($en_empresas_dolar,2);?></font></div></td>

    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo number_format($en_regaleria_dolar,2);?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo number_format($en_por_menor_dolar,2);?></font></div></td>
  </tr>
    
<?}

$cont = $cont + 1;

$result->MoveNext();
	}


?>
    <tr>
      <td height="20" colspan="6" bgcolor="#666666"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">CANTIDAD DE MERCADERIA <?ECHO $cont;?></font></div></td>
    </tr>
</table>
