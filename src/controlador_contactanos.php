<?php
include_once "util.php";
include_once "mail.php";
if(isset($_POST["action"])){
    session_start();
    $_POST = limpia_entradas($_POST);

    $to_email = "estradaf.bernardo@gmail.com";
    $subject = "Simple Email Test via PHP";
    $body = "Hi,nn This is test email send by PHP Script";
    $headers = "From: sender\'s email";
    if (mail($to_email, $subject, $body, $headers)) {
        $_SESSION["mensaje"] = "¡Gracias por contactarnos!";
        header("location:index.php");
    } else {
        $_SESSION["error"] = "Hubo un error al enviar tu formulario";
        header("location:contactanos.php");
    }

}