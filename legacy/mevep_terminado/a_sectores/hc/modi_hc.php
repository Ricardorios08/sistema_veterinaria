<?php 
include ("../../conexiones/config.inc.php");


$cod_socio= $_REQUEST['cod_socio'];
$usuario= $_REQUEST['usuario'];
 $tipo= $_REQUEST['tipo'];
 $cod_operacion= $_REQUEST['cod_operacion'];

if ($tipo == 'part'){
	$tipo1 = "PARTICULAR";
}ELSE{
$tipo1 = "SOCIO";
}

if ($tipo == 'part'){
$sql="select * from  particulares  where cod_socio = $cod_socio";
}else{
$sql="select * from  socios where cod_socio = $cod_socio";
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



$sql="select * from  usuario  where id = $usuario";
 $result = $db->Execute($sql);
$nombre_vet=$result->fields["nombre"];


	if ($tipo == 'part'){
$sql1="select * from animal_particular where cod_socio = $cod_socio";
}else{
$sql1="select * from animal where cod_socio = $cod_socio";
}
$result1 = $db->Execute($sql1);

	
$nombre_mascota=strtoupper($result1->fields["nombre"]);
$especie=strtoupper($result1->fields["especie"]);
$raza=strtoupper($result1->fields["raza"]);
$pelaje=strtoupper($result1->fields["pelaje"]);
$tamanio=strtoupper($result1->fields["tamanio"]);
$color=strtoupper($result1->fields["color"]);
$sexo_mascota=strtoupper($result1->fields["sexo"]);
$fecha_nac=strtoupper($result1->fields["fecha_nac"]);
$cod_animal=strtoupper($result1->fields["cod_animal"]);


$dia_nac = substr($fecha_nac,8,2);
$mes_nac = substr($fecha_nac,5,2);
$anio_nac = substr($fecha_nac,0,4);

$hoy = date("d/m/Y");

?>

<form action="guardar_modi_hc.php" method="post">
<table width="850" border="1" cellspacing="0">
  <!--DWLayoutTable-->
  <tr bgcolor="#CCCCCC">
    <td colspan="5"><div align="center" class="Estilo1">HISTORIA CLINICA </div></td>
  </tr>
  <tr bgcolor="#FFFFCC">
    <td colspan="5"><span class="Estilo4"><?php echo $tipo1;?>: <?php echo $cod_socio;?> - <?php echo $apellido;?>, <?php echo $nombre;?></span></td>
  </tr>

   <tr bgcolor="#EBEBEB">
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS"> <span class="Estilo4">MASCOTA</span></font></div></td>
          <td width="183"><div align="center"><font size="2" face="Trebuchet MS"><strong> <?php print("$nombre");?> </strong></font></div>          <div align="center"></div></td>
          <td width="204"><font size="2" face="Trebuchet MS">TAMA&Ntilde;O</font></td>
          <td colspan="2"><font size="2" face="Trebuchet MS"><?php print("$tamanio");?></font></td>
  </tr>
        <tr bgcolor="#EBEBEB">
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">ESPECIE</font></div></td>
          <td><div align="center"><font size="2" face="Trebuchet MS"><?php print("$especie");?></font></div></td>
          <td><font size="2" face="Trebuchet MS">COLOR</font></td>
          <td colspan="2"><font size="2" face="Trebuchet MS"><?php print("$color");?></font></td>
        </tr>
        <tr bgcolor="#EBEBEB">
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">RAZA</font></div></td>
          <td><div align="center"><font size="2" face="Trebuchet MS"><?php print("$raza");?></font></div></td>
          <td><font size="2" face="Trebuchet MS">SEXO</font></td>
          <td colspan="2"><font size="2" face="Trebuchet MS"><?php print("$sexo");?></font></td>
        </tr>
        <tr bgcolor="#EBEBEB">
          <td bgcolor="#CCCCCC"><div align="right"><font size="2" face="Trebuchet MS">PELAJE</font></div></td>
          <td><div align="center"><font size="2" face="Trebuchet MS"><?php print("$pelaje");?></font></div></td>
          <td><font size="2" face="Trebuchet MS">FECHA NAC</font></td>
          <td colspan="2"><font size="2" face="Trebuchet MS"><?php print("$fecha_nac");?></font></td>
        </tr>
  <tr bgcolor="#FFFFCC">
    <td colspan="5"><div align="center"><span class="Estilo1">DIAGNOSTICOS ANTERIORES</span></div></td>
  </tr>
  <tr bgcolor="#999999">
    <td><span class="Estilo2 Estilo3"><strong>FECHA:</strong> </span></td>
    <td colspan="3" valign="top"><span class="Estilo5">DIAGNOSTICO PRESUNTIVO: </span></td>
    <td width="174" valign="top" class="Estilo5"><div align="center">Atendi&oacute;: </div></td>
  </tr>


<?php
  $sql1="select * from diagnostico where cod_socio = $cod_socio and tipo = '$tipo' and cod_operacion = '$cod_operacion' order by  fecha_diagnostico";
$result1 = $db->Execute($sql1);


	  $fecha_diagnostico=strtoupper($result1->fields["fecha_diagnostico"]);



$diagnostico=strtoupper($result1->fields["diagnostico"]);
$diagnostico_presuntivo=strtoupper($result1->fields["diagnostico_presuntivo"]);
$nombre_vet=strtoupper($result1->fields["veterinario"]);

$dia = substr($fecha_diagnostico,8,2);
$mes = substr($fecha_diagnostico,5,2);
$anio = substr($fecha_diagnostico,0,4);

$fecha_diagnostico = $dia."/".$mes."/".$anio;

?>

  <tr bordercolor="#000000" bgcolor="#FFFFFF">
    <td width="124"><div align="center" class="Estilo2 Estilo3"><?php echo $fecha_diagnostico;?></div></td>
    <td colspan="3" valign="top"><div align="center" class="Estilo4">
        <div align="left"><strong>
          <input name="diagnostico_presuntivo" type="text" id="diagnostico_presuntivo" value="<?php echo $diagnostico_presuntivo;?>" size="80">
        </strong></div>
    </div></td>
    <td valign="top"><div align="center" class="Estilo4"><?php echo $nombre_vet;?></div></td>
  </tr>
  <tr bordercolor="#000000" bgcolor="#FFFFFF">
    <td><div align="center"><span class="Estilo4">&nbsp;&nbsp;</span></div></td>
    <td colspan="4"><span class="Estilo4">
      <textarea name="diagnostico" cols="120" rows="10" id="textarea"><?php echo $diagnostico;?></textarea>
    </span></td>
  </tr>


<?php




?>
</table>
<table width="850" border="0" cellspacing="0">

  <tr bgcolor="#CCCCCC">
    <td colspan="2"><div align="center">
<input name="usuario" type="hidden" value = "<?php echo $usuario;?>" size="40">

<input name="cod_operacion" type="hidden" value = "<?php echo $cod_operacion;?>" size="40">

<input name="tipo" type="hidden" value = "<?php echo $tipo;?>" size="40">
<input name="cod_socio" type="hidden" value = "<?php echo $cod_socio;?>" size="40">
      <input type="submit" name="Submit" value="MODIFICAR DIAGNOSTICO">
    </div></td>
  </tr>
</table>
