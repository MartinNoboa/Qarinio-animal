<?php
    include_once ("util.php");
    include("_header.html");
    include("_navbar.html");
    print_r($_POST);

    if(!isset($_POST["email"]) || $_POST["email"]==""){
        $_SESSION["error"] = "Por favor ingresa un correo";
    } else if(cuentaExistente($_POST["email"])) {
        $_SESSION["error"] = "El usuario ya existe";
    } else{
        $_SESSION["error"] = false;
    }
?>

<div class = "uk-container">
  <form method="post" action="crearCuenta.php">
    <legend class="uk-legend">Crear Cuenta</legend>
      <div class="uk-margin">
          <label class="uk-form-label">Nombre: </label>
          <input class="uk-input" type="text" name="nombre" placeholder="Nombre" <?= isset($_POST["nombre"])?"value='{$_POST['nombre']}'":"" ?>>
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Apellido(s):</label>
          <input class="uk-input" type="text" name="apellido" placeholder="Apellido(s)"  <?= isset($_POST["apellido"])?"value='{$_POST['apellido']}'":"" ?>>
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Email:</label>
          <input class="uk-input" type="email" name="email" placeholder="Correo"  <?= isset($_POST["email"])?"value='{$_POST['email']}'":"" ?> <?= (isset($_POST["email"])AND!$_SESSION["error"])?"disabled":"" ?>>
      </div>

    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
    <!-- Solo mostrar esto si el email NO está en uso -->
    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
      <?php if(!$_SESSION["error"]): ?>
      <div class="uk-margin">
          <label class="uk-form-label">Teléfono:</label>
          <input class="uk-input" type="tel" name="telefono" placeholder="123 456 7890">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Calle Principal:</label>
          <input class="uk-input" type="text" name="callePrincipal" placeholder="Calle 1">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Calle Secundaria:</label>
          <input class="uk-input" type="text" name="calleSecundaria" placeholder="Calle 2">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Número Exterior:</label>
          <input class="uk-input" type="number" name="numeroExterior" placeholder="123">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Número Interior:</label>
          <input class="uk-input" type="number" name="numeroInterior" placeholder="42">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Código Postal:</label>
          <input class="uk-input" type="text" name="cp" placeholder="11560">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Colonia:</label>
          <input class="uk-input" type="text" name="colonia" placeholder="Colonia">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Ciudad:</label>
          <input class="uk-input" type="text" name="ciudad" placeholder="Querétaro">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Estado:</label>
          <input class="uk-input" type="text" name="estado" placeholder="Estado">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Fecha de Nacimiento:</label>
          <input class="uk-input" type="date" name="fechaNacimiento" placeholder="Frcha de Nacimiento">
      </div>
      <?php elseif(isset($_POST["email"])): ?>
      <h3 class="uk-alert-danger">Error: <?= $_SESSION["error"] ?> </h3>
      <?php endif; ?>
      <div class="uk-margin">
          <input class="uk-input" type="submit" name="submit" value="Regresar">
          <input class="uk-input" type="submit" name="submit" value="Continuar">
      </div>


  </form>
</div>




<?php
  include("_footer.html");
?>