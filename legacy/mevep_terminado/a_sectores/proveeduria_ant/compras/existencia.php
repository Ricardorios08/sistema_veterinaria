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
$palabra=$_POST["busca"];

$sql="select * from mercaderia where cod_merca like '%$palabra%' or  nombre like '%$palabra%' or proveedor like '%$palabra%' or tipo like '%$palabra%' or presentacion like '%$palabra%' order by nombre, cod_merca asc ";

	$result = $db->Execute($sql);
?>
<table width="103%" height="58" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#993300">
    <td colspan="12
	" bgcolor="#E1F2EF"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE MERCADERIA Y PRECIOS CON EL PLAN: </font><strong><font size="4" face="Arial, Helvetica, sans-serif"><?print("$plan");?></font></strong><font size="4" face="Arial, Helvetica, sans-serif">.</font>  <font color="#000000" face="Arial, Helvetica, sans-serif">Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#000099">
   
    <td width="5%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="11%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRODUCTO</font></div></td>

<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRESENTACION</font></div></td>
<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">CANTIDAD</font></div></td>
<td width="10%"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">PRECIO</font></div></td>
  </tr>
  <?

	






 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {


$cod_merca=strtoupper($result->fields["cod_merca"]);

$sql1="select * from existencias where cod_mercaderia = $cod_merca";
$result1 = $db->Execute($sql1);

$cod_merquita=strtoupper($result1->fields["cod_mercaderia"]);


if ($cod_merquita == ""){
$result->MoveNext();
}
else
	  {

$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);


$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
$lote=strtoupper($result1->fields["lote"]);
$vto_lote=strtoupper($result1->fields["vto_lote"]);
$descripcion=strtoupper($result->fields["descripcion"]);
$presentacion=strtoupper($result->fields["presentacion"]);
$margendif=strtoupper($result->fields["margendif"]);
$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);

$margendif = number_format($margendif,2);
$precio_actualizado = number_format($precio_actualizado,2);

$cantidad_existente = $cantidad_ingresada - $cantidad_salida;
				  
$margendif = 0;
$porce_margendif = (($precio_actualizado * $margendif) /100);

$sql6 = "SELECT * FROM `tasas_planes`  WHERE  `cod_plan` = $plan";
$result6 = $db->Execute($sql6);

$descuento_1=strtoupper($result6->fields["descuento_1"]);
$porc_descuento_1= (($precio_actualizado * $descuento_1)/100);
$precio_actualizado = $precio_actualizado - $porc_descuento_1;


$descuento_2=strtoupper($result6->fields["descuento_2"]);
$porc_descuento_2= (($precio_actualizado * $descuento_2)/100);
$precio_actualizado = $precio_actualizado - $porc_descuento_2;

$recargo_1=strtoupper($result6->fields["recargo_1"]);
$porc_recargo_1= (($precio_actualizado * $recargo_1)/100);
$precio_actualizado = $precio_actualizado + $porc_recargo_1;

$recargo_2=strtoupper($result6->fields["recargo_2"]);
$porc_recargo_2= (($precio_actualizado * $recargo_2)/100);
$precio_actualizado = $precio_actualizado + $porc_recargo_2;

$recargo_impuesto=strtoupper($result6->fields["recargo_impuestos"]);
$porc_recargo_impuesto= (($precio_actualizado * $recargo_impuesto)/100);
$precio_actualizado = $precio_actualizado + $porc_recargo_impuesto;


$precio_actualizado = round($precio_actualizado,2);


	if ($B == 1) {

?>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <?
$B = 0;
				}
	ELSE	{
	$B=1;
		 	
?>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC">
    <?

			}






		?>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cod_merca");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="left"><font size="2"><?print("$descripcion");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$presentacion");?></font></div></td>
    <td bgcolor="#E8DCFC"><div align="center"><font size="2"><?print("$cantidad_existente");?></font></div></td>
	
	<td bgcolor="#E8DCFC"><div align="center"><font size="2">$ <?print("$precio_actualizado");?></font></div></td>

 
  </tr>
  <?





$result->MoveNext();
	}
  }

?>
</table>
