<?php
include_once "util.php";
$_POST = limpia_entradas($_POST);
if(isset($_POST["contrasenia"],$_POST["verifContrasenia"])){
    $sql="SELECT uid
            FROM cambio_contrasenia
            WHERE uid='339206bae7d33e0f1sa6dt9f387d0706'
            AND  timestamp > DATE_SUB(NOW(), INTERVAL 1 HOUR)
            AND NOT usada";
}