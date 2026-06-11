<link href="../../menus.css" rel="stylesheet" type="text/css" />
<?php


$tipo_semana = 1;
$tipo_mes = 1;

$MESCOMPLETO[1] = 'Enero';
$MESCOMPLETO[2] = 'Febrero';
$MESCOMPLETO[3] = 'Marzo';
$MESCOMPLETO[4] = 'Abril';
$MESCOMPLETO[5] = 'Mayo';
$MESCOMPLETO[6] = 'Junio';
$MESCOMPLETO[7] = 'Julio';
$MESCOMPLETO[8] = 'Agosto';
$MESCOMPLETO[9] = 'Septiembre';
$MESCOMPLETO[10] = 'Octubre';
$MESCOMPLETO[11] = 'Noviembre';
$MESCOMPLETO[12] = 'Diciembre';

$MESABREVIADO[1] = 'Ene';
$MESABREVIADO[2] = 'Feb';
$MESABREVIADO[3] = 'Mar';
$MESABREVIADO[4] = 'Abr';
$MESABREVIADO[5] = 'May';
$MESABREVIADO[6] = 'Jun';
$MESABREVIADO[7] = 'Jul';
$MESABREVIADO[8] = 'Ago';
$MESABREVIADO[9] = 'Sep';
$MESABREVIADO[10] = 'Oct';
$MESABREVIADO[11] = 'Nov';
$MESABREVIADO[12] = 'Dic';

$SEMANACOMPLETA[0] = 'Domingo';
$SEMANACOMPLETA[1] = 'Lunes';
$SEMANACOMPLETA[2] = 'Martes';
$SEMANACOMPLETA[3] = 'Miércoles';
$SEMANACOMPLETA[4] = 'Jueves';
$SEMANACOMPLETA[5] = 'Viernes';
$SEMANACOMPLETA[6] = 'Sábado';

$SEMANAABREVIADA[0] = 'Dom';
$SEMANAABREVIADA[1] = 'Lun';
$SEMANAABREVIADA[2] = 'Mar';
$SEMANAABREVIADA[3] = 'Mie';
$SEMANAABREVIADA[4] = 'Jue';
$SEMANAABREVIADA[5] = 'Vie';
$SEMANAABREVIADA[6] = 'Sáb';

////////////////////////////////////
if($tipo_semana == 0){
$ARRDIASSEMANA = $SEMANACOMPLETA;
}elseif($tipo_semana == 1){
$ARRDIASSEMANA = $SEMANAABREVIADA;
}
if($tipo_mes == 0){
$ARRMES = $MESCOMPLETO;
}elseif($tipo_mes == 1){
$ARRMES = $MESABREVIADO;
}

if(!$dia) $dia = date(d);
if(!$mes) $mes = $mes1;
if(!$ano) $ano = "20".$anio1;

$dia = intval($dia);
$mes = intval($mes);
$ano = intval($ano);

$TotalDiasMes = date(t,mktime(0,0,0,$mes,$dia,$ano));
$DiaSemanaEmpiezaMes = date(w,mktime(0,0,0,$mes,1,$ano));
$DiaSemanaTerminaMes = date(w,mktime(0,0,0,$mes,$TotalDiasMes,$ano));
$EmpiezaMesCalOffset = $DiaSemanaEmpiezaMes;
$TerminaMesCalOffset = 6 - $DiaSemanaTerminaMes;
$TotalDeCeldas = $TotalDiasMes + $DiaSemanaEmpiezaMes + $TerminaMesCalOffset;


if($mes == 1){
$MesAnterior = 12;
$MesSiguiente = $mes + 1;
$AnoAnterior = $ano - 1;
$AnoSiguiente = $ano;
}elseif($mes == 12){
$MesAnterior = $mes - 1;
$MesSiguiente = 1;
$AnoAnterior = $ano;
$AnoSiguiente = $ano + 1;
}else{
$MesAnterior = $mes - 1;
$MesSiguiente = $mes + 1;
$AnoAnterior = $ano;
$AnoSiguiente = $ano;
$AnoAnteriorAno = $ano - 1;
$AnoSiguienteAno = $ano + 1;
}

