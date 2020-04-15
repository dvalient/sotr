<?php 
	require_once('connection.php');
	
	require_once('Model/Session.php');
	$sesion = sotr\Session::getInstance();
					
	if (isset($sesion->id_usuario)){	

		if (isset($_GET['controller'])&&isset($_GET['action'])) {
			
			$controller=$_GET['controller'];
			$action=$_GET['action'];
		}else{
			$controller='pantalla';
			$action='show';
		}
	} else {

		$controller='acUsuario';
		$action='login';
	}
	require_once('Views/Layouts/layout.php');	

 ?>