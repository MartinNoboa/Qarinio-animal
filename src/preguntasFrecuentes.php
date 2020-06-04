<?php
    include("_header.html");
    include("_navbar.html");
    include_once("util.php");
?>
<div class="uk-container uk-margin-top uk-margin-bottom">
    <h1 class="uk-text-center uk-animation-slide-bottom-medium">Preguntas Frecuentes</h1>
    <hr class="uk-divider-icon">

    <ul uk-accordion="multiple: true" id="lista-preguntas">
    </ul>

</div>

<?php include("_footer.html"); ?>
<script>
    mostrarPreguntas();
</script>
