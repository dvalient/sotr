
<div class="flex-container">
	<!--<button id="btn_switch"> E / G </button>  -->
    
<!--    <form id="editpantalla" action="./?controller=pantalla&&action=editaPantalla" method="POST">
      <section>
-->
        <div id="elementos">
                        
            <input type="hidden" name="id_pantalla" id="id_pantalla" value="<?php echo $E["id_pantalla"]; ?>">
            
            <label>o Grupo: </label>
            <?php
               $grp = sotr\Grupo::all();
               echo '<select name="sel_id_grupo" id="sel_id_grupo" onChange=GetGrupo()>';
               echo '<option value="0"> ... </option>';  
               foreach($grp as $g){
                //	$selected=($g->getId() == $elemnto->id_grupo) ? "selected" : "";                        
                    echo '<option value="'.$g->getid().'">'.$g->grupo.'</option>';
               }
               echo '</select>';
            ?>
			
			<button name="crea_grupo" id="crea_grupo">+ Grupo </button>

            <label>Seleccionar Elemento: </label>
            <select name="sel_id_elemento" id="sel_id_elemento" style="width: 10em" onChange=GetElemento()>
            	<option '.$e_sel.' value="0">... </option>
            </select>

<!--            <?php                    
                echo '<select name="sel_id_elemento" id="sel_id_elemento" style="width: 10em" onChange=GetElemento() >'; //onChange=GetElemento() 
                echo '<option '.$e_sel.' value="0">... </option>';  
                foreach($PS as $E){
	                    echo '<option value="'.$E["id_elemento"].'">'.$E["leyenda"].'</option>';
                }  
                echo '</select>';
            ?>	-->
            
            <button name="crea_elemento" id="crea_elemento">+ Elemento</button>
						
        </div>
<!--
	  </section>
    </form>
-->
</div>

<!------------------------------+
 |	Editar Elemento Modal 		|
 +------------------------------>
