<div class="container-fluid"> 
    <div id="dibujo" class="dibujo">
		
		<?php file_put_contents('Views/Pantalla/pantalla.json', json_encode($PS)); ?>
        
		<img src="Views/Pantalla/drawer.php"> 

    </div>
<table>
  <tr>
    <td colspan="2">
        <a href="http://www.ccasa.com.ar/">
            <img border="0" alt="General" src="../../img/iconoH.gif" width="33" height="33">
        </a>
    </td>
    <td colspan="2"> 
      <a href="generalindex.php">
          <img border="0" alt="General" src="../../img/iconoG.gif" width="33" height="33">
      </a>
    </td>        
    <td colspan="2">
      <a href="pindex.php">
          <img border="0" alt="Potencias" src="../../img/iconoP.gif" width="33" height="33">
      </a>
    </td>
  </tr>
</table>

</div>

