
<p><img src="img/CCATransparente.png" alt="Cca s.a." width="170" height="44"  align="right"> </p>

<h2>Pantallas SOTR WEB </h2>

<div class="row">
  <div class="columnI">
	<table class="show">
        <thead>
                <tr>
                    <th>Pantalla</th>
                    <th>Ancho</th>
                    <th>Alto</th>
                    <th>Background</th>
                    <th>Acciónes </th>
					<th>Eliminar </th>
                </tr>
        </thead>
    
        <tbody>
            <?php 
                foreach($listaPantalla as $p){ ?>
                <tr>
                    <td> <a href="./?controller=pantalla&&action=armapantalla&&id_pantalla=<?php echo $p->getId(); ?>"> <?php echo $p->pantalla ; ?></a></td>
                    <td><?php echo $p->w; ?></td> 
                    <td><?php echo $p->h; ?></td> 
                    <td><?php echo (sotr\Color::SearchById($p->background))->color; ?> </td> 
					<td>
                    	<!-- Ver  -->
                        <a href="./?controller=pantalla&&action=armaPantalla&&id_pantalla=<?php echo $p->getId(); ?>"><img src="img/visibility-24px.svg" alt="ver"></a>

                       	<!-- Editar -->
                        <a href="./?controller=pantalla&&action=dibujaPantalla&&id_pantalla=<?php echo $p->getId(); ?>"><img src="img/edit-24px.svg" alt="ver"></a>
                    </td>
                    <td>
                        <a href="./?controller=pantalla&&action=delete&&id=<?php echo $p->getId(); ?>"> <img src="img/delete-24px.svg" alt= "eliminar"></a>
                    </td>
                </tr>
          <?php } ?>    
        </tbody>
    </table>
  </div>
  <div class="columnD">
      <div class="row">
        <span style="color: black;"> <img src="img/add_box-24px.svg" alt="Nuevo" onClick="creaMarco()"> Nueva Pantalla </span>
      </div>

      <div class="row">
		<div class="modal" id="nuevo_marco"> 
        	<span class="close">&times;</span>
<!--        	<span class="close" style="padding-right:20px">&times;</span>        	-->
            <form id="editpantalla" action="./?controller=pantalla&&action=crearMarco" method="POST" >
                
                <input type="hidden" name="me_id_pantalla" id="me_id_pantalla">
              	<h4> Editar Marco</h4>			
                <div class="div-bott25">
                    <label for="me_pantalla">Nombre:</label>
                    <input type="text" id="me_pantalla" name="me_pantalla" style="width: 12em" placeholder="nombre de pantalla ...">
                </div>
                <div class="div-bott25">
                    <label for="me_w"> Ancho: </label>
                    <input type="number" name="me_w" id="me_w" step="1" style="width: 5em; text-align: right">
                </div>
                <div class="div-bott25">
                    <label for="me_h"> Alto: </label>
                    <input type="number" name="me_h" id="me_h" step="1" style="width: 4em; text-align: right">
                </div>
                <div class="div-bott25">   
                    <label for="me_id_color">color In: </label>
                    <?php
                       $colores = sotr\Color::all();
                       echo '<select name="me_background" id="me_background">';
                       echo '<option value="0">... </option>';  
                       foreach($colores as $c){
                            echo '<option value="'.$c->getid().'">'.$c->color.'</option>';
                       }
                       echo '</select>';
                    ?>
                </div>
                <div class="div-bott25">
                    <button type="submit" name="marco_crear" id="marco_crear" style="float:right">Crear</button>	
                </div>
            </form>      	
        </div>
  	</div>
  </div>
</div>
<!------------------------------>

<script>
/*
	function editaMarco(id, nombre, ancho, alto, color){
		document.getElementById("me_id_pantalla").value = id;
		document.getElementById("me_pantalla").value = nombre;
		document.getElementById("me_w").value = ancho;
		document.getElementById("me_h").value = alto;
		document.getElementById("me_background").value = color;
		
		var ventana = document.getElementById("nuevo_marco");
		var span = document.getElementsByClassName("close")[0];
		var btn_actualiza = document.getElementById("edita_marco");
		var btn_crear = document.getElementById("marco_crear");
		
		btn_crear.style.visibility = "hidden";
		btn_actualiza.style.visibility = "visible";
		
		ventana.style.display = "block";
		
		//document.getElementById("ed_pantalla").focus();

		span.onclick = function() {
		  ventana.style.display = "none";
		}
	}
*/
		
	var span = document.getElementsByClassName("close")[0];
	var ventana = document.getElementById("nuevo_marco");
	span.onclick = function() {
		ventana.style.display = "none";
	}

	function creaMarco() {
		// alert(id + ", " + nombre);
		document.getElementById("me_id_pantalla").value = 0;
		document.getElementById("me_pantalla").value = "";
		document.getElementById("me_w").value = 1024;
		document.getElementById("me_h").value = 768;

		var btn_actualiza = document.getElementById("edita_marco");
		var btn_crear = document.getElementById("marco_crear");

		ventana.style.display = "block";
		
	}
</script>