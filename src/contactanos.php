<?php
    include("_header.html");
    include("_navbar.html");
?>

<div class="uk-container">
    <h1 class="uk-text-center">¿Tienes una duda? ¡Contáctanos!</h1>
    <hr>
      <form action="controlador_contactanos.php" method="post">
          <div class="uk-margin">
              <label for="first_name">Nombre</label>
              <input id="first_name" type="text" class="uk-input" placeholder="José">
          </div>
          <div class="uk-margin">
              <label for="last_name">Apellido</label>
              <input id="last_name" type="text" class="uk-input" placeholder="Pérez">
          </div>
            <div class="uk-margin">
              <label for="email">Correo Electrónico</label>
              <input name = "email" id="email" type="email" class="uk-input" placeholder="jperez@ejemplo.com">
          </div>
          <div class="uk-margin">
              <label for="mensaje">Escribe tu mensaje aquí</label>
              <textarea name = "mensaje" id="mensaje" class="uk-textarea" data-length="256"></textarea>
          </div>
          <div class="uk-margin">
              <button class="uk-button uk-button-primary" type="submit" name="action">Enviar</button>
          </div>
      </form>
</div>

<?php
    include("_footer.html");
?>
