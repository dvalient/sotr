<?php
/*==================++
||		MAIN 		||
++==================*/
    include_once('lee_shares_drawer.php');

//	$pantalla = json_decode(file_get_contents('Views/Pantalla/pantalla.json'),true);
	$pantalla = json_decode(file_get_contents('pantalla.json'),true);
	
	$img = imagecreate($pantalla[0]["w"], $pantalla[0]["h"]);
	$color = imagecolorallocate($img, $pantalla[0]["rp"],$pantalla[0]["gp"], $pantalla[0]["bp"]);

/*	$color = imagecolorallocate($img, 255, 255, 255);
	imagestring($img, 3, 20, 10, "leyenda" , $color);
*/	
	foreach($pantalla as $e){
		switch ($e["tipo"]) {	
			case 'leyenda':
				$x = $e["gx"] + $e["x"];
				$y = $e["gy"] + $e["y"];
				$font = $e["dimension"];
				$texto = $e["nombre"];

				$color = imagecolorallocate($img, $e["ri"], $e["gi"], $e["bi"]);
				imagestring($img, $font, $x, $y, $texto, $color);
			break;

			case 'linea':
				$x = $e["gx"] + $e["x"];
				$y = $e["gy"] + $e["y"];
				$xx = $e["gx"] + $e["xx"];
				$yy = $e["gy"] + $e["yy"];
				
				$grosor = $e["dimension"];
//				$texto = $e["leyenda"];

				$color = imagecolorallocate($img, $e["ri"], $e["gi"], $e["bi"]);
				imagesetthickness($img, $grosor);
				imageline($img, $x, $y, $xx, $yy, $color);
				
			break;
			
			case 'seccionador':
				$x = $e["gx"] + $e["x"];
				$y = $e["gy"] + $e["y"];
							
				$alto = $e['alto'];
				$ancho = $e['ancho'];
				$margenV = $e['margenV'];
				$margenH = $e['margenH'];
				$grosor = $e["dimension"];
				
			
				$xmedio = $x + $margenH + (($ancho - 2 * $margenH) / 2);
				$ymedio = $y + $margenV + (($alto - 2 * $margenV) / 2);
				
				$x1 =  $x + $margenH;
				$y1 =  $y + $margenV;
				$x2 = $x + $ancho-$margenH;
				$y2 = $y + $alto - $margenV;
				$x3 = $x + $ancho;
				$y3 = $y + $alto;
				
				//	imagerectangle($img, $x, $y, $x + $ancho, $y + $alto, $colores["verde"]);
				// cuadro
				$blanco = imagecolorallocate($img, 255, 255, 255);
				$colorin = imagecolorallocate($img, $e["ri"], $e["gi"], $e["bi"]);
				$colorout = imagecolorallocate($img, $e["ro"], $e["go"], $e["bo"]);
				imagesetthickness($img, $grosor);
				
				imageline($img, $x1, $y1, $x2, $y1, $blanco);// H sup
				imageline($img, $x1, $y1, $x1, $y2, $blanco);//Y Izq
				imageline($img, $x1, $y2, $x2, $y2, $blanco);// H sup
				imageline($img, $x2, $y1, $x2, $y2, $blanco);//Y Izq
			
				imageline($img, $xmedio, $y, $xmedio, $y1, $colorin);//conector arriba
				imageline($img, $xmedio, $y2, $xmedio, $y3, $colorout);// conector abajo
				
				imagearc($img, $xmedio, $y1 + 2 , 3, 3, 0 , 359, $blanco);
				imagearc($img, $xmedio, $y2 - 2 , 3, 3, 0 , 359, $blanco);
				
				$variable = $e["variable"];
				if ($variable != NULL){
					$xestado = ($valores[$variable] == 1) ? $xmedio + 7 : $xmedio ;
					imageline($img, $xestado, $y1+3, $xmedio, $y2, $blanco);// Llave off
				} else {
					imageline($img, $x1, $ymedio, $x2, $ymedio, $blanco);// Llave off
				}

			//	imageline($img, $xmedio, $y1+3, $xmedio, $y2, $colorin);// Llave off

			break;
			
			case 'generador':
				$x = $e["gx"] + $e["x"];
				$y = $e["gy"] + $e["y"];
							
				$alto = $e['alto'];
				$ancho = $e['ancho'];
				$margenV = $e['margenV'];
				$margenH = $e['margenH'];
				$grosor = $e["dimension"];
				$radio = $e["radio"];
				
				$xmedio = $x + $margenH + (($ancho - 2 * $margenH) / 2);
				$ymedio = $y + $margenV + (($alto - 2 * $margenV) / 2);
				
				$x1 =  $x + $margenH;
				$y1 =  $y + $margenV;
				$x2 = $x + $ancho-$margenH;
				$y2 = $y + $alto - $margenV;
				$x3 = $x + $ancho;
				$y3 = $y + $alto;
				
				$colorin = $color = imagecolorallocate($img, $e["ri"], $e["gi"], $e["bi"]);
				imagesetthickness($img, $grosor);
				
				imageline($img, $xmedio, $y, $xmedio, $y1, $colorin);
				
				imagearc($img, $xmedio, $ymedio, $radio, $radio, 0 , 359, $colorin);
				imagearc($img, $xmedio-4, $ymedio, $radio/3, $radio/3, 0 , 180, $colorin);
				imagearc($img, $xmedio+4, $ymedio, $radio/3, $radio/3, 180 , 40, $colorin);
				//	imagearc($img,  $Cx, $Cy+10+12+13, 25, 25, 0 , 359, $colores["naranja"]);
				imageline($img, $xmedio, $y2, $xmedio, $y3, $colorin);
				imageline($img, $x1, $y3, $x2, $y3, $colorin);
			break;
			
			case 'trafosimple':
				$x = $e["gx"] + $e["x"];
				$y = $e["gy"] + $e["y"];
							
				$alto = $e['alto'];
				$ancho = $e['ancho'];
				$margenV = $e['margenV'];
				$margenH = $e['margenH'];
				$grosor = $e["dimension"];
				$radio = $e["radio"];
				
				$xmedio = $x + $margenH + (($ancho - 2 * $margenH) / 2);
				$ymedio = $y + $margenV + (($alto - 2 * $margenV) / 2);
				
				$x1 =  $x + $margenH;
				$y1 =  $y + $margenV;
				$x2 = $x + $ancho-$margenH;
				$y2 = $y + $alto - $margenV;
				$x3 = $x + $ancho;
				$y3 = $y + $alto;
				
				$colorin = $color = imagecolorallocate($img, $e["ri"], $e["gi"], $e["bi"]);
				$colorout = $color = imagecolorallocate($img, $e["ro"], $e["go"], $e["bo"]);
				imagesetthickness($img, $grosor);

				imageline($img, $xmedio, $y, $xmedio, $y1, $colorin);
				
				imagearc($img,  $xmedio, $ymedio-5, $radio, $radio, 0 , 359, $colorin);
				imagearc($img,  $xmedio, $ymedio+5, $radio, $radio, 0 , 359, $colorout);
				
				imageline($img, $xmedio, $y2, $xmedio, $y3, $colorout);
			break;
			
			case 'variable':
				$x = $e["gx"] + $e["x"];
				$y = $e["gy"] + $e["y"];
				$font = $e["dimension"];
				$color = imagecolorallocate($img, $e["ri"], $e["gi"], $e["bi"]);

				$variable = $e["variable"];
				if ($variable != NULL){
					$valor_num = round($valores[$variable],1);
					
					$color = imagecolorallocate($img, $e["ri"], $e["gi"], $e["bi"]);
					imagestring($img, $font, $x, $y, $valor_num, $color);
				}
			break;

		}
	}

/*	
	$hora=$hora . ":" . $minuto . ":" . $segundo;
	imagestring($img, 4, 4, 4, "ULTIMA ACTUALIZACION", $colores["celeste"]);
	imagestring($img, 4, 165, 4, $fecha .$hora . "   -F11 expande/comprime la pantalla-" , $colores["celeste"]);
*/
	$src = imagecreatefrompng('../../img/CCATransparente.png');
	imagecopymerge($img, $src, 1100, 1, 0, 0, 170, 44, 100);
	header("Content-type: image/png");
	imagepng($img);
	imagedestroy($img);
	
/*==================++
||	END MAIN 		||
++==================*/

?>