<?php

include_once "globales.php";	//define var globales, colores y tablas
include_once "lee_shares.php";	// carga contenidos de archivos en arrays

/*----------------------------------+
|	Dibuja Leyendas desde un array	|
+----------------------------------*/
function leyendas($leyendas){
	global $colores, $img, $bases;
	
	foreach ($leyendas as $l){	
		
		$Leyenda_X1 	= $FullPantalla["gx"] + $FullPantalla["x"];
		$Leyenda_Y1 	= $FullPantalla["gy"] + $FullPantalla["y"];

		$Leyenda_Font 	= $FullPantalla["dimension"];
		$Leyenda_Leyenda = $FullPantalla["leyenda"];
	  	$color    		= imagecolorallocate($img, $FullPantalla["r"], $FullPantalla["g"], $FullPantalla["b"]);
				
		imagestring($img,$Leyenda_Font, $Leyenda_X1, $Leyenda_Y1, $Leyenda_Leyenda, $color);
	}
}

/*--------------------------------------------------+
|	Dibuja Barras de Tensión Lineas desde un array	|
+--------------------------------------------------*/
function barrastension($barras){
	global $colores, $img, $bases, $valores;
	
	foreach ($barras as $b){	
/*
		echo("<pre>");
		print_r($b);
		echo("</pre>");
*/			

		$Leyenda_X1 	= $FullPantalla["gx"] + $FullPantalla["x"];
		$Leyenda_Y1 	= $FullPantalla["gy"] + $FullPantalla["y"];

		$Linea_X2 = $FullPantalla["gx"] + $FullPantalla["xx"];
		$Linea_Y2 = $FullPantalla["gy"] + $FullPantalla["yy"];

		$Color    = imagecolorallocate($img, $FullPantalla["r"], $FullPantalla["g"], $FullPantalla["b"]);
		$Grosor   = $FullPantalla["dimension"];
	
		imagesetthickness($img, $Grosor);
	    imageline($img, $Linea_X1, $Linea_Y1, $Linea_X2, $Linea_Y2, $Color);

	}
}

/*----------------------------------+
|	Dibuja Lineas desde un array	|
+----------------------------------*/
function lineas($lineas){
	global $colores, $img, $bases;
	
	$x 	= $FullPantalla["gx"] + $FullPantalla["x"];
	$y 	= $FullPantalla["gy"] + $FullPantalla["y"];

	$xx = $FullPantalla["gx"] + $FullPantalla["xx"];
	$yy = $FullPantalla["gy"] + $FullPantalla["yy"];

	$Color    = imagecolorallocate($img, $FullPantalla["r"], $FullPantalla["g"], $FullPantalla["b"]);
	$Grosor   = $FullPantalla["dimension"];

	imagesetthickness($img, $Grosor);
	imageline($img, $x, $y, $xx, $yy, $color);
}

/*--------------------------------------+
|	Dibuja Seccionadores desde un array	|
+--------------------------------------*/
function seccionadores($seccionadores){
	global $colores, $img, $bases, $valores, $arregloMaquinasNuevas;
	
	$x 	= $FullPantalla["gx"] + $FullPantalla["x"];
	$y 	= $FullPantalla["gy"] + $FullPantalla["y"];

	$grosor = $FullPantalla["dimension"];
	
	imagesetthickness($img, $grosor);
	
	imageline($img, $x+37, $Cy, $Cx+37, $Cy+12, $colores["verde"]); //línea vertical de arriba

	imageline($img, $Cx+26, $Cy+12, $Cx+48, $Cy+12, $colores["grisclaro"]);//arriba
	imageline($img, $Cx+26, $Cy+12, $Cx+26, $Cy+12+15, $colores["grisclaro"]);//izquierda
	imageline($img, $Cx+26, $Cy+12+15, $Cx+48, $Cy+12+15, $colores["grisclaro"]);//abajo
	imageline($img, $Cx+48, $Cy+12, $Cx+48, $Cy+12+15, $colores["grisclaro"]);//derecha
	//Dibujo los dos puntitos dentro del rectángulo
	imagearc($img,  $Cx+37, $Cy+12+2, 3, 3, 0 , 359, $colores["grisclaro"]);
	imagearc($img,  $Cx+37, $Cy+12+15-2, 3, 3, 0 , 359, $colores["grisclaro"]);
	
	$Cx2 = ($valores[$seccionador] == 1)? $Cx + 7 : $Cx ;

	imageline($img, $Cx+37,  $Cy+12+2+10, $Cx2+37,  $Cy+12+2, $colores["grisclaro"]);
	imageline($img, $Cx+37, $Cy+12+15+1, $Cx+37, $Cy+12+15+10, $colores["verde"]);//línea vertical de abajo

//		imageline($img, $Cx, $Cy+12+15+10, $Cx+75, $Cy+12+15+10, $colores["verde"]);//línea larga horizontal (largo 75px)	}
}

