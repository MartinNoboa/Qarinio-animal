<?php
    require_once 'util.php';
    foreach($_POST as &$key){
        $key = limpia_entrada($key);
    }
    $perro = check($_POST,"idPerro");
    $edad = $_POST["anios"]*12 + $_POST["meses"];
    $result = editarPerro($_POST["idPerro"], $_POST["nombre"], $_POST["tamanio"], $edad, $_POST["sexo"], $_POST["historia"], $_POST["condiciones_medicas"], $_POST["raza"], $_POST["personalidad"]);
    echo $result;
?>
