<?php

 

 $nom= $_REQUEST['nom'];
 
$cant= $_REQUEST['cant'];
$nombre = $nom."_horizontales_3_codigos.pdf";

$desde = $_REQUEST['desde'];
$hasta= $_REQUEST['hasta'];

$nom= $_REQUEST['nom'];
$nombre = $nom."_horizontales_2_codigos.pdf";

$desde1 = $_REQUEST['desde1'];
$hasta1= $_REQUEST['hasta1'];

$desde2 = $_REQUEST['desde2'];
$hasta2= $_REQUEST['hasta2'];

$desde3 = $_REQUEST['desde3'];
$hasta3= $_REQUEST['hasta3'];

$desde4 = $_REQUEST['desde4'];
$hasta4= $_REQUEST['hasta4'];

$a = $desde;
$b = $desde + $cant;

$a1 = $a;
$b1 = $b;


require('code128.php');



$pdf=new PDF_Code128('L','mm','A4');
$pdf->SetDisplayMode(80,'default'); 
 

for ($i = $desde; $i <= $hasta; $i++) { // matriz


$pdf->AddPage();


$a1 = $a1 + 1; 
$b1 = $b1 + 1; 
$c1 = $c1 + 1; 
$d1 = $d1 + 1; 


$pdf->SetFont('Arial','',8);


$a1 =  str_pad($a1, 12, "0", STR_PAD_LEFT);
$b1 =  str_pad($b1, 12, "0", STR_PAD_LEFT);
 



$pdf->Code128(127,118,$b1,50,7);
$pdf->TextWithDirection(162,115,$b1,'L');



$pdf->Code128(127,25,$a1,50,7);
$pdf->TextWithDirection(162,22,$a1,'L');



// R L U D 
} // fin matriz



$pdf->Output($nombre,'D');
?>


