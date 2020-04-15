
<div class="flex-container">
    <div id="elementos">        

        <label  style="color:#063BB7; font-weight:bold">Grupo: </label>
        <select name="sel_id_grupo" id="sel_id_grupo" onChange=GetGrupo()>
            <option value=""> ... </option>
            <?php
               $grp = sotr\Grupo::all();
    /*           echo '<select name="sel_id_grupo" id="sel_id_grupo" onChange=GetGrupo()>'; //
               echo '<option value=""> ... </option>';  
    */         
                foreach($grp as $g){
                    $selected=($grupo_post == $g->getid()) ? "selected" : "";
                    echo '<option '.$selected.' value="'.$g->getid().'">'.$g->grupo.'</option>';
               }
            ?>
        </select>
		<img src="img/add_box-24px.svg" alt="Nuevo" onClick="CreaGrupo()">

<!--        <button name="crea_grupo" id="crea_grupo" onClick="CreaGrupo()">[+]</button>  -->

        <label style="color:#063BB7; font-weight:bold">| Elemento: </label>
        <select name="sel_id_elemento" id="sel_id_elemento" style="width: 10em" onChange=GetElemento()>
	        <option '.$e_sel.' value="">Elija un grupo ... </option>
			<?php
                if( !is_null($grupo_post)){
                    foreach($PS as $elemento){
                        if($grupo_post == $elemento['id_grp']){
                            $tipo = substr($elemento['tipo'],0,2);
                            echo '<option value="'.$elemento['id_elemento'].'">'.$tipo.'-'.$elemento['nombre'].'</option>';
                        }
                    }
                }
            ?>        
		</select>

		<img src="img/add_box-24px.svg" alt="Nuevo" onClick="CreaElemento()"> <!-- align="middle"  -->
    	
        <input type="hidden" name="me_id_pantalla" id="me_id_pantalla" value="<?php echo $PS[0]['id_pantalla']; ?>">
        <input type="hidden" name="me_pantalla" id="me_pantalla" value="<?php echo $PS[0]['pantalla']; ?>">

<!--	<form name="frm_editaMarco" id="frm_editaMarco" action="./?controller=pantalla&&action=editaPantall" method="POST" > -->

        <label style="color:#063BB7; font-weight:bold">| Pantalla:</label>
        <label><?php echo $PS[0]['pantalla']; ?></label>

        <label for="Ancho">Ancho: </label>
        <input type="number" name="me_w" id="me_w" step="1" style="width: 4em; text-align: right" value="<?php echo $PS[0]['w']; ?>">
        
        <label for="Alto">Alto: </label>
        <input type="number" name="me_h" id="me_h" step="1" style="width: 4em; text-align: right" value="<?php echo $PS[0]['h']; ?>">
        
        <label for="background">Fondo: </label>        
       	<select name="me_background" id="me_background">
       		<option value="0">... </option>
			<?php
               $colores = sotr\Color::all();
               foreach($colores as $c){
                    $selected=($c->getId() == $PS[0]['background']) ? "selected" : "";                        
                    echo '<option '.$selected.' value="'.$c->getid().'">'.$c->color.'</option>';
               }
            ?>
        </select>
        
        <button type="submit" name="marco_editar" id="marco_editar">Actualizar</button>
<!--     </form>  -->
   </div>
</div>

<div id="dibujo">    
    <?php file_put_contents('Views/Pantalla/pantalla.json', json_encode($PS)); ?>
    <img src="Views/Pantalla/drawer.php">
</div>

<!------------------------------+
 |	Editar Elemento Modal 		|
 +------------------------------>
