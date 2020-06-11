<?php
    include("util.php");
    session_start();
    if(isset($_SESSION["id"])){
        $qry="SELECT * from solicitud where idSolicitud=". $_POST['idSol'] ." and idUsuario=" . $_SESSION["id"];
        if(sqlqry($qry)->num_rows>0) {
            $id = limpia_entrada($_POST['idSol']);
            echo eliminarSolicitud($id);
        }
    }

?>
