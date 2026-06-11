<?php

  dl("php_TM20v52ts.dll");

  $port = IF_OPEN("COM2",9600);

  if ( $port == -1) 
  { 
   echo "impresora ocupada";   
   return;  
  }

  $nError = IF_WRITE("@PONEENCABEZADO|1|EJEMPLO TIQUE");
  $nError = IF_WRITE("@TIQUEABRE|C|");
  $nError = IF_WRITE("@TIQUEITEM|ABRAZADERAS  ACER.IN|    1.000|      2.42|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEITEM|BARDAHL ADIT. INYECT|    1.000|      4.84|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEITEM|CABALLA AL NATURAL C|    1.000|      3.03|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEITEM|GALL.FLIARES C/SALVA|    1.000|      2.66|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEITEM|REFRIG. FLUIDO LAVAC|    1.000|      9.68|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEITEM|NAIPES CASINO x 40  |    1.000|      3.39|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEITEM|PALITO BOMBON       |    1.000|      1.82|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEITEM|ELAION DIESEL 15W40 |    1.000|     10.29|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEITEM|TABLETAS FUYI       |    1.000|      1.21|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEITEM|D1  15W40 x 5 LT    |    1.000|     27.83|21.00|M|1|0|0|");
  $nError = IF_WRITE("@TIQUEPAGO|Su Pago......|000070.00|T|");
  $nError = IF_WRITE("@TIQUECIERRA|T|");
 
  // Recuperar el nro de documento impreso

  $nDoc  =  IF_READ(3);


  $nError = IF_CLOSE();

?>
