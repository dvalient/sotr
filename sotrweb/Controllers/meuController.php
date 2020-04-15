<?php 
/**********************
* Controller Usuario *
**********************/
namespace sotr {
	class AcUsuarioController
	{
		
		function __construct()	{
		}
	
		function index(){
			require_once('Views/AcUsuario/bienvenido.php');
		}
	
		function crear(){
			require_once('Views/AcUsuario/crear.php');
		}
	
		function save(){
			$usuario= new AcUsuario(null, $_POST['username'], $_POST['nombre'], $_POST['password']);
	
			AcUsuario::save($usuario);
			$this->show();
		}
	
		function show(){
			$listaUsuarios = AcUsuario::all();
	
			require_once('Views/AcUsuario/show.php');
		}
	
		function updateshow(){
			require_once('Model/AcRolxUsuario.php');
			require_once('Model/AcRol.php');

			$id=$_GET['id_usuario'];
			$usuario = AcUsuario::searchById($id);
			require_once('Views/AcUsuario/updateshow.php');
		}
	
		function update(){
			require_once('Model/AcRolxUsuario.php');

			$usuario = new AcUsuario($_POST['id_usuario'],$_POST['username'],$_POST['nombre'],$_POST['password']);
			AcUsuario::update($usuario);
			AcRolxUsuario::delete_usuario($usuario->getId());
			// $rol_lis = $_POST['rol_lst'];
			foreach($_POST['rol_lst'] as $rol_chk){
				$rxu = new AcRolxUsuario(NULL, $usuario->getId(),$rol_chk);
				AcRolxUsuario::save($rxu);
			}
			$this->show();
		}
		
		function delete(){
			$id=$_GET['id'];
			AcUsuario::delete($id);
			$this->show();
		}
	
		function search(){
			if (!empty($_POST['nombre'])) {
				$nombre=$_POST['nombre'];
				$usuario = AcUsuario::searchByNombre($nombre);
				$listaUsuarios[]=$usuario;
				//var_dump($id);
				//die();
				require_once('Views/AcUsuario/show.php');
			} else {
				$listaUsuarios = AcUsuario::all();
	
				require_once('Views/AcUsuario/show.php');
			}
		}

		function login(){
			require_once('Model/AcUsuario.php');
			require_once('Model/Session.php');
//			require_once('Model/Menu.php');

			$usuario = false;
			
			if (isset($_POST['ingresar'])) {
				// var_dump($_POST);
				// die();
				if (!empty($_POST['login_usr'])) {
					$login_usr = $_POST['login_usr'];
					
					if(!empty($_POST['login_pwd'])) {
						$login_pwd = $_POST['login_pwd'];
						$usuario = AcUsuario::login($login_usr, $login_pwd);
						if($usuario){						
							$sesion = Session::getInstance();
							$sesion->usuario = $usuario->getUsername();
							$sesion->id_usuario = $usuario->getId();
							
							//echo date('Y-m-d H:i:s');
							echo "<script type=\"text/javascript\">
									window.location.href = \"./?controller=pantalla&&action=armaPantalla\";
								  </script>";
							/*echo '<script type="text/javascript">location.reload(true);</script>';*/
							die();
						} else {
							$mensaje = "El usuario y contraseña no pudieron ser validados";
						}
					} else {
						$mensaje = "NO ha ingresado una contraseña";
					}
				} else {
					$mensaje = "NO ha ingresado una usuario";
				}
			} else {
				$mensaje = "";
			}
			require_once('Views/AcUsuario/login.php');
						
			//var_dump($id);
			//die();
		}

		function logout(){
			require_once('Model/AcUsuario.php');
			require_once('Model/Session.php');
			require_once('Model/Menu.php');
			
			AcUsuario::logout();			

			echo "<script type=\"text/javascript\">
					window.location.href = \"./?controller=acUsuario&&action=login\";
				  </script>";

/*			echo date('Y-m-d H:i:s');
			echo '<script type="text/javascript">location.reload(true);</script>';
*/
			die();
		}

/*
		function validar(){
			
			$login_usr = $_POST['login_usr'];
			$login_pwd = $_POST['login_pwd'];
			
			//var_dump($login_usr);
			//die();

			$usuario = AcUsuario::validar($login_usr, $login_pwd);

			if (! $usuario) { // El usuario no se validó
				require_once('Views/AcUsuario/login.php');
			} else {
				$sesion->usuario = $usuario->getUsername();
				$sesion->id_usuario = $usuario->getId();
			}
			
			//var_dump($id);
			//die();
		}
*/	
		function error(){
			require_once('Views/AcUsuario/error.php');
		}
	
	}
}
?>