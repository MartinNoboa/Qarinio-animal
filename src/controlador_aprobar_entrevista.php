<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $aprobarEntrevista = limpia_entrada($_POST["aprobarEntrevista"]);

    if ($aprobarEntrevista == 'true'){
        echo actualizarEstadoEntrevista($id,5);
    }else{
        echo actualizarEstadoEntrevista($id,3);
    }
?>
