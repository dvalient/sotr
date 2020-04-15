<?php 
/*******************
*  MOELO Elemento  * 
*******************/

namespace sotr{	
	class Elemento {
		private $id_elemento;
		public $id_grp;
		public $id_tipo;
		public $id_colorin;
		public $id_colorout;
		public $x;
		public $y;
		public $xx;
		public $yy;
		public $dimension;
		public $nombre;
		public $variable;
		public $unidad;
		
		function __construct($id_elemento,$id_grp,$id_tipo,$id_colorin,$id_colorout,$x,$y,$xx,$yy,$dimension,$nombre,$variable,$unidad)
		{
			$this->setId($id_elemento);
			$this->id_grp = $id_grp;
			$this->id_tipo = $id_tipo;
			$this->id_colorin = $id_colorin;
			$this->id_colorout = $id_colorout;
			$this->x = $x;
			$this->y = $y;
			$this->xx = $xx;
			$this->yy = $yy;
			$this->dimension = $dimension;
			$this->nombre = $nombre;
			$this->variable = $variable;
			$this->unidad = $unidad;
		}

		public function getId(){
			return $this->id_Elemento;
		}
	
		public function setId($id_elemento){
			$this->id_Elemento= $id_elemento;
		}
		
		public static function save($Elemento){
			$db=\Db::getConnect();
			//var_dump($Elemento);
			//die();
			
			$insert=$db->prepare('INSERT INTO elemento 
									VALUES (
										NULL, 
										:id_grp,
										:id_tipo,
										:id_colorin,
										:id_colorout,
										:x,
										:y,
										:xx,
										:yy,
										:dimension,
										:nombre,
										:variable,
										:unidad)'
								);
								
			$insert->bindValue('id_tipo',$Elemento->id_tipo);
			$insert->bindValue('id_grp',$Elemento->id_grp);
			$insert->bindValue('id_colorin',$Elemento->id_colorin);
			$insert->bindValue('id_colorout',$Elemento->id_colorout);
			$insert->bindValue('x',$Elemento->x);
			$insert->bindValue('y',$Elemento->y);
			$insert->bindValue('xx',$Elemento->xx);
			$insert->bindValue('yy',$Elemento->yy);
			$insert->bindValue('dimension',$Elemento->dimension);
			$insert->bindValue('nombre',$Elemento->nombre);
			$insert->bindValue('variable',$Elemento->variable);
			$insert->bindValue('unidad',$Elemento->unidad);
			
			$insert->execute();
		}
	
		public static function all(){
			$db=\Db::getConnect();
			$listaElementos=[];
	
			$select=$db->query('SELECT * FROM elemento order by id_Elemento');
	
			foreach($select->fetchAll() as $db_row){
				$Elemento = new Elemento();
				$Elemento->setId($db_row['id_Elemento']);
				$Elemento->id_grp=$db_row['id_grp'];
				$Elemento->id_tipo=$db_row['id_tipo'];
				$Elemento->id_colorin=$db_row['id_colorin'];
				$Elemento->id_colorout=$db_row['id_colorout'];
				$Elemento->x=$db_row['x'];
				$Elemento->y=$db_row['y'];
				$Elemento->xx=$db_row['xx'];
				$Elemento->yy=$db_row['yy'];
				$Elemento->dimensionx=$db_row['dimension'];
				$Elemento->nombre=$db_row['nombre'];
				$Elemento->variable=$db_row['variable'];
				$Elemento->unidad=$db_row['unidad'];
				
				$listaElementos[]=$Elemento;
			}
			return $listaElementos;
		}
	
		public static function searchById($id_elemento){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM elemento WHERE id_Elemento=:id');
			$select->bindValue('id',$id_elemento);
			$select->execute();
	
			$ElementoDb=$select->fetch();
	
			$Elemento = new Elemento(
							$ElementoDb['id_Elemento'], 
							$ElementoDb['id_grp'],
							$ElementoDb['id_tipo'], 
							$ElementoDb['id_colorin'], 
							$ElementoDb['id_colorout'], 
							$ElementoDb['x'], 
							$ElementoDb['y'], 
							$ElementoDb['xx'], 
							$ElementoDb['yy'], 
							$ElementoDb['dimension'], 
							$ElementoDb['nombre'], 
							$ElementoDb['variable'],
							$ElementoDb['unidad']
							);

			return $Elemento;	
		}

		public static function searchByNombre($id_tipo){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM elemento WHERE id_tipo=:id');
			$select->bindValue('id',$id_tipo);
			$select->execute();
			
			$ElementoDb=$select->fetch();
	
			$Elemento = new Elemento(
							$ElementoDb['id_Elemento'], 
							$ElementoDb['id_grp'],
							$ElementoDb['id_tipo'], 
							$ElementoDb['id_colorin'], 
							$ElementoDb['id_colorout'], 
							$ElementoDb['x'], 
							$ElementoDb['y'], 
							$ElementoDb['xx'], 
							$ElementoDb['yy'], 
							$ElementoDb['dimension'], 
							$ElementoDb['nombre'], 
							$ElementoDb['variable'],
							$ElementoDb['unidad']
							);

			return $Elemento;
		}

		public static function contElementos(){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT count(*) as cantidad FROM elemento ');
			$select->execute();
	
			$ElementoDb=$select->fetch();
	
			$cant_Elemento = $ElementoDb['cantidad'];
			//var_dump($rubro);
			//die();
			return $cant_Elemento;
		}
	
		public static function update($Elemento){
			$db=\Db::getConnect();
			$update=$db->prepare('UPDATE elemento SET 
										id_grp=:id_grp, 
										id_tipo=:id_tipo, 
										id_colorin=:id_colorin, 
										id_colorout=:id_colorout, 
										x=:x, 
										y=:y, 
										xx=:xx, 
										yy=:yy, 
										dimension=:dimension, 
										nombre=:nombre, 
										variable=:variable, 
										unidad=:unidad
									WHERE id_Elemento=:id');
			$update->bindValue('id',$Elemento->getId());
			$update->bindValue('id_grp', $Elemento->id_grp);
			$update->bindValue('id_tipo', $Elemento->id_tipo);
			$update->bindValue('id_colorin', $Elemento->id_colorin);
			$update->bindValue('id_colorout', $Elemento->id_colorout);
			$update->bindValue('x', $Elemento->x);
			$update->bindValue('y', $Elemento->y);
			$update->bindValue('xx', $Elemento->xx);
			$update->bindValue('yy', $Elemento->yy);
			$update->bindValue('dimension', $Elemento->dimension);
			$update->bindValue('nombre', $Elemento->nombre);
			$update->bindValue('variable', $Elemento->variable);
			$update->bindValue('unidad', $Elemento->unidad);
			$update->execute();
		}
				
		public static function delete($id_elemento){
			$db=\Db::getConnect();
			$delete=$db->prepare('DELETE FROM Elemento WHERE id_Elemento=:id');
			$delete->bindValue('id',$id_elemento);
			$delete->execute();		
		}
	}
}
?>