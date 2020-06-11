<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $aprobarPago = limpia_entrada($_POST["aprobarPago"]);
    session_start();

    if(checkPriv("ver-todas-solicitudes")){
        if ($aprobarPago == 'true'){
            echo actualizarEstadoPago($id,5);
        }else{
            echo actualizarEstadoPago($id,3);
        }
    } else {
        echo("Hubo un error");
    }
?>