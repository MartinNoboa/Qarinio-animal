<?php
    include '_header.html';
    include '_navbar.html';
    include_once 'util.php';
    $err = limpia_entrada($_GET['err']);
 ?>

<div class="uk-container uk-margin">
    <h1 class="uk-text-center">¡Algo salió mal!</h1>
    <h4 class="uk-text-center">Error: <?= $err ?>, <?= $err<=500?"La página solicitada no existe":"Hubo un error en el servidor" ?></h4>
    <?= $err>=500?"<h2 class='uk-text-center'>Estamos trabajando para arreglarlo</h2>":"" ?>
    <?php
    switch($err){
        case 404:
        case 402:
            echo "<img src='img/errorDog.png' alt='imagen de perro triste' class='uk-align-center uk-height-large'>";
            break;
        case 500:
            echo "<img src='img/trabajando.jpg' alt='imagen de perro trabajando con casco' class='uk-align-center uk-height-large'>";
            break;
    }
    ?>


</div>
<?php
include '_footer.html';
 ?>

