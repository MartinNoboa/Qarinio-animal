<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $metodo = limpia_entrada($_POST["metodo"]);
    //print_r($aprobarPago);
session_start();

if(checkPriv("adoptar")){
    echo actualizarMetodoPago($id, $metodo);
} else {
    echo "Hubo un error";
}
?>