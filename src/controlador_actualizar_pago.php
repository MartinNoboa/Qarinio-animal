<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $metodo = limpia_entrada($_POST["metodo"]);
    //print_r($aprobarPago);

    echo actualizarMetodoPago($id, $metodo);
?>