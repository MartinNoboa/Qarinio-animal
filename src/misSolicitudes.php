<?php
    include '_header.html';
    include '_navbar.html';
    if(checkPriv("adoptar")):
?>

<div class="uk-container uk-margin uk-margin-large-bottom">
    <h1 class="uk-text-center">Mis Solicitudes de Adopción</h1>
    <hr class="uk-divider-icon">
    <form class="uk-form uk-align-right" action="catalogo.php" method="post">
        <button class="uk-button uk-button-primary uk-border-rounded" type="submit" name="button">Adoptar un perro</button>
    </form>
    <?= muestraSolicitudes(); ?>
</div>
<?php
else:
    http_response_code(404);
    header("location:error.php");
endif;
include '_footer.html'; ?>
