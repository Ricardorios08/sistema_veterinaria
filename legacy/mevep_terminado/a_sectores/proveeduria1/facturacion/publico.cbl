       IDENTIFICATION DIVISION.                            
       PROGRAM-ID. PUBLICO.
      *                   facturacion individual IMP FISCAL
       ENVIRONMENT DIVISION.
       CONFIGURATION SECTION.
       SOURCE-COMPUTER.  RMC.
       OBJECT-COMPUTER.  RMC.
       SPECIAL-NAMES.    DECIMAL-POINT IS COMMA.
       INPUT-OUTPUT SECTION.
       FILE-CONTROL.
            COPY SLMAESTO.
            COPY SLMAEVIA.
            COPY SLSUMAE.
            COPY SLSUMOV.
            COPY SLSUOPE.
            COPY SLDEOPE.
            COPY SLDEMOV.
            COPY SLMOVSTO.
            COPY SLMAETAS.
            COPY SLMAEALI.
            COPY SLMOVFAC.
            COPY SLIVAVEN.
            COPY SLCOMOV.
            COPY SLMAENUM.
            SELECT STFIS ASSIGN TO RANDOM,
                   "/home/prueba/comandos.txt"
                   ; ORGANIZATION LINE SEQUENTIAL.
            SELECT IFENC ASSIGN TO RANDOM, "/usr/archi/IFENC"
                   ; ORGANIZATION LINE SEQUENTIAL.
            SELECT IFDEL ASSIGN TO RANDOM, "/usr/archi/IFDEL"
                   ; ORGANIZATION LINE SEQUENTIAL.
       DATA DIVISION.
       FILE SECTION.
           COPY FDMAESTO.
           COPY FDMAEVIA.
           COPY FDSUMAE.
           COPY FDSUMOV. 
           COPY FDSUOPE.
           COPY FDDEOPE.
           COPY FDDEMOV.
           COPY FDMOVSTO.
           COPY FDMAETAS.
           COPY FDMAEALI.
           COPY FDMOVFAC.
           COPY FDIVAVEN.
           COPY FDCOMOV.  
           COPY FDMAENUM.
       FD  STFIS  LABEL RECORD STANDARD.
       01  RFIS   PIC X(130).
       01  RFIF   PIC X(30).
       FD  IFENC  LABEL RECORD STANDARD.
       01  IFEN   PIC X(30).
       FD  IFDEL  LABEL RECORD STANDARD.
       01  IFDE   PIC XX.
       WORKING-STORAGE SECTION.
       77  ZFUN     PIC 99     COMP-1       VALUE ZEROS.
       77  ZFAC     PIC ZZZ.ZZZ.
       77  ZRET     PIC 99     COMP-1       VALUE 58.
       77  ZALE     PIC 99     COMP-1       VALUE 27.
       77  WFIN     PIC 9      VALUE 0.
       77  X        PIC 9      VALUE 0.
       77  UPO1     PIC 99     VALUE 0.
       77  SUB      PIC 99     VALUE 0.
       77  PMAR     PIC 9      VALUE 0.
       77  WBUS     PIC 9      VALUE 0.
       77  WRES   PIC X        VALUE SPACES.
       77  WB10   PIC X(10)    VALUE SPACES.
       77  WB26   PIC X(26)    VALUE SPACES.
       77  WB65   PIC X(65)    VALUE SPACES.
       77  WB78   PIC X(78)    VALUE SPACES.
       77  WB8R   PIC X(80)    VALUE SPACES.
       77  WB76   PIC X(77)    VALUE SPACES.
       77  WB80   PIC X(80)    VALUE SPACES.
       77  WALF   PIC X(35)    VALUE SPACES.
       77  LIDO   PIC X(80)    VALUE SPACES.
       77  WDE1   PIC X(5)     VALUE SPACES.
       77  WDEPA  PIC 99       VALUE ZEROS.
       77  WITEM  PIC 9(3)     VALUE ZEROS.
       77  WDESC  PIC X(20)    VALUE SPACES.
       77  WPUBL  PIC 9(6)V99  VALUE ZEROS.
       77  WIVA   PIC 9(6)V9(4)  VALUE ZEROS.
       77  WREC   PIC 9(9)V9(4)  VALUE ZEROS.
       77  WPAR   PIC 9(9)V9(4)  VALUE ZEROS.
       77  TBRU   PIC 9(9)V99  VALUE ZEROS.
       77  TIVA   PIC 9(9)V99  VALUE ZEROS.
       77  TREC   PIC 9(9)V99  VALUE ZEROS.
       77  TPER   PIC 9(8)V99  VALUE ZEROS.
       77  TSUB   PIC 9(9)V99  VALUE ZEROS.
       77  TNET   PIC 9(8)V99  VALUE ZEROS.
       77  WEJE   PIC 9        VALUE ZEROS.
       77  WLIVA  PIC 99V9     VALUE ZEROS.
       77  WITE   PIC 9        VALUE ZEROS.
       77  WTIP   PIC 9        VALUE ZEROS.
       77  WFAP   PIC 9(6)     VALUE ZEROS.
       77  WFAC   PIC 9(6)     VALUE ZEROS.
       77  RFEC   PIC 9(8)     VALUE ZEROS.
       77  RVEN   PIC 99       VALUE ZEROS.
       77  RDEP   PIC 99       VALUE ZEROS.
       77  WTIC   PIC 9        VALUE ZEROS.
       77  WREM   PIC 9(8)     VALUE ZEROS.
       77  PFAC   PIC 9(6)     VALUE ZEROS.
       77  PVEN   PIC 99       VALUE ZEROS.
       77  PDEP   PIC 99       VALUE ZEROS.
       77  PAYN   PIC X(25)    VALUE SPACES.
       77  PGAN   PIC X(14)    VALUE SPACES.
       77  PCAL   PIC X(15)    VALUE SPACES.
       77  PPUE   PIC X(5)     VALUE SPACES.
       77  PPOS   PIC 9999     VALUE ZEROS.
       77  PREF   PIC X(10)    VALUE SPACES.
       77  PLOC   PIC X(12)    VALUE SPACES.
       77  VRED   PIC X(10).
       77  WLIN   PIC 99       VALUE ZEROS.
       77  ILIN   PIC 99       VALUE ZEROS.
       77  CLIN   PIC 99       VALUE ZEROS.
       77  LIN    PIC 99       VALUE ZEROS.
       77  PTVTA  PIC 9        VALUE ZEROS.
       77  PTIVA  PIC 9        VALUE ZEROS.
       77  PTDES  PIC 9        VALUE ZEROS.
       77  PPORC  PIC 99       VALUE ZEROS.
       77  WPORC  PIC 9V9999   VALUE ZEROS.
       77  WPLA   PIC 99       VALUE ZEROS.
       77  WDGR   PIC 9(8)V99  VALUE ZEROS.
       77  TDGR   PIC 9(8)V99  VALUE ZEROS.
       77  WRE1   PIC 9(8)V99  VALUE ZEROS.
       77  TRE1   PIC 9(8)V99  VALUE ZEROS.
       77  WRE3   PIC 9(8)V99  VALUE ZEROS.
       77  TRE3   PIC 9(8)V99  VALUE ZEROS.
       77  WCAL   PIC 9(8)V99  VALUE ZEROS.
       77  WPRE   PIC 9(4)V99  VALUE ZEROS.
       77  WENT   PIC 9(6)     VALUE ZEROS.
       77  WAUX   PIC 9(8)V99  VALUE ZEROS.
       77  UPRE   PIC ZZ.ZZZ,ZZ.
       77  NOMIM     PIC X(11) VALUE SPACES.
       77  REM31  PIC X(30) VALUE "           REMITO:            ".
       77  FAC31  PIC X(30) VALUE "         FAC AFEC:            ".
       01  WK-CLA       PIC X(40).
       01  RWK-CLA1     REDEFINES WK-CLA.
           03 1CLA      PIC X(3).
           03 FILLER    PIC X(37).
       01  RWK-CLA2     REDEFINES WK-CLA.
           03 2CLA      PIC X(6).
           03 FILLER    PIC X(34).
       01  RWK-CLA3     REDEFINES WK-CLA.
           03 3CLA      PIC X(10).
           03 FILLER    PIC X(30).
       01  WMUL         PIC X(10).
       01  RWK-MUL1     REDEFINES WMUL.
           03 CLA1      PIC XXX.
           03 FILLER    PIC X(7).
       01  RWK-MUL2     REDEFINES WMUL.
           03 CLA2      PIC X(6).
           03 FILLER    PIC X(4).
       01  RWK-MUL      REDEFINES WMUL.
           03 LM        PIC X OCCURS 10 TIMES.
       01  FECHAS.
           03 FECI  PIC 9(8).
           03 FECI1 REDEFINES FECI.
              05 IAA PIC 9999.
              05 IMM PIC 99.
              05 IDD PIC 99.
           03 FECD   PIC 9(8).
           03 FECD1 REDEFINES FECD.
              05 DDD PIC 99.
              05 DMM PIC 99.
              05 DAA PIC 9999.
           03 WVTO   PIC 9(8).
           03 WVTO1 REDEFINES WVTO.
              05 WVD PIC 99.
              05 WVM PIC 99.
              05 WVA PIC 9999.
       01  WFIS1.
           03 FILLER PIC X(10) VALUE "@FACTABRE|".
           03 F-NRO1 PIC 9(5).
           03 FILLER PIC X(5)  VALUE "|F|C|".
           03 F-LET1 PIC X.
           03 FILLER PIC X(10) VALUE "|1|P|10|I|".
           03 F-IVA  PIC X.
           03 FILLER PIC X     VALUE "|".
           03 F-NOM  PIC X(20).
           03 FILLER PIC X     VALUE "|".
           03 F-DE1  PIC X.
           03 FILLER PIC X     VALUE "|".
           03 F-TID  PIC X(4).
           03 FILLER PIC X     VALUE "|".
           03 F-CUI  PIC 9(11).
           03 FILLER PIC X(3)  VALUE "|N|".
           03 F-DIR  PIC X(20).
           03 FILLER PIC X     VALUE "|".
           03 F-POS  PIC 9(4).
           03 FILLER PIC XX    VALUE "  ".
           03 F-LOC  PIC X(15).
           03 FILLER PIC X     VALUE "|".
           03 F-DE2  PIC X.
           03 FILLER PIC X     VALUE "|".
           03 F-DE3  PIC X.
           03 FILLER PIC X     VALUE "|".
           03 F-DE4  PIC X.
       01  WFIS2.
           03 FILLER PIC X(10) VALUE "@FACTITEM|".
           03 F-NRO2 PIC 9(5).
           03 FILLER PIC X     VALUE "|".
           03 F-DES  PIC X(20).
           03 FILLER PIC X     VALUE "|".
           03 F-CAN  PIC 9(5)V999.
           03 FILLER PIC X     VALUE "|".
           03 F-PRE  PIC 9(7)V99.
           03 FILLER PIC X(1)  VALUE "|". 
           03 F-IVAN PIC 9(4).
           03 FILLER PIC X(9)  VALUE "|M|00001|".
           03 F-AJU  PIC V9(8).
           03 FILLER PIC X     VALUE "|".
           03 F-DE5  PIC X.
           03 FILLER PIC X     VALUE "|".
           03 F-DE6  PIC X.
           03 FILLER PIC X     VALUE "|".
           03 F-DE7  PIC X.
           03 FILLER PIC X     VALUE "|".
           03 F-REC  PIC 9(4).
       01  WFIS3.
           03 FILLER PIC X(10) VALUE "@FACTPAGO|".
           03 F-NRO3 PIC 9(5).
           03 FILLER PIC X     VALUE "|".
           03 F-COND PIC X(8).
           03 FILLER PIC X     VALUE "|".
           03 F-TOT  PIC 9(7)V99.
           03 FILLER PIC XX    VALUE "|T".
       01  WFIS4.
           03 FILLER PIC X(12) VALUE "@FACTCIERRA|".
           03 F-NRO4 PIC 9(5).
           03 FILLER PIC XXX   VALUE "|F|".
           03 F-LET4 PIC X.
           03 FILLER PIC X(6)  VALUE "|FINAL".
       01  WFIS5.
           03 FILLER PIC X(12) VALUE "@FACTPERCEP|".
           03 F-NRO5 PIC 9(5).
           03 FILLER PIC X     VALUE "|".
           03 F-LPE  PIC X(25).
           03 FILLER PIC XXX   VALUE "|O|".
           03 F-PER  PIC 9(7)V99.
       01  EDICIONES.
           03 EFECH PIC 99/99/9999.
           03 ECLA  PIC Z(4).
           03 ECOD  PIC ZZBZ(4).
           03 ENUM  PIC ZZZZ.
           03 EIMP  PIC -.---.---,--.
           03 ECANT PIC ZZZ.ZZZ.
           03 ECAND PIC Z.ZZZ,ZZ.
           03 DPREC PIC ZZZ.ZZZ,ZZ.
           03 DPORC PIC ZZ,ZZ.
           03 WCANT PIC 9(6).
           03 WCAND PIC 9(6)V99.
           03 PCTA  PIC 9(8).
           03 PCTA1 REDEFINES PCTA.
             05 PCT1 PIC 99.
             05 PCT2 PIC 9(6).
       01  TABLA-LEIVA.
           03 FILLER PIC X(10) VALUE "Res.Inscr.".
           03 FILLER PIC X(10) VALUE "Res.No Ins".
           03 FILLER PIC X(10) VALUE "Monotribut".
           03 FILLER PIC X(10) VALUE "Exento    ".
           03 FILLER PIC X(10) VALUE "Cons Final".
           03 FILLER PIC X(10) VALUE "Ignorada  ".
       01  TABLA-LEIVA-R REDEFINES TABLA-LEIVA.
           03 LEIVA  PIC X(10) OCCURS 6 TIMES.
       01  TABLA-LVTA.
           03 FILLER PIC X(3)  VALUE "Cdo".
           03 FILLER PIC X(3)  VALUE "C C".
           03 FILLER PIC X(3)  VALUE "N/C".
       01  TABLA-LVTA-R REDEFINES TABLA-LVTA.
           03 LVTA   PIC X(3)  OCCURS 3 TIMES.
       01  AR-TAS.
           03 WTAS-O   OCCURS 2 TIMES.
              05 COIVA PIC 9V999.
              05 TAIVA PIC 99V9.
              05 DAIVA PIC 9V999.
              05 CORIV PIC 9V999.
              05 TARIV PIC 99V9.
              05 CODGR PIC 9V999.
              05 TADGR PIC 99V9.
       01  LDIR.
           03 LCAL1  PIC X(14).
           03 LPUE1  PIC BX(5).
       01  LTI3.
           03 LCUI1  PIC X(13).
           03 LCUI2  REDEFINES LCUI1.
              05 LC1 PIC 99.
              05 LC2 PIC X.
              05 LC3 PIC 9(8).
              05 LC4 PIC X.
              05 LC5 PIC 9.
           03 NCUI1  PIC 9(11).
           03 NCUI2  REDEFINES NCUI1.
              05 NC1 PIC 99.
              05 NC3 PIC 9(8).
              05 NC5 PIC 9.
       01  LTO2.
           03 LSUBT  PIC Z.ZZZ.ZZZ,ZZB.
           03 LPERC  PIC ZZ.ZZZ,ZZB.
           03 LSUMA  PIC ZZZ.ZZZ,ZZB.
           03 LIVAI  PIC ZZZ.ZZZ,ZZBB.
           03 LRECI  PIC ZZ.ZZZ.ZZZ,ZZBBBB.
           03 LNETO  PIC ZZZ.ZZZ.ZZZ,ZZB.
       01  LLIN.
           03 LCAN1  PIC 9(6)V999.
           03 LDES1  PIC X(20)B.
           03 LPRE1  PIC 9(6)V99.
           03 LIVA1  PIC 99V9.
           03 LIMP1  PIC 9(8)V99.
       01  RESERVA-REGISTRO.
           03 AREAS-REG           OCCURS 14 TIMES.
              05 RRCLA PIC 9(5).
              05 RRCOD PIC 9.
              05 RRCAN PIC 9(6).
              05 MICAN PIC 9(6).
              05 MICOM PIC 9(4)V999.
              05 MIUNI PIC X(15).
              05 RRPRE PIC 9(6)V99.
              05 RRDES PIC 9(6)V99.
              05 RRIVA PIC 9(6)V9(4).
              05 RRRIV PIC 9(6)V9(4).
              05 RRPOR PIC 99.
       01  LINEAS    PIC X(2904).
       01  LINEAS-1 REDEFINES LINEAS.
           03 PLIN   PIC X(132)   OCCURS 18 TIMES.
       01  LPIE.
           03 PIE1   PIC X(27).
           03 FILLER PIC XXX      VALUE SPACES.
           03 PIE2   PIC X(27).
       01  LIMAE.
           03 LCLA   PIC 99B999999B.
           03 LDES   PIC X(28).
       01  LISTO.
           03 LARA   PIC 99B999BB.
           03 LDEA   PIC X(30)BB.
           03 LUNA   PIC X(15).
       01  LITI1.
           03 FILLER PIC X(30) VALUE "FECHA:             VENDEDOR:  ".
           03 FILLER PIC X(30) VALUE "                 DEPOSITO:    ".
           03 FILLER PIC X(20) VALUE "   OPERACION:       ".
       01  LITI2.
           03 FILLER PIC X(30) VALUE "CUENTA:                       ".
           03 FILLER PIC X(30) VALUE "                              ".
           03 FILLER PIC X(20) VALUE "CUIT:               ".
       01  LITI3.
           03 FILLER PIC X(30) VALUE "PLAN:        DESCUENTO:       ".
           03 LITI31 PIC X(30) VALUE "                              ".
           03 FILLER PIC X(20) VALUE "IVA :               ".
       01  LITI4.
           03 FILLER PIC X(30) VALUE " OR CODIGO  DESCRIPCION       ".
           03 FILLER PIC X(30) VALUE "               CONTENIDO     P".
           03 FILLER PIC X(20) VALUE "R.UNIT. CANTIDAD DT ".
       01  LITI5.
           03 FILLER PIC X(30) VALUE "tqqnqqqqqqnqqqqqqqqqqqqqqqqqqq".
           03 FILLER PIC X(30) VALUE "qqqqqqqqqqqnqqqqqqqqqqqqqqqnqq".
           03 FILLER PIC X(20) VALUE "qqqqqqqnqqqqqqqqnqqu".
       01  LIDI1.
           03 FILLER PIC X(30) VALUE "x  x      x                   ".
           03 FILLER PIC X(30) VALUE "           x               x  ".
           03 FILLER PIC X(20) VALUE "       x        x  x".
       01  LIDI2.
           03 FILLER PIC X(30) VALUE "tqqvqqqqqqvqqqqqqqqqqqqqqqwqqq".
           03 FILLER PIC X(30) VALUE "qqqqqqqqqqqvqqqqqqqqqqwqqqqvqq".
           03 FILLER PIC X(20) VALUE "qqqqqqqvqqqqqqqqvqqu".
       01  LIDI3.
           03 FILLER PIC X(30) VALUE "x                         x   ".
           03 FILLER PIC X(30) VALUE "                      x       ".
           03 FILLER PIC X(20) VALUE "                   x".
       01  LIDI4.
           03 FILLER PIC X(30) VALUE "mqqqqqqqqqqqqqqqqqqqqqqqqqvqqq".
           03 FILLER PIC X(30) VALUE "qqqqqqqqqqqqqqqqqqqqqqvqqqqqqq".
           03 FILLER PIC X(20) VALUE "qqqqqqqqqqqqqqqqqqqj".
           
     **    lineas para pantalla
       COPY WTUKI.
       PROCEDURE DIVISION.
       ABRE. OPEN INPUT SCTAS. MOVE 0 TO FCLA.
       CARGA-TASAS.
             READ SCTAS NEXT AT END GO FIN-TASAS.          
             MOVE FCLA TO X.
             MOVE FIV1 TO TAIVA(X).
             DIVIDE FIV1 BY 100 GIVING COIVA(X) ROUNDED.
             MOVE COIVA(X) TO DAIVA(X) ADD 1 TO DAIVA(X).
             MOVE FRI1 TO TARIV(X).
             DIVIDE FRI1 BY 100 GIVING CORIV(X) ROUNDED.
             MOVE FRPE TO TADGR(X).
             DIVIDE FRPE BY 100 GIVING CODGR(X) ROUNDED.
             GO TO CARGA-TASAS.
       FIN-TASAS.
             CLOSE SCTAS OPEN INPUT STMAE SUMAE.
             INSPECT LIDO REPLACING CHARACTERS BY "Q".
             ACCEPT FECI FROM DATE.
             ADD TUKI TO IAA.
             MOVE IAA TO DAA MOVE IMM TO DMM MOVE IDD TO DDD.
       PANTA.
             DISPLAY LITI1 LINE 1 ERASE            
             DISPLAY LITI4 LINE 4 POSITION 01.
             DISPLAY LITI5 LINE 5 CONTROL "GRAPHICS".
             DISPLAY LITI2 LINE 2 REVERSE.
       P1.   DISPLAY LITI3 LINE 3 REVERSE.
             MOVE 04 TO LIN.
             DISPLAY "x" LINE LIN POSITION 01 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 04 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 11 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 42 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 58 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 68 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 77 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 80 CONTROL "GRAPHICS".
             MOVE 0 TO SUB.
             DISPLAY WB80 LINE 24.
       CICLO-LINEAS.
             ADD 1 TO SUB. IF SUB > 14 GO FIN-LINEAS.
             ADD 5 SUB GIVING LIN.
             DISPLAY "x" LINE LIN POSITION 01 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 04 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 11 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 42 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 58 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 68 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 77 CONTROL "GRAPHICS".
             DISPLAY "x" LINE LIN POSITION 80 CONTROL "GRAPHICS".
             GO TO CICLO-LINEAS.
       FIN-LINEAS.
             DISPLAY LIDI1 LINE 06 CONTROL "GRAPHICS".
             DISPLAY LIDI1 LINE 07 CONTROL "GRAPHICS".
             DISPLAY LIDI2 LINE 20 CONTROL "GRAPHICS".
             DISPLAY LIDI3 LINE 21 CONTROL "GRAPHICS".
             DISPLAY LIDI3 LINE 22 CONTROL "GRAPHICS".
             DISPLAY LIDI3 LINE 23 CONTROL "GRAPHICS".
             DISPLAY LIDI4 LINE 24 CONTROL "GRAPHICS".
       FIN-PANTA.   EXIT.
       CUADRO.
             DISPLAY "SUMA BRUTA: "  LINE 21 POSITION 2.
             DISPLAY "PERCEPCION: "  LINE 22 POSITION 2.
             DISPLAY "SUB-TOTAL : "  LINE 23 POSITION 2.
             DISPLAY "I.V.A.    : "  LINE 21 POSITION 28.
             DISPLAY "RECARGO   : "  LINE 22 POSITION 28.
             DISPLAY "TOTAL     : "  LINE 23 POSITION 28
                                        REVERSE.
       ENTRA-DAT.
             DISPLAY WB10 LINE 1 POSITION 07.
             ACCEPT FECD LINE 1 POSITION 07 PROMPT NO BEEP
                ON EXCEPTION ZALE GO TO CIERRA-PROCESO.
             IF FECD = 0 
                MOVE IAA TO DAA MOVE IMM TO DMM MOVE IDD TO DDD.
             IF DAA > IAA MOVE RFEC TO FECD.
             MOVE FECD TO EFECH DISPLAY EFECH LINE 1 POSITION 07.
             MOVE FECD TO WVTO RFEC.
       ENTRA-VEN.
             ACCEPT PVEN LINE 1 POSITION 30 PROMPT ECHO NO BEEP
                    ON EXCEPTION ZALE GO TO ENTRA-DAT.
             IF PVEN = 0 MOVE RVEN TO PVEN
                         DISPLAY PVEN LINE 1 POSITION 30.
             OPEN INPUT SIVIA.
             MOVE PVEN TO VCLA.
             READ SIVIA INVALID KEY CLOSE SIVIA GO TO ENTRA-VEN.
             CLOSE SIVIA.
             MOVE VDES TO VRED.
             DISPLAY VRED LINE 1 POSITION 33.
             MOVE PVEN TO RVEN.
       ENTRA-DEP.
             ACCEPT PDEP LINE 1 POSITION 58 PROMPT ECHO NO BEEP
                    ON EXCEPTION ZALE GO TO ENTRA-VEN.
             IF PDEP = 0 MOVE RDEP TO PDEP
                         DISPLAY PDEP LINE 1 POSITION 58.
             OPEN INPUT SIVIA.
             MOVE PDEP TO VCLA ADD 1000 TO VCLA.
             READ SIVIA INVALID KEY CLOSE SIVIA GO TO ENTRA-DEP.
             CLOSE SIVIA.
             MOVE PDEP TO RDEP.
       CON1. 
             DISPLAY "FACTURAS      NOTA CREDITO" 
                      LINE 21 POSITION 54.
             DISPLAY "1= Contado    3= Contado  "
                      LINE 22 POSITION 54.
             DISPLAY "2= Cta cte    4= Cta cte  "
                      LINE 23 POSITION 54.
             ACCEPT PTVTA LINE 1 POSITION 75 PROMPT ECHO NO BEEP
                    ON EXCEPTION ZALE GO TO ENTRA-DEP.
             MOVE 1 TO PMAR.
             IF PTVTA < 1 OR PTVTA > 4 GO TO CON1.
             IF PTVTA = 4 MOVE 3 TO PTVTA MOVE 0 TO PMAR.
             DISPLAY LVTA(PTVTA) LINE 1 POSITION 77.
             IF PTVTA < 3 MOVE REM31 TO LITI31
                ELSE      MOVE FAC31 TO LITI31.
             DISPLAY LITI3 LINE 3 REVERSE.
             PERFORM LIMPIA.
       ENTRA-CLI.
             DISPLAY "^R: Registrar " LINE 21 POSITION 54.
             DISPLAY "^P: Consulta  " LINE 22 POSITION 54.
             DISPLAY "^D: Contado   " LINE 23 POSITION 54.
