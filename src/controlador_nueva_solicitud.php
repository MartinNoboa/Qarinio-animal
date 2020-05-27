<?php
    require_once('util.php');

    limpia_entradas($_POST);

//recupera valores del formulario
    //print_r($_POST);
    $idUsuario = $_POST["idUsuario"];
    $idPerro = $_POST["idPerro"];

    $res1 = $_POST["res1"];
    $res2 = $_POST["res2"];
    $res3 = $_POST["res3"];
    $res4 = $_POST["res4"];
    $res5 = $_POST["res5"];
    $res6 = $_POST["res6"];
    $res7 = $_POST["res7"];
    $res8 = $_POST["res8"];
    $res9 = $_POST["res9"];
    $res10 = $_POST["res10"];
    $res11 = $_POST["res11"];
    $res12 = $_POST["res12"];

//llama a la funcion de util para agregar nueva solicitud
    echo nuevaSolicitud($idUsuario, $idPerro,$res1, $res2,$res3,$res4,$res5,$res6,$res7,$res8,$res9,$res10,$res11,$res12);

?>