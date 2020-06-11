<?php
    include("util.php");
    session_start();
session_start();

if(checkPriv("editar-info-contacto")) {
    $idUsuario = limpia_entrada($_POST["id"]);
    $result = eliminaOperador($idUsuario);
}
?>
