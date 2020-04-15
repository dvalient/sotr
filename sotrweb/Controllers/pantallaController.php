<?php 
/**********************
* Controller Pantalla *
**********************/
namespace sotr{
	
	class PantallaController
	{
		
		function __construct()	{
		}
	
		function index(){
			require_once('Views/Pantalla/bienvenido.php');
		}
	
		function crear(){
            require_once('Model/Pantalla.php');
			

			require_once('Views/Pantalla/crear.php');
		}
	
		function save(){
			$rubro= new Pantalla;
			
			$rubro->nombre_r=$_POST['nombre_r'];
			$rubro->descripcion=$_POST['descripcion'];
	
			Pantalla::save($rubro);
			$this->show();
		}

		function armaPantalla(){
            require_once('Model/Pantalla.php');

			if (isset($_GET['id_pantalla'])) {
				$id_pantalla=$_GET['id_pantalla'];
			} else {
				$id_pantalla = 1;
			}
			
			$PS = Pantalla::CargaPantallaFull($id_pantalla);

			require_once('Views/Pantalla/showDibujo.php');
		}

		function crearMarco(){
            require_once('Model/Pantalla.php');

			
			if (isset($_POST['marco_crear'])){				
				$id_pantalla = $_POST['me_id_pantalla'];
				$pantalla = $_POST['me_pantalla'];
				$w = $_POST['me_w'];
				$h = $_POST['me_h'];
				$background = $_POST['me_background'];
				
				$newmarco = new Pantalla($id_pantalla, $pantalla, $w, $h, $background);
				Pantalla::save($newmarco);				
				$this->show();
			}  
		}

