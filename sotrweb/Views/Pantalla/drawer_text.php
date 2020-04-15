<?php

	header("Content-type: image/png");
	
	global $fullPantalla;
	
	$img = imagecreate(1100, 600);
	$color = imagecolorallocate($img, 30, 30, 30);
	$x= 20;
	$y=20;
	
	
	$color = imagecolorallocate($img, 255, 255, 255);
	$font = 3;
	$texto = "leyenda";
	
	imagestring($img, $font, $x, $y, $texto, $color);
	/*
	foreach( $fullPantalla as $P=>$E ){
			$x += 1; 
	};
*/
	imagepng($img);
	imagedestroy($img);
	
?>