<?php 

$controllers=array(
	'pantalla'=>['armaPantalla','editaPantalla','editaMarco','crearMarco','show','dibujaPantalla','showElemento','error'],
	'acUsuario'=>['login','logout'],
	);

if (array_key_exists($controller,  $controllers)) {
	if (in_array($action, $controllers[$controller])) {
		call($controller, $action);
	}
	else{
		call('pantalla','error');
	}		
}else{
	call('pantalla','error');
}



function call($controller, $action){
	require_once('Controllers/'.$controller.'Controller.php');

	switch ($controller) {
		case 'pantalla':
    		require_once('Model/Pantalla.php');
    		$controller= new sotr\PantallaController();
    		break;			
		case 'acUsuario':
    		require_once('Model/AcUsuario.php');
    		$controller= new sotr\AcUsuarioController();
    		break;			
		default:
				# code...
		break;
	}
	$controller->{$action}();
}

?>