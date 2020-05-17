<?php
    include("_header.html");
    include("_navbar.html");
    include("util.php");
?>
<div  id="modal-editar-preguntas" class="uk-modal-container" uk-modal>
</div>
<div class = "uk-container">
  <h2>Preguntas Frecuentes <a  uk-tooltip = 'Editar Preguntas' class='uk-icon-link uk-align-right' uk-icon='pencil'; ratio ='2' id="editar-preguntas">Editar preguntas</a></h2>
    
    
    
  <div class = "uk-divider"></div>
    
  <ul uk-accordion="multiple: true" id="lista-preguntas">
        
  </ul>
    
</div>

<?php include("_footer.html"); ?>
