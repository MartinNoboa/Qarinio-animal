<?php
include_once("util.php");
$_POST["idPerro"] = limpia_entrada($_POST["idPerro"]);
session_start();
if(checkPriv("editar-perro")):
    $info = getDogInfoById($_POST["idPerro"]);
    print_r($info);
?>
    <div class="uk-modal-dialog uk-modal-body">
        <div class="uk-modal-title">
                <h1>Editar Información - <?= $info["nombre"];?>
                <button id="eliminar" class="eliminar uk-align-right uk-text-danger"  uk-icon="icon: trash ;ratio: 2.5"
                idperro=<?= $_POST["idPerro"]; ?> >
                </button>
                </h1>

        </div>
        <div class="uk-modal-body">
            <form class="uk-form-horizontal uk-margin-large">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Nombre:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" type="text" placeholder="<?= $info["nombre"]; ?>" value="<?= $info["nombre"]; ?>">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="tamanio">Tamaño:</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="tamanio">
                            <option <?= $info["tamanio"]=="pequenio"?"selected":"" ?>>Pequeño</option>
                            <option <?= $info["tamanio"]=="mediano"?"selected":"" ?>>Mediano</option>
                            <option <?= $info["tamanio"]=="grande"?"selected":"" ?>>Grande</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="uk-margin">
                    <p class="uk-text-lead">Edad Estimada</label>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="anios">Años:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="anios" type="number" placeholder="<?= $info["anios"]; ?>" value="<?= $info["anios"]; ?>"><br>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="meses">Meses:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="meses" type="number" placeholder="<?= $info["meses"]; ?>" value="<?= $info["meses"]; ?>"><br>
                    </div>
                </div>
                <hr>
                <div class="uk-margin">
                    <label class="uk-form-label" for="sexo">Sexo:</label>
                    <div class="uk-form-controls">
                        <label><input class="uk-radio" type="radio" name="radio2" <?= $info["sexo"]=="macho"?"checked":"" ?>> Macho</label>
                        <label><input class="uk-radio" type="radio" name="radio2" <?= $info["sexo"]=="hembra"?"checked":"" ?>> Hembra</label>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="historia">Historia:</label>
                    <div class="uk-form-controls">
                        <textarea id="historia" class="uk-textarea" data-length="500"><?= $info["historia"]; ?></textarea>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="raza">Raza:</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="raza">
                            <?= recuperarOpcionesConSelect("idRaza", "raza", "tipo_raza", $info["raza"]); ?>
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="condiciones-medicas">Condiciones médicas:</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="condiciones-medicas">
                            <?= recuperarOpcionesConSelect("idCondicion", "condicion", "condiciones_medicas", $info["condicion"]); ?>
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="personalidad">Personalidad:</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="personalidad">
                            <?= recuperarOpcionesConSelect("idPersonalidad", "personalidad", "tipo_personalidad", $info["personalidad"]); ?>
                        </select>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close">Cancelar</button>
                    <button class="uk-button uk-button-primary" type="submit">Guardar</button>
                </p>
            </form>
        </div>
    </div>
<?php
    http_response_code(200);
else:
    http_response_code(404);
    header("location:404");
endif;
?>
