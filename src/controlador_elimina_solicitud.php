<?php
    include("util.php");
    $id = limpia_entrada($_POST['idSol']);
    echo eliminarSolicitud($id);


?>
