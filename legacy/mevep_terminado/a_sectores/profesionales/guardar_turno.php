<?php

$dia=$_REQUEST["dia"];
$mes1=$_REQUEST["mes1"];
$anio1=$_REQUEST["anio1"];


$dia  = str_pad($dia, 2, "0", STR_PAD_LEFT);  
$mes1  = str_pad($mes1, 2, "0", STR_PAD_LEFT);  




$fecha_turno = $anio1."-".$mes1."-".$dia;

$profesionales=$_REQUEST["profesionales"];


include ("../../conexiones/config.inc.php");


 $sql2="select * from profesionales where nro_profesional = '$profesionales'";
$result2 = $db->Execute($sql2);

$apellido=$result2->fields["apellido"];
$nombre=$result2->fields["nombre"];
$especialidad=$result2->fields["especialidad"];
$sexo=$result2->fields["sexo"];
$fecha_nacimiento=$result2->fields["fecha_nacimiento"];
$domicilio=$result2->fields["domicilio"];
$localidad=$result2->fields["localidad"];
$telefono=$result2->fields["telefono"];
$celular=$result2->fields["celular"];
$mail=$result2->fields["mail"];
$lunes=$result2->fields["lunes"];
$martes=$result2->fields["martes"];
$miercoles=$result2->fields["miercoles"];
$jueves=$result2->fields["jueves"];
$viernes=$result2->fields["viernes"];
$sabado=$result2->fields["sabado"];
$duracion_consulta=$result2->fields["duracion_consulta"];
$espacio_entre_turnos=$result2->fields["espacio_entre_turnos"];
 $cantidad_turnos_diarios=$result2->fields["cantidad_turnos_diarios"]+1;
$turno=$result2->fields["turno"];
 $horario_turno_manana=$result2->fields["horario_turno_manana"];
$horario_turno_tarde=$result2->fields["horario_turno_tarde"];



 



for($j = 1 ;$j < $cantidad_turnos_diarios ;$j++){


$columna1 = "col1_".$j;
$columna2 = "col2_".$j;
$columna3 = "col3_".$j;
$columna4 = "col4_".$j;
$columna5 = "col5_".$j;
$columna6 = "col6_".$j;

$columna7 = "col7_".$j;
$columna8 = "col8_".$j;
$columna9 = "col9_".$j;
$columna10 = "col10_".$j;
$columna11 = "col11_".$j;
$columna12 = "col12_".$j;
$columna13 = "col13_".$j;
$columna14 = "col14_".$j;
$columna15 = "col15_".$j;


 $col1= $_REQUEST[$columna1];
 $col2= $_REQUEST[$columna2];
$col3= $_REQUEST[$columna3];
$col4= $_REQUEST[$columna4];
$col5= $_REQUEST[$columna5];
$col6= $_REQUEST[$columna6];

$col7= $_REQUEST[$columna7];
$col8= $_REQUEST[$columna8];
$col9= $_REQUEST[$columna9];
$col10= $_REQUEST[$columna10];
$col11= $_REQUEST[$columna11];
$col12= $_REQUEST[$columna12];
$col13= $_REQUEST[$columna13];
$col14= $_REQUEST[$columna14];
$col15= $_REQUEST[$columna15];




if ($col1 != ""){
	$j;
 $col1;
 $col2;
 $col3;
 $col4;
 $col5;
 $col6;
 $col7;
 $col8;
 $col9;
 $col10;
 $col11;
 $col12;
 $col13;
 $col14;
 $col15;



 $sql2="select * from turno where fecha_turno = '$fecha_turno' and nro_turno = '$j' and nro_profesional = '$profesionales'";
$result2 = $db->Execute($sql2);



$nro_turn=$result2->fields["nro_turno"];

if ($nro_turn == ""){
  $sql = "INSERT INTO turno (`cod_operacion`, `nro_turno`, `fecha_turno`, `nro_profesional`, `col1`, `col2`, `col3`, `col4`, `col5`, `col6`, `col7`, `col8`, `col9` , `col10` , `col11` , `col12` , `col13` , `col14` , `col15`) VALUES ('', '$j', '$fecha_turno', '$profesionales', '$col1', '$col2', '$col3', '$col4', '$col5', '$col6', '$col7', '$col8', '$col9' , '$col10' , '$col11' , '$col12' , '$col13' , '$col14' , '$col15')";
mysql_query($sql);

}else{

  $sql = "UPDATE `turno` SET `col1` = '$col1',`col2` = '$col2', `col3` = '$col3', `col4` = '$col4', `col5` = '$col5', `col6` = '$col6', `col7` = '$col7', `col8` = '$col8', `col9` = '$col9' , `col10` = '$col10' , `col11` = '$col11' , `col12` = '$col12' , `col13` = '$col13' , `col14` = '$col14' , `col15` = '$col15' WHERE `nro_turno` = $j AND `fecha_turno` = '$fecha_turno' AND `nro_profesional` = $profesionales  LIMIT 1;";
mysql_query($sql);


}


}

}

$bande = 1;
$anio1 = substr($anio1,2,2);
include ("ver_turnos.php");