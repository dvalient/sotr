<?php 
/*******************
*  MOELO Tipo  * 
*******************/

namespace sotr{
	
	class Tipo {
		private $id_tipo;
		public $tipo;
		public $alto;
		public $ancho;
		public $radio;
		public $margenV;
		public $margenH;
		
		function __construct($id_tipo, $tipo, $alto,$ancho,$radio,$margenV,$margenH)
		{
			$this->setId($id_tipo);
			$this->tipo = $tipo;
			$this->alto = $alto;
			$this->ancho = $ancho;
			$this->radio = $radio;
			$this->margenV = $margenV;
			$this->margenH = $margenH;
		}

		public function getId(){
			return $this->id_tipo;
		}
	
		public function setId($id_tipo){
			$this->id_tipo= $id_tipo;
		}
		
		public static function save($Tipo){
			$db=\Db::getConnect();
			//var_dump($Tipo);
			//die();
				
			$insert=$db->prepare('INSERT INTO `tipo` VALUES (NULL, :tipo, :alto, :ancho, :radio, :margenV, :margenH)');
			$insert->bindValue('tipo',$Tipo->tipo);
			$insert->bindValue('alto',$Tipo->alto);
			$insert->bindValue('ancho',$Tipo->ancho);
			$insert->bindValue('radio',$Tipo->radio);
			$insert->bindValue('margenV',$Tipo->margenV);
			$insert->bindValue('margenH',$Tipo->margenH);
			
			$insert->execute();
		}
	
		public static function all(){
			$db=\Db::getConnect();
			$listaTipos=[];
	
			$select=$db->query('SELECT * FROM tipo order by id_tipo');
	
			foreach($select->fetchAll() as $db_row){
				$Tipo = new Tipo($db_row['id_tipo'],
								 $db_row['tipo'], 
								 $db_row['alto'],
								 $db_row['ancho'],
								 $db_row['radio'],
								 $db_row['margenV'],
								 $db_row['margenH']
								 );
				
				$listaTipos[]=$Tipo;
			}
			return $listaTipos;
		}
	
		public static function searchById($id_tipo){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM tipo WHERE id_tipo=:id');
			$select->bindValue('id',$id_tipo);
			$select->execute();
	
			$TipoDB=$select->fetch();
	
			$Tipo = new Tipo(
							$TipoDB['id_tipo'], 
							$TipoDB['tipo'],
							$TipoDB['alto'],
							$TipoDB['ancho'],
							$TipoDB['radio'],
							$TipoDB['margenV'],
							$TipoDB['margenH']
							);

			return $Tipo;	
		}

		public static function searchByNombre($id_tipo){
			$db=\Db::getConnect();
			$select=$db->prepare('SELECT * FROM tipo WHERE id_tipo=:id');
			$select->bindValue('id',$id_tipo);
			$select->execute();
			
			$TipoDB=$select->fetch();
	
			$Tipo = new Tipo(
							$TipoDB['id_tipo'], 
							$TipoDB['tipo'],
							$TipoDB['alto'],
							$TipoDB['ancho'],
							$TipoDB['radio'],
							$TipoDB['margenV'],
							$TipoDB['margenH']
							);

			return $Tipo;
		}
		
		public static function update($Tipo){
			$db=\Db::getConnect();
			$update=$db->prepare('UPDATE tipo 
										SET tipo=:tipo, 
										alto=:alto , 
										ancho=:ancho , 
										radio=:radio , 
										margenV=:margenV, 
										margenH=:margenH 
									WHERE id_tipo=:id');
			$update->bindValue('id',$Tipo->getId());
			$update->bindValue('tipo', $Tipo->tipo);
			$update->bindValue('alto', $Tipo->alto);
			$update->bindValue('ancho', $Tipo->ancho);
			$update->bindValue('radi', $Tipo->radio);
			$update->bindValue('margenV', $Tipo->margenV);
			$update->bindValue('margenH', $Tipo->margenH);
			$update->execute();
		}
	
		public static function delete($id_tipo){
			$db=\Db::getConnect();
			$delete=$db->prepare('DELETE FROM tipo WHERE id_tipo=:id');
			$delete->bindValue('id',$id_tipo);
			$delete->execute();		
		}
	}
}
?>