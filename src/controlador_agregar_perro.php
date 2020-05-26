<?php
    require_once "util.php";
    //echo "Hola";
    
    limpia_entradas($_POST);
    //print_r($_POST);

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
    
    //codigo para agregar foto
    $directorio = 'img/perros/';
    $nombreFoto = $_FILES["foto"]["name"];
    $temp_name = $_FILES["fotos"]["temp_name"];
    if (move_uploaded_file($temp_name,$directorio.$nombreFoto)){
        echo agregarPerro($nombre,$size,$meses, $fechaLlegada, $genero, $historia, $condiciones, $personalidad,$raza, $estado);
        
    }else {
        echo 0;
    }

    
    
    

?>