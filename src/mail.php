<?php
function get_self_domain(){return "carino.dawbd.org";}
function get_self_email(){
    //return "contacto@get_self_domain();"
    return "qarinotest@gmail.com";
}

function send_email($recipient, $subject, $contenido){
    $body = include "_email.php";
    return mail($recipient, $subject, $body);
    //return true;
}

function send_email_contacto($solicitante, $nombre, $mensaje){
    $contenido = "";

    $contSolic="<h2>¡Gracias por escribirnos!</h2>";
    $contSolic.="<h4>Nos pondremos en contacto contigo lo antes posible</h4>";
    $contSolic.="<strong>Tu Mensaje:</strong><p class='msg'>$mensaje</p>";
    $contSolic.="Si tienes mas dudas te invitamos a visitar nuestras páginas de 
    <a href='https://". get_self_domain() ."/preguntasFrecuentes'>preguntas frecuentes</a>
     y  
    <a href='https://". get_self_domain() ."/comoAyudar'>como ayudar</a><br>";

    $res = send_email($solicitante, "Gracias por ponerte en contacto con Qariño Animal", $contSolic) /*&&
            send_email(get_self_email(), "Contacto Qariño Animal", $contenido)*/;
    return $res;
}

//echo send_email_contacto("estradaf.bernardo@gmail.com", "Bernardo Estrada", "Holañé!");
function test_email(){
    $mensaje = "gokdasinmoasinvsdvwsvfdf";

    return include "_email.php";
}
echo send_email_contacto("estradaf.bernardo@gmail.com", "Bernardo", "Hola me gusta su pagina");