***********  ACCEPT PCT1 LINE 2 POSITION 9 PROMPT NO BEEP ECHO
***********         REVERSE ON EXCEPTION ZFUN GO TO VER-FUN.
             MOVE 1 TO PCT1.
             ACCEPT PCT2 LINE 2 POSITION 11 PROMPT NO BEEP ECHO
                    REVERSE ON EXCEPTION ZFUN GO TO VER-FUN.
       LIMPIA. DISPLAY WB26 LINE 21 POSITION 54.
               DISPLAY WB26 LINE 22 POSITION 54.
               DISPLAY WB26 LINE 23 POSITION 54.
       LL.   IF PCTA < 1     GO ENTRA-CLI.
             GO TO LEE-CLIENTE.
       VER-FUN.
             PERFORM LIMPIA.                    
             IF ZFUN = 27 GO TO PANTA.
             IF ZFUN = 18                              
                          CALL "/usr/obje/ssacsu.cob"
                          GO TO PANTA.
             IF ZFUN = 16 GO TO CONSULTA.
             IF ZFUN = 04 GO TO PASAJE.
             GO TO ENTRA-CLI.
       PASAJE.
           MOVE 0 TO SCLA.
           DISPLAY WB8R LINE 20 DISPLAY WB8R LINE 21.
           DISPLAY WB8R LINE 22 DISPLAY WB8R LINE 23.
           DISPLAY WB8R LINE 24.
           DISPLAY LIDO LINE 20 CONTROL "GRAPHICS".
           DISPLAY LIDO LINE 24 CONTROL "GRAPHICS".
           DISPLAY "L" LINE 20 POSITION 1 CONTROL "GRAPHICS".
           DISPLAY "K" LINE 20 POSITION 80 CONTROL "GRAPHICS".
           DISPLAY "X" LINE 21 POSITION 1 CONTROL "GRAPHICS".
           DISPLAY "X" LINE 22 POSITION 1 CONTROL "GRAPHICS".
           DISPLAY "X" LINE 23 POSITION 1 CONTROL "GRAPHICS".
           DISPLAY "X" LINE 21 POSITION 80 CONTROL "GRAPHICS".
           DISPLAY "X" LINE 22 POSITION 80 CONTROL "GRAPHICS".
           DISPLAY "X" LINE 23 POSITION 80 CONTROL "GRAPHICS".
           DISPLAY "J" LINE 24 POSITION 80 CONTROL "GRAPHICS".
           DISPLAY "M" LINE 24 POSITION 1 CONTROL "GRAPHICS".
            DISPLAY "Cliente:" LINE 21 POSITION 2.
            DISPLAY "Domicil:" LINE 22 POSITION 2.
            DISPLAY "CUIT   :" LINE 23 POSITION 2.
            DISPLAY "CONDICION IVA:" LINE 23 POSITION 30.
            DISPLAY "CONDICION I.B:" LINE 23 POSITION 60.
            MOVE 0 TO SAPE PCTA.
       C1.  ACCEPT SAPE LINE 21 POSITION 10 PROMPT ECHO NO BEEP
                   ON EXCEPTION ZALE GO TO ENTRA-CLI.
            IF SAPE = SPACES MOVE "VENTA CONTADO " TO SAPE
                             DISPLAY SAPE LINE 21 POSITION 10.
       C2.  ACCEPT SCAL LINE 22 POSITION 10 PROMPT ECHO NO BEEP
                   ON EXCEPTION ZALE GO TO C1.
       C3.  ACCEPT SPUE LINE 22 POSITION 34 PROMPT ECHO NO BEEP
                   ON EXCEPTION ZALE GO TO C2.
       C4.  ACCEPT SLOC LINE 22 POSITION 40 PROMPT ECHO NO BEEP
                   ON EXCEPTION ZALE GO TO C3.
       C5.  ACCEPT SCUI LINE 23 POSITION 10 PROMPT ECHO NO BEEP
                   ON EXCEPTION ZALE GO TO C4.
       C6.  ACCEPT SIVA LINE 23 POSITION 45 PROMPT ECHO NO BEEP
                   ON EXCEPTION ZALE GO TO C5.
       C7.  ACCEPT SCIB LINE 23 POSITION 75 PROMPT ECHO NO BEEP
                   ON EXCEPTION ZALE GO TO C6.
            PERFORM FIN-LINEAS PERFORM CUADRO.
            GO TO MUE-CLIENTE.
       CONSULTA.
            DISPLAY "Digite Denominacion" LINE 21 POSITION 54
                     BLINK.
            ACCEPT WMUL  LINE 2 POSITION 20 PROMPT ECHO NO BEEP
                   REVERSE.
            PERFORM FIN-LINEAS.                    
            MOVE 3 TO WBUS.
            IF LM(7) = SPACES MOVE 2 TO WBUS.
            IF LM(4) = SPACES MOVE 1 TO WBUS.
            MOVE WMUL TO SAPE.
            START SUMAE KEY NOT < SAPE INVALID KEY GO TO CONSULTA.
       REPONE-1.
            MOVE 20 TO WLIN MOVE 0 TO WFIN.
            MOVE 2 TO UPO1.
       LEE-BUMAE.
            READ SUMAE NEXT AT END MOVE 1 TO WFIN GO TO CORTE-N.
            IF WMUL = SPACES       GO TO MUE-BUMAE.
            MOVE SAPE TO WK-CLA.
            GO TO CONTRO1 CONTRO2 CONTRO3 DEPENDING WBUS.
       CONTRO1.
            IF 1CLA NOT = CLA1 MOVE 1 TO WFIN GO TO CORTE-N.
            GO TO MUE-BUMAE.
       CONTRO2.
            IF 2CLA NOT = CLA2 MOVE 1 TO WFIN GO TO CORTE-N.
            GO TO MUE-BUMAE.
       CONTRO3.
            IF 3CLA NOT = WMUL MOVE 1 TO WFIN GO TO CORTE-N.
            GO TO MUE-BUMAE.
       MUE-BUMAE.
           MOVE SCLA TO LCLA MOVE SAPE TO LDES.                     
           ADD 1 TO WLIN.
           IF WLIN > 23 GO TO FIN-CUADRO.
       REE-BUMAE.
           DISPLAY LIMAE LINE WLIN POSITION UPO1.
           GO TO LEE-BUMAE.
       FIN-CUADRO.
           IF UPO1 > 40 GO TO CORTE-N.
           ADD 40 TO UPO1.
           MOVE 21 TO WLIN.
           GO TO REE-BUMAE.
       CORTE-N.
           ACCEPT PCTA LINE 2 POSITION 9 PROMPT ECHO NO BEEP
                  REVERSE ON EXCEPTION ZALE GO TO PANTA.
           IF PCTA = 0    GO TO VER-WFIN.
           PERFORM FIN-LINEAS PERFORM CUADRO.
           GO TO LEE-CLIENTE.
       VER-WFIN.
           IF WFIN = 1 MOVE 0 TO WFIN GO TO PANTA.
           MOVE 21 TO WLIN MOVE 0 TO WFIN.
           MOVE 2 TO UPO1.
           GO TO REE-BUMAE.
       BUSCA-TIPO.
           ADD 1 TO PCT1.
           IF PCT1 < 26 GO TO LEE-CLIENTE.
           GO TO ENTRA-CLI.
       LEE-CLIENTE.
             DISPLAY PCTA LINE 2 POSITION 9 REVERSE.
             MOVE PCTA TO SCLA.
             READ SUMAE INVALID KEY GO TO BUSCA-TIPO.
       MUE-CLIENTE.
             MOVE SAPE TO WALF.
             DISPLAY WALF LINE 2 POSITION 20 REVERSE.
             DISPLAY SCUI LINE 2 POSITION 66 REVERSE.
             DISPLAY SIVA LINE 3 POSITION 66 REVERSE.
             IF SIVA NOT = 0
                DISPLAY LEIVA(SIVA) LINE 3 POSITION 68 REVERSE.
             MOVE SIVA TO PTIVA MOVE SCON TO WPLA.
             DISPLAY WPLA LINE 3 POSITION 7 REVERSE.
       CON2. PERFORM LIMPIA.
             DISPLAY "1 = Descuento Total"  LINE 21 POSITION 54.
             DISPLAY "2 = Desc. por artic." LINE 22 POSITION 54.
             DISPLAY "ENTER: Sin descuento" LINE 23 POSITION 54.
             ACCEPT PTDES LINE 3 POSITION 25 PROMPT ECHO NO BEEP
                    REVERSE ON EXCEPTION ZALE
                    DISPLAY LITI2 LINE 2 REVERSE
                    DISPLAY LITI3 LINE 3 REVERSE
                    GO TO ENTRA-CLI.
             IF PTDES > 2 GO CON2.
       CON3. DISPLAY "^I: modifica IVA    " LINE 21 POSITION 54.
             DISPLAY "^P: modifica PLAN   " LINE 22 POSITION 54.
             DISPLAY "Digite remito       " LINE 23 POSITION 54.
       ENTRA-REM.
             ACCEPT WREM LINE 3 POSITION 50 PROMPT ECHO NO BEEP
                    REVERSE ON EXCEPTION ZFUN GO TO VER-CORREC.
             PERFORM LIMPIA.
             GO TO LIMPIA-LINEA.
       VER-CORREC.
             IF ZFUN = 58 GO TO H1.
             IF ZFUN = 16 GO TO H2.
             GO TO CON3.
       H1.   ACCEPT PTIVA LINE 3 POSITION 66 PROMPT ECHO NO BEEP
                    REVERSE ON EXCEPTION ZALE GO TO CON2.
             PERFORM LIMPIA.
             IF PTIVA = 0 MOVE SIVA TO PTIVA.
             IF PTIVA < 1 OR PTIVA > 5 GO TO H1.
             DISPLAY LEIVA(PTIVA) LINE 3 POSITION 68 REVERSE.
             MOVE PTIVA TO SIVA.
             GO TO CON3.
       H2.   ACCEPT WPLA  LINE 3 POSITION 07 PROMPT ECHO NO BEEP
                    REVERSE ON EXCEPTION ZALE GO TO ENTRA-REM.
             PERFORM LIMPIA.
             GO TO ENTRA-REM.
       LIMPIA-LINEA.
             MOVE 0 TO TBRU TIVA TREC TPER TSUB TNET. 
             MOVE 0 TO WIVA WREC CLIN.
       CICLO-BIN.
             ADD 1 TO CLIN. IF CLIN > 14 GO LIMPIA-LINEA-1.
             MOVE 0 TO RRCOD(CLIN) RRCAN(CLIN) RRPRE(CLIN).
             MOVE 0 TO RRCLA(CLIN) RRIVA(CLIN) RRRIV(CLIN).
             MOVE 0 TO OART(CLIN) OCAN(CLIN) OPRE(CLIN).
             MOVE 0 TO ODES(CLIN) OIVA(CLIN) OREC(CLIN).
             MOVE 0 TO MICAN(CLIN) MICOM(CLIN).
             MOVE SPACES TO PLIN(CLIN) MIUNI(CLIN).
             GO TO CICLO-BIN.
       LIMPIA-LINEA-1.
             MOVE 6 TO LIN  MOVE 1 TO CLIN.
       ACEP-ARTI.
             DISPLAY LIDI1 LINE LIN CONTROL "GRAPHICS".
             MOVE 0 TO WDEPA WITEM WCANT.
             MOVE SPACES TO WDESC.
             DISPLAY "ESC: anula factura       " LINE 21 POSITION 54.
             DISPLAY "TAB: fin factura         " LINE 22 POSITION 54.
             DISPLAY "^P : consulta  ^V: vuelve" LINE 23 POSITION 54.
             DISPLAY CLIN LINE LIN POSITION 2.
             ACCEPT WDEPA LINE LIN POSITION 5 PROMPT ECHO NO BEEP
                    ON EXCEPTION ZFUN GO VER-FUN1.
       ENTRA-NRO.
             ACCEPT WITEM LINE LIN POSITION 7 PROMPT ECHO NO BEEP
                    ON EXCEPTION ZRET GO ACEP-ARTI.
             PERFORM LIMPIA.                     
             IF WDEPA NOT NUMERIC GO ACEP-ARTI.
             IF WITEM NOT NUMERIC GO ACEP-ARTI.
             GO TO LECTURA-ARTICULO.
       VER-FUN1.
             PERFORM LIMPIA.                        
             IF ZFUN = 22 SUBTRACT 1 FROM LIN
                          SUBTRACT 1 FROM CLIN MOVE CLIN TO WLIN
                          PERFORM BORRA-LINEA THRU SACA-LINEA
                          PERFORM PONE-TOTAL
                          MOVE SPACES TO PLIN(CLIN)
                          MOVE 0 TO RRCLA(CLIN)
                          GO ACEP-ARTI.
             IF ZFUN = 27 GO TO PANTA.
             IF ZFUN = 16 GO TO CONSUART.
             IF ZFUN = 58 SUBTRACT 1 FROM CLIN GO TO FIN-FACTURA.
             GO TO ACEP-ARTI.
       CONSUART.
             PERFORM LIMPIA.
            DISPLAY "Digite Denominacion:" LINE 21 POSITION 54.
            ACCEPT WMUL LINE LIN POSITION 12 PROMPT ECHO NO BEEP.
            PERFORM FIN-LINEAS.                   
            MOVE 3 TO WBUS.
            IF LM(7) = SPACES MOVE 2 TO WBUS.
            IF LM(4) = SPACES MOVE 1 TO WBUS.
            MOVE WMUL TO ADESC
            START STMAE KEY NOT < ADESC INVALID KEY GO TO CONSULTA.
       REPONE-2.
            MOVE 20 TO WLIN MOVE 0 TO WFIN.
            MOVE 2 TO UPO1.
       LEE-ARMAE.
            READ STMAE NEXT AT END MOVE 1 TO WFIN GO TO CORTE-S.
            IF WMUL = SPACES       GO TO MUE-ARMAE.
            MOVE ADESC TO WK-CLA.
            GO TO KONTRO1 KONTRO2 KONTRO3 DEPENDING WBUS.
       KONTRO1.
            IF 1CLA NOT = CLA1 MOVE 1 TO WFIN GO TO CORTE-S.
            GO TO MUE-ARMAE.
       KONTRO2.
            IF 2CLA NOT = CLA2 MOVE 1 TO WFIN GO TO CORTE-S.
            GO TO MUE-ARMAE.
       KONTRO3.
            IF 3CLA NOT = WMUL MOVE 1 TO WFIN GO TO CORTE-S.
            GO TO MUE-ARMAE.
       MUE-ARMAE.
           MOVE REGNUM TO LARA MOVE ADESC TO LDEA MOVE AUNID TO LUNA.
           ADD 1 TO WLIN.
           IF WLIN > 23 GO TO CORTE-S.
           DISPLAY LISTO LINE WLIN POSITION UPO1.
           GO TO LEE-ARMAE.
       CORTE-S.
           DISPLAY "Enter para seguir" LINE LIN POSITION 12.
           ACCEPT WDEPA LINE LIN POSITION 5 PROMPT ECHO NO BEEP.
           IF WDEPA = 0    GO TO VER-WFIN-A.
           ACCEPT WITEM LINE LIN POSITION 7 PROMPT ECHO NO BEEP.
           PERFORM FIN-LINEAS PERFORM CUADRO PERFORM PONE-TOTAL.
           GO TO LECTURA-ARTICULO.
       VER-WFIN-A.
           IF WFIN = 1 PERFORM FIN-LINEAS PERFORM CUADRO
                       PERFORM PONE-TOTAL
                       MOVE 0 TO WFIN GO TO ACEP-ARTI.
           GO TO REPONE-2.
       LECTURA-ARTICULO.
             MOVE WDEPA TO AGRUP MOVE WITEM TO AITEM.
             READ STMAE INVALID KEY GO ACEP-ARTI.            
             IF AIVAC = 0 GO CONTINUA-UNO.
             MOVE TAIVA(AIVAC) TO WLIVA.
       CONTINUA-UNO.
             DISPLAY ADESC LINE LIN POSITION 12.
             DISPLAY AUNID LINE LIN POSITION 43.
             IF WPLA = 81 MOVE APRE1 TO WCAL GO TO CALCULO-IVA.
             IF WPLA = 82 MOVE APRE2 TO WCAL GO TO CALCULO-IVA.
             OPEN INPUT STALI.
             MOVE WPLA TO FALI.
             READ STALI INVALID KEY CLOSE STALI GO PIDE-PLAN.
             MULTIPLY AACTU BY FIB1 GIVING WDGR ROUNDED.
             DIVIDE WDGR BY 100 GIVING TDGR ROUNDED.
             MULTIPLY AACTU BY FRE1 GIVING WRE1 ROUNDED.
             DIVIDE WRE1 BY 100 GIVING TRE1 ROUNDED.
             ADD AACTU TDGR TRE1 GIVING WCAL.
             IF ATRAT < 2 ADD FRE2 TO WCAL.
             IF ATRAT = 1 IF AMARG > 0 ADD AMARG TO FRE3.
             IF ATRAT = 3 IF AMARG > 0 ADD AMARG TO FRE3.
             IF ATRAT = 0 IF AMARG > 0 SUBTRACT AMARG FROM FRE3.
             IF ATRAT = 2 IF AMARG > 0 SUBTRACT AMARG FROM FRE3.
             MULTIPLY WCAL BY FRE3 GIVING WRE3 ROUNDED.
             DIVIDE WRE3 BY 100 GIVING TRE3 ROUNDED.
             ADD TRE3 TO WCAL
             MULTIPLY ACOME BY WCAL GIVING WCAL ROUNDED.
             MOVE WCAL TO WPUBL.
             CLOSE STALI.
             GO TO CALCULO-IVA.
       PIDE-PLAN.
       CALCULO-IVA.
             IF PTIVA = 4 GO TO MUESTRA-PRECIO.
             IF AIVAC = 0 GO TO MUESTRA-PRECIO.
             MULTIPLY WCAL BY COIVA(AIVAC) GIVING WIVA ROUNDED.
             ADD WIVA WCAL GIVING WPUBL.              
             IF PTIVA = 2
             MULTIPLY WCAL BY CORIV(AIVAC) GIVING WREC ROUNDED.
             ADD WREC TO WPUBL.
       MUESTRA-PRECIO.
             IF PTIVA > 2 MOVE WPUBL TO UPRE
                ELSE      MOVE WCAL TO UPRE.
             DISPLAY UPRE LINE LIN POSITION 59.
       HASTA.  EXIT.
       PAN-ARTI.
             DISPLAY "ESC: anula factura       " LINE 21 POSITION 54.
             DISPLAY "^P : cambia precio       " LINE 22 POSITION 54.
             DISPLAY "^V : vuelve              " LINE 23 POSITION 54.
       ACEP-CANT.
             IF SSUB = 13050 OR SSUB = 17030 OR SSUB = 3001
                       GO TO ENTRA-UNI.
       SIG-CANT.
             DISPLAY "       " LINE LIN POSITION 69.
             ACCEPT WCANT LINE LIN POSITION 69 PROMPT ECHO NO BEEP
                    ON EXCEPTION ZFUN GO TO VER-FUN-CAN.
             IF SSUB = 13050 MOVE WCANT TO MICAN(CLIN)
                       MOVE ACOME TO MICOM(CLIN)
                       MULTIPLY WCANT BY ACOME GIVING WCAND ROUNDED
                       MOVE WCAND TO ECAND
                       DISPLAY ECAND LINE LIN POSITION 69 GO PARCIAL.
             IF SSUB = 17030 MOVE WCANT TO MICAN(CLIN)
                       MOVE ACOME TO MICOM(CLIN)
                       MULTIPLY WCANT BY ACOME GIVING WCAND ROUNDED
                       MOVE WCAND TO ECAND
                       DISPLAY ECAND LINE LIN POSITION 69 GO PARCIAL.
             IF SSUB = 3001  MOVE WCANT TO MICAN(CLIN)
                       MOVE ACOME TO MICOM(CLIN)
                       MULTIPLY WCANT BY ACOME GIVING WCAND ROUNDED
                       MOVE WCAND TO ECAND
                       DISPLAY ECAND LINE LIN POSITION 69 GO PARCIAL.
             MOVE WCANT TO ECANT DISPLAY ECANT LINE LIN POSITION 69.
             MOVE WCANT TO WCAND.
             GO TO PARCIAL.
       ENTRA-UNI.
             ACCEPT MIUNI(CLIN) LINE LIN POSITION 43 PROMPT ECHO NO BEEP.
             GO TO SIG-CANT.
       PARCIAL.
             IF PTIVA > 2 MULTIPLY WCAND BY WPUBL GIVING WPAR ROUNDED
                          ADD WPAR TO TBRU MOVE WPAR TO LIMP1
                          MOVE WPUBL TO LPRE1 GO PONE-TOTAL.
             MULTIPLY WCAND BY WCAL GIVING WPAR ROUNDED.
             ADD WPAR TO TBRU.
             MOVE WCAL TO LPRE1 MOVE WPAR TO LIMP1.
             MULTIPLY WCAND BY WIVA GIVING WPAR ROUNDED.
             ADD WPAR TO TIVA.
             IF PTIVA = 2 MULTIPLY WCAND BY WREC GIVING WPAR ROUNDED
                          ADD WPAR TO TREC.
       PONE-TOTAL.
             IF SCIB = 1 MULTIPLY TBRU BY FRPE GIVING WAUX ROUNDED
                         DIVIDE WAUX BY 100 GIVING TPER ROUNDED.
             IF SCIB = 2 MULTIPLY TBRU BY 1    GIVING WAUX ROUNDED
                         DIVIDE WAUX BY 100 GIVING TPER ROUNDED.
             IF SCIB = 3  MOVE 0 TO TPER.
             IF PTIVA > 2 MOVE 0 TO TPER.
             ADD TBRU TPER GIVING TSUB.
             ADD TSUB TIVA TREC GIVING TNET.
             MOVE TBRU TO EIMP DISPLAY EIMP LINE 21 POSITION 14.
             MOVE TPER TO EIMP DISPLAY EIMP LINE 22 POSITION 14.
             MOVE TSUB TO EIMP DISPLAY EIMP LINE 23 POSITION 14.
             MOVE TIVA TO EIMP DISPLAY EIMP LINE 21 POSITION 40.
             MOVE TREC TO EIMP DISPLAY EIMP LINE 22 POSITION 40.
             MOVE TNET TO EIMP DISPLAY EIMP LINE 23 POSITION 40.
       ARMA-RESERVA.
             MOVE REGNUM TO RRCLA(CLIN).
             MOVE WCANT  TO RRCAN(CLIN).
             MOVE WCAL   TO RRPRE(CLIN).
             MOVE WIVA   TO RRIVA(CLIN).
             MOVE WREC   TO RRRIV(CLIN).
             IF PTVTA = 3   MOVE 2 TO RRCOD(CLIN)
                ELSE        MOVE 1 TO RRCOD(CLIN).
       ARMA-LINEA.
             IF AIVAC = 0 MOVE 1 TO AIVAC.
             MOVE TAIVA(AIVAC) TO LIVA1.
             MOVE ADESC  TO LDES1
             IF PTIVA < 3 MOVE WCAL TO LPRE1
                ELSE      MOVE WPUBL  TO LPRE1.
             MOVE WCANT  TO LCAN1.
             IF SSUB = 13050 OR SSUB = 17030 OR SSUB = 3001
                MOVE WCAND TO LCAN1.
             MOVE LLIN TO  PLIN(CLIN).
       FIN-PROCE.  EXIT.
       CONTROL-CUERPO.
             IF CLIN > 13 GO FIN-FACTURA.
             ADD 1 TO CLIN.
             ADD 1 TO LIN.
             GO ACEP-ARTI.
       VER-FUN-CAN.
             PERFORM LIMPIA.
             IF ZFUN = 27 GO TO PANTA.
             IF ZFUN = 16 GO TO CAMBIA-PRECIO.
             GO TO ACEP-CANT.
       CAMBIA-PRECIO.
             DISPLAY "         " LINE LIN POSITION 59.
             ACCEPT WENT LINE LIN POSITION 60 PROMPT ECHO NO BEEP.
             DIVIDE WENT BY 100 GIVING WPRE ROUNDED.
             MOVE WPRE TO WCAL.
             GO TO CALCULO-IVA.
       FIN-FACTURA.
             DISPLAY "ESC: anula factura       " LINE 21 POSITION 54.
             DISPLAY "TAB: fin factura         " LINE 22 POSITION 54.
             DISPLAY "Nro linea a corregir:    " LINE 23 POSITION 54.
             ACCEPT WLIN LINE 23 POSITION 77 PROMPT ECHO NO BEEP
                    ON EXCEPTION ZFUN GO TO VER-FUN-FIN.
             IF WLIN NOT NUMERIC      GO TO FIN-FACTURA.
             IF WLIN < 1 OR WLIN > 14 GO TO FIN-FACTURA.
             ADD WLIN 5 GIVING LIN. 
             DISPLAY WLIN LINE LIN POSITION 2 REVERSE.
       ENTRA-COR.
             DISPLAY "^E : anula linea         " LINE 21 POSITION 54.
             DISPLAY "TAB: fin correccion      " LINE 22 POSITION 54.
             DISPLAY "^P:precio  ^K:cantidad " LINE 23 POSITION 54.
             ACCEPT WITE LINE 23 POSITION 78 PROMPT ECHO NO BEEP
                    ON EXCEPTION ZFUN GO TO VER-FUN-COR.
             GO TO ENTRA-COR.
       VER-FUN-FIN.
             IF ZFUN = 27 GO TO PANTA.
             IF ZFUN = 58 GO TO OK-PRT.
             GO TO FIN-FACTURA.
       VER-FUN-COR.
             IF ZFUN = 05 GO TO BORRA-LINEA.
             IF ZFUN = 58 GO TO OK-PRT.
             IF ZFUN = 16 PERFORM BORRA-LINEA THRU SACA-LINEA 
                          MOVE WLIN TO CLIN
                          PERFORM CAMBIA-PRECIO THRU HASTA
                          PERFORM PARCIAL THRU FIN-PROCE
                          GO TO FIN-FACTURA.
             IF ZFUN = 11 PERFORM BORRA-LINEA THRU SACA-LINEA 
                          MOVE WLIN TO CLIN
                          PERFORM ACEP-CANT THRU FIN-PROCE
                          GO TO FIN-FACTURA.
             GO TO ENTRA-COR.
       BORRA-LINEA.
             IF PTIVA > 2 ADD RRPRE(WLIN) RRIVA(WLIN) RRRIV(WLIN)
                              GIVING WPUBL
                          MULTIPLY RRCAN(WLIN) BY WPUBL       
                                   GIVING WPAR ROUNDED
                          SUBTRACT WPAR FROM TBRU GO SACA-LINEA.
             MULTIPLY RRCAN(WLIN) BY RRPRE(WLIN)  
                      GIVING WPAR ROUNDED.
             SUBTRACT WPAR FROM TBRU.
             MULTIPLY RRCAN(WLIN) BY RRIVA(WLIN) 
                      GIVING WPAR ROUNDED.
             SUBTRACT WPAR FROM TIVA.
             IF PTIVA = 2 MULTIPLY RRCAN(WLIN) BY RRRIV(WLIN)
                      GIVING WPAR ROUNDED
                      SUBTRACT WPAR FROM TREC.
       SACA-LINEA. EXIT.
       SIGUE-LINEA.
             DISPLAY LIDI1 LINE WLIN CONTROL "GRAPHICS".
             MOVE 0 TO RRCOD(WLIN) RRCAN(WLIN) RRPRE(WLIN).
             MOVE 0 TO RRCLA(WLIN) RRIVA(WLIN) RRRIV(WLIN).
             MOVE 0 TO MICAN(WLIN) MICOM(WLIN).
             MOVE SPACES TO PLIN(WLIN) MIUNI(WLIN).
             GO TO FIN-FACTURA.
