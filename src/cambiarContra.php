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
  <form method="post" action="controlador_cambiarContra.php" name='change-pass' id="change-pass">
    <legend class="uk-legend uk-text-center">Iniciar Sesión</legend>
      <div class="uk-margin">
          <label class="uk-form-label">Contraseña:<label class="uk-form-label uk-text-danger">*</label></label>
          <input class="uk-input" type="password" pattern=".{8,}" name="contrasenia"  id="contrasenia" placeholder="">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Verifica Tu contraseña:<label class="uk-form-label uk-text-danger">*</label></label>
          <input class="uk-input" type="password" pattern=".{8,}" name="verifContrasenia" id="verifContrasenia" placeholder="">
      </div>

      <div class="uk-margin uk-align-center uk-width-medium uk-text-center">
          <input id="terminar" class="uk-input uk-button-primary uk-border-pill" type="submit" name="submit" value="Cambiar Contraseña" disabled>
      </div>
  </form>
    <div class = 'uk-container'>
        <h3>La Contraseña debe de contener los siguientes requisitos:</h3>
        <p id='minuscula' name='minuscula' class='uk-text-danger'>Una letra <b>Minuscula</b> </p>
        <p id='mayuscula' name='mayuscula' class='uk-text-danger'>Una letra <b>Mayuscula</b> </p>
        <p id='numero' name='numero' class='uk-text-danger'>Un <b>numero</b></p>
        <p id='caracteres' name='caracteres' class='uk-text-danger'>Minimo de <b>8 caracteres</b></p>
        <p id='coincidir'  name='coincidir' class='uk-text-danger'>Coincidir <b>contraseña con la verificacion</b></p>
    </div>

</div>


<script src="js/validaciones.js"></script>
<script>verifCambContr()</script>
<?php
  include("_footer.html");
?>

