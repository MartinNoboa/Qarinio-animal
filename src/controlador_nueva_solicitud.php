<?php
    require_once('util.php');

    limpia_entradas($_POST);

//recupera valores del formulario
    $idUsuario = $_POST["idUsuario"];
    $idPerro = $_POST["idPerro"];

    $resp1 = $_POST["res1"];
    $resp2 = $_POST["res2"];
    $resp3 = $_POST["res3"];
    $resp4 = $_POST["res4"];
    $resp5 = $_POST["res5"];
    $resp6 = $_POST["res6"];
    $resp7 = $_POST["res7"];
    $resp8 = $_POST["res8"];
    $resp9 = $_POST["res9"];
    $resp10 = $_POST["res10"];
    $resp11 = $_POST["res11"];
    $resp12 = $_POST["res12"];

//llama a la funcion de util para agregar nueva solicitud
    echo nuevaSolicitud($idUsuario, $idPerro);

?>