*********************************************
       OK-PRT.
             OPEN I-O STNUM.
             IF PTVTA = 3 MOVE 2 TO NNUM
                ELSE      MOVE 1 TO NNUM.
             READ STNUM INVALID KEY MOVE 0 TO NFAC NFAB NFIL.
             IF PTIVA < 3 ADD 1 TO NFAC MOVE NFAC TO PFAC
                ELSE      ADD 1 TO NFAB MOVE NFAB TO PFAC.
       VEMOS-FAC.
             PERFORM LIMPIA.
             DISPLAY "Numero Factura:" LINE 21 POSITION 54.
             MOVE PFAC TO ZFAC DISPLAY ZFAC LINE 21 POSITION 70.
             DISPLAY "ESC: anula TAB: imprime" LINE 22 POSITION 54.
             DISPLAY "Corrige numero:" LINE 23 POSITION 54.
       ENTRA-FAC.
             ACCEPT WFAC LINE 23 POSITION 70 PROMPT ECHO NO BEEP
                    ON EXCEPTION ZFUN GO TO VER-NUMERO.
             IF WFAC = 0         GO TO VEMOS-FAC.
             IF WFAC NOT NUMERIC GO TO VEMOS-FAC.
             OPEN INPUT FAMOV MOVE WFAC TO OCOM.
             IF PTIVA > 2 MOVE 2 TO OLET ELSE MOVE 1 TO OLET.
             IF PTVTA < 3 MOVE 1 TO OCOD ELSE MOVE 3 TO OCOD.
             READ FAMOV INVALID KEY CLOSE FAMOV GO NRO-ORI.
             CLOSE FAMOV.
             GO TO ENTRA-FAC.
       NRO-ORI.
             DISPLAY "SN" LINE 22 POSITION 78 BLINK.
       ENTRA-S.
             ACCEPT WRES LINE 23 POSITION 79 PROMPT NO BEEP.
             IF WRES = "s" MOVE "S" TO WRES.
             IF WRES = "n" MOVE "N" TO WRES.
             IF WRES = "N" GO TO ENTRA-FAC.
             IF WRES NOT = "S"   GO TO ENTRA-S.
             MOVE WFAC TO PFAC GO TO M2.
       VER-NUMERO.
             IF ZFUN = 27 CLOSE STNUM GO TO PANTA.
             IF ZFUN = 58 GO TO M2.
             GO TO VEMOS-FAC.
       M2.   IF PTIVA < 3 MOVE PFAC TO NFAC
                ELSE      MOVE PFAC TO NFAB.
