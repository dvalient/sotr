<?php
$bases = array();

$img = imagecreate(1300, 660);
$negro = imagecolorallocate($img, 50, 50, 50);

$colores["blanco"] = imagecolorallocate($img, 255, 255, 255);	//0 white
$colores["negro"] = imagecolorallocate($img, 0, 0, 0);			//1 black
$colores["rojo"] = imagecolorallocate($img, 255, 0, 0);			//2 red
$colores["verde"] = imagecolorallocate($img, 0, 176, 0);		//3 green
$colores["azul"] = imagecolorallocate($img, 0, 0, 255);			//4 blue
$colores["amarillo"] = imagecolorallocate($img, 255, 255, 0);	//5 yellow
$colores["naranja"] = imagecolorallocate($img, 255, 128, 0);    //6 orange
$colores["celeste"] = imagecolorallocate($img, 0, 176, 255);	//4 blue

$colores["grisclaro"] = imagecolorallocate($img, 230, 230, 230);
$colores["grismedio"] = imagecolorallocate($img, 215, 215, 215);
$colores["grisoscuro"] = imagecolorallocate($img, 200, 200, 200);

$colores["abierto"] = imagecolorallocate($img, 255, 255, 255);
$colores["cerrado"] = imagecolorallocate($img, 155, 105, 055);
$colores["indefinido"] = imagecolorallocate($img, 228, 225, 32);

/*
$colores["colorArriba"] = imagecolorallocate($img, 0, 176, 0);		//3 green
$colores["colorAbajo"] = imagecolorallocate($img, 255, 128, 0);     //6 orange
$colores["colorFondo"] = imagecolorallocate($img, 215, 215, 215);	//gris medio
*/

/*----------------------------------------------+
|	conversion de binario a flotante en php		|
+----------------------------------------------*/
function bin2float ($bin) {
	
	((ord($bin[0])>>7)==0)?$sign=1:$sign=-1;

	((ord($bin[0])>>6)%2==1)?$exponent=1:$exponent=-127;
	
	$exponent+=(ord($bin[0])%64)*2;
	$exponent+=ord($bin[1])>>7;
	$base=1.0;

	for($k=1;$k<8;$k++) {
		$base+=((ord($bin[1])>>(7-$k))%2)*pow(0.5,$k);
	}
	for($k=0;$k<8;$k++) {
		$base+=((ord($bin[2])>>(7-$k))%2)*pow(0.5,$k+8);
	}
	for($k=0;$k<8;$k++) {
		$base+=((ord($bin[3])>>(7-$k))%2)*pow(0.5,$k+16);
	}
	
	$float=(float)$sign*pow(2,$exponent)*$base;
	return $float;
}

?>