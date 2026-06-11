<?php

//  dl("php_TM20v52ts.dll");

INCLUDE ("tM20PhpApi.php");

  $port = IF_OPEN("COM4",9600);

  if ( $port == -1) 
  {   echo "impresora ocupada";   return;  }

  $err = IF_WRITE("@CIERREZ|P");

  printf($err);

  $err = IF_CLOSE();

?>
