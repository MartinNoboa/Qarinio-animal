<?php
include_once "util.php";
$_GET=limpia_entradas($_GET);

if(!isset($_GET["caso"])){
    $_GET["caso"]="";
}
session_start();

if (isset($_POST["oId"])) {
    if ($_GET["caso"] == "donacion") {
        $orderId = limpia_entrada($_POST["oId"]);
        if (isset($_SESSION["id"])) {
            $dml = "INSERT INTO donacion (numeroTransaccion, idUsuario) VALUES (?, ?)";
            insertIntoDb($dml, $orderId, $_SESSION["id"]);
        } else {
            $dml = "INSERT INTO donacion (numeroTransaccion) VALUES (?)";
            insertIntoDb($dml, $orderId);
        }

    } else if ($_GET["caso"] == "cuotaRecuperacion" && isset($_SESSION["id"])) {
        $dml = "UPDATE solicitud set estadoPago=9, fechaPago=current_timestamp(), noTransaccion='". $_POST["oId"] ."' where idSolicitud=". $_POST["sId"] ." and idUsuario=" . $_SESSION['id'];
        echo $dml;
        modifyDb($dml);
    } else {
        http_response_code(404);
    }
} else {
    http_response_code(404);
}
