<?php
require('code39.php');
$pdf=new PDF_Code39('P','mm',array(250,305));
$pdf->AddPage();

include("../../conexiones/config.inc.php");

$mes = "01";
$anio = "2012";
$importe = "1500";

$sql="select * from socios";
$result2 = $db->Execute($sql);

//if (!$result2) die("fallo".$db->ErrorMsg());
// while (!$result2->EOF) {


$nombre=$result2->fields["nombre"];
$cod_socio=$result2->fields["cod_socio"];

$cod_barra = $cod_socio.$mes.$anio.$importe;
$pdf->Code39(20,10,$cod_barra,1,10);
$pdf->Code39(152.5,40,$cod_barra,1,10);

$pdf->ln();


	//$pdf->AddPage();


//$result2->MoveNext();

//	}


$pdf->Output();
?>