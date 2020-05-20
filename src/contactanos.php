<?php
    include("_header.html");
    include("_navbar.html");
?>

<div class="uk-container uk-margin">
    <h1 class="uk-text-center uk-animation-slide-bottom-medium">¿Tienes una duda? ¡Contáctanos!</h1>
    <hr class="uk-divider-icon">
      <form class="uk-form uk-animation-fade" action="controlador_contactanos.php" method="post">
          <div class="uk-margin">
              <label for="first_name">Nombre</label>
              <input name="nombre" id="first_name" type="text" class="uk-input uk-border-rounded" placeholder="José">
          </div>
          <div class="uk-margin">
              <label for="last_name">Apellido</label>
              <input name="apellido" id="last_name" type="text" class="uk-input uk-border-rounded" placeholder="Pérez">
          </div>
            <div class="uk-margin">
              <label for="email">Correo Electrónico</label>
              <input name="email" id="email" type="email" class="uk-input uk-border-rounded" placeholder="jperez@ejemplo.com">
          </div>
          <div class="uk-margin">
              <label for="mensaje">Escribe tu mensaje aquí</label>
              <textarea name = "mensaje" id="mensaje" class="uk-textarea uk-border-rounded" data-length="256"></textarea>
          </div>
          <div class="uk-margin">
              <button class="uk-button uk-button-primary uk-border-rounded" type="submit" name="action">Enviar</button>
          </div>
      </form>
</div>

<?php
    include("_footer.html");
?>
