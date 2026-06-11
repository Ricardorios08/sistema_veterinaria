<table width="307" border="0">
  <tr>
    <th width="291" bgcolor="#FF0000" scope="col"><span class="Estilo2">ESTE PROCESO PUEDE TARDAR VARIOS MINUTOS POR FAVOR NO DESESPERARSE</span></th>
  </tr>
</table>
<?php 
global $palabra;
global $palabra1;
global $resultado;
global $a;


$a= 21;


include ("funciones.php");

include ("../conexiones/config_gb.php");
?>
<style type="text/css">
<!--
.Estilo2 {color: #FFFFFF}
-->
</style>


<?php 

$sqls = "TRUNCATE TABLE `para_cobol";
mysql_query($sqls);

$sql="select cod_grabacion, nro_practica from detalle where periodo = $mes and nro_os = 4723 and ano = $anio and (confirmada = 1 or confirmada = 7) and lote = 'DOCTHOS'   ORDER  BY nro_laboratorio, cod_grabacion, nro_orden";
$result = $db->Execute($sql);

if (!$result) die("No hay Ordenes en ese Mes".$db->ErrorMsg());
  while (!$result->EOF) {

$cod_grabacion=$result->fields["cod_grabacion"];
$practica=$result->fields["nro_practica"];



 $sql1 = "SELECT * FROM `ordenes` WHERE `cod_grabacion` LIKE '$cod_grabacion'";
$result1 = $db->Execute($sql1);
echo $cod_grabacion;
echo $nro_laboratorio=$result1->fields["nro_laboratorio"];
$nro_laboratori= ceros_nro_laboratorio($nro_laboratorio);



echo $nro_orden=$result1->fields["nro_orden"];
$nro_ord = ceros_nro_orden($nro_orden);


echo $nro_afiliado=$result1->fields["nro_afiliado"];
$nro_afiliad= ceros_nro_afiliado($nro_afiliado);

$fecha=$result1->fields["fecha"];

if ($nro_orden == "0"){
$nro_orden = $result1->fields["autorizacion"];
	$nro_ord = ceros_nro_orden($nro_orden);
}

if ($nro_orden == ""){
	$nro_orden = $result1->fields["autorizacion"];
	$nro_ord = ceros_nro_orden($nro_orden);
}


if ($fecha == '0000-00-00'){
	$fecha= '2008-03-01';
}

echo $fecha;
echo $medico=$result1->fields["medico"];
echo $practica;
	echo "<br>";

$practic=$practica;
$practic= ceros_nro_practica($practica);


$sql12 = "INSERT INTO `para_cobol` ( `nro_laboratorio` , `nro_orden` , `afiliado` , `fecha` , `prescriptor` , `practica` ) VALUES ('$nro_laboratori' , '$nro_ord' , '$nro_afiliad' , '$fecha' , '$medico' , '$practic')";

mysql_query($sql12);


$cont = $cont + 1;


$result->MoveNext();
}



