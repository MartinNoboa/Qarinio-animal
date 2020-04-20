<?php 
    include("_header.html");
    include("_navbar.html");
?>

<div class="uk-container">
    <div class="uk-card">

    </div>
<h2>Nuestros Perros</h2>
    <div class="uk-child-width-1-3@m" id="contenido-catalogo" uk-grid>
    <?php
        include("controlador_catalogo.php");
    ?>
    </div>
</div>



<?php include("_footer.html"); ?>
