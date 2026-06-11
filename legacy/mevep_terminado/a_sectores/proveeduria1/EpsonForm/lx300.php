<?php

// Este modulo contiene el codigo a disposicion por parte de IFDRIVERS
// en una base TAL CUAL. Todo receptor del  Modulo se considera 
// bajo licencia de los derechos de autor de IFDRIVERS para utilizar el 
// codigo fuente siempre en modo que él o ella considere conveniente,
// incluida la copia, la compilacion, su modificacion Y la redistribucion,
// con o sin modificaciones. Ninguna licencia o patentes de IFDRivers 
// está implicita en la presente licencia.
// 
// El usuario del codigo fuente debera entender que IFDRIVERS no puede 
// proporcionar apoyo técnico para el modulo y no sera Responsable 
// de las consecuencias del uso del programa. 
//
// Todas las comunicaciones, incluida esta, no deben ser removidos 
// del modulo sin el consentimiento previo por escrito de IFDRIVERS

////////////////////////////////////////////////////
//// Syntax: ESTADO($byVar1)
////////////////////////////////////////////////////
FUNCTION ESTADO( $byVar1) 
{
  $strBuff = "@ESTADO" . "|" . $byVar1 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: CIERRE($byVar1, $byVar2)
////////////////////////////////////////////////////
FUNCTION CIERRE( $byVar1, $byVar2) 
{
  $strBuff = "@CIERRE" . "|" . $byVar1  . "|" . $byVar2 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: CIERREZ()
////////////////////////////////////////////////////
FUNCTION CIERREZ() 
{
  $strBuff = "@CIERREZ";
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: CIERREX()
////////////////////////////////////////////////////
FUNCTION CIERREX() 
{
  $strBuff = "@CIERREX";
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: AUDITORIAF($strVar1, $strVar2, $byVar3)
////////////////////////////////////////////////////
FUNCTION AUDITORIAF( $strVar1, $strVar2, $byVar3) 
{
  $strBuff = "@AUDITORIAF" . "|" . $strVar1  . "|" . $strVar2  . "|" . $byVar3 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: AUDITORIAZ($nVar1, $nVar2, $byVar3)
////////////////////////////////////////////////////
FUNCTION AUDITORIAZ( $nVar1, $nVar2, $byVar3) 
{
  $strBuff = "@AUDITORIAZ" . "|" . $nVar1  . "|" . $nVar2  . "|" . $byVar3 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: PREFERENCIA($byVar1, $byVar2, $byVar3, $byVar4, $strVar5, $strVar6, $strVar7)
////////////////////////////////////////////////////
FUNCTION PREFERENCIA( $byVar1, $byVar2, $byVar3, $byVar4, $strVar5, $strVar6, $strVar7) 
{
  $strBuff = "@PREFERENCIA" . "|" . $byVar1  . "|" . $byVar2  . "|" . $byVar3  . "|" . $byVar4  . "|" . $strVar5  . "|" . $strVar6  . "|" . $strVar7 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: LEEPREFERENCIA($byVar1, $byVar2, $byVar3, $byVar4, $byVar5)
////////////////////////////////////////////////////
FUNCTION LEEPREFERENCIA( $byVar1, $byVar2, $byVar3, $byVar4, $byVar5) 
{
  $strBuff = "@LEEPREFERENCIA" . "|" . $byVar1  . "|" . $byVar2  . "|" . $byVar3  . "|" . $byVar4  . "|" . $byVar5 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: NOFISABRE($byVar1, $byVar2)
////////////////////////////////////////////////////
FUNCTION NOFISABRE( $byVar1, $byVar2) 
{
  $strBuff = "@NOFISABRE" . "|" . $byVar1  . "|" . $byVar2 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: NOFISITEM($strVar1)
////////////////////////////////////////////////////
FUNCTION NOFISITEM( $strVar1) 
{
  $strBuff = "@NOFISITEM" . "|" . $strVar1 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: NOFISCIERRA($byVar1)
////////////////////////////////////////////////////
FUNCTION NOFISCIERRA( $byVar1) 
{
  $strBuff = "@NOFISCIERRA" . "|" . $byVar1 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: AVANZAHOJA($nVar1)
////////////////////////////////////////////////////
FUNCTION AVANZAHOJA( $nVar1) 
{
  $strBuff = "@AVANZAHOJA" . "|" . $nVar1 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: CORTAPAPEL()
////////////////////////////////////////////////////
FUNCTION CORTAPAPEL() 
{
  $strBuff = "@CORTAPAPEL";
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: PONEFECHORA($strVar1, $strVar2)
////////////////////////////////////////////////////
FUNCTION PONEFECHORA( $strVar1, $strVar2) 
{
  $strBuff = "@PONEFECHORA" . "|" . $strVar1  . "|" . $strVar2 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: PIDEFECHORA()
////////////////////////////////////////////////////
FUNCTION PIDEFECHORA() 
{
  $strBuff = "@PIDEFECHORA";
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: PONEENCABEZADO($nVar1, $strVar2)
////////////////////////////////////////////////////
FUNCTION PONEENCABEZADO( $nVar1, $strVar2) 
{
  $strBuff = "@PONEENCABEZADO" . "|" . $nVar1  . "|" . $strVar2 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: PIDEENCABEZADO($nVar1)
////////////////////////////////////////////////////
FUNCTION PIDEENCABEZADO( $nVar1) 
{
  $strBuff = "@PIDEENCABEZADO" . "|" . $nVar1 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: ZONAS($nVar1, $nVar2, $nVar3, $nVar4, $nVar5)
////////////////////////////////////////////////////
FUNCTION ZONAS( $nVar1, $nVar2, $nVar3, $nVar4, $nVar5) 
{
  $strBuff = "@ZONAS" . "|" . $nVar1  . "|" . $nVar2  . "|" . $nVar3  . "|" . $nVar4  . "|" . $nVar5 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: OFFSET($byVar1, $byVar2, $byVar3, $nVar4, $byVar5, $nVar6)
////////////////////////////////////////////////////
FUNCTION OFFSET( $byVar1, $byVar2, $byVar3, $nVar4, $byVar5, $nVar6) 
{
  $strBuff = "@OFFSET" . "|" . $byVar1  . "|" . $byVar2  . "|" . $byVar3  . "|" . $nVar4  . "|" . $byVar5  . "|" . $nVar6 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: LEEZONAS($byVar1, $byVar2, $byVar3, $nVar4)
////////////////////////////////////////////////////
FUNCTION LEEZONAS( $byVar1, $byVar2, $byVar3, $nVar4) 
{
  $strBuff = "@LEEZONAS" . "|" . $byVar1  . "|" . $byVar2  . "|" . $byVar3  . "|" . $nVar4 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: CLEARZONEDAT($byVar1, $byVar2, $byVar3, $byVar4)
////////////////////////////////////////////////////
FUNCTION CLEARZONEDAT( $byVar1, $byVar2, $byVar3, $byVar4) 
{
  $strBuff = "@CLEARZONEDAT" . "|" . $byVar1  . "|" . $byVar2  . "|" . $byVar3  . "|" . $byVar4 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: CLEARUSERDAT($byVar1, $byVar2)
////////////////////////////////////////////////////
FUNCTION CLEARUSERDAT( $byVar1, $byVar2) 
{
  $strBuff = "@CLEARUSERDAT" . "|" . $byVar1  . "|" . $byVar2 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: FACTABRE($byVar1, $byVar2, $byVar3, $byVar4, $byVar5, $strVar6, $byVar7, $byVar8, $strVar9, $strVar10, $strVar11, $strVar12, $byVar13, $strVar14, $strVar15, $strVar16, $strVar17, $strVar18, $byVar19)
////////////////////////////////////////////////////
FUNCTION FACTABRE( $byVar1, $byVar2, $byVar3, $byVar4, $byVar5, $strVar6, $byVar7, $byVar8, $strVar9, $strVar10, $strVar11, $strVar12, $byVar13, $strVar14, $strVar15, $strVar16, $strVar17, $strVar18, $byVar19) 
{
  $strBuff = "@FACTABRE" . "|" . $byVar1  . "|" . $byVar2  . "|" . $byVar3  . "|" . $byVar4  . "|" . $byVar5  . "|" . $strVar6  . "|" . $byVar7  . "|" . $byVar8  . "|" . $strVar9  . "|" . $strVar10  . "|" . $strVar11  . "|" . $strVar12  . "|" . $byVar13  . "|" . $strVar14  . "|" . $strVar15  . "|" . $strVar16  . "|" . $strVar17  . "|" . $strVar18  . "|" . $byVar19 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: FACTITEM($strVar1, $dblVar2, $dblVar3, $dblVar4, $byVar5, $nVar6, $dblVar7, $strVar8, $strVar9, $strVar10, $dblVar11, $dblVar12)
////////////////////////////////////////////////////
FUNCTION FACTITEM( $strVar1, $dblVar2, $dblVar3, $dblVar4, $byVar5, $nVar6, $dblVar7, $strVar8, $strVar9, $strVar10, $dblVar11, $dblVar12) 
{
  $strBuff = "@FACTITEM" . "|" . $strVar1  . "|" . $dblVar2  . "|" . $dblVar3  . "|" . $dblVar4  . "|" . $byVar5  . "|" . $nVar6  . "|" . $dblVar7  . "|" . $strVar8  . "|" . $strVar9  . "|" . $strVar10  . "|" . $dblVar11  . "|" . $dblVar12 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: FACTSUBTOTAL($byVar1, $strVar2)
////////////////////////////////////////////////////
FUNCTION FACTSUBTOTAL( $byVar1, $strVar2) 
{
  $strBuff = "@FACTSUBTOTAL" . "|" . $byVar1  . "|" . $strVar2 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: FACTPAGO($strVar1, $dblVar2, $byVar3)
////////////////////////////////////////////////////
FUNCTION FACTPAGO( $strVar1, $dblVar2, $byVar3) 
{
  $strBuff = "@FACTPAGO" . "|" . $strVar1  . "|" . $dblVar2  . "|" . $byVar3 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: FACTPERCEP($strVar1, $byVar2, $dblVar3, $dblVar4)
////////////////////////////////////////////////////
FUNCTION FACTPERCEP( $strVar1, $byVar2, $dblVar3, $dblVar4) 
{
  $strBuff = "@FACTPERCEP" . "|" . $strVar1  . "|" . $byVar2  . "|" . $dblVar3  . "|" . $dblVar4 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: FACTCIERRA($byVar1, $byVar2, $strVar3)
////////////////////////////////////////////////////
FUNCTION FACTCIERRA( $byVar1, $byVar2, $strVar3) 
{
  $strBuff = "@FACTCIERRA" . "|" . $byVar1  . "|" . $byVar2  . "|" . $strVar3 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: FACTCANCEL()
////////////////////////////////////////////////////
FUNCTION FACTCANCEL() 
{
  $strBuff = "@FACTCANCEL";
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: PAUSA($nVar1)
////////////////////////////////////////////////////
FUNCTION PAUSA( $nVar1) 
{
  $strBuff = "@PAUSA" . "|" . $nVar1 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: SINCRO()
////////////////////////////////////////////////////
FUNCTION SINCRO() 
{
  $strBuff = "@SINCRO";
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: TRANSPOABRE()
////////////////////////////////////////////////////
FUNCTION TRANSPOABRE() 
{
  $strBuff = "@TRANSPOABRE";
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: TRANSPOPIDE()
////////////////////////////////////////////////////
FUNCTION TRANSPOPIDE() 
{
  $strBuff = "@TRANSPOPIDE";
  $nError = IF_WRITE(strBuff);
  return $nError;
}

////////////////////////////////////////////////////
//// Syntax: TAMANO($nVar1, $nVar2)
////////////////////////////////////////////////////
FUNCTION TAMANO( $nVar1, $nVar2) 
{
  $strBuff = "@TAMANO" . "|" . $nVar1  . "|" . $nVar2 ;
  $nError = IF_WRITE(strBuff);
  return $nError;
}
?>