?>
<style type="text/css">
<!--
.Estilo5 {
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	font-style: italic;
}
.Estilo7 {font-size: 12; }
.Estilo8 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo9 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
<table border='0' align='center' cellpadding='0' cellspacing='1' bordercolor='navy' style=\"font-family:arial;font-size:9px\">
  <tr>
    <td colspan='10'><table border='0' align='center' width='850' style="font-family:arial;font-size:9px">
      <!-- <tr>
<td width=\"1%\"><a href=\"$PHP_SELF?mes=$mes&ano=$AnoAnteriorAno\"><img src='atras2.gif' border='0'></a></td>
<td width=\"1%\"><a href=\"$PHP_SELF?mes=$MesAnterior&ano=$AnoAnterior\"><img src='atras.gif' border='0'></a></td>
<td width=\"1%\" colspan=\"1\" align=\"center\" nowrap><b> <?echo $ARRMES[$mes]." ".$ano;?> </b></td>
<td width=\"1%\"><a href=\"$PHP_SELF?mes=$MesSiguiente&ano=$AnoSiguiente\"><img src='avanzar.gif' border='0'></a></td>
<td width=\"1%\"><a href=\"$PHP_SELF?mes=$mes&ano=$AnoSiguienteAno\"><img src='avanzar2.gif' border='0'></a></td>
</tr> -->
    </table></td>
  </tr>
  <tr>
    <?php




foreach($ARRDIASSEMANA AS $key){

?>
    <td bgcolor='#B8B8B8'><div align="center"><b><?php echo $key;?></b></div></td>
    <?php
}


?>
  </tr>
  <?php

  $profesionales;

for($a=1;$a <= $TotalDeCeldas;$a++){
if(!$b) $b = 0;
if($b == 7) $b = 0;
if($b == 0) print '<tr>';
if(!$c) $c = 1;
if($a > $EmpiezaMesCalOffset AND $c <= $TotalDiasMes){
if($c == date(d) && $mes == date(m) && $ano == date(Y)){

?>
  <td bgcolor="#8FA5FA"><div align="center">
    <div align="center" class="Estilo8"><a href="agregar_turno.php?dia=<?php print("$c");?>&&cod_socio=<?php print("$cod_socio");?>&&mes1=<?php print("$mes1");?>&&anio1=<?php print("$anio1");?>&&profesionales=<?php print("$profesionales2");?>"><?php echo $c;?> AGREGAR </a>
            <?php include ("hoy2.php");?>
    </div>
    <br>
  </div></td>
      <?php
}elseif($b == 0 OR $b == 6){
?>
    <td bordercolor="#EEEEEE" bgcolor='#C9CFC7'><div align="rigth" class="Estilo7">
      <div align="center"><span class="Estilo5"><a href="agregar_turno.php?dia=<?php print("$c");?>&&cod_socio=<?php print("$cod_socio");?>&&mes1=<?php print("$mes1");?>&&anio1=<?php print("$anio1");?>&&profesionales=<?php print("$profesionales2");?>"><?php echo $c;?> AGREGAR </a>
        <?php include ("hoy2.php");?>
        </span></div>
    </div></td>
    <?php
}else{?>
      <td bgcolor="#C9CFC7"><div align="center" class="Estilo7 Estilo9"><a href="agregar_turno.php?dia=<?php print("$c");?>&&cod_socio=<?php print("$cod_socio");?>&&mes1=<?php print("$mes1");?>&&anio1=<?php print("$anio1");?>&&profesionales2=<?php print("$profesionales");?>"><?php echo $c;?> AGREGAR </a>
              <?php include ("hoy2.php");?>
    </div></td>
    <?php
}
$c++;
}else{
?>
    <td bgcolor="#C9CFC7"></td>
    <?php
}
if($b == 6) print '</tr>';
$b++;
}

?>
  <tr>
    <td colspan='10' align='center'></td>
  </tr>
</table>
