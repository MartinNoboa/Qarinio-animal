<?php

session_start();

if(checkPriv("ver-todas-solicitudes")) {
    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);

    echo rechazarSolicitud($id);
}    else {
    echo "Hubo un error";
}

?>
