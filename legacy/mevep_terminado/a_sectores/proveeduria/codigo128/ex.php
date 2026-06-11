<?php

 

 


$desde = $_REQUEST['desde'];
$hasta= $_REQUEST['hasta'];




$desde1 = $_REQUEST['desde1'];
$hasta1= $_REQUEST['hasta1'];

$desde2 = $_REQUEST['desde2'];
$hasta2= $_REQUEST['hasta2'];

$desde3 = $_REQUEST['desde3'];
$hasta3= $_REQUEST['hasta3'];

$desde4 = $_REQUEST['desde4'];
$hasta4= $_REQUEST['hasta4'];

$a = $desde;
$b = $desde + 125;
$c = $b + 125;
$d = $c + 125;

$a1 = $a;
$b1 = $b;
$c1 = $c;
$d1 = $d;


require('code128.php');

$pdf=new PDF_Code128('L','mm','A4');

 

$code='1245678';

for ($i = $desde; $i <= $hasta; $i++) { // matriz


$pdf->AddPage();


$a1 = $a1 + 1; 
$b1 = $b1 + 1; 
$c1 = $c1 + 1; 
$d1 = $d1 + 1; 


$pdf->SetFont('Arial','',8);

 
 /////// 1 
$pdf->Code128(15,35,$a1,30,7);
$pdf->SetXY(15,28.5);
$pdf->Write(10,$a1);

$pdf->Code128(15,58,$a1,30,7);
$pdf->SetXY(15,51.5);
$pdf->Write(10,$a1);

$pdf->Code128(15,77,$a1,30,5);
$pdf->SetXY(15,70.8);
$pdf->Write(10,$a1);


/////// 1 
$pdf->Code128(89,35,$b1,30,7);
$pdf->SetXY(89,28.5);
$pdf->Write(10,$b1);

$pdf->Code128(89,58,$b1,30,7);
$pdf->SetXY(89,51.5);
$pdf->Write(10,$b1);

$pdf->Code128(90,77,$b1,30,5);
$pdf->SetXY(89,70.8);
$pdf->Write(10,$b1);



/////// 1 
$pdf->Code128(157,35,$c1,30,7);
$pdf->SetXY(157,28.5);
$pdf->Write(10,$c1);


$pdf->Code128(157,58,$c1,30,7);
$pdf->SetXY(157,51.5);
$pdf->Write(10,$c1);

$pdf->Code128(157,77,$c1,30,5);
$pdf->SetXY(157,70.8);
$pdf->Write(10,$c1);



/////// 1 
$pdf->Code128(236,35,$d1,30,7);
$pdf->SetXY(236,28.5);
$pdf->Write(10,$d1);

$pdf->Code128(236,58,$d1,30,7);
$pdf->SetXY(236,51.5);
$pdf->Write(10,$d1);

$pdf->Code128(236,77,$d1,30,5);
$pdf->SetXY(236,70.8);
$pdf->Write(10,$d1);






} // fin matriz



$pdf->Output();

<?php
  include('Barcode.php');
 
  
  // -------------------------------------------------- //
  //                      USEFULL
  // -------------------------------------------------- //
  
  class eFPDF extends FPDF{
    function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
    {
        $font_angle+=90+$txt_angle;
        $txt_angle*=M_PI/180;
        $font_angle*=M_PI/180;
    
        $txt_dx=cos($txt_angle);
        $txt_dy=sin($txt_angle);
        $font_dx=cos($font_angle);
        $font_dy=sin($font_angle);
    
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }
  }

  // -------------------------------------------------- //
  //                  PROPERTIES
  // -------------------------------------------------- //
  
  $fontSize = 10;
  $marge    = 10;   // between barcode and hri in pixel
  $x        = 200;  // barcode center
  $y        = 200;  // barcode center
  $height   = 50;   // barcode height in 1D ; module size in 2D
  $width    = 2;    // barcode height in 1D ; not use in 2D
  $angle    = 45;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  
  $code     = '123456789012'; // barcode, of course ;)
  $type     = 'ean13';
  $black    = '000000'; // color in hexa
  
  
  // -------------------------------------------------- //
  //            ALLOCATE FPDF RESSOURCE
  // -------------------------------------------------- //
    
  $pdf = new eFPDF('P', 'pt');
  $pdf->AddPage();
  
  // -------------------------------------------------- //
  //                      BARCODE
  // -------------------------------------------------- //
  
  $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  
  // -------------------------------------------------- //
  //                      HRI
  // -------------------------------------------------- //
  
  $pdf->SetFont('Arial','B',$fontSize);
  $pdf->SetTextColor(0, 0, 0);
  $len = $pdf->GetStringWidth($data['hri']);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  $pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);
  
  $pdf->Output();
?>


?>


