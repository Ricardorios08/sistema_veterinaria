<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
include ("../../../conexiones/config.inc.php");


$B = 1;
$palabra=$_REQUEST["palabra1"];


if ($palabra != ""){
 
   $sql="select * from mercaderia where cod_merca like '$palabra%' or  nombre like '%$palabra%' or  proveedor like '$palabra'";
}else{
  $sql="select * from mercaderia order by cod_merca";
}

	$result = $db->Execute($sql);



?><body background="../imagenes/logito.png">
<table width="850" height="62" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#666666">
    <td colspan="15"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">LISTADO DE MERCADERIA . Emitido el <?php echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#A0A7F5">
 


    <td width="7%" height="14"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="44%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PRODUCTO</font> / <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">DESCRIPCION</font></div></td>
    <td width="21%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PROVEEDOR</font></div></td>
    <td width="5%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">EXIS.</font></div></td>
 
    <td width="7%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">SOCIOS </font></div></td>
<td width="5%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PART.</font></div></td>
  <td width="4%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">MOD</font></div></td>
  <td width="7%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">BORRAR</font></div></td>
  </tr>
 
 
 <?php 

 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cod_merca=$result->fields["cod_merca"];
$nombre=strtoupper($result->fields["nombre"]);
$descripcion=strtoupper($result->fields["tipo_moneda"]);
 $precio_actualizado=strtoupper($result->fields["precio_actualizado"]);
$proveedor=strtoupper($result->fields["proveedor"]);
$cod_tasa=strtoupper($result->fields["cod_tasa"]);

 $sql2="select * from tasas where cod_tasa = $cod_tasa";
 $result2 = $db->Execute($sql2);

  $tasa_socios=strtoupper($result2->fields["iva_normal"]);
  $tasa_particulares=strtoupper($result2->fields["iva_recargo"]);

$socios = $precio_actualizado * $tasa_socios/100;
$no_socios = $precio_actualizado * $tasa_particulares/100;


$sql4="select * from proveedores where cuenta = $proveedor";
 $result4 = $db->Execute($sql4);
 $denominacion=strtoupper($result4->fields["denominacion"]);




$sql1="select sum(cantidad_ingresada) as cantidad_ingresada from existencias where cod_mercaderia = $cod_merca";
$result1 = $db->Execute($sql1);
$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);

$sql1="select sum(cantidad_salida) as cantidad_salida from existencias where cod_mercaderia = $cod_merca";
$result1 = $db->Execute($sql1);
$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);

$suma_existente = $cantidad_ingresada - $cantidad_salida;


?>
    <tr><td height="20" bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php print("$cod_merca");?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $nombre;?></font>   <font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $descripcion;?></font></div></td>


    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $denominacion;?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $suma_existente;?></font></div></td>

    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo number_format($socios,2);?></font></div></td>

    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo number_format($no_socios,2);?></font></div></td>

    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><a href="../mercaderia/modificar_mercaderia.php?cod_merca=<?php print("$cod_merca");?>"><IMG SRC="../../../imagenes/office/102.ico" alt="Modificar" border = "0"></a></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><a href="../mercaderia/borra.php?cod_merca=<?php print("$cod_merca");?>"><IMG SRC="../../../imagenes/office/1047.ico" alt="Modificar" border = "0"></a></div></td>
  </tr>
    
<?PHP 
$cont = $cont + 1;

$result->MoveNext();
	}


?>
    <tr>
      <td height="20" colspan="9" bgcolor="#666666"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">CANTIDAD DE MERCADERIA <?php ECHO $cont;?></font></div></td>
    </tr>
</table>
