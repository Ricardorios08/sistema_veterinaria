<?php
	header("Content-type: image/png");
	
	$radio=150;
	$inc=80;
	
	$w=$radio*2+$inc;
	$h=$radio*2+$inc;
	$img = imagecreate($w, $h)  or die("Error. no s epuede crear");
	$background = imagecolorallocate($img, 235, 245, 225);
	$blanco = imagecolorallocate($img, 255, 255, 255);	
	$negro  = imagecolorallocate($img, 0, 0, 0);

	for($i=0; $i<=$w; $i+=10)
	  { imageline ( $img, 0,$i, $w, $i, $blanco);
	  	imageline ( $img, $i,0, $i, $h, $blanco);
	  }

	for($i=0; $i<=($radio*2); $i++)
	{ $x = $radio-$i;
	  $y= sqrt(pow($radio,2)-pow($x,2));	  
	  $color  = imagecolorallocate($img, $i, 150,255-$i);
	  imageline ($img,($w/2)+$x,($h/2)+$y,($w/2)+$x,($h/2+-$y),$color);
   }
  	imageline ( $img,$inc/4,$h/2,$w-($inc/4),$h/2, $negro);
  	imageline ( $img,$w/2,$inc/4,$w/2,$h-($inc/4), $negro);
	imagestring($img, 2, 10,10,  " CIRCULO EN FADE", $negro);
	imagestring($img, 1, $w/2, $inc/4,  " EJE Y", $negro);
	imagestring($img, 1, $inc/4, $h/2+5,  "EJE X", $negro);

	imagepng($img);
	imagedestroy($img);
?> 