<?php 
/*******************
*  MOELO Unidad  * 
*******************/

namespace sotr{
	
	class Unidad {
		private $id_unidad;
		public $unidad;
		public $descripcion;
		
		function __construct($id_unidad, $unidad, $descripcion)
		{
			$this->setId($id_unidad);
			$this->unidad = $unidad;
			$this->descripcion = $descripcion;
		}

		public function getId(){
			return $this->id_unidad;
		}
	
		public function setId($id_unidad){
			$this->id_unidad= $id_unidad;
		}
		
		public static function save($Unidad){
			$db=\Db::getConnect();
			//var_dump($Unidad);
			//die();
				
			$insert=$db->prepare('INSERT INTO `unidad` VALUES (NULL, :unidad, :descripcion)');
			$insert->bindValue('unidad',$Unidad->unidad);
			$insert->bindValue('descripcion',$Unidad->descripcion);
			
			$insert->execute();
		}
	
		public static function all(){
			$db=\Db::getConnect();
			$listaElementos=[];
	
			$select=$db->query('SELECT * FROM unidad order by id_unidad');
	
			foreach($select->fetchAll() as $db_row){
				$Unidad = new Unidad($db_row['id_unidad'],
								 $db_row['unidad'], 
								 $db_row['descripcion']
								 );
				
				$listaElementos[]=$Unidad;
			}
			return $listaElementos;
		}
	
		public static function searchById($id_unidad){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM unidad WHERE id_unidad=:id');
			$select->bindValue('id',$id_unidad);
			$select->execute();
	
			$ElementoDb=$select->fetch();
	
			$Unidad = new Unidad(
							$ElementoDb['id_unidad'], 
							$ElementoDb['unidad'],
							$ElementoDb['descripcion']
							);

			return $Unidad;	
		}

		public static function searchByNombre($id_unidad){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM unidad WHERE id_unidad=:id');
			$select->bindValue('id',$id_unidad);
			$select->execute();
			
			$ElementoDb=$select->fetch();
	
			$Unidad = new Unidad(
							$ElementoDb['id_unidad'], 
							$ElementoDb['unidad'],
							$ElementoDb['descripcion']
							);

			return $Unidad;
		}
		
		public static function update($Unidad){
			$db=\Db::getConnect();
			$update=$db->prepare('UPDATE unidad SET unidad=:unidad, descripcion=:descripcion WHERE id_unidad=:id');
			$update->bindValue('id',$Unidad->getId());
			$update->bindValue('unidad', $Unidad->unidad);
			$update->bindValue('descripcion', $Unidad->descripcion);
			$update->execute();
		}
	
		public static function delete($id_unidad){
			$db=\Db::getConnect();
			$delete=$db->prepare('DELETE FROM unidad WHERE id_unidad=:id');
			$delete->bindValue('id',$id_unidad);
			$delete->execute();		
		}
	}
}
?>