/*--------------------------------------------------+
|	Dibuja Acoplamiento de barras desde un array	|
+--------------------------------------------------*/
function acoplamientobarra($acoplamientos){
	global $colores, $img, $bases, $valores;
	
	foreach ($acoplamientos as $ab){	
/*
		echo("<pre>");
		print_r($b);
		echo("</pre>");
*/			

		$Xbase 	  = $bases[$ab["base"]]["x"]; //$l["xbase"];
		$Ybase 	  = $bases[$ab["base"]]["y"]; //$l["ybase"];
		$Cx = $ab["cx"] + $Xbase;
		$Cy = $ab["cy"] + $Ybase;
		$L_Int1= $ab["seccionador_a"];
		$L_Int2= $ab["seccionador_b"];
		
		imagesetthickness($img, 1);
		imageline($img, $Cx, $Cy, $Cx, $Cy+12, $colores["verde"]);
		imageline($img, $Cx+40, $Cy-30, $Cx+40, $Cy+12, $colores["verde"]);
		
		//Dibujo el rectángulo
		imageline($img, $Cx-11, $Cy+12, $Cx+11, $Cy+12, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12, $Cx-11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12+15, $Cx+11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx+11, $Cy+12, $Cx+11, $Cy+12+15, $colores["grisclaro"]);

		
		//Dibujo los dos puntitos dentro del rectángulo
		imagearc($img,  $Cx, $Cy+12+2, 3, 3, 0 , 359, $colores["grisclaro"]);
		imagearc($img,  $Cx, $Cy+12+15-2, 3, 3, 0 , 359, $colores["grisclaro"]);
		
		$Cx2 = ($valores[$L_Int1] == 1 )? $Cx + 7 : $Cx ; // Si esta abierto desplazo 7 
		imageline($img, $Cx,  $Cy+12+2+10, $Cx2,  $Cy+12+2, $colores["grisclaro"]);

		imageline($img, $Cx, $Cy+12+15, $Cx, $Cy+12+15+10, $colores["verde"]);
		imageline($img, $Cx+40, $Cy+12+15, $Cx+40, $Cy+12+15+10, $colores["verde"]);
		imageline($img, $Cx, $Cy+12+15+10, $Cx+40, $Cy+12+15+10, $colores["verde"]);

		//Dibujo el rectángulo
		imageline($img, $Cx+40-11, $Cy+12, $Cx+40+11, $Cy+12, $colores["grisclaro"]);
		imageline($img, $Cx+40-11, $Cy+12, $Cx+40-11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx+40-11, $Cy+12+15, $Cx+40+11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx+40+11, $Cy+12, $Cx+40+11, $Cy+12+15, $colores["grisclaro"]);
		
		//Dibujo los dos puntitos dentro del rectángulo
		imagearc($img,  $Cx+40, $Cy+12+2, 3, 3, 0 , 359, $colores["grisclaro"]);
		imagearc($img,  $Cx+40, $Cy+12+15-2, 3, 3, 0 , 359, $colores["grisclaro"]);
		
		$Cx2 = ($valores[$L_Int2] == 1 )? $Cx + 7 : $Cx ; // Si esta abierto desplazo 7 
		imageline($img, $Cx+40, $Cy+12+2+10, $Cx2+40, $Cy+12+2, $colores["grisclaro"]);
	}
}