<div class="modal" id="modal_e_edit">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form-modal" id="form_ee" action="./?controller=pantalla&&action=editaPantalla" method="POST" >
            
            <input type="hidden" name="ee_id_elemento" id="ee_id_elemento">
            <input type="hidden" name="ee_id_tipo" id="ee_id_tipo">
        
            <h4> Editar Elemento </h4>
            <section>
              <div  class="div-bott25">
                <label for="nombre">Nombre:</label>
                <input type="text" id="ee_nombre" name="ee_nombre" style="width: 12em">		
              </div>
            
              <div class="div-bott25">
                <label>Grupo: </label>
                <?php
                   $grp = sotr\Grupo::all();
                   echo '<select name="ee_id_grupo" id="ee_id_grupo">';
                   echo '<option value="">... </option>';  
                   foreach($grp as $g){
        //                    $selected=($g->getId() == $elemnto->id_grupo) ? "selected" : "";                        
                        echo '<option value="'.$g->getid().'">'.$g->grupo.'</option>';
                   }
                   echo '</select>';
                ?>
              </div>                    
            </section>
                
            <section>			
              <div  class="div-bott25">
                <label for="ee_x">Desde x: </label>
                <input type="number" name="ee_x" id="ee_x" step="1" style="width: 4em; text-align: right">
                <label for="ee_y">y: </label>
                <input type="number" name="ee_y" id="ee_y" step="1" style="width: 4em; text-align: right">
              </div>
              <div  class="div-bott25">
                <label for="ee_xx">Hasta x: </label>
                <input type="number" name="ee_xx" id="ee_xx" step="1" style="width: 4em; text-align: right">
                <label for="ee_yy">y: </label>
                <input type="number" name="ee_yy" id="ee_yy" step="1" style="width: 4em; text-align: right">
              </div>
            </section>
            
            <section> 
              <div  class="div-bott25">
                <label for="ee_id_colorin">color in: </label>
                <?php
                   $colores = sotr\Color::all();
                   echo '<select name="ee_id_colorin" id="ee_id_colorin">';
                   echo '<option value="0">... </option>';  
                   foreach($colores as $c){
        //                    $selected=($c->getId() == $elemnto->id_colorin) ? "selected" : "";                        
                        echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
                   }
                   echo '</select>';
                ?>
              </div>
            </section>
            <section>
              <div  class="div-bott25">
                <label for="ee_id_colorout">color out: </label>
                <?php
        //               $colores = sotr\Color::all();
                   echo '<select name="ee_id_colorout" id="ee_id_colorout">';
                   echo '<option value="0">... </option>';  
                   foreach($colores as $c){
        //                    $selected=($c->getId() == $elemnto->id_colorout) ? "selected" : "";                        
                        echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
                   }
                   echo '</select>';
                ?>
              </div>
            </section>
            <section>
              <div  class="div-bott25">
                <label for="ee_dimension">font/dimensión: </label>
                <input type="number" name="ee_dimension" id="ee_dimension" step="1" style="width: 3em; text-align: right" min="1" max="5">
              </div>  
            </section>
            <section>     
              <div class="div-bott25">
                    <label for="ee_variable">Variable:</label>
                    <?php
                        echo '<select name="ee_variable" id="ee_variable">';
                        echo '<option value="">... </option>';
                        foreach($valores as $n=>$v){
        //	                	$selected=($n == $elemnto->variable) ? "selected" : "";                        
                            echo '<option value="'.$n.'">'.$n.'</option>';
                        }
                        echo '</select>';
                    ?>
                </div>
            </section>
            <button type="submit" name="elemento_editar" id="elemento_editar" style="float:left;margin-left:30px;">Actualizar</button>
            <button type="submit" name="elemento_eliminar" id="elemento_eliminar" style="float:right">Eliminar</button>
        
        <!--        <br style="clear:both;" />   -->
        
          </form>
    </div>
</div>
<!--   FIN MODAL EDIT ELEMENTO  -->

