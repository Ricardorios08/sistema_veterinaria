<!-- <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();"> -->
<style type="text/css">
<!--
.Estilo2 {font-weight: bold}
.Estilo4 {
	font-size: 18px;
	font-weight: bold;
}
.Estilo5 {font-size: 16px}
.Estilo6 {
	font-size: 36px;
	font-weight: bold;
}
-->
</style>


<?php

include ("../../conexiones/config.inc.php");


global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
$palabra=$_POST["busca"];
}

$palabra=$_REQUEST["palabra"];


$hoy = date("d/m/y");

list($ape,$nom) = explode(" ",$palabra);

    $ape; // Imprime 12
    $nom; // Imprime 01
  

if ($palabra == "") {
$leyenda = "NO INGRESO BUSQUEDA";
include ("../../alertas/campo_informacion.php");
EXIT;

}

$B = 1;

/*if ($palabra == "") {
$mensaje = "NO INGRESO BUSQUEDA";
include ("../../alertas/campo_informacion.php");
EXIT;

}else{
  $sql="select * from socios where cod_socio like '$palabra' or documento like '$palabra' or apellido like '%$palabra%' or nombre like '$palabra%' or telefono like '$palabra%'  or domicilio like '%$palabra%'  order by  cod_socio asc ";
 $result = $db->Execute($sql);
}
	
*/

    if (is_numeric($palabra) == false){

if (($ape != "") and ($nom != "")){
$sql="select * from socios where  apellido like '$ape%' and nombre like '$nom%'  order by  cod_socio asc  ";
}elseif (($ape != "") and ($nom == "")){
 $sql="select * from socios where  apellido like '$ape%' order by cod_socio";
}elseif (($ape == "") and ($nom != "")){
 $sql="select * from socios where  nombre like '$nom%' order by cod_socio";
}

}else
{
   $sql="select * from socios where cod_socio  like '$palabra' or telefono like '$palabra' limit 1";



}

 $result = $db->Execute($sql);



?>
<table width="800" border="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="5"><div align="center"><font color="#FFFFFF" size="2" face="Trebuchet MS"><font color="#000000">LISTADO DE SOCIOS. Emitido el <?php echo $hoy;?></font></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
  
    <td width="179"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">SOCIO</font></strong></div></td>
    <td width="370"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"> APELLIDO Y NOMBRE </font></strong></div></td>
    <td width="104"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">TELEFONO</font></strong></div></td>
    <td width="67"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">LOCALIDAD</font></strong></div></td>
    <td width="70"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">BORRAR</font></strong></div></td>
    <?php 




 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$cod_socio=$result->fields["cod_socio"];
$cod_socio1=$result->fields["cod_socio"];
$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);
$domicilio=strtoupper($result->fields["domicilio"]);
$departamento=strtoupper($result->fields["departamento"]);
$telefono=strtoupper($result->fields["telefono"]);
$cod_postal=strtoupper($result->fields["cod_postal"]);
$motivo=strtoupper($result->fields["motivo"]);
$fecha_ingreso=strtoupper($result->fields["fecha_ingreso"]);
$cobrador=strtoupper($result->fields["cobrador"]);

switch ($cobrador){
	case "10":{$cobrador1 = $cobrador." - LOCAL";break;}
	case "11":{$cobrador1 = $cobrador." - DANIEL";break;}
	case "12":{$cobrador1 = $cobrador." - JORGE";break;}
	case "13":{$cobrador1 = $cobrador." - GUSTAVO";break;}
    case "14":{$cobrador1 = $cobrador." - RICARDO";break;}
	}


$ruta=strtoupper($result->fields["ruta"]);

$no_imprimir=strtoupper($result->fields["no_imprimir"]);

switch ($no_imprimir){case "VERDADERO":{$tipo_pago_mostrar = "LOCAL";BREAK;}case "FALSO":{$tipo_pago_mostrar = "COBRADOR";BREAK;}}



