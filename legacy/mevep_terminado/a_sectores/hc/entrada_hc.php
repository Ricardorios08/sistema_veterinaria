<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;
}
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo3 {font-size: 12px}
.Estilo4 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo5 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
-->
</style>

<?php 


include ("../../conexiones/config.inc.php");


  $cod_socio= $_REQUEST['cod_socio'];
 $usuario= $_REQUEST['usuario'];
  $tipo= $_REQUEST['tipo'];

$sql="select * from  usuario  where id = $usuario";
 $result = $db->Execute($sql);
$nombre_vet=$result->fields["nombre"];


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
$habilitar_hc=strtoupper($result->fields["habilitar_hc"]);

if ($habilitar_hc == 1){
	include ("mod_hc.php");
}else{
	include ("sin_mod_hc.php");
}

