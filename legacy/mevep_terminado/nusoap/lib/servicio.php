<?
require_once("nusoap.php");

$ns = 'http://coprofi.com.ar/sulb/nusoap/lib'; //Espacio de nombres o sitio; sitio donde estará alojado el web service

$server = new soap_server();
$server->configureWSDL('CanadaTaxCalculator',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
$server->register('CalculateOntarioTax',array('amount' => 'xsd:string' , 'apellido' => 'xsd:string'),array('return' => 'xsd:string'),$ns);


$server->register('pacientes',array('sql' => 'xsd:string' , 'apellido' => 'xsd:string'),array('return' => 'xsd:string'),$ns);
$server->register('buscar_orden',array('cod_grabacion' => 'xsd:string' , 'apellido' => 'xsd:string'),array('return' => 'xsd:string'),$ns);


function CalculateOntarioTax($amount,$apellido){

$taxcalc=$amount.$apellido;

return new soapval('return','xsd:string',$taxcalc);
}



function pacientes($sql){
include ("../../conexiones/config.inc.php");
$sql1=$sql;
mysql_query($sql1);

return new soapval('return','xsd:string',$sql1);
}


function buscar_orden($cod_grabacion){
include ("../../conexiones/config.inc.php");
$cod_grabacion1=$cod_grabacion;

$sql2="select * from ordenes where cod_grabacion = $cod_grabacion1";
$result2 = $db->Execute($sql2);
$cod_gr=$result2->fields["cod_grabacion"];



return new soapval('return','xsd:string', $cod_gr);
}






$server->service($HTTP_RAW_POST_DATA);

?>