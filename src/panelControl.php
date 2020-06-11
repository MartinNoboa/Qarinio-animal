<?php
    include("_header.html");
    include("_navbar.html");
    if(checkPriv("editar-faq") && checkPriv("editar-info-contacto")):
 ?>
<div class="uk-container uk-margin-top">
    <h1 class="uk-text-center uk-animation-slide-bottom-medium">Panel de Control</h1>
    <hr class="uk-divider-icon">
    <div class="uk-margin-bottom uk-animation-fade">
        <h3>Preguntas Frecuentes
            <a id="editar-preguntas" class="uk-icon-button uk-button-primary uk-margin-left" uk-icon="pencil" uk-tooltip="title: Editar"></a>
        </h3>
        <div class="uk-modal-container" id="modal-editar-preguntas" ></div>
    </div>
    <hr>
    <div class="uk-animation-fade">
        <h3>Cuota de Recuperación</h3>
        <input type="number" class="uk-input uk-border-rounded uk-width-medium" id="cuota" value="<?= getCuota();  ?>" placeholder="Cantidad en pesos" min="0" step="0.01">
        <button class="uk-button uk-button-primary uk-border-rounded" id="editar-cuota" type="button">Guardar</button>
    </div>
    <hr>
    <div class=" uk-animation-fade">
        <h3>Información de Contacto</h3>
        <div id="seccion-contacto"></div>
            <button class="uk-button uk-button-primary uk-border-rounded uk-align-right" id="editar-contacto" type="button">Guardar</button>
    </div>

</div>

</div>
<?php
    http_response_code(200);
else:
    http_response_code(404);
    header("location:error");
endif;
include("_footer.html")
?>
<script type="text/javascript">
    document.getElementById("editar-preguntas").onclick=editarPreguntas;
    document.getElementById("editar-contacto").onclick=submitEditarContacto;
    document.getElementById("editar-cuota").onclick=submitEditarCuota;
    mostrarContacto();
    mostrarEdicionContacto();
</script>
