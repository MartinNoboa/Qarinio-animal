<?php 
    include_once 'util.php';

    $_POST = limpia_entradas($_POST);
    $periodo = $_POST["periodo"];
    $donante = $_POST["donante"];
    $num = $_POST["transac"];

?>

<table class="uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium uk-text-center">
    <thead >
        <tr>
            <th class="uk-text-center uk-width-small uk-text-secondary">Nombre</th>
            <th class="uk-text-center uk-width-small uk-text-secondary">Cantidad</th>
            <th class="uk-text-center uk-width-small uk-text-secondary">Comisión de Paypal</th>
            <th class="uk-text-center uk-width-small uk-text-secondary">No. transacción</th>
            <th class="uk-text-center uk-width-small uk-text-secondary">Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?= muestraDonaciones($periodo, $donante, $num);  ?>
    </tbody>
</table>