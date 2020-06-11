<?php
    include '_header.html';
    include '_navbar.html';
    include_once 'util.php';
if(checkPriv("editar-faq")):
?>
<div class="uk-container uk-margin">
    <h1 class="uk-text-center">Historial de Donaciones</h1>
    <hr class="uk-divider-icon">
    <div id = "tablaDonaciones">
        <table class="uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium">
            <thead>
                <tr>
                    <th class="uk-width-small uk-text-secondary">Nombre</th>
                    <th class="uk-width-small uk-text-secondary">Cantidad</th>
                    <th class="uk-width-small uk-text-secondary">Comisión de Paypal</th>
                    <th class="uk-width-small uk-text-secondary">No. transacción</th>
                    <th class="uk-width-small uk-text-secondary">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?= muestraDonaciones();  ?>
            </tbody>
        </table>
    </div>
</div>
<?php
    http_response_code(200);
else:
    http_response_code(404);
endif;
include("_footer.html")
?>
