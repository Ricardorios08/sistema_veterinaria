<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
}

$hoy = date("d/m/Y");
include ("../../../conexiones/config.inc.php");


$B = 1;


if ($bande != 2){
$palabra=$_REQUEST["palabra1"];
}



$id=$_REQUEST["id"];
$palabra_agenda=$_REQUEST["palabra_agenda"];

$id = 0;


IF ($palabra_agenda != ''){
include ("../../../validar/usuarios/buscar_empleado.php");
EXIT;
}


$sql3 = "SELECT sum(cantidad) as cant_productos FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $id";
$result3 = $db->Execute($sql3);
$cant_productos=strtoupper($result3->fields["cant_productos"]);
 


  $sql3 = "SELECT sum(cantidad) as cant_productos FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $id group  by cod_mercaderia";
$result3 = $db->Execute($sql3);
$cant_arti=strtoupper($result3->fields["cant_arti"]);
 
   $sql3 = "SELECT sum(total) as tot FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $id";
$result3 = $db->Execute($sql3);
$tot=strtoupper($result3->fields["tot"]);


if ($palabra != ""){
 
   $sql="select * from mercaderia where cod_merca like '$palabra%' or  nombre like '%$palabra%' or  proveedor like '$palabra'";
}else{
  $sql="select * from mercaderia order by cod_merca";
}

	$result = $db->Execute($sql);



?><body background="../imagenes/logito.png">
<table width="800" height="62" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#666666">
    <td colspan="15" bgcolor="#000033">
	  
	<div align="center"><font color="#FFFFFF" size="2" face="Trebuchet MS"> Cantidad de Productos: <?php echo $cant_productos;?> |  Total: <?php  $tot;?> | </font>
	    
	  <a href="../ventas/mostrar_detalle.php?id=<?php print("$id");?>"><font color="#FFFFFF" face="Trebuchet MS">Ver Venta </font></a></div></td></tr>
  <tr bordercolor="#FFFFCC" bgcolor="#666666">
    <td colspan="15"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">LISTADO DE MERCADERIA . Emitido el <?php echo $hoy;?> </font></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#A0A7F5">
 


    <td width="8%" height="14"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="36%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PRODUCTO</font><font size="2"> / <font color="#000000" face="Arial, Helvetica, sans-serif">DESCRIPCION</font></font></div></td>
    <td width="12%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PROVEEDOR</font></div></td>
    <td width="6%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">EXIS.</font></div></td>
 
    <td width="5%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">RES</font></div>
    <div align="center"> </div></td><td width="9%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">SOCIO</font></div></td>
    <td width="10%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PARTICULAR</font></div></td>
    <td width="6%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">STO</font></div></td>
  <td width="8%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">AGREG</font></div></td> 
  </tr>
 
 
 <?php 

 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cod_merca=$result->fields["cod_merca"];
$nombre=strtoupper($result->fields["nombre"]);
 $descripcion=strtoupper($result->fields["descripcion"]);
 $precio_actualizado=strtoupper($result->fields["precio_actualizado"]);
$proveedor=strtoupper($result->fields["proveedor"]);
 $cod_tasa=strtoupper($result->fields["cod_tasa"]);


$cod_marca=strtoupper($result->fields["cod_marca"]);
$cod_categoria=strtoupper($result->fields["cod_categoria"]);
 
  
  
   $sql2="select * from tasas where cod_tasa = $cod_tasa";
 $result2 = $db->Execute($sql2);

   $tasa_socio=$result2->fields["iva_normal"];
   $tasa_particulares=strtoupper($result2->fields["iva_recargo"]);






$sql2="select * from marca1 where cod_marca = $cod_marca";
$result2 = $db->Execute($sql2);
$marca=$result2->fields["marca"];

$sql2="select * from categoria where cod_categoria = $cod_categoria";
$result2 = $db->Execute($sql2);
$categoria=$result2->fields["categoria"];

 $precio_particular = round(($precio_actualizado * $tasa_particulares)/100,2) + $precio_actualizado;
 $precio_socio =round(($precio_particular * $tasa_socio/100),2);

 $precio_socio1 = $precio_particular - $precio_socio;



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


  $sql3 = "SELECT sum(cantidad) as cant_art FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $id and cod_mercaderia = $cod_merca";
$result3 = $db->Execute($sql3);
$cant_art=$result3->fields["cant_art"];


$saldo = $suma_existente - $cant_art;



?>
    <tr><td height="20" bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php print("$cod_merca");?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $nombre;?></font>/   <font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $descripcion;?></font></div></td>


    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $denominacion;?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $suma_existente;?></font></div></td>

    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">(<?php echo $saldo;?>)</font></div></td>

    <td bordercolor="#E8DCFC" bgcolor="#66CCFF"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><?php echo number_format($precio_socio1,2);?></font></div></td>

    <td bordercolor="#E8DCFC" bgcolor="#FFCC99"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><?php echo number_format($precio_particular,2);?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><a href="../consultas/stock/consultas.php?cod_merca=<?php print("$cod_merca");?>"><IMG SRC="../../../imagenes/office/605.ico" alt="Modificar" border = "0"></a></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="center"><a href="../ventas/agregar.php?cod_merca=<?php print("$cod_merca");?>&&id=<?php print("$id");?>&&palabra=<?php print("$palabra");?>&&id=<?php print("$id");?>"><IMG SRC="../../../imagenes/office/1033.ico" alt="Modificar" border = "0"></a></div></td> 
  </tr>
    
<?PHP 
$cont = $cont + 1;

$result->MoveNext();
	}


?>
    <tr>
      <td height="20" colspan="9" bgcolor="#666666"><div align="center"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">CANTIDAD DE MdddERCADERIA <?php ECHO $cont;?></font></div></td>
    </tr>
</table>