****** M3.   REWRITE RNUM INVALID KEY MOVE 0 TO NFIL.      
             CLOSE STNUM.
       RUT-IMPRESION.
             MOVE PFAC TO F-NRO1 F-NRO2 F-NRO3 F-NRO4 F-NRO5.
             MOVE SAPE TO F-NOM
             MOVE SCAL TO LCAL1 MOVE SPUE TO LPUE1.
             MOVE LDIR TO F-DIR.
             MOVE SPOS TO F-POS MOVE SLOC TO F-LOC.
             MOVE SCUI TO LCUI1.
             MOVE LC1 TO NC1 MOVE LC3 TO NC3 MOVE LC5 TO NC5.
             MOVE NCUI1 TO F-CUI.
             MOVE "CUIT" TO F-TID.
             IF SIVA = 5 MOVE "DNI" TO F-TID MOVE 0 TO F-CUI.
             IF SIVA  = 1 MOVE "I" TO F-IVA.
             IF SIVA  = 2 MOVE "N" TO F-IVA.
             IF SIVA  = 3 MOVE "M" TO F-IVA.
             IF SIVA  = 4 MOVE "E" TO F-IVA.
             IF SIVA  = 5 MOVE "F" TO F-IVA.
             IF PTVTA = 1 MOVE "CONTADO"  TO F-COND.
             IF PTVTA = 2 MOVE "CTA CTE" TO F-COND.
             IF PTVTA = 3 MOVE "CTA CTE" TO F-COND.
             IF PMAR  = 1 MOVE "CONTADO" TO F-COND.
             IF PTIVA < 3 MOVE "A" TO F-LET1 F-LET4
                     ELSE MOVE "B" TO F-LET1 F-LET4.
             MOVE TNET TO F-TOT MOVE TPER TO F-PER.
             MOVE "PERC DGR" TO F-LPE.
       ESCRIBE.
            OPEN OUTPUT STFIS INPUT IFENC IFDEL.
            READ IFENC AT END MOVE SPACES TO IFEN.
            READ IFDEL AT END MOVE SPACES TO IFDE.
            CLOSE IFENC IFDEL.
            MOVE IFDE TO F-DE1 F-DE2 F-DE3 F-DE4.
            WRITE RFIF FROM IFEN.
            WRITE RFIS FROM WFIS1.                             
            MOVE 1 TO ILIN.
       CICLO-LIN.
             IF PLIN(ILIN) = SPACES GO COMPARA-LIN.
             MOVE PLIN(ILIN) TO LLIN.   
             MOVE LCAN1 TO F-CAN MOVE LDES1 TO F-DES.
             MOVE LPRE1 TO F-PRE MOVE 0 TO F-AJU F-REC.
             MULTIPLY LIVA1 BY 100 GIVING F-IVAN.
             MOVE IFDE TO F-DE5 F-DE6 F-DE7.
             WRITE RFIS FROM WFIS2.
       COMPARA-LIN.
             IF ILIN = CLIN   GO FIN-CUERPO.
             ADD 1 TO ILIN    GO CICLO-LIN.
       FIN-CUERPO.
             IF TPER NOT = 0 WRITE RFIS FROM WFIS5.
             WRITE RFIS FROM WFIS3.
             WRITE RFIS FROM WFIS4.
             CLOSE STFIS.
       FIN-IMPRESION.
             GO TO ACTUALIZA.
