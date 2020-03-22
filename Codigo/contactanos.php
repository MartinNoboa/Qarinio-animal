<?php 
    include("_header.html");
    include("_navbar.html");
?>

<div class="container">
    <h2 class="center-align">¿Tienes una duda? ¡Contáctanos!</h2>
    <div class="row">
        <form class="s12" action="<?php echo htmlspecialchars('procesaFormContacto.php'); ?>" method="post">
            <div class="input-field col s6">
                <input id="first_name" type="text" class="validate">
                <label for="first_name">Nombre</label>
            </div>
            <div class="input-field col s6">
                <input id="last_name" type="text" class="validate">
                <label for="last_name">Apellido</label>
            </div>
             <div class="input-field col s12">
                <input id="email" type="email" class="validate">
                <label for="email">Correo Electrónico</label>
            </div>
            <div class="input-field col s12">
                <textarea id="mensaje" class="materialize-textarea" data-length="256"></textarea>
                <label for="mensaje">Escribe tu mensaje aquí</label>
            </div>
            <div class="col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php include("_footer.html"); ?>

<script>
  $(document).ready(function() {
    $('textarea#mensaje').characterCounter();
  });
</script>

