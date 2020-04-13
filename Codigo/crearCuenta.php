<?php
    include_once ("util.php");
    include("_header.html");
    include("_navbar.html");

    if(isset($_POST["email"]) && !cuentaExistente($_POST["email"])){
        $_SESSION["existingAccount"] = false;
    } else{
        $_SESSION["existingAccount"] = true;
    }
?>

<div class = "uk-container">
  <form method="post" action="crearCuenta.php">
    <legend class="uk-legend">Crear Cuenta</legend>
      <div class="uk-margin">
          <input class="uk-input" type="text" id="nombre" name="nombre" placeholder="Nombre">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="text" name="apellido" placeholder="Apellido">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="email" name="email" placeholder="Correo">
      </div>

    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
    <!-- Solo mostrar esto si el email no está en uso -->
    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
      <?php if(!$_SESSION["existingAccount"]): ?>
      <div class="uk-margin">
          <input class="uk-input" type="tel" name="telefono" placeholder="Teléfono">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="text" name="callePrincipal" placeholder="Calle Principal">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="text" name="calleSecundaria" placeholder="Calle Secundaria">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="number" name="numeroExterior" placeholder="Número Exterior">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="number" name="numeroInterior" placeholder="Número Interior">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="text" name="cp" placeholder="Código Postal">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="text" name="colonia" placeholder="Colonia">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="text" name="ciudad" placeholder="Ciudad">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="text" name="estado" placeholder="Estado">
      </div>
      <div class="uk-margin">
          <input class="uk-input" type="date" name="fechaNacimiento" placeholder="Frcha de Nacimiento">
      </div>
      <?php endif; ?>
      <div class="uk-margin">
          <input class="uk-input" type="submit" name="submit" value="Continuar">
      </div>


  </form>
</div>




<?php
  include("_footer.html");
?>