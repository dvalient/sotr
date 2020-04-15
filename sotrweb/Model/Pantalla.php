<?php 
/*******************
*  MOELO pantalla  * 
*******************/

namespace sotr{
	
	class Pantalla {
		private $id_pantalla;
		public $pantalla;
		public $w;
		public $h;
		public $background;
		
		function __construct($id_pantalla, $pantalla, $w, $h, $background)
		{
			$this->setId($id_pantalla);
			$this->pantalla = $pantalla;
			$this->w = $w;
			$this->h = $h;
			$this->background = $background;
		}

		public function getId(){
			return $this->id_pantalla;
		}
	
		public function setId($id_pantalla){
			$this->id_pantalla= $id_pantalla;
		}
		
		public static function save($pantalla){
			$db=\Db::getConnect();
			//var_dump($pantalla);
			//die();
				
			$insert=$db->prepare('INSERT INTO `pantalla` VALUES (NULL, :pantalla, :w, :h, :background)');
			$insert->bindValue('pantalla',$pantalla->pantalla);
			$insert->bindValue('w',$pantalla->w);
			$insert->bindValue('h',$pantalla->h);
			$insert->bindValue('background',$pantalla->background);
			
			$insert->execute();
		}
	
		public static function all(){
			$db=\Db::getConnect();
			$listapantallas=[];
	
			$select=$db->query('SELECT * FROM pantalla order by id_pantalla');
	
			foreach($select->fetchAll() as $db_row){
				$pantalla = new pantalla(
							$db_row['id_pantalla'], 
							$db_row['pantalla'],
							$db_row['w'],
							$db_row['h'],
							$db_row['background']
					);
				
				$listapantallas[]=$pantalla;
			}
			return $listapantallas;
		}
	
		public static function CargaPantallaFull($id_pantalla){
			$db=\Db::getConnect();
			$fullPantalla=[];

			$select=$db->prepare('SELECT p.id_pantalla, p.pantalla, p.w, p.h, p.background,
										g.id_grupo, g.grupo, g.gx, g.gy,
										e.id_elemento, e.x, e.y, e.xx, e.yy, e.nombre, e.dimension, e.variable, e.id_colorin, e.id_colorout,
										t.id_tipo, t.tipo, t.alto, t.ancho, t.radio, t.margenV, t.margenH,
										u.id_unidad, u.unidad,
										cp.r as rp, cp.g as gp, cp.b as bp, 
										ci.r as ri, ci.g as gi, ci.b as bi, 
										co.r as ro, co.g as go, co.b as bo
									FROM pantalla p 
									LEFT JOIN grupo g ON p.id_pantalla = g.id_pantalla 
									LEFT JOIN elemento e ON g.id_grupo = e.id_grp 
									LEFT JOIN tipo t ON e.id_tipo = t.id_tipo 
									LEFT JOIN color cp ON p.background = cp.id_color
									LEFT JOIN color ci ON e.id_colorin = ci.id_color
									LEFT JOIN color co ON e.id_colorout = co.id_color
									LEFT JOIN unidad u ON e.unidad = u.id_unidad
								WHERE p.id_pantalla = :id ;'
								);

			$select->bindValue('id',$id_pantalla);
			$select->execute();
			$fullPantalla = $select->fetchAll();
			
			foreach($fullPantalla as $panta){
				$arr_restar = array(
							 0=>"0",  1=>"0", 2=>"0", 3=>"0", 4=>"0", 5=>"0", 6=>"0", 7=>"0", 8=>"0", 9=>"0", 10=>"0",
							 11=>"0", 12=>"0", 13=>"0", 14=>"0", 15=>"0", 16=>"0", 17=>"0", 18=>"0", 19=>"0", 20=>"0", 
							 21=>"0", 22=>"0", 23=>"0", 24=>"0", 25=>"0", 26=>"0", 27=>"0", 28=>"0", 29=>"0", 30=>"0",
							 31=>"0", 32=>"0", 33=>"0", 34=>"0", 35=>"0", 36=>"0");
							 
				$P = \array_diff_key($panta, $arr_restar);
				$PS[] = $P;
			}

			return $PS;
	
		}

		public static function searchById($id_pantalla){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM pantalla WHERE id_pantalla=:id');
			$select->bindValue('id',$id_pantalla);
			$select->execute();
	
			$pantallaDb=$select->fetch();
	
			$pantalla = new pantalla(
							$pantallaDb['id_pantalla'], 
							$pantallaDb['pantalla'], 
							$pantallaDb['w'], 
							$pantallaDb['h'], 
							$pantallaDb['background']
							);

			return $pantalla;
	
		}

		public static function searchByNombre($pantalla){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM pantalla WHERE pantalla=:id');
			$select->bindValue('id',$pantalla);
			$select->execute();
			
			$pantallaDb=$select->fetch();
	
			$pantalla = new pantalla(
							$pantallaDb['id_pantalla'], 
							$pantallaDb['pantalla'], 
							$pantallaDb['w'], 
							$pantallaDb['h'], 
							$pantallaDb['background']
							);

			return $pantalla;
		}

		public static function contpantallas(){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT count(*) as cantidad FROM pantalla ');
			$select->execute();
	
			$pantallaDb=$select->fetch();
	
			$cant_pantalla = $pantallaDb['cantidad'];
			//var_dump($rubro);
			//die();
			return $cant_pantalla;
		}

	
		public static function update($pantalla){
			$db=\Db::getConnect();
			$update=$db->prepare('UPDATE pantalla SET pantalla=:pantalla, w=:w, h=:h, background=:background WHERE id_pantalla=:id');
			
			$update->bindValue('id',$pantalla->getId());
			$update->bindValue('pantalla', $pantalla->pantalla);
			$update->bindValue('w', $pantalla->w);
			$update->bindValue('h', $pantalla->h);
			$update->bindValue('background', $pantalla->background);
			$update->execute();
		}
	
		public static function delete($id_pantalla){
			$db=\Db::getConnect();
			$delete=$db->prepare('DELETE FROM pantalla WHERE id_pantalla=:id');
			$delete->bindValue('id',$id_pantalla);
			$delete->execute();		
		}
	}
}
?>