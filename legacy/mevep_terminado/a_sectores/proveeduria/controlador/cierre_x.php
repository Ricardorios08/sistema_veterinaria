<?php
ECHO "CIERRE X";
//  dl("php_TM20v53ts-vc9-x86.dll");

//phpinfo();

//exit;

  $port = IF_OPEN("COM3",9600);




  if ( $port == -1) 
  {   echo "impresora ocupada";   return;  }

$nError = IF_SERIAL("27-0163848-435");


 $nError = IF_WRITE("@PONEENCABEZADO|11|MEVEP");
 //$nError = IF_WRITE("@PONEENCABEZADO|12|------------------------ ");
// $nError = IF_WRITE("@PONEENCABEZADO|13|CIERRE Z ");
 //$nError = IF_WRITE("@PONEENCABEZADO|14|------------------------ ");


  $err = IF_WRITE("@CIERREX|P");

  printf($err);

  $err = IF_CLOSE();

?>

