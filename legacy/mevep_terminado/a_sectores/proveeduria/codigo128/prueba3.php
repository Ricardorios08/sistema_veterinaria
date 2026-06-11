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
$b = $desde + 250;

$a1 = $a;
$b1 = $b;


require('code128.php');
require('Barcode.php');

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




$pdf=new PDF_Code128('P','mm','A4');
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
 
 /////// 1 
$pdf->Code128(44,33,$a1,30,7);
$pdf->SetXY(49,25);
$pdf->Write(10,$a1);


$pdf->Code128(44,63.5,$a1,30,7);
$pdf->SetXY(49,55.5);
$pdf->Write(10,$a1);

$pdf->Code128(44,90,$a1,30,5);
$pdf->SetXY(49,82.5);
$pdf->Write(10,$a1);


/////// 1 
$pdf->Code128(133,33,$b1,30,7);
$pdf->SetXY(138,25);
$pdf->Write(10,$b1);

$pdf->Code128(133,63.5,$b1,30,7);
$pdf->SetXY(138,55.5);
$pdf->Write(10,$b1);

$pdf->Code128(133,90,$b1,30,5);
$pdf->SetXY(138,82.5);
$pdf->Write(10,$b1);


 
$fontSize = 8;
  $marge    = 0;   // between barcode and hri in pixel
  $x        = 26;  // barcode center
  $y        = 155;  // barcode center
  $height   = 5;   // barcode height in 1D ; module size in 2D
  $width    = 0.2;    // barcode height in 1D ; not use in 2D
  $angle    = 90;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  
$code     = '123456789012'; // barcode, of course ;)
$code   = '000000789012'; // barcode, of course ;)
  $type     = 'code128';
  $black    = '000000'; // color in hexa


 $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  
  // -------------------------------------------------- //
  //                      HRI
  // -------------------------------------------------- //
  
  $pdf->SetFont('Arial','','8');
  $pdf->SetTextColor(0, 0, 0);
  $len = $pdf->GetStringWidth($data['hri']);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  //$pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);


//$pdf->Code128(23,145,$a1,12,20);
$pdf->SetXY(23,149);
//$pdf->Write(10,$a1);
$pdf->TextWithDirection(21,146,$a1,'D');



//////////////////////////////////////////////////////////

$fontSize = 8;
  $marge    = 0;   // between barcode and hri in pixel
  $x        = 119;  // barcode center
  $y        = 155;  // barcode center
  $height   = 5;   // barcode height in 1D ; module size in 2D
  $width    = 0.2;    // barcode height in 1D ; not use in 2D
  $angle    = 90;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  
  $code     = '123456789012'; // barcode, of course ;)
    $code   = $b1; // barcode, of course ;)
  $type     = 'code128';
  $black    = '000000'; // color in hexa


 $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  

  // -------------------------------------------------- //
  //                      HRI
  // -------------------------------------------------- //
  
  $pdf->SetFont('Arial','','8');
  $pdf->SetTextColor(0, 0, 0);
  $len = $pdf->GetStringWidth($data['hri']);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  //$pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);



//$pdf->Code128(23,145,$a1,12,20);
$pdf->SetXY(23,150);
//$pdf->Write(10,$a1);
$pdf->TextWithDirection(114,146,$b1,'D');





//$pdf->Code128(116,145,$b1,12,20);
//$pdf->SetXY(116,137);
//$pdf->Write(10,$b1);
//$pdf->TextWithDirection(113,150,$b1,'D');



} // fin matriz



$pdf->Output();
?>


