<?php
function get_self_domain(){return "carino.dawbd.org";}
function get_self_email(){
    //return "contacto@get_self_domain();"
    return "qarinotest@gmail.com";
}

function send_email($recipient, $subject, $contenido){
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: '.get_self_email()."\r\n".
        'Reply-To: '.get_self_email()."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    $body = include "_email.php";
    return mail($recipient, $subject, $body, $headers);
    //return true;
}

function send_email_contacto($solicitante, $nombre, $mensaje){
    $contenido = "<h2></h2>";
    $contenido.="<h4></h4>";
    $contenido.="<strong>$nombre ha escrito:</strong><p class='msg'>$mensaje</p>";
    $contenido.="<h4>Responde a $nombre al correo <a href='mailto:$solicitante'>$solicitante</a></h4>";

    $contSolic="<h2>¡Gracias por escribirnos!</h2>";
    $contSolic.="<h4>Nos pondremos en contacto contigo lo antes posible.</h4>";
    $contSolic.="<strong>Tu Mensaje:</strong><p class='msg'>$mensaje</p>";
    $contSolic.="Si tienes más dudas te invitamos a visitar nuestras páginas de 
    <a href='https://". get_self_domain() ."/preguntasFrecuentes'>preguntas frecuentes</a>
     y  
    <a href='https://". get_self_domain() ."/comoAyudar'>cómo ayudar.</a><br>";

    $res = send_email($solicitante, "Gracias por ponerte en contacto con Qariño Animal", $contSolic) &&
            send_email(get_self_email(), "Contacto Qariño Animal", $contenido);
    return $res;
}