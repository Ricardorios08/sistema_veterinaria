   <?include ("../../../conexiones/config_grabacion.php");


$nro_factura_afectada= $_REQUEST['nro_factura_afectada'];
$tipo_fact_afectado =$_REQUEST['tipo_fact_afectado'];
$operador =$_REQUEST['operador'];


$dia = $_REQUEST['dia'];
$mes=$_REQUEST['mes'];
$anio =$_REQUEST['anio'];
$fecha_anulacion = $anio."-".$mes."-".$dia;



$sql = "SELECT * FROM `ventas_encabezado`  WHERE  `nro_factura` = '$nro_factura_afectada' and tipo_fact = '$tipo_fact_afectado'";
 $result = $db_pro->Execute($sql);


$tipo_fact=strtoupper($result->fields["tipo_fact"]);
$nro_factura=strtoupper($result->fields["nro_factura"]);

if (($nro_factura == "") && ($tipo_fact == "")){

 $sql = "INSERT INTO `ventas_encabezado` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `bruto` , `descuento` , `iva` , `retencion` , `neto` , `forma_pago` ) VALUES ( '$tipo_fact_afectado' , '$nro_factura_afectada' , '6' , '$tipo_fact' , '' , '' , '' , '$operador' , 'ANULADA' , '$fecha_anulacion' , '' ,  '' , '' , '' , '' , '' )";
 $result = $db_pro->Execute($sql);
}
else

{
$leyenda  = "NO PUEDE INGRESAR ESE NUMERO DE FACTURA PORQUE YA ESTA EN EL SISTEMA ";
include ("../../../alertas/campo_vacio.php");
EXIT;
}
 

$leyenda  = "SE REGISTRO UNA ANULACION DE ESTA FACTURA ";
include ("../../../alertas/campo_vacio.php");