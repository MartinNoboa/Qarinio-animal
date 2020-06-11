<?php
    session_start();
    require_once "util.php";
session_start();

if(checkPriv("eliminar-perro")) {
    $perro = check($_POST, "idperro");
    $result = eliminar_perro($perro);
    echo $result;
}
?>
