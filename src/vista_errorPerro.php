<?php

    include("_header.html");
    include("_navbar.html");
    include_once("util.php");
    if(checkPriv("registrar")):

?>

<div class = "uk-container uk-align-center uk-width-xlarge">
   <p class = "uk-text-center"> 
       <span class = "uk-text-warning uk-animation-scale-up" uk-icon = "icon: warning ; ratio : 7" ></span>
    </p>
    <h2 class = "uk-text-center uk-margin-remove-top uk-margin-large-bottom uk-animation-scale-up">¡Hubo un error al agregar al perro!</h2>
    
    <div class="uk-child-width-expand@s uk-text-center" uk-grid>
        <div>
            <a class="uk-button uk-button-primary uk-border-pill uk-align-center" href="catalogo.php">Regresar al catálogo</a>
        </div>
        <div>
            <a class="uk-button uk-button-primary uk-border-pill uk-align-center" href="agregarPerro.php">Intentar nuevamente</a>
        </div>
    </div>
    
    
    
</div>


<?php else:
    http_response_code(404);
    header("location:_error.html");
    endif;
    include("_footer.html");
?>
