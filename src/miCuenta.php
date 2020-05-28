<?php
    include("_header.html");
    include("_navbar.html");
    $idUsuario = limpia_entrada($_SESSION["id"]);
    if(checkPriv("editar-perfil")):
        $info = getUserInfoById($idUsuario);
?>
    <div class="uk-container uk-margin-top">
        <h1 class="uk-text-center">Editar Mi Perfil</h1>
        <hr class="uk-divider-icon uk-margin-large-left uk-margin-large-right">
        <form class="uk-form-horizontal uk-margin-large-left uk-margin-large-right">
            <div class="uk-margin">
                <p class="uk-text-lead">Información Básica</p>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="nombre">Nombre:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="nombre" type="text" placeholder="<?= $info["nombre"]; ?>" value="<?= $info["nombre"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="apellido">Apellido:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="apellido" type="text" placeholder="<?= $info["apellido"]; ?>" value="<?= $info["apellido"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="fechaNacimiento">Fecha de Nacimiento:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="fechaNacimiento" type="date" placeholder="<?= $info["fechaNacimiento"]; ?>" value="<?= $info["fechaNacimiento"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="email">Correo Electrónico:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="email" type="text" placeholder="<?= $info["email"]; ?>" value="<?= $info["email"]; ?>">
                </div>
            </div>

            <div class="uk-inline-clip">
                <div class="uk-form-controls">
                    <button name="cambia-contrasenia" class="uk-button uk-button-primary uk-button-small uk-border-rounded">Cambiar mi contraseña</button>
                </div>
            </div>

            <hr>
            <div class="uk-margin">
                <p class="uk-text-lead">Información de Contacto</p>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="telefono">Teléfono:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="telefono" type="text" placeholder="<?= $info["telefono"]; ?>" value="<?= $info["telefono"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="principal">Calle Principal:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="principal" type="text" placeholder="<?= $info["callePrincipal"]; ?>" value="<?= $info["callePrincipal"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="secundaria">Calle Secundaria:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="secundaria" type="text" placeholder="<?= $info["calleSecundaria"]; ?>" value="<?= $info["calleSecundaria"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="numExt">Número Exterior:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="numExt" type="text" placeholder="<?= $info["NumeroExterior"]; ?>" value="<?= $info["NumeroExterior"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="numInt">Número Interior:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="numInt" type="text" placeholder="<?= $info["NumeroInterior"]; ?>" value="<?= $info["NumeroInterior"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="cp">Código Postal:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="cp" type="text" placeholder="<?= $info["CodigoPostal"]; ?>" value="<?= $info["CodigoPostal"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="colonia">Colonia:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="colonia" type="text" placeholder="<?= $info["Colonia"]; ?>" value="<?= $info["Colonia"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="ciudad">Ciudad:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="ciudad" type="text" placeholder="<?= $info["Ciudad"]; ?>" value="<?= $info["Ciudad"]; ?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="estado">Estado:</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-border-rounded" id="estado" type="text" placeholder="<?= $info["Estado"]; ?>" value="<?= $info["Estado"]; ?>">
                </div>
            </div>
            <hr>
            <div class="uk-margin">
                <div class="uk-form-controls">
                    <button type="submit" name="editar-perfil" class="uk-button uk-button-primary uk-align-right uk-border-rounded">Guardar</button>
                </div>
            </div>
        </form>

    </div>

<?php
else:
    http_response_code(404);
    header("location:error");
endif;
    include("_footer.html");
 ?>