/*----------------------------------------+
|	Dibuja Trafos Simples desde un array  |
+----------------------------------------*/
function trafosimples($trafos){
	global $colores, $img, $bases;
	
	foreach ($trafos as $ts){	
		$Xbase 	  = $bases[$ts["base"]]["x"]; //$l["xbase"];
		$Ybase 	  = $bases[$ts["base"]]["y"]; //$l["ybase"];

		$Cx = $ts["cx"] + $Xbase;
		$Cy = $ts["cy"] + $Ybase;

		imagesetthickness($img, 2);
		imageline($img, $Cx, $Cy, $Cx, $Cy+10, $colores["verde"]);
		
		imagearc($img,  $Cx, $Cy+10+12, 25, 25, 0 , 359, $colores["verde"]);
		imagearc($img,  $Cx, $Cy+10+12+13, 25, 25, 0 , 359, $colores["naranja"]);
		
		imageline($img, $Cx, $Cy+10+12+13+12, $Cx, $Cy+10+12+13+12+10, $colores["naranja"]);
	}
}

/*--------------------------------------+
|	Dibuja semicampos desde un array	|
+--------------------------------------*/
function semicampos($semicampos){
	global $colores, $img, $bases, $valores;
	
	foreach ($semicampos as $sc){	
		$Xbase 	  = $bases[$sc["base"]]["x"]; //$l["xbase"];
		$Ybase 	  = $bases[$sc["base"]]["y"]; //$l["ybase"];

		$Cx = $sc["cx"] + $Xbase;
		$Cy = $sc["cy"] + $Ybase;
		
		$Valor1= $sc["v1"];
		$Valor2= $sc["v2"];
		$Valor3= $sc["v3"]; 
		$Identificador = $sc["interruptor"]; 
		$Leyenda_Interruptor3= $sc["cartel"]; 
		$color    = $colores[$sc["color"]];
		$grosor   = $sc["grosor"];


		imagesetthickness($img, $grosor);
		imageline($img, $Cx, $Cy, $Cx, $Cy+13, $color);
		imageline($img, $Cx, $Cy+28, $Cx, $Cy+50, $color);

		// Interruptor
		imageline($img, $Cx, $Cy+13, $Cx, $Cy+16, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12, $Cx+11, $Cy+12, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12, $Cx-11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12+15, $Cx+11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx+11, $Cy+12, $Cx+11, $Cy+12+15, $colores["grisclaro"]);
		imagearc($img,  $Cx, $Cy+12+2, 3, 3, 0 , 359, $colores["grisclaro"]);
		imagearc($img,  $Cx, $Cy+12+15-2, 3, 3, 0 , 359, $colores["grisclaro"]);
		
		if (strlen($Identificador)>0)
			$Cx2 = (($valores[$Identificador]) == 1 )? $Cx+7 : $Cx;
		else
			$Cx2 = $Cx;
			
		imageline($img, $Cx, $Cy+26, $Cx2, $Cy+16, $colores["grisclaro"]);

		// Generador
		imagearc($img, $Cx,   $Cy+50+12, 25, 25,  0, 359, $color);
		imagearc($img, $Cx-3, $Cy+50+12, 6, 9,  0, 180, $color);
		imagearc($img, $Cx+3, $Cy+50+12, 6, 9,  180, 360, $color);
		imageline($img, $Cx,  $Cy+50+12+12, $Cx,    $Cy+50+12+12+10, $color);
		imageline($img, $Cx-10,  $Cy+50+12+12+10, $Cx+10, $Cy+50+12+12+10, $color);
		// Cartel
		 imagestring($img, 4, $Cx-50,$Cy+50,  $Leyenda_Interruptor3 , $colores["celeste"]);

		if (strlen($Valor1)>0){
			$valor_num = round($valores[$Valor1],1);

	//		imagestring($img, 4, $Cx-25, $Cy+50+12+12+10+8,  $valor_num." MW", $colores["grisclaro"]);
			imagestring($img, 4, $Cx-27, $Cy+50+12+12+10+8,  $valor_num." MW", $colores["grisclaro"]);
		}

		if (strlen($Valor2)>0){
			$valor_num = round($valores[$Valor2],1);
	//		imagestring($img, 4, $Cx-25, $Cy+50+12+12+10+8+12,  $valor_num." MVAR", $colores["grisclaro"]);
			imagestring($img, 4, $Cx-25, $Cy+50+12+12+10+8+14,  $valor_num." MVAR", $colores["grisclaro"]);
		}
		
		if (strlen($Valor3)>0){
			$valor_num = round($valores[$Valor3],1);
//			imagestring($img, 4, $Cx-25,$Cy+50+12+12+10+8+12+12,  $valor_num." KV", $colores["grisclaro"]);
			imagestring($img, 4, $Cx-25,$Cy+50+12+12+10+8+12+14,  $valor_num." KV", $colores["grisclaro"]);		}
		}
}

