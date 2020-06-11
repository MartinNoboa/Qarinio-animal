<?php

    include("util.php");
    $id = limpia_entrada($_POST["idSolicitud"]);

    echo rechazarSolicitud($id);
?>
