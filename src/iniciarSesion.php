<?php
    include_once("util.php");
    include("_header.html");

    if(isset($_POST["email"], $_POST["pass"])){
            $_POST["email"] = limpia_entrada($_POST["email"]);
            $_POST["pass"] = limpia_entrada($_POST["pass"]);
            if(autenticar($_POST["email"], $_POST["pass"])){
                $_SESSION["error"] = null;
                $_SESSION["mensaje"] = "Bienvenid@ {$_SESSION['nombre']}";

                header("location:/");
            } else{
            $_SESSION["error"] = "Correo o contraseña incorrectos";
        }
    }
    include("_navbar.html");
?>
<div id="modal-cambiar-c" class="uk-modal" uk-modal></div>
<br>
<div class="uk-container uk-align-center uk-width-large">
  <form method="post" action="iniciarSesion.php">
    <legend class="uk-legend uk-text-center">Iniciar Sesión</legend>
    <div class="uk-margin">
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input uk-border-rounded" type="text" name="email">
        </div>
    </div>

      <div class="uk-margin">
          <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon" uk-icon="icon: lock"></span>
              <input class="uk-input uk-border-rounded" type="password" name="pass">
          </div>
      </div>

      <div class="uk-margin uk-align-center uk-width-medium uk-text-center">
          <input class="uk-input uk-button-primary uk-border-pill" type="submit" name="submit" value="Iniciar Sesión">
          <a class="uk-button uk-button-text uk-text-meta uk-margin" id="olv-contr">Olvidé Mi contraseña</a>
      </div>
  </form>

</div>

<?php
  include("_footer.html");
?>
<script>
    document.getElementById("olv-contr").onclick = mostrarCambiarC;
</script>