/*------------------------------------------+
|	Dibuja camposcompletos A desde un array	|
+------------------------------------------*/
function camposcompletosA($completosA){
	global $colores, $img, $bases, $valores;
	
	foreach ($completosA as $ca){	
		$Xbase 	  = $bases[$ca["base"]]["x"]; //$l["xbase"];
		$Ybase 	  = $bases[$ca["base"]]["y"]; //$l["ybase"];

		$Cx = $ca["cx"] + $Xbase;
		$Cy = $ca["cy"] + $Ybase;
		$Valor1= $ca["v1"];
		$Valor2= $ca["v2"];
		$interruptor = $ca["Interruptor"]; 
		$cartel= $ca["Cartel"]; 

		imagesetthickness($img, 1);
		imageline($img, $Cx, $Cy, $Cx, $Cy+13, $colores["verde"]);//Línea vertical de arriba
		imageline($img, $Cx, $Cy+28, $Cx, $Cy+50, $colores["verde"]);

		//Interruptor
		imageline($img, $Cx, $Cy+13, $Cx, $Cy+16, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12, $Cx+11, $Cy+12, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12, $Cx-11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12+15, $Cx+11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx+11, $Cy+12, $Cx+11, $Cy+12+15, $colores["grisclaro"]);
		imagearc($img,  $Cx, $Cy+12+2, 3, 3, 0 , 359, $colores["grisclaro"]);
		imagearc($img,  $Cx, $Cy+12+15-2, 3, 3, 0 , 359, $colores["grisclaro"]);

//		$Cx2 = (($abierto_int[$interruptor]) == 2 )? $Cx+7 : $Cx;
		$Cx2 = (($valores[$interruptor]) == 1 )? $Cx+7 : $Cx;
		
		imageline($img, $Cx, $Cy+26, $Cx2, $Cy+16, $colores["grisclaro"]);

		imagearc($img,  $Cx, $Cy+50+12, 25, 25, 0 , 359, $colores["verde"]);
		imagearc($img,  $Cx, $Cy+50+12+13, 25, 25, 0 , 359, $colores["colorAbajo"]);
		
		imageline($img, $Cx, $Cy+50+12+13+12, $Cx, $Cy+50+12+13+12+10, $colores["colorAbajo"]);
		imagearc($img, $Cx,   $Cy+50+12+13+12+10+12, 25, 25,  0, 359, $colores["colorAbajo"]);
		
		imagearc($img, $Cx-3, $Cy+50+12+13+12+10+12, 6, 9,  0, 180, $colores["colorAbajo"]);
		imagearc($img, $Cx+3, $Cy+50+12+13+12+10+12, 6, 9,  180, 360, $colores["colorAbajo"]);
		imageline($img, $Cx,  $Cy+50+12+13+12+10+12+12, $Cx,    $Cy+50+12+13+12+10+12+12+10, $colores["colorAbajo"]);
		imageline($img, $Cx-10,  $Cy+50+12+13+12+10+12+12+10, $Cx+10, $Cy+50+12+13+12+10+12+12+10, $colores["colorAbajo"]);

		// Cartel

//		imagestring($img, 4, $Cx-50,$Cy+50+12+13+12+10, $cartel, $colores["celeste"]);
		imagestring($img, 4, $Cx-45,$Cy+50+12+13+12+10, $cartel, $colores["celeste"]);

		$valor_num=round($valores[$Valor1],1);
//		imagestring($img, 4, $Cx-25,$Cy+50+12+13+12+10+12+12+10+8,  $valor_num . " MW", $colores["grisclaro"]);
		imagestring($img, 4, $Cx-25,$Cy+50+12+13+12+10+12+12+10+8,  $valor_num . " MW", $colores["grisclaro"]);

		$valor_num=round($valores[$Valor2],1);
//		imagestring($img, 4, $Cx-25,$Cy+50+12+13+12+10+12+12+10+8+12,  $valor_num . " MVAR", $colores["grisclaro"]);
		imagestring($img, 4, $Cx-25,$Cy+50+12+13+12+10+12+12+10+8+14,  $valor_num . " MVAR", $colores["grisclaro"]);
	}
}

