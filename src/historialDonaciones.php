<?php
    include '_header.html';
    include '_navbar.html';
    include_once 'util.php';
if(checkPriv("editar-faq")):
?>
<div class="uk-container uk-margin">
    <h1 class="uk-text-center">Historial de Donaciones</h1>
    <hr class="uk-divider-icon">
    <div>
        <div class="uk-search uk-search-default uk-width-expand uk-margin uk-width-medium">
            <span uk-search-icon></span>
            <input id="buscarDonante" class="uk-search-input uk-border-rounded" type="search" placeholder="Buscar por donante...">
        </div>
        <div class="uk-search uk-search-default uk-width-expand uk-margin uk-width-large">
            <span uk-search-icon></span>
            <input id="buscarTransac" class="uk-search-input uk-border-rounded" type="search" placeholder="Buscar por número de transacción...">
        </div>
        <select id = "periodo" class = "uk-select uk-border-rounded uk-width-medium">
            <option selected value = "1">Último mes</option>
            <option value = "2">Últimos 3 mes</option>
            <option value = "3">Últimos 6 mes</option>
            <option value = "4">Último año</option>
            <option value = "5">Todas las donaciones</option>
        </select>
    </div>
    
    <hr class="uk-divider-icon">
    <div id = "tablaDonaciones">
        
    </div>
</div>
<?php
    http_response_code(200);
else:
    http_response_code(404);
endif;
include("_footer.html")
?>
<script>
    filtrarDonaciones();
    document.getElementById("periodo").addEventListener("change", filtrarDonaciones);
    let waitForTypeStopD = null;
    document.getElementById("buscarDonante").addEventListener("input", function(){
        clearTimeout(waitForTypeStopD);
        waitForTypeStopD = setTimeout(function(){
            filtrarDonaciones();
        }, 500)
    });
    
    let waitForTypeStopT = null;
    document.getElementById("buscarTransac").addEventListener("input", function(){
        clearTimeout(waitForTypeStopT);
        waitForTypeStopT = setTimeout(function(){
            filtrarDonaciones();
        }, 500)
    });
</script>
