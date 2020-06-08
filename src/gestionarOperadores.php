<?php
    include("_header.html");
    include("_navbar.html");
    include_once("util.php");
if(checkPriv("editar-faq") && checkPriv("editar-info-contacto")):
?>
    <div class="uk-container uk-margin uk-align-center">
    <h1 class="uk-text-center uk-margin-top">Gestionar operadores</h1>
    <hr class="uk-divider-icon">
        <h3 class="">Introduce el correo de la cuenta que quieres hacer operador.</h3>
        <p class="uk-text-meta">El usuario debe verificar su correo para poder convertirse en operador. El administrador no puede ser degradado a operador</p>
        <form class="uk-form " action="controlador_agregar_operador.php" method="post">

                 <input class="uk-input uk-border-rounded uk-width-medium" placeholder="jperez@ejemplo.com" type="email" id="email-operador" name="email-operador">
                <button class="uk-button uk-button-primary uk-border-rounded uk-width-auto" id="agregar-operador" type="submit">
                Agregar</button>
        </form>
        <?= muestraOperadores(); ?>
    </div>






<?php
    http_response_code(200);
else:
    http_response_code(404);
    header("location:error");
endif;
include("_footer.html")
?>
