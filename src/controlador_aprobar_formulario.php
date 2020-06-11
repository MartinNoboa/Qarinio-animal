<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $aprobar = limpia_entrada($_POST["aprobar"]);
    session_start();

if(checkPriv("ver-todas-solicitudes")){
    if ($aprobar == 'true'){
        echo actualizarEstadoFormulario($id,5);
    }else{
        echo actualizarEstadoFormulario($id,3);
    }
} else {
    echo "Hubo un error";
}
?>
