<?php 
/*******************
*  MOELO Grupo  * 
*******************/

namespace sotr{
	
	class Grupo {
		private $id_grupo;
		public $id_pantalla;
		public $grupo;
		public $padre;
		public $gx;
		public $gy;

		
		function __construct($id_grupo, $id_pantalla, $grupo, $padre, $gx, $gy)
		{
			$this->setId($id_grupo);
			$this->id_pantalla = $id_pantalla;
			$this->grupo = $grupo;
			$this->padre = $padre;
			$this->gx = $gx;
			$this->gy = $gy;

		}

		public function getId(){
			return $this->id_Grupo;
		}
	
		public function setId($id_grupo){
			$this->id_Grupo= $id_grupo;
		}
		
		public static function save($grupo){
			$db=\Db::getConnect();
			//var_dump($Grupo);
			//die();
				
			$insert=$db->prepare('INSERT INTO `grupo` VALUES (NULL, :id_pantalla, :grupo, :padre, :gx, :gy)');
			$insert->bindValue('id_pantalla',$grupo->id_pantalla);
			$insert->bindValue('grupo',$grupo->grupo);
			$insert->bindValue('padre',$grupo->padre);
			$insert->bindValue('gx',$grupo->gx);
			$insert->bindValue('gy',$grupo->gy);
			
			$insert->execute();
		}
	
		public static function all(){
			$db=\Db::getConnect();
			$listaGrupos=[];
	
			$select=$db->query('SELECT * FROM grupo order by id_Grupo');
			
			foreach($select->fetchAll() as $db_row){
				$Grupo = new Grupo(
								$db_row['id_grupo'], 
								$db_row['id_pantalla'], 
								$db_row['grupo'], 
								$db_row['padre'],
								$db_row['gx'],
								$db_row['gy']);
				
				$listaGrupos[]=$Grupo;
			}
			return $listaGrupos;
		}
	
		public static function searchById($id_grupo){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM grupo WHERE id_Grupo=:id');
			$select->bindValue('id',$id_grupo);
			$select->execute();
	
			$GrupoDb=$select->fetch();
	
			$Grupo = new Grupo(
							$GrupoDb['id_Grupo'], 
							$GrupoDb['id_pantalla'],
							$GrupoDb['grupo'], 
							$GrupoDb['padre'], 
							$GrupoDb['gx'], 
							$GrupoDb['gy'] 
							);

			return $Grupo;
	
		}

		public static function searchByPantalla($id_pantalla){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM grupo WHERE id_pantalla=:id');
			$select->bindValue('id',$id_pantalla);
			$select->execute();
			
			foreach($select->fetchAll() as $db_row){
				$Grupo = new Grupo(
								$db_row['id_grupo'], 
								$db_row['id_pantalla'], 
								$db_row['grupo'], 
								$db_row['padre'],
								$db_row['gx'],
								$db_row['gy']);
				
				$listaGrupos[]=$Grupo;
			}
			return $listaGrupos;
		}

		public static function contGrupos(){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT count(*) as cantidad FROM grupo ');
			$select->execute();
	
			$GrupoDb=$select->fetch();
	
			$cant_Grupo = $GrupoDb['cantidad'];
			//var_dump($rubro);
			//die();
			return $cant_Grupo;
		}
	
		public static function updatexy($id_grupo, $gx, $gy){
			$db=\Db::getConnect();
			$update=$db->prepare('UPDATE grupo SET gx=:x, gy=:y WHERE id_grupo=:id');
			$update->bindValue('id',$id_grupo);
			$update->bindValue('x', $gx);
			$update->bindValue('y', $gy);
			$update->execute();
		}
	
		public static function update($Grupo){
			$db=\Db::getConnect();
			$update=$db->prepare('UPDATE grupo SET grupo=:grupo, id_pantalla=:id_pantalla, padre=:padre, gx=:x, gy=:y WHERE id_grupo=:id');
			$update->bindValue('id',$Grupo->getId());
			$update->bindValue('grupo', $Grupo->grupo);
			$update->bindValue('id_pantalla', $Grupo->id_pantalla);
			$update->bindValue('padre', $Grupo->padre);
			$update->bindValue('x', $Grupo->gx);
			$update->bindValue('y', $Grupo->gy);
			$update->execute();
		}
	
		public static function delete($id_grupo){
			$db=\Db::getConnect();
			$delete=$db->prepare('DELETE FROM grupo WHERE id_grupo=:id');
			$delete->bindValue('id',$id_grupo);
			$delete->execute();
		}
	}
}
?>