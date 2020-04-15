<?php 
	if(isset($_GET['id_patalla'])){
		$get_pantalla = $_GET['id_patalla'];
	}

	$id_grupo = (isset($get_grupo))?$get_grupo: "";
?>

<div id="elementos" style="padding-bottom:5px">

<!--  PANTALLA  -->
    <input type="hidden" name="id_pantalla" id="id_pantalla" value="<?php echo $PS[0]['id_pantalla']; ?>">
    <input type="hidden" name="eliminacion" id="eliminacion" value="NO">
    
    <span style="color:#063BB7; ">|| Pantalla:</span>
    <label><?php echo $PS[0]['pantalla']; ?></label>
	<img src="img/edit-24px.svg" alt="Edit Marco" id="btn_editMarco">

<!--  GRUPO  -->
    <input type="hidden" name="id_grupo" id="id_grupo">  <!-- type="hidden" -->
    
    <span style="color:#063BB7;"> || Grupo:</span>
    <select class="g_select" name="sel_id_grupo" id="sel_id_grupo">
        <option value=""> ... </option>
        <?php
			$grp = sotr\Grupo::searchByPantalla($PS[0]['id_pantalla']);
			foreach($grp as $g){
				$seleccion = ($g->getId() == $id_grupo) ? "selected" : "";
				echo '<option '.$seleccion.' value="'.$g->getId().'">'.$g->grupo.'</option>';
			}
        ?>
    </select>
	<img src="img/edit-24px.svg" alt="Edit Grupo" id="btn_editGrupo">
    <img src="img/add_box-24px.svg" alt="crea Grupo" id="btn_creaGrupo">


<!--  ELEMENTO  -->
    <input type="hidden" name="id_elemento" id="id_elemento">
    
    <span style="color:#063BB7;"> || Elemento:</span>
    <select  name="sel_id_elemento" id="sel_id_elemento">
        <option value="">Elija un Grupo...</option>
        <?php
			if(isset($id_grupo)){
				foreach($PS as $E){
					if($E['id_grupo'] == $id_grupo){
						echo "<option value = ".$E['id_elemento'].">".$E['nombre']."</option>";
					}
				}
			}
		?>
	</select>    
    <img src="img/add_box-24px.svg" alt="crea Elemento" name="btn_creaElemento" id="btn_creaElemento">

	<span style="float: right; padding-right: 100px; ">
    	<a href="./?controller=pantalla&&action=show"><img src="img/close-24px.svg" alt="Cerrar"></a>
<!--    <img src="img/close-24px.svg" alt="close" id="close"> -->
    </span> 
    
</div>


<div id="dibujo">
    <?php file_put_contents('Views/Pantalla/pantalla.json', json_encode($PS)); ?>
    <img src="Views/Pantalla/drawer.php"> 
</div>

<!-----------------------+
|    Modal Edita Marco   |
+------------------------>
<div class="modal" id="modal_editMarco">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form-modal" id="form_em" action="./?controller=pantalla&&action=dibujaPantalla" method="POST" >
            
            <input type="hidden" name="m_id_pantalla" id="m_id_pantalla" value="<?php echo $PS["id_pantalla"]; ?>">
          <h4> Editar Marco</h4>			
              <div class="div-bott25">
                <label for="m_pantalla">Pantalla:</label>
                <input type="text" id="m_pantalla" name="m_pantalla" style="width: 12em">
              </div>
              <div class="div-bott25">
                <label for="m_w"> Ancho: </label>
                <input type="number" name="m_w" id="m_w" step="1" style="width: 5em; text-align: right">
				<label for="m_h"> Alto: </label>
                <input type="number" name="m_h" id="m_h" step="1" style="width: 5em; text-align: right">
              </div>
              <div  class="div-bott25">
                <label for="m_background">Background: </label>
                <select name="m_background" id="m_background">
                    <option value="0">... </option>
                    <?php
                       $colores = sotr\Color::all();
                       foreach($colores as $c){
                            echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
                       }
                    ?>
                </select>
              </div>

              <div class="div-bott25">
                <button type="submit" name="marco_editar" id="marco_editar" style="float:right">Actualizar</button>        
              </div>
        </form>
    </div>
</div>

