<?php
 
require_once('nusoap.php');     //aquí invocamos la librería nusoap
 
$miURL = 'http://coprofi.com.ar/sulb/nusoap';  //definimos la url del web service, si esta alojado localmente se usa localhost
                                           //si esta en un equipo en red usamos una dirección ip como aquí
                                           //si esta en un servidor remoto usaremos el nombre de dominio del servidor o de nuestra pagina web
                                           //ejemplo: www .mipagina123abc.com/ejemplows
 
$server = new soap_server();               // definimos la variable server como soap_server
 
$server->configureWSDL('miservicioweb', $miURL);  //configuramos la wsdl con el nombre de miservicioweb
 
$server->wsdl->schemaTargetNamespace=$miURL;