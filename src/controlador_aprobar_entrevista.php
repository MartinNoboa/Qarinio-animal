<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $aprobarEntrevista = limpia_entrada($_POST["aprobarEntrevista"]);
    //print_r($aprobarPago);

    if ($aprobarEntrevista == 'true'){
        echo actualizarEstadoPago($id,5);
    }else{
        echo actualizarEstadoPago($id,3);
    }
?>