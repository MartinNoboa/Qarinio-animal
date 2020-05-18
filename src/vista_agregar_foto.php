<?php
include_once("util.php");
$_POST["idPerro"] = limpia_entrada($_POST["idPerro"]);
session_start();
if(checkPriv("editar-perro")):


?>



<div class="uk-modal-dialog uk-modal-body uk-border-rounded">
        <div class="uk-modal-title">
                <h1>Agregar Imagen</h1>
    </div>
    <div class = "uk-modal-body">
        
        <form>
            
            <div class="uk-margin" uk-margin>
            <div uk-form-custom="target: true">
                <h5>Agregar foto</h5>
                <input id = "foto"  name = "foto" type="file">
                <input class="uk-input uk-form-width-medium" type="text" placeholder="Seleccione una foto">
            </div>
        </div>
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