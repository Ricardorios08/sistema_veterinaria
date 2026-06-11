<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 12px}
.Estilo7 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo8 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo9 {font-family: Geneva, Arial, Helvetica, sans-serif}
.Estilo11 {font-size: 14px}
.Estilo12 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo13 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
-->


</style>

<script language="javascript"> 
function multicarga(documento1,documento2) 
{ 
parent.derecha.location.href=documento1; 
parent.central.location.href=documento2; 

} 
</script> 



<table width="399" border="1" cellspacing="0">
  <tr bgcolor="#CCCCCC">
    <td colspan="4"><div align="center" class="Estilo5 Estilo8">PROXIMOS TURNOS</div></td>
  </tr>
  <tr bgcolor="#F0F0F0">
    <td width="132"><div align="center"><span class="Estilo6"><strong><span class="Estilo5"><strong>MASCOTA</strong></span></strong></span></div></td>
    <td width="154"><div align="center" class="Estilo6"><strong><strong><span class="Estilo5">SOCIO</span></strong></strong></div></td>
    <td width="48"><div align="center" class="Estilo13">VACUNA</div></td>
    <td width="47"><div align="center" class="Estilo7">
      <div align="center">ESTADO</div>
    </div></td>
  </tr>


<?php

 $usuario = $_REQUEST['usuario'];

include ("../../conexiones/config.inc.php");

date_default_timezone_set("America/Santiago");
date_default_timezone_set("America/Santiago");
$fecha = date("Y-m-d");



$hoy = date("Y-m-d");

   $sql1="select * from lista_espera where fecha_llegada = '$fecha' and atendido = 'N' order by atendido asc, cod_operacion";
