<?php
    include '_header.html';
    include '_navbar.html';
    if(checkPriv("adoptar")):
?>

<div class="uk-container uk-margin uk-margin-large-bottom">
    <h1 class="uk-text-center">Gestionar Solicitudes de Adopción</h1>
    <hr class="uk-divider-icon">
    

    <div  id = "filtrosSolicitudes">
    
        <select id = "estado" class = "uk-select uk-border-rounded uk-width-medium">
            <option selected value="1">Solicitudes en proceso</option>
            <option value = "2">Solicitudes rechazadas</option>
            <option  value = "3">Solicitudes aprobadas</option>
        </select>

        <button class = "uk-button uk-button-primary uk-border-rounded" id = "filtroSolicitudes">Aplicar</button>
    </div>
    <div class="uk-search uk-search-default uk-margin">
            <span uk-search-icon></span>
            <input id="nombre" class="uk-search-input uk-border-rounded uk-width-medium" type="search" placeholder="Buscar...">
        </div>  
    
    <h5 class="uk-margin-remove-bottom">Haz clic sobre cada elemento de tu solicitud para obtener más información.</h5>


    <div id = "tablaSolicitudes">
            <?php
            include("controlador_gestionar_solicitudes.php");
            ?>
<!--        <div class="uk-position-center uk-position-relative uk-margin-xlarge-top" uk-spinner="ratio: 2"></div>-->
    </div>
</div>

<div class = "uk-modal-container" id = "formulario"></div>
<div class = "uk-modal-container" id = "pago"></div>
<div class = "uk-modal-container" id = "entrevista"></div>

<?php
else:
    http_response_code(404);
    header("location:error");
    endif;
    include '_footer.html';
?>

<script type="text/javascript">
    setEventListenerSolicitudes();
    
    document.getElementById("filtroSolicitudes").onclick = filtrarSolicitudes;

    let waitForTypeStop = null;
    document.getElementById("nombre").addEventListener("input", function(){
        clearTimeout(waitForTypeStop);
        waitForTypeStop = setTimeout(function(){
            filtrarSolicitudes();
        }, 500)
    });

</script>
