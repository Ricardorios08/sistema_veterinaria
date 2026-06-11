<BODY background="SIGN.pnp"><CENTER><TABLE WIDTH="90%" BORDER=0><TR><TD>  
<?php


//include ("../../conexiones/config.inc.php");


include ("../../../conexiones/config_pro.php");

$palabra=$_POST["busca"];
$opcion=$_POST["menu"];

	$sql="select * from stockpro";

	switch($opcion)
	{

		case "cod_merca1":
		$sql.=" where cod_merca1 like '%$palabra%'";

			break;

		case "Nombre":
			
			$sql.=" where nombre like '%$palabra%'";
			break;

		case "Telefono":
			
		    $sql.=" where telefono like '%$palabra%'";
			break;

		case "Todos":
			break;

	}

$sql.=" order by cod_merca1";

$result = $db->Execute($sql);

?>
<table width="850" height="58" border="4">
  <tr bordercolor="#0066FF" bgcolor="#0033FF"> 
    <td width="10%"><div align="center"><strong><font color="#FFFFFF" size="2">Codigo de la Mercaderia </font></strong></div></td>
    <td width="9%"><div align="center"><strong><font color="#FFFFFF" size="2">Descripcion</font></strong></div></td>
    <td width="8%"><div align="center"><strong><font color="#FFFFFF" size="2">Cantidad</font></strong></div></td>
    <td width="12%"><div align="center"><strong><font color="#FFFFFF" size="2">Precio Unitario</font></strong></div></td>
    <td width="9%"><div align="center"><strong><font color="#FFFFFF" size="2">Lote</font></strong></div></td>
    <td width="11%"><div align="center"><strong><font color="#FFFFFF" size="2">Vencimiento del Lote </font></strong></div></td>
    <td width="23%"><div align="center"><strong><font color="#FFFFFF" size="2">Proveedor</font></strong></div></td>
    <td width="35" bgcolor="#CCCCCC"><div align="center"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">Cambiar</font></div></td>
    <td width="27" bgcolor="#CCCCCC"><div align="center"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">Borrar</font></div></td>
    <td width="44" bgcolor="#CCCCCC"><div align="center"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">Ficha </font></div></td>
    </tr>
  <?php 
if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	  $id=ucwords($result->fields["cod_merca1"]);

	$sql1="select * from stockpro where cod_merca1 = '$id'";
	$result1 = $db->Execute($sql1);



$id=ucwords($result->fields["cod_merca1"]);
$precio_unitario1=ucwords($result->fields["precio_unitario1"]);
$cantidad1=ucwords($result->fields["cantidad1"]);
$fecha1=$result1->fields["fecha1"];
$factura1=ucwords($result->fields["factura1"]); 
$tipo_mov1=$result->fields["tipo_mov1"];
$lote1=ucwords($result->fields["lote1"]);
$vto_lote1=$result->fields["vto_lote1"];
$nro_proveedor=$result->fields["nro_proveedor"];


//-------trae el nombre de la mercaderia, para mostrar----------------------------

include ("../../../conexiones/config_pro.php");
$sql2="select * from mercaderia where cod_merca = '$id'";
$result2 = $db->Execute($sql2);
$nombre=strtoupper($result2->fields["nombre"]);

$sql3="select * from proveedores where cuenta = '$nro_proveedor'";
$result3 = $db->Execute($sql3);
$denominacion=strtoupper($result3->fields["denominacion"]);

?>
  <tr> 
    <td><font color="#FF0000" size="2"><?php print("$id");?></font></td>
    <td><font color="#0000FF" size="2"><?php print("$nombre");?></font></td>
    <td><font size="2"><?php print("$cantidad1");?></font></td>
    <td><font size="2"><?php print("$precio_unitario1");?></font></td>
    <td><font size="2"><?php print("$lote1");?></font></td>
    <td><font size="2"><?php print("$vto_lote1");?></font></td>
    <td><font color="#FF0000" size="2"><?php print("$denominacion");?></font></td>
    <td><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="proveeduria\mercaderia\modificar_ficha.php?id=<?php print("$id");?>" target = "central">[OK]</a></font></div></td>
    <td><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="../../proveeduria/mercaderia/borra_ficha.php?id=<?php print("$id");?>">[OK]</a> </font></div></td>
    <td><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="../mercaderia/ficha.php?id=<?php print("$id");?>">[OK]</a></font></div></td>
    </tr>
  <?php 

$result->MoveNext();
	}

?>
</table>