if ($telefono == 0){
$telefono = "-";
}



    ?>  
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
	<td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center" class="Estilo6"><font face="Trebuchet MS"><?php print("$cod_socio");?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="left"><strong><font face="Trebuchet MS"><a href="modificar_socio.php?cod_socio=<?php print("$cod_socio");?>" class="Estilo5"><?php print("$apellido");?>, <?php print("$nombre");?></a></font></strong></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center" class="Estilo4"> <font face="Trebuchet MS"><?php echo $telefono;?></font></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"> <?php echo $departamento;?></font></strong></div></td>
   


	<td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"><a href="borrar_socio.php?cod_socio=<?php print("$cod_socio1");?>" onClick="return confirm('&iquest;Est&aacute; seguro de Borrar el paciente con toda su historia Clinica?');"><img src="../../imagenes/office//1047.ico" alt="Borrar" border = "0"></a></font></strong></div></td>
  </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td colspan="5" bordercolor="#E8DCFC"><font color="#000000" size="2" face="Trebuchet MS">Domicilio: <strong><font size="2" face="Trebuchet MS"><?php echo $domicilio;?></font></strong></font>        <div align="left"><strong></strong></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bordercolor="#E8DCFC"><font size="2" face="Trebuchet MS">Modo Pago: <?php echo $tipo_pago_mostrar;?> </font></td>
      <td bordercolor="#E8DCFC"><div align="center"><font size="2" face="Trebuchet MS">Cobrador: <?php echo $cobrador1;?></font></div></td>
      <td bordercolor="#E8DCFC"><div align="center"><font size="2" face="Trebuchet MS">Ruta:</font> <font size="2" face="Trebuchet MS"><a href="acomodar_rut.php?cod_socio=<?php print("$cod_socio");?>" class="Estilo2"><?php echo $ruta;?></a></font></div></td>
      <td bordercolor="#E8DCFC"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"><a href="../profesionales/entrada_turno_socio.php?cod_socio=<?php print("$cod_socio");?>"></a></font></strong></div></td>
      <td bordercolor="#E8DCFC">&nbsp;</td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td bordercolor="#E8DCFC"><font size="2" face="Trebuchet MS">Observaciones<?php echo $motivo;?></font> </td>
      <td bordercolor="#E8DCFC"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="3" bordercolor="#E8DCFC"><div align="center"><strong><font face="Trebuchet MS"><a href="pagos_multiples.php?cod_socio=<?php print("$cod_socio");?>" class="Estilo5">Pagar Varios</a></font></strong></div></td>
    </tr>
    <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
      <td colspan="2" bordercolor="#E8DCFC"><font size="2" face="Trebuchet MS">Deuda: <?php 
include ("inhabilitado.php");	  
include ("estado_pago.php");?>
       </font></td>
      <td colspan="3" bordercolor="#E8DCFC"><div align="center"><strong><font face="Trebuchet MS"><a href="corregir_pagos.php?cod_socio=<?php print("$cod_socio");?>" class="Estilo5">Corregir Pagos</a></font></strong></div></td>
    </tr>

 <?php
		
	IF ($cant >= 2){ ?>
    <tr bordercolor="#FFFFFF" bgcolor="#FF0000">
      <td colspan="6" bordercolor="#E8DCFC"><div align="center"><font color="#FFFFFF" size="6" face="Trebuchet MS"><BLINK><strong>INHABILITADO POR DEUDA </strong><BLINK></font> </div>  </TR>
<?php }?>
  
   
	<tr bgcolor="#EBEBEB">
	  <td bgcolor="#EBEBEB"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"><a href="../hc/lista_espera.php?cod_socio=<?php print("$cod_socio");?>">LISTA DE ESPERA</a></font></strong></div></td>
	  <td valign="top"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"><a href="../hc/entrada_hc.php?cod_socio=<?php print("$cod_socio");?>">HISTORIA CLINICA</a></font></strong></div></td>
	  <td colspan="3" valign="top"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"><a href="../profesionales/entrada_turno_socio.php?cod_socio=<?php print("$cod_socio");?>&&cod_animal=<?php print("$cod_animal");?>">SOLICITAR TURNO PELUQUERIA</a></font></strong></div></td>
  </tr>
	<tr bgcolor="#EBEBEB">
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">AGREGAR MASCOTA </font></div></td>
          <td valign="top"><div align="left"><font size="2" face="Trebuchet MS"><a href="agregar_mascota.php?cod_socio=<?php print("$cod_socio");?>&&cod_animal=<?php print("$cod_animal");?>"> <img src="../../imagenes/office//1274.ico" alt="Borrar" border = "0"></a></font></div>            <div align="center"></div></td>
          <td colspan="3" valign="top"><div align="center"></div></td>
    </tr>
  

        <?php 

  $sql1="select * from animal where cod_socio = $cod_socio order by  fecha_nac";
