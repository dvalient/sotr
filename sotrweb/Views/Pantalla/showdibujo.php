<div class="container-fluid"> 
    <div id="dibujo" class="dibujo">
		
		<?php file_put_contents('Views/Pantalla/pantalla.json', json_encode($PS)); ?>
        
		<a href="./?controller=pantalla&&action=show"><img src="Views/Pantalla/drawer.php" alt="volver"></a>
        
    </div>
</div>

