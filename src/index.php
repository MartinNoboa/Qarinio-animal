
<?php
    $titulo="";
  include("_header.html");
  include("_navbar.html");
?>
    <div class="uk-height-large uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top" style="background-image: url('img/maybe.jpg');" uk-parallax="bgy: -200" >
        <div class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical uk-height-auto">
            <h1 class="uk-text-bold uk-text-emphasis">Qariño Animal</h1>
            <h3 class="uk-text-bold uk-text-italic">Espacio creado para la expresión de animalistas, ayuda y difusión de adopciones.</h3>
            <form class="uk-form" action="catalogo.php" method="post">
                <button class="uk-button uk-button-primary uk-border-pill uk-box-shadow-large" type="submit" name="button">¡Adoptar un perro ahora!</button>
            </form>
        </div>
    </div>

<script>
UIkit.parallax();
</script>
<?php include("_footer.html");?>
