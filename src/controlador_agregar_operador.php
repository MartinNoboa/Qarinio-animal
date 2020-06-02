<?php
    include("util.php");
    $email = limpia_entrada($_POST["email-operador"]);
    $result=agregarOperador($email);
  
    if($result =="1"){
       $_SESSION["mensaje"] = $email." ahora es operador.";
    }else{
        $_SESSION["error"] = "Hubo un problema al agregar al operador.";
    }
    header("location:index");
?>