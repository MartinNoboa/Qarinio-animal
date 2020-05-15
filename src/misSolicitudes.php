<?php
    include '_header.html';
    include '_navbar.html';
    if(checkPriv("adoptar")):
?>
<div class="uk-container uk-margin uk-margin-large-bottom">
    <h1 class="uk-text-center">Mis Solicitudes de Adopción</h1>
    <hr class="uk-divider-icon">
    <div class="uk-overflow-auto">
        <table class="uk-table uk-table-divider uk-table-large">
            <thead clas>
                <tr>
                    <th>Perro</th>
                    <th class="uk-text-center">Formulario</th>
                    <th class="uk-text-center">Entrevista</th>
                    <th class="uk-text-center">Pago</th>
                    <th class="uk-text-center">Editar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
                <tr>
                    <td>2 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
                <tr>
                    <td>3 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
                <tr>
                    <td>4 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
                <tr>
                    <td>5 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
                <tr>
                    <td>6 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
                <tr>
                    <td>7 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
                <tr>
                    <td>8 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
                <tr>
                    <td>9 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
                <tr>
                    <td>10 (Hard Code)</td>
                    <td class="uk-text-center uk-alert-success"><span uk-icon="icon: check" uk-tooltip="¡Tu formulario fue arpobado!"></span></td>
                    <td class="uk-text-center uk-alert-danger"><span uk-icon="icon: close" uk-tooltip="Tu entrevista fue rechazada"></span></td>
                    <td class="uk-text-center uk-alert-warning"><span uk-icon="icon: minus" uk-tooltip="Tu pago está pendiente"></span></td>
                    <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
else:
    http_response_code(404);
    header("location:error.php");
endif;
include '_footer.html'; ?>
