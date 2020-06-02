<?php
    include_once("util.php");
?>
<div class="uk-modal-dialog uk-modal-body uk-border-rounded">
        <div class="uk-modal-title">
                <h1 class="uk-text-center">Editar Preguntas Frecuentes</h1>
            <hr class="uk-divider-icon">
            <h3 class="uk-text-italic">Para eliminar una pregunta, deje en blanco los campos de pregunta y respuesta.</h3>
                
        </div>
        <div class="uk-modal-body">
            <form  id="form-editar-preguntas" class="uk-form-horizontal uk-margin-large" onsubmit="return false;">
               <div id="seccion-preguntas"></div>
                <div class="uk-align-right">
                    <input class="uk-button uk-button-default uk-modal-close uk-border-rounded" type="button" value="Cancelar"></input>
                    <input class="uk-button uk-button-primary uk-border-rounded" id="btn-editar-preguntas" type="submit" value="Guardar"></input>
                </div>
            </form>
            
        </div>
    </div>
