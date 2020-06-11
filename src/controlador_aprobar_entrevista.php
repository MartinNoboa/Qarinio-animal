<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $aprobarEntrevista = limpia_entrada($_POST["aprobarEntrevista"]);
session_start();

if(checkPriv("ver-todas-solicitudes")){
    if ($aprobarEntrevista == 'true'){
        echo actualizarEstadoEntrevista($id,5);
    }else{
        echo actualizarEstadoEntrevista($id,3);
    }
} else {
    echo "Hubo un error";
}
    ?>
