<?php
    require_once 'util.php';
    $_POST = limpia_entradas($_POST);
session_start();

if(checkPriv("editar-info-contacto")) {
    $edad = $_POST["anios"] * 12 + $_POST["meses"];
    $result = editarPerro($_POST["idPerro"], $_POST["nombre"], $_POST["tamanio"], $edad, $_POST["sexo"], $_POST["historia"], $_POST["condiciones_medicas"], $_POST["raza"], $_POST["personalidad"], $_POST["estado"]);
    echo $result;
}
?>
