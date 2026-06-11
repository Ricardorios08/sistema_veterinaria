<?php
require('../../drivers/fpdf/fpdf.php');
require('code39.php');

$pdf=new PDF_Code39('L','mm','A5');

$pdf->AddPage();

include("../../conexiones/config.inc.php");


$anio = date("Y");


$desde=$_POST["desde"];
$hasta=$_POST["hasta"];

$mes_fac=$_POST["mes_fac"];
$fecha_fac=$_POST["fecha_fac"];

$observaciones=$_POST["observaciones"];
switch ($mes_fac){

case "ENERO":{$mes1 = "01";break;}
case "FEBRERO":{$mes1 = "02";break;}
case "MARZO":{$mes1 = "03";break;}
case "ABRIL":{$mes1 = "04";break;}
case "MAYO":{$mes1 = "05";break;}
case "JUNIO":{$mes1 = "06";break;}
case "JULIO":{$mes1 = "07";break;}
case "AGOSTO":{$mes1 = "08";break;}
case "SETIEMBRE":{$mes1 = "09";break;}
case "OCTUBRE":{$mes1 = "10";break;}
case "NOVIEMBRE":{$mes1 = "11";break;}
case "DICIEMBRE":{$mes1 = "12";break;}

}


if ($desde == ""){
$leyenda = "NO INGRESO RANGO DESDE";
include ("../../alertas/campo_informacion.php");
EXIT;
}

if ($hasta == ""){
$leyenda = "NO INGRESO RANGO DESDE";
include ("../../alertas/campo_informacion.php");
EXIT;
}


$hoy = date("d/m/y");


$sql = "SELECT * FROM `socios` WHERE ruta BETWEEN '$desde' AND '$hasta'  and no_imprimir = 'FALSO' order by ruta";
$result2 = $db->Execute($sql);

if (!$result2) die("fallo".$db->ErrorMsg());
while (!$result2->EOF) {


$cod_socio=$result2->fields["cod_socio"];
$apellido=strtoupper($result2->fields["apellido"]);
$nombre=strtoupper($result2->fields["nombre"]);
$tipo_doc=strtoupper($result2->fields["tipo_doc"]);
$documento=strtoupper($result2->fields["documento"]);
$telefono=strtoupper($result2->fields["telefono"]);
$domicilio=strtoupper($result2->fields["domicilio"]);
$departamento=strtoupper($result2->fields["departamento"]);
$cobrador=strtoupper($result2->fields["cobrador"]);

$ruta=strtoupper($result2->fields["ruta"]);


$importe_deuda=strtoupper($result2->fields["importe_deuda"]);
$importe_cuota=strtoupper($result2->fields["importe_cuota"]);
$importe_cuota_barra=strtoupper($result2->fields["importe_cuota"]);


$sql1="select * from animal where cod_socio = $cod_socio";
$result1 = $db->Execute($sql1);
$nombre_mascota=strtoupper($result1->fields["nombre"]);

$nombre = $apellido.", ".$nombre;


list($precio_entero1,$precio_decimal1) = explode(".",$importe_cuota_barra);
if (strlen($precio_decimal1) == 1){
$precio_decimal1 = $precio_decimal1."0";
}
$importe_cuota_barra = $precio_entero1."".$precio_decimal1;




if (strlen($importe_cuota_barra) == 4){
$importe_cuota_barra = "0".$importe_cuota_barra;
}
$cod_barra = $cod_socio.$mes1.$anio.$cobrador;


$pdf->SetFont('Arial','',9);

$nro_talon = "00005839";

$pdf->SetY(5);
$pdf->SetX(70);
$pdf->Cell(40,5,"Nº: ".$nro_talon);

$pdf->SetX(185);
$pdf->Cell(180,5,"Nº: ".$nro_talon);
$pdf->Ln();


$pdf->SetY(30);
$pdf->SetX(70);
$pdf->Cell(40,5,$fecha_fac);

$pdf->SetX(185);
$pdf->Cell(180,5,$fecha_fac);
$pdf->Ln();

$pdf->SetX(20);
$pdf->Cell(40,5,$nombre.' ('.$cod_socio.")");
$pdf->SetX(135);
$pdf->Cell(40,5,$nombre.' ('.$cod_socio.")");
$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(40,5,$domicilio." - ".$departamento);
$pdf->SetX(135);
$pdf->Cell(40,5,$domicilio." - ".$departamento);
$pdf->Ln();

$leyenda = "1 Abono por: ".$nombre_mascota;
$pdf->SetY(60);
$pdf->Cell(40,5,$leyenda);
$pdf->SetX(90);
$pdf->Cell(40,5,$importe_cuota);
$pdf->SetX(130);
$pdf->Cell(40,5,$leyenda);
$pdf->SetX(200);
$pdf->Cell(40,5,$importe_cuota);
$pdf->Ln();

$pdf->SetFont('Arial','B',28);
$pdf->SetY(80);
$pdf->SetX(25);

$pdf->Cell(40,5,$mes_fac);
$pdf->SetX(130);
$pdf->Cell(40,5,$mes_fac);


$pdf->SetFont('Arial','',8);

$pdf->SetY(90);
$pdf->SetX(120);
$pdf->MultiCell(80,5,$observaciones);

$pdf->SetFont('Arial','',9);


$pdf->SetY(121);

$pdf->SetX(10);
$pdf->Cell(40,5,$ruta);


$pdf->SetX(90);
$pdf->Cell(40,5,$importe_cuota);


$pdf->SetX(200);
$pdf->Cell(40,5,$importe_cuota);


$pdf->Code39(10,90,$cod_barra,1,10);
//$pdf->Code39(130,90,$cod_barra,1,10);

$pdf->Ln();

$pdf->AddPage();


$result2->MoveNext();


}




$pdf->Output();
?>