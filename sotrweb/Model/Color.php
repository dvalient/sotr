<?php 
/*******************
*  MOELO Color  * 
*******************/

namespace sotr{	
	class Color {
		private $id_color;
		public $color;
		public $r;
		public $g;
		public $b;
		
		function __construct($id_color, $color, $r, $g, $b)
		{
			$this->setId($id_color);
			$this->color = $color;
			$this->r = $r;
			$this->g = $g;
			$this->b = $b;
		}
		
		public function getId(){
			return $this->id_color;
		}
		
		public function setId($id_color){
			$this->id_color= $id_color;
		}
		
		public static function save($Color){
			$db=\Db::getConnect();
			//var_dump($Color);
			//die();
			
			$insert=$db->prepare('INSERT INTO `color` VALUES (NULL, :color, :r, :g, :b)');
			$insert->bindValue('color',$Color->color);
			$insert->bindValue('r',$Color->r);
			$insert->bindValue('g',$Color->g);
			$insert->bindValue('b',$Color->b);
			
			$insert->execute();
		}
		
		public static function all(){
			$db=\Db::getConnect();
			$listaColores=[];
			
			$select=$db->query('SELECT * FROM color order by id_color');
			
			foreach($select->fetchAll() as $db_row){
				$Color = new Color( $db_row['id_color'], 
									$db_row['color'], 
									$db_row['r'], 
									$db_row['g'], 
									$db_row['b']
								);
								
				$listaColores[]=$Color;
			}
			return $listaColores;
		}
		
		public static function searchById($id_color){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM color WHERE id_color=:id');
			$select->bindValue('id',$id_color);
			$select->execute();
			
			$ColorDB=$select->fetch();
			
			$Color = new Color(
							$ColorDB['id_color'], 
							$ColorDB['color'],
							$ColorDB['r'], 
							$ColorDB['g'], 
							$ColorDB['b'] 
							);
			return $Color;
		}

		public static function searchByNombre($color){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM color WHERE r=:id');
			$select->bindValue('id',$color);
			$select->execute();
			
			$ColorDB=$select->fetch();
			
			$Color = new Color(
							$ColorDB['id_color'], 
							$ColorDB['r'], 
							$ColorDB['g'], 
							$ColorDB['b'], 
							$ColorDB['color']
							);
			return $Color;
		}

		public static function contGrupos(){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT count(*) as cantidad FROM color ');
			$select->execute();
			
			$ColorDB=$select->fetch();
			
			$cant_Grupo = $ColorDB['cantidad'];
			//var_dump($rubro);
			//die();
			return $cant_Grupo;
		}
		
		public static function update($Color){
			$db=\Db::getConnect();
			$update=$db->prepare('UPDATE color SET r=:r, color=:color, g=:g, b=:b WHERE id_color=:id');
			$update->bindValue('id',$Color->getId());
			$update->bindValue('color', $Color->color);
			$update->bindValue('r', $Color->r);
			$update->bindValue('g', $Color->g);
			$update->bindValue('b', $Color->b);
			$update->execute();
		}
	
		public static function delete($id_color){
			$db=\Db::getConnect();
			$delete=$db->prepare('DELETE FROM color WHERE id_color=:id');
			$delete->bindValue('id',$id_color);
			$delete->execute();		
		}
	}
}
?>