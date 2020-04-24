<?php
    include_once("util.php");
    include("_header.html");
    include("_navbar.html");

    if(isset($_POST["email"], $_POST["pass"])){
        $_POST["email"] = limpia_entrada($_POST["email"]);
        $_POST["pass"] = limpia_entrada($_POST["pass"]);
        if(autenticar($_POST["email"], $_POST["pass"])){
            $_SESSION["error"] = null;
            $_SESSION["message"] = "Bienvenid@ {$_SESSION['nombre']}";
            header("location:index.php");
        } else{
            $_SESSION["error"] = "Correo o contraseña incorrectos";
        }
    }
?>
<br>
<div class="uk-container ">
  <form method="post" action="iniciarSesion.php">
    <legend class="uk-legend">Iniciar Sesion</legend>
    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="text" name="email">
        </div>
    </div>

      <div class="uk-margin">
          <div class="uk-inline">
              <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
              <input class="uk-input" type="password" name="pass">
          </div>
      </div>

      <div class="uk-margin">
          <div class="uk-inline">
              <input class="uk-input" type="submit" name="submit" value="login">
          </div>
      </div>
  </form>
</div>

<?php
  include("_footer.html");
?>