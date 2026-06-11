    <style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif}
.Estilo7 {font-size: 12px}
.Estilo9 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo11 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo13 {color: #000000}
-->
      </style>

<?global $band;


include("../../../conexiones/config_pro.php");

$sql1 = "SELECT * FROM `compras1_encab_temp` ";
$result1 = $db->Execute($sql1);
$nro_factura=strtoupper($result1->fields["nro_factura"]);
$nro_proveedor=strtoupper($result1->fields["nro_proveedor"]);

$porcentaje_boni=strtoupper($result1->fields["bonificacion"]);
$porcentaje_dto=strtoupper($result1->fields["descuento"]);


include ("../../../conexiones/config_pro.php");
$sql="select * from proveedores where cuenta = $nro_proveedor";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$puerta=strtoupper($result->fields["puerta"]);
$telefono=strtoupper($result->fields["telefono"]);
$email=$result->fields["email"];
$cuit=strtoupper($result->fields["cuit"]);
$localidad=strtoupper($result->fields["localidad"]);
$tipo_iva=strtoupper($result->fields["tipo_iva"]);


switch ($tipo_fact){
	case "1":{
$tipo_fact = "RESP. INSCRIPTO";
		break;
	}

	case "2":{
$tipo_fact = "RNI";
		break;
	}

case "3":{
$tipo_fact = "Monotributo";
		break;
	}

		case "4":{
$tipo_fact = "EXENTO";
		break;
	}

		case "5":{
$tipo_fact = "Consumidor Final";
		break;
	}

}




$sql = "SELECT * FROM `compras1_deta_temp` where nro_factura = '$nro_factura'";
$result = $db->Execute($sql);
$fecha=strtoupper($result1->fields["fecha"]);

$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio = substr($fecha,0,4);

$fecha = $dia."/".$mes."/".$anio;



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">
<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">

<table width="103%" border="0">
  <tr bgcolor="#FFFFFF">
    <td colspan="2"><div align="center"><font color="#000000" face="Arial, Helvetica, sans-serif">INFORME DE COMPRA . Emitido el <?echo $hoy=date("d/m/Y");?></font></div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2"><HR noshade></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="62%"><div align="left"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Proveedor: </font> <font size="3"><span class="Estilo13"><?echo $denominacion;?></span></font></div></td>
    <td width="38%"><div align="center"></div>      <div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Fecha/Compra: </font><font color="#000000" size="2"><?echo $fecha;?></font><font color="#000000" size="2"></font></div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Domicilio: </font> <font size="3"><span class="Estilo13"><?echo $domicilio ;?> <?echo $puerta;?></span></font> - <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Localidad: </font><font size="3"><span class="Estilo13"><?echo $localidad;?></span></font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">: </font> <font size="3">&nbsp;</font></td>
    <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">N&ordm; Comprobante: <?echo $nro_factura;?></font> </div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Tipo IVA: <font size="3"><span class="Estilo13"><?echo $tipo;?></span></font> - Cuit: <font size="3"><span class="Estilo13"><?echo $cuit;?></span></font></td>
    <td><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">% de Descuento : <?echo $porcentaje_dto;?> </font></div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><div align="center"></div>      
      <div align="left"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Email: </font> <font size="3"><span class="Estilo13"><?echo $email;?></span></font><font color="#000000" size="2">
      </font></div>      <div align="center">
      </div></td>
    <td><div align="center"><font color="#000000" size="2">
          </font></div>      <div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">% de Bonificaci&oacute;n</font><font color="#000000" size="2"> : <?echo $porcentaje_boni;?></font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">
          </font></div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2"><HR noshade></td>
  </tr>
</table>

<table width="103%" border="0">
  <tr bgcolor="#FFFFFF">
    <td width="41%" scope="col"><div align="center" class="Estilo26"><font size="2" face="Arial, Helvetica, sans-serif">
      <?include("../../../conexiones/config_pro.php");
$nro_factura;
if ($nro_factura != ""){
$sql = "SELECT * FROM `compras1_deta_temp`  WHERE  `nro_factura` = $nro_factura";
}

$result = $db->Execute($sql);





?>
  
    Descripcion / Mercaderia</font></div></td>
    <td width="15%" scope="col"><div align="center" class="Estilo26"><font size="2" face="Arial, Helvetica, sans-serif">Presentacion</font></div></td>
    <td width="7%" scope="col"><div align="center" class="Estilo28"><font size="2" face="Arial, Helvetica, sans-serif">Cantidad</font></div></td>
    <td width="4%" scope="col"><div align="center" class="Estilo28"><font size="2" face="Arial, Helvetica, sans-serif"> Lote</font></div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo28"><font size="2" face="Arial, Helvetica, sans-serif"> Vencimiento</font></div></td>
    <td width="9%" scope="col"><div align="center"><span class="Estilo28"><font size="2" face="Arial, Helvetica, sans-serif">Precio Unit. </font></span></div></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td height="20" colspan="6" scope="col"><hr noshade></td>
  </tr><?

if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$cod_mercaderia=strtoupper($result->fields["cod_mercaderia"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$lote=strtoupper($result->fields["lote"]);
$mes_lote=strtoupper($result->fields["mes_lote"]);
$anio_lote=strtoupper($result->fields["anio_lote"]);
$vto_lote= $mes_lote." - ".$anio_lote;
$precio_unitario=strtoupper($result->fields["precio_unitario"]);
$total=strtoupper($result->fields["total"]);
$cod_detalle=strtoupper($result->fields["cod_detalle"]);
$precio_unitario=strtoupper($result->fields["precio_unitario"]);





$sql2 = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result2 = $db->Execute($sql2);
$descripcion=strtoupper($result2->fields["descripcion"]);
$presentacion=strtoupper($result2->fields["presentacion"]);
/*


$sql3 = "SELECT * FROM existencias  WHERE  `cod_merca` = $cod_mercaderia";
$result3 = $db->Execute($sql3);
$cod_lote=strtoupper($result3->fields["cod_lote"]);
$vencimiento_lote=strtoupper($result3->fields["vencimiento_lote"]);
$precio_unitario=strtoupper($result3->fields["precio_unitario"]);


$neto = $neto + $total;
$iva = ($neto * 21) /100;
$total_factura = round($neto,2) + round($iva,2);


*/
?>
  <tr bgcolor="#FFFFFF">
    <td height="20" scope="col"><div align="left" class="Estilo6 Estilo7"><font size="2" face="Arial, Helvetica, sans-serif"><span class="Estilo28"><?echo $cod_mercaderia. " - ".$descripcion;?></span></font></div></td>
    <td scope="col"><div align="center" class="Estilo9"><font size="2" face="Arial, Helvetica, sans-serif"><span class="Estilo26"><?echo $presentacion;?></span></font></div></td>
    <td scope="col"><div align="center" class="Estilo9"><font size="2" face="Arial, Helvetica, sans-serif"><span class="Estilo28"><?echo $cantidad;?></span></font></div></td>
	    <td scope="col"><div align="center" class="Estilo9"><font size="2" face="Arial, Helvetica, sans-serif"><span class="Estilo26"><?echo $lote;?></span></font></div></td>
		    <td scope="col"><div align="center" class="Estilo9"><font size="2" face="Arial, Helvetica, sans-serif"><span class="Estilo28"><?echo $vto_lote;?></span></font></div></td>
            <td scope="col"><div align="center"><span class="Estilo9"><font size="2" face="Arial, Helvetica, sans-serif"><span class="Estilo28"><?echo $precio_unitario;?></span></font></span></div></td>
  </tr>
<?


	        $total_cantidad = $total_cantidad + $cantidad;
	        $total_unitario = $precio_unitario + $cantidad;
	        $total_neto = $total_neto + $total;
									

	 $result->MoveNext();
				}

?>

<tr bgcolor="#FFFFFF">
  <td height="21" colspan="6" scope="col"><hr noshade></td>
  </tr>
<tr bgcolor="#E6E6E6">
  <td height="21" colspan="2" bgcolor="#FFFFFF" scope="col"><div align="right"><span class="Estilo11">Cantidad de Mercaderia Ingresada </span></div></td>
  <td colspan="4" bgcolor="#FFFFFF" scope="col"><div align="left"><span class="Estilo6 Estilo7 Estilo28"><strong><?echo $total_cantidad;?>
  </strong></span></div></td>
  </tr>
</table>


