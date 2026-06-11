<?php
require_once("nusoap.php");

$wsdl='http://coprofi.com.ar/sulb/nusoap/lib/servicio.php?wsdl';

$client=new nusoap_client($wsdl, 'wsdl');  
//$param=array('amount'=>'RICARDO','apellido'=>'RIOS');  

//$response= $client->call('CalculateOntarioTax', $param);
$aaa = "fsd fsd fsd";
$param1=array('nombre'=>$aaa); 
$response= $client->call('pacientes', $param1);


echo "<pre>";
print_r($response);
echo "</pre>";
?>