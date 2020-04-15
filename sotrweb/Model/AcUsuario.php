<?php 
/*******************
*  MOELO USUARIO  * 
*******************/

namespace sotr{
	
	class AcUsuario {
		private $id_usuario;
		private $username;
		private $nombre;
		private $password;
		
		function __construct($id_usuario, $username, $nombre, $password)
		{
			$this->setId($id_usuario);
			$this->setUsername($username);
			$this->setNombre($nombre);
			$this->setPassword($password);
		}
	
		public function getId(){
			return $this->id_usuario;
		}
	
		public function setId($id_usuario){
			$this->id_usuario= $id_usuario;
		}
	
		public function getUsername(){
			return $this->username;
		}
	
		public function setUsername($username){
			$this->username = $username;
		}
		public function getNombre(){
			return $this->nombre;
		}
	
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}

		public function getPassword(){
			return $this->password;
		}
	
		public function setPassword($password){
			$this->password = $password;
		}
	
		public static function login($nombre, $password){

			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM acusuario WHERE username=:nom_s AND password=PASSWORD(:pwd_s)');
			$select->bindValue('nom_s',$nombre);
			$select->bindValue('pwd_s',$password);
			$select->execute();
			

			if($select->rowCount() > 0){
				$usuarioDb=$select->fetch();
			
				$usuario = new AcUsuario ($usuarioDb['id_usuario'],$usuarioDb['username'],$usuarioDb['nombre'],$usuarioDb['password']);
				//var_dump($usuario);
				//die();
				return $usuario;			
			} else {
				return false;	
			}
		}

		public static function logout(){
			$sesion = Session::getInstance();
		
			$sesion->destroy();
			return $sesion->destroy();
		}


		public static function save($usuario){
			$db=\Db::getConnect();
			//var_dump($usuario);
			//die();
	
			$insert=$db->prepare('INSERT INTO `acusuario` VALUES (NULL, :username,:nombre, PASSWORD(:password))');
			$insert->bindValue('username',$usuario->getUsername());
			$insert->bindValue('nombre',$usuario->getNombre());
			$insert->bindValue('password',$usuario->getPassword());
			$insert->execute();
		}
	
		public static function all(){
			$db=\Db::getConnect();
			$listaUsuarios=[];
	
			$select=$db->query('SELECT * FROM acusuario order by Nombre');
	
			foreach($select->fetchAll() as $usuario){
				$listaUsuarios[] = new AcUsuario($usuario['id_usuario'],$usuario['username'],$usuario['nombre'],$usuario['password']);
			}
			return $listaUsuarios;
		}
	
		public static function searchById($id_usuario){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM acusuario WHERE id_usuario=:id');
			$select->bindValue('id',$id_usuario);
			$select->execute();
	
			$usuarioDb=$select->fetch();
	
	
			$usuario = new AcUsuario ($usuarioDb['id_usuario'],$usuarioDb['username'],$usuarioDb['nombre'],$usuarioDb['password']);
			//var_dump($usuario);
			//die();
			return $usuario;
	
		}
//D
		public static function searchByNombre($nombre){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM acusuario WHERE nombre=:nom_s');
			$select->bindValue('nom_s',$nombre);
			$select->execute();
	
			$usuarioDb=$select->fetch();
		
			$usuario = new AcUsuario ($usuarioDb['id_usuario'],$usuarioDb['username'],$usuarioDb['nombre'],$usuarioDb['password']);
			//var_dump($usuario);
			//die();
			return $usuario;
		}
	
		public static function update($usuario){
			$db=\Db::getConnect();
			$update=$db->prepare('UPDATE acusuario SET username=:username, nombre=:nombre, password=PASSWORD(:password) WHERE id_usuario=:id');
			$update->bindValue('username', $usuario->getUsername());
			$update->bindValue('nombre', $usuario->getNombre());
			$update->bindValue('password', $usuario->getPassword());
			$update->bindValue('id',$usuario->getId());
			$update->execute();
		}
	
		public static function delete($id_usuario){
			$db=\Db::getConnect();
			$delete=$db->prepare('DELETE  FROM acusuario WHERE id_usuario=:id');
			$delete->bindValue('id',$id_usuario);
			$delete->execute();		
		}
	}
}
?>