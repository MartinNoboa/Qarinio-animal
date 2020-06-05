<?php
include_once('util.php');
include("_header.html");
if(checkPriv("adoptar")):
    include("_navbar.html");
    $idPerro = limpia_entrada($_GET['idPerro']);
    $idUsuario = $_SESSION["id"];
    //echo $idUsuario;
?>
<div class="uk-container uk-margin">
    <h1 class="uk-text-center">Nueva Solicitud de Adopción</h1>
    <hr class="uk-divider-icon">
    <h2 class="uk-text-center">Formulario de Adopción</h2>
    <a href='catalogo.php' uk-tooltip = 'Click para retroceder' class='uk-icon-link uk-align-left' uk-icon='arrow-left'; ratio ='2'></a>
    <div class="uk-margin-xlarge-right uk-margin-xlarge-left">
        <form class="uk-form">
            <?= muestraPreguntasFormulario(); ?>
            <hr>
            <input type = "number" name = "idusuario" id = "idusuario" value = "<?= $idUsuario ?>" hidden readonly>
            <input type = "number" name = "idperro" id = "idperro" value = "<?= $idPerro ?>" hidden readonly>
            <div class="uk-align-right">
                <button id = "enviarFormulario" type="button" name="button" class="uk-button uk-button-primary uk-border-rounded ">Enviar</button>
            </div>
        </form>
    </div>
</div>

    <script>
        //var idPerro = <?php echo $idPerro; ?>;
        var idUsuario = <?php echo $idUsuario; ?>;
        //console.log(idPerro, idUsuario);
        $("#enviarFormulario")[0].onclick = nuevaSolicitud;
    </script>

<?php
    http_response_code(200);
    include("_footer.html");
else:
    $_SESSION["error"]="Por favor inicia sesión para poder adoptar";
    header("location:iniciarSesion");
endif;
?>
