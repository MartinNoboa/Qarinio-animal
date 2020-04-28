<?php
include_once("util.php");
session_start();
if(checkPriv("editar-perro")):

?>
    <div class="uk-modal-dialog uk-modal-body">
        <div class="uk-modal-title">
                <h1>Editar Información - <?= $_POST["idPerro"]?>
                <button id="eliminar" class="eliminar uk-align-right uk-text-danger"  uk-icon="icon: trash ;ratio: 2.5" idperro=<?= $_POST["idPerro"]?>>
                </button>
                </h1>

        </div>
        <div class="uk-modal-body">
            <form class="uk-form-horizontal uk-margin-large">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Nombre:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" type="text" placeholder="Firulais(falta conectar db)">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select">Tamaño:</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-horizontal-select">
                            <option>Pequeño</option>
                            <option>Mediano</option>
                            <option>Grande</option>
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Edad estimada:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" type="number" placeholder="10 meses(falta conectar db)">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Fecha de llegada:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" type="date" placeholder="dd/mm/yyyy(falta conectar db)">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select">Género:</label>
                    <div class="uk-form-controls">
                        <label><input class="uk-radio" type="radio" name="radio2" checked> Macho</label>
                        <label><input class="uk-radio" type="radio" name="radio2"> Hembra</label>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Historia:</label>
                    <div class="uk-form-controls">
                        <textarea id="form-horizontal-text" class="uk-textarea" data-length="500"></textarea>
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
else:
    http_response_code(404);
    header("location:404");
endif;
?>