		function dibujaPantalla(){
            require_once('Model/Pantalla.php');
            require_once('Model/Grupo.php');
            require_once('Model/Elemento.php');
            require_once('Model/Color.php');
            require_once('Model/Tipo.php');
			require_once('Model/Unidad.php');
            require_once('lee_shares.php');

			if(isset($_GET['id_pantalla'])){
				$get_pantalla = $_GET['id_pantalla'];
			}

			/*  EDITAR MARCO */
			if(isset($_POST['marco_editar'])){
				$id_pantalla = $_POST['m_id_pantalla'];
				$pantalla = $_POST['m_pantalla'];
				$w = $_POST['m_w'];
				$h = $_POST['m_h'];
				$background = $_POST['m_background'];

				$newmarco = new Pantalla($id_pantalla, $pantalla, $w, $h, $background);
				Pantalla::update($newmarco);
				
				$get_pantalla = $id_pantalla;
			}
			
			/* EDITAR GRUPO */
			if (isset($_POST['accionGeditar'])){
				$id_pantalla = $_POST['grupoId_pantalla'];
				$id_grupo = $_POST['grupoId'];
				$grupo = $_POST['grupoNombre'];
				$padre = NULL;
				$gx = $_POST['grupoX'];
				$gy = $_POST['grupoY'];
				
				$newgrupo = new Grupo($id_grupo,$id_pantalla,$grupo,$padre,$gx,$gy);
				Grupo::update($newgrupo);
				
				$get_grupo = $id_grupo;
				$get_pantalla = $id_pantalla;				
			}

			/* CREAR GRUPO */
			if (isset($_POST['accionGcrear'])){
				$id_pantalla = $_POST['grupoId_pantalla'];
				$id_grupo = $_POST['grupoId'];
				$grupo = $_POST['grupoNombre'];
				$padre = NULL;
				$gx = $_POST['grupoX'];
				$gy = $_POST['grupoY'];
				
				$newgrupo = new Grupo($id_grupo,$id_pantalla,$grupo,$padre,$gx,$gy);
				Grupo::save($newgrupo);
				
				$get_pantalla = $id_pantalla;				
			}
			
			/* ELIMINAR GRUPO */
			if (isset($_POST['accionGeliminar'])){
				$get_pantalla = $_POST['grupoId_pantalla'];
				$id_grupo = $_POST['grupoId'];	
/*				var_dump('id grupo: '.$id_grupo);
				die();	*/
				Grupo::delete($id_grupo);
			}

			/* EDITAR ELEMENTO */
			if (isset($_POST['accionEeditar'])){
				$get_pantalla = $_POST['eId_pantalla'];

				$id_elemento = $_POST['eId_elemento'];
				$id_grupo = $_POST['eId_grupo'];
				$id_tipo = $_POST['eId_tipo'];
				$x = $_POST['eX'];
				$y = $_POST['eY'];
				$xx = $_POST['eXx'];
				$yy = $_POST['eYy'];
				$id_colorin = $_POST['eId_colorin'];
				$id_colorout = $_POST['eId_colorout'];
				$dimension = $_POST['eDimension'];
				$nombre = $_POST['eNombre'];
				$variable = isset($_POST['eVariable'])?$_POST['eVariable']:NULL;
				$unidad = isset($_POST['eUnidad'])?$_POST['eUnidad']:NULL;
				
				$elemento = new Elemento($id_elemento,$id_grupo,$id_tipo,$id_colorin,$id_colorout,$x,$y,$xx,$yy,$dimension,$nombre,$variable,$unidad);
				$get_grupo = $id_grupo;
				Elemento::update($elemento);
				
			}   
			
			/* CREAR ELEMENTO */
			if (isset($_POST['accionEcrear'])){
				$get_pantalla = $_POST['eId_pantalla'];

				$id_elemento = $_POST['eId_elemento'];
				$id_grupo = $_POST['eId_grupo'];
				$id_tipo = $_POST['eId_tipo'];
				$x = $_POST['eX'];
				$y = $_POST['eY'];
				$xx = $_POST['eXx'];
				$yy = $_POST['eYy'];
				$id_colorin = $_POST['eId_colorin'];
				$id_colorout = isset($_POST['eId_colorout'])?$_POST['eId_colorout']:0;
				$dimension = $_POST['eDimension'];
				$nombre = $_POST['eNombre'];
				$variable = isset($_POST['eVariable'])?$_POST['eVariable']:NULL;
				$unidad = isset($_POST['eUnidad'])?$_POST['eUnidad']:NULL;
				
				$elemento = new Elemento($id_elemento,$id_grupo,$id_tipo,$id_colorin,$id_colorout,$x,$y,$xx,$yy,$dimension,$nombre,$variable,$unidad);
				$get_grupo = $id_grupo;
				Elemento::save($elemento);
			}

			/* ELIMINAR ELEMENTO*/
			if (isset($_POST['accionEeliminar'])){
/*				if (isset($_POST['eliminacion']) && ($_POST['eliminacion']=="SI")){ */
					$get_pantalla = $_POST['eId_pantalla'];
					$get_grupo = $_POST['eId_grupo'];
					$id_elemento = $_POST['eId_elemento'];	
					
					Elemento::delete($id_elemento);
						
/*				} */
			}
			
			$PS = Pantalla::CargaPantallaFull($get_pantalla);
			require_once('Views/Pantalla/dibujaPantalla.php');
			
		}
/*    Viejo Edita Pantalla 		
		function editaPantalla(){
			//global $valores;
            require_once('Model/Pantalla.php');
            require_once('Model/Grupo.php');
            require_once('Model/Elemento.php');
            require_once('Model/Color.php');
            require_once('Model/Tipo.php');
			require_once('Model/Unidad.php');
            require_once('lee_shares.php');
			
			/* EDITAR ELEMENTO */
/*			if (isset($_POST['elemento_editar'])){
				$id_pantalla = $_POST['ee_id_pantalla'];
				$id_elemento = $_POST['ee_id_elemento'];
				$id_grupo = $_POST['ee_id_grupo'];
				$id_tipo = $_POST['ee_id_tipo'];
				$x = $_POST['ee_x'];
				$y = $_POST['ee_y'];
				$xx = $_POST['ee_xx'];
				$yy = $_POST['ee_yy'];
				$id_colorin = $_POST['ee_id_colorin'];
				$id_colorout = $_POST['ee_id_colorout'];
				$dimension = $_POST['ee_dimension'];
				$nombre = $_POST['ee_nombre'];
				$variable = (isset($_POST['ee_variable'])) ? $_POST['ee_variable'] : NULL ;
				
				$elemento = new Elemento($id_elemento, $id_grupo, $id_tipo, $id_colorin, $id_colorout, $x, $y, $xx, $yy, $dimension, $nombre, $variable);
				Elemento::update($elemento);
			}
			
			/* EDITAR GRUPO */
/*			if (isset($_POST["grupo_editar"])) {
				$id_pantalla = $_POST['gid_pantalla'];
				$id_grupo = $_POST['mg_id_grupo'];
				$grupo = $_POST['mg_grupo'];
				$gx = $_POST['mg_x'];
				$gy = $_POST['mg_y'];
				
				$newgrupo = new Grupo($id_grupo, $id_pantalla, $grupo, 0, $gx, $gy);
				Grupo::update($newgrupo);
			}
			
			/* CREAR ELEMENTO */
/*			if(isset($_POST['elemento_crear'])){
				$id_pantalla = $POST['ec_id_pantalla'];
				$id_grupo = $_POST['ec_id_grupo'];
				$id_tipo = $_POST['ec_id_tipo'];
				$x = $_POST['ec_x'];
				$y = $_POST['ec_y'];
				$xx = $_POST['ec_xx'];
				$yy = $_POST['ec_yy'];
				$id_colorin = $_POST['ec_id_colorin'];
				$id_colorout = $_POST['ec_id_colorout'];
				$dimension = $_POST['ec_dimension'];
				$nombre = $_POST['ec_nombre'];
				$variable = $_POST['ec_variable'];
				
				$elemento = new Elemento(NULL, $id_grupo, $id_tipo, $id_colorin, $id_colorout, $x, $y, $xx, $yy, $dimension, $nombre, $variable);
				Elemento::save($elemento);
			}
			/* CREAR GRUPO */
/*			if(isset($_POST['grupo_crear'])){
				$id_pantalla = $_GET['gc_id_pantalla'];
				$grupo = $_POST['gc_grupo'];
				$x = $_POST['gc_x'] ;
				$y = $_POST['gc_y'] ;
				
				$grupo = new Grupo(NULL, $id_pantalla, $grupo, 0, $x, $y);
				Grupo::save($grupo);
			}

			/* EDITAR MARCO */			
/*			if (isset($_POST['marco_editar'])){
				
				$id_pantalla = $_GET['id_pantalla'];
				$pantalla = $_POST['me_pantalla'];
				$w = $_POST['me_w'];
				$h = $_POST['me_h'];
				$background = $_POST['me_background'];
				
				$newmarco = new Pantalla($id_pantalla, $pantalla, $w, $h, $background);
				Pantalla::update($newmarco);				
				
			}  
			
			/* ELIMINAR MARCO */			
/*			if(isset($_POST['elemento_eliminar'])){
				$id_elemento = $_POST['id_elemento'];
				
				Elemento::delete($id_elemento);
			}

			/* ELIMINAR GRUPO */			
/*			if(isset($_POST['grupo_eliminar'])){
				$id_grupo = $_POST['mg_id_grupo'];
				
				Grupo::delete($id_grupo);
			}

			if (isset($_GET['id_pantalla'])) {
				$id_pantalla = $_GET['id_pantalla'];
			} else {
				if (isset($_POST['id_pantalla'])){
					$id_pantalla = $_POST['id_pantalla'];
				} else {
					$id_pantalla = 1;
				}
			}

			$PS = Pantalla::CargaPantallaFull($id_pantalla);

			require_once('Views/Pantalla/editaPantalla.php');
		}*/
		function showElemento(){
            require_once('Model/Pantalla.php');

			if (isset($_GET['id_pantalla'])) {
				$id_pantalla=$_GET['id_pantalla'];
			} else {
				$id_pantalla = 1;
			}
			
			$fullPantalla = Pantalla::CargaPantallaFull($id_pantalla);

			require_once('Views/Pantalla/showElementos.php');
		}
		