$result1 = $db->Execute($sql1);

  If (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

	
$nombre=strtoupper($result1->fields["nombre"]);
$especie=strtoupper($result1->fields["especie"]);
$raza=strtoupper($result1->fields["raza"]);
$pelaje=strtoupper($result1->fields["pelaje"]);
$tamanio=strtoupper($result1->fields["tamanio"]);
$color=strtoupper($result1->fields["color"]);
$sexo=strtoupper($result1->fields["sexo"]);
$fecha_nac=strtoupper($result1->fields["fecha_nac"]);
$cod_animal=strtoupper($result1->fields["cod_animal"]);



?>
       
        <tr bgcolor="#EBEBEB">
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS"><a href="borrar_masota.php?cod_socio=<?php print("$cod_socio");?>&&cod_animal=<?php print("$cod_animal");?>" onClick="return confirm('&iquest;Est&aacute; seguro de Borrar la mascota con toda su historia Clinica?');"><img src="../../imagenes/office//1047.ico" alt="Borrar" border = "0"></a> NOMBRE</font></div></td>
          <td bgcolor="#F0F0F0"><div align="center" class="Estilo4">
            <div align="left"><font face="Trebuchet MS">&nbsp;&nbsp;<a href="modificar_mascota.php?cod_animal=<?php print("$cod_animal");?>&&cod_socio=<?php print("$cod_socio");?>"><strong></strong></a><a href="modificar_mascota.php?cod_animal=<?php print("$cod_animal");?>&&cod_socio=<?php print("$cod_socio");?>"><strong><?php print("$nombre");?></strong></a></font></div>
          </div>          </td>
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">TAMA&Ntilde;O</font></div></td>
          <td colspan="2" ><div align="left"><font face="Trebuchet MS">&nbsp;&nbsp;<a href="modificar_mascota.php?cod_animal=<?php print("$cod_animal");?>&&cod_socio=<?php print("$cod_socio");?>"><strong></strong></a></font><font size="2" face="Trebuchet MS"><?php print("$tamanio");?></font></div></td>
        </tr>
        <tr bgcolor="#EBEBEB">
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">ESPECIE</font></div></td>
          <td><div align="left"><font face="Trebuchet MS">&nbsp;&nbsp;<a href="modificar_mascota.php?cod_animal=<?php print("$cod_animal");?>&&cod_socio=<?php print("$cod_socio");?>"><strong></strong></a></font><font size="2" face="Trebuchet MS"><?php print("$especie");?></font></div></td>
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">COLOR</font></div></td>
          <td colspan="2" valign="top"><div align="left"><font face="Trebuchet MS">&nbsp;&nbsp;<a href="modificar_mascota.php?cod_animal=<?php print("$cod_animal");?>&&cod_socio=<?php print("$cod_socio");?>"><strong></strong></a></font><font size="2" face="Trebuchet MS"><?php print("$color");?></font></div></td>
        </tr>
        <tr bgcolor="#EBEBEB">
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">RAZA</font></div></td>
          <td><div align="left"><font face="Trebuchet MS">&nbsp;&nbsp;<a href="modificar_mascota.php?cod_animal=<?php print("$cod_animal");?>&&cod_socio=<?php print("$cod_socio");?>"><strong></strong></a></font><font size="2" face="Trebuchet MS"><?php print("$raza");?></font></div></td>
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">SEXO</font></div></td>
          <td colspan="2" valign="top"><div align="left"><font face="Trebuchet MS">&nbsp;&nbsp;<a href="modificar_mascota.php?cod_animal=<?php print("$cod_animal");?>&&cod_socio=<?php print("$cod_socio");?>"><strong></strong></a></font><font size="2" face="Trebuchet MS"><?php print("$sexo");?></font></div></td>
        </tr>
        <tr bgcolor="#EBEBEB">
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">PELAJE</font></div></td>
          <td><div align="left"><font face="Trebuchet MS">&nbsp;&nbsp;<a href="modificar_mascota.php?cod_animal=<?php print("$cod_animal");?>&&cod_socio=<?php print("$cod_socio");?>"><strong></strong></a></font><font size="2" face="Trebuchet MS"><?php print("$pelaje");?></font></div></td>
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">FECHA NAC</font></div></td>
          <td colspan="2" valign="top"><div align="left"><font face="Trebuchet MS">&nbsp;&nbsp;<a href="modificar_mascota.php?cod_animal=<?php print("$cod_animal");?>&&cod_socio=<?php print("$cod_socio");?>"><strong></strong></a></font><font size="2" face="Trebuchet MS"><?php print("$fecha_nac");?></font></div></td>
        </tr>
        <?php 


$result1->MoveNext();
	}

?>
    <tr>
      <td>&nbsp;</td>  


     

      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
  <?php 


$result->MoveNext();
	}

?>
</table>
