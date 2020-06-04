<?php
    include("util.php");
    session_start();
    $idUsuario = limpia_entrada($_POST["id"]);
    $result=eliminaOperador($idUsuario);
?>
