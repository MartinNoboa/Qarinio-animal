<?php

include_once("util.php");
session_start();

if(checkPriv("ver-todas-solicitudes")) {
    $id = limpia_entrada($_POST["idSolicitud"]);

    echo rechazarSolicitud($id);
} else {
    echo 0;
}

?>