<!------------------------------+
|	Crear  Elemento  Modal 	|
+------------------------------->
<div class="modal" id="modal_e_crear">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form-modal" id="form_ce" action="./?controller=pantalla&&action=editaPantalla" method="POST" >
            
            <h4> Crear Elemento </h4>
                
              <div class="div-bott25">
                <label for="m_tipo">Tipo: </label>
                <?php
                   $Tipos = sotr\Tipo::all();
                   echo '<select name="ec_id_tipo" id="ec_id_tipo">';
                   echo '<option value="0">... </option>';  
                   foreach($Tipos as $t){
        //                    $selected=($t->getId() == $elemnto->id_colorin) ? "selected" : "";                        
                        echo '<option value="'.$t->getid().'">'.$t->tipo.'</option>';
                   }
                   echo '</select>';
                ?>
              </div>
                
              <div class="div-bott25">
                <label>Grupo: </label>
                <?php
                   $grp = sotr\Grupo::all();
                   echo '<select name="ec_id_grupo" id="ec_id_grupo">';
                   echo '<option value="0">... </option>';  
                   foreach($grp as $g){
        //                    $selected=($g->getId() == $elemnto->id_grupo) ? "selected" : "";                        
                        echo '<option value="'.$g->getid().'">'.$g->grupo.'</option>';
                   }
                   echo '</select>';
                ?>
              </div>
                
              <div class="div-bott25">
                <label for="ec_nombre">Nombre:</label>
                <input type="text" id="ec_nombre" name="ec_nombre" style="width: 12em">
             </div>
             
             <div class="div-bott25">		
                <label for="dimension">font/dimensión: </label>
                <input type="number" name="ec_dimension" id="ec_dimension" step="1" style="width: 3em; text-align: right" min="1" max="5">
             </div>
                
             <div class="div-bott25">
                <label for="ec_x">Desde x: </label>
                <input type="number" name="ec_x" id="ec_x" step="1" style="width: 4em; text-align: right">
                
                <label for="ec_y"> y: </label>
                <input type="number" name="ec_y" id="ec_y" step="1" style="width: 4em; text-align: right">
             </div>
             
             <div class="div-bott25">	
                <label for="ec_xx">Hasta x: </label>
                <input type="number" name="ec_xx" id="ec_xx" step="1" style="width: 4em; text-align: right">
                
                <label for="ec_yy"> y: </label>
                <input type="number" name="ec_yy" id="ec_yy" step="1" style="width: 4em; text-align: right">
             </div>
            
             <div class="div-bott25">   
                <label for="ec_id_colorin">color In: </label>
                <?php
                   $colores = sotr\Color::all();
                   echo '<select name="ec_id_colorin" id="ec_id_colorin">';
                   echo '<option value="0">... </option>';  
                   foreach($colores as $c){
                        //$selected=($c->getId() == $elemnto->id_colorin) ? "selected" : "";                        
                        echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
                   }
                   echo '</select>';
                ?>
             </div>
                
             <div class="div-bott25">	
                <label for="ec_id_colorout">color Out: </label>
                <?php
        //               $colores = sotr\Color::all();
                   echo '<select name="ec_id_colorout" id="ec_id_colorout">';
                   echo '<option value="0">... </option>';  
                   foreach($colores as $c){
                        //$selected=($c->getId() == $elemnto->id_colorout) ? "selected" : "";                        
                        echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
                   }
                   echo '</select>';
                ?>
            </div>
            
            <div class="div-bott25">
                <label for="ec_variable">Variable:</label>
        <!--                <input type="text" id="ec_variable" name="ec_variable">	-->
                <?php
                   echo '<select name="ec_variable" id="ec_variable">';
                   echo '<option value="">... </option>';  
                   foreach($valores as $n=>$v){
                        echo '<option value="'.$n.'">'.$n.'</option>';
                   }
                   echo '</select>';
                ?>
            </div>
            <button type="submit" name="elemento_crear" id="elemento_crear">Crear</button>
        </form>
    </div>
</div>
<!--   FIN MODAL CREA ELEMENTO  -->
	
<!-----------------------+
|    Modal Edita Grupo   |
+------------------------>
<div class="modal" id="modal_g_edit">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form-modal" id="form_eg" action="./?controller=pantalla&&action=editaPantalla" method="POST" >
            
            <input type="hidden" name="gid_pantalla" id="gid_pantalla" value="<?php echo $E["id_pantalla"]; ?>">
            <input type="hidden" name="mg_id_grupo" id="mg_id_grupo" >
          <h4> Editar Grupo</h4>			
              <div class="div-bott25">
                <label for="m_grupo">Grupo:</label>
                <input type="text" id="mg_grupo" name="mg_grupo" style="width: 12em">
              </div>
              <div class="div-bott25">
                <label for="g_x"> X: </label>
                <input type="number" name="mg_x" id="mg_x" step="1" style="width: 4em; text-align: right">
        <!--              </div>
              <div   class="div-bott25">
        -->                <label for="g_y"> Y: </label>
                <input type="number" name="mg_y" id="mg_y" step="1" style="width: 4em; text-align: right">
              </div>
              <div class="div-bott25">
                <button type="submit" name="grupo_editar" id="grupo_editar">Actualizar</button>	
                <button type="submit" name="grupo_eliminar" id="grupo_eliminar" style="float:right">Eliminar</button>
        
              </div>
        </form>
    </div>
