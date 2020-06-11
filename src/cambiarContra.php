<?php
    include_once("util.php");
    include("_header.html");
    include("_navbar.html");
    if(isset($_GET["id"])):
        $uid = limpia_entrada($_GET["id"]);
        $qry= "SELECT uid
                FROM cambio_contrasenia
                WHERE uid='$uid'
                AND NOT usada
                AND timestamp > DATE_SUB(NOW(), INTERVAL 2 HOUR)";
        $noUsada=sqlqry($qry)->num_rows>0;
        if($noUsada):
?>
<br>
<div class="uk-container uk-align-center uk-width-large">
  <form name='change-pass' id="change-pass">
    <legend class="uk-legend uk-text-center">Cambiar Contraseña</legend>
      <div class="uk-margin">
          <label class="uk-form-label">Nueva Contraseña:<label class="uk-form-label uk-text-danger">*</label></label>
          <input class="uk-input" type="password" pattern=".{8,}" name="contrasenia"  id="contrasenia" placeholder="">
      </div>
      <div class="uk-margin">
          <label class="uk-form-label">Verifica Tu contraseña:<label class="uk-form-label uk-text-danger">*</label></label>
          <input class="uk-input" type="password" pattern=".{8,}" name="verifContrasenia" id="verifContrasenia" placeholder="">
      </div>
      <input class="uk-input" type="password" name="uid" id="uid" placeholder="" hidden value="<?= $uid ?>">

      <div class="uk-margin uk-align-center uk-width-medium uk-text-center">
          <input id="terminar" class="uk-input uk-button-primary uk-border-pill" type="button" name="submit" value="Cambiar Contraseña" disabled>
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
<script> window.onload = function(){
    document.getElementById("terminar").onclick = cambiarContra
}
</script>
<?php
        else:
?>
<div class="uk-container uk-align-center uk-width-xlarge uk-text-center">
     <img src="img/errorDog.png" alt="">
    <h3>Este link es invalido o ha expirado, por favor intenta de nuevo</h3>
    <div class="uk-container">
        <a class='boton-info uk-button uk-button-text uk-text-meta' href="/">Inicio</a>
        |
        <a class='boton-info uk-button uk-button-text uk-text-meta' href="catalogo">Nuestros Perros</a>
        |
        <a class='boton-info uk-button uk-button-text uk-text-meta' href="iniciarSesion">Iniciar Sesión</a>
        |
        <a class='boton-info uk-button uk-button-text uk-text-meta' href="cambiarContra">Cambiar mi Contraseña</a>
    </div>
</div>
<?php
        endif;
    else:
        header("location:iniciarSesion");
    endif;
  include("_footer.html");
?>