<div class="modal" id="modal_e_edit">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="editpantalla" action="./?controller=pantalla&&action=editaPantalla" method="POST" >
		
        <input type="hidden" name="id_elemento" id="id_elemento">
        <input type="hidden" name="id_tipo" id="id_tipo">

		<h4> Editar Elemento </h4>
        <section>
        <input type="hidden" name="id_pantalla" id="id_pantalla" value="<?php echo $E["id_pantalla"]; ?>">
          <div  class="div-bott25">
            <label for="leyenda">Var./Desc.:</label>
            <input type="text" id="leyenda" name="leyenda" style="width: 8em">		
          </div>
        
          <div class="div-bott25">
            <label>Grupo: </label>
            <?php
               $grp = sotr\Grupo::all();
               echo '<select name="id_grupo" id="id_grupo">';
               echo '<option value="0">... </option>';  
               foreach($grp as $g){
//                    $selected=($g->getId() == $elemnto->id_grupo) ? "selected" : "";                        
                    echo '<option '.$selected.' value="'.$g->getid().'">'.$g->grupo.'</option>';
               }
               echo '</select>';
            ?>
          </div>
                    
        </section>
            
        <section>			
		  <div  class="div-bott25">
            <label for="x">Desde x: </label>
            <input type="number" name="x" id="x" step="1" style="width: 3em; text-align: right">
            <label for="y">y: </label>
            <input type="number" name="y" id="y" step="1" style="width: 3em; text-align: right">
    	  </div>
          <div  class="div-bott25">
            <label for="xx">Hasta x: </label>
            <input type="number" name="xx" id="xx" step="1" style="width: 3em; text-align: right">
            <label for="yy">y: </label>
            <input type="number" name="yy" id="yy" step="1" style="width: 3em; text-align: right">
          </div>
        </section>
        
        <section> 
		  <div  class="div-bott25">
            <label for="colorE">color in: </label>
            <?php
               $colores = sotr\Color::all();
               echo '<select name="id_colorin" id="id_colorin">';
               echo '<option '.$g_sel.' value="0">... </option>';  
               foreach($colores as $c){
                    $selected=($c->getId() == $elemnto->id_colorin) ? "selected" : "";                        
                    echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
               }
               echo '</select>';
            ?>
          </div>
          <div  class="div-bott25">
            <label for="colorS">color out: </label>
            <?php
    //               $colores = sotr\Color::all();
               echo '<select name="id_colorout" id="id_colorout">';
               echo '<option '.$g_sel.' value="0">... </option>';  
               foreach($colores as $c){
                    $selected=($c->getId() == $elemnto->id_colorout) ? "selected" : "";                        
                    echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
               }
               echo '</select>';
            ?>
          </div>
        </section>
        <section>
          <div  class="div-bott25">
            <label for="dimension">font/dimensión: </label>
            <input type="number" name="dimension" id="dimension" step="1" style="width: 3em; text-align: right" min="1" max="5">
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
        <form id="editpantalla" action="./?controller=pantalla&&action=editaPantalla" method="POST" >

            <input type="hidden" name="EoG" id="EoG" value="E">

            <h4> Crear Elemento </h4>
				
              <div class="div-bott25">
                <label for="m_tipo">Tipo: </label>
                <select name="ec_id_tipo" id="ec_id_tipo">
                    <option value="0">... </option>
                    <?php
                       $Tipos = sotr\Tipo::all();
                       foreach($Tipos as $t){
        //                    $selected=($t->getId() == $elemnto->id_colorin) ? "selected" : "";                        
                            echo '<option value="'.$t->getid().'">'.$t->tipo.'</option>';
                       }
                    ?>
              </select>
              </div>
				
              <div class="div-bott25">
              	<label>Grupo: </label>
                <select name="ec_id_grupo" id="ec_id_grupo">
                    <option value="0">... </option>
                    <?php
                       $grp = sotr\Grupo::all();
                       foreach($grp as $g){
     //                    $selected=($g->getId() == $elemnto->id_grupo) ? "selected" : "";                        
                            echo '<option value="'.$g->getid().'">'.$g->grupo.'</option>';
                       }
                    ?>
                </select>
              </div>
				
              <div class="div-bott25">
                <label for="m_leyenda">Desc./Ley.:</label>
                <input type="text" id="ec_leyenda" name="ec_leyenda">
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
                   echo '<option '.$g_sel.' value="0">... </option>';  
                   foreach($colores as $c){
                        $selected=($c->getId() == $elemnto->id_colorin) ? "selected" : "";                        
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
                   echo '<option '.$g_sel.' value="0">... </option>';  
                   foreach($colores as $c){
                        $selected=($c->getId() == $elemnto->id_colorout) ? "selected" : "";                        
                        echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
                   }
                   echo '</select>';
                ?>
            </div>
            
            <div class="div-bott25">
                <label for="ec_variable">Variable:</label>
                <input type="text" id="ec_variable" name="ec_variable">
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
        <form id="editpantalla" action="./?controller=pantalla&&action=editaPantalla" method="POST" >
			
            <input type="hidden" name="gid_pantalla" id="gid_pantalla" value="<?php echo $E["id_pantalla"]; ?>">
            <input type="hidden" name="mg_id_grupo" id="mg_id_grupo" >
		  <h4> Editar Grupo</h4>			
          <div   class="div-bott25">
            <label for="m_grupo">Grupo:</label>
            <input type="text" id="mg_grupo" name="mg_grupo">
          </div>
          <div class="div-bott25">
            <label for="g_x"> x: </label>
            <input type="number" name="mg_x" id="mg_x" step="1" style="width: 4em; text-align: right">
          </div>
          <div class="div-bott25">
            <label for="g_y"> y: </label>
            <input type="number" name="mg_y" id="mg_y" step="1" style="width: 4em; text-align: right">
          </div>
          <div class="div-bott25">
            <button type="submit" name="grupo_editar" id="grupo_editar">Actualizar</button>	
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
        <form id="editpantalla" action="./?controller=pantalla&&action=editaPantalla" method="POST" >


            <input type="hidden" name="gc_id_pantalla" id="gc_id_pantalla" value="<?php echo $E["id_pantalla"]; ?>">

            <h4> Crear Nuevo Grupo </h4>
			<div  class="div-bott25">
                <label for="gc_grupo">Grupo:</label>
                <input type="text" id="gc_grupo" name="gc_grupo">
			</div>
            <div  class="div-bott25">
                <label for="gc_x"> x: </label>
                <input type="number" name="gc_x" id="gc_x" step="1" style="width: 4em; text-align: right">
            </div>
            <div  class="div-bott25">
                <label for="gc_y"> y: </label>
                <input type="number" name="gc_y" id="gc_y" step="1" style="width: 4em; text-align: right">
            </div>
            <div   class="div-bott25">  	
		    	<button type="submit" name="grupo_crear" id="grupo_crear">Crear</button>
            </div>
		</form>
      </div>
    </div>
<!------------------------------+
 |			Fin  Modal 			|
 +------------------------------>
    
<div id="dibujo">
    
    <?php file_put_contents('Views/Pantalla/pantalla.json', json_encode($PS)); ?>
    <img src="Views/Pantalla/drawer.php"> 
    
</div>

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
				document.getElementById("id_elemento").value = elementos[i].id_elemento;
				document.getElementById("id_grupo").value = elementos[i].id_grupo;
				document.getElementById("id_tipo").value = elementos[i].id_tipo;
				document.getElementById("x").value = elementos[i].x;
				document.getElementById("y").value = elementos[i].y;
				document.getElementById("xx").value = elementos[i].xx;
				document.getElementById("yy").value = elementos[i].yy;
				document.getElementById("id_colorin").value = elementos[i].id_colorin;
				document.getElementById("id_colorout").value = elementos[i].id_colorout;
				document.getElementById("dimension").value = elementos[i].dimension;
				document.getElementById("leyenda").value = elementos[i].leyenda;
			}
		}
		
		modal_ee.style.display = "block";	
		modal_ec.style.display = "none";
		modal_gc.style.display = "none";
		modal_ge.style.display = "none";

		document.getElementById("EoG").value = "E";			  

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
	document.getElementById("crea_elemento")
	  .addEventListener("click", function() {
		
		// Get the modal
		var modal_ee = document.getElementById("modal_e_edit");
		var modal_ec = document.getElementById("modal_e_crear");
		var modal_ge = document.getElementById("modal_g_edit");
		var modal_gc = document.getElementById("modal_g_crear");
		
		// Get the button that opens the modal
		var btn = document.getElementById("crea_elemento");
			
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[1];
				
		// When the user clicks the button, open the modal 
		btn.onclick = function() {
			  modal_ec.style.display = "block";
			  modal_ee.style.display = "none";
			  modal_gc.style.display = "none";
			  modal_ge.style.display = "none";
		}
		
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal_ec.style.display = "none";
		}
		
	  }, false);

