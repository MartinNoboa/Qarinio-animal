<?php
include_once "util.php";
include_once "mailJet.php";
if(isset($_POST["action"])){
    session_start();
    if(send_email("maualvm@gmail.com", "Mauricio Alvarez", "prueba")){
        $_SESSION["mensaje"] = "¡Gracias por contactarnos!";
        header("location:index.php");
    } else{
        $_SESSION["error"] = "Hubo un error al enviar tu formulario";
        header("location:contactanos.php");
    }
}