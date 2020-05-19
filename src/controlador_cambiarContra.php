<?php
include_once "util.php";
if(isset($_POST["contrasenia"],$_POST["verifContrasenia"],$_POST["uid"])){
    $_POST = limpia_entradas($_POST);
    $uid = $_POST["uid"];
    $qry="SELECT uid
            FROM cambio_contrasenia
            WHERE uid='$uid'
            AND  timestamp > DATE_SUB(NOW(), INTERVAL 2 HOUR)
            AND NOT usada";
    $noUsada=sqlqry($qry)->num_rows>0;
    if($noUsada){
        if(cambiarContra($uid, $_POST["contrasenia"])>0){
            http_response_code(200);
            echo "Se ha cambiado tu contraseña";
        }else {
            http_response_code(500);
            echo "Hubo un error al cambiar tu contraseña";
        }
    } else{
        http_response_code(400);
        echo "Link invalido o expirado";
    }
}