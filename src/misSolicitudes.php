<?php
    include '_header.html';
    include '_navbar.html';
    if(checkPriv("adoptar")):
?>

<div class="uk-container uk-margin uk-margin-large-bottom">
    <h1 class="uk-text-center">Mis Solicitudes de Adopción</h1>
    <hr class="uk-divider-icon">
    <form class="uk-form uk-align-right" action="catalogo.php" method="post">
        <button class="uk-button uk-button-primary uk-border-rounded" type="submit" name="button">Adoptar un perro</button>
    </form>
    <table class="uk-table uk-table-divider uk-table-large uk-table-hover uk-animation-slide-bottom-medium">
        <thead clas>
            <tr>
                <th class="uk-width-small">Perro</th>
                <th class="uk-text-center">Formulario</th>
                <th class="uk-text-center">Entrevista</th>
                <th class="uk-text-center">Pago</th>
                <!-- <th class="uk-text-center">Editar</th> -->
            </tr>
        </thead>
        <tbody>
            <tr onclick="window.location='catalogo.php';">
                <td>1 (Hard Code)</td>
                <td class="uk-text-center"><span class="uk-text-center uk-text-success" uk-icon="icon: check" uk-tooltip="title: ¡Tu formulario fue aprobado!"></span></td>
                <td class="uk-text-center"><span class="uk-text-center uk-text-danger" uk-icon="icon: close" uk-tooltip="title: Tu entrevista fue rechazada"></span></td>
                <td class="uk-text-center"><span class="uk-text-center uk-text-warning" uk-icon="icon: minus" uk-tooltip="title: Tu pago está pendiente"></span></td>
                <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
            </tr>
            <tr onclick="window.location='index.php';">
                <td>2 (Hard Code)</td>
                <td class="uk-text-center"><span class="uk-text-center uk-text-danger" uk-icon="icon: close" uk-tooltip="title: Tu formulario fue rechazado"></span></td>
                <td class="uk-text-center"><span class="uk-text-center uk-text-success" uk-icon="icon: check" uk-tooltip="title: ¡Tu entrevista fue aprobada!"></span></td>
                <td class="uk-text-center"><span class="uk-text-center uk-text-warning" uk-icon="icon: minus"></span></td>
                <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
            </tr>
            <tr>
                <td>3 (Hard Code)</td>
                <td class="uk-text-center"><span class="uk-text-center uk-text-success" uk-icon="icon: check"></span></td>
                <td class="uk-text-center"><span class="uk-text-center uk-text-danger" uk-icon="icon: close"></span></td>
                <td class="uk-text-center"><span class="uk-text-center uk-text-warning" uk-icon="icon: minus"></span></td>
                <td class="uk-text-center"><a class="uk-link-text" href="#"><span uk-icon="icon: file-edit"></span></a></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
else:
    http_response_code(404);
    header("location:error.php");
endif;
include '_footer.html'; ?>
