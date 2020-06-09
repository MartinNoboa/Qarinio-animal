<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $aprobar = limpia_entrada($_POST["aprobar"]);

    if ($aprobar == 'true'){
        //echo actualizarEstadoFormulario($id,5);
    }else{
        //echo actualizarEstadoFormulario($id,3);
    }
?>