/*------------------------------------------+
|	Dibuja camposcompletos B desde un array	|
+------------------------------------------*/
function camposcompletosB($completosB){
	global $colores, $img, $valores, $bases;
	
	foreach ($completosB as $cb){	
		$Xbase 	  = $bases[$cb["base"]]["x"]; //$l["xbase"];
		$Ybase 	  = $bases[$cb["base"]]["y"]; //$l["ybase"];

		$Cx = $cb["cx"] + $Xbase;
		$Cy = $cb["cy"] + $Ybase;
		$Valor1= $cb["v1"];
		$Valor2= $cb["v2"];
		$interruptor1 = $cb["Interruptor1"]; 
		$interruptor2 = $cb["Interruptor2"]; 
		$cartel= $cb["Cartel"]; 

		imagesetthickness($img, 1);
		imageline($img, $Cx, $Cy, $Cx, $Cy+13, $colores["verde"]);//Línea vertical de arriba
		imageline($img, $Cx, $Cy+28, $Cx, $Cy+50, $colores["verde"]);

		//Interruptor
		imageline($img, $Cx, $Cy+13, $Cx, $Cy+16, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12, $Cx+11, $Cy+12, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12, $Cx-11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+12+15, $Cx+11, $Cy+12+15, $colores["grisclaro"]);
		imageline($img, $Cx+11, $Cy+12, $Cx+11, $Cy+12+15, $colores["grisclaro"]);
		imagearc($img,  $Cx, $Cy+12+2, 3, 3, 0 , 359, $colores["grisclaro"]);
		imagearc($img,  $Cx, $Cy+12+15-2, 3, 3, 0 , 359, $colores["grisclaro"]);

		$Cx2 = ($valores[$interruptor1] == 1)? $Cx + 7: $Cx;

		imageline($img, $Cx, $Cy+26, $Cx2, $Cy+16, $colores["grisclaro"]);
//		imageline($img, $Cx, $Cy+50+12+13+12+10-1+15-2-1, $Cx2, $Cy+50+12+13+12+10-1+15-2-10, $colores["grisclaro"]);

		imagearc($img,  $Cx, $Cy+50+12, 25, 25, 0 , 359, $colores["verde"]);
		imagearc($img,  $Cx, $Cy+50+12+13, 25, 25, 0 , 359, $colores["colorAbajo"]);
		imageline($img, $Cx, $Cy+50+12+13+12, $Cx, $Cy+50+12+13+12+10, $colores["colorAbajo"]);

		//Interruptor
		imageline($img, $Cx, $Cy+50+12+13+12+10+0, $Cx, $Cy+50+12+13+12+10+3, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+50+12+13+12+10-1, $Cx+11, $Cy+50+12+13+12+10-1, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+50+12+13+12+10-1, $Cx-11, $Cy+50+12+13+12+10-1+15, $colores["grisclaro"]);
		imageline($img, $Cx-11, $Cy+50+12+13+12+10-1+15, $Cx+11, $Cy+50+12+13+12+10-1+15, $colores["grisclaro"]);
		imageline($img, $Cx+11, $Cy+50+12+13+12+10-1, $Cx+11, $Cy+50+12+13+12+10-1+15, $colores["grisclaro"]);
		imagearc($img,  $Cx, $Cy+50+12+13+12+10-1+2, 3, 3, 0 , 359, $colores["grisclaro"]);
		imagearc($img,  $Cx, $Cy+50+12+13+12+10-1+15-2, 3, 3, 0 , 359, $colores["grisclaro"]);
		imageline($img, $Cx, $Cy+50+12+13+12+10-1+15+1, $Cx, $Cy+50+12+13+12+10-1+15+13, $colores["colorAbajo"]);	//línea vertical abajo del último interruptor

		$Cx2 = ($valores[$interruptor2] == 1)? $Cx + 7: $Cx;
				
/*		if (array_key_exists($interruptor2, $abierto_int)) {
			$Cx2 = ($abierto_int[$interruptor2]==2)? $Cx + 7: $Cx;
		} else {
			$Cx2 = ($arregloMaquinasNuevas[$interruptor2] == 1)? $Cx + 7: $Cx;
		}
*/
		imageline($img, $Cx, $Cy+50+12+13+12+10-1+15-2-1, $Cx2, $Cy+50+12+13+12+10-1+15-2-10, $colores["grisclaro"]);

		imagearc($img, $Cx,   $Cy+50+12+13+12+10-1+15+13+12, 25, 25,  0, 359, $colores["colorAbajo"]);
		imagearc($img, $Cx-3, $Cy+50+12+13+12+10-1+15+13+12, 6, 9,  0, 180, $colores["colorAbajo"]);
		imagearc($img, $Cx+3, $Cy+50+12+13+12+10-1+15+13+12, 6, 9,  180, 360, $colores["colorAbajo"]);
		imageline($img, $Cx,  $Cy+50+12+13+12+10-1+15+13+12+12, $Cx,    $Cy+50+12+13+12+10-1+15+13+12+12+10, $colores["colorAbajo"]);//línea vertical de abajo
		imageline($img, $Cx-10,  $Cy+50+12+13+12+10-1+15+13+12+12+10, $Cx+10, $Cy+50+12+13+12+10-1+15+13+12+12+10, $colores["colorAbajo"]);//línea horizontal de abajo
		
		// Cartel
		imagestring($img, 4, $Cx-50,$Cy+50+12+13+12+10+12,  $cartel , $colores["celeste"]);
		
		$numero = round($valores[$Valor1],1);
		
/*		if (array_key_exists($Valor1, $valores)) {
			$numero = round($valores[$Valor1],1);
		} else {
			$numero = round($arregloMaquinasNuevas[$Valor1],1);
		}
*/		
//		imagestring($img, 4, $Cx-25,$Cy+50+12+13+12+10-1+15+13+12+12+10+8,  $numero . " MW", $colores["grisclaro"]);
		imagestring($img, 4, $Cx-25,$Cy+50+12+13+12+10-1+15+13+12+12+10+9,  $numero . " MW", $colores["grisclaro"]);
		
		$numero = round($valores[$Valor2],1);

/*		if (array_key_exists($Valor2, $valores)) {
			$numero = round($valores[$Valor2],1);
		} else {
			$numero = round($arregloMaquinasNuevas[$Valor2],1);
		}
*/
//		imagestring($img, 4, $Cx-25,$Cy+50+12+13+12+10-1+15+13+12+12+10+8+12,  $numero . " MVAR", $colores["grisclaro"]);
		imagestring($img, 4, $Cx-25,$Cy+50+12+13+12+10-1+15+13+12+12+10+8+13,  $numero . " MVAR", $colores["grisclaro"]);	}
}


