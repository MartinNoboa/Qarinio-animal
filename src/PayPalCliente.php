<?php
include_once "util.php";
session_start();
if(isset($_POST["oId"])){
    $orderId = limpia_entrada($_POST["oId"]);
    if(isset($_SESSION["id"])){
        $dml = "INSERT INTO donacion (numeroTransaccion, idUsuario) VALUES (?, ?)";
        insertIntoDb($dml, $orderId, $_SESSION["id"]);
    } else{
        $dml = "INSERT INTO donacion (numeroTransaccion) VALUES (?)";
        insertIntoDb($dml, $orderId);
    }
}