<?php
    require_once "util.php";
    include("_header.html");
    include("_navbar.html");

    $nombre = $_POST["nombre"];
    $size = $_POST["size"];
        
    $years = $_POST["years"];
    $meses = $_POST["meses"];

    $edad = $years *12 + $meses;
    $fechaLlegada = date('Y-m-d', strtotime($_POST['fecha']));
    $genero = $_POST["genero"];
    $condicion = $_POST["condiciones"];
    $personalidad = $_POST["personalidad"];
    $raza = $_POST["raza"];
    $historia = $_POST["historia"];
    
    $incompleto = false;
    /*if(empty($nombre) || empty($size) || empty($years) || empty($meses) || empty($fechaLlegada) || empty($genero) || empty($historia) || empty($idPersonalidad) || empty($idCondicion) || empty($idRaza)){
        $incompleto = true;
    }*/

    
    if ($incompleto){
        llenarCampos();
    }else{
        agregarPerro($nombre,$size,$edad, $fechaLlegada, $genero, $historia, $condicion,$raza, $personalidad);
    }


    function llenarCampos(){
        echo '<script type="text/javascript">alert("Por favor completa todos los campos");</script>';
    }
?>