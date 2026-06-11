<?php 
include ("../conexiones/config.inc.php");
$sel =$_POST["seleccionado"];
 $user = $_POST["usuario"];
 $pass = $_POST["password"];

$sql= "select * from usuarios where usuario like '$user' and contraseña like '$pass'" ;
$result = $db->Execute($sql);

 $rol=strtoupper($result->fields["rol"]);
 $id=strtoupper($result->fields["id"]);


switch($rol)
	{
:
		case "ADMIN":

session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
//header ("Location: ../validar/admin.php");	
//header ("Location: ../validar/cuadros.htm");	
//include ("../validar/presentacion.php");
//include ("../validar/frames.php");

include ("../validar/admin.htm");
		
			break;

		case "AUDITORIA":

session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
include ("../validar/auditoria.php");
		
			break;

			case "AUDITORIA_MARIO":

session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
include ("../validar/auditoria_mario.php");
		
			break;

		case "SECRETARIA":

session_start ();
session_register ("$user");
session_register ("$pass");
header ("Location: ../validar/secretaria.php");		
		

			break;


case "RECEPCION":

session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
header ("Location: ../validar/recepcion.php");		
break;

case "GERENCIA":

session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
include ("../validar/gerencia.htm");	
break;


case "FACTURACION":

session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
include ("../validar/facturacion.php");	
break;


	case "WEB":

session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
include ("../validar/web1.php");
		
			break;

		case "":
$usuario = $id;
header ("Location: ../drivers/frames/error.php");		
		break;


case "LAUTARO":

session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
header ("Location: ../validar/lautaro.php");		
break;

	

case "PROVEEDURIA":
session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
header ("Location: ../validar/provee.php");			
break;

case "GRABACION":
session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
header ("Location: ../validar/grabacion.php");	
break;

case "CONTADURIA":
//session_start ();
//session_register ("$user");
//session_register ("$pass");
echo "---".$usuario = $id;
header ("Location: ../validar/contaduria.php");	
break;


case "MEG":
session_start ();
session_register ("$user");
session_register ("$pass");
$usuario = $id;
header ("Location: ../validar/mega.php");	
break;

}


?>


