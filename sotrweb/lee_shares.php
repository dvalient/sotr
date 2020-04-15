<?php
/*--------------------------------------------------------------------------------------------+
| Abre el archivo que genera el sistema del despacho (Eduardo) y carga los valores en arrays  |
|carga los siguientes Valores:                                                                |
|    $hora, $minuto, $segundo, $fecha                                                         |
|    $int_num: cantidad de interruptores                                                      |
|    $alarm_num: cantidad de alarmas                                                          |
|    $valor_Cantidad: cantidad de valores                                                     |
|    $valores[$valor_Cantidad]: array de valores                                              |
|    $nombre_int[$int_num]                                                                    |
|    $estado_int[$int_num]                                                                    |
|    $abierto_int[$int_num]                                                                   |
|                                                                                             |
+--------------------------------------------------------------------------------------------*/
//$handle = fopen("/SOTR/lsharedos.dat", "rb");
$handle = fopen("../../sotr/lsharedos.dat", "rb");
$valores = [];
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

//Si quiero leer lshareuni.dat, lo abro con Frhed y en Options>View settings
//Number of bytes va en 22 (es lo que ocupa cada registro) y destildo que sea automático
//o con el notepad achicar el ancho de la pantalla hasta que se acomode
$pointer = 1;

$hora = fgets ($handle, 3);
fseek($handle, 1 , SEEK_CUR);
$minuto = fgets ($handle, 3);
fseek($handle, 1 , SEEK_CUR);
$segundo = fgets ($handle, 3);

$fecha = fgets ($handle, 3);
$fecha = $fecha  . "/". fgets ($handle, 3);
$fecha = $fecha  . "/". fgets ($handle, 3). "  ";

//fseek($handle, 6 , SEEK_CUR);

$analog[3] = fgets ($handle, 2);
$analog[2] = fgets ($handle, 2);
$analog[1] = fgets ($handle, 2);
$analog[0] = fgets ($handle, 2);

//ord() devuelve el valor ASCII (un entero) del primer caracter de la string
//cantidad de interruptores

$int_num = ord(fgets ($handle, 2));

//cantidad de alarmas

fseek($handle, 1 , SEEK_CUR);
$alarm_num = ord(fgets ($handle, 2));

//Hago legible lo que guarda analog
//valor_cantidad es la cantidad de registros con valores analogicos
//(después hay más pero digitales (y 2 tipos de digitales: interruptores (valores dobles) y alarmas(valores simples)))

$valor_Cantidad = bin2float($analog);

// cargar valores analogicos en array

fseek($handle, 0);
//22 es el largo de cada registro (22 bytes)

fseek($handle, 22 , SEEK_CUR);

while ($pointer <= $valor_Cantidad) {
//	$nombre_val[$pointer-1] = fgets ($handle, 15);
	$nombre_val = trim(fgets ($handle, 15));
	
	//valores
	$analog[3] = fgets ($handle, 2);
	$analog[2] = fgets ($handle, 2);
	$analog[1] = fgets ($handle, 2);
	$analog[0] = fgets ($handle, 2);
	
	$valores[$nombre_val] = bin2float($analog);
	
	//pego un salto porque no sirve lo último que queda
	fseek($handle, 4, SEEK_CUR);
	$pointer++;
}

//Recorro los demás registros (digitales: interruptores y alarmas)
//Los guardo en 3 arrays
//Para estos no hay que usar la función bin2float()

	$pointer=0;
	 while ($pointer <= ($int_num)) {
			//nombre del interruptor
//			$nombre_int[$pointer] = fgets ($handle, 15);
			$nombre_int = trim(fgets ($handle, 15));
			
			fseek($handle, 4, SEEK_CUR);
			//estado
			$estado_int[$nombre_int] = fgets ($handle,2);
			
			fseek($handle, 1 , SEEK_CUR);
			//abierto
			$bait = ord(fgets ($handle, 2));
//			$valores[$nombre_int] = $bait;
			if ($bait == 2) {
				$r = 1;	
			} elseif ($bait == 1) {
				$r = 2;
			} else {
				$r = $bait;
			}
			$valores[$nombre_int] = $r;
//			echo $nombre_int ." = ".$r."<p>";

			fseek($handle, 1 , SEEK_CUR); 

		 $pointer++;
	  }

	fclose($handle);
/*
echo ("<pre>");
print_r($valores);
echo("</pre>");
die();
*/

/*--------------------------------------------------------+
|    Carga en un arreglo el txt de las máquinas nuevas    |
+--------------------------------------------------------*/
	$arregloMaquinasNuevas = array();
//	$archivo = "/SOTR/share2324.csv";
	$archivo = "../../sotr/share2324.csv";

	// $archivo = "asdd.txt";
	
	if (!file_exists($archivo)) {
		//die("No se encontró el archivo.");
	}else{
	  $archivo = fopen($archivo, "r");// or die("No se pudo abrir el archivo.");
	  while (($linea = fgets($archivo)) !== false) {
		  list($nombre, $valor) = explode(",", $linea);
		  $valores[$nombre] = $valor;
//		  $arregloMaquinasNuevas[$nombre] = $valor;
		  //echo $nombre." ".$arregloMaquinasNuevas[$nombre];
		  //echo "</br>";
	  }
	}
	fclose($archivo);

/*----------------------------------------------------------+
|    Carga en un arreglo los valores de Cammesa desde BLC   |
+----------------------------------------------------------*/
//	$archivo_BLC = "/SOTR/datos_cammesa.csv";
	$archivo_BLC = "../../sotr/datos_cammesa.csv";

	if (!file_exists($archivo_BLC)) {
		//die("No se encontrï¿½ el archivo.");
	}else{
	  $archivo_BLC = fopen($archivo_BLC, "r");// or die("No se pudo abrir el archivo.");
	
	  while (($linea = fgets($archivo_BLC)) !== false) {		
		list($nombre, $valor) = explode(";", $linea);
		//$valores_BLC[$nombre] = $valor;
		$valores[$nombre] = $valor;

	//	echo  $nombre;
	//	echo  $valores_BLC[$nombre];
	  }
	}
	fclose($archivo_BLC);
	
?>