<?php
    include("_header.html");
    include("_navbar.html");
    include_once("util.php");
?>

<div  id="modal-editar-preguntas" class="uk-modal-container" uk-modal>
</div>
<div class = "uk-container uk-margin  ">
    <div class="uk-container  " >
        <h1 class="uk-align-left uk-margin-remove-bottom">Preguntas Frecuentes </h1>
        
            <?php
                if(checkPriv("editar-faq")){
                    echo "<button class='uk-button uk-button-primary uk-border-rounded uk-align-right' type='button' id='editar-preguntas' ><span uk-icon='icon:pencil'></span> Editar Preguntas</button> ";
                }
            ?>
                
            
    </div>
  <hr>
    
  <ul uk-accordion="multiple: true" id="lista-preguntas">
        
  </ul>
    
</div>

<?php include("_footer.html"); ?>
<script>
mostrarPreguntas(); 
document.getElementById("editar-preguntas").onclick=editarPreguntas;

window.history.forward(1);
</script>