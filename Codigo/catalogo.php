<?php 
    include("_header.html");
    include("_navbar.html");
?>

<div class="uk-container">
    <div class="uk-card">
        <ul uk-accordion="multiple: true">
            <li class="uk-open">
                <a class="uk-accordion-title" href="#">Filtros</a>
                <div class="uk-accordion-content">
                    <input class="uk-range" type="range" value="2" min="0" max="10" step="0.1">
                </div>
            </li>
        </ul>
    </div>
<h2>Nuestros Perros</h2>
    <div class="uk-child-width-1-3@m" id="contenido-catalogo" uk-grid>
    <?php
        include("controlador_catalogo.php");
    ?>
    </div>
</div>



<?php include("_footer.html"); ?>
