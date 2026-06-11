<?php 
//Abrimos el fichero en modo de escritura 
include ("../../../conexiones/config_grabacion.php");
$hoy = date("d-m-Y");

$carpeta = "c:/informes/";
$nombre = "NEVADA_".$hoy.".txt";



if (is_dir($carpeta)) {
echo "el directorio existe¡¡";
}
else {
mkdir("c:/informes", 0700);
echo "se ha creado el directorio";
}




 if (file_exists($carpeta.$nombre) == true){
unlink ($carpeta.$nombre);
 }


$DescriptorFichero = fopen("c:/informes/$nombre","w"); 

$enter = "\r\n";
$tab = "\t";
$nro_nevada = "610004794";
$filler = "                   ";//19 espacios
$sql2="select count(monto_descontar) as cantidad from debito";
$result22 = $db_pro->Execute($sql2);
$cantidad=$result22->fields["cantidad"];
$fecha = date("ymd");
$filler1 = "                                  ";// 35 espacios
$mes1= date("m");
$anio1 = date("y");
$filler2 = "          "; //10 espacios




echo $string0 = $nro_nevada.$filler.$fecha.$filler1.$enter;
fputs($DescriptorFichero,$string0); 
echo "<br>";


$sql="select * from debito order by cod_mevep";
$result = $db_pro->Execute($sql);

  if (!$result) die("fallo".$db_bq->ErrorMsg());
  while (!$result->EOF) {

$cont = $cont +1;
$cod_mevep=$result->fields["cod_mevep"];
$nombre=$result->fields["nombre"];
$documento=$result->fields["documento"];
$cbu=$result->fields["cbu"];
$monto_descontar=$result->fields["monto_descontar"];
$fecha_ingreso=$result->fields["fecha_ingreso"];

$total = $total + $monto_descontar;

$dia = substr($fecha_ingreso,8,1);
$mes= substr($fecha_ingreso,5,2);
$anio = substr($fecha_ingreso,2,2);
$fecha_ingreso = $anio.$mes.$dia;

$descripcion = "CUOTA MENSUAL ".$mes1."-".$anio1;
$descripcion = str_pad($descripcion, 35); 



list($precio_entero,$precio_decimal) = explode(".",$monto_descontar);
$precio_terminado = $precio_entero.$precio_decimal;
if ($precio_decimal == ""){$precio_decimal = "00";}

 $precio_terminado = str_pad($precio_terminado, 12, "0", STR_PAD_LEFT); 
echo $string1 = $cbu.$precio_terminado.$fecha_ingreso.$descripcion.$enter;
fputs($DescriptorFichero,$string1); 

echo "<br>";

$result->MoveNext();
	}


$cont = str_pad($cont, 6, "0", STR_PAD_LEFT); 



list($precio_entero,$precio_decimal) = explode(".",$total);

if ($precio_decimal == ""){$precio_decimal = "00";}
$precio_final = $precio_entero.$precio_decimal;
$precio_final = str_pad($precio_final, 12, "0", STR_PAD_LEFT); 


echo $string2 = $cont.$filler2.$precio_final.$fecha.$filler1;
fputs($DescriptorFichero,$string2); 
echo "<br>";

fclose($DescriptorFichero); 