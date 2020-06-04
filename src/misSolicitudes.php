<?php
    include '_header.html';
    include '_navbar.html';
    $idUsuario = $_SESSION["id"];
    if(checkPriv("adoptar")):
?>

<div class="uk-container uk-margin uk-margin-large-bottom">
    <h1 class="uk-text-center">Mis Solicitudes de Adopción</h1>
    <hr class="uk-divider-icon">
    <form class="uk-form uk-align-right" action="catalogo.php" method="post">
        <button class="uk-button uk-button-primary uk-border-rounded" type="submit" name="button">Adoptar un perro</button>
    </form>
    <h5 class="uk-margin-remove-bottom">Haz clic sobre cada elemento de tu solicitud para obtener más información.</h5>
 
    <div id = "tablaMisSolicitudes">
        <div class="uk-position-center uk-position-relative uk-margin-xlarge-top" uk-spinner="ratio: 2">

        </div>
    </div>
</div>

<div class = "uk-modal-container" id = "urformulario"></div>
<div class = "uk-modal-container" id = "urpago"></div>
<div class = "uk-modal-container" id = "urentrevista"></div>
<form>
    <input id = "idUsuario" type = number value = <?= $idUsuario ?> hidden readonly >
</form>


</div>
<?php
else:
    http_response_code(404);
    header("location:error");
endif;
include '_footer.html'; ?>
<script type="text/javascript">
    
    muestraMisSolicitudes();

</script>