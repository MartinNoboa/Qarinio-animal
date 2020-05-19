<?php
    include_once("util.php");
    session_start();
?>
<div class="uk-modal-dialog uk-modal-body uk-border-rounded">
        <div class="uk-modal-title">
                <h1>Editar Informacion de Contacto</h1>
        </div>
        <div class="uk-modal-body">
            <form  id="form-editar-contacto" class="uk-form-horizontal uk-margin-large">
               <div id="seccion-contacto"></div>

              
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close uk-border-rounded">Cancelar</button>
                    <button class="uk-button uk-button-primary uk-border-rounded" id="btn-editar-contacto" type="button">Guardar</button>
                </p>
            </form>
        </div>
    </div>