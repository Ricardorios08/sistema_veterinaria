<?php
ECHO "ENCABEZADO";
//  dl("php_TM20v53ts-vc9-x86.dll");

//phpinfo();

//exit;

$port = IF_OPEN("COM5",9600);

  if ( $port == -1) 
  { 
   echo "impresora ocupada";   
   return;  
  }
 

$nError = IF_SERIAL("27-0163848-435");


$nError = IF_SERIAL("27-0163848-435");
$nError = IF_WRITE("@PONEENCABEZADO|1|GRACIAS POR SU COMPRA");
$nError = IF_WRITE("@PONEENCABEZADO|2|TIQUE FACTURA NC B / CONSUMIDOR FINAL ");
$nError = IF_WRITE("@PONEENCABEZADO|3| ");
$nError = IF_WRITE("@TIQUEABRE|D|");




$descripcion = "Devolucion";
$cantidad = 1;
$precio_particular = 163;

$nError = IF_WRITE("@TIQUEITEM|".$descripcion."|    ".$cantidad."|      ".$precio_particular."|21.00|M|1|0|0|");


$total_par = 163;
  $nError = IF_WRITE("@TIQUEPAGO|PAGO|".$total_par."|T");
  $nError = IF_WRITE("@TIQUECIERRA|T|");


  printf($err);

  $err = IF_CLOSE();

?>