</div>
<!------------------------------+


<!-----------------------+
|    Modal Crea Grupo    |
+------------------------>
<div class="modal" id="modal_g_crear">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form-modal" id="form_cg" action="./?controller=pantalla&&action=editaPantalla" method="POST" >
            
            <input type="hidden" name="gc_id_pantalla" id="gc_id_pantalla" value="<?php echo $PS[0]["id_pantalla"]; ?>">
            
            <h4> Crear Nuevo Grupo </h4>
            <div class="div-bott25">
                <label for="gc_grupo">Grupo:</label>
                <input type="text" id="gc_grupo" name="gc_grupo" style="width: 4em">
            </div>
            <div class="div-bott25">
                <label for="gc_x"> x: </label>
                <input type="number" name="gc_x" id="gc_x" step="1" style="width: 4em; text-align: right">
            </div>
            <div class="div-bott25">
                <label for="gc_y"> y: </label>
                <input type="number" name="gc_y" id="gc_y" step="1" style="width: 4em; text-align: right">
            </div>
            <div class="div-bott25">  	
                <button type="submit" name="grupo_crear" id="grupo_crear">Crear</button>
            </div>
        </form>
    </div>
</div>
<!------------------------------+
 |			Fin  Modal 			|
 +------------------------------>
    
<script>
/*--------------------------+
 |		Edita elemento		|
 +--------------------------*/
	function GetElemento(){
		var modal_ee = document.getElementById("modal_e_edit");
		var modal_ec = document.getElementById("modal_e_crear");
		var modal_ge = document.getElementById("modal_g_edit");
		var modal_gc = document.getElementById("modal_g_crear");

		// Get the button that opens the modal
		var btn = document.getElementById("btn_editar");
			
		// Get the <span> element that closes the modal
		var span_e = document.getElementsByClassName("close")[0];
		
		//console.log("muestra el modal");
		
		var elementos = <?php echo json_encode($PS); ?>;
	
		var elegido = document.getElementById("sel_id_elemento");
		var indice = elegido.options[elegido.selectedIndex].value;
		
		for( var i in elementos ){
			if(elementos[i].id_elemento==indice){
				document.getElementById("ee_id_elemento").value = elementos[i].id_elemento;
				document.getElementById("ee_id_grupo").value = elementos[i].id_grupo;
				document.getElementById("ee_id_tipo").value = elementos[i].id_tipo;
				document.getElementById("ee_x").value = elementos[i].x;
				document.getElementById("ee_y").value = elementos[i].y;
				document.getElementById("ee_xx").value = elementos[i].xx;
				document.getElementById("ee_yy").value = elementos[i].yy;
				document.getElementById("ee_id_colorin").value = elementos[i].id_colorin;
				document.getElementById("ee_id_colorout").value = elementos[i].id_colorout;
				document.getElementById("ee_dimension").value = elementos[i].dimension;
				document.getElementById("ee_nombre").value = elementos[i].nombre;
				document.getElementById("ee_variable").value = elementos[i].variable;
			}
		}
		
		modal_ee.style.display = "block";	
		modal_ec.style.display = "none";
		modal_gc.style.display = "none";
		modal_ge.style.display = "none";

		span_e.onclick = function() {
			elegido.selectedIndex = 0;
			modal_ee.style.display = "none";
		}
		
		// When the user clicks anywhere outside of the modal, close it
/*		window.onclick = function(event) {
		  if (event.target == modal_e) {
			modal_e.style.display = "none";
		  }		  
		}
*/
	}
//	  }, false);

/*--------------------------+
 |		Crea elemento		|
 +--------------------------*/