*********************************************
       ACTUALIZA.
************ GO TO SOLO-ACTUALIZA.
             DISPLAY "ESC: anula factura       " LINE 21 POSITION 54.
             DISPLAY "TAB: actualiza           " LINE 22 POSITION 54.
             DISPLAY "                         " LINE 23 POSITION 54.
             ACCEPT WRES LINE 22 POSITION 70 PROMPT NO BEEP
                    ON EXCEPTION ZFUN GO VER-SALIDA2.
             GO TO ACTUALIZA.
       VER-SALIDA2.
             PERFORM LIMPIA.
             IF ZFUN = 27 GO TO PANTA.
             IF ZFUN = 58 GO TO SOLO-ACTUALIZA.
             GO TO ACTUALIZA.
       SOLO-ACTUALIZA.
*************** graba iva
             OPEN I-O IVAVEN.
             MOVE DDD TO IDIA MOVE DMM TO IMES MOVE DAA TO IANO.
             MOVE PTVTA TO IOPE MOVE PFAC TO INRO MOVE PTIVA TO ITIV.
             MOVE PCTA TO ICLA MOVE SAPE TO IREF MOVE SCUI TO ICUI.
             IF PTIVA < 3 MOVE 1 TO ILET ELSE MOVE 2 TO ILET.
             MOVE 0 TO IGRA IEXE IIVA IDIF IREC IINT IRET ITOT.
             IF PTIVA = 4 MOVE TNET TO IEXE ITOT GO GRABA-IVA.
             IF PTIVA < 3 MOVE TBRU TO IGRA MOVE TIVA TO IIVA
                          MOVE TREC TO IREC MOVE TPER TO IRET
                          MOVE TNET TO ITOT GO GRABA-IVA.
             IF PTIVA > 2 DIVIDE TBRU BY DAIVA(1) GIVING WCAL ROUNDED
                          SUBTRACT WCAL FROM TBRU GIVING IIVA
                          MOVE WCAL TO IGRA MOVE TBRU TO ITOT
                          GO GRABA-IVA.
       GRABA-IVA.
             WRITE RIVE INVALID KEY GO VERI-IVA.
       SALVAIVA.
             CLOSE IVAVEN.
