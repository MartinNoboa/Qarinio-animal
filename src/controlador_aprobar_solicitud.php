<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $aprobar = limpia_entrada($_POST["aprobar"]);

session_start();

if(checkPriv("ver-todas-solicitudes")) {
    if ($aprobar == 'true') {
        echo aprobarSolicitud($id);
    } else {
        echo eliminarSolicitud($id);
    }
} else {
    echo "Hubo un error";
}
?>