/*	document.getElementById("crea_elemento")
	  .addEventListener("click", function() {
*/
	function CreaElemento(){	
		// Get the modal
		var modal_ee = document.getElementById("modal_e_edit");
		var modal_ec = document.getElementById("modal_e_crear");
		var modal_ge = document.getElementById("modal_g_edit");
		var modal_gc = document.getElementById("modal_g_crear");
		
		// Get the button that opens the modal
		// var btn = document.getElementById("crea_elemento");
			
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[1];
				
		// When the user clicks the button, open the modal 
//		btn.onclick = function() {
			  modal_ee.style.display = "none";
			  modal_gc.style.display = "none";
			  modal_ge.style.display = "none";
			  modal_ec.style.display = "block";
//		}
		
		document.getElementById("ec_id_tipo").focus();
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal_ec.style.display = "none";
		}
		
	}
	  //, false);
	
/*--------------------------+
 |		 Crea grupo 		|
 +--------------------------*/	
/*	document.getElementById("crea_grupo")
		.addEventListener("click", function() {
*/
	function CreaGrupo(){	
		
		var modal_ee = document.getElementById("modal_e_edit");
		var modal_ec = document.getElementById("modal_e_crear");
		var modal_ge = document.getElementById("modal_g_edit");
		var modal_gc = document.getElementById("modal_g_crear");

		var span_gc = document.getElementsByClassName("close")[3];
		// Get the button that opens the modal
//		var btn = document.getElementById("crea_grupo");
								
		// When the user clicks the button, open the modal 
//		btn.onclick = function() {
			  modal_ec.style.display = "none";
			  modal_ee.style.display = "none";
			  modal_ge.style.display = "none";
			  modal_gc.style.display = "block";
//		}
		
		// When the user clicks on <span> (x), close the modal
		span_gc.onclick = function() {
		  modal_gc.style.display = "none";
		}

	}
	//, false);
/*--------------------------+
 |		Edita grupo 		|
 +--------------------------*/	
/*	document.getElementById("sel_id_grupo")
		.addEventListener("change", function() {
	document.forms["frm_editaMarco"]["sel_id_grupo"]
*/
/*	document.getElementById("sel_id_grupo")
		.addEventListener("change", function() {
*/
	function GetGrupo(){ 
		var modal_ee = document.getElementById("modal_e_edit");
		var modal_ec = document.getElementById("modal_e_crear");
//		var modal_ge = document.getElementById("modal_g_edit");
//		var mg_id_grupo = document.forms["form_eg"]["mg_id_grupo"];
		var modal_gc = document.getElementById("modal_g_crear");

		var span_eg = document.getElementsByClassName("close")[2];

		var arr_elementos = <?php echo json_encode($PS); ?>;
		
//		console.log("muestra el modal Edit Grupo!!");		
				
		var grupos = document.getElementById("sel_id_grupo");
		var grupo_sel = grupos.options[grupos.selectedIndex].value;
		var sel_elementos = document.getElementById("sel_id_elemento");
		
		//limpia la lista de elementos
		sel_elementos.innerHTML = '<option value="">...</option>'
		
		if(sel_elementos !== ""){
			for (var i in arr_elementos){
				if (arr_elementos[i].id_grupo==grupo_sel){
					var opcion = document.createElement('option');
					opcion.value = arr_elementos[i].id_elemento;
					opcion.text = arr_elementos[i].nombre;
					sel_elementos.add(opcion);

					document.form_eg.mg_id_grupo.value= arr_elementos[i].id_grupo;
/*					document.getElementById("mg_grupo").value = arr_elementos[i].grupo;
					document.getElementById("mg_x").value = arr_elementos[i].gx;
					document.getElementById("mg_y").value = arr_elementos[i].gy;
*/				}
			}
		}
		
		modal_ge.style.display = "block";	
		modal_gc.style.display = "none"; 
		modal_ee.style.display = "none"; 
		modal_ec.style.display = "none";
		
//		document.getElementById("mg_EoG").value = "G";			  
		
		span_eg.onclick = function() {
		  elegido.selectedIndex = 0;
		  modal_eg.style.display = "none";
		}
	}
	
 </script>