*************** graba contabilidad
             OPEN I-O COMOV.
             MOVE IFEC TO ZFEC  MOVE PFAC TO ZNRO ZCOM.
             MOVE 444444 TO ZCTA MOVE 2 TO ZORD.
             IF PTVTA = 2 MOVE "VTA CTA CTE" TO ZREF
                ELSE      MOVE "VENTA CONTADO" TO ZREF.
             MOVE TNET TO ZIMC MOVE 0 TO ZIMD ZAFE.
       W-CRE.
             WRITE RCOMOV INVALID KEY ADD 1 TO ZORD GO W-CRE.
             IF PTVTA = 2 MOVE 111222 TO ZCTA
                ELSE      MOVE 111111 TO ZCTA.
             MOVE TNET TO ZIMD MOVE 0 TO ZIMC MOVE 1 TO ZORD.
       W-DEB.
             WRITE RCOMOV INVALID KEY ADD 1 TO ZORD GO W-DEB.
             CLOSE COMOV.
             IF PTVTA = 1 GO TO ACTUALIZA-STOCK.
             IF PTVTA = 2 GO TO ACTUALIZA-CTACTE.
             IF PMAR = 1  GO TO ACTUALIZA-STOCK.
*************** graba cta cte 
       ACTUALIZA-CTACTE.
             OPEN I-O SUMOV.
             IF PTVTA = 3 MOVE 22 TO NOPE
                ELSE      MOVE 11 TO NOPE.
             MOVE PCTA TO NCLA MOVE IFEC TO NFEC MOVE ILET TO NLET.
             MOVE PFAC TO NNRO MOVE ITOT TO NIMP MOVE PVEN TO NVIA.
             MOVE WVTO TO NVTO.
       GRABA-SUM.
           WRITE RSUM INVALID KEY MOVE 0 TO NNRO.                   
           CLOSE SUMOV OPEN I-O SUOPE.  
           IF NOPE = 11 GO TO DEBITOS.                                  
           MOVE WREM TO WFAP.
       CREDITOS.
           MOVE PCTA TO DCLA MOVE WFAP TO DNRO.
           MOVE 0    TO DAPU.
           READ SUOPE INVALID KEY GO TO SIN-NRO-FAC.
       TRATA-FAC.
           IF NIMP > DSAL GO TO MAY-SAL.
       AMORTIZA.
           SUBTRACT NIMP FROM DSAL.
           IF DSAL = 0 GO TO CANCELA.
       SALE-SUB.
           MOVE FECD TO DPAG.
           REWRITE ROPE INVALID KEY STOP "NO REG".
           GO TO ACTUALIZA-CLI.
       CANCELA.
           DELETE SUOPE INVALID KEY STOP "NO DEL".
           GO TO ACTUALIZA-CLI.
       MAY-SAL.
           SUBTRACT DSAL FROM NIMP.
           DELETE SUOPE INVALID KEY STOP "NO DEL".
       VEN-1.
           READ SUOPE NEXT AT END GO TO ACTUALIZA-CLI.
           IF DCLA NOT = PCTA       GO TO ACTUALIZA-CLI.
           IF NIMP > DSAL           GO TO MAY-SAL.
           GO TO AMORTIZA.
       SIN-NRO-FAC.
           MOVE PCTA TO DCLA MOVE ZEROS TO DNRO DAPU.
           START SUOPE KEY GREATER THAN CLAOPE INVALID KEY
                 GO TO ACTUALIZA-CLI.
           READ SUOPE NEXT AT END GO TO ACTUALIZA-CLI.
           IF DCLA NOT = PCTA       GO TO ACTUALIZA-CLI.
           GO TO TRATA-FAC.
       DEBITOS.
           MOVE PCTA TO DCLA MOVE PFAC TO DNRO DNRO1.
           MOVE FECD TO DEMI MOVE TNET TO DIMP DSAL 
           MOVE WVTO TO DVTO MOVE PVEN TO DVIA.
           MOVE 0    TO DAPU DPAG.  
       FIN-ARMA.
           WRITE ROPE INVALID KEY STOP "SATUR".
       ACTUALIZA-CLI.
           CLOSE SUOPE.         
