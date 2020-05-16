<?php
    include("_header.html");
    include("_navbar.html");
    include("util.php");
?>
<div class = "uk-container">
  <h2>Preguntas Frecuentes <a href='vista_preguntas.php' uk-tooltip = 'Editar Preguntas' class='uk-icon-link uk-align-right' uk-icon='pencil'; ratio ='2'>Editar preguntas</a></h2>
    
    
    
  <div class = "uk-divider"></div>
    
  <ul uk-accordion="multiple: true" id="lista-preguntas">
        
  </ul>
    
</div>

<?php include("_footer.html"); ?>
