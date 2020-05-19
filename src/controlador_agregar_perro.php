<?php
    require_once "util.php";
    //echo "Hola";
    
    limpia_entradas($_POST);

    $nombre = $_POST["nombre"];
    $size = $_POST["size"];
        
    $meses = $_POST["meses"];

    $fechaLlegada = date('Y-m-d', strtotime($_POST['fechaLlegada']));
    $genero = $_POST["genero"];
    $condiciones = $_POST["condiciones"];
    $personalidad = $_POST["personalidad"];
    $raza = $_POST["raza"];
    $estado = $_POST["estado"];
    $historia = $_POST["historia"];


    
    
    echo agregarPerro($nombre,$size,$meses, $fechaLlegada, $genero, $historia, $condiciones, $personalidad,$raza, $estado);
    

?>