<?php
include_once("util.php");

$_POST["idPerro"] = limpia_entrada($_POST["idPerro"]);
session_start();
echo $_POST["idPerro"];
$info = getDogInfoById($_POST["idPerro"]);
?>
    <div class="uk-modal-dialog uk-modal-body uk-border-rounded">
        <div class="uk-modal-title">
            <h1><?= $info["nombre"];?></h1>
            <div uk-lightbox="animation: fade">
                <a href="img/Mario.jpg" data-caption=<?= $info["nombre"];?>>
                    <img src="img/Mario.jpg" alt="Imagen del perro" class="uk-border-rounded uk-float-right uk-width-medium">
                </a>
            </div>
        </div>
        <div class="uk-modal-body uk-margin-remove uk-width-2-3 ">
            <button class="uk-modal-close-default" type="button" uk-close></button>

            <table class="uk-table uk-table-divider">
                <tbody>
                    <tr>
                        <td class="uk-table-shrink uk-text-bold">Tamaño:</td>
                        <td><?= $info["tamanio"];?></td>
                    </tr>
                    <tr>
                        <td class="uk-table-shrink uk-text-bold">Edad:</td>
                        <td>
                        <?=sintaxisEdad($info["edad"])?></td>
                    </tr>
                    <tr>
                        <td class="uk-table-shrink uk-text-bold">Sexo:</td>
                        <td><?= $info["sexo"]; ?></td>
                    </tr>
                    <tr>
                        <td class="uk-table-shrink uk-text-bold">Historia:</td>
                        <td><?= $info["historia"]; ?></td>
                    </tr>
                    <tr>
                        <td class="uk-table-shrink uk-text-bold">Raza:</td>
                        <td><?= $info["raza"]; ?></td>
                    </tr>
                    <tr>
                        <td class="uk-table-shrink uk-text-bold">Condiciones Médicas:</td>
                        <td><?= $info["condicion"]; ?></td>
                    </tr>
                    <tr>
                        <td class="uk-table-shrink uk-text-bold">Personalidad:</td>
                        <td><?= $info["personalidad"]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <form class="uk-form uk-align-right" action="nuevaSolicitud.php?idPerro=<?= $_POST['idPerro'] ?>" method="post">
            <button class="uk-button uk-button-primary uk-border-rounded uk-margin-remove-bottom" id="btn-adoptar" type="submit" idPerro ='<?= $_POST['idPerro'] ?>' >Adoptar</button>
        </form>
    </div>
<?php
    http_response_code(200);
?>
