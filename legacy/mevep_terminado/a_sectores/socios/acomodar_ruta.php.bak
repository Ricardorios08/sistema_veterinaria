<?php include ("../../conexiones/config.inc.php");

 $sql="select * from socios where ruta >= $ruta_nueva ORDER BY ruta DESC";
$result = $db->Execute($sql);


  If (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$ruta_vieja=$result->fields["ruta"];
$ruta_incre=($result->fields["ruta"] + 1);
$cod_socio=$result->fields["cod_socio"];

$sql1 = "UPDATE socios SET `ruta` = '$ruta_incre' WHERE cod_socio = $cod_socio and ruta = $ruta_vieja;";
mysql_query($sql1);


	  $result->MoveNext();
	}


$sql1 = "UPDATE socios SET `ruta` = '$ruta_nueva' WHERE cod_socio = $cod_socio_usado";
mysql_query($sql1);


echo $sql = "UPDATE socios SET `apellido` = '$apellido' , `nombre` = '$nombre' , `tipo_doc` = '$tipo_doc' ,  `documento` = '$documento', `telefono` = '$telefono', `domicilio` = '$domicilio', `localidad` = '$localidad', `departamento` = '$departamento', `cod_postal` = '$cod_postal', `fecha_pago` = '$fecha_pago', `debito` = '$debito', `sexo` = '$sexo', `deuda` = '$deuda', `importe_deuda` = 'importe_deuda', `importe_cuota` = '$importe_cuota', `no_imprimir` = '$tipo_pago', `celular` = '$celular', `mail` = '$mail', `fecha_ingreso` = '$fecha_ingreso' , `motivo` = '$motivo' WHERE cod_socio = $cod_socio_usado;";
mysql_query($sql);

