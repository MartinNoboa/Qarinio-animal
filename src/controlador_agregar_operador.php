<?php
    include("util.php");
    session_start();
    if(checkPriv("editar-faq") && checkPriv("editar-info-contacto")){
        $email = limpia_entrada($_POST["email-operador"]);
        $result=agregarOperador($email);
        if($result=="1"){
            $_SESSION["mensaje"] = $email." ahora es operador.";
        } elseif ($result=="2"){
            $_SESSION["error"] = "Este usuario no puede convertirse en operador";
        }
        else{
            $_SESSION["error"] = "Hubo un problema al agregar al operador.";
        }
        header("location:gestionarOperadores");
    } else {
        $_SESSION["error"] = "Hubo un problema al agregar al operador.";
        header("location:gestionarOperadores");
    }
?>
