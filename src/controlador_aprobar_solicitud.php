<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);
    $aprobar = limpia_entrada($_POST["aprobar"]);

    if ($aprobar == 'true'){
        echo aprobarSolicitud($id);
    }else{
        echo eliminarSolicitud($id);
    }
?>
