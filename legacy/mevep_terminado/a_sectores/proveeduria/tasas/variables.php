<?php 

//tabla clientes
include ("../../../conexiones/config_pro.php");
$sql="select * from clientes where cuenta = $a";
$result = $db->Execute($sql);

$cuenta=strtoupper($result->fields["cuenta"]);
$estado=strtoupper($result->fields["estado"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$puerta=strtoupper($result->fields["puerta"]);
$referencia=strtoupper($result->fields["referencia"]);
$cod_postal =strtoupper($result->fields["cod_postal"]);
$localidad=strtoupper($result->fields["localidad"]);
$caracteristica_1=strtoupper($result->fields["caracteristica_1"]);
$telefono_1=strtoupper($result->fields["telefono_1"]);
$caracteristica_2=strtoupper($result->fields["caracteristica_2"]);
$telefono_2=strtoupper($result->fields["telefono_2"]);
$caracteristica_3=strtoupper($result->fields["caracteristica_3"]);
$telefono_3=strtoupper($result->fields["telefono_3"]);
$email=$result->fields["email"];
$cuit=strtoupper($result->fields["cuit"]);

$sql="select * from condiciones_clientes where cuenta = $a";
$result = $db->Execute($sql);
$iva=strtoupper($result->fields["iva"]);
$ingresos_brutos=strtoupper($result->fields["ingresos_brutos"]);
$condiciones=strtoupper($result->fields["condiciones"]);
$credito=strtoupper($result->fields["credito"]);
$flete=strtoupper($result->fields["flete"]);
$observaciones=$cuenta=$_POST["observaciones"];
$plan=$cuenta=$_POST["plan"];

?>

