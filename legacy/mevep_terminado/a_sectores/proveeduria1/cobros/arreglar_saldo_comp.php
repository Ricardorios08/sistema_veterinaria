<?
include ("../../../conexiones/config_grabacion.php");
$sql="select * from composicion where tipo_fact = 1";
$result = $db_liq->Execute($sql);

 if (!$result) die("fallo".$db_liq->ErrorMsg());
  while (!$result->EOF) {


$nro_factura=ucwords($result->fields["nro_factura"]);
$fecha_emision=ucwords($result->fields["fecha_emision"]);

$nro_laboratorio=ucwords($result->fields["nro_laboratorio"]);
$nro_os=ucwords($result->fields["nro_os"]);
$importe=ucwords($result->fields["importe"]);

$total=$result->fields["total"];
if ($importe != 0.00){
echo $sql1 = "UPDATE `composicion` SET `saldo` = '$importe' WHERE `nro_factura` = '$nro_factura' and nro_os = '$nro_os' and nro_laboratorio = '$nro_laboratorio'";
//$result1 = $db_liq->Execute($sql1);
}

echo "<br>";
$result->MoveNext();
	}
?>