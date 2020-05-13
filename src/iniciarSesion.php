<?php
    include_once("util.php");
    include("_header.html");
    include("_navbar.html");

    if(isset($_POST["email"], $_POST["pass"])){
            $_POST["email"] = limpia_entrada($_POST["email"]);
            $_POST["pass"] = limpia_entrada($_POST["pass"]);
            if(autenticar($_POST["email"], $_POST["pass"])){
                $_SESSION["error"] = null;
                $_SESSION["mensaje"] = "Bienvenid@ {$_SESSION['nombre']}";

                header("location:index.php");
            } else{
            $_SESSION["error"] = "Correo o contraseña incorrectos";
        }
    }
?>
<br>
<div class="uk-container uk-align-center uk-width-large">
  <form method="post" action="iniciarSesion.php">
    <legend class="uk-legend">Iniciar Sesion</legend>
    <div class="uk-margin">
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="text" name="email">
        </div>
    </div>

      <div class="uk-margin">
          <div class="uk-inline uk-width-1-1">
              <span class="uk-form-icon" uk-icon="icon: lock"></span>
              <input class="uk-input" type="password" name="pass">
          </div>
      </div>

      <div class="uk-margin">
          <div class="uk-inline uk-align-right">
              <input class="uk-input uk-button-primary" type="submit" name="submit" value="Iniciar Sesión">
          </div>
      </div>
  </form>
</div>

<?php
  include("_footer.html");
?>
