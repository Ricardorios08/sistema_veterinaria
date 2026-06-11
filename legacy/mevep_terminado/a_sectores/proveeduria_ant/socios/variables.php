
<?


include ("../../../conexiones/config_grabacion.php");


//tabla datos_laboratorio
$sql="select * from datos_laboratorio where nro_laboratorio like '$a'";
$result = $db_bq->Execute($sql);

$nro_laboratorio=ucwords($result->fields["nro_laboratorio"]);
$matricula=ucwords($result->fields["matricula"]);
$nombre_laboratorio=ucwords($result->fields["nombre_laboratorio"]);
$fecha_habilitacion=ucwords($result->fields["fecha_habilitacion"]);
$fecha_inicio=ucwords($result->fields["fecha_inicio"]);
$fecha_vencimiento=ucwords($result->fields["fecha_vencimiento"]);
$tipo_sociedad=ucwords($result->fields["tipo_sociedad"]);

if ($matricula == 0){
	$matricula= "";}

switch ($tipo_sociedad){

case "0":
	{
	$tipo_sociedad="No Tiene";
	break;
	}

	case "1":
	{
	$tipo_sociedad="S.A";
	break;
	}

	case "2":
	{
	$tipo_sociedad="S.R.L";
	break;
	}

	case "3":
	{
	$tipo_sociedad="Otra";
	break;
	}

}


$cantidad=ucwords($result->fields["cantidad"]);
$categoria_lab=ucwords($result->fields["categoria_lab"]);
$domicilio=ucwords($result->fields["domicilio"]);
$nro_domicilio=ucwords($result->fields["nro_domicilio"]);
$referencia=ucwords($result->fields["referencia"]);
$cod_postal=ucwords($result->fields["cod_postal"]);
$localidad=ucwords($result->fields["localidad"]);
$departamento=ucwords($result->fields["departamento"]);
$orientacion=ucwords($result->fields["orientacion"]);
$telefono=ucwords($result->fields["telefono"]);
$celular=ucwords($result->fields["celular"]);
$fax=ucwords($result->fields["fax"]);
$email=strtolower($result->fields["email"]);
$especialidad=ucwords($result->fields["especialidad"]);

if (strlen($telefono) == 6){
$telefono = "4".$telefono;
}


//tabla facturante
$sql="select * from facturante where nro_laboratorio like '$a'";
$result = $db_bq->Execute($sql);
$facturante=ucwords($result->fields["facturante"]);
$banco=ucwords($result->fields["banco"]);
$cuenta=ucwords($result->fields["cuenta"]);
$nro_cuenta=ucwords($result->fields["nro_cuenta"]);
$gastos_adm=ucwords($result->fields["gastos_adm"]);
$tipo_cuenta=ucwords($result->fields["tipo_cuenta"]);
$sucursal=ucwords($result->fields["sucursal"]);

$entero1=substr($gastos_adm,1,1);

$decimal1=substr($gastos_adm,2,2);

//$gastos_adm= $entero1.".".$decimal1;


//tabla ing_bruto
$sql="select * from ing_bruto where nro_laboratorio like '$a'";
$result = $db_bq->Execute($sql);
$nro_laboratorio=ucwords($result->fields["nro_laboratorio"]);
$nro_ib=ucwords($result->fields["nro_ib"]);
$vencimiento_ib=ucwords($result->fields["vencimiento_ib"]);
$requisitos_ib=ucwords($result->fields["requisitos_ib"]);
$retension_ib=ucwords($result->fields["retension_ib"]);
$tasa_ib=ucwords($result->fields["tasa_ib"]);

$enter1=substr($retension_ib,1,1);

$decima1=substr($retension_ib,2,2);

//$retension_ib= $enter1.".".$decima1;

//tabla informatico
$sql="select * from informatico where nro_laboratorio like '$a'";
$result = $db_bq->Execute($sql);

$equipamiento=ucwords($result->fields["equipamiento"]);
$equipo=ucwords($result->fields["equipo"]);
$conexion=ucwords($result->fields["conexion"]);
$sistematizacion=ucwords($result->fields["sistematizacion"]);
$capacitacion=ucwords($result->fields["capacitacion"]);

if ($equipo == ""){
	$equipo= "NO";
}

if ($sistematizacion == ""){
	$sistematizacion= "NO";
}

if ($capacitacion == ""){
	$capacitacion= "NO";
}

if ($equipamiento == ""){
	$equipamiento= "Ninguno";
}


switch ($conexion){

	case "":{
		$conexion="Ninguna";
	break;
	}

	case "1":{
		$conexion="Banda Ancha";
	break;
	}

	case "2":{
		$conexion="Wire-les";
	break;
	}

	case "3":{
		$conexion="Dial-up";
	break;
	}

		case "4":{
		$conexion="Wi-Fip";
	break;
	}

		case "5":{
		$conexion="Otra";
	break;
	}
}
//tabla afip
$sql="select * from afip where nro_laboratorio like '$a'";
$result = $db_bq->Execute($sql);
$nro_afip=ucwords($result->fields["nro_afip"]);
$vencimiento_afip=ucwords($result->fields["vencimiento_afip"]);
$requisitos_afip=ucwords($result->fields["requisitos_afip"]);
$retension_afip=ucwords($result->fields["retension_afip"]);
$sit_iva=ucwords($result->fields["sit_iva"]);
$categoria_afip=ucwords($result->fields["categoria_afip"]);

//tabla ansal
$sql="select * from ansal where nro_laboratorio like '$a'";
$result = $db_bq->Execute($sql);
$nro_ansal=ucwords($result->fields["nro_ansal"]);
$vencimiento_ansal=ucwords($result->fields["vencimiento_ansal"]);
$requisitos_ansal=ucwords($result->fields["requisitos_ansal"]);


$sql1="select * from datos_personales where matricula like '$matricula'";
$result1 = $db_bq->Execute($sql1);

$apellido=strtoupper($result1->fields["apellido"]);
$nombre=strtoupper($result1->fields["nombre"]);

if (($apellido != "")&&($nombre!="")){
$completo=" (".$apellido." ".$nombre.")";
}
else{
$completo = "No tiene Ingresado un responsable";}


$sql="select * from condiciones_socios where cuenta like '$a'";
$result = $db_pro->Execute($sql);
$plan=strtoupper($result->fields["plan"]);