<!-------------------------------+
|   Editar + Crear  Grupo Modal  |
+-------------------------------->
<div class="modal" id="modal_editGrupo">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form-modal" id="form_eg" action="./?controller=pantalla&&action=dibujaPantalla" method="POST" > <!--action="./?controller=pantalla&&action=dibujaPantalla" -->
            
            <input type="hidden" name="grupoId_pantalla" id="grupoId_pantalla"> <!-- type="hidden"  -->
            <input type="hidden" name="grupoId" id="grupoId" >
          <h4> Editar Grupo</h4>			
              <div class="div-bott25">
                <label for="grupoNombre">Grupo:</label>
                <input type="text" id="grupoNombre" name="grupoNombre" style="width: 12em">
              </div>
              <div class="div-bott25">
                <label for="grupoX"> X: </label>
                <input type="number" name="grupoX" id="grupoX" step="1" style="width: 4em; text-align: right">

                <label for="grupoY"> Y: </label>
                <input type="number" name="grupoY" id="grupoY" step="1" style="width: 4em; text-align: right">
              </div>
              <div class="div-bott25">
              	<p>
                <button type="submit" name="accionGeditar" id="accionGeditar">Actualizar</button>	
                <button type="submit" name="accionGcrear" id="accionGcrear" style="visibility:hidden; float:right">Crear</button>	
                <button type="submit" name="accionGeliminar" id="accionGeliminar" style="float:right" onClick="return confirm('Seguro desea eliminar este grupo?');">
                	Eliminar
                </button>
              </div>
        </form>
    </div>
</div>

<!--------------------------------------+
 |	Editar + Crear Elemento Modal 		|
 +-------------------------------------->
<div class="modal" id="modal_editElemento">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form-modal" id="form_ee" action="./?controller=pantalla&&action=dibujaPantalla" method="POST" >
            
            <input type="hidden" name="eId_pantalla" id="eId_Pantalla">
            <input type="hidden" name="eId_elemento" id="eId_elemento">
