<?php
    require_once "util.php";


    $nombre = $_POST["nombre"];
    $size = $_POST["size"];
        
    $meses = $_POST["meses"];

    $fechaLlegada = date('Y-m-d', strtotime($_POST['fecha']));
    $genero = $_POST["genero"];
    $condiciones = $_POST["condiciones"];
    $personalidad = $_POST["personalidad"];
    $raza = $_POST["raza"];
    $historia = $_POST["historia"];
    
    $incompleto = false;
    if(empty($nombre) || empty($size) ||  empty($meses) || empty($fechaLlegada) || empty($genero) || empty($historia) || empty($condiciones) || empty($personalidad) || empty($raza)){
        $incompleto = true;
    }

    
    if ($incompleto){
        llenarCampos();
    }else{
        agregarPerro($nombre,$size,$meses, $fechaLlegada, $genero, $historia, $condiciones,$raza, $personalidad);
        header("location:catalogo.php");
    }


    function llenarCampos(){
        echo '<script type="text/javascript">alert("Por favor llene todos los campos.");</script>';
    }
?>