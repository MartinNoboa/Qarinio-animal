<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $aprobarPago = limpia_entrada($_POST["aprobarPago"]);
    //print_r($aprobarPago);

    if ($aprobarPago == 'true'){
        echo actualizarEstadoPago($id,5);
    }else{
        echo actualizarEstadoPago($id,3);
    }
?>