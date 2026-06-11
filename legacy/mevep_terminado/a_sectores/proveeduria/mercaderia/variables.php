<?php
include ("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `mercaderia` WHERE `cod_merca` = $cod_merca";
$result = $db->Execute($sql);
//tabla mercaderia
$cod_merca=$result->fields["cod_merca"];
$nombre=strtoupper($result->fields["nombre"]);
$proveedor=$result->fields["proveedor"];
$precio_actualizado=$result->fields["precio_actualizado"];
$tipo_moneda=$result->fields["tipo_moneda"];
$cod_tasa=$result->fields["cod_tasa"];
$descripcion=$result->fields["descripcion"];
 
 $cod_categoria=$result->fields["cod_categoria"];
 $cod_marca=$result->fields["cod_marca"];

$sql2="select * from categoria where cod_categoria = $cod_categoria";
$result2 = $db->Execute($sql2);
$categoria=strtoupper($result2->fields["categoria"]);

 $sql2="select * from marca1 where cod_marca = $cod_marca";
$result2 = $db->Execute($sql2);
$marca=strtoupper($result2->fields["marca"]);


 $sql2="select * from tasas where cod_tasa = $cod_tasa";
$result2 = $db->Execute($sql2);
$tasa=strtoupper($result2->fields["iva_normal"]);
 $iva_recargo=strtoupper($result2->fields["iva_recargo"]);

$renglon = "Particular: ".$iva_recargo." Desc. Socio: ".$tasa;
$sql="select * from proveedores where cuenta = $proveedor order by denominacion";
$result = $db->Execute($sql);

$denominacion=strtoupper($result->fields["denominacion"]);


?>

