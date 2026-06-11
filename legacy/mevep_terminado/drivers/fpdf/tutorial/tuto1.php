<?php
require('../fpdf.php');

$pdf=new FPDF();
$pdf->AddPage('a5');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Rect(5,5,10,10, [1];

$pdf->Output();
?>