<!--            <input type="hidden" name="eId_tipo" id="eId_tipo">  -->
        
            <h4> Editar Elemento </h4>
            <div  class="div-bott25">
                <label for="eNombre">Nombre:</label>
                <input type="text" id="eNombre" name="eNombre" style="width: 12em">		
            </div>
            <div class="div-bott25">
                <label>Grupo: </label>
                <select name="eId_grupo" id="eId_grupo">
                	<option value="">... </option>
					<?php
                        $grp = sotr\Grupo::searchByPantalla($PS[0]['id_pantalla']);
                        foreach($grp as $g){
                            echo '<option value="'.$g->getid().'">'.$g->grupo.'</option>';
                        }
                    ?>
                </select>';
            </div>                    
            <div class="div-bott25">
                <label>Tipo: </label>
                <select name="eId_tipo" id="eId_tipo">
                    <option value="">... </option>
                    <?php
                        $tipos = sotr\Tipo::all();
                        foreach($tipos as $t){
                            echo '<option value="'.$t->getid().'">'.$t->tipo.'</option>';
                        }
                    ?>
                </select>';

            </div>                    
            <div  class="div-bott25">
                <label for="eX">Desde x: </label>
                <input type="number" name="eX" id="eX" step="1" style="width: 4em; text-align: right">
                <label for="eY">y: </label>
                <input type="number" name="eY" id="eY" step="1" style="width: 4em; text-align: right">
            </div>
            <div  class="div-bott25">
                <label for="eXx">Hasta x: </label>
                <input type="number" name="eXx" id="eXx" step="1" style="width: 4em; text-align: right">
                <label for="eYy">y: </label>
                <input type="number" name="eYy" id="eYy" step="1" style="width: 4em; text-align: right">
            </div>
            <div  class="div-bott25">
                <label for="eId_colorin">color in: </label>
                <select name="eId_colorin" id="eId_colorin">
                	<option value="0">... </option>
					<?php
                       $colores = sotr\Color::all();
                       foreach($colores as $c){
                            echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
                       }
                    ?>
                </select>';
            </div>
            <div  class="div-bott25">
                <label for="eId_colorout">color out: </label>
				<select name="eId_colorout" id="eId_colorout">
                    <option value="0">... </option>
                    <?php
                       foreach($colores as $c){
                            echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
                       }
                    ?>
              	</select>
            </div>
            <div  class="div-bott25">
                <label for="eDimension">font/dimensión: </label>
                <input type="number" name="eDimension" id="eDimension" step="1" style="width: 3em; text-align: right" min="1" max="5">
            </div>  
            <div class="div-bott25">
                <label for="eVariable">Variable:</label>
                <select name="eVariable" id="eVariable">
                    <option value="">... </option>
                    <?php
                        foreach($valores as $n=>$v){
                            echo '<option value="'.$n.'">'.$n.'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="div-bott25">
                <label for="eUnidad">Unidad: </label>
				<select name="eUnidad" id="eUnidad">
                    <option value="">... </option>
                    <?php
						$unidades = sotr\Unidad::all();
						foreach($unidades as $u){
							echo '<option value="'.$u->getid().'">'.$u->unidad.'</option>';
						}
                    ?>
              	</select>
            </div>
			<div class="div-bott25">
            	<p>
                <button type="submit" name="accionEeditar" id="accionEeditar" style="float:left;margin-left:5px;">Actualizar</button>
                <button type="submit" name="accionEcrear" id="accionEcrear" style="float:right;margin-right:50px;">Crear</button>
                <button type="submit" name="accionEeliminar" id="accionEeliminar" value="eliminar" style="float:right;margin-right:20px;" onClick="return confirm('Seguro desea eliminar este elemento?');">
                	Eliminar
                </button>
			</div>
          </form>
    </div>
</div>
<!--   FIN MODAL EDIT ELEMENTO  -->

<script>
	const btn_editMarco = document.getElementById('btn_editMarco');
	const btn_editGrupo = document.getElementById('btn_editGrupo');	
	const btn_creaGrupo = document.getElementById('btn_creaGrupo');	
	const selectGrupo = document.getElementById('sel_id_grupo');
	const selectElemento = document.getElementById('sel_id_elemento');
	
	const modalMarco = document.getElementById('modal_editMarco');
	const modalGrupo = document.getElementById('modal_editGrupo');
	const modalElemento = document.getElementById('modal_editElemento');
	
	const arr_elementos = <?php echo json_encode($PS); ?>;
	
/*  Edita Marco */	
	btn_editMarco.addEventListener('click',(event) =>{
		var w = document.getElementById('m_w');
		var h = document.getElementById('m_h');
		var id = document.getElementById('m_id_pantalla');
		var p = document.getElementById('m_pantalla');
		var bkg = document.getElementById('m_background');

		const span = document.getElementsByClassName("close")[0];
		
		id.value = arr_elementos[0].id_pantalla
		p.value = arr_elementos[0].pantalla;
		w.value = arr_elementos[0].w;
		h.value = arr_elementos[0].h;
		bkg.value = arr_elementos[0].background;

		modalMarco.style.display	= 'block';

		span.onclick = function() {
		  modalMarco.style.display = "none";
		}

	});

/*	Grupo Select Change   */	
	selectGrupo.addEventListener('change', (event) => {
		const id_grupo = selectGrupo.value ;
		
//		id_grupo.value = selectGrupo.value;
		
		addElementosOptions(id_grupo);
		//alert('Grupo Elejido: '+ id_grupo.value); 
	});

/*   Completar Select Elementos */	
	function addElementosOptions(id_grupo) {
/*		var arr_elementos = <?php echo json_encode($PS); ?>;*/

		selectElemento.innerHTML = '<option value="">...</option>'
		if(selectElemento !== ""){
			for (var i in arr_elementos){
				if (arr_elementos[i].id_grupo==selectGrupo.value){
					var opcion = document.createElement('option');
					opcion.value = arr_elementos[i].id_elemento;
					opcion.text = arr_elementos[i].nombre;
					selectElemento.add(opcion);
				}
			}
		}
	}

/* Click Edita Grupo  */
	btn_editGrupo.addEventListener('click', (event) => {
		
		const sel_id_grupo = document.getElementById('sel_id_grupo').value;
		modalGrupo.style.display = 'none';
		const actualizar = document.getElementById("accionGeditar");
		const eliminar = document.getElementById("accionGeliminar");
		const crear = document.getElementById("accionGcrear");

		for (var i in arr_elementos){
			if (arr_elementos[i].id_grupo==sel_id_grupo){
		 		document.getElementById("form_eg").elements.namedItem("grupoId_pantalla").value=arr_elementos[0].id_pantalla;		
				document.getElementById("form_eg").elements.namedItem("grupoId").value=sel_id_grupo;
				document.getElementById("form_eg").elements.namedItem("grupoNombre").value=arr_elementos[i].grupo;
				document.getElementById("form_eg").elements.namedItem("grupoX").value=arr_elementos[i].gx;
				document.getElementById("form_eg").elements.namedItem("grupoY").value=arr_elementos[i].gy;
				break;
			}
		}

		const span = document.getElementsByClassName("close")[1];

		modalGrupo.style.display = 'block';
		actualizar.style.visibility = "visible";
		eliminar.style.visibility = "visible";
		crear.style.visibility = "hidden";
		

		span.onclick = function() {
		  modal_editGrupo.style.display = "none";
		}
	});

/*  Edita Elemento change */
	selectElemento.addEventListener('change', (event) => {
		const id_elemento = document.getElementById('sel_id_elemento').value;
				
		modal_editElemento.style.display = 'none';
		const actualizar = document.getElementById("accionEeditar");
		const eliminar = document.getElementById("accionEeliminar");
		const crear = document.getElementById("accionEcrear");
		
		for( var i in arr_elementos){
			if(arr_elementos[i].id_elemento==id_elemento){
				document.getElementById("form_ee").elements.namedItem("eId_pantalla").value=arr_elementos[i].id_pantalla;
				document.getElementById("form_ee").elements.namedItem("eId_tipo").value=arr_elementos[i].id_tipo;
				document.getElementById("form_ee").elements.namedItem("eId_grupo").value=arr_elementos[i].id_grupo;
				document.getElementById("form_ee").elements.namedItem("eId_elemento").value=arr_elementos[i].id_elemento;
				document.getElementById("form_ee").elements.namedItem("eId_tipo").value=arr_elementos[i].id_tipo;
				document.getElementById("form_ee").elements.namedItem("eNombre").value=arr_elementos[i].nombre;				
				document.getElementById("form_ee").elements.namedItem("eX").value=arr_elementos[i].x;
				document.getElementById("form_ee").elements.namedItem("eY").value=arr_elementos[i].y;
				document.getElementById("form_ee").elements.namedItem("eXx").value=arr_elementos[i].xx;
				document.getElementById("form_ee").elements.namedItem("eYy").value=arr_elementos[i].yy;
				document.getElementById("form_ee").elements.namedItem("eId_colorin").value=arr_elementos[i].id_colorin;
				document.getElementById("form_ee").elements.namedItem("eId_colorout").value=arr_elementos[i].id_colorout;
				document.getElementById("form_ee").elements.namedItem("eDimension").value=arr_elementos[i].dimension;
				document.getElementById("form_ee").elements.namedItem("eVariable").value=arr_elementos[i].variable;
				document.getElementById("form_ee").elements.namedItem("eUnidad").value=arr_elementos[i].id_unidad;
				break;				
			}
		}

		actualizar.style.visibility = "visible";
		eliminar.style.visibility = "visible";
		crear.style.visibility = "hidden";

		modal_editElemento.style.display = 'block';
		const span = document.getElementsByClassName("close")[2];

		span.onclick = function() {
			modal_editElemento.style.display = "none";
		}
		
	});

/*  Crear un Grupo  */
	btn_creaGrupo.addEventListener('click', (event) => {
		modalGrupo.style.display = "none";
		
		const span = document.getElementsByClassName("close")[1];
		const actualizar = document.getElementById("accionGeditar");
		const eliminar = document.getElementById("accionGeliminar");
		const crear = document.getElementById("accionGcrear");

 		document.getElementById("form_eg").elements.namedItem("grupoId_pantalla").value=arr_elementos[0].id_pantalla;		
		document.getElementById("form_eg").elements.namedItem("grupoId").value=null;
		document.getElementById("form_eg").elements.namedItem("grupoNombre").value="";
		document.getElementById("form_eg").elements.namedItem("grupoX").value=null;
		document.getElementById("form_eg").elements.namedItem("grupoY").value=null;
		
		console.log('id_pantalla = ' + arr_elementos[0].id_pantalla);
		
		modalGrupo.style.display = "block";
		
		actualizar.style.visibility = "hidden";
		eliminar.style.visibility = "hidden";
		crear.style.visibility = "visible";
		
		span.onclick = function() {
			modal_editGrupo.style.display = "none";
		}
				
	});

/*  Crear Elemento */
	btn_creaElemento.addEventListener('click', (event) => {
		
		modal_editElemento.style.display = 'none';
		const actualizar = document.getElementById("accionEeditar");
		const eliminar = document.getElementById("accionEeliminar");
		const crear = document.getElementById("accionEcrear");

		document.getElementById("form_ee").elements.namedItem("eId_pantalla").value=document.getElementById('id_pantalla').value;;
		document.getElementById("form_ee").elements.namedItem("eId_tipo").value=null;
		document.getElementById("form_ee").elements.namedItem("eId_grupo").value=document.getElementById('sel_id_grupo').value;
		document.getElementById("form_ee").elements.namedItem("eId_elemento").value=null;
		document.getElementById("form_ee").elements.namedItem("eId_tipo").value=null;
		document.getElementById("form_ee").elements.namedItem("eNombre").value=null;				
		document.getElementById("form_ee").elements.namedItem("eX").value=null;
		document.getElementById("form_ee").elements.namedItem("eY").value=null;
		document.getElementById("form_ee").elements.namedItem("eXx").value=null;
		document.getElementById("form_ee").elements.namedItem("eYy").value=null;
		document.getElementById("form_ee").elements.namedItem("eId_colorin").value=0;
		document.getElementById("form_ee").elements.namedItem("eId_colorout").value=0;
		document.getElementById("form_ee").elements.namedItem("eDimension").value=1;
		document.getElementById("form_ee").elements.namedItem("eVariable").value=null;
		document.getElementById("form_ee").elements.namedItem("eUnidad").value=null;

		actualizar.style.visibility = "hidden";
		eliminar.style.visibility = "hidden";
		crear.style.visibility = "visible";

		modal_editElemento.style.display = 'block';
		const span = document.getElementsByClassName("close")[2];

		span.onclick = function() {
			modal_editElemento.style.display = "none";
		}
				
	});
	
</script>
