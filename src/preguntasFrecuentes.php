<?php
    include("_header.html");
    include("_navbar.html");
    include("util.php");
?>
<div  id="modal-editar-preguntas" class="uk-modal-container" uk-modal>
</div>
<div class = "uk-container uk-margin  ">
    <div class="uk-container  " >
        <h1 class="uk-align-left uk-margin-remove-bottom">Preguntas Frecuentes </h1>
        
        
            <button class="uk-button uk-button-primary uk-border-rounded uk-align-right" type="button" id="editar-preguntas" ><span uk-icon="icon:pencil"></span> Editar Preguntas</button>     
        
        
        
    </div>
  <hr>
    
  <ul uk-accordion="multiple: true" id="lista-preguntas">
        
  </ul>
    
</div>

<?php include("_footer.html"); ?>
<script>
mostrarPreguntas(); 
</script>