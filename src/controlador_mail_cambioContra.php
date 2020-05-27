<?php
include_once "util.php";
include_once "mail.php";
$mail=limpia_entrada($_POST["mail"]);

if(cuentaExistente($mail)){
    $user = mysqli_fetch_array(sqlqry("SELECT idUsuario, nombre, apellido FROM usuario WHERE email='$mail'"));
    $uniqId = insertUid("cambio_contrasenia", $user["idUsuario"]);
    send_email_contr($mail, $user["nombre"]." ".$user["apellido"], $uniqId);
    echo "200";
} else {
    echo "404";
}