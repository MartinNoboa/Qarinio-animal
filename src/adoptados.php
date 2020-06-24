<?php
    include("_header.html");
include("_navbar.html");
include_once("util.php")
?>


<div class="uk-container uk-margin uk-animation-slide-bottom-medium">
    <h1 class="uk-text-center">Nuestros Perros Adoptados</h1>

    <div class="uk-grid-match uk-child-width-1-2@m uk-padding-remove" uk-grid="parallax: 250">
                <div uk-scrollspy="cls: uk-animation-slide-bottom-medium; repeat:true" class="uk-width-auto">
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title uk-text-center"><i class="fas fa-heart uk-margin-small-left"></i></h3>
                        <p class = "uk-text-center">
                            La asociación se enorgullece del trabajo que realizamos. Por este motivo, hemos dedicado esta
                            sección a todos los amigos caninos que hemos podido ayudar. Aqui estas todos los perros que han pasado por el refugio y afortunadamente, ¡ ya encontraron su hogar para siempre !
                        </p>
                    </div>
                </div>
    </div>
    <hr class="uk-divider-icon">
</div>


<div id="main" class="uk-margin uk-grid-divider uk-margin-small-left uk-margin-small-right" uk-grid>
    <div class="uk-width-expand uk-margin-remove uk-animation-slide-bottom-medium" id="contenido-catalogo" uk-grid>
        <?php
            include("controlador_perros_adoptados.php");
        ?>

    </div>
</div>


