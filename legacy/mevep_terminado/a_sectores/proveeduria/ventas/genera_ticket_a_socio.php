<?PHP

 
 

if ($cuit_socio == ""){
$leyenda = "NO INGRESO CUIT";
include ("../../../alertas/campo_informacion2.php");
exit;
}



$port = IF_OPEN("COM3",9600);

  if ( $port == -1) 
  { 
   echo "impresora ocupada";   
   return;  
  }



  EXIT;



$nError = IF_SERIAL("27-0163848-435");
//$nError = IF_WRITE("@PONEENCABEZADO|1|FACTURA A");
//$nError = IF_WRITE("@TIQUEABRE|C|");

 //$nError = IF_WRITE("@FACTABRE|T|C|A|1|P|10|I|I|".$denominacion_particular_A."||CUIT|".$cuit_particular."|N|".$domicilio_particular."|".$localidad_particular".||||C");

 $nError = IF_WRITE("@FACTABRE|T|C|A|1|P|10|I|I|".$denominacion."||CUIT|".$cuit_socio."|N|".$domicilio."|".$departamento);





include ("../../../conexiones/config_pro.php");

$sql="select * from `ventas1_deta_temp` where nro_factura = '$id'  order by cod_mercaderia";
  $result = $db->Execute($sql);


  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cod_merc = $cod_mercaderia;
$cod_mercaderia=$result->fields["cod_mercaderia"];
$descripcion=strtoupper($result->fields["descripcion"]);
$presentacion=strtoupper($result->fields["presentacion"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$precio_unitario=strtoupper($result->fields["precio_unitario"]);
$total2=strtoupper($result->fields["total"]);
$iva_renglon=strtoupper($result->fields["iva_renglon"]);
$cod_detalle=strtoupper($result->fields["cod_detalle"]);



 $sql1="select * from mercaderia where cod_merca = '$cod_mercaderia'";
 $result1 = $db->Execute($sql1);

$precio_actualizado=strtoupper($result1->fields["precio_actualizado"]);
$proveedor=strtoupper($result1->fields["proveedor"]);
$cod_tasa=strtoupper($result1->fields["cod_tasa"]);
  
  
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



$desc = $precio_particular * $descuento /100;
$precio_particular = $precio_particular - $desc;

$desc = $precio_socio1 * $descuento /100;
$precio_socio1 = $precio_socio1 - $desc;



if ($presentacion == "CREADO"){
$precio_particular = $total2;
$precio_socio1 = $total2;
}

$total_soc = $total_soc + $precio_socio1;







$cont = $cont + 1;


$base = $precio_particular / 1.21;

$total_par = $total_par + $base;


  $nError = IF_WRITE("@FACTITEM|".$descripcion.   "|    ".$cantidad."|      ".$base."|21|M|1|0|0|");

$result->MoveNext();
	}

$neto_gravado = $total_par;
$iva = $total_par * 21 /100;
$total = $neto_gravado + $iva;


//$nError = IF_WRITE("@FACTPAGO|DESCUENTO ".$descuento."|".$desc."|D");
  $nError = IF_WRITE("@FACTPAGO|PAGO|".$total_par."|T");
 // $nError = IF_WRITE("@TIQUECIERRA|T|");
   
	
	$nError = IF_WRITE("@FACTCIERRA|T|");
 
 $nDoc  =  IF_READ(3);


  $nError = IF_CLOSE();


   $sql = "DELETE FROM ventas1_deta_temp";
mysql_query($sql);

ECHO "TIQUET IMPRESO";