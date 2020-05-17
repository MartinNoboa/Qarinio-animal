<?php
    $datos = $_POST["datos"];
    $datosp = $_POST["datosp"];
    /*for($i = 0; $i < count($datos); $i++){
        echo  'console.log('. $datos[$i] .')';
    }*/

    $jsonString = file_get_contents('preguntas.json');
    $data = json_decode($jsonString, true);
    $i = 0;
    foreach ($data as $key => $entry) {
       
        if ($entry['id'] == $i) {
            $data[$key]['respuesta'] = $datos[$i];
            $data[$key]['pregunta'] = $datosp[$i];
        }
        $i++;
    }
    $newJsonString = json_encode($data);
    file_put_contents('preguntas.json', $newJsonString);
?>