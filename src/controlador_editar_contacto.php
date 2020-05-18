<?php
    require_once("util.php");
    $nombre = limpia_entrada($_POST["nombre"]);
    $correo = limpia_entrada($_POST["correo"]);
    $direccion = limpia_entrada($_POST["direccion"]);
    $telefono = limpia_entrada($_POST["telefono"]);
    /*for($i = 0; $i < count($datos); $i++){
        echo  'console.log('. $datos[$i] .')';
    }*/
    echo  'console.log('. $nombre .')';
    echo  'console.log('. $correo .')';
    echo  'console.log('. $direccion .')';
    $jsonString = file_get_contents('contacto.json');
    $data = json_decode($jsonString, true);
   
    $data[0]['nombre'] = $nombre;
    $data[0]['correo'] = $correo;
    $data[0]['direccion'] = $direccion;
    $data[0]['telefono']=$telefono;
    $newJsonString = json_encode($data);
    echo file_put_contents('contacto.json', $newJsonString);
?>