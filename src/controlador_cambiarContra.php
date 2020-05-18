<?php
include_once "util.php";
if(isset($_POST["contrasenia"],$_POST["verifContrasenia"],$_POST["uid"])){
    $_POST = limpia_entradas($_POST);
    $uid = $_POST["uid"];
    $sql="SELECT uid
            FROM cambio_contrasenia
            WHERE uid='$uid'
            AND  timestamp > DATE_SUB(NOW(), INTERVAL 1 HOUR)
            AND NOT usada";
    print_r($_POST);
}