************** graba stock        
       ACTUALIZA-STOCK.
             OPEN I-O STMOV FAMOV DEOPE DEMOV.
             MOVE IFEC TO JFEC OFEC CFEC.
             MOVE PFAC TO JCOM OCOM OCOM1 CNRO.
             MOVE SCLA TO OCLA MOVE 21 TO JCOD COPE.
             IF PTVTA = 3 MOVE 12 TO COPE.
             MOVE PVEN TO JVIA OVIA MOVE PDEP TO CCLA.
             MOVE 0 TO CLIN.
       CICLO-A1.
             ADD 1 TO CLIN. IF CLIN > 14 GO FIN-A1.
             IF RRCLA(CLIN) = ZEROS      GO CICLO-A1.
             MOVE RRCLA(CLIN) TO JART CART OART(CLIN).
             MOVE RRCAN(CLIN) TO OCAN(CLIN).
             MOVE RRCAN(CLIN) TO JCAN CCAN.
             MOVE CLIN TO JAPU.
             IF SSUB = 13050 MOVE MICAN(CLIN) TO JCAN CCAN.
             IF SSUB = 17030 MOVE MICAN(CLIN) TO JCAN CCAN.
             IF SSUB = 3001  MOVE MICAN(CLIN) TO JCAN CCAN.
             MOVE RRPRE(CLIN) TO OPRE(CLIN).
             IF SSUB = 13050 MULTIPLY RRPRE(CLIN) BY MICOM(CLIN)
                             GIVING RRPRE(CLIN) ROUNDED.
             IF SSUB = 17030 MULTIPLY RRPRE(CLIN) BY MICOM(CLIN)
                             GIVING RRPRE(CLIN) ROUNDED.
             IF SSUB = 3001  MULTIPLY RRPRE(CLIN) BY MICOM(CLIN)
                             GIVING RRPRE(CLIN) ROUNDED.
             MOVE RRPRE(CLIN) TO JPRE CPRE.
             MOVE RRDES(CLIN) TO ODES(CLIN).
             MOVE RRIVA(CLIN) TO OIVA(CLIN).
             MOVE RRRIV(CLIN) TO OREC(CLIN).
             IF RRCOD(CLIN) = 1 MOVE 21 TO JCOD
                           ELSE MOVE 12 TO JCOD.
       GRABA-JMOV.
             IF PDEP NOT = 1 GO TO TRATA-RESTO.
             WRITE JMOV INVALID KEY ADD 1 TO JAPU
                        GO TO GRABA-JMOV.
       TRATA-RESTO.
             IF PDEP = 1     GO TO CICLO-A1.
             MOVE CLIN TO CAPU.
       GRABA-RDEM.
             WRITE RDEM INVALID KEY ADD 1 TO CAPU
                        GO TO GRABA-RDEM.
             MOVE PDEP TO VDEP MOVE JART TO VART.
             READ DEOPE INVALID KEY   GO CICLO-A1.
             SUBTRACT JCAN FROM VSAL.
             MOVE FECD TO VFEM.
             REWRITE RVEH INVALID KEY GO CICLO-A1.
             GO TO CICLO-A1.
       FIN-A1.
             CLOSE STMOV DEOPE DEMOV.
             MOVE 1 TO OEST.
             MOVE TBRU TO OBRU  MOVE TPER TO OPER.   
             MOVE TIVA TO OTOI  MOVE TREC TO OTOR.  
             IF PTIVA < 3 MOVE 1 TO OLET ELSE MOVE 2 TO OLET.
             IF PTVTA < 3 MOVE 1 TO OCOD ELSE MOVE 3 TO OCOD.
             IF PTVTA = 1 MOVE 1 TO OOPE.
             IF PTVTA = 2 MOVE 2 TO OOPE.
             IF PTVTA = 3 MOVE 1 TO OOPE.
             IF PMAR = 0  MOVE 2 TO OOPE.
             MOVE PTIVA TO OTIV MOVE WPLA TO OPLA
             MOVE IREF TO OREF MOVE ICUI TO OCUI.
             MOVE PDEP TO ODEP.
             MOVE WREM TO OREM MOVE 0 TO OFIL ODTO.
             WRITE RFAC INVALID KEY MOVE 0 TO OCOM.
             CLOSE FAMOV.
             GO TO PANTA.        
       VERI-IVA.
             DISPLAY "Registro duplicado. Enter"
                     LINE 21 POSITION 54.
             ACCEPT WRES LINE 24 POSITION 79 PROMPT NO BEEP.
             GO TO SALVAIVA.
       CIERRA-PROCESO.
             CLOSE STMAE SUMAE.
       VUELTA. EXIT PROGRAM.
       ZZ.  STOP RUN.
       FIN-TAREA.