		function show(){
			$listaPantalla=Pantalla::all();
            require_once('Model/Pantalla.php');
			require_once('Model/Color.php');
			
			require_once('Views/Pantalla/show.php');
		}
	
		function updateshow(){
			$id_pantalla=$_GET['id_pantalla'];
			$rubro=Pantalla::searchById($id_pantalla);
            
            require_once('Model/Pantalla.php');

			require_once('Views/Pantalla/updateshow.php');
		}

		function itemsshow(){
			$id_pantalla=$_GET['id_pantalla'];
			
            require_once('Model/Pantalla.php');
            require_once('Model/SubPantalla.php');
            require_once('Model/SbrxPv.php');
			
			$rubro=Pantalla::searchById($id_pantalla);
			
			require_once('Views/Pantalla/itemsshow.php');
		}
		

		function update(){
			$rubro = new Pantalla;
			
			$rubro->setId($_POST['id_pantalla']);
			$rubro->nombre_r=$_POST['nombre_r'];
			$rubro->descripcion=$_POST['descripcion'];
										   
			Pantalla::update($rubro);
			require_once('Model/Pantalla.php');
			require_once('Views/Pantalla/updateshow.php');

/*			echo "<script>
				  window.location.href = './?controller=presupuesto&&action=itemsshow&&id_pantalla=".$rubro->getId()."';
				</script>";
*/
		}
		
		function delete(){
			require_once('Model/SubPantalla.php');
			
			$id=$_GET['id'];
			$conSubrubros = Subrubro::searchByIdPantalla($id);
			
			if (empty($conSubrubros)){
				Pantalla::delete($id);
				echo '<div class="alert alert-success" role="alert">
						  Pantalla eliminado exitosamente.
					  </div>' ;
				$this->show();
			} else {
				$msg_error = "No es posible eliminar Pantallas con Subrubros asociados!";
				$this->error($msg_error);

/*				echo "<script>
					  window.location.href = './?controller=rubro&&action=itemsshow&&id_pantalla=".$id."';
					</script>";
*/
				//echo "<span> No es posible Eliminar un Pantalla que contiene Subrubros asociados !!";
			};
		
		}
	
		function error(){
			require_once('Views/Pantalla/error.php');
		}
	
	}
}
?>