<?php
include_once "util.php";
include_once "mail.php";
if(isset($_POST["action"])){
    session_start();
    $_POST = limpia_entradas($_POST);


    if (send_email_contacto($_POST["email"], $_POST["nombre"]." ".$_POST["apellido"], $_POST["mensaje"])) {
        $_SESSION["mensaje"] = "¡Gracias por contactarnos!";
        header("location:index.php");
    } else {
        $_SESSION["error"] = "Hubo un error al enviar tu formulario";
        header("location:contactanos.php");
    }

}