/*--------------------------------------+
|	Dibuja Valores desde un array	|
+--------------------------------------*/
function valores($variables){
	global $colores, $img, $bases, $valores, $arregloMaquinasNuevas;
	
	foreach ($variables as $v){	
		$Xbase 	  = $bases[$v["base"]]["x"]; //$l["xbase"];
		$Ybase 	  = $bases[$v["base"]]["y"]; //$l["ybase"];

		$Cx = $v["x"] + $Xbase;
		$Cy = $v["y"] + $Ybase;

		$Valor = $v["id_valor"];
		$Unidad = $v["unidad"];

		$valor_num = round($valores[$Valor],1);

/*		if (array_key_exists($Valor, $valores)) {
			$valor_num = round($valores[$Valor],1);
		} else {
			$valor_num = round($arregloMaquinasNuevas[$Valor], 1);
		}
*/
		imagestring($img, 4, $Cx,$Cy,  $valor_num ." ". $Unidad, $colores["grisclaro"]);
	}
}

/*--------------------------------------+
|	Dibuja Valores desde un array	|
+--------------------------------------*/
function valores_blc($variables){
	global $colores, $img, $bases, $valores;
	
	foreach ($variables as $v){	
		$Xbase 	  = $bases[$v["base"]]["x"]; //$l["xbase"];
		$Ybase 	  = $bases[$v["base"]]["y"]; //$l["ybase"];

		$Cx = $v["Cx"] + $Xbase;
		$Cy = $v["Cy"] + $Ybase;
		$nombre_valor = $v["puntero"];
		$unidad = $v["unidad"];

		$Valor_BLC = round($valores[$nombre_valor],1);
		
		imagestring($img, 4, $Cx,$Cy,  $Valor_BLC ." ". $unidad, $colores["grisclaro"]);
	}
}