$result1 = $db->Execute($sql1);

  If (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

$cont = $cont + 1;
	  $fecha_llegada=strtoupper($result1->fields["fecha_llegada"]);

	  $fecha_llegada1=strtoupper($result1->fields["fecha_llegada"]);
 $cod_operacion=strtoupper($result1->fields["cod_operacion"]);

$cod_socio=strtoupper($result1->fields["cod_socio"]);
$hora_llegada=strtoupper($result1->fields["hora_llegada"]);
  $tipo=$result1->fields["tipo"];

$dia = substr($fecha_llegada,8,2);
$mes = substr($fecha_llegada,5,2);
$anio = substr($fecha_llegada,0,4);

$fecha_llegada = $dia."/".$mes."/".$anio;
$hora_llegada=strtoupper($result1->fields["hora_llegada"]);

$atendido=strtoupper($result1->fields["atendido"]);

if ($tipo == 'part'){
 $sql="select * from particulares where cod_socio = $cod_socio";
}ELSE{
 $sql="select * from socios  where cod_socio = $cod_socio";
}

 $result = $db->Execute($sql);

	
$cod_socio=$result->fields["cod_socio"];
$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);
$tipo_doc=strtoupper($result->fields["tipo_doc"]);
$documento=strtoupper($result->fields["documento"]);
$telefono=strtoupper($result->fields["telefono"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$localidad=strtoupper($result->fields["localidad"]);
$departamento=strtoupper($result->fields["departamento"]);
$cod_postal=strtoupper($result->fields["cod_postal"]);
$fecha_pago=strtoupper($result->fields["fecha_pago"]);
$debito=strtoupper($result->fields["debito"]);
$sexo=strtoupper($result->fields["sexo"]);
$deuda=strtoupper($result->fields["deuda"]);
$motivo=strtoupper($result->fields["motivo"]);
$cobrador=strtoupper($result->fields["cobrador"]);


$socio = $cod_socio." ".$apellido." ".$nombre;

if ($tipo == 'part'){
$sql="select * from animal_particular where cod_socio = $cod_socio";
}ELSE{
 $sql="select * from animal where cod_socio = $cod_socio";
}



$result = $db->Execute($sql);

	
$nombre_mascota=strtoupper($result->fields["nombre"]);
$especie=strtoupper($result->fields["especie"]);
$raza=strtoupper($result->fields["raza"]);

$pelaje=strtoupper($result->fields["pelaje"]);
$tamanio=strtoupper($result->fields["tamanio"]);
$color=strtoupper($result->fields["color"]);
$sexo_mascota=strtoupper($result->fields["sexo"]);
$fecha_nac=strtoupper($result->fields["fecha_nac"]);
$cod_animal=strtoupper($result->fields["cod_animal"]);


$dia_nac = substr($fecha_nac,8,2);
$mes_nac = substr($fecha_nac,5,2);
$anio_nac = substr($fecha_nac,0,4);


?>


 <?PHP  if ($cont == "1"){?>
  <tr bgcolor="#66FF99">
    <td><span class="Estilo4 Estilo9 Estilo11"><?php echo $nombre_mascota;?></span></td>
    <td><span class="Estilo4 Estilo9 Estilo11"><?php echo $apellido;?> <?php echo $nombre;?></span></td>
    <td><div align="center"><span class="Estilo12"><span class="Estilo4"><a href="../hc/vacuna_vet.php?cod_socio=<?php print("$cod_socio");?>&&cod_operacion=<?php print("$cod_operacion");?>&&usuario=<?php print("$usuario");?>&&tipo=<?php print("$tipo");?>"  target ="central"><img src="../../imagenes/office//475.ico" alt="Borrar" border = "0"></a></span></span></div></td>
    <td><div align="center" class="Estilo12"><span class="Estilo4">  <A HREF="javascript:multicarga('../hc/lista_vet.php?cod_socio=<?php print("$cod_socio");?>&&cod_operacion=<?php print("$cod_operacion");?>&&usuario=<?php print("$usuario");?>&&tipo=<?php print("$tipo");?>', '../hc/entrada_hc1_vet.php?cod_socio=<?php print("$cod_socio");?>&&cod_operacion=<?php print("$cod_operacion");?>&&usuario=<?php print("$usuario");?>&&tipo=<?php print("$tipo");?>')"><img src="../../imagenes/office//1274.ico" alt="Borrar" border = "0"></a></span></div></td>

  </tr>

  <!-- <A HREF="javascript:multicarga('../hc/lista_vet.php?cod_socio=<?php print("$cod_socio");?>&&cod_operacion=<?php print("$cod_operacion");?>&&usuario=<?php print("$usuario");?>&&tipo=<?php print("$tipo");?>', '../hc/entrada_hc1_vet.php?cod_socio=<?php print("$cod_socio");?>&&cod_operacion=<?php print("$cod_operacion");?>&&usuario=<?php print("$usuario");?>&&tipo=<?php print("$tipo");?>')"><img src="../../imagenes/office//1274.ico" alt="Borrar" border = "0"></a> -->

<?PHP }ELSE{?>

  <tr bgcolor="#FFFFFF">
    <td><span class="Estilo4 Estilo9 Estilo11"><?php echo $nombre_mascota;?></span></td>
    <td><span class="Estilo4 Estilo9 Estilo11"><?php echo $apellido;?> <?php echo $nombre;?></span></td>
    <td><div align="center"><span class="Estilo12"><span class="Estilo4"><a href="../hc/vacuna_vet.php?cod_socio=<?php print("$cod_socio");?>&&cod_operacion=<?php print("$cod_operacion");?>&&usuario=<?php print("$usuario");?>&&tipo=<?php print("$tipo");?>"  target = "central"><img src="../../imagenes/office//475.ico" alt="Borrar" border = "0"></a></span></span></div></td>
	  <td><div align="center" class="Estilo12"><span class="Estilo4">  <A HREF="javascript:multicarga('../hc/lista_vet.php?cod_socio=<?php print("$cod_socio");?>&&cod_operacion=<?php print("$cod_operacion");?>&&usuario=<?php print("$usuario");?>&&tipo=<?php print("$tipo");?>', '../hc/entrada_hc1_vet.php?cod_socio=<?php print("$cod_socio");?>&&cod_operacion=<?php print("$cod_operacion");?>&&usuario=<?php print("$usuario");?>&&tipo=<?php print("$tipo");?>')"><img src="../../imagenes/office//1274.ico" alt="Borrar" border = "0"></a></span></div></td>

<?php
}



$result1->MoveNext();
	}

?>
</table>

<br><br>
<table width="399" border="1" cellspacing="0">
  <tr bgcolor="#CCCCCC">
    <td colspan="2"><div align="center" class="Estilo5 Estilo8">ATENDIDOS</div></td>
  </tr>
  <tr bgcolor="#F0F0F0">
    <td width="177"><div align="center"><span class="Estilo6"><strong><span class="Estilo5"><strong>MASCOTA</strong></span></strong></span></div></td>
    <td width="212"><div align="center" class="Estilo6"><strong><strong><span class="Estilo5">SOCIO</span></strong></strong></div></td>
  </tr>


<?php


   $sql1="select * from lista_espera where fecha_llegada = '$fecha' and atendido = 'S' order by  cod_operacion";
$result1 = $db->Execute($sql1);

  If (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {


	  $fecha_llegada=strtoupper($result1->fields["fecha_llegada"]);

	  $fecha_llegada1=strtoupper($result1->fields["fecha_llegada"]);
 $cod_operacion=strtoupper($result1->fields["cod_operacion"]);

$cod_socio=strtoupper($result1->fields["cod_socio"]);
$hora_llegada=strtoupper($result1->fields["hora_llegada"]);
  $tipo=$result1->fields["tipo"];

$dia = substr($fecha_llegada,8,2);
$mes = substr($fecha_llegada,5,2);
$anio = substr($fecha_llegada,0,4);

$fecha_llegada = $dia."/".$mes."/".$anio;
$hora_llegada=strtoupper($result1->fields["hora_llegada"]);

$atendido=strtoupper($result1->fields["atendido"]);

if ($tipo == 'part'){
 $sql="select * from particulares where cod_socio = $cod_socio";
}ELSE{
 $sql="select * from socios  where cod_socio = $cod_socio";
}

 $result = $db->Execute($sql);

	
$cod_socio=$result->fields["cod_socio"];
$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);
$tipo_doc=strtoupper($result->fields["tipo_doc"]);
$documento=strtoupper($result->fields["documento"]);
$telefono=strtoupper($result->fields["telefono"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$localidad=strtoupper($result->fields["localidad"]);
$departamento=strtoupper($result->fields["departamento"]);
$cod_postal=strtoupper($result->fields["cod_postal"]);
$fecha_pago=strtoupper($result->fields["fecha_pago"]);
$debito=strtoupper($result->fields["debito"]);
$sexo=strtoupper($result->fields["sexo"]);
$deuda=strtoupper($result->fields["deuda"]);
$motivo=strtoupper($result->fields["motivo"]);
$cobrador=strtoupper($result->fields["cobrador"]);


$socio = $cod_socio." ".$apellido." ".$nombre;

if ($tipo == 'part'){
$sql="select * from  animal_particular where cod_socio = $cod_socio";
}ELSE{
$sql="select * from animal where cod_socio = $cod_socio";
}



$result = $db->Execute($sql);

	
$nombre_mascota=strtoupper($result->fields["nombre"]);
$especie=strtoupper($result->fields["especie"]);
$raza=strtoupper($result->fields["raza"]);
$pelaje=strtoupper($result->fields["pelaje"]);
$tamanio=strtoupper($result->fields["tamanio"]);
$color=strtoupper($result->fields["color"]);
$sexo_mascota=strtoupper($result->fields["sexo"]);
$fecha_nac=strtoupper($result->fields["fecha_nac"]);
$cod_animal=strtoupper($result->fields["cod_animal"]);


$dia_nac = substr($fecha_nac,8,2);
$mes_nac = substr($fecha_nac,5,2);
$anio_nac = substr($fecha_nac,0,4);


?>


 <?PHP  if ($atendido == "N"){?>
  <tr bgcolor="#FFFFFF">
    <td><span class="Estilo4 Estilo9 Estilo11"><?php echo $nombre_mascota;?></span></td>
    <td><span class="Estilo4 Estilo9 Estilo11"><?php echo $apellido;?> <?php echo $nombre;?></span></td>
  </tr>

<?PHP }ELSE{?>

  <tr bgcolor="#FFAEAE">
    <td><span class="Estilo4 Estilo9 Estilo11">
	<a href="../hc/entrada_hc.php?cod_socio=<?php print("$cod_socio");?>&&tipo=<?php print("$tipo");?>&&usuario=<?php print("$usuario");?>" target ="central"><?php echo $apellido;?> <?php echo $nombre;?></a></span></td>
    <td><span class="Estilo4 Estilo11"><?php echo $nombre_mascota;?></span></td>
  </tr>

<?php
}



$result1->MoveNext();
	}

?>
</table>


<a href="http://www.microsoft.com" target="central" onclick="window.open('http://www.google.com'); window.open('http://www.yahoo.com');">Click Here</a>`