/*--------------------------+
 |		Edita grupo 		|
 +--------------------------*/	
	function GetGrupo(){
		var modal_ee = document.getElementById("modal_e_edit");
		var modal_ec = document.getElementById("modal_e_crear");
		var modal_ge = document.getElementById("modal_g_edit");
		var modal_gc = document.getElementById("modal_g_crear");

		var span_eg = document.getElementsByClassName("close")[2];

		var elementos = <?php echo json_encode($PS); ?>;
		
		console.log("muestra el modal Edit Grupo!!");		
				
		var grupos = document.getElementById("sel_id_grupo");
		var grupo_sel = grupos.options[elegido.selectedIndex].value;
		
		var elementos = document.getElementById("sel_id_elemento");
		
		elementos.innerHTML = '<option value="">Seleccione un Pueblo...</option>'

		
		
		for (var i in elementos){
			if (elementos[i].id_grupo==grupo_sel){
				document.getElementById("mg_id_grupo").value = elementos[i].id_grupo;
				document.getElementById("mg_grupo").value = elementos[i].grupo;
				document.getElementById("mg_x").value = elementos[i].gx;
				document.getElementById("mg_y").value = elementos[i].gy;
			}
		}
		
		modal_ge.style.display = "block";	
		modal_gc.style.display = "none"; 
		modal_ee.style.display = "none"; 
		modal_ec.style.display = "none";
		
		document.getElementById("mg_EoG").value = "G";			  
		
		span_eg.onclick = function() {
		  elegido.selectedIndex = 0;
		  modal_eg.style.display = "none";
		}
	}
	
/*--------------------------+
 |		 Crea grupo 		|
 +--------------------------*/	
	document.getElementById("crea_grupo")
		.addEventListener("click", function() {
			
		var modal_ee = document.getElementById("modal_e_edit");
		var modal_ec = document.getElementById("modal_e_crear");
		var modal_ge = document.getElementById("modal_g_edit");
		var modal_gc = document.getElementById("modal_g_crear");

		var span_gc = document.getElementsByClassName("close")[3];
		// Get the button that opens the modal
		var btn = document.getElementById("crea_grupo");
								
		// When the user clicks the button, open the modal 
		btn.onclick = function() {
			  modal_ec.style.display = "none";
			  modal_ee.style.display = "none";
			  modal_ge.style.display = "none";
			  modal_gc.style.display = "block";
		}
		
		// When the user clicks on <span> (x), close the modal
		span_gc.onclick = function() {
		  modal_gc.style.display = "none";
		}

	}, false);
		
</script>