/*--------------------------------------------------+
|	Dibuja grupo sumado de Valores desde un array	|
+--------------------------------------------------*/
function sumados($grupo){
	global $colores, $img, $bases, $valores;
	
	// carga la definción de los grupos
	foreach ($grupo as $g){	
		$nombre = $g["grupo"];
		$tabla[$nombre]["x"] = $g["x"] + $bases[$g["base"]]["x"];
		$tabla[$nombre]["y"] = $g["y"] + $bases[$g["base"]]["y"];
		$tabla[$nombre]["unidad"] = $g["unidad"];
		$tabla[$nombre]["valor_g"] = 0;
	}	

	// suma los valores por cada grupo
	foreach ($grupo as $g){	
		$nombre = $g["grupo"];
		$tabla[$nombre]["valor_g"] += $valores[$g["valor"]];
	}

	// imprime los totales calculados
	foreach ($tabla as $t) {
		imagestring($img, 4, $t["x"], $t["y"],round($t["valor_g"],1)." ".$t["unidad"], $colores["grisclaro"]);		
	}
}

/*==================++
||		MAIN 		||
++==================*/
	foreach ($FullPantalla as $elemento) {
		
		switch ($elemento["tipo"]) {
			
			case 'barrastension':
				barrastension($arr_elementos);
				break;
			
			case 'lineas':
				lineas($arr_elementos);
				break;
			
			case 'acoplamientobarra':
				acoplamientobarra($arr_elementos);
				break;
				
			case 'trafosimples':
				trafosimples($arr_elementos);
				break;
				
			case 'semicampos':
				semicampos($arr_elementos);
				break;
			
			case 'camposcompletosA':
				camposcompletosA($arr_elementos);
				break;
				
			case 'camposcompletosB':
				camposcompletosB($arr_elementos);
				break;
				
			case 'seccionadores':
				seccionadores($arr_elementos);
				break;
				
			case 'valores':
				valores($arr_elementos);
				break;
			
			case 'valores_blc':
				valores_blc($arr_elementos);
				break;
			
			case 'leyendas':
				leyendas($arr_elementos);
				break;
			
			case 'sumados':
				sumados($arr_elementos);
				break;
		}
	}

	header("Content-type: image/png");
	
	$hora=$hora . ":" . $minuto . ":" . $segundo;
	imagestring($img, 4, 4, 4, "ULTIMA ACTUALIZACION", $colores["celeste"]);
	imagestring($img, 4, 165, 4, $fecha .$hora . "   -F11 expande/comprime la pantalla-" , $colores["celeste"]);
	$src = imagecreatefrompng('CCATransparente.png');
	// Copy and merge
	imagecopymerge($img, $src, 1050, 1, 0, 0, 170, 44, 100);
	imagepng($img);
	
?>