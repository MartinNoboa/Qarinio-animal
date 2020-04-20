<div id="modal-editar" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <div class="uk-modal-title">
            <h1>Editar Información</h1>
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
                    <label class="uk-form-label" for="form-horizontal-select">Sexo:</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-horizontal-select">
                            <option>Macho(falta conectar db)</option>
                            <option>Hembra(falta conectar db)</option>
                        </select>
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
</div>
