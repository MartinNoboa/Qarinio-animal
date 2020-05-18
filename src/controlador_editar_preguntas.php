<?php
    require_once("util.php");
    $datos = limpia_entradas($_POST["datos"]);
    $datosp = limpia_entradas($_POST["datosp"]);
    /*for($i = 0; $i < count($datos); $i++){
        echo  'console.log('. $datos[$i] .')';
    }*/

    $jsonString = file_get_contents('preguntas.json');
    $data = json_decode($jsonString, true);
    foreach ($data as $key => $entry) {
        if ($entry['id'] == $key) {
            $data[$key]['respuesta'] = $datos[$key];
            $data[$key]['pregunta'] = $datosp[$key];
        }
    }
    $newJsonString = json_encode($data);
    echo file_put_contents('preguntas.json', $newJsonString);
?>