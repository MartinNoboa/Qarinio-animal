<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);

session_start();

if(checkPriv("ver-todas-solicitudes")) {
        echo aprobarSolicitud($id);
} else {
    echo "Hubo un error";
}

?>
