<?php 
//include ("../../../conexiones/config_pro.php");

 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

$B = 1;


$sql="select * from clientes order by cuenta, denominacion";
$result = $db->Execute($sql);

 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cuenta=strtoupper($result->fields["cuenta"]);
$nueva_cuenta=$_POST[nueva_cuenta.$cuenta];


$sql3="select * from cambio_cuenta where cuenta_actual = $cuenta";
$result3 = $db->Execute($sql3);
$cuenta_1=$result3->fields["cuenta_actual"];

if ($cuenta_1 == ""){
$sql4 = "INSERT INTO `cambio_cuenta` ( `cuenta_actual` , `cuenta_nueva` ) VALUES ('$cuenta' , '$nueva_cuenta')";
$result4 = $db->Execute($sql4);
}
else{
$sql5 = "UPDATE `cambio_cuenta` SET `cuenta_nueva` = '$nueva_cuenta' WHERE `cuenta_actual` = '$cuenta' ";
$result5 = $db->Execute($sql5);
}


$result->MoveNext();
	}

include ("listar_